<?php

/**
 * Provides functions for creation of admin meta for infoboxes custom post type
 *
 * This file is used to display and save the meta in infoboxes post type.
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
 * Generate the meta box content for the infoboxes post
 * 
 **/
function rve_infoboxes_meta_callback($post){
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $stored_meta = get_post_meta($post->ID);
    ?>

    <p>
        <label for="font-awesome-class" class="form-control"><?php _e( 'Font Awesome Icon Class: ', 'rosko-visual-editor' )?></label><br/>
        <input style="width:100%" type="text" name="font-awesome-class" id="font-awesome-class" value="<?php if ( isset ( $stored_meta['font-awesome-class'] ) ) echo $stored_meta['font-awesome-class'][0]; ?>" />
    </p>
 
    <?php
}

/**
 * 
 * Saves the custom meta input for infoboxes post
 * 
 **/
function rve_infoboxes_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'font-awesome-class' ] ) ) {
        update_post_meta( $post_id, 'font-awesome-class', sanitize_text_field( $_POST[ 'font-awesome-class' ] ) );
    }

}
add_action( 'save_post', 'rve_infoboxes_meta_save' );
