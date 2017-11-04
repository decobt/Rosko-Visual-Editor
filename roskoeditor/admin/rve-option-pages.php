<?php
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/*
This function is used to define the main option(settings) page for the visual editor
The page will appear on the dashboard as the last option
*/
function rve_add_option_page(){
    add_menu_page(
        'Visual Editor Options',
        'Visual Editor',
        'manage_options',
        'visual_editor',
        'rve_visual_editor_settings_callback',
        'dashicons-layout'
        );
}
add_action('admin_menu','rve_add_option_page', 9);



/*
This function is used to enable all the subpages used for the visual editor modules
The functions checks if each subpage is enabled in the main option page for the visual editor
*/
function rve_add_subpages(){
    $options = get_option('visual_editor_options');

        //Check if parallax is enabled and if it is, enable the custom post type
        if(isset($options['parallax']) && $options['parallax']=='enabled'){
            $labels = array(
        		'name'               => _x( 'Parallax', 'post type general name' ),
        		'singular_name'      => _x( 'Parallax', 'post type singular name' ),
        		'menu_name'          => _x( 'Parallax', 'admin menu'),
        		'name_admin_bar'     => _x( 'Parallax', 'add new on admin bar' ),
        		'add_new'            => _x( 'Add New Parallax', 'button add new text' ),
        		'add_new_item'       => __( 'Add New Parallax', 'title on new page' ),
        		'new_item'           => __( 'New Parallax'),
        		'edit_item'          => __( 'Edit Parallax', 'link edit on admin bar' ),
        		'view_item'          => __( 'View Parallax', 'link view on admin bar' ),
        		'all_items'          => __( 'Parallax', 'text om admin menu on the left' ),
        		'search_items'       => __( 'Search Parallax', 'search button name' ),
        		'parent_item_colon'  => __( 'Parent Parallax:' ),
        		'not_found'          => __( 'No Parallax found.' ),
        		'not_found_in_trash' => __( 'No Parallax found in Trash.'),
        		'featured_image'     => __( 'Parallax Image'),
        		'set_featured_image' => __( 'Set Parallax Image'),
        		'remove_featured_image' => __( 'Remove Parallax Image')
        	);
            
            $args = array(
                'public' => true,
                'labels'  => $labels,
                'show_in_menu' => 'visual_editor',
                'menu_icon'   => 'dashicons-format-image',
                'publicly_queryable' => false,
                'supports' => array( 'title', 'editor', 'thumbnail' )
            );
            register_post_type( 'parallax', $args );
        }else{
            unset( $wp_post_types['parallax'] );
        }
        
        //Check if slider is enabled and if it is, enable the custom post type
        if(isset($options['slider']) && $options['slider']=='enabled'){
            $labels = array(
        		'name'               => _x( 'Sliders', 'post type general name' ),
        		'singular_name'      => _x( 'Slider', 'post type singular name' ),
        		'menu_name'          => _x( 'Slider', 'admin menu'),
        		'name_admin_bar'     => _x( 'Sliders', 'add new on admin bar' ),
        		'add_new'            => _x( 'Add New Slider', 'button add new text' ),
        		'add_new_item'       => __( 'Add New Slider', 'title on new page' ),
        		'new_item'           => __( 'New Slider'),
        		'edit_item'          => __( 'Edit Slider', 'link edit on admin bar' ),
        		'view_item'          => __( 'View Slider', 'link view on admin bar' ),
        		'all_items'          => __( 'Slider', 'text om admin menu on the left' ),
        		'search_items'       => __( 'Search Sliders', 'search button name' ),
        		'parent_item_colon'  => __( 'Parent Sliders:' ),
        		'not_found'          => __( 'No Sliders found.' ),
        		'not_found_in_trash' => __( 'No Sliders found in Trash.'),
        		'featured_image'     => __( 'Slider Image'),
        		'set_featured_image' => __( 'Set Slider Image'),
        		'remove_featured_image' => __( 'Remove Slider Image')
        	);
            
            $args = array(
                'public' => true,
                'labels'  => $labels,
                'show_in_menu' => 'visual_editor',
                'menu_icon'   => 'dashicons-camera',
                'publicly_queryable' => false,
                'supports' => array( 'title', 'editor', 'thumbnail' )
            );
            register_post_type( 'slider', $args );
        }else{
            unset( $wp_post_types['slider'] );
        }
        
        //Check if galleries is enabled and if it is, enable the custom post type
        
        if(isset($options['galleries']) && $options['galleries']=='enabled'){
            $labels = array(
        		'name'               => _x( 'Galleries', 'post type general name' ),
        		'singular_name'      => _x( 'Galleries', 'post type singular name' ),
        		'menu_name'          => _x( 'Galleries', 'admin menu'),
        		'name_admin_bar'     => _x( 'Galleries', 'add new on admin bar' ),
        		'add_new'            => _x( 'Add New Gallery', 'button add new text' ),
        		'add_new_item'       => __( 'Add New Gallery', 'title on new page' ),
        		'new_item'           => __( 'New Gallery'),
        		'edit_item'          => __( 'Edit Gallery', 'link edit on admin bar' ),
        		'view_item'          => __( 'View Gallery', 'link view on admin bar' ),
        		'all_items'          => __( 'Galleries', 'text om admin menu on the left' ),
        		'search_items'       => __( 'Search Galleries', 'search button name' ),
        		'parent_item_colon'  => __( 'Parent Galleries:' ),
        		'not_found'          => __( 'No Galleries found.' ),
        		'not_found_in_trash' => __( 'No Galleries found in Trash.'),
        		'featured_image'     => __( 'Gallery Image'),
        		'set_featured_image' => __( 'Set Gallery Image'),
        		'remove_featured_image' => __( 'Remove Gallery Image')
        	);
        	
            $args = array(
                'public' => true,
                'labels'  => $labels,
                'show_in_menu' => 'visual_editor',
                'menu_icon'   => 'dashicons-format-gallery',
                'supports' => array( 'title', 'editor', 'thumbnail')
            );
            register_post_type( 'galleries', $args );
        }else{
            unset( $wp_post_types['galleries'] );
        }
        
        //Check if staff is enabled and if it is, enable the custom post type
        if(isset($options['staff']) && $options['staff']=='enabled'){
            $labels = array(
        		'name'               => _x( 'Staff', 'post type general name' ),
        		'singular_name'      => _x( 'Staff', 'post type singular name' ),
        		'menu_name'          => _x( 'Staff', 'admin menu'),
        		'name_admin_bar'     => _x( 'Staff', 'add new on admin bar' ),
        		'add_new'            => _x( 'Add New Staff', 'button add new text' ),
        		'add_new_item'       => __( 'Add New Staff', 'title on new page' ),
        		'new_item'           => __( 'New Staff'),
        		'edit_item'          => __( 'Edit Staff', 'link edit on admin bar' ),
        		'view_item'          => __( 'View Staff', 'link view on admin bar' ),
        		'all_items'          => __( 'Staff', 'text om admin menu on the left' ),
        		'search_items'       => __( 'Search Staff', 'search button name' ),
        		'parent_item_colon'  => __( 'Parent Staff:' ),
        		'not_found'          => __( 'No Staff found.' ),
        		'not_found_in_trash' => __( 'No Staff found in Trash.'),
        		'featured_image'     => __( 'Staff Image'),
        		'set_featured_image' => __( 'Set Staff Image'),
        		'remove_featured_image' => __( 'Remove Staff Image')
        	);
        	
            $args = array(
                'public' => true,
                'labels'  => $labels,
                'show_in_menu' => 'visual_editor',
                'menu_icon'   => 'dashicons-id',
                'supports' => array( 'title', 'editor', 'thumbnail' )
            );
            register_post_type( 'staff', $args );
        }else{
            unset( $wp_post_types['staff'] );
        }
        
        //Check if timeline is enabled and if it is, enable the custom post type
        if(isset($options['timeline']) && $options['timeline']=='enabled'){
            $labels = array(
        		'name'               => _x( 'Timeline', 'post type general name' ),
        		'singular_name'      => _x( 'Timeline', 'post type singular name' ),
        		'menu_name'          => _x( 'Timeline', 'admin menu'),
        		'name_admin_bar'     => _x( 'Timeline', 'add new on admin bar' ),
        		'add_new'            => _x( 'Add New Timeline Event', 'button add new text' ),
        		'add_new_item'       => __( 'Add New Timeline Event', 'title on new page' ),
        		'new_item'           => __( 'New Timeline Event'),
        		'edit_item'          => __( 'Edit Timeline Event', 'link edit on admin bar' ),
        		'view_item'          => __( 'View Timeline Event', 'link view on admin bar' ),
        		'all_items'          => __( 'Timeline', 'text om admin menu on the left' ),
        		'search_items'       => __( 'Search Timeline', 'search button name' ),
        		'parent_item_colon'  => __( 'Parent Timeline:' ),
        		'not_found'          => __( 'No Timeline Events found.' ),
        		'not_found_in_trash' => __( 'No Timeline Events found in Trash.'),
        		'featured_image'     => __( 'Timeline Image'),
        		'set_featured_image' => __( 'Set Timeline Image'),
        		'remove_featured_image' => __( 'Remove Timeline Image')
        	);
        	
            $args = array(
                'public' => true,
                'labels'  => $labels,
                'show_in_menu' => 'visual_editor',
                'menu_icon'   => 'dashicons-groups',
                'publicly_queryable' => false,
                'supports' => array( 'title', 'editor' )
            );
            register_post_type( 'timeline', $args );
        }else{
            unset( $wp_post_types['timeline'] );
        }
        
        //Check if testimonials is enabled and if it is, enable the custom post type
        if(isset($options['testimonials']) && $options['testimonials']=='enabled'){
            $labels = array(
        		'name'               => _x( 'Testimonial', 'post type general name' ),
        		'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
        		'menu_name'          => _x( 'Testimonial', 'admin menu'),
        		'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar' ),
        		'add_new'            => _x( 'Add New Testimonial', 'button add new text' ),
        		'add_new_item'       => __( 'Add New Testimonial', 'title on new page' ),
        		'new_item'           => __( 'New Testimonial'),
        		'edit_item'          => __( 'Edit Testimonial', 'link edit on admin bar' ),
        		'view_item'          => __( 'View Testimonial', 'link view on admin bar' ),
        		'all_items'          => __( 'Testimonials', 'text om admin menu on the left' ),
        		'search_items'       => __( 'Search Testimonials', 'search button name' ),
        		'parent_item_colon'  => __( 'Parent Testimonials:' ),
        		'not_found'          => __( 'No Testimonials found.' ),
        		'not_found_in_trash' => __( 'No Testimonials found in Trash.'),
        		'featured_image'     => __( 'Testimonial Image'),
        		'set_featured_image' => __( 'Set Testimonial Image'),
        		'remove_featured_image' => __( 'Remove Testimonial Image')
        	);
        	
            $args = array(
                'public' => true,
                'labels'  => $labels,
                'show_in_menu' => 'visual_editor',
                'menu_icon'   => 'dashicons-format-quote',
                'publicly_queryable' => false,
                'supports' => array( 'title', 'editor', 'thumbnail' )
            );
            register_post_type( 'testimonials', $args );
        }else{
            unset( $wp_post_types['testimonials'] );
        }
        
        //Check if infoboxes is enabled and if it is, enable the custom post type
        if(isset($options['infoboxes']) && $options['infoboxes']=='enabled'){
            $labels = array(
        		'name'               => _x( 'Info box', 'post type general name' ),
        		'singular_name'      => _x( 'Info box', 'post type singular name' ),
        		'menu_name'          => _x( 'Info box', 'admin menu'),
        		'name_admin_bar'     => _x( 'Info box', 'add new on admin bar' ),
        		'add_new'            => _x( 'Add New Info box', 'button add new text' ),
        		'add_new_item'       => __( 'Add New Info box', 'title on new page' ),
        		'new_item'           => __( 'New Info box'),
        		'edit_item'          => __( 'Edit Info box', 'link edit on admin bar' ),
        		'view_item'          => __( 'View Info box', 'link view on admin bar' ),
        		'all_items'          => __( 'Info Boxes', 'text om admin menu on the left' ),
        		'search_items'       => __( 'Search Info boxes', 'search button name' ),
        		'parent_item_colon'  => __( 'Parent Info boxes:' ),
        		'not_found'          => __( 'No Info boxes found.' ),
        		'not_found_in_trash' => __( 'No Info boxes found in Trash.'),
        		'featured_image'     => __( 'Info box Image'),
        		'set_featured_image' => __( 'Set Info box Image'),
        		'remove_featured_image' => __( 'Remove Info box Image')
        	);
        	
            $args = array(
                'public' => true,
                'labels'  => $labels,
                'show_in_menu' => 'visual_editor',
                'menu_icon'   => 'dashicons-feedback',
                'publicly_queryable' => false
            );
            register_post_type( 'infoboxes', $args );
        }else{
            unset( $wp_post_types['infoboxes'] );
        }
        
        // Clear the permalinks after the post types have been registered
        flush_rewrite_rules();
}
add_action( 'init', 'rve_add_subpages' );



