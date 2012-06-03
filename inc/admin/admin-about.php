<?php

/**
 * About admin page
 */

/**
 * About Page
 *
 * @updated: 31 may 2012
 */
if ( ! function_exists( 'wp_awld_js_settings_about_page' ) )
{
function wp_awld_js_settings_about_page()
{
	global $wp_awld_js;
	$v = $wp_awld_js->version;
	?>
	<div id="welcome-panel" class="welcome-panel wp-awld-js-welcome-panel" style="border-top:0;">
	<div class="wp-badge"><?php printf( __( 'Plugin v. %s', 'wp_awld_js' ), $v ); ?></div>

	<div class="welcome-panel-content">
	<h3><?php _e( 'Ancient World Linked Data for WordPress', 'wp_awld_js' ); ?></h3>
	<p class="about-description"><?php _e( 'Awld.js is a javascript library for Ancient World Linked Data. It adds functionality and visual elements to your WordPress powered website based on links to stable URIs relevant to the study of the Ancient World.', 'wp_awld_js' ); ?></p>
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
		<h4><span class="icon16 icon-"></span> <?php _e( 'About awld.js' ); ?></h4>
		<p><?php echo sprintf( __( 'Awld.js is a project of the <a href="%s" target="_blank">Institute for the Study of the Ancient World</a>.', 'wp_awld_js' ), esc_url( 'http://www.nyu.edu/isaw/' ) ); ?></p>
		<p><?php _e( 'The project is overseen by <strong>Sebastian Heath</strong> (sebastian.heath [at] nyu.edu).', 'wp_awld_js' ); ?></p>
		<p><?php _e( 'The initial implementation of the library was written by <strong>Nick Rabinowitz</strong>.', 'wp_awld_js' ); ?></p>
		<h4><span class="icon16 icon-"></span> <?php _e( 'Links and resources' ); ?></h4>
		<ul>
		<li><?php echo sprintf(	__( 'Awld.js <a href="%s" target="_blank">home page</a>', 'wp_awld_js' ), esc_url( 'http://isawnyu.github.com/awld-js/' ) ); ?></li>
		<li><?php echo sprintf(	__( 'Awld.js code repository on <a href="%s" target="_blank">Github</a>', 'wp_awld_js' ), esc_url( 'http://github.com/isawnyu/awld-js' ) ); ?></li>		
		</ul>
	</div>
	<div class="welcome-panel-column">
		<h4><span class="icon16 icon-"></span> <?php _e( 'Terms of Use', 'wp_awld_js' ); ?></h4>
		<p><?php _e( 'Neither the name of the New York University nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.', 'wp_awld_js' ); ?></p>
		<h4><span class="icon16 icon-"></span> <?php _e( 'Copyright', 'wp_awld_js' ); ?></h4>
		<p><?php _e( 'Awld.js is copyright &copy; 2012, Institute for the Study of the Ancient World, New York University. All rights reserved.', 'wp_awld_js' ); ?></p>
		<p><?php _e( 'WordPress plugin is copyright &copy; 2012, Peter J. Herrel.', 'wp_awld_js' ); ?></p>
		<h4><span class="icon16 icon-"></span> <?php _e( 'License', 'wp_awld_js' ); ?></h4>
		<p><?php echo sprintf(	__( 'Awld.js is licensed under the BSD License; see <a href="%s" target="_blank">LICENSE.txt</a> for more infomation.', 'wp_awld_js' ), esc_url( $wp_awld_js->plugin_dir_url . 'inc/assets/js/awld/license/LICENSE.txt' ) ); ?></p>
		<p><?php _e( 'WordPress plugin license: GPLv3.', 'wp_awld_js' ); ?></p>
	</div>
	<div class="welcome-panel-column welcome-panel-last">
		<h4><span class="icon16 icon-"></span> <?php _e( 'About this plugin', 'wp_awld_js' ); ?></h4>
		<p><?php _e( 'The <em>Ancient World Linked Data for WordPress</em> plugin was developed by <strong>Peter J. Herrel</strong>.', 'wp_awld_js' ); ?></p>
		<p><?php _e( 'The author has no affiliations with the Institute for the Study of the Ancient World.', 'wp_awld_js' ); ?></p>
		<p><?php echo sprintf( __( 'If you like this plugin, <a href="%1s">rate it</a> on WordPress.org or buy the author a <a href="%2s" target="_blank">cup of coffee</a>.', 'wp_awld_js' ), esc_url( 'http://wordpress.org/extend/plugins/ancient-world-linked-data-for-wordpress/' ), esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WAY79HJWYKPQE' ) ); ?></p>
		<ul>
		<li><?php echo sprintf(	__( 'Plugin <a href="%s" target="_blank">home page</a>', 'wp_awld_js' ), esc_url( 'http://peterherrel.com/wordpress/plugins/wp-awld-js/' ) ); ?></li>
		<li><?php echo sprintf(	__( 'Plugin <a href="%s" target="_blank">support forums</a>', 'wp_awld_js' ), esc_url( 'http://wordpress.org/support/plugin/ancient-world-linked-data-for-wordpress' ) ); ?></li>
		<li><?php echo sprintf(	__( 'Plugin on <a href="%s" target="_blank">WordPress.org</a>', 'wp_awld_js' ), esc_url( 'http://wordpress.org/extend/plugins/ancient-world-linked-data-for-wordpress/' ) ); ?></li>
		<li><?php echo sprintf(	__( 'Plugin code repository on <a href="%s" target="_blank">Github</a>', 'wp_awld_js' ), esc_url( 'https://github.com/diggy/wp-awld-js' ) ); ?></li>
		</ul>
	</div>
	</div>
	</div>
	</div>
	<p style="text-align:center;color:#888;"><?php _e( 'Disclaimer: the Awld.js project is in the proof-of-concept, pre-alpha, use-at-your-own-risk stage.', 'wp_awld_js' ); ?><br /><?php echo sprintf( __( 'If you encounter an issue with awld.js, please raise a ticket on <a href="%s" target="_blank">Github</a>.', 'wp_awld_js' ), esc_url( 'https://github.com/nrabinowitz/awld-js/issues' ) ); ?></p>
	<?php
}
}