<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
This function is used to generate the fields for the partners modal
*/
function rve_get_timeline_modal_fields(){

    //Query for post type partners and get all posts
    query_posts( array('post_type' => 'timeline') );
    
    echo '<h3>Timeline Module</h3>';
    echo '<p>Choose which timeline events to be available in this timeline module.</p>';
    
    
	echo '<select name="timeline-post" id="timeline-post" onChange="enable_button(\'insert_event\')">';
	echo '<option disabled selected> ---- select an option from the list ---- </option>';
	
	// Loop through all posts with type partners
	while ( have_posts() ) : the_post(); ?>
	    <option value="<?php echo get_the_ID() ?>" data-url="<?php urlencode(the_content()); ?>"><?php the_title_attribute(); ?></option>
	<?php endwhile;
	
	echo '</select>';
	echo '<input type="hidden" value="" id="timeline-selection" name="timeline-selection" />';
	
	// Reset Query
	wp_reset_query();?>
	
	<button id="insert_event" type="button" onclick="insert_timeline_post()" class="button">Add Timeline Event</button>
    <br/><br/>
    <table id="timeline-table">
    <tr>
       <th>ID</th>
       <th>TITLE</th>
       <th>Body Text</th>
       <th>Action</th>
     </tr>       

    </table>
    <br/>
    <a href="" class="button button-primary" id="timeline_save_button">Save Settings</a>
    <?php
}

?>