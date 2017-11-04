<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/rosko-visual-editor/
 * @since      1.0.0
 *
 * @package    rosko_visual_editor
 * @subpackage rosko_visual_editor/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    rosko_visual_editor
 * @subpackage rosko_visual_editor/admin
 * @author     Trajche Roshkoski <roskoskitrajce@gmail.com>
 */

class Rosko_Visual_Editor_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rosko_visual_editor    The ID of this plugin.
	 */
	private $rosko_visual_editor;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $rosko_visual_editor       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $rosko_visual_editor, $version ) {

		$this->rosko_visual_editor = $rosko_visual_editor;
		$this->version = $version;
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/modals/rve-modal-fields.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/rve-option-pages.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/rve-page-meta-boxes.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/rve-styling-meta-boxes.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function rve_admin_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in rosko_visual_editor_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The rosko_visual_editor_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 
		 //Get the current screen that is viewed by the user
	    global $current_screen;
	    
	    //If it's post, page type load the js and css files
	    if( $current_screen->base  == 'post' ) {
	        
	        // Registers and enqueues the required css.
	        wp_register_style( 'dragulaCSS', plugins_url( 'css/dragula-admin-style.css', __FILE__ ) );
	        wp_enqueue_style( 'dragulaCSS' );
	        
	        //wp_enqueue_style( $this->rosko_visual_editor, plugin_dir_url( __FILE__ ) . 'css/dragula.css', array(), $this->version, 'all' );
	    }

		//wp_enqueue_style( $this->rosko_visual_editor, plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function rve_admin_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in rosko_visual_editor_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The rosko_visual_editor_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 
		 //Get the current screen that is viewed by the user
	    global $current_screen;
	    
	    //If it's post, page type load the js and css files
	    if( $current_screen->base  == 'post' ) {
	        
	        // Registers and enqueues the required javascript.
	        wp_register_script( 'dragulaJS', plugins_url( 'js/dragula-admin.js', __FILE__ ), '', '', true  );
	        wp_register_script( 'exampleJS', plugins_url( 'js/rosko-visual-editor-admin.js', __FILE__ ), '', '', true  );
	        wp_enqueue_script( 'dragulaJS' );
	        wp_enqueue_script( 'exampleJS' );
	    }

		//wp_enqueue_script( $this->rosko_visual_editor, plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	
	/**
	 * 
	 * 	Set which boxes are visible and their locations on posts pages
	 * 
	 * 	This functions sets which boxes are available and hidden by default on post and page type
	 * 
	**/
	public function rve_set_user_metaboxes($user_id=NULL) {
	
	    // These are the metakeys we will need to update
	    $meta_key['order'] = 'meta-box-order_post';
	    $meta_key['hidden'] = 'metaboxhidden_post';
	
	    // So this can be used without hooking into user_register
	    if ( ! $user_id)
	        $user_id = get_current_user_id(); 
	
	    // Set the default order if it has not been set yet
	    if ( ! get_user_meta( $user_id, $meta_key['order'], true) ) {
	        $meta_value = array(
	            'side' => 'submitdiv,formatdiv,categorydiv,postimagediv',
	            'normal' => 'postexcerpt,tagsdiv-post_tag,postcustom,commentstatusdiv,commentsdiv,trackbacksdiv,slugdiv,authordiv,revisionsdiv',
	            'advanced' => '',
	        );
	        update_user_option( $user_id, $meta_key['order'], $meta_value );
	    }
	
	    // Set the default hiddens if it has not been set yet
	    if ( ! get_user_option( $user_id, $meta_key['hidden'], true) ) {
	        $meta_value = array('formatdiv','trackbacksdiv','commentstatusdiv','commentsdiv','slugdiv','authordiv','revisionsdiv','categorydiv','tagsdiv-post_tag','postexcerpt', 'postcustom');
	        update_user_meta( $user_id, $meta_key['hidden'], $meta_value );
	    }
	}
	
	/**
	 * 
	 * 	This function is used to add the visual editor box that will appear on post and page type
	 * 	The display place in normal and high in priority.
	 * 	Additionaly remove the editor box from both post and page type
	 * 
	**/
	public function rve_add_custom_meta() {
	    //add a box on post and page type that will be used to display the visual editor
	    add_meta_box( 'visual-editor-id','Visual Editor', 'rve_visual_editor_callback', array('page','post'), 'normal','high' );
	    
	    //remove the default editor from post and page type
	    remove_post_type_support( 'post', 'editor' );
	    remove_post_type_support( 'page', 'editor' );
	}
	
	/**
	 * 
	 * 	This function is used to save the value of the meta box input
	 * 
	**/
	public function rve_visual_editor_meta_save($post_id, $post ){
	    if(!isset( $_POST['meta-text']) || !wp_verify_nonce($_POST['meta_nonce'], basename(__FILE__))){
	        return $post_id;
	    }
	    $post_type = get_post_type_object( $post->post_type );
	
	    /* Check if the current user has permission to edit the post. */
	    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
	        return $post_id;
	        
	    //Get the value of the meta box from the $_POST and update it (save) in database  
	    $visual_editor_meta_box = esc_html($_POST['meta-text']);
	    update_post_meta( $post_id, 'meta-text', $visual_editor_meta_box);
	}
	
	/**
	 * 
	 * 	This function is used to get the stored meta box value instead of the content value
	 * 	The returned metabox value will be outputed on the front end and displayed to the front end user
	 * 
	**/
	public function rve_changeTheContent($content){
	    //get the post id
	    $post_id =  $GLOBALS['post']->ID;
	    //Find the stored metabox value
	    $stored_meta = get_post_meta($post_id, 'meta-text', true);
	    if($content!=''){
	       return $content;
	    }else{
	        //Return it instead of the content value
	        return urldecode($stored_meta);
	    }
	}
	
	/**
	 * 
	 * 	This function is used to force the layout of page type to 2 columns
	 * 	If this function returns 1, there will be only one column on that type
	 * 
	**/
	public function rve_change_layout_page() {
	    return 2;
	}
	
	/**
	 * 
	 * 	This is a helper function to add space if the title and content of a page or post are empty
	 * 	By default WP wont save pages or posts that have empty title and content
	 * 	This overwrites the option by adding spaces before the save function happens
	 * 
	**/
	public function rve_post_mask_empty($value){
	    if ( empty($value) ) {
	        return ' ';
	    }
	    return $value;
	}
	
	/**
	 * 
	 * 	This function compliments the post_mask_empty() function
	 * 	The purpose is after the post or page is saved with empty space character, 
	 * 	will remove it from the title and content of the post or page
	 * 	That way the post or page will be saved with empty values for title and content
	 * 
	**/
	public function rve_post_unmask_empty($data)
	{
	    if ( ' ' == $data['post_title'] ) {
	        $data['post_title'] = '';
	    }
	    if ( ' ' == $data['post_content'] ) {
	        $data['post_content'] = '';
	    }
	    return $data;
	}
	
	/**
	 * 
	 * 	This function is used as an ajax call for wordpress to get the post info and return it back as a response
	 * 
	**/
	public function rve_get_slider_posts_callback() {
	    $whatever = sanitize_text_field( $_POST['shortcode-data']);
	    $post_type = sanitize_text_field( $_POST['post-type']);
	
	        $proba = explode( ',', $whatever);
	        $ids = $proba;
	        $my_query = query_posts(array('post__in' => $ids,'post_type'=> $post_type,'order'=> 'ASC', 'orderby'=>'date'));
	        foreach ($my_query as $post) {
	            $post -> thumbnail = get_the_post_thumbnail_url($post->ID);
	        }
	        wp_send_json($my_query);
	
		wp_die(); // this is required to terminate immediately and return a proper response
	}
}

