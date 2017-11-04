<?php

/**
 * Provides functions for creation of admin meta for staff custom post type
 *
 * This file is used to display and save the meta in staff post type.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    rosko_visual_editor
 * @subpackage rosko_visual_editor/admin/partials
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * 
 * Generate the meta box content for the staff post
 * 
 **/
function rve_staff_meta_callback($post){
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $stored_meta = get_post_meta($post->ID);
    ?>

    <p>
        <label for="facebook" class="form-control"><?php _e( 'Facebook: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="facebook" id="facebook" value="<?php if ( isset ( $stored_meta['facebook'] ) ) echo $stored_meta['facebook'][0]; ?>" />
    </p>
     <p>
        <label for="twitter" class="form-control"><?php _e( 'Twitter Link: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="twitter" id="twitter" value="<?php if ( isset ( $stored_meta['twitter'] ) ) echo $stored_meta['twitter'][0]; ?>" />
    </p>
    <p>
        <label for="linkedin" class="form-control"><?php _e( 'Linkedin Link: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="linkedin" id="linkedin" value="<?php if ( isset ( $stored_meta['linkedin'] ) ) echo $stored_meta['linkedin'][0]; ?>" />
    </p>
 
    <?php
}

/**
 * 
 * Saves the custom meta input for staff post
 * 
 **/
function rve_staff_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'facebook' ] ) ) {
        update_post_meta( $post_id, 'facebook', sanitize_text_field( $_POST[ 'facebook' ] ) );
    }
    
     // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'twitter' ] ) ) {
        update_post_meta( $post_id, 'twitter', sanitize_text_field( $_POST[ 'twitter' ] ) );
    }
    
     // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'linkedin' ] ) ) {
        update_post_meta( $post_id, 'linkedin', sanitize_text_field( $_POST[ 'linkedin' ] ) );
    }

}
add_action( 'save_post', 'rve_staff_meta_save' );
