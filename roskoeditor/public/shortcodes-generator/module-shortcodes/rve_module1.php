<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function rve_generate_module1( $atts ) {
	
	$post_id =  $GLOBALS['post']->post_title;
    $a = shortcode_atts( array(
        'data-content' => '',
    ), $atts );

	//get color and check if its set
	global $post;
	$paragraph_bg_color = get_post_meta($post->ID, 'paragraph_bg_color', true);
	$paragraph_txt_color = get_post_meta($post->ID, 'paragraph_txt_color', true);
	if(!isset($paragraph_bg_color) || $paragraph_bg_color==''){
	    $paragraph_bg_color = '#ececec';
	}
	if(!isset($paragraph_txt_color) || $paragraph_txt_color==''){
	    $paragraph_txt_color = '#2f2f2f';
	}
	
	ob_start();
	?>
	
	    <div style="background:<?php echo $paragraph_bg_color; ?>;padding:80px 0px 80px; text-align:center; color:<?php echo $paragraph_txt_color; ?>">
            <div class="container-fluid">
            <div class="row">
                <div class=" col-xs-12 col-sm-12">
                    <?php echo urldecode($a['data-content']) ?>
                </div>
            </div>
            </div>
        </div>

	<?php
	while(ob_end_flush());
}
add_shortcode( 'module1', 'rve_generate_module1' );
?>