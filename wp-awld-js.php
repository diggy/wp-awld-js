<?php

/***************************************************************************************************

Plugin Name: Ancient World Linked Data for WordPress
Plugin URI: http://peterherrel.com/wordpress/plugins/wp-awld-js/
Description: Awld.js is a javascript library for Ancient World Linked Data. This WordPress plugin uses the Awld.js library to add functionality and visual elements to your WordPress powered website, based on links to stable URIs relevant to the study of the Ancient World.
Version: 0.2.1
Author: Peter J. Herrel
Author URI: http://peterherrel.com/
License: GPL3
Text Domain: wp_awld_js
Domain Path: /inc/lang

****************************************************************************************************

Copyright (c) 2012-2014 Peter J. Herrel <peterherrel - gmail>

Ancient World Linked Data for WordPress is free software; you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by the Free
Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License along
with this program. If not, see <http://www.gnu.org/licenses/>.

****************************************************************************************************

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

***************************************************************************************************/

// Security, exit if accessed directly
if( ! defined( 'ABSPATH' ) )
    exit;

if( ! class_exists( 'Wp_Awld_Js' ) )
{
/**
 * Main Wp_Awld_Js Class
 *
 * Contains the main functions for Wp_Awld_Js
 *
 * @since Wp_Awld_Js 0.1.1
 */
class Wp_Awld_Js
{
    // vars
    public $version         = '0.2.1';
    public $version_wp      = '3.9';
    public $plugin_dir_url  = '';

    /**
     * Constructor
     *
     * @return  void
     */
    public function __construct()
    {
        // constants
        define( 'WP_AWLD_JS_VERSION',       $this->version );
        define( 'WP_AWLD_JS_VERSION_WP',    $this->version_wp );

        // plugin url
        $this->plugin_dir_url = trailingslashit( plugins_url( dirname( plugin_basename( __FILE__ ) ) ) );

        // i18n
        add_action( 'init', array( $this, 'load_plugin_textdomain' ), 0 );

        // installation and upgrading
        if( is_admin() && ! defined( 'DOING_AJAX' ) ) :

            // activation
            register_activation_hook( __FILE__, array( $this , 'register_activation_hook' ) );

            // deactivation
            register_deactivation_hook( __FILE__, array( $this, 'register_deactivation_hook' ) );

            // check compatibility
            add_action( 'admin_init', array( $this, 'check_compat' ), 9 );

            if( '1' == get_option( 'wp_awld_js_install' ) && false !== self::is_compatible() )
                add_action( 'admin_init', array( $this, 'redirect_after_activation' ), 10 );

        endif;

        // includes
        $this->includes();

        // init
        add_action( 'init', array( $this, 'init' ), 0 );

        // action hook
        do_action( 'wp_awld_js_loaded' );
    }
    /**
     * Localisation
     *
     * @return  void
     */
    public function load_plugin_textdomain()
    {
        load_plugin_textdomain( 'wp_awld_js', false, $this->plugin_dir_url . 'inc/lang/' );
    }
    /**
     * Includes
     *
     * @return  void
     */
    public function includes()
    {
        if( is_admin() )                                $this->admin_includes();
        if( ! is_admin() || defined( 'DOING_AJAX' ) )   $this->frontend_includes();

        // core functions
        include_once( 'inc/core/functions.php' );

        // widget(s)
        if( 'widget' == get_option( 'wp_awld_js_widget_implement' ) )
            include_once( 'inc/widgets/widget-init.php' );
    }
    /**
     * Admin includes
     *
     * @return  void
     */
    public function admin_includes()
    {
        // plugin meta
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ),   array( $this, 'plugin_action_links' ), 10, 1 );
        add_filter( 'plugin_row_meta',                                      array( $this, 'plugin_row_meta' ), 10, 2 );

        // admin includes
        include_once( 'inc/admin/admin-init.php' );
    }
    /**
     * Front end includes
     *
     * @return  void
     */
    public function frontend_includes()
    {
        // shortcodes
        add_shortcode( 'awld',          array( $this, 'shortcode' ), 10, 2 );
        add_shortcode( 'awld_index',    array( $this, 'shortcode_ndx' ), 11, 2 );

        // filters
        // add_filter( 'the_excerpt', 'shortcode_unautop');
        add_filter( 'the_excerpt', 'do_shortcode');
    }
    /**
     * Init
     *
     * @return  void
     */
    public function init()
    {
        // Front end
        if( ! is_admin() || defined( 'DOING_AJAX' ) )
        {
            add_filter( 'body_class', array( $this, 'body_class' ), 10, 1 );
            add_filter( 'post_class', array( $this, 'post_class' ), 10, 1 );
        }

        // Actions
        add_action( 'init', array( $this, 'register_scripts' ) );

        // Init action hook
        do_action( 'wp_awld_js_init' );
    }
    /**
     * Register scripts
     *
     * @return  void
     */
    public function register_scripts()
    {
        wp_register_script( 'awld-require',     $this->plugin_dir_url . 'inc/assets/js/awld/lib/requirejs/require.js',  array(), $this->version, true );
        wp_register_script( 'awld-registry',    $this->plugin_dir_url . 'inc/assets/js/awld/registry.js',               array(), $this->version, true );
        wp_register_script( 'awld-types',       $this->plugin_dir_url . 'inc/assets/js/awld/types.js',                  array(), $this->version, true );
        //wp_register_script( 'awld-ui',        $this->plugin_dir_url . 'inc/assets/js/awld/ui.js',                     array(), $this->version, true );
        wp_register_script( 'awld-ui',          $this->plugin_dir_url . 'inc/assets/js/custom/ui.wp.js',                array(), $this->version, true );
        wp_register_script( 'awld',             $this->plugin_dir_url . 'inc/assets/js/awld/awld.js',                   array( 'jquery', 'awld-require', 'awld-registry', 'awld-types', 'awld-ui' ), $this->version, true );
    }
    /**
     * Enqueue scripts
     *
     * @return  void
     */
    public function enqueue()
    {
        $file   = get_stylesheet_directory() . '/awld.css';
        $url    = ( file_exists( $file ) ) ? get_stylesheet_directory_uri() . '/awld.css' : $this->plugin_dir_url . 'inc/assets/js/awld/ui/core.css';

        wp_enqueue_script( 'awld' );

        wp_localize_script( 'awld', 'wp_awld_js', array(
            'WpStyleSheetUrl' => $url
        ) );

        // autoinit
        add_filter( 'script_loader_src', array( $this, 'script_loader_src' ), 10, 1 );
    }
    /**
     * awld.js autoinit
     *
     * @param   string  $src
     * @return  string
     */
    public function script_loader_src( $src )
    {
        if( false === strpos( $src, 'awld.js' ) )
            return $src;

        return $src . '&autoinit';
    }
    /**
     * Link shortcode callback
     *
     * @param   array   $atts
     * @param   string  $content
     * @return  string
     */
    public function shortcode( $atts, $content = null )
    {
        if( empty( $content ) )
            return;

        if( is_singular() && ! is_feed() )
            $this->enqueue();

        extract( shortcode_atts( array(
            'href'      => '',
            'type'      => 'default',
            'title'     => '',
            'class'     => 'wp-awld-js',
            'target'    => '_blank',
            'nofollow'  => ''
        ), $atts ) );

        $rel = ( esc_attr( $nofollow ) == '1' ) ? ' rel="nofollow"' : '';

        return '<a href="' . esc_attr( $href ) . '" class="' . esc_attr( $class ) . ' awld-type-' . esc_attr( $type ) . '" title="' . esc_attr( $title ) . '" target="' . esc_attr( $target ) . '"' . $rel . '>' . esc_attr( $content ) . '</a>';
    }
    /**
     * Index shortcode callback
     *
     * @param   array   $atts
     * @param   string  $content
     * @return  string
     */
    public function shortcode_ndx( $atts, $content = null )
    {
        if( 'shortcode' != get_option( 'wp_awld_js_widget_implement' ) )
            return;

        return '<div class="awld-index"></div>';
    }
    /**
     * Body Class
     *
     * @param   array   $classes
     * @return  array
     */
    public function body_class( $classes )
    {
        $classes[] = ( 'body' == get_option( 'wp_awld_js_scope' ) ) ? 'wp-awld-js awld-scope' : 'wp-awld-js';

        return apply_filters( 'awld_body_class', $classes );
    }
    /**
     * Post Class
     *
     * @param   array   $classes
     * @return  array
     */
    public function post_class( $classes )
    {
        $classes[] = ( 'post' == get_option( 'wp_awld_js_scope' ) ) ? 'wp-awld-js awld-scope' : 'wp-awld-js';

        return apply_filters( 'awld_post_class', $classes );
    }
    /**
     * Activation hook
     *
     * @uses    wp_awld_js_default_options()
     * @return  void
     */
    public function register_activation_hook()
    {
        if( false === self::is_compatible() )
        {
            require_once( trailingslashit( ABSPATH ) . 'wp-admin/includes/plugin.php' );

            deactivate_plugins( plugin_basename( __FILE__ ) );

            wp_die(
                 sprintf( __( 'The Ancient World Linked Data plugin requires WordPress %s or higher.', 'wp_awld_js' ), $this->version_wp )
                ,__( 'Ancient World Linked Data plugin activation error.', 'wp_awld_js' )
                ,array( 'back_link' => true )
            );
        }
        else
        {
            $this->includes();

            update_option( 'wp_awld_js_install', 1 );

            wp_awld_js_default_options();

            update_option( 'wp_awld_js_db_version', $this->version );
        }
    }
    public function redirect_after_activation()
    {
        delete_option( 'wp_awld_js_install' );

        wp_safe_redirect( admin_url( 'options-general.php?page=wp-awld-js-settings&tab=about&activated=1' ) );

        exit;
    }
    /**
     * Deactivation
     *
     * @uses    wp_awld_js_delete_options()
     * @return  void
     */
    public function register_deactivation_hook()
    {
        $this->includes();

        update_option( 'wp_awld_js_uninstall', 1 );

        wp_awld_js_delete_options();

        delete_option( 'wp_awld_js_db_version', $this->version );
        delete_option( 'wp_awld_js_uninstall' );
    }
    /**
     * Compatibility check
     *
     * @uses    wp_awld_js_default_options()
     * @return  void
     */
    public function check_compat()
    {
        // if incompatible
        if( false === self::is_compatible() )
        {
            require_once( trailingslashit( ABSPATH ) . 'wp-admin/includes/plugin.php' );

            if( ! is_plugin_active( plugin_basename( __FILE__ ) ) )
                return;

            deactivate_plugins( plugin_basename( __FILE__ ) );

            add_action( 'admin_notices', array( $this, 'admin_notices' ) );

            if( isset( $_GET['activate'] ) )
                unset( $_GET['activate'] );
        }
        // if upgrade
        elseif( $this->version != get_option( 'wp_awld_js_db_version' ) )
        {
            $this->includes();

            wp_awld_js_default_options();

            update_option( 'wp_awld_js_db_version', $this->version );
        }
    }
    /**
     * Version compare
     *
     * @return  bool
     */
    public static function is_compatible()
    {
        if( version_compare( $GLOBALS['wp_version'], constant( 'WP_AWLD_JS_VERSION_WP' ), '<' ) )
            return false;

        return true;
    }
    /**
     * Admin notice
     *
     * @return  void
     */
    public function admin_notices()
    {
        printf( '<div class="error" id="message"><p><strong>%s</strong></p></div>', sprintf( __( 'The Ancient World Linked Data plugin requires WordPress %s or higher. The plugin had been deactivated.', 'wp_awld_js' ), $this->version_wp ) );
    }
    /**
     * Admin plugin settings link
     *
     * @param   array   $links
     * @return  array
     */
    public function plugin_action_links( $links )
    {
        $settings_link = '<a href="admin.php?page=wp-awld-js-settings">' . __( 'Settings', 'wp_awld_js' ) . '</a>';

        array_unshift( $links, $settings_link );

        return $links;
    }
    /**
     * Admin plugin row meta
     *
     * @param   array   $links
     * @param   string  $file
     * @return  array
     */
    public function plugin_row_meta( $links, $file )
    {
        if( $file == plugin_basename( __FILE__ ) )
            return array_merge( $links, array(
                 sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( 'https://wordpress.org/support/plugin/ancient-world-linked-data-for-wordpress' ), __( 'Support', 'wp_awld_js' ) )
                ,sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( 'https://github.com/diggy/wp-awld-js' ), __( 'Repository', 'wp_awld_js' ) )
            ) );

        return $links;
    }
}

/*
 * Init main class
 */
$GLOBALS['wp_awld_js'] = new Wp_Awld_Js();

} // class_exists check

/* end of file wp-awld-js.php */
