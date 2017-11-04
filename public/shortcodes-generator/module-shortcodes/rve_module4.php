<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function rve_generate_module4( $atts ) {
  
	//Check for attributes set in shortcode or assign defaults
	$post_id =  $GLOBALS['post']->post_title;
    $a = shortcode_atts( array(
        'data-content' => '',
    ), $atts );

  //Query for posts and record the results
  $my_query = query_posts(array('post__in' => explode( ',', $a['data-content']),'post_type'=> 'slider','order'=> 'ASC', 'orderby'=>'date'));

  //Search for additional thumbnail and link for each returned post in $my_query
  foreach ($my_query as $post) {
      $post -> post_thumbnail = get_the_post_thumbnail_url($post->ID, 'slider-thumb');
      $post -> post_url = get_permalink($post->ID);
  }
    
  //Start baffer  
  ob_start();   
  //Echo container   
  $list = explode( ',', $a['data-content']);
  ?>
  
<div id="carousel-second-generic" class="carousel slide carousel-fade" data-ride="carousel" style="margin:auto;overflow:hidden">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    
    <?php
    $index = 0;
	  foreach ($list as $list_id){
	    if($index == 0){
	      echo '<li data-target="#carousel-second-generic" data-slide-to="'.$index.'" class="active"></li>';
	      $index = $index + 1;
	    }else{
	      echo '<li data-target="#carousel-second-generic" data-slide-to="'.$index.'"></li>';
	      $index = $index + 1;
	    }
	  }
    ?>

  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    
	<?php
	// The Loop

	//Loop through the array and generate gallery cards

  $index = 1;
	foreach ($list as $list_id){
	    rve_get_slider($list_id, $my_query, $index);
	    $index = $index + 1;
	}
     
	  //End echo of container   
	  ?>
  
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-second-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-second-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  <?php
	// Reset Query
	wp_reset_query();
	
	//Return the buffer content and stop buffering
	while(ob_end_flush());
}
add_shortcode( 'module4', 'rve_generate_module4' );

function rve_get_slider($list_id, $my_query, $index){
  //print_r($list_id);
  //Loop through each post in $my_query

  foreach ($my_query as $post){

      //Check if $list_id == $post->ID, if true generate the HTML code
      if($list_id == $post->ID){

        if ($index == 1) {
          echo '<div class="item active">';
        }else{
          echo '<div class="item">';
        }
        
        ?>

                        <picture >
                          <!--[if IE 9]><video style="display: none;"><![endif]-->
                          <source srcset="<?php echo $post->post_thumbnail ?>" media="(min-width: 768px)"  class="img-responsive">
                          <source srcset="<?php echo $post->post_thumbnail ?>" media="(max-width: 767px)"  class="img-responsive">
                          <!--[if IE 9]></video><![endif]-->
                          <img alt="…"  class="img-responsive">
                        </picture>
            <div class="carousel-caption hidden-xs">
              <h2 class="wow"><?php echo $post->post_title ?></h2>
              <h5 class="subHeading wow"><?php echo $post->post_content ?></h5> 
            </div>
          </div> 
    
        <?php
        
      }//end of if    
   }//end of foreach
}

?>