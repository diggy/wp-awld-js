<?php
/**
 * Functions for the admin options page.
 * 
 * The options page contains settings for the AWLD JS plugin
 * This file contains functions to display and save the list of options.
 *
 * @author 		Peter J. Herrel
 * @category 	Admin
 * @package 	AWLD JS
 */

/**
 * Define options
 */
global $wp_awld_js_settings;

$wp_awld_js_settings['settings'] = apply_filters('wp_awld_js_general_settings', array(
	array( 'name' => __( 'User Agreement', 'wp_awld_js' ), 'type' => 'title', 'desc' => '', 'id' => 'settings-terms' ),
	array(  
		'name' => __( 'Terms of use', 'wp_awld_js' ),
		'desc' 		=> __( 'I agree to the terms of use.', 'wp_awld_js' ),
		'id' 		=> 'wp_awld_js_i_accept',
		'css' 		=> 'min-width:300px;',
		'std' 		=> 'yes',
		'type' 		=> 'checkbox'
	),	
	array( 'type' => 'sectionend', 'id' => 'settings-terms'),
	array( 'name' => __( 'General Settings', 'wp_awld_js' ), 'type' => 'title', 'desc' => '', 'id' => 'settings-general' ),
	array(  
		'name' => __( 'Scope', 'wp_awld_js' ),
		'desc' 		=> __( 'Restricts the work of the library to a part of the document.', 'wp_awld_js' ),
		'id' 		=> 'wp_awld_js_scope',
		'css' 		=> 'min-width:160px;',
		'std' 		=> 'post',
		'type' 		=> 'select',
		'options' => array( 
			'post'		=> __( 'Post', 'wp_awld_js' ),
			'body'		=> __( 'Body', 'wp_awld_js' ),
			'manual'	=> __( 'Manual', 'wp_awld_js' ),
		)
	),
	array( 'type' => 'sectionend', 'id' => 'settings-general'),
	array( 'name' => __( 'Widget Settings', 'wp_awld_js' ), 'type' => 'title', 'desc' => '', 'id' => 'settings-widget' ),
	array(  
		'name' => __( 'Implementation', 'wp_awld_js' ),
		'desc' 		=> __( 'Please choose how would you like to implement the widget.', 'wp_awld_js' ),
		'id' 		=> 'wp_awld_js_widget_implement',
		'css' 		=> 'min-width:160px;',
		'std' 		=> 'none',
		'type' 		=> 'select',
		'options' => array( 
			'none'  		=> __( 'No Widget', 'wp_awld_js' ),
			'prepend'		=> __( 'Prepend to post content', 'wp_awld_js' ),
			'append'		=> __( 'Append to post content', 'wp_awld_js' ),
			'widget'		=> __( 'WordPress widget', 'wp_awld_js' ),
			'shortcode'		=> __( 'Shortcode', 'wp_awld_js' ),
			'tag'			=> __( 'Template tag', 'wp_awld_js' )
		)
	),
	array( 'type' => 'sectionend', 'id' => 'settings-widget'),
	array( 'name' => __( 'Editor Settings', 'wp_awld_js' ), 'type' => 'title', 'desc' => '', 'id' => 'settings-editor' ),
	array(  
		'name' => __( 'Buttons', 'wp_awld_js' ),
		'desc' 		=> __( 'Enable tinyMCE button in the visual editor.', 'wp_awld_js' ),
		'id' 		=> 'wp_awld_js_button',
		'css' 		=> 'min-width:300px;',
		'std' 		=> 'yes',
		'type' 		=> 'checkbox',
		'checkboxgroup'	=> 'start'
	),	
	array(  
		'name' => __( 'Buttons', 'wp_awld_js' ),
		'desc' 		=> __( 'Enable quicktags in the HTML editor.', 'wp_awld_js' ),
		'id' 		=> 'wp_awld_js_quicktags',
		'css' 		=> 'min-width:300px;',
		'std' 		=> 'no',
		'type' 		=> 'checkbox',
		'checkboxgroup'	=> 'end'
	),	
	array( 'type' => 'sectionend', 'id' => 'settings-editor'),
)); // End of settings array

/**
 * Options page
 * 
 * Handles the display of the options page.
 */
