<?php
/*
Description: This part of the code is used to generate the shortcodes
they are separated from module0 to module9 each for specific type
The functions listed in these files are used to generate the html code
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//Add which files are required
require_once( 'modal-fields/rve-button-modal.php' );
require_once( 'modal-fields/rve-galleries-modal.php' );
require_once( 'modal-fields/rve-infoboxes-modal.php' );
require_once( 'modal-fields/rve-parallax-modal.php' );
require_once( 'modal-fields/rve-timeline-modal.php' );
require_once( 'modal-fields/rve-slider-modal.php' );
require_once( 'modal-fields/rve-staff-modal.php' );
require_once( 'modal-fields/rve-testimonials-modal.php' );

?>