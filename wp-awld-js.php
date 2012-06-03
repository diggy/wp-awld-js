<?php

/**************************************************************************

Plugin Name: Ancient World Linked Data for WordPress
Plugin URI: http://peterherrel.com/wordpress/plugins/awld-js
Description: Awld.js is a javascript library for Ancient World Linked Data. This WordPress plugin uses the Awld.js library to add functionality and visual elements to your WordPress powered website, based on links to stable URIs relevant to the study of the Ancient World.
Version: 0.1.1
Author: Peter J. Herrel
Author URI: http://peterherrel.com/
License: GPL3
Text Domain: wp_awld_js
Domain Path: /inc/lang

**************************************************************************

Copyright (c) 2012 Peter J. Herrel <peterherrel - gmail>

Ancient World Linked Data for WordPress is free software; you can redistribute it and/or modify 
it under the terms of the GNU Lesser General Public License as published by the Free
Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License along
with this program. If not, see <http://www.gnu.org/licenses/>.

**************************************************************************

Copyright (c) 2012, Institute for the Study of the Ancient World, New York University

All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted
provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this list of conditions
and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of
conditions and the following disclaimer in the documentation and/or other materials provided
with the distribution.
* Neither the name of the New York University nor the names of its contributors may be used to
endorse or promote products derived from this software without specific prior written permission.
    
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR 
IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND 
FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR 
CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY 
OF SUCH DAMAGE.

**************************************************************************/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wp_Awld_Js' ) ) {

/**
 * Main Wp_Awld_Js Class
 *
 * Contains the main functions for Wp_Awld_Js
 *
 * @since Wp_Awld_Js 0.1.1
 */
class Wp_Awld_Js
{	
	var $version = '0.1.1';	
	var $plugin_dir_url = '';

