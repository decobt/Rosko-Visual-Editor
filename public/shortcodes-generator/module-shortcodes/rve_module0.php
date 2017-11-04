<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function rve_generate_module0() {
	
	$options = get_option('social_options');
	
	//get color and check if its set
	global $post;
	$social_bg_color = get_post_meta($post->ID, 'social_bg_color', true);
	$social_btn_color = get_post_meta($post->ID, 'social_btn_color', true);
	if(!isset($social_bg_color) || $social_bg_color==''){
	    $social_bg_color = '#ececec';
	}
	if(!isset($social_btn_color) || $social_btn_color==''){
	    $social_btn_color = '#2f2f2f';
	}
	
	ob_start();
	?>
	
	<section id="social-section" style="padding:40px 0px 40px; background:<?php echo $social_bg_color; ?>">
	<div class="container-fluid text-center">
	<ul class="list-inline social-buttons">
		
	<?php if(isset($options['facebook']) && $options['facebook']!=''){ ?>
	 <li><a href="<?php echo $options['facebook'] ?>"><i class="fa fa-facebook-square fa-3x" aria-hidden="true" style="color:<?php echo $social_btn_color; ?>"></i></a></li>
	<?php } ?>
	
	<?php if(isset($options['twitter']) && $options['twitter']!=''){ ?>
	 <li><a href="<?php echo $options['twitter'] ?>"><i class="fa fa-twitter-square fa-3x" aria-hidden="true" style="color:<?php echo $social_btn_color; ?>"></i></a></li>
	<?php } ?>
	
	<?php if(isset($options['linkedin']) && $options['linkedin']!=''){ ?>
	 <li><a href="<?php echo $options['linkedin'] ?>"><i class="fa fa-linkedin-square fa-3x" aria-hidden="true" style="color:<?php echo $social_btn_color; ?>"></i></a></li>
	<?php } ?>
	
	<?php if(isset($options['youtube']) && $options['youtube']!=''){ ?>
	 <li><a href="<?php echo $options['youtube'] ?>"><i class="fa fa-youtube-square fa-3x" aria-hidden="true" style="color:<?php echo $social_btn_color; ?>"></i></a></li>
	<?php } ?>
	
	<?php if(isset($options['google']) && $options['google']!=''){ ?>
	 <li><a href="<?php echo $options['google'] ?>"><i class="fa fa-google-plus-square fa-3x" aria-hidden="true" style="color:<?php echo $social_btn_color; ?>"></i></a></li>
	<?php } ?>
	
	<?php if(isset($options['snapchat']) && $options['snapchat']!=''){ ?>
	 <li><a href="<?php echo $options['snapchat'] ?>"><i class="fa fa-snapchat-square fa-3x" aria-hidden="true" style="color:<?php echo $social_btn_color; ?>"></i></a></li>
	<?php } ?>
	
	<?php if(isset($options['mail']) && $options['mail']!=''){ ?>
	 <li><a href="<?php echo $options['mail'] ?>"><i class="fa fa-envelope-square fa-3x" aria-hidden="true" style="color:<?php echo $social_btn_color; ?>"></i></a></li>
	<?php } ?>
	
	</ul></div></section>
 
 	<?php
	
	while(ob_end_flush());
}
add_shortcode( 'module0', 'rve_generate_module0' );
?>