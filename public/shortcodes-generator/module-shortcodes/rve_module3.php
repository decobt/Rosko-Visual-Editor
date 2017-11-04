<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function rve_generate_module3( $atts ) {
	
	$post_id =  $GLOBALS['post']->post_title;
    $a = shortcode_atts( array(
        'data-content' => ',,,',
    ), $atts );

	$list = explode(',', $a['data-content']);	
	
	//get color and check if its set
	global $post;
	$button_bg_color = get_post_meta($post->ID, 'button_bg_color', true);
	$button_txt_color = get_post_meta($post->ID, 'button_txt_color', true);
	$button_btn_color = get_post_meta($post->ID, 'button_btn_color', true);
	
	if(!isset($button_bg_color) || $button_bg_color==''){
	    $button_bg_color = '#333';
	}
	if(!isset($button_txt_color) || $button_txt_color==''){
	    $button_txt_color = '#fff';
	}
	if(!isset($button_btn_color) || $button_btn_color==''){
	    $button_btn_color = '#ef7674';
	}
	
	ob_start();?>
	
	<div style="background:<?php echo $button_bg_color; ?>; padding:70px 0px 70px; text-align:center">    
        <div class="container-fluid">
            <div class="row"><div class="col-sm-12">
                <a href="<?php echo urldecode($list[0]) ?>" target="_blank" style="background:<?php echo $button_btn_color; ?>; color:<?php echo $button_txt_color; ?>; border-color:<?php echo $button_btn_color; ?>" class="btn btn-xl <?php echo $list[2] ?>" id="<?php echo $list[3] ?>"><?php echo $list[1] ?></a>
            </div></div>
          </div>
      </div>

	<?php
	while(ob_end_flush());
}
add_shortcode( 'module3', 'rve_generate_module3' );
?>