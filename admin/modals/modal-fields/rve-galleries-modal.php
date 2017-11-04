<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
This function is used to generate the fields for the galleries modal
*/
function rve_get_galleries_modal_fields(){

    //Query for post type galleries and get all posts
    query_posts( array('post_type' => 'galleries') );
    
    echo '<h3>Galleries Module</h3>';
    echo '<p>Choose which gallery posts to be available in this galleries module.</p>';
    
    
	echo '<select name="galleries-post" id="galleries-post" onChange="enable_button(\'insert_galleries\')">';
	echo '<option disabled selected> ---- select an option from the list ---- </option>';
	
	// Loop through posts with type galleries
	while ( have_posts() ) : the_post(); ?>
	    <option value="<?php echo get_the_ID() ?>" data-url="<?php urlencode(the_post_thumbnail_url()); ?>"><?php the_title_attribute(); ?></option>
	<?php endwhile;
	
	echo '</select>';
	echo '<input type="hidden" value="" id="galleries-selection" name="galleries-selection" />';
	
	// Reset Query
	wp_reset_query();?>
	
	<button id="insert_galleries" type="button" onclick="<?php echo esc_js('insert_galleries_post()') ?>" class="button">Add Gallery Post</button>
    <br/><br/>
    <table id="galleries-table">
    <tr>
       <th>ID</th>
       <th>Picture</th>
       <th>Gallery Name</th>
       <th>Action</th>
     </tr>       

    </table>
    <br/>
    <a href="" class="button button-primary" id="galleries_save_button">Save Settings</a>
    <?php
}

?>