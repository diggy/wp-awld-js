<?php

/**
 * Awld.js index template tag
 *
 * @return  (empty) string
 */
function awld_index()
{
    if( 'tag' != get_option( 'wp_awld_js_widget_implement' ) )
        return '';

    return '<div class="awld-index"></div>';
}

/**
 * Awld.js Index Widget Content Filter
 *
 * @param   string  $content
 * @return  string
 */
add_filter( 'the_content', 'awld_index_filter', 11, 1 );
function awld_index_filter( $content )
{
    if( is_feed() || is_admin() || defined( 'DOING_AJAX' ) )
        return $content;

    if( is_singular() && 'append' == get_option( 'wp_awld_js_widget_implement' ) )
        return $content . '<div class="awld-index"></div>';

    if( is_singular() && 'prepend' == get_option( 'wp_awld_js_widget_implement' ) )
        return '<div class="awld-index"></div>' . $content;

    return $content;
}

/**
 * Sanitize variables
 *
 * @param   string  $var
 * @return  string  sanitized variable
 */
function wp_awld_js_clean( $var )
{
    return sanitize_text_field( $var );
}

/* end of file functions.php */
