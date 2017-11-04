<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
This function is used to generate the fields for the testimonials modal
*/
function rve_get_testimonials_modal_fields(){
    
    //Query for post type testimonials and get all posts
    query_posts( array('post_type' => 'testimonials') );
    
    echo '<h3>Testimonials Module</h3>';
    echo '<p>Choose which testimonial posts to be available in this testimonial module.</p>';
    
    
	echo '<select name="testimonial-post" id="testimonial-post" onChange="enable_button(\'insert_testimonial\')">';
	echo '<option disabled selected> ---- select an option from the list ---- </option>';
	
	// Loop through posts with type testimonials
	while ( have_posts() ) : the_post(); ?>
	    <option value="<?php echo get_the_ID() ?>" data-url="<?php urlencode(the_content()); ?>"><?php the_title_attribute(); ?></option>
	<?php endwhile;
	
	echo '</select>';
	echo '<input type="hidden" value="" id="testimonial-selection" name="testimonial-selection" />';
	
	// Reset Query
	wp_reset_query();?>
	
	<button id="insert_testimonial" type="button" onclick="insert_testimonial_post()" class="button">Add Testimonial Post</button>
    <br/><br/>
    <table id="testimonial-table">
    <tr>
       <th>ID</th>
       <th>Title</th>
       <th>Content</th>
       <th>Action</th>
     </tr>       

    </table>
    <br/>
    <a href="" class="button button-primary" id="testimonial_save_button">Save Settings</a>
    <?php
}

?>