<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
This function is used to generate the fields for the slider modal
*/
function rve_get_slider_modal_fields(){
    
    //Query for post type slider and get all posts
    query_posts( array('post_type' => 'slider') );
    
    echo '<h3>Slider Module</h3>';
    echo '<p>Choose which slider posts to be available in this slider module.</p>';
    
    
	echo '<select name="slider-post" id="slider-post" onChange="enable_button(\'insert_slider\')">';
	echo '<option disabled selected value> ---- select an option from the list ---- </option>';
	
	// Loop through posts with type slider
	while ( have_posts() ) : the_post(); ?>
	    <option value="<?php echo get_the_ID() ?>" data-url="<?php urlencode(the_post_thumbnail_url()); ?>"><?php the_title_attribute(); ?></option>
	<?php endwhile;
	
	echo '</select>';
	echo '<input type="hidden" value="" id="slider-selection" name="slider-selection" />';
	
	// Reset Query
	wp_reset_query();?>
	
	<button type="button" id="insert_slider" onclick="insert_slider_post()" class="button">Add Slider Post</button>
    <br/><br/>
    <table id="slider-table">
    <tr>
       <th>ID</th>
       <th>Picture</th>
       <th>Slider Name</th>
       <th>Action</th>
     </tr>       

    </table>
    <br/>
    <a href="" class="button button-primary" id="portfolio_save_button">Save Settings</a>
    <?php
}

?>