function rve_visual_editor_callback($post){
    
    //Create a nonce field that will be verified on save
    wp_nonce_field( basename( __FILE__ ), 'meta_nonce' );
    
    $options = get_option('visual_editor_options');
    
    //Get the stored value of the metabox input field
    $visual_editor_stored_meta = get_post_meta($post->ID, 'meta-text', true);
    
    ?>
    
    <!-- Modal content for TEXT AND PARAGRAPH -->
    <div id="my-content-id" class="modal">
		<div class="modal-content zoomIn">
			<div class="modal-header" id="grad">
		  		<p style="text-align:right;width:100%; margin:0"><span class="close" onclick="closemodal('my-content-id')">×</span></p>
            </div>
            <div class="modal-body">
	            <?php
	            $content = '';
	            $editor_args = array(
	                'editor_height'=>'300',
	                'editor_class'=>'bootstrap_editor'
	                );
	            $editor_id = 'mycustomeditor';
	            wp_editor( $content, $editor_id, $editor_args );
	            ?>
            	<br><a href="javascript:save_edit();" id="modal_save_button" class="button button-primary">Save Content</a>
            </div>
            <div class="modal-footer" id="grad">
            	<p style="color:white">Note: Don't forget to save the changes at the end by clicking on the above button.</p>
            </div>
         </div>
    </div>
    
    <!-- Modal content for Galleries -->
    <div id="my-parallax" class="modal">
	  	<!-- Modal content -->
		<div class="modal-content zoomIn">
			<div class="modal-header" id="grad">
		  		<p style="text-align:right;width:100%; margin:0"><span class="close" onclick="closeparallax('my-parallax')">×</span></p>
            </div>
            <div class="modal-body">
            	<?php rve_get_parallax_modal_fields() ?> 
            </div>
            <div class="modal-footer" id="grad">
            	<p style="color:white">Note: Don't forget to save the changes at the end by clicking on the above button.</p>
            </div>
        </div>
    </div>
    
    <!-- Modal content for SLIDER -->
    <div id="slider" class="modal">
	  	<!-- Modal content -->
		<div class="modal-content zoomIn">
			<div class="modal-header" id="grad">
		  		<p style="text-align:right;width:100%; margin:0"><span class="close" onclick="closeslider('slider')">×</span></p>
            </div>
            <div class="modal-body">
            	<?php rve_get_slider_modal_fields() ?> 
            </div>
            <div class="modal-footer" id="grad">
            	<p style="color:white">Note: Don't forget to save the changes at the end by clicking on the above button.</p>
            </div>
        </div>
    </div>
    
    <!-- Modal content for TESTIMONIALS -->
    <div id="testimonial" class="modal">
	  	<!-- Modal content -->
		<div class="modal-content zoomIn">
			<div class="modal-header" id="grad">
		  		<p style="text-align:right;width:100%; margin:0"><span class="close" onclick="closetestimonial('testimonial')">×</span></p>
            </div>
            <div class="modal-body">
            	<?php rve_get_testimonials_modal_fields() ?> 
            </div>
            <div class="modal-footer" id="grad">
            	<p style="color:white">Note: Don't forget to save the changes at the end by clicking on the above button.</p>
            </div>
        </div>
    </div>
    
    <!-- Modal content for Galleries -->
    <div id="galleries" class="modal">
	  	<!-- Modal content -->
		<div class="modal-content zoomIn">
			<div class="modal-header" id="grad">
		  		<p style="text-align:right;width:100%; margin:0"><span class="close" onclick="closegalleries('galleries')">×</span></p>
            </div>
            <div class="modal-body">
            	<?php rve_get_galleries_modal_fields() ?>
            </div>
            <div class="modal-footer" id="grad">
            	<p style="color:white">Note: Don't forget to save the changes at the end by clicking on the above button.</p>
            </div>
        </div>
    </div>
    
    <!-- Modal content for STAFF -->
    <div id="staff" class="modal">
	  	<!-- Modal content -->
		<div class="modal-content zoomIn">
			<div class="modal-header" id="grad">
		  		<p style="text-align:right;width:100%; margin:0"><span class="close" onclick="closestaff('staff')">×</span></p>
            </div>
            <div class="modal-body">
            	<?php rve_get_staff_modal_fields() ?> 
            </div>
            <div class="modal-footer" id="grad">
            	<p style="color:white">Note: Don't forget to save the changes at the end by clicking on the above button.</p>
            </div>
        </div>
    </div>
    
    <!-- Modal content for Timeline -->
    <div id="timeline" class="modal">
	  	<!-- Modal content -->
		<div class="modal-content zoomIn">
			<div class="modal-header" id="grad">
		  		<p style="text-align:right;width:100%; margin:0"><span class="close" onclick="closetimeline('timeline')">×</span></p>
            </div>
            <div class="modal-body">
            	<?php rve_get_timeline_modal_fields() ?> 
            </div>
            <div class="modal-footer" id="grad">
            	<p style="color:white">Note: Don't forget to save the changes at the end by clicking on the above button.</p>
            </div>
        </div>
    </div>
    
    <!-- Modal content for INFO BOXES -->
    <div id="infoboxes" class="modal">
	  	<!-- Modal content -->
		<div class="modal-content zoomIn">
			<div class="modal-header" id="grad">
		  		<p style="text-align:right;width:100%; margin:0"><span class="close" onclick="closeinfoboxes('infoboxes')">×</span></p>
		  	</div>
		  	<div class="modal-body">
            <?php rve_get_infoboxes_modal_fields() ?> 
            </div>
            <div class="modal-footer" id="grad">
            	<p style="color:white">Note: Don't forget to save the changes at the end by clicking on the above button.</p>
            </div>
        </div>
    </div>
    
    <!-- Modal content for Button -->
    <div id="my-button-id" class="modal">
	  	<!-- Modal content -->
		<div class="modal-content zoomIn">
			<div class="modal-header" id="grad">
		  		<p style="text-align:right;width:100%; margin:0"><span class="close" onclick="closebutton('my-button-id')">×</span></p>
            </div>
            <div class="modal-body">
            	<?php rve_get_button_modal_fields() ?>
            </div>
            <div class="modal-footer" id="grad">
            	<p style="color:white">Note: Don't forget to save the changes at the end by clicking on the above button.</p>
            </div>
        </div>
    </div>
    
    <?php
    //From here starts the display of the visual editor HTML code
    ?>
    <div class="parent">
    <div class="wrapper">
        
        <?php   //From here starts the display of the box that accepts drag and drop  ?>
        <div id="left-defaults" class="container">
            <?php rve_getTheCode( $visual_editor_stored_meta ); ?>
        </div>
      
      <?php   //From here starts the display of the box that has the source of available modules, feel free to add more    ?>
      <div id="right-defaults" class="container" style="overflow:scroll-y">
        <div class="module" data-shortcode="module1" data-content="">PARAGRAPH</div>
        
        <?php if(isset($options['parallax']) && $options['parallax']=='enabled'){ ?>
        	<div class="module" data-shortcode="module2" data-content="">PARALLAX</div>
        <?php } ?>
        <div class="module" data-shortcode="module3" data-content="">BUTTON</div>
        <?php if(isset($options['slider']) && $options['slider']=='enabled'){ ?>
        	<div class="module" data-shortcode="module4" data-content="">SLIDER</div>
        <?php } ?>
        <?php if(isset($options['galleries']) && $options['galleries']=='enabled'){ ?>
        	<div class="module" data-shortcode="module5" data-content="">GALLERY</div>
        <?php } ?>
        <?php if(isset($options['staff']) && $options['staff']=='enabled'){ ?>
        	<div class="module" data-shortcode="module6" data-content="">STAFF</div>
        <?php } ?>
        <?php if(isset($options['timeline']) && $options['timeline']=='enabled'){ ?>
        	<div class="module" data-shortcode="module7" data-content="">TIMELINE</div>
        <?php } ?>
        <?php if(isset($options['testimonials']) && $options['testimonials']=='enabled'){ ?>
        	<div class="module" data-shortcode="module8" data-content="">TESTIMONIALS</div>
        <?php } ?>
        <?php if(isset($options['infoboxes']) && $options['infoboxes']=='enabled'){ ?>
        	<div class="module" data-shortcode="module9" data-content="">INFO BOXES</div>
        <?php } ?>
        <div class="module" data-shortcode="module0" data-content="">SOCIAL</div>
      </div>
    </div>
    </div>
    
    <?php
    /*
    Hidden input used to hold the value of the dropped boxes and later to save it,
    once a box is dropped, the value of this input updates to the latest boxes in left-defaults
    */
    ?>
    <input type="hidden" name="meta-text" id="meta-text" value="<?php echo $visual_editor_stored_meta; ?>" />
    <?php
}