/*
This function is used to generate the things that will be displayed on the main option page for the visual editor
All fields and options are set here
*/
function rve_visual_editor_settings_callback(){
    
    //If settings are updated fire init and check what pages are enabled in the settings
    if(isset($_GET['settings-updated'])){
        if($_GET['settings-updated'] == true){
            do_action('init');
        }
    }
    
    if(isset($_GET['tab'])){
        $active_tab=sanitize_text_field($_GET['tab']);
    }else{
        $active_tab='editor_settings';
    }
    
    //The HTML code that will appear on the page ?>
     <div class="wrap">
         
        <div id="grad" style="padding:30px 40px; border-bottom:8px solid #3498db;">
        <div id="icon-options-general"></div>
        <h1 style="color:#fff"><strong>Rosko Visual Editor Options</strong></h1>
        <?php settings_errors(); ?>   
        <p style="color:#fff"><span>Custom designed visual editor for faster theme development. Use the options below to enable or disable features!</span></p>
        </div>
        
        <div id="visual-editor" style="background:#fff; padding:20px 40px; border:1px solid #ccc">
            
        <h2 class="nav-tab-wrapper">
            <a href="?page=visual_editor&tab=editor_settings" class="nav-tab plugin-nav-tab <?php echo $active_tab == 'editor_settings' ? 'nav-tab-active' : ''; ?>">Visual Editor Settings</a>
            <a href="?page=visual_editor&tab=social_options" class="nav-tab plugin-nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>">Social Media Options</a>
            <a href="?page=visual_editor&tab=about_options" class="nav-tab plugin-nav-tab <?php echo $active_tab == 'about_options' ? 'nav-tab-active' : ''; ?>">About</a>
        </h2>   
        
        <div style="background:#f1f1f1; padding:20px;border: 1px solid #ccc; border-top:none;">
        <form method="post" action="options.php">
            
            <?php
            if($active_tab=='editor_settings'){
                    echo '<br/>';
                    settings_fields('visual_editor_options');
                    do_settings_sections('visual_editor_options');
                    
                    submit_button();
            } 
            if($active_tab=='social_options'){
                    echo '<br/>';
                    settings_fields('social_options');
                    do_settings_sections('social_options');
                    
                    submit_button();
            } 
            if($active_tab=='about_options'){
                echo "<br/><h1>About the Plugin</h1>";
                echo "<p>Drag and Drop Visual editor with 10 available modules for easy development of any site.</p>";
                echo "<h1>About the Author</h1>";
                echo "<p>During my studies at the Faculty of Informatics and Communication Technologies, I have had the opportunity to hone my skills with HTML5, CSS, JavaScript, PHP and MySQL. Inside the classroom, I have committed myself to academic excellence. Beyond the classroom, I worked for IDS Group as a web developer and I have two more years of experience as a freelancer. Examples of my work are available on my online portfolio at www.trajcheroshkoski.com.</p>";
            } 

            ?>
            
            </form></div>
        </div>
        
        <div id="grad" class="footer-credit" style="padding:30px 40px; border-top:8px solid #3498db;">
            <p style="color:#fff">This plugin was made by <a title="Trajche Roshkoski" href="http://www.trajcheroshkoski.com/" target="_blank" style="color:#fff">Trajche Roshkoski</a>.</p>
         </div>  
    </div>    
    <?php
}



