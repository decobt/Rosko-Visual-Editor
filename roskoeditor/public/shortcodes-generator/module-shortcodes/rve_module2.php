<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function rve_generate_module2( $atts ) {
  
	//Check for attributes set in shortcode or assign defaults
	$post_id =  $GLOBALS['post']->post_title;
    $a = shortcode_atts( array(
        'data-content' => '',
    ), $atts );

	//Query for posts and record the results
	query_posts( array('post_type' => 'parallax','post__in' => explode(',',$a['data-content']) ));

	ob_start(); 
	// The Loop
	while ( have_posts() ) : the_post();?>

<?php
$button_text = get_post_meta( get_the_ID(), 'button-text', true );
$button_link = get_post_meta( get_the_ID(), 'button-link', true );
?>
	
<header style="background-image:url('<?php the_post_thumbnail_url(); ?>');">
        <div class="container-fluid">
            <div class="intro-text">
            	<div class="intro-heading"><?php the_title_attribute(); ?></div>
                <div class="intro-lead-in"><?php the_content(); ?></div>
                
                <a href="<?php if( !empty( $button_link ) ) { echo $button_link; } ?>" class="page-scroll btn btn-xl"><?php if( !empty( $button_text ) ) { echo $button_text; } ?></a>
            </div>
        </div>
    </header>

	<?php endwhile;
	
	// Reset Query
	wp_reset_query();
	
	//Return the buffer content and stop buffering
	while(ob_end_flush());
}
add_shortcode( 'module2', 'rve_generate_module2' );
?>