if ( ! function_exists( 'wp_awld_js_settings' ) )
{
function wp_awld_js_settings()
{
    global $wp_awld_js, $wp_awld_js_settings;

    $current_tab = ( empty( $_GET['tab'] ) ) ? 'about' : urldecode( $_GET['tab'] );

    if ( ! empty( $_POST ) )
    {    
    	if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'wp-awld-js-settings' ) ) 
    		die( __( 'Something went wrong. Please refresh the page and retry.', 'wp_awld_js' ) );    	
 	
 		switch ( $current_tab ) {
			case "about" :
			case "usage" :
			case "examples" :
			
			break;
			case "settings" :
				wp_awld_js_update_options( $wp_awld_js_settings[$current_tab] );
			break;
		}

		do_action( 'wp_awld_js_update_options' );
		do_action( 'wp_awld_js_update_options_' . $current_tab );				

		$redirect = add_query_arg( 'saved', 'true' );		
		//wp_safe_redirect( $redirect );
		echo "<meta http-equiv='refresh' content='0;url=$redirect' />";
		exit;
	}	
	if ( ! empty( $_GET['saved'] ) ) {		
		echo '<div id="message" class="updated fade"><p><strong>' . __( 'Your settings have been saved.', 'wp_awld_js' ) . '</strong></p></div>';
        do_action('wp_awld_js_settings_saved');
    }
	if ( isset( $_GET['activated'] ) && $_GET['activated'] === '1' ) {		
		global $current_user;
		echo '<div id="message" class="updated fade"><p><strong>' . sprintf( __( 'Hello, %s. <em>Ancient World Linked Data for WordPress</em> has been successfully installed!', 'wp_awld_js' ), $current_user->display_name ) . '</strong></p></div>';
    }
    ?>
	<div class="wrap wp_awld_js">
		<form method="post" id="mainform" action="">
			<div class="icon32 icon-plugins icon32-wp-awld-js-settings" id="icon-wp-awld-js"><br /></div><h2 class="nav-tab-wrapper wp-awld-js-nav-tab-wrapper">
				<?php
					$tabs = array(
						'about' 	=> __( 'About', 'wp_awld_js' ),
						'usage' 	=> __( 'Usage', 'wp_awld_js' ),
						'examples' 	=> __( 'Examples', 'wp_awld_js' ),
						'settings' 	=> __( 'Settings', 'wp_awld_js' )
					);					
					$tabs = apply_filters('wp_awld_js_settings_tabs_array', $tabs);					
					foreach ( $tabs as $name => $label ) {
						echo '<a href="' . admin_url( 'admin.php?page=wp-awld-js-settings&tab=' . $name ) . '" class="nav-tab ';
						if( $current_tab == $name ) echo 'nav-tab-active';
						echo '">' . $label . '</a>';
					}					
					do_action( 'wp_awld_js_settings_tabs' ); 
				?>
			</h2>
			<?php wp_nonce_field( 'wp-awld-js-settings', '_wpnonce', true, true ); ?>
			<?php
				switch ( $current_tab ) :
					case "about" :
						include( 'admin-about.php' );
						wp_awld_js_settings_about_page();
					break;
					case "usage" :
						include( 'admin-usage.php' );
						wp_awld_js_settings_usage_page();
					break;
					case "examples" :
						include( 'admin-examples.php' );
						wp_awld_js_settings_examples_page();
					break;
					case "settings" :
						wp_enqueue_script( 'farbtastic' );
						wp_awld_js_admin_fields( $wp_awld_js_settings[$current_tab] );
					break;
					default :
						do_action( 'wp_awld_js_settings_tabs_' . $current_tab );
					break;
				endswitch;
				if( isset( $current_tab ) && $current_tab == 'settings' )
				{ ?><p class="submit">
	        		<input name="save" class="button-primary" type="submit" value="<?php _e( 'Save changes', 'wp_awld_js' ); ?>" />       		
	        	</p><?php 
	        } ?>
		</form>
	</div>
	<script type="text/javascript">
	<?php if( isset( $current_tab ) && $current_tab == 'settings' ) : ?>
	jQuery(window).load(function(){
		// Edit prompt
		jQuery(function(){
			var changed = false;
			jQuery('input, select, checkbox').change(function(){
				changed = true;
			});					
			jQuery('.wp-awld-js-nav-tab-wrapper a').click(function(){
				if (changed) {
					window.onbeforeunload = function() {
					    return '<?php echo __( 'The changes you made will be lost if you navigate away from this page.', 'wp_awld_js' ); ?>';
					}
				} else {
					window.onbeforeunload = '';
				}
			});					
			jQuery('.submit input').click(function(){
				window.onbeforeunload = '';
			});
		});
	});
	<?php endif; ?>
	jQuery(document).ready(function() {
		jQuery('.fade').fadeTo(2500,1).fadeOut(1500);
	});
	</script><?php
}
}