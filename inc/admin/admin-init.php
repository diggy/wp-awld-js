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
 *
 * @return  void
 */
add_action( 'admin_menu', 'wp_awld_js_admin_menu' );
function wp_awld_js_admin_menu()
{
    add_options_page(
         __( 'AWLD Linked Data', 'wp_awld_js' )
        ,__( 'AWLD Linked Data', 'wp_awld_js' )
        ,'manage_options'
        ,'wp-awld-js-settings'
        ,'wp_awld_js_settings_page'
    );
}

/**
 * Includes
 *
 * @return  void
 */
function wp_awld_js_settings_page()
{
    include_once( 'admin-forms.php' );
    include_once( 'admin-settings.php' );

    wp_awld_js_settings();
}

/**
 * Admin init
 *
 * @return  void
 */
add_action( 'init', 'wp_awld_js_add_mce_button' );
function wp_awld_js_add_mce_button()
{
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
        return;

    if ( ! ( get_user_option( 'rich_editing' ) == 'true' && get_option( 'wp_awld_js_button' ) == 'yes' ) )
        return;

    add_action( 'admin_head',           'wp_awld_js_admin_head' );

    add_filter( 'mce_external_plugins', 'wp_awld_js_mce_external_plugins' );
    add_filter( 'mce_buttons',          'wp_awld_js_mce_buttons' );
}

/**
 * Admin CSS
 *
 * @return  void
 */
function wp_awld_js_admin_head()
{
    echo '<style type="text/css">i.mce-i-wp-awld-js-mce-button{background-image: url("' . $GLOBALS['wp_awld_js']->plugin_dir_url . 'inc/assets/images/wp_awld_js_icon.png");}</style>' . "\n";
}

/**
 * TinyMCE External Plugins
 *
 * @param   array   $plugin_array   array of external plugins
 * @return  array                   modified array of external plugins
 */
function wp_awld_js_mce_external_plugins( $plugin_array )
{
    $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    $plugin_array['wp_awld_js_mce_button'] = $GLOBALS['wp_awld_js']->plugin_dir_url . 'inc/assets/js/wp/awld_editor_plugin' . $min . '.js';

    return $plugin_array;
}

/**
 * TinyMCE Buttons
 *
 * @param   array   $buttons    array of buttons
 * @return  array               modified array of buttons
 */
function wp_awld_js_mce_buttons( $buttons )
{
    array_push( $buttons, "wp_awld_js_mce_button" );

    return $buttons;
}

/**
 * HTML editor Quicktags
 *
 * Add custom Quicktag buttons to the editor Wordpress ver. 3.3 and above only
 *
 * Params for this are:
 *
 * - Button HTML ID (required)
 * - Button display, value="" attribute (required)
 * - Opening Tag (required)
 * - Closing Tag (required)
 * - Access key, accesskey="" attribute for the button (optional)
 * - Title, title="" attribute (optional)
 * - Priority/position on bar, 1-9 = first, 11-19 = second, 21-29 = third, etc. (optional)
 *
 * @return  void
 */
add_action( 'admin_print_footer_scripts',  '_wp_awld_js_add_quicktags' );
function _wp_awld_js_add_quicktags()
{
    if( get_option( 'wp_awld_js_quicktags' ) != 'yes' || ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
        return;

    global $pagenow;

    if( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) :
?>
<script type="text/javascript">
QTags.addButton( 'awld', 'AWLD', '[awld href=""]', '[/awld]', '', 'default', '991' );
QTags.addButton( 'awld_object', 'awld object', '[awld href="" type="object"]', '[/awld]', '', 'object', '992' );
QTags.addButton( 'awld_person', 'awld person', '[awld href="" type="person"]', '[/awld]', '', 'person', '993' );
QTags.addButton( 'awld_index', 'awld index', '[awld_index]', ' ', '', 'widget', '994' );
</script>
<?php
    endif;
}

/**
 * Update options
 */
function wp_awld_js_default_options()
{
    global $wp_awld_js_settings;

    include_once( 'admin-settings.php' );

    foreach ( $wp_awld_js_settings as $section )
    {
        foreach ( $section as $value )
        {
            if ( isset( $value['std'] ) && isset( $value['id'] ) )
                add_option($value['id'], $value['std']);   
        }
    }
}

/**
 * Delete options
 */
function wp_awld_js_delete_options()
{
    global $wp_awld_js_settings;

    include_once( 'admin-settings.php' );

    foreach ( $wp_awld_js_settings as $section )
    {
        foreach ( $section as $value )
        {
            if ( isset( $value['id'] ) )
                delete_option( $value['id'] );
        }
    }
}

/* end of file admin-init.php */
