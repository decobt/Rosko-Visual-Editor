<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
This function is used to generate the fields for the infoboxes modal
*/
function rve_get_infoboxes_modal_fields(){

    //Query for post type infoboxes and get all posts
    query_posts( array('post_type' => 'infoboxes') );
    
    echo '<h3>Infobox Module</h3>';
    echo '<p>Choose which infobox posts to be available in this infobox module.</p>';
    
    
	echo '<select name="infoboxes-post" id="infoboxes-post" onChange="enable_button(\'insert_infoboxes\')">';
	echo '<option disabled selected> ---- select an option from the list ---- </option>';
	
	// Loop through all posts with type infoboxes
	while ( have_posts() ) : the_post(); ?>
	    <option value="<?php echo get_the_ID() ?>" data-content="<?php urlencode(the_content()); ?>"><?php the_title_attribute(); ?></option>
	<?php endwhile;
	
	echo '</select>';
	echo '<input type="hidden" value="" id="infoboxes-selection" name="infoboxes-selection" />';
	
	// Reset Query
	wp_reset_query();?>
	
	<button id="insert_infoboxes" type="button" onclick="insert_infoboxes_post()" class="button">Add Infobox Post</button>
    <br/><br/>
    <table id="infoboxes-table">
    <tr>
       <th>ID</th>
       <th>Title</th>
       <th>Content</th>
       <th>Action</th>
     </tr>       

    </table>
    <br/>
    <a href="" class="button button-primary" id="infoboxes_save_button">Save Settings</a>
    <?php
}

?>