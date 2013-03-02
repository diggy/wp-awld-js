<?php

/**
 * Usage Page (Admin)
 *
 * @updated: 02 mar 2013
 */
if ( ! function_exists( 'wp_awld_js_settings_usage_page' ) )
{
function wp_awld_js_settings_usage_page()
{
    global $wp_awld_js;
    $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    wp_enqueue_style( 'jquery-ui-custom', $wp_awld_js->plugin_dir_url . 'inc/assets/css/admin/jquery-ui.custom' . $min . '.css', array(), '1.8.16' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-accordion' );
?>
<p><?php _e( 'The <em>Ancient World Linked Data for WordPress</em> plugin allows you to create enhanced links to the stable URIs relevant to the study of the Ancient World, using the awld.js library. For every external link to an Ancient World resource, a small popup will be shown on hover, with a preview of the resource description.', 'wp_awld_js' ); ?></p>
<div id="accordion" style="margin-top:15px;">
    <h3 class="acc" aria-expanded="true"><a href="#"><?php _e( 'Shortcode', 'wp_awld_js' ); ?></a></h3>
    <div>
        <p><?php _e( 'Enhanced links are created with the <code>awld</code> shortcode. The shortcode mimics the markup of a regular HTML link, e.g.:', 'wp_awld_js' ); ?></p>
        <p style="margin-left: 20px;"><code>[awld href="http://nomisma.org/id/athens"]Athens[/awld]</code></p>
        <p><?php echo sprintf( __( 'Visit the <a href="%s">next tab</a> for a list of available resources and more examples.', 'wp_awld_js' ), esc_url( admin_url() . 'options-general.php?page=wp-awld-js-settings&tab=examples' ) ); ?></p>
    </div>
    <h3 class="acc"><a href="#"><?php _e( 'Shortcode Parameters', 'wp_awld_js' ); ?></a></h3>
    <div>
        <p><?php _e( 'Following shortcode parameters can be configured:', 'wp_awld_js' ); ?></p>
        <ul style="margin-left: 20px;">
            <li><code>$href</code> (<em><?php _e( 'required', 'wp_awld_js' ); ?></em>): <?php _e( 'The href attribute (URL), i.e. the actual hyperlink to the external resource.', 'wp_awld_js' ); ?></li>
            <li><code>$type</code> (<em><?php _e( 'optional', 'wp_awld_js' ); ?></em>): <?php _e( 'The type, valid values include: <code>person</code>, <code>place</code>, <code>event</code>, <code>citation</code>, <code>text</code> and <code>object</code>. Defaults to <code>default</code>.', 'wp_awld_js' ); ?></li>
            <li>--------------------------------------------------------------</li>
            <li><code>$title</code> (<em><?php _e( 'optional', 'wp_awld_js' ); ?></em>): <?php _e( 'The title attribute of the hyperlink. Empty by default.', 'wp_awld_js' ); ?></li>
            <li><code>$class</code> (<em><?php _e( 'optional', 'wp_awld_js' ); ?></em>): <?php _e( 'The CSS classes applied to the hyperlink. Defaults to <code>wp-awld-js</code>', 'wp_awld_js' ); ?></li>
            <li><code>$target</code> (<em><?php _e( 'optional', 'wp_awld_js' ); ?></em>): <?php _e( 'The target attribute of the hyperlink. Defaults to <code>_blank</code>.', 'wp_awld_js' ); ?></li>
        </ul>
    </div>
    <h3 class="acc"><a href="#"><?php _e( 'Shortcode Buttons', 'wp_awld_js' ); ?></a></h3>
    <div>
        <p><img src="<?php echo $wp_awld_js->plugin_dir_url; ?>inc/assets/images/wp_awld_js_icon.png" alt="button" title="button" class="alignright" style="width:24px;border:1px solid #ddd;border-radius:5px;background: #f1f1f1;margin-right:11px;"/><?php _e( 'You can easily insert new shortcodes in your post content via the tinyMCE button added to the visual editor.', 'wp_awld_js' ); ?></p>
        <p><?php _e( 'Alternatively, you can insert shortcodes with the quicktags added to the HTML editor.', 'wp_awld_js' ); ?></p>
        <p><?php echo sprintf( __( 'Visit the <a href="%s">settings tab</a> to enable or disable editor buttons functionality.', 'wp_awld_js' ), esc_url( admin_url() . 'options-general.php?page=wp-awld-js-settings&tab=settings' ) ); ?></p>
    </div>
    <h3 class="acc"><a href="#"><?php _e( 'Index Widget', 'wp_awld_js' ); ?></a></h3>
    <div>
        <p><?php _e( 'The optional widget collects all the enhanced links within the scope of awld.js and organizes them by type and source.', 'wp_awld_js' ); ?></p>
        <p><?php _e( 'The index widget will only appear if the page contains one or more <code>awld</code> shortcodes.', 'wp_awld_js' ); ?></p>
    </div>
    <h3 class="acc"><a href="#"><?php _e( 'Widget Implementation', 'wp_awld_js' ); ?></a></h3>
    <div>
        <p><?php _e( 'There are several ways to include the index widget in your website:', 'wp_awld_js' ); ?></p>
        <ul style="margin-left: 20px;">
            <li>- <?php _e( 'Prepend the widget to the post content automatically.', 'wp_awld_js' ); ?></li>
            <li>- <?php _e( 'Append the widget to the post content automatically.', 'wp_awld_js' ); ?></li>
            <li>- <?php _e( 'Display the widget with a shortcode (in posts and pages):', 'wp_awld_js' ); ?> <code>[awld_index]</code></li>
            <li>- <?php _e( 'Display the widget with a shortcode (in your template files):', 'wp_awld_js' ); ?> <code>&lt;?php echo do_shortcode( '[awld_index]' ); ?&gt;</code></li>
            <li>- <?php _e( 'Display the widget with a WordPress widget.', 'wp_awld_js' ); ?></li>
            <li>- <?php _e( 'Display the widget with a template tag:', 'wp_awld_js' ); ?> <code>&lt;?php if( function_exists( 'awld_index' ) ) { echo awld_index(); } ?&gt;</code></li>
        </ul>
        <p><?php echo sprintf( __( 'Visit the <a href="%s">settings tab</a> to choose an implementation method.', 'wp_awld_js' ), esc_url( admin_url() . 'options-general.php?page=wp-awld-js-settings&tab=settings' ) ); ?></p>
    </div>
    <h3 class="acc"><a href="#"><?php _e( 'Custom Styles', 'wp_awld_js' ); ?></a></h3>
    <div>
        <p><?php _e( 'To override the default styles that ship with awld.js:', 'wp_awld_js' ); ?></p>
        <ul style="margin-left: 20px;">
            <li>- <?php echo sprintf( __( 'Make a copy of the <code>awld-sample.css</code> file located <a href="%s">here</a>.', 'wp_awld_js' ), $wp_awld_js->plugin_dir_url . 'inc/assets/css/awld-sample.css' ); ?></li>
            <li>- <?php _e( 'Rename the copy to <code>awld.css</code>.', 'wp_awld_js' ); ?></li>
            <li>- <?php _e( 'Move the <code>awld.css</code> file to the stylesheet directory of your WordPress theme, e.g. <code>http://mysite.com/wp-content/themes/twentyeleven/awld.css</code>.', 'wp_awld_js' ); ?></li>
        </ul>
    </div>
</div>
<script>
jQuery(function() {
	jQuery( "#accordion" ).accordion({ autoHeight: false });
});
</script>
<?php
}
}