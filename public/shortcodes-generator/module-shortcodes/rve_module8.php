<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function generate_module8( $atts ) {
	
	$post_id =  $GLOBALS['post']->post_title;
    $a = shortcode_atts( array(
        'data-content' => '',
    ), $atts );
    
    //get color and check if its set
	global $post;
	$testimonial_color = get_post_meta($post->ID, 'testimonial_color', true);
	if(!isset($testimonial_color) || $testimonial_color==''){
	    $testimonial_color = '#eee';
	}

	ob_start();

	$my_query = query_posts( array('post__in' => explode( ',', $a['data-content']),'post_type' => 'testimonials') );
	
	//Search for additional thumbnail and link for each returned post in $my_query
	  foreach ($my_query as $post) {
	      $post -> post_thumbnail = get_the_post_thumbnail_url($post->ID, 'testimonials-thumb');
	      $post -> post_url = get_permalink($post->ID);
	  }

?>

<div style="background:<?php echo $testimonial_color; ?>; padding:20px 0px 20px; text-align:center">    
<div class="container-fluid">
<div id="carousel-first-generic" class="carousel slide" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

<?php

	// The Loop
	$list = explode( ',', $a['data-content']);
	//Loop through the array and generate gallery cards

	$index=1;
	foreach ($list as $list_id){
	    get_testimonial($list_id, $my_query, $index);
	    $index = $index + 1;
	}
	echo '</div>';
 
 	?>
	<!-- Indicators -->
	  <ol class="carousel-indicators">
	  	
	  	<?php
	    $index = 0;
		  foreach ($list as $list_id){
		    if($index == 0){
		      echo '<li data-target="#carousel-first-generic" data-slide-to="'.$index.'" class="active"></li>';
		      $index = $index + 1;
		    }else{
		      echo '<li data-target="#carousel-first-generic" data-slide-to="'.$index.'"></li>';
		      $index = $index + 1;
		    }
		  }
	    ?>
	  </ol>
	  
	<?php
	
	echo '</div></div></div>';
	// Reset Query
	wp_reset_query();

	while(ob_end_flush());
}
add_shortcode( 'module8', 'generate_module8' );

function get_testimonial($list_id, $my_query,$index){
  //print_r($list_id);
  //Loop through each post in $my_query
  foreach ($my_query as $post){

      //Check if $list_id == $post->ID, if true generate the HTML code
      if($list_id == $post->ID){
      	
      	$name = get_post_meta( $post->ID, 'name', true );
    	$job = get_post_meta( $post->ID, 'job', true );
      	
      	if ($index == 1) {
          echo '<div class="item active">';
        }else{
          echo '<div class="item">';
        }
        ?>
        
         <div class="row wow" style="padding:80px 0px;">
                <div class="col-xs-12 col-sm-3" style="text-align:center">
                    <img src="<?php echo $post->post_thumbnail ?>" class="img-responsive img-circle img-thumbnail" alt="">

                </div>
                <div class="col-xs-12 col-sm-9 testimonial-panel">
                    <div class="testimonial_box" style="width:100%; text-align:left; padding:25px 20px 10px; background:#fff; color:#333; position:relative">
                        <h4><?php echo $post->post_title ?></h4>
                        <p><?php echo $post->post_content ?></p>
                        
                        <h5 style="color:#777"><?php if( !empty( $name ) ) { echo $name; } ?> <?php if( !empty( $job ) ) { ?><span style="font-size:12px">-<?php echo $job;  ?></span><?php } ?></h5>
                    </div>
                </div>
            </div>   
    	
    	
        <?php
        
        echo '</div>';
      }//end of if    
   }//end of foreach
}
?>