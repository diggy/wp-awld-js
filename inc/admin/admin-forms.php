<?php
/**
 * Functions for outputting and updating the settings page
 * 
 * @author      Peter J. Herrel
 * @category    Admin
 * @package     AWLD JS
 */
 
/**
 * Update options
 * 
 * Updates settings on the options page. 
 *
 * @return: returns true if saved.
 */
function wp_awld_js_update_options( $options )
{
    if ( empty( $_POST ) )
        return false;
    
    foreach ( $options as $value )
    {
        if ( isset( $value['type'] ) && $value['type'] == 'checkbox' ) {
            if ( isset( $value['id'] ) && isset( $_POST[$value['id']] ) ) {
                update_option($value['id'], 'yes');
            } else {
                update_option($value['id'], 'no');
            }
        } else {
            if ( isset( $value['id'] ) && isset( $_POST[$value['id']] ) ) {
                update_option($value['id'], wp_awld_js_clean($_POST[$value['id']]));
            } elseif( isset( $value['id'] ) ) {
                delete_option($value['id']);
            }
        }
    }
    return true;
}

/**
 * Admin fields
 * 
 * Loops though the wp_awld_js options array and outputs each field.
 */
function wp_awld_js_admin_fields( $options )
{
    global $wp_awld_js;
    
    foreach ( $options as $value )
    {
        if ( ! isset( $value['type'] ) )    continue;
        if ( ! isset( $value['id'] ) )      $value['id'] = '';
        if ( ! isset( $value['name'] ) )    $value['name'] = '';
        if ( ! isset( $value['class'] ) )   $value['class'] = '';
        if ( ! isset( $value['css'] ) )     $value['css'] = '';
        if ( ! isset( $value['std'] ) )     $value['std'] = '';
        if ( ! isset( $value['desc'] ) )    $value['desc'] = '';
        
        switch( $value['type'] ) {
            case 'title':
                if ( isset($value['name'] ) && $value['name'] ) echo '<h3>' . $value['name'] . '</h3>'; 
                if ( isset($value['desc'] ) && $value['desc'] ) echo wpautop( wptexturize( $value['desc'] ) );
                echo '<table class="form-table">'. "\n\n";
                if ( isset($value['id'] ) && $value['id'] ) do_action( 'wp_awld_js_settings_' . sanitize_title($value['id'] ) );
            break;
            case 'sectionend':
                if ( isset($value['id'] ) && $value['id'] ) do_action( 'wp_awld_js_settings_' . sanitize_title( $value['id'] ) . '_end' );
                echo '</table>';
                if ( isset($value['id'] ) && $value['id'] ) do_action( 'wp_awld_js_settings_' . sanitize_title( $value['id'] ) . '_after' );
            break;
            case 'text':
                ?><tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                    </th>
                    <td class="forminp"><input name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" type="<?php echo esc_attr( $value['type'] ); ?>" style="<?php echo esc_attr( $value['css'] ); ?>" value="<?php if ( get_option( $value['id'] ) !== false && get_option( $value['id'] ) !== null ) { echo esc_attr( stripslashes( get_option($value['id'] ) ) ); } else { echo esc_attr( $value['std'] ); } ?>" /> <?php echo $description; ?></td>
                </tr><?php
            break;
            case 'select':
                ?><tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo $value['name']; ?></label>
                    </th>
                    <td class="forminp"><select name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" style="<?php echo esc_attr( $value['css'] ); ?>" class="<?php if (isset($value['class'])) echo $value['class']; ?>">
                    <?php
                        foreach ($value['options'] as $key => $val) {
                            $_current = get_option( $value['id'] );
                            if ( ! $_current ) {
                                $_current = $value['std'];
                            }
                            ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $_current, $key ); ?>><?php echo $val ?></option>
                            <?php
                        }
                        ?>
                        </select> <?php echo $value['desc']; ?>
                    </td>
                </tr><?php
            break;
            case 'checkbox' :
            
                if (!isset($value['hide_if_checked'])) $value['hide_if_checked'] = false;
                if (!isset($value['show_if_checked'])) $value['show_if_checked'] = false;
                
                if (!isset($value['checkboxgroup']) || (isset($value['checkboxgroup']) && $value['checkboxgroup']=='start')) :
                    ?>
                    <tr valign="top" class="<?php 
                        if ($value['hide_if_checked']=='yes' || $value['show_if_checked']=='yes') echo 'hidden_option'; 
                        if ($value['hide_if_checked']=='option') echo 'hide_options_if_checked';
                        if ($value['show_if_checked']=='option') echo 'show_options_if_checked';
                    ?>">
                    <th scope="row" class="titledesc"><?php echo $value['name'] ?></th>
                    <td class="forminp">
                        <fieldset>
                    <?php
                else :
                    ?>
                    <fieldset class="<?php 
                        if ($value['hide_if_checked']=='yes' || $value['show_if_checked']=='yes') echo 'hidden_option'; 
                        if ($value['hide_if_checked']=='option') echo 'hide_options_if_checked';
                        if ($value['show_if_checked']=='option') echo 'show_options_if_checked';
                    ?>">
                    <?php
                endif;
                
                ?>
                <legend class="screen-reader-text"><span><?php echo $value['name'] ?></span></legend>
                    <label for="<?php echo $value['id'] ?>">
                    <input name="<?php echo esc_attr( $value['id'] ); ?>" id="<?php echo esc_attr( $value['id'] ); ?>" type="checkbox" value="1" <?php checked(get_option($value['id']), 'yes'); ?> />
                    <?php echo $value['desc'] ?></label><br />
                <?php
                
                if (!isset($value['checkboxgroup']) || (isset($value['checkboxgroup']) && $value['checkboxgroup']=='end')) :
                    ?>
                        </fieldset>
                    </td>
                    </tr>
                    <?php
                else :
                    ?>
                    </fieldset>
                    <?php
                endif;
                
            break;
            default:
                do_action( 'wp_awld_js_admin_field_'.$value['type'], $value );
            break;
        }
    }
}