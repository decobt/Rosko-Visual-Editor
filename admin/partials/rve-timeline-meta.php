<?php

/**
 * Provides functions for creation of admin meta for timeline custom post type
 *
 * This file is used to display and save the meta in timeline post type.
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
 * Generate the meta box content for the timeline post
 * 
 **/
function rve_timeline_meta_callback($post){
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $stored_meta = get_post_meta($post->ID);
    ?>

    <p>
        <label for="starting-date" class="form-control"><?php _e( 'Starting Date: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="starting-date" id="starting-date" value="<?php if ( isset ( $stored_meta['starting-date'] ) ) echo $stored_meta['starting-date'][0]; ?>" />
    </p>
     <p>
        <label for="ending-date" class="form-control"><?php _e( 'Ending Date: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="ending-date" id="ending-date" value="<?php if ( isset ( $stored_meta['ending-date'] ) ) echo $stored_meta['ending-date'][0]; ?>" />
    </p>
 
    <?php
}

/**
 * 
 * Saves the custom meta input for timeline post
 * 
 **/
function rve_timeline_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'starting-date' ] ) ) {
        update_post_meta( $post_id, 'starting-date', sanitize_text_field( $_POST[ 'starting-date' ] ) );
    }
    
     // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'ending-date' ] ) ) {
        update_post_meta( $post_id, 'ending-date', sanitize_text_field( $_POST[ 'ending-date' ] ) );
    }

}
add_action( 'save_post', 'rve_timeline_meta_save' );
