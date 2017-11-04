<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function rve_generate_module7( $atts ) {
	
	$post_id =  $GLOBALS['post']->post_title;
    $a = shortcode_atts( array(
        'data-content' => '',
    ), $atts );
    
    //get color and check if its set
	global $post;
	$timeline_color = get_post_meta($post->ID, 'timeline_color', true);
	if(!isset($timeline_color) || $timeline_color==''){
	    $timeline_color = '#fafafa';
	}

	ob_start();
	
	$my_query = query_posts( array('post_type' => 'timeline','post__in' => explode(',',$a['data-content']) ));
	
	//Search for additional thumbnail and link for each returned post in $my_query
	  foreach ($my_query as $post) {
	      //$post -> post_thumbnail = get_the_post_thumbnail_url($post->ID);
	      $post -> post_url = get_permalink($post->ID);
	  }
	
           
	echo '<div style="padding:100px 0px 80px; color:white; text-align:center; background:'. $timeline_color.'">';
	echo '<div class="container-fluid">';
	
	// The Loop
	$list = explode( ',', $a['data-content']);
	//Loop through the array and generate gallery cards

	foreach ($list as $list_id){
    	rve_get_timeline($list_id, $my_query);
	}

	echo '</div></div>';
 
	// Reset Query
	wp_reset_query();

	while(ob_end_flush());
}
add_shortcode( 'module7', 'rve_generate_module7' );

function rve_get_timeline($list_id, $my_query){ 
	
	foreach ($my_query as $post){

    //Check if $list_id == $post->ID, if true generate the HTML code
    if($list_id == $post->ID){
    	
    $start = get_post_meta( $post->ID, 'starting-date', true );
    $ending = get_post_meta( $post->ID, 'ending-date', true );
	?>

 <div class="row wow">
                <div class=" col-xs-12 col-sm-3">
                    <div class="prevY" style="background:#ef7674;padding:10px;margin:10px"><?php if( !empty( $start ) ) { echo $start; } ?></div>
                    <div class="afterY" style="background:#333;padding:10px;margin:10px"><?php if( !empty( $ending ) ) { echo $ending; } ?></div>
                </div>
                <div class="col-xs-12 col-sm-9 timeline-panel">
                    <div class="arrow_box" style="width:100%; text-align:left; padding:25px 20px 10px; background:#f2f2f2; color:#333; position:relative">
                        <h4><?php echo $post->post_title ?></h4>
                        <p><?php echo $post->post_content ?></p>
                    </div>
                </div>
            </div>

	<?php
    }//end of if    
   }//end of foreach	
}
?>