/*
This function is used to display the already saved values for the specif page or post
If the metabox has value that is not empty, it means modules have already been added
This function goes through the stored values and displays the saved modules
*/
function rve_getTheCode($values){
    
    //Set counter to zero, used for adding id attribute to the modules
    $counter = 0;
    
    //Because the values come from input field, the HTML entites have to be escaped, urldecode takes them back to normal
    $htmlvalues=urldecode($values);
    
    /*The long saved string is split using pattern, it finds everything between [ ], those excluded as well
    The results is an array $keywords full of data for each module and ready to be looped through and processed
    */
    $keywords = preg_split("/[\[\]]+/", $htmlvalues, -1);

    //For loop to go through each item in the previously generated array $keywords
    foreach ($keywords as $value) {
        
        //modules are 7 chars long, substr takes the first 7 and holds the value of the module in question
        $module= substr($value, 0, 7);
        
        //The rest of the string is data that belongs to the specific module, at this point we dont care how long or what value does it have
        $data = substr($value, 8);

        //Check which module is in question and generate the specific code for it
        switch($module){
            
            /*
            The code can be changed to the following lines if we want the front end HTML to be displayed in left-defaults (the visual editor box)
            case 'module1': do_shortcode('['.$value.']');break;
            case 'module2': do_shortcode('['.$value.']');break;
            case 'module3': do_shortcode('['.$value.']');break;
            case 'module4': do_shortcode('['.$value.']');break;
            case 'module5': do_shortcode('['.$value.']');break;
            case 'module6': do_shortcode('['.$value.']');break;
            */
            case 'module1': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module1" '.$data.' ondblclick="open_editor(\'my-content-id\',this)">PARAGRAPH</div>';break;
            case 'module2': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module2" '.$data.' ondblclick="open_parallax(\'my-parallax\',this)">PARALLAX</div>';break;
            case 'module3': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module3" '.$data.' ondblclick="open_button(\'my-button-id\',this)">BUTTON</div>';break;
            case 'module4': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module4" '.$data.' ondblclick="open_slider(\'slider\',this)">SLIDER</div>';break;
            case 'module5': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module5" '.$data.' ondblclick="open_galleries(\'galleries\',this)">GALLERY</div>';break;
            case 'module6': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module6" '.$data.' ondblclick="open_staff(\'staff\',this)">STAFF</div>';break;
            case 'module7': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module7" '.$data.' ondblclick="open_timeline(\'timeline\',this)">TIMELINE</div>';break;
            case 'module8': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module8" '.$data.' ondblclick="open_testimonial(\'testimonial\',this)">TESTIMONIALS</div>';break;
            case 'module9': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module9" '.$data.' ondblclick="open_infoboxes(\'infoboxes\',this)">INFO BOXES</div>';break;
            case 'module0': echo '<div class="module" id="in'.$counter++.'" data-shortcode="module0" '.$data.' >SOCIAL</div>';break;
            
        }
    }
}