/*
This function is used to initialize the options for the visual editor
They will be stored in visual_editor_options
*/
function rve_visual_editor_options_init(){
    
    //If option does not exist, create it with the default settings
    if( false === add_option( 'visual_editor_options' ) ) {
        $defaults = array(
            'parallax'=>'enabled',
            'slider'=>'enabled',
            'social'=>'enabled',
            'galleries'=>'enabled',
            'staff'=>'enabled',
            'testimonials'=>'enabled',
            'timeline'=>'enabled',
            'infoboxes'=>'enabled',
            );
        add_option('visual_editor_options', $defaults);
    }
    
    //If option does not exist, create it with the default settings
    if( false === add_option( 'social_options' ) ) {
        $defaults = array(
            'facebook'=>'',
            'twitter'=>'',
            'linkedin'=>'',
            'youtube'=>'',
            'google'=>'',
            'snapchat'=>'',
            'mail'=>'',
            );
        add_option('social_options', $defaults);
    }
    
    //Add section on the page with name Available Visual editor modules
    add_settings_section(
        'general_section',
        'Available Visual Editor Modules',
        'rve_general_section_callback',
        'visual_editor_options'
    );
    
    //Add section on the page with name Available Social Media Options
    add_settings_section(
        'social_section',
        'Available Social Media Options',
        'rve_social_section_callback',
        'social_options'
    );
    
    //Add a field for Parallax
    add_settings_field(
        'parallax',
        'Parallax',
        'rve_parallax_callback',
        'visual_editor_options',
        'general_section'
    );
    
    //Add a field for Slider
    add_settings_field(
        'slider',
        'Slider',
        'rve_slider_callback',
        'visual_editor_options',
        'general_section'
    );
    
    //Add a field for Gallery
    add_settings_field(
        'galleries',
        'Galleries',
        'rve_galleries_callback',
        'visual_editor_options',
        'general_section'
    );
    
    //Add a field for Staff
    add_settings_field(
        'staff',
        'Staff',
        'rve_staff_callback',
        'visual_editor_options',
        'general_section'
    );
    
    //Add a field for Timeline
    add_settings_field(
        'timeline',
        'Timeline',
        'rve_timeline_callback',
        'visual_editor_options',
        'general_section'
    );
    
    //Add a field for testimonials
    add_settings_field(
        'testimonials',
        'Testimonials',
        'rve_testimonials_callback',
        'visual_editor_options',
        'general_section'
    );
    
    //Add a field for infoboxes
    add_settings_field(
        'infoboxes',
        'Info Boxes',
        'rve_infoboxes_callback',
        'visual_editor_options',
        'general_section'
    );
    
    //Add a field for Facebook
    add_settings_field(
        'facebook',
        'Facebook',
        'rve_facebook_callback',
        'social_options',
        'social_section'
    );
    
    //Add a field for Twitter
    add_settings_field(
        'twitter',
        'Twitter',
        'rve_twitter_callback',
        'social_options',
        'social_section'
    );
    
    //Add a field for Linkedin
    add_settings_field(
        'linkedin',
        'Linkedin',
        'rve_linkedin_callback',
        'social_options',
        'social_section'
    );
    
    //Add a field for Youtube
    add_settings_field(
        'youtube',
        'Youtube',
        'rve_youtube_callback',
        'social_options',
        'social_section'
    );
    
    //Add a field for Google
    add_settings_field(
        'google',
        'Google Plus',
        'rve_google_callback',
        'social_options',
        'social_section'
    );
    
    //Add a field for Snapchat
    add_settings_field(
        'snapchat',
        'Snapchat',
        'rve_snapchat_callback',
        'social_options',
        'social_section'
    );
    
    //Add a field for Mail
    add_settings_field(
        'mail',
        'Email',
        'rve_mail_callback',
        'social_options',
        'social_section'
    );
    
    //Register setting for modules
    register_setting('visual_editor_options','parallax');
    register_setting('visual_editor_options','slider');
    register_setting('visual_editor_options','galleries');
    register_setting('visual_editor_options','staff');
    register_setting('visual_editor_options','timeline');
    register_setting('visual_editor_options','testimonials');
    register_setting('visual_editor_options','infoboxes');
    
    //Register setting for social media
    register_setting('social_options','facebook', 'rve_sanitize_input');
    register_setting('social_options','twitter', 'rve_sanitize_input');
    register_setting('social_options','linkedin', 'rve_sanitize_input');
    register_setting('social_options','google', 'rve_sanitize_input');
    register_setting('social_options','youtube', 'rve_sanitize_input');
    register_setting('social_options','snapchat', 'rve_sanitize_input');
    register_setting('social_options','mail', 'rve_sanitize_input');

    register_setting(
        'visual_editor_options',
        'visual_editor_options'
    );
    
    register_setting(
        'social_options',
        'social_options'
    );
}
add_action('admin_init','rve_visual_editor_options_init');

