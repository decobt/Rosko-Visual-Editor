<?php

if ( ! function_exists( 'rve_new_backend_scripts' ) ){
    function rve_new_backend_scripts($hook) {
        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
    }
}
add_action( 'admin_enqueue_scripts', 'rve_new_backend_scripts');


if ( ! function_exists( 'rve_add_styling_meta_box' ) ){
    function rve_add_styling_meta_box(){
        add_meta_box( 'styling-metabox-options', esc_html__('Styling Options', 'rosko-visual-editor' ), 'rve_styling_meta_box_callback', array('page', 'post') , 'normal', 'low');
    }
}
add_action( 'add_meta_boxes', 'rve_add_styling_meta_box' );

if ( ! function_exists( 'rve_styling_meta_box_callback' ) ){
    function rve_styling_meta_box_callback( $post ){
        $custom = get_post_custom( $post->ID );
        
        //set colors at the beginning
        $paragraph_bg_color = (isset($custom["paragraph_bg_color"][0])) ? $custom["paragraph_bg_color"][0] : '';
        $paragraph_txt_color = (isset($custom["paragraph_txt_color"][0])) ? $custom["paragraph_txt_color"][0] : '';
        
        $button_bg_color = (isset($custom["button_bg_color"][0])) ? $custom["button_bg_color"][0] : '';
        $button_txt_color = (isset($custom["button_txt_color"][0])) ? $custom["button_txt_color"][0] : '';
        $button_btn_color = (isset($custom["button_btn_color"][0])) ? $custom["button_btn_color"][0] : '';
        
        $social_bg_color = (isset($custom["social_bg_color"][0])) ? $custom["social_bg_color"][0] : '';
        $social_btn_color = (isset($custom["social_btn_color"][0])) ? $custom["social_btn_color"][0] : '';

        $gallery_color = (isset($custom["gallery_color"][0])) ? $custom["gallery_color"][0] : '';
        $infobox_color = (isset($custom["infobox_color"][0])) ? $custom["infobox_color"][0] : '';
        $testimonial_color = (isset($custom["testimonial_color"][0])) ? $custom["testimonial_color"][0] : '';
        $timeline_color = (isset($custom["timeline_color"][0])) ? $custom["timeline_color"][0] : '';
        $staff_color = (isset($custom["staff_color"][0])) ? $custom["staff_color"][0] : '';
        
        wp_nonce_field( 'rosko_styling_meta_box', 'rosko_styling_meta_box_nonce' );
        ?>
        
    <div class="accordionz" data-acc=".acc1">Paragraph styling options</div>
    <div class="panelz acc1">
        <p>Use these options to style the paragraph module on this page.</p>
        <table>
            <tr>
                <td class="heading-cell"><label for="paragraph_bg_color">Background color:</label></td>
                <td><input class="color-field" id="paragraph_bg_color" type="text" name="paragraph_bg_color" value="<?php esc_attr_e($paragraph_bg_color); ?>"/></td>
            </tr>
            <tr>
                <td class="heading-cell"><label for="paragraph_txt_color" class="prfx-row-title">Text color:</label></td>
                <td><input class="color-field" type="text" name="paragraph_txt_color" value="<?php esc_attr_e($paragraph_txt_color); ?>"/></td>
            </tr>
        </table>
    </div>
    
    <div class="accordionz" data-acc=".acc2">Button styling options</div>
    <div class="panelz acc2">
      <p>Use these options to style the button module on this page.</p>
        <table>
            <tr>
                <td class="heading-cell"><label for="button_bg_color">Background color:</label></td>
                <td><input class="color-field" id="button_bg_color" type="text" name="button_bg_color" value="<?php esc_attr_e($button_bg_color); ?>"/></td>
            </tr>
            <tr>
                <td class="heading-cell"><label for="button_btn_color">Button color:</label></td>
                <td><input class="color-field" type="text" name="button_btn_color" value="<?php esc_attr_e($button_btn_color); ?>"/></td>
            </tr>
            <tr>
                <td class="heading-cell"><label for="button_txt_color">Button Text color:</label></td>
                <td><input class="color-field" type="text" name="button_txt_color" value="<?php esc_attr_e($button_txt_color); ?>"/></td>
            </tr>
        </table>
    </div>
    
    <div class="accordionz" data-acc=".acc3">Social styling options</div>
    <div class="panelz acc3">
      <p>Use these options to style the social module on this page.</p>
        <table>
            <tr>
                <td class="heading-cell"><label for="social_bg_color">Background color:</label></td>
                <td><input class="color-field" id="social_bg_color" type="text" name="social_bg_color" value="<?php esc_attr_e($social_bg_color); ?>"/></td>
            </tr>
            <tr>
                <td class="heading-cell"><label for="social_btn_color">Button color:</label></td>
                <td><input class="color-field" type="text" name="social_btn_color" value="<?php esc_attr_e($social_btn_color); ?>"/></td>
            </tr>
        </table>
    </div>
    
    <div class="accordionz" data-acc=".acc4">Other styling options</div>
    <div class="panelz acc4">
      <p>Use these options to style rest of the modules on this page.</p>
        <table>
            <tr>
                <td class="heading-cell"><label for="gallery_color">Gallery Background color:</label></td>
                <td><input class="color-field" id="gallery_color" type="text" name="gallery_color" value="<?php esc_attr_e($gallery_color); ?>"/></td>
            </tr>
            <tr>
                <td class="heading-cell"><label for="infobox_color">Infobox Background color:</label></td>
                <td><input class="color-field" id="infobox_color" type="text" name="infobox_color" value="<?php esc_attr_e($infobox_color); ?>"/></td>
            </tr>
            <tr>
                <td class="heading-cell"><label for="testimonial_color">Testimonial Background color:</label></td>
                <td><input class="color-field" id="testimonial_color" type="text" name="testimonial_color" value="<?php esc_attr_e($testimonial_color); ?>"/></td>
            </tr>
            <tr>
                <td class="heading-cell"><label for="timeline_color">Timeline Background color:</label></td>
                <td><input class="color-field" id="timeline_color" type="text" name="timeline_color" value="<?php esc_attr_e($timeline_color); ?>"/></td>
            </tr>
            <tr>
                <td class="heading-cell"><label for="staff_color">Staff Background color:</label></td>
                <td><input class="color-field" id="staff_color" type="text" name="staff_color" value="<?php esc_attr_e($staff_color); ?>"/></td>
            </tr>
        </table>
    </div>

    
        <?php
    }
}
if ( ! function_exists( 'rve_save_styling_meta_box' ) ){
    function rve_save_styling_meta_box( $post_id ){
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if( !current_user_can( 'edit_pages' ) ) {
            return;
        }
        
        //check if everything is set
        if ( !isset( $_POST['paragraph_txt_color'] ) || !isset( $_POST['paragraph_bg_color'] ) || !wp_verify_nonce( $_POST['rosko_styling_meta_box_nonce'], 'rosko_styling_meta_box' ) ) {
            return;
        }
        if ( !isset( $_POST['button_txt_color'] ) || !isset( $_POST['button_bg_color'] ) || !isset( $_POST['button_btn_color'] ) ) {
            return;
        }
        if ( !isset( $_POST['social_btn_color'] ) || !isset( $_POST['social_bg_color'] ) ) {
            return;
        }
        if ( !isset( $_POST['gallery_color'] ) || !isset( $_POST['infobox_color'] ) || !isset( $_POST['testimonial_color'] ) || !isset( $_POST['timeline_color'] ) || !isset( $_POST['staff_color'] ) ) {
            return;
        }
        
        //update paragraph styling meta
        $paragraph_bg_color = (isset($_POST["paragraph_bg_color"]) && $_POST["paragraph_bg_color"]!='') ? $_POST["paragraph_bg_color"] : '';
        update_post_meta($post_id, "paragraph_bg_color", $paragraph_bg_color);
        $paragraph_txt_color = (isset($_POST["paragraph_txt_color"]) && $_POST["paragraph_txt_color"]!='') ? $_POST["paragraph_txt_color"] : '';
        update_post_meta($post_id, "paragraph_txt_color", $paragraph_txt_color);
        
        //update button styling meta
        $button_bg_color = (isset($_POST["button_bg_color"]) && $_POST["button_bg_color"]!='') ? $_POST["button_bg_color"] : '';
        update_post_meta($post_id, "button_bg_color", $button_bg_color);
        $button_txt_color = (isset($_POST["button_txt_color"]) && $_POST["button_txt_color"]!='') ? $_POST["button_txt_color"] : '';
        update_post_meta($post_id, "button_txt_color", $button_txt_color);
        $button_btn_color = (isset($_POST["button_btn_color"]) && $_POST["button_btn_color"]!='') ? $_POST["button_btn_color"] : '';
        update_post_meta($post_id, "button_btn_color", $button_btn_color);
        
        //update social styling meta
        $social_btn_color = (isset($_POST["social_btn_color"]) && $_POST["social_btn_color"]!='') ? $_POST["social_btn_color"] : '';
        update_post_meta($post_id, "social_btn_color", $social_btn_color);
        $social_bg_color = (isset($_POST["social_bg_color"]) && $_POST["social_bg_color"]!='') ? $_POST["social_bg_color"] : '';
        update_post_meta($post_id, "social_bg_color", $social_bg_color);
        
        //update other styling meta
        $gallery_color = (isset($_POST["gallery_color"]) && $_POST["gallery_color"]!='') ? $_POST["gallery_color"] : '';
        update_post_meta($post_id, "gallery_color", $gallery_color);
        $infobox_color = (isset($_POST["infobox_color"]) && $_POST["infobox_color"]!='') ? $_POST["infobox_color"] : '';
        update_post_meta($post_id, "infobox_color", $infobox_color);
        $testimonial_color = (isset($_POST["testimonial_color"]) && $_POST["testimonial_color"]!='') ? $_POST["testimonial_color"] : '';
        update_post_meta($post_id, "testimonial_color", $testimonial_color);
        $timeline_color = (isset($_POST["timeline_color"]) && $_POST["timeline_color"]!='') ? $_POST["timeline_color"] : '';
        update_post_meta($post_id, "timeline_color", $timeline_color);
        $staff_color = (isset($_POST["staff_color"]) && $_POST["staff_color"]!='') ? $_POST["staff_color"] : '';
        update_post_meta($post_id, "staff_color", $staff_color);
    }
}
add_action( 'save_post', 'rve_save_styling_meta_box' );

?>