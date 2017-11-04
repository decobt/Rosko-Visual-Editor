<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
This function is used to generate the fields for the button modal
*/
function rve_get_button_modal_fields(){

    echo '<h3>Button Module</h3>';
    echo '<p>Set your styling for this button module.</p>';
    
    ?>
    <table class="form-table" id="visual-editor">
    <tbody>    
    <tr>
        <th scope="row"><label for="button-url">Button Url Link:</label></th>
        <td><input type="text" value="" id="button-url" class="form-control" name="button-url" /></td>
    </tr>
    <tr>
        <th scope="row"><label for="button-title">Button Text:</label></th>
        <td><input type="text" value="" id="button-title" class="form-control" name="button-title" /></td>
    </tr>
    <tr>
        <th scope="row"><label for="button-class">Class Attribute (optional):</label></th>
        <td><input type="text" value="" id="button-class" class="form-control" name="button-class" /></td>
    </tr>
    <tr>
        <th scope="row"><label for="button-id">ID Attribute (optional):</label></th>
        <td><input type="text" value="" id="button-id" class="form-control" name="button-id" /></td>
    </tr>
    </tbody>
	</table>
    <br/>
    <a href="" class="button button-primary" id="button_save_button">Save Settings</a>
    <?php
}

?>