function rve_sanitize_input($input){
    return sanitize_text_field($input);
}

//Callback function for the general section, used to display description for the section
function rve_general_section_callback(){
    echo '<p style="color:#555">Choose what options to be enabled and available in the site. By default all settings are not set, you have to enable them in order to use them in the live editor.</p>';
}

//Callback function for the general section, used to display description for the section
function rve_social_section_callback(){
    echo '<p style="color:#555">Choose what social options to be enabled and available in the site. Input the links in the fields below.</p>';
}

/*
This function is used to display the option input for the facebook setting
*/
function rve_facebook_callback(){
    $options = get_option('social_options');
    ?>
        <input class="form-control" name="social_options[facebook]" value="<?php if ( isset ( $options['facebook'] ) ) echo $options['facebook']; ?>" />
    <?php
}

/*
This function is used to display the option input for the twitter setting
*/
function rve_twitter_callback(){
    $options = get_option('social_options');
    ?>
        <input class="form-control" name="social_options[twitter]" value="<?php if ( isset ( $options['twitter'] ) ) echo $options['twitter']; ?>" />
    <?php
}

/*
This function is used to display the option input for the linkedin setting
*/
function rve_linkedin_callback(){
    $options = get_option('social_options');
    ?>
        <input class="form-control" name="social_options[linkedin]" value="<?php if ( isset ( $options['linkedin'] ) ) echo $options['linkedin']; ?>" />
    <?php
}

