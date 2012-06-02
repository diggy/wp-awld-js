<?php
/**
 * Widgets init
 * 
 * Initialize widget(s).
 *
 * @package		Awld.js for WordPress
 * @category	Widgets
 * @author		Peter J. Herrel
 */
include_once('widget-awld-index.php');

function wp_awld_js_register_widgets()
{
	register_widget( 'Wp_Awld_Js_Widget_Awld_Index' );
}
add_action( 'widgets_init', 'wp_awld_js_register_widgets' );