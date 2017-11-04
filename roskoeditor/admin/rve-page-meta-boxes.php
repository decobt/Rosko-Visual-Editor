<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rve-parallax-meta.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rve-staff-meta.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rve-timeline-meta.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rve-testimonials-meta.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rve-infoboxes-meta.php';

/**
 * 
 * Adds meta boxes for various custom post types
 * 
 **/
function rve_add_post_meta_boxes(){
    add_meta_box( 'parallax_meta', __( 'Button Options', 'rosko-visual-editor' ), 'rve_parallax_meta_callback', 'parallax', 'normal', 'high');
    add_meta_box( 'staff_meta', __( 'Staff Social Media Options', 'rosko-visual-editor' ), 'rve_staff_meta_callback', 'staff', 'normal', 'high');
    add_meta_box( 'timeline_meta', __( 'Event Date Options', 'rosko-visual-editor' ), 'rve_timeline_meta_callback', 'timeline', 'normal', 'high');
    add_meta_box( 'testimonials_meta', __( 'Testimonials Person Options', 'rosko-visual-editor' ), 'rve_testimonials_meta_callback', 'testimonials', 'normal', 'high');
    add_meta_box( 'infoboxes_meta', __( 'Font Awesome Icon Options', 'rosko-visual-editor' ), 'rve_infoboxes_meta_callback', 'infoboxes', 'normal', 'high');
}
add_action( 'add_meta_boxes', 'rve_add_post_meta_boxes' );

?>