<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function rve_generate_module6( $atts ) {
	
	$post_id =  $GLOBALS['post']->post_title;
    $a = shortcode_atts( array(
        'data-content' => '',
    ), $atts );
    
    //get color and check if its set
	global $post;
	$staff_color = get_post_meta($post->ID, 'staff_color', true);
	if(!isset($staff_color) || $staff_color==''){
	    $staff_color = '#eee';
	}

	ob_start();
	
	$my_query = query_posts( array('post_type' => 'staff','post__in' => explode(',',$a['data-content']) ));
	
	//Search for additional thumbnail and link for each returned post in $my_query
	  foreach ($my_query as $post) {
	      $post -> post_thumbnail = get_the_post_thumbnail_url($post->ID, 'staff-thumb');
	      $post -> post_url = get_permalink($post->ID);
	  }

	echo '<section id="staff-section" style="background-color:'. $staff_color .'; padding:80px 0px 80px; text-align:center">';
	echo '<div class="container-fluid">';
	echo '<div class="row">';
	
	// The Loop
	$list = explode( ',', $a['data-content']);
	//Loop through the array and generate gallery cards

	foreach ($list as $list_id){
    	rve_get_staff($list_id, $my_query);
	}

	echo '</div></div></section>';
 
	// Reset Query
	wp_reset_query();

	while(ob_end_flush());
}
add_shortcode( 'module6', 'rve_generate_module6' );

function rve_get_staff($list_id, $my_query){ 
	
	foreach ($my_query as $post){

    //Check if $list_id == $post->ID, if true generate the HTML code
    if($list_id == $post->ID){
    	
    //get the meta for social media
    $facebook = get_post_meta( $post->ID, 'facebook', true );
    $twitter = get_post_meta( $post->ID, 'twitter', true );
    $linkedin = get_post_meta( $post->ID, 'linkedin', true );
	?>
	
	<div class="col-sm-4">
                    <div class="team-member">
                        <img src="<?php echo $post->post_thumbnail ?>" class="img-responsive img-circle img-thumbnail" alt="">
                        <h4><?php echo $post->post_title ?></h4>
                        <p class="text-muted"><?php echo $post->post_content ?></p>
                        <ul class="list-inline social-buttons">
                        	<?php if( !empty( $twitter ) ) { ?>
                            <li><a href="<?php if( !empty( $twitter ) ) { echo $twitter; } ?>"><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a>
                            </li>
                            <?php } ?>
                            <?php if( !empty( $facebook ) ) { ?>
                            <li><a href="<?php if( !empty( $facebook ) ) { echo $facebook; } ?>"><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a>
                            </li>
                            <?php } ?>
                            <?php if( !empty( $linkedin ) ) { ?>
                            <li><a href="<?php if( !empty( $linkedin ) ) { echo $linkedin; } ?>"><i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
	    
	<?php
    }//end of if    
   }//end of foreach	
}
?>