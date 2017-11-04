<?php
/*
Description: This part of the code is used to generate the shortcodes
they are separated from module0 to module9 each for specific type
The functions listed in these files are used to generate the html code
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//Add theme support for post thumbnail for the following post types
add_theme_support( 'post-thumbnails', array( 'post', 'parallax', 'partners', 'staff', 'galleries', 'slider', 'testimonials' ) );

//Add which files are required
require_once( 'module-shortcodes/rve_module0.php' );
require_once( 'module-shortcodes/rve_module1.php' );
require_once( 'module-shortcodes/rve_module2.php' );
require_once( 'module-shortcodes/rve_module3.php' );
require_once( 'module-shortcodes/rve_module4.php' );
require_once( 'module-shortcodes/rve_module5.php' );
require_once( 'module-shortcodes/rve_module6.php' );
require_once( 'module-shortcodes/rve_module7.php' );
require_once( 'module-shortcodes/rve_module8.php' );
require_once( 'module-shortcodes/rve_module9.php' );

?>