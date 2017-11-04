<?php

/**
 * Provides functions for creation of admin meta for parallax custom post type
 *
 * This file is used to display and save the meta in parallax post type.
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
 * Generate the meta box content for the parallax post
 * 
 **/
function rve_parallax_meta_callback($post){
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $stored_meta = get_post_meta($post->ID);
    ?>

    <p>
        <label for="button-text" class="form-control"><?php _e( 'Button Text: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="button-text" id="button-text" value="<?php if ( isset ( $stored_meta['button-text'] ) ) echo $stored_meta['button-text'][0]; ?>" />
    </p>
     <p>
        <label for="button-link" class="form-control"><?php _e( 'Button Link: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="button-link" id="button-link" value="<?php if ( isset ( $stored_meta['button-link'] ) ) echo $stored_meta['button-link'][0]; ?>" />
    </p>
 
    <?php
}

/**
 * 
 * Saves the custom meta input for parallax post
 * 
 **/
function rve_parallax_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'button-text' ] ) ) {
        update_post_meta( $post_id, 'button-text', sanitize_text_field( $_POST[ 'button-text' ] ) );
    }
    
     // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'button-link' ] ) ) {
        update_post_meta( $post_id, 'button-link', sanitize_text_field( $_POST[ 'button-link' ] ) );
    }

}
add_action( 'save_post', 'rve_parallax_meta_save' );
