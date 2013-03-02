<?php

/**
 * Awld.js index template tag
 **/
function awld_index()
{
    if( get_option( 'wp_awld_js_widget_implement' ) != 'tag' )
        return '';
    return '<div class="awld-index"></div>';
}

/**
 * Awld.js Index Widget Content Filter
 **/
add_filter( 'the_content', 'awld_index_filter', 11, 1 );
function awld_index_filter( $content )
{
    if( is_feed() || is_admin() || defined( 'DOING_AJAX' ) )
        return $content;
    if( is_singular() && get_option( 'wp_awld_js_widget_implement' ) == 'append' )
        return $content . '<div class="awld-index"></div>';
    if( is_singular() && get_option( 'wp_awld_js_widget_implement' ) == 'prepend' )
        return '<div class="awld-index"></div>' . $content;
    return $content;
}

/**
 * Conditional tag
 *
 * Checks if a post contains an awld shortcode
 *
 * @param: $shortcode (string) 
 */
if ( ! function_exists( 'has_awld_shortcode' ) )
{
    function has_awld_shortcode( $shortcode = '' )
    {
        global $post;
        
        $obj = get_post( $post->ID );
        $found = false;
        
        if ( ! $shortcode )
            return $found;
        
        if ( stripos( $obj->post_content, '[' . $shortcode ) !== false )
            $found = true;
        
        return $found;
    }
}

/**
 * Sanitize variables
 **/
function wp_awld_js_clean( $var )
{
    return trim( strip_tags( stripslashes( $var ) ) );
}