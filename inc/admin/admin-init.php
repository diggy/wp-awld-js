<?php
/**
 * Admin
 * 
 * Main admin file.
 *
 * @author      Peter J. Herrel
 * @category    Admin
 * @package     AWLD JS for WordPress
 */

/**
 * Admin Menu
 */
add_action( 'admin_menu', 'wp_awld_js_admin_menu' );
function wp_awld_js_admin_menu()
{
    global $menu, $wp_awld_js;
    $main_page = add_options_page(
        __( 'AWLD Linked Data', 'wp_awld_js' )
        ,__( 'AWLD Linked Data', 'wp_awld_js' )
        ,'manage_options'
        ,'wp-awld-js-settings'
        ,'wp_awld_js_settings_page'
    );
}

/**
 * Includes
 */
function wp_awld_js_settings_page()
{
    include_once( 'admin-forms.php' );
    include_once( 'admin-settings.php' );
    wp_awld_js_settings();
}

/**
 * tinyMCE button
 */
add_filter( 'mce_buttons', 'wp_awld_js_add_buttons_wysiwyg_editor' );
function wp_awld_js_add_buttons_wysiwyg_editor( $mce_buttons )
{
    $pos = array_search( 'wp_more', $mce_buttons, true );
    if ( $pos !== false ) {
        $tmp_buttons = array_slice( $mce_buttons, 0, $pos+1 );
        $tmp_buttons[] = 'wp_page';
        $mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos+1 ) );
    }
    return $mce_buttons;
}

add_action( 'init', 'wp_awld_js_add_shortcode_button' );
function wp_awld_js_add_shortcode_button()
{
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) return;
    if ( get_user_option( 'rich_editing' ) == 'true' && get_option( 'wp_awld_js_button' ) == 'yes' ) :
        add_filter( 'mce_external_plugins', 'wp_awld_js_add_shortcode_tinymce_plugin' );
        add_filter( 'mce_buttons', 'wp_awld_js_register_shortcode_button' );
    endif;
}

function wp_awld_js_register_shortcode_button( $buttons )
{
    array_push($buttons, "|", "wp_awld_js_shortcodes_button" );
    return $buttons;
}

function wp_awld_js_add_shortcode_tinymce_plugin( $plugin_array )
{
    global $wp_awld_js;
    $plugin_array['AwldShortcodes'] = $wp_awld_js->plugin_dir_url . 'inc/assets/js/wp/awld_editor_plugin.js';
    return $plugin_array;
}

add_filter( 'tiny_mce_version', 'wp_awld_js_refresh_mce' );
function wp_awld_js_refresh_mce( $ver )
{
    $ver += 3;
    return $ver;
}

/**
 * Awld.js Add Quicktags to HTML editor
 **/
if( ! function_exists( '_wp_awld_js_add_quicktags' ) )
{
    add_action( 'admin_print_footer_scripts',  '_wp_awld_js_add_quicktags' );
    function _wp_awld_js_add_quicktags()
    { 
        if ( get_option( 'wp_awld_js_quicktags' ) != 'yes' || ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) return;
        global $pagenow;
        if( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) :
        ?>
        <script type="text/javascript">
        /* Add custom Quicktag buttons to the editor Wordpress ver. 3.3 and above only
         *
         * Params for this are:
         * - Button HTML ID (required)
         * - Button display, value="" attribute (required)
         * - Opening Tag (required)
         * - Closing Tag (required)
         * - Access key, accesskey="" attribute for the button (optional)
         * - Title, title="" attribute (optional)
         * - Priority/position on bar, 1-9 = first, 11-19 = second, 21-29 = third, etc. (optional)
         */
        QTags.addButton( 'awld', 'AWLD', '[awld href=""]', '[/awld]', '', 'default', '991' );
        QTags.addButton( 'awld_object', 'awld object', '[awld href="" type="object"]', '[/awld]', '', 'object', '992' );
        QTags.addButton( 'awld_person', 'awld person', '[awld href="" type="person"]', '[/awld]', '', 'person', '993' );
        QTags.addButton( 'awld_index', 'awld index', '[awld_index]', ' ', '', 'widget', '994' );
        </script>
    <?php endif;
    }
}

/**
 * Activation
 */
function activate_wp_awld_js()
{
    update_option( 'wp_awld_js_install', 1 );
    install_wp_awld_js();
}

/**
 * Install
 */
function install_wp_awld_js()
{
    global $wp_awld_js;
    wp_awld_js_default_options();
    update_option( "wp_awld_js_db_version", $wp_awld_js->version );
}

/**
 * Update options
 */
function wp_awld_js_default_options()
{
    global $wp_awld_js_settings;
    include_once( 'admin-settings.php' );
    foreach ( $wp_awld_js_settings as $section ) {
        foreach ( $section as $value ) {
            if ( isset( $value['std'] ) && isset( $value['id'] ) ) {
                add_option($value['id'], $value['std']);   
            }
        }
    }
}

/**
 * Redirect after activation
 */
add_action( 'admin_init', 'wp_awld_js_activ_redirect' );
function wp_awld_js_activ_redirect()
{
    if ( get_option( 'wp_awld_js_install' ) == 1 ) :
        $url = admin_url() . 'options-general.php?page=wp-awld-js-settings&tab=about&activated=1';
        delete_option( 'wp_awld_js_install' );
        wp_safe_redirect( $url );
        exit;
    endif;
}


/**
 * Deactivation
 */
function deactivate_wp_awld_js()
{
    update_option( 'wp_awld_js_uninstall', 1 );
    uninstall_wp_awld_js();
}

/**
 * Uninstall
 */
function uninstall_wp_awld_js()
{
    global $wp_awld_js;
    wp_awld_js_delete_options();
    delete_option( "wp_awld_js_db_version", $wp_awld_js->version );
    delete_option( 'wp_awld_js_uninstall' );
}

/**
 * Delete options
 */
function wp_awld_js_delete_options()
{
    global $wp_awld_js_settings;
    include_once( 'admin-settings.php' );
    foreach ( $wp_awld_js_settings as $section ) {
        foreach ( $section as $value ) {
            if ( isset( $value['id'] ) ) {
                delete_option( $value['id'] );
            }
        }
    }
}