/*
This function is used to display the option input for the youtube setting
*/
function rve_youtube_callback(){
    $options = get_option('social_options');
    ?>
        <input class="form-control" name="social_options[youtube]" value="<?php if ( isset ( $options['youtube'] ) ) echo $options['youtube']; ?>" />
    <?php
}

/*
This function is used to display the option input for the google setting
*/
function rve_google_callback(){
    $options = get_option('social_options');
    ?>
        <input class="form-control" name="social_options[google]" value="<?php if ( isset ( $options['google'] ) ) echo $options['google']; ?>" />
    <?php
}

/*
This function is used to display the option input for the snapchat setting
*/
function rve_snapchat_callback(){
    $options = get_option('social_options');
    ?>
        <input class="form-control" name="social_options[snapchat]" value="<?php if ( isset ( $options['snapchat'] ) ) echo $options['snapchat']; ?>" />
    <?php
}

/*
This function is used to display the option input for the mail setting
*/
function rve_mail_callback(){
    $options = get_option('social_options');
    ?>
        <input class="form-control" name="social_options[mail]" value="<?php if ( isset ( $options['mail'] ) ) echo $options['mail']; ?>" />
    <?php
}

/*
This function is used to display the option input for the parallax setting
*/
function rve_parallax_callback(){
    $options = get_option('visual_editor_options');
    if(isset($options['parallax'])==0){?>
        <select name="visual_editor_options[parallax]">
        <option disabled selected value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['parallax']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['parallax']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }else{ ?>
        <select name="visual_editor_options[parallax]">
        <option disabled value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['parallax']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['parallax']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }
}



