<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function rve_generate_module5( $atts ) {
  
	//Check for attributes set in shortcode or assign defaults
	$post_id =  $GLOBALS['post']->post_title;
    $a = shortcode_atts( array(
        'data-content' => '',
    ), $atts );
    
  //get color and check if its set
	global $post;
	$gallery_color = get_post_meta($post->ID, 'gallery_color', true);
	if(!isset($gallery_color) || $gallery_color==''){
	    $gallery_color = '#2f2f2f';
	}

  //Query for posts and record the results
  $my_query = query_posts(array('post__in' => explode( ',', $a['data-content']),'post_type'=> 'galleries','order'=> 'ASC', 'orderby'=>'date'));

  //Search for additional thumbnail and link for each returned post in $my_query
  foreach ($my_query as $post) {
      $post -> post_thumbnail = get_the_post_thumbnail_url($post->ID, 'gallery-thumb');
      $post -> post_url = get_permalink($post->ID);
  }
    
  //Start baffer  
  ob_start();   
  //Echo container   
  ?>
  
  <section id="gallery-section" style="padding:80px 0px 60px; background:<?php echo $gallery_color; ?>">
	<div class="container-fluid">
	<div class="row">
	
	<?php
	// The Loop
	$list = explode( ',', $a['data-content']);
  //Loop through the array and generate gallery cards

  foreach ($list as $list_id){
    rve_get_gallery($list_id, $my_query);
  }
     
  //End echo of container   
  ?>
  
	</div></div></section>
 
  <?php
	// Reset Query
	wp_reset_query();
    
	//Return the buffer content and stop buffering
	while(ob_end_flush());
}
add_shortcode( 'module5', 'rve_generate_module5' );

function rve_get_gallery($list_id, $my_query){
  //print_r($list_id);
  //Loop through each post in $my_query
  foreach ($my_query as $post){

      //Check if $list_id == $post->ID, if true generate the HTML code
      if($list_id == $post->ID){
        ?>

        <div class="col-md-4 col-sm-6 portfolio-item">
                    <div class="panel panel-default" style="border-radius:0;border:none;">
                      <div class="panel-heading" style="padding:0; position:relative">
                        <a href="<?php echo $post->post_url ?>">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-search fa-3x"></i>
                            </div>
                        </div>
                         </a>
                         
                         <picture >
                          <!--[if IE 9]><video style="display: none;"><![endif]-->
                          <source srcset="<?php echo $post->post_thumbnail ?>" media="(min-width: 768px)"  class="img-responsive">
                          <source srcset="<?php echo $post->post_thumbnail ?>" media="(max-width: 767px)"  class="img-responsive">
                          <!--[if IE 9]></video><![endif]-->
                          <img alt="…"  class="img-responsive">
                        </picture>
                        </div>
                      <div class="panel-body">
                        <h4><?php echo $post->post_title ?></h4>
                        <p style="margin-bottom:0"><?php echo $post->post_content ?></p>
                      </div>
                    </div>
                </div>
        
        
        <?php
      }//end of if    
   }//end of foreach
}
?>