<?php
/**
 * Awld.js Auto-generated Index Widget
 * 
 * @package     Awld.js for WordPress
 * @category    Widgets
 * @author      Peter J. Herrel
 */

class Wp_Awld_Js_Widget_Awld_Index extends WP_Widget
{
    /** Variables to setup the widget. */
    var $awld_widget_cssclass;
    var $awld_widget_description;
    var $awld_widget_idbase;
    var $awld_widget_name;

    /** constructor */
    function Wp_Awld_Js_Widget_Awld_Index()
    {
        /* Widget variable settings. */
        $this->awld_widget_cssclass     = 'widget_awld';
        $this->awld_widget_description  = __( 'The awld.js auto-generated widget collects all the awld.js links in your post content and organizes them by type and source. The widget will only appear if the page contains one or more awld.js shortcodes. Visit the settings tab for configuration options.', 'wp_awld_js' );
        $this->awld_widget_idbase       = 'wp_awld_js_widget_index';
        $this->awld_widget_name         = __('Awld.js Index', 'wp_awld_js' );

        /* Widget settings. */
        $widget_ops = array( 'classname' => $this->awld_widget_cssclass, 'description' => $this->awld_widget_description );

        /* Create the widget. */
        parent::__construct( 'wp_awld_js_index', $this->awld_widget_name, $widget_ops );
    }
    /** @see WP_Widget */
    function widget( $args, $instance )
    {
        global $post;

        if( is_singular() && has_shortcode( $post->post_content, 'awld' ) )
        {
            extract( $args );

            $title = $instance['title'];
            $title = apply_filters('widget_title', $title, $instance, $this->id_base);

            echo $before_widget;

            if ($title) echo $before_title . $title . $after_title;

            echo '<div class="awld-index"></div>';

            echo $after_widget;
        }
    }
    /** @see WP_Widget->update */
    function update( $new_instance, $old_instance )
    {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        return $instance;
    }
    /** @see WP_Widget->form */
    function form( $instance )
    {
        global $wpdb;
        ?>
            <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wp_awld_js' ) ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
        <?php
    }
} // Wp_Awld_Js_Widget_Awld_Index

/* end of file widget-awld-index.php */