/*
This function is used to display the option input for the slider setting
*/
function rve_slider_callback(){
    $options = get_option('visual_editor_options');
    if(isset($options['slider'])==0){?>
        <select name="visual_editor_options[slider]">
        <option disabled selected value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['slider']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['slider']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }else{ ?>
        <select name="visual_editor_options[slider]">
        <option disabled value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['slider']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['slider']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }
}



/*
This function is used to display the option input for the galleries setting
*/
function rve_galleries_callback(){
    $options = get_option('visual_editor_options');
    if(isset($options['galleries'])==0){?>
    <select name="visual_editor_options[galleries]">
        <option disabled selected value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['galleries']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['galleries']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
    </select>
    <?php }else{ ?>
    <select name="visual_editor_options[galleries]">
        <option disabled value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['galleries']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['galleries']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
    </select>
    <?php }
}



/*
This function is used to display the option input for the staff setting
*/
function rve_staff_callback(){
    $options = get_option('visual_editor_options');
    if(isset($options['staff'])==0){?>
        <select name="visual_editor_options[staff]">
        <option disabled selected value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['staff']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['staff']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }else{?>
        <select name="visual_editor_options[staff]">
        <option disabled value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['staff']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['staff']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }
}



/*
This function is used to display the option input for the timeline setting
*/
function rve_timeline_callback(){
    $options = get_option('visual_editor_options');
    if(isset($options['timeline'])==0){?>
        <select name="visual_editor_options[timeline]">
        <option disabled selected value> --- select an option from the list --- </option>
        <option value="enabled" <?php if($options['timeline']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['timeline']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }else{ ?>
        <select name="visual_editor_options[timeline]">
        <option disabled value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['timeline']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['timeline']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }
}



/*
This function is used to display the option input for the testimonials setting
*/
function rve_testimonials_callback(){
    $options = get_option('visual_editor_options');
    if(isset($options['testimonials'])==0){?>
        <select name="visual_editor_options[testimonials]">
        <option disabled selected value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['testimonials']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['testimonials']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }else{ ?>
        <select name="visual_editor_options[testimonials]">
        <option disabled value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['testimonials']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['testimonials']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }
}



/*
This function is used to display the option input for the infoboxes setting
*/
function rve_infoboxes_callback(){
    $options = get_option('visual_editor_options');
    if(isset($options['infoboxes'])==0){?>
        <select name="visual_editor_options[infoboxes]">
        <option disabled selected value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['infoboxes']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['infoboxes']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }else{ ?>
        <select name="visual_editor_options[infoboxes]">
        <option disabled value> ---- select an option from the list ---- </option>
        <option value="enabled" <?php if($options['infoboxes']=='enabled'){ echo 'selected';}; ?> >Enabled</option>';
        <option value="disabled" <?php if($options['infoboxes']=='disabled'){ echo 'selected';}; ?> >Disabled</option>';
        </select>
    <?php }
}


/*
Add styles to admin pages in admin_head for the visual editor option page
*/
function rve_custom_admin_head() {
    if ( is_user_logged_in() ) {
	echo '<style>
	#grad {
        background: #2980b9; /* For browsers that do not support gradients */
        background: -webkit-linear-gradient(left, #2980b9, #3498db); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(right, #2980b9, #3498db); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(right, #2980b9, #3498db); /* For Firefox 3.6 to 15 */
        background: linear-gradient(to right, #2980b9, #3498db); /* Standard syntax */
    }
    .plugin-nav-tab{padding:15px 25px;margin-left:0px;}
	#visual-editor .button-primary, .modal .button-primary{ padding:15px 70px; height:auto}
	#visual-editor select{ padding:0px 10px;border-radius:4px;}
	#visual-editor .form-control{ border-radius:4px; width:100%; max-width:400px; border:1px solid #CCC;padding-left:10px}
	#wpadminbar #wp-admin-bar-visual_editor .ab-icon:before {content: \'\f538\';top: 2px;}</style>';
    }
}
add_action( 'wp_head', 'rve_custom_admin_head' );
add_action( 'admin_head', 'rve_custom_admin_head' );



function rve_toolbar_link_menu( $wp_admin_bar ) {
    
    $options = get_option('visual_editor_options');

	$args = array(
		'id'    => 'visual_editor',
		'title' => '<span class="ab-icon"></span>Visual Editor',
		'href'  => admin_url().'admin.php?page=visual_editor',
		'meta'  => array( 'class' => 'my-toolbar-page' ),
	);
	$wp_admin_bar->add_node( $args );
	
	//Check if parallax is enabled and if it is, enable the custom post type
    if(isset($options['parallax']) && $options['parallax']=='enabled'){
    	$args = array(
    		'id'    => 'parallax',
    		'title' => 'Parallax',
    		'href'  => admin_url().'edit.php?post_type=parallax',
    		'meta'  => array( 'class' => 'my-toolbar-page' ),
    		'parent' => 'visual_editor'
    	);
	
        $wp_admin_bar->add_node( $args );
    }
    
	//Check if slider is enabled and if it is, enable the custom post type
    if(isset($options['slider']) && $options['slider']=='enabled'){
    	$args = array(
    		'id'    => 'slider',
    		'title' => 'Slider',
    		'href'  => admin_url().'edit.php?post_type=slider',
    		'meta'  => array( 'class' => 'my-toolbar-page' ),
    		'parent' => 'visual_editor'
    	);
	
        $wp_admin_bar->add_node( $args );
    }
    
    
    //Check if galleries is enabled and if it is, enable the custom post type
    if(isset($options['galleries']) && $options['galleries']=='enabled'){
    	$args = array(
    		'id'    => 'galleries',
    		'title' => 'Galleries',
    		'href'  => admin_url().'edit.php?post_type=galleries',
    		'meta'  => array( 'class' => 'my-toolbar-page' ),
    		'parent' => 'visual_editor'
    	);
	
        $wp_admin_bar->add_node( $args );
    }
    
    //Check if staff is enabled and if it is, enable the custom post type
    if(isset($options['staff']) && $options['staff']=='enabled'){
    	$args = array(
    		'id'    => 'staff',
    		'title' => 'Staff',
    		'href'  => admin_url().'edit.php?post_type=staff',
    		'meta'  => array( 'class' => 'my-toolbar-page' ),
    		'parent' => 'visual_editor'
    	);
	
        $wp_admin_bar->add_node( $args );
    }
    
    //Check if timeline is enabled and if it is, enable the custom post type
    if(isset($options['timeline']) && $options['timeline']=='enabled'){
    	$args = array(
    		'id'    => 'timeline',
    		'title' => 'Timeline',
    		'href'  => admin_url().'edit.php?post_type=timeline',
    		'meta'  => array( 'class' => 'my-toolbar-page' ),
    		'parent' => 'visual_editor'
    	);
	
        $wp_admin_bar->add_node( $args );
    }
    
	//Check if testimonials is enabled and if it is, enable the custom post type
    if(isset($options['testimonials']) && $options['testimonials']=='enabled'){
    	$args = array(
    		'id'    => 'testimonial',
    		'title' => 'Testimonials',
    		'href'  => admin_url().'edit.php?post_type=testimonials',
    		'meta'  => array( 'class' => 'my-toolbar-page' ),
    		'parent' => 'visual_editor'
    	);
	
        $wp_admin_bar->add_node( $args );
    }
	
	//Check if infoboxes is enabled and if it is, enable the custom post type
    if(isset($options['infoboxes']) && $options['infoboxes']=='enabled'){
    	$args = array(
    		'id'    => 'infoboxes',
    		'title' => 'Info Boxes',
    		'href'  => admin_url().'edit.php?post_type=infoboxes',
    		'meta'  => array( 'class' => 'my-toolbar-page' ),
    		'parent' => 'visual_editor'
    	);
	
        $wp_admin_bar->add_node( $args );
    }
}
add_action( 'admin_bar_menu', 'rve_toolbar_link_menu',999 );
?>