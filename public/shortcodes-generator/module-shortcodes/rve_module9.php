<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function rve_generate_module9( $atts ) {
	
	$post_id =  $GLOBALS['post']->post_title;
    $a = shortcode_atts( array(
        'data-content' => '',
    ), $atts );
    
    //get color and check if its set
	global $post;
	$infobox_color = get_post_meta($post->ID, 'infobox_color', true);
	if(!isset($infobox_color) || $infobox_color==''){
	    $infobox_color = '#fafafa';
	}

	ob_start();
	
	$my_query = query_posts( array('post_type' => 'infoboxes','post__in' => explode(',',$a['data-content']) ));
	
	//Search for additional thumbnail and link for each returned post in $my_query
	  foreach ($my_query as $post) {
	      //$post -> post_thumbnail = get_the_post_thumbnail_url($post->ID);
	      $post -> post_url = get_permalink($post->ID);
	  }
	
	    
            
           
	echo '<div style="padding:80px 0px 80px; background:'. $infobox_color .'">';
	echo '<div class="container-fluid" id="services"><div class="row text-center">';
	
	// The Loop
	$list = explode( ',', $a['data-content']);
	//Loop through the array and generate gallery cards

	foreach ($list as $list_id){
    	rve_get_infoboxes($list_id, $my_query);
	}

	echo '</div></div></div>';
 
	// Reset Query
	wp_reset_query();

	while(ob_end_flush());
}
add_shortcode( 'module9', 'rve_generate_module9' );

function rve_get_infoboxes($list_id, $my_query){ 
	
	foreach ($my_query as $post){

    //Check if $list_id == $post->ID, if true generate the HTML code
    if($list_id == $post->ID){
    	
    $class = get_post_meta( $post->ID, 'font-awesome-class', true );
	?>

	 			<div class="col-md-4">
	 				<?php if( !empty( $class ) ) { ?>
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-square fa-stack-2x" style="color:#ef7674"></i>
                        <i class="fa <?php if( !empty( $class ) ) { echo $class; } ?> fa-stack-1x fa-inverse"></i>
                    </span>
                    <?php } ?>
                    <h4 class="service-heading"><?php echo $post->post_title ?></h4>
                    <p class="text-muted"><?php echo $post->post_content ?></p>
                </div>

	<?php
    }//end of if    
   }//end of foreach	
}
?>