	/**
	 * Constructor
	 */
	function __construct()
	{
		define( 'WP_AWLD_JS_VERSION', $this->version );
		
		$this->plugin_dir_url = trailingslashit( plugins_url( dirname( plugin_basename( __FILE__ ) ) ) );
		
		$this->includes();

		// Installation
		if ( is_admin() && ! defined('DOING_AJAX') ) :
			$this->install();
			$this->uninstall();
		endif;
		
		add_action( 'init', array( &$this, 'init' ), 0 );
		
		do_action( 'wp_awld_js_loaded' );
	}
	/**
	 * Includes
	 **/
	function includes()
	{
		if ( is_admin() )									$this->admin_includes();
		if ( ! is_admin() || defined( 'DOING_AJAX' ) )		$this->frontend_includes();

		// core functions
		include( 'inc/core/functions.php' );
		
		// widget(s)
		if( get_option( 'wp_awld_js_widget_implement' ) == 'widget' ) include( 'inc/widgets/widget-init.php' );
	}	
	/**
	 * Admin
	 **/
	function admin_includes()
	{
		// admin includes
		include( 'inc/admin/admin-init.php' );
		
		// settings link
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( &$this, 'settings_link' ) );
	}
	/**
	 * Front End
	 **/
	function frontend_includes()
	{		
		// shortcodes
		add_shortcode( 'awld', array( &$this, 'shortcode' ), 10, 2 );
		add_shortcode( 'awld_index', array( &$this, 'shortcode_ndx' ), 11, 1 );
	}	
	/**
	 * Activation
	 **/
	function install()
	{
		register_activation_hook( __FILE__, 'activate_wp_awld_js' );
		if ( get_option( 'wp_awld_js_db_version' ) != $this->version ) 
			add_action( 'init', 'install_wp_awld_js', 1 );
	}
	/**
	 * Deactivation
	 **/
	function uninstall()
	{
		register_deactivation_hook( __FILE__, 'deactivate_wp_awld_js' );
	}
	/**
	 * Init
	 **/
	function init()
	{
		// Localisation
		$this->load_plugin_textdomain();

		// Front end
		if ( ! is_admin() || defined( 'DOING_AJAX' ) ) {
			add_filter( 'body_class', array( &$this, 'body_class' ), 10, 1 );
			add_filter( 'post_class', array( &$this, 'post_class' ), 10, 1 );
		}
		
		// Actions
		add_action( 'init', array( &$this, 'register_scripts' ) );
		
		// Init action hook
		do_action( 'wp_awld_js_init' );
	}
	/**
	 * Localisation
	 **/
	function load_plugin_textdomain()
	{
		load_plugin_textdomain( 'wp_awld_js', false, $this->plugin_dir_url . 'inc/lang/' );
	}
	public function register_scripts()
	{
		wp_register_script( 'awld-require', 	$this->plugin_dir_url . 'inc/assets/js/awld/lib/requirejs/require.js', array( 'jquery' ), $this->version, true );
		wp_register_script( 'awld', 			$this->plugin_dir_url . 'inc/assets/js/awld/awld.js', array( 'awld-require' ), $this->version, true );
		wp_register_script( 'awld-registry', 	$this->plugin_dir_url . 'inc/assets/js/awld/registry.js', array(), $this->version, true );
		//wp_register_script( 'awld-ui', 		$this->plugin_dir_url . 'inc/assets/js/awld/ui.js', array(), $this->version, true );
		wp_register_script( 'awld-ui', 			$this->plugin_dir_url . 'inc/assets/js/custom/ui.wp.js', array(), $this->version, true );
		wp_register_script( 'awld-types', 		$this->plugin_dir_url . 'inc/assets/js/awld/types.js', array(), $this->version, true );
		wp_register_script( 'awld-init', 		$this->plugin_dir_url . 'inc/assets/js/wp/awld-init.js', array(), $this->version, true );
	}
	function enqueue()
	{
		$file = get_stylesheet_directory() . '/awld.css';
		$url = ( file_exists( $file ) ) ? get_stylesheet_directory_uri() . '/awld.css' : $this->plugin_dir_url . 'inc/assets/js/awld/ui/core.css';
		
		wp_enqueue_script( 'awld-require' );
		wp_enqueue_script( 'awld' );
		wp_enqueue_script( 'awld-registry' );
		
		wp_enqueue_script( 'awld-ui' );
		
		$wp_awld_js_params = array(
			'WpStyleSheetUrl' => $url
		);			
		wp_localize_script( 'awld-ui', 'wp_awld_js', $wp_awld_js_params );
		
		wp_enqueue_script( 'awld-types' );
		wp_enqueue_script( 'awld-init' );
	}
 	public function shortcode( $atts, $content = null )
 	{
		if( empty( $content ) ) return;
		if( is_singular() && ! is_feed() ) $this->enqueue();
		extract( shortcode_atts( array(
			'href' => '',
			'type' => 'default',
			'title' => '',
			'class' => 'wp-awld-js',
			'target' => '_blank',
			'nofollow' => ''
		), $atts ) );
		$rel = ( esc_attr( $nofollow ) == '1' ) ? ' rel="nofollow"' : ''; 
		return '<a href="' . esc_attr( $href ) . '" class="' . esc_attr( $class ) . ' awld-type-' . esc_attr( $type ) . '" title="' . esc_attr( $title ) . '" target="' . esc_attr( $target ) . '"' . $rel . '>' . esc_attr( $content ) . '</a>';
	}
	function shortcode_ndx( $atts )
	{
		if( get_option( 'wp_awld_js_widget_implement' ) != 'shortcode' ) return;
		$div = $this->shortcode_ndx_func();
		return $div;
	}
	function shortcode_ndx_func()
	{
		$div = "<div class=\"awld-index\"></div>";
		return $div;
	}
	function body_class( $classes )
	{
		$classes[] = ( get_option( 'wp_awld_js_scope' ) == 'body' ) ? 'wp-awld-js awld-scope' : 'wp-awld-js';
        return apply_filters( 'awld_body_class', $classes );
	}
	function post_class( $classes )
	{
        $classes[] = ( get_option( 'wp_awld_js_scope' ) == 'post' ) ? 'wp-awld-js awld-scope' : 'wp-awld-js';
        return apply_filters( 'awld_post_class', $classes );
	}
	function settings_link( $links )
	{ 
		$settings_link = '<a href="admin.php?page=wp-awld-js-settings">Settings</a>';
		array_unshift( $links, $settings_link );
		return $links; 
	}
}

/**
 * Init main class
 */
$GLOBALS['wp_awld_js'] = new Wp_Awld_Js();

} // class_exists check