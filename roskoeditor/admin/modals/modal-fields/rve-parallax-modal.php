<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
This function is used to generate the fields for the parallax modal
*/
function rve_get_parallax_modal_fields(){

    //Query for post type parallax and get all posts
    query_posts( array('post_type' => 'parallax') );
    
    echo '<h3>Parallax Module</h3>';
    echo '<p>Choose which parallax posts to be available in this parallax module.</p>';
    
    
	echo '<select name="parallax-post" id="parallax-post">';
	echo '<option disabled selected value> ---- select an option from the list ---- </option>';
	
	// Loop through posts with type parallax
	while ( have_posts() ) : the_post(); ?>
	    <option value="<?php echo get_the_ID() ?>"><?php the_title_attribute(); ?></option>
	<?php endwhile;
	
	echo '</select>';
	
	// Reset Query
	wp_reset_query();?>
    
    <br/><br/>
    <a href="" class="button button-primary" id="parallax_save_button">Save Settings</a>
    <?php
}

?>