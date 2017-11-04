<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
This function is used to generate the fields for the staff modal
*/
function rve_get_staff_modal_fields(){

    //Query for post type staff and get all posts
    query_posts( array('post_type' => 'staff') );
    
    echo '<h3>Staff Module</h3>';
    echo '<p>Choose which staff posts to be available in this staff module.</p>';
    
    
	echo '<select name="staff-post" id="staff-post" onChange="enable_button(\'insert_staff\')">';
	echo '<option disabled selected> ---- select an option from the list ---- </option>';
	
	// Loop through posts with type staff
	while ( have_posts() ) : the_post(); ?>
	    <option value="<?php echo get_the_ID() ?>" data-url="<?php urlencode(the_post_thumbnail_url()); ?>"><?php the_title_attribute(); ?></option>
	<?php endwhile;
	
	echo '</select>';
	echo '<input type="hidden" value="" id="staff-selection" name="staff-selection" />';
	
	// Reset Query
	wp_reset_query();?>
	
	<button id="insert_staff" type="button" onclick="insert_staff_post()" class="button">Add Staff Post</button>
    <br/><br/>
    <table id="staff-table">
    <tr>
       <th>ID</th>
       <th>Picture</th>
       <th>Person's Name</th>
       <th>Action</th>
     </tr>       

    </table>
    <br/>
    <a href="" class="button button-primary" id="staff_save_button">Save Settings</a>
    <?php
}

?>