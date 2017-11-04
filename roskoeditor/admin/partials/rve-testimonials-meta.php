<?php

/**
 * Provides functions for creation of admin meta for testimonials custom post type
 *
 * This file is used to display and save the meta in testimonials post type.
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
 * Generate the meta box content for the testimonials post
 * 
 **/
function rve_testimonials_meta_callback($post){
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $stored_meta = get_post_meta($post->ID);
    ?>

    <p>
        <label for="name" class="form-control"><?php _e( 'Full Name: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="name" id="name" value="<?php if ( isset ( $stored_meta['name'] ) ) echo $stored_meta['name'][0]; ?>" />
    </p>
     <p>
        <label for="job" class="form-control"><?php _e( 'Job Title: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="job" id="job" value="<?php if ( isset ( $stored_meta['job'] ) ) echo $stored_meta['job'][0]; ?>" />
    </p>
 
    <?php
}

/**
 * 
 * Saves the custom meta input for testimonials post
 * 
 **/
function rve_testimonials_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'name' ] ) ) {
        update_post_meta( $post_id, 'name', sanitize_text_field( $_POST[ 'name' ] ) );
    }
    
     // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'job' ] ) ) {
        update_post_meta( $post_id, 'job', sanitize_text_field( $_POST[ 'job' ] ) );
    }

}
add_action( 'save_post', 'rve_testimonials_meta_save' );
