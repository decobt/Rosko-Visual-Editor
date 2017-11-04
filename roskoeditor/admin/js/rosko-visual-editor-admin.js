var counter = 0;
var dragAndDrop = {
    
    init: function () {
        this.dragula();
        this.eventListeners();
    },

    eventListeners: function () {
        this.dragula.on('drop', this.dropped.bind(this));
        this.dragula.on('remove', this.destroy.bind(this));
        this.dragula.on('over', this.over.bind(this));
        this.dragula.on('out', this.out.bind(this));
    },

    dragula: function () {
        this.dragula = dragula([document.getElementById('right-defaults'), document.getElementById('left-defaults')],
        {
            removeOnSpill:true,
            copy: function (el, source) {
                return source === document.getElementById('right-defaults');
             },
            accepts: function (el, target) {
                return target !== document.getElementById('right-defaults');
             },
            moves: this.canMove.bind(this)
            /*
            ******This function can be used in future for module sections and adding extra containers to the visual editor********
            *
            isContainer: function(el){
                return el.classList.contains('container');
            }
            */
        });
    },
    
    canMove: function (el, container, handle) {
        return true;
    },
    dropped: function (el) {
        var elements;
        counter = counter + 1;
        
        var shortcode = el.getAttribute('data-shortcode');
        //This function is used to check which module has been dropped and assign specific function on dbl click
        switch(shortcode){
            case 'module1': el.setAttribute('ondblclick','open_editor(\'my-content-id\',this)'); break;
            case 'module2': el.setAttribute('ondblclick','open_parallax(\'my-parallax\',this)'); break;
            case 'module3': el.setAttribute('ondblclick','open_button(\'my-button-id\',this)'); break;
            case 'module4': el.setAttribute('ondblclick','open_slider(\'slider\',this)'); break;
            case 'module5': el.setAttribute('ondblclick','open_galleries(\'galleries\',this)'); break;
            case 'module6': el.setAttribute('ondblclick','open_staff(\'staff\',this)'); break;
            case 'module7': el.setAttribute('ondblclick','open_timeline(\'timeline\',this)'); break;
            case 'module8': el.setAttribute('ondblclick','open_testimonial(\'testimonial\',this)');break;
            case 'module9': el.setAttribute('ondblclick','open_infoboxes(\'infoboxes\',this)');break;
        }
        
        if(el.getAttribute('data-content')!=''){
            el.setAttribute('data-content', el.getAttribute('data-content'));
        }else{
            el.setAttribute('data-content','');
        }
        el.setAttribute('id','out'+counter);
        if(document.getElementById('meta-text').value ==""){
            elements = document.getElementById('left-defaults').getElementsByTagName("div");
            changeValue(elements);
        }else{
            elements = document.getElementById('left-defaults').getElementsByTagName("div");
            changeValue(elements);
        }
    },
    destroy: function(el){
        var elements = document.getElementById('left-defaults').getElementsByTagName("div");
        changeValue(elements);
    },
    over: function(el){
        document.getElementById("left-defaults").className += " drag-over";
    },
    out: function(el){
        document.getElementById("left-defaults").className = "container";
    }
};

dragAndDrop.init();



/*
This function is used to enable the button once the dropdown option has been selected
*/
function enable_button(button){
    document.getElementById(button).removeAttribute('disabled');
}
/*
The changeValue function is used to add all the fields in left-defaults and add them to the metabox value
The loop goes through each element in the array and selects the data-shortcode attribute and adds it to the final output
Input: elements (array)
*/
function changeValue(elements){
    var output = '';
    var shortcode='';
    var parameters='';
    for(var i = 0; i < elements.length; i++) {
        shortcode = elements[i].attributes['data-shortcode'].value;
        parameters = elements[i].attributes['data-content'].value;
        shortcode = '['+shortcode+' data-content="'+parameters+'"]';
        output = output+encodeURIComponent(shortcode);
    }
    //Update the visual editor meta field with the shortcode outputs
    document.getElementById('meta-text').value = output;
}



/*************************************************************************************************
 * 
 * THE FOLLOWING FUNCTIONS ARE USED FOR THE PARALLAX MODULE
 * 
 * ***********************************************************************************************/

/*
The open_parallax function is used to open the modal for the PARALLAX modules
*/
function open_parallax(p1,ele){
    //Display the modal for parallax
    var modal = document.getElementById(p1);
    modal.style.display = "block";
    
    //Update body and modal save button
    document.getElementsByTagName('body')[0].style.overflow = "hidden";
    document.getElementById('parallax_save_button').setAttribute('href','javascript:save_parallax_post(\''+ele.attributes['id'].value+'\');');
    
    //Get the value of the data-content attribute of the modal
    var shortcode_value = ele.attributes['data-content'].value;

    //If it has been previosly set, update the fields of the modal to the latest info, or if not, set them empty
    if(shortcode_value!=''){
        document.getElementById('parallax-post').value = shortcode_value;
    }else{
        document.getElementById('parallax-post').selectedIndex = 0;
    }
}



/*
This function is used to close the parallax modal
*/
function closeparallax(p1) {
    //Close and reset the modals and page
    var modal = document.getElementById(p1);
    modal.style.display = "none";
    document.getElementsByTagName('body')[0].style.overflow = "initial";
}



/*
This function is used to save the data from the parallax modal
It takes the value from the select box and updates the data-content
*/
function save_parallax_post(p1){
    
    //Get the value from the modal select field
     var content = document.getElementById('parallax-post').options[document.getElementById('parallax-post').selectedIndex].value;
    
    //Set the output and assign it to the attribute data-content
    document.getElementById(p1).setAttribute('data-content', content);
    
    //Close the modal
    closeparallax('my-parallax');
    
    //Update the visual editor fields
    var elements = document.getElementById('left-defaults').getElementsByTagName("div");
    changeValue(elements);
}



/*************************************************************************************************
 * 
 * THE FOLLOWING FUNCTIONS ARE USED FOR THE TITLE AND PARAGRAPH MODULE
 * 
 * ***********************************************************************************************/

/*
The open_editor function is used to open the modal for TITLE and PARAGRAPH modules
*/
function open_editor(p1,ele){
    //Display the modal for title and paragraph
    var modal = document.getElementById(p1);
    modal.style.display = "block";
    
    //Set the content of the tinyMCE editor to the saved shortcode value
    tinymce.activeEditor.setContent(decodeURIComponent(ele.attributes['data-content'].value));
    
    //Update body and modal save button
    document.getElementsByTagName('body')[0].style.overflow = "hidden";
    document.getElementById('modal_save_button').setAttribute('href','javascript:save_edit(\''+ele.attributes['id'].value+'\');');
}



/*
This function is called to close the modal for the TITLE and PARAGRAPH module
*/
function closemodal(p1) {
    var modal = document.getElementById(p1);
    modal.style.display = "none";
    document.getElementsByTagName('body')[0].style.overflow = "initial";
}



/*
This function is used to save the data from the modal for TITLE AND PARAGRAPH module
*/
function save_edit(field){
    //Get the content from the module
    var content = document.getElementById("mycustomeditor");
    
    //Check if content comes from tinyMCE or simple text editor and update accordingly
    if (content.style.display == 'none'){
        document.getElementById(field).setAttribute('data-content',encodeURIComponent(tinyMCE.activeEditor.getContent()));
    }else{
        document.getElementById(field).setAttribute('data-content',encodeURIComponent(content.value));
    }
    
    //Close the modal and update the visual editor fields
    closemodal('my-content-id');
    var elements = document.getElementById('left-defaults').getElementsByTagName("div");
    changeValue(elements);
}



/*************************************************************************************************
 * 
 * THE FOLLOWING FUNCTIONS ARE USED FOR THE SLIDER MODULE
 * 
 * ***********************************************************************************************/
 
/*
The open slider function is used to display the modal for the Slider Module
*/
function open_slider(p1,ele){
    //Display the slider modal
    var modal = document.getElementById(p1);
    modal.style.display = "block";
    
    document.getElementById('insert_slider').setAttribute('disabled', 'disabled');
    
    document.getElementById('slider-post').selectedIndex = 0;
    
    //Get the saved shortcode values from the slider
    var shortcode_value = ele.attributes['data-content'].value;

    var data = {
			'action': 'get_slider_posts',
			'shortcode-data': shortcode_value,
			'post-type': 'slider'
	};

    //Make an ajax call to wordpress and get the information about the saved post ID's as a response
	jQuery.post(ajaxurl, data, function(response) {
	    
            //The callback function (myCallback) updates the hidden input for the slider modal
		    var myCallback = function(){
                var table = document.getElementById("slider-table");
                var length = table.rows.length;

                var output = '';
                for (var i = 0; i < length; i++) {
                    if (i!=0){
                        if (output == ''){
                            output = output + table.rows[i].cells[0].innerHTML;
                        }else{
                            output = output + ',' + table.rows[i].cells[0].innerHTML;
                        }
                    }
                }
                document.getElementById('slider-selection').value = output;
            };
            
            //First call the generate_table function to generate a table for the saved values
            //Next use the callback function to calculate the shortcode value because initially it is set as ''
            generate_table(response, shortcode_value, myCallback);
	});
    
    document.getElementsByTagName('body')[0].style.overflow = "hidden";
    document.getElementById('portfolio_save_button').setAttribute('href','javascript:save_slider_post(\''+ele.attributes['id'].value+'\');');
}



/*
This function is used to insert one of the slider posts in the slider modal as an option
Once the user selects a slider post to be added to the slider, the function generates a row with the post info
and adds the id of the post to the final value that needs to be saved
*/
function insert_slider_post(){
    var hidden_input = document.getElementById('slider-selection').value;
    if (hidden_input==''){
        document.getElementById('slider-selection').value = document.getElementById('slider-post').value;
    }else{
        document.getElementById('slider-selection').value = document.getElementById('slider-selection').value + ',' +document.getElementById('slider-post').value;
    }
    
    var url = document.getElementById('slider-post').options[document.getElementById('slider-post').selectedIndex].attributes['data-url'].value;
    var table = document.getElementById("slider-table");

    var x = document.getElementById("slider-table").rows.length;
    // Create an empty <tr> element and add it to the last position of the table:
    var row = table.insertRow(x);
    
    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    
    // Add some text to the new cells:
    cell1.innerHTML = document.getElementById('slider-post').value;
    if(url!=''){
    cell2.innerHTML = '<img src="'+decodeURIComponent(url)+'" height="60px"/>';
    }
    cell3.innerHTML = document.getElementById('slider-post').options[document.getElementById('slider-post').selectedIndex].text;
    cell4.innerHTML = '<button type="button" onclick="del_slider_table('+ x +')" class="button button-small">Remove Entry</button>';
    
    document.getElementById('slider-post').selectedIndex = 0;
    document.getElementById('insert_slider').setAttribute('disabled', 'disabled');
}



/*
This function is used to remove an added slider post to the slider in question
The function removes the selected row of the table and updates the value for the slider that needs to be saved
*/
function del_slider_table(el){

    var table = document.getElementById("slider-table");
    table.deleteRow(el);
    
    var length = table.rows.length;
    var output = '';
    
    //This loop is used to update the remove buttons in the table to the correct index because now one row is deleted and they are off
    for (var i = 0; i < length; i++) {
        if (i!=0){
        table.rows[i].cells[3].innerHTML = '<button type="button" onclick="del_slider_table('+ i +')" class="button button-small">Remove Entry</button>';
            if (output == ''){
                output = output + table.rows[i].cells[0].innerHTML;
            }else{
                output = output + ',' + table.rows[i].cells[0].innerHTML;
            }
        }
    }
    //At the end because we deleted one row, we have to update the hidden input in the modal
    document.getElementById('slider-selection').value = output;
}



/*
This function is used to save the value for the slider
Once the user adds all the desired slider posts he can save the value of the ID's to the slider with this function
*/
function save_slider_post(field){

    //Get and set the updated values
    var content = document.getElementById("slider-selection").value;
    document.getElementById(field).setAttribute('data-content',content);
    
    //Close the slider modal and refresh the visual editor values
    closeslider('slider');
    var elements = document.getElementById('left-defaults').getElementsByTagName("div");
    changeValue(elements);
}



/*
This function is used to close the slider modal
*/
function closeslider(p1) {
    
    //Close and reset the modals and page
    var modal = document.getElementById(p1);
    modal.style.display = "none";
    document.getElementsByTagName('body')[0].style.overflow = "initial";
    
    var table = document.getElementById("slider-table");
    var length = table.rows.length;
    
    //Loop through the table in the slider modal and remove any rows, the table is blank for the next time that we can open it
    while(length>1){
        table.deleteRow(length-1);
        length = table.rows.length;
    }
}



/*
This function is used to generate the table with posts for the slider that has already been saved and has
previously addes slider posts
*/
function generate_table(response,shortcode_value,myCallback){
    
    var table = document.getElementById("slider-table");
    var row, cell1, cell2, cell3, cell4;
    
    //Get the array with all the save ID's for the slider
    var list = shortcode_value.split(',');
    
    //Loop through the array and generate table rows
    for(var j=0; j<list.length;j++){
        
		    for(var i=0; i<response.length;i++){
		        
		        if(list[j]==response[i].ID){
		        row = table.insertRow(table.rows.length);
		        
		        cell1 = row.insertCell(0);
                cell2 = row.insertCell(1);
                cell3 = row.insertCell(2);
                cell4 = row.insertCell(3);
                
		        cell1.innerHTML = response[i].ID;
		        if(response[i].thumbnail!=''){
		            cell2.innerHTML = '<img src="'+response[i].thumbnail+'" height="60px"/>';
		        }
		        cell3.innerHTML = response[i].post_title;
		        cell4.innerHTML = '<button type="button" onclick="del_slider_table('+ (table.rows.length-1) +')" class="button button-small">Remove Entry</button>';
		        }
		            
		  }
    }    
	myCallback();
}

/*************************************************************************************************
 * 
 * THE FOLLOWING FUNCTIONS ARE USED FOR THE TESTIMONIALS MODULE
 * 
 * ***********************************************************************************************/
 
/*
The open testimonial function is used to display the modal for the Testimonial Module
*/
function open_testimonial(p1,ele){
    //Display the testimonial modal
    var modal = document.getElementById(p1);
    modal.style.display = "block";
    document.getElementById('insert_testimonial').setAttribute('disabled', 'disabled');
    
    document.getElementById('testimonial-post').selectedIndex = 0;

    //Get the saved shortcode values from the testimonial
    var shortcode_value = ele.attributes['data-content'].value;

    var data = {
			'action': 'get_slider_posts',
			'shortcode-data': shortcode_value,
			'post-type': 'testimonials'
	};

    //Make an ajax call to wordpress and get the information about the saved post ID's as a response
	jQuery.post(ajaxurl, data, function(response) {
	    
            //The callback function (myCallback) updates the hidden input for the testimonial modal
		    var myCallback = function(){
                var table = document.getElementById("testimonial-table");
                var length = table.rows.length;

                var output = '';
                for (var i = 0; i < length; i++) {
                    if (i!=0){
                        if (output == ''){
                            output = output + table.rows[i].cells[0].innerHTML;
                        }else{
                            output = output + ',' + table.rows[i].cells[0].innerHTML;
                        }
                    }
                }
                document.getElementById('testimonial-selection').value = output;
            };
            
            //First call the generate_table function to generate a table for the saved values
            //Next use the callback function to calculate the shortcode value because initially it is set as ''
            generate_testimonial_table(response, shortcode_value, myCallback);
	});
    
    document.getElementsByTagName('body')[0].style.overflow = "hidden";
    document.getElementById('testimonial_save_button').setAttribute('href','javascript:save_testimonial_post(\''+ele.attributes['id'].value+'\');');
}



/*
This function is used to insert one of the testimonial posts in the testimonial modal as an option
Once the user selects a testimonial post to be added to the slider, the function generates a row with the post info
and adds the id of the post to the final value that needs to be saved
*/
function insert_testimonial_post(){

    var hidden_input = document.getElementById('testimonial-selection').value;
    if (hidden_input==''){
        document.getElementById('testimonial-selection').value = document.getElementById('testimonial-post').value;
    }else{
        document.getElementById('testimonial-selection').value = document.getElementById('testimonial-selection').value + ',' +document.getElementById('testimonial-post').value;
    }
    
    var content = document.getElementById('testimonial-post').options[document.getElementById('testimonial-post').selectedIndex].attributes['data-url'].value;
    var table = document.getElementById("testimonial-table");

    var x = document.getElementById("testimonial-table").rows.length;
    // Create an empty <tr> element and add it to the last position of the table:
    var row = table.insertRow(x);
    
    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    
    // Add some text to the new cells:
    cell1.innerHTML = document.getElementById('testimonial-post').value;
    cell2.innerHTML = document.getElementById('testimonial-post').options[document.getElementById('testimonial-post').selectedIndex].text;
    cell3.innerHTML = '<p>' + content + '</p>';
    cell4.innerHTML = '<button type="button" onclick="del_testimonial_table('+ x +')" class="button button-small">Remove Entry</button>';
    document.getElementById('testimonial-post').selectedIndex = 0;
    document.getElementById('insert_testimonial').setAttribute('disabled', 'disabled');
}



/*
This function is used to remove an added testimonial post to the testimonials in question
The function removes the selected row of the table and updates the value for the testimonial that needs to be saved
*/
function del_testimonial_table(el){
    
    var table = document.getElementById("testimonial-table");
    table.deleteRow(el);
    
    var length = table.rows.length;
    var output = '';
    
    //This loop is used to update the remove buttons in the table to the correct index because now one row is deleted and they are off
    for (var i = 0; i < length; i++) {
        if (i!=0){
        table.rows[i].cells[3].innerHTML = '<button type="button" onclick="del_testimonial_table('+ i +')" class="button button-small">Remove Entry</button>';
            if (output == ''){
                output = output + table.rows[i].cells[0].innerHTML;
            }else{
                output = output + ',' + table.rows[i].cells[0].innerHTML;
            }
        }
    }
    //At the end because we deleted one row, we have to update the hidden input in the modal
    document.getElementById('testimonial-selection').value = output;
}



/*
This function is used to save the value for the testimonial
Once the user adds all the desired testimonial posts he can save the value of the ID's to the testimonial with this function
*/
function save_testimonial_post(field){

    //Get and set the updated values
    var content = document.getElementById("testimonial-selection").value;
    document.getElementById(field).setAttribute('data-content',content);
    
    //Close the testimonial modal and refresh the visual editor values
    closetestimonial('testimonial');
    var elements = document.getElementById('left-defaults').getElementsByTagName("div");
    changeValue(elements);
}



/*
This function is used to close the testimonial modal
*/
function closetestimonial(p1) {
    
    //Close and reset the modals and page
    var modal = document.getElementById(p1);
    modal.style.display = "none";
    document.getElementsByTagName('body')[0].style.overflow = "initial";
    
    var table = document.getElementById("testimonial-table");
    var length = table.rows.length;
    
    //Loop through the table in the slider modal and remove any rows, the table is blank for the next time that we can open it
    while(length>1){
        table.deleteRow(length-1);
        length = table.rows.length;
    }
}



/*
This function is used to generate the table with posts for the testimonial that has already been saved and has
previously addes testimonial posts
*/
function generate_testimonial_table(response,shortcode_value,myCallback){
    
    var table = document.getElementById("testimonial-table");
    var row, cell1, cell2, cell3, cell4;
    
    //Get the array with all the save ID's for the testimonial
    var list = shortcode_value.split(',');
    
    //Loop through the array and generate table rows
    for(var j=0; j<list.length;j++){
        
		    for(var i=0; i<response.length;i++){
		        if(list[j]==response[i].ID){
		        row = table.insertRow(table.rows.length);
		        
		        cell1 = row.insertCell(0);
                cell2 = row.insertCell(1);
                cell3 = row.insertCell(2);
                cell4 = row.insertCell(3);
                
		        cell1.innerHTML = response[i].ID;
		        cell2.innerHTML = response[i].post_title;
		        cell3.innerHTML = '<p>'+response[i].post_content+'</p>';
		        cell4.innerHTML = '<button type="button" onclick="del_testimonial_table('+ (table.rows.length-1) +')" class="button button-small">Remove Entry</button>';
		        }
		            
		  }
    }    
	myCallback();
}



/*************************************************************************************************
 * 
 * THE FOLLOWING FUNCTIONS ARE USED FOR THE GALLERIES MODULE
 * 
 * ***********************************************************************************************/
 
/*
The open galleries function is used to display the modal for the Galleries Module
*/
function open_galleries(p1,ele){
    //Display the galleries modal
    var modal = document.getElementById(p1);
    modal.style.display = "block";
    document.getElementById('insert_galleries').setAttribute('disabled', 'disabled');
    
    document.getElementById('galleries-post').selectedIndex = 0;

    //Get the saved shortcode values from the galleries
    var shortcode_value = ele.attributes['data-content'].value;

    var data = {
			'action': 'get_slider_posts',
			'shortcode-data': shortcode_value,
			'post-type': 'galleries'
	};

    //Make an ajax call to wordpress and get the information about the saved post ID's as a response
	jQuery.post(ajaxurl, data, function(response) {
	    
            //The callback function (myCallback) updates the hidden input for the galleries modal
		    var myCallback = function(){
                var table = document.getElementById("galleries-table");
                var length = table.rows.length;

                var output = '';
                for (var i = 0; i < length; i++) {
                    if (i!=0){
                        if (output == ''){
                            output = output + table.rows[i].cells[0].innerHTML;
                        }else{
                            output = output + ',' + table.rows[i].cells[0].innerHTML;
                        }
                    }
                }
                document.getElementById('galleries-selection').value = output;
            };
            
            //First call the generate_table function to generate a table for the saved values
            //Next use the callback function to calculate the shortcode value because initially it is set as ''
            generate_galleries_table(response, shortcode_value, myCallback);
	});
    
    document.getElementsByTagName('body')[0].style.overflow = "hidden";
    document.getElementById('galleries_save_button').setAttribute('href','javascript:save_galleries_post(\''+ele.attributes['id'].value+'\');');
}



/*
This function is used to insert one of the galleries posts in the galleries modal as an option
Once the user selects a galleries post to be added to the galleries, the function generates a row with the post info
and adds the id of the post to the final value that needs to be saved
*/
function insert_galleries_post(){

    var hidden_input = document.getElementById('galleries-selection').value;
    if (hidden_input==''){
        document.getElementById('galleries-selection').value = document.getElementById('galleries-post').value;
    }else{
        document.getElementById('galleries-selection').value = document.getElementById('galleries-selection').value + ',' +document.getElementById('galleries-post').value;
    }
    
    var url = document.getElementById('galleries-post').options[document.getElementById('galleries-post').selectedIndex].attributes['data-url'].value;
    var table = document.getElementById("galleries-table");

    var x = document.getElementById("galleries-table").rows.length;
    // Create an empty <tr> element and add it to the last position of the table:
    var row = table.insertRow(x);
    
    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    
    // Add some text to the new cells:
    cell1.innerHTML = document.getElementById('galleries-post').value;
    if(url!=''){
    cell2.innerHTML = '<img src="'+decodeURIComponent(url)+'" height="60px"/>';
    }
    cell3.innerHTML = document.getElementById('galleries-post').options[document.getElementById('galleries-post').selectedIndex].text;
    cell4.innerHTML = '<button type="button" onclick="del_galleries_table('+ x +')" class="button button-small">Remove Entry</button>';
    document.getElementById('galleries-post').selectedIndex = 0;
    document.getElementById('insert_galleries').setAttribute('disabled', 'disabled');
}



/*
This function is used to remove an added galleries post to the galleries in question
The function removes the selected row of the table and updates the value for the galleries that needs to be saved
*/
function del_galleries_table(el){
    
    var table = document.getElementById("galleries-table");
    table.deleteRow(el);
    
    var length = table.rows.length;
    var output = '';
    
    //This loop is used to update the remove buttons in the table to the correct index because now one row is deleted and they are off
    for (var i = 0; i < length; i++) {
        if (i!=0){
        table.rows[i].cells[3].innerHTML = '<button type="button" onclick="del_galleries_table('+ i +')" class="button button-small">Remove Entry</button>';
            if (output == ''){
                output = output + table.rows[i].cells[0].innerHTML;
            }else{
                output = output + ',' + table.rows[i].cells[0].innerHTML;
            }
        }
    }
    //At the end because we deleted one row, we have to update the hidden input in the modal
    document.getElementById('galleries-selection').value = output;
}



/*
This function is used to save the value for the galleries
Once the user adds all the desired galleries posts he can save the value of the ID's to the galleries with this function
*/
function save_galleries_post(field){

    //Get and set the updated values
    var content = document.getElementById("galleries-selection").value;
    document.getElementById(field).setAttribute('data-content',content);
    
    //Close the galleries modal and refresh the visual editor values
    closegalleries('galleries');
    var elements = document.getElementById('left-defaults').getElementsByTagName("div");
    changeValue(elements);
}



/*
This function is used to close the galleries modal
*/
function closegalleries(p1) {
    
    //Close and reset the modals and page
    var modal = document.getElementById(p1);
    modal.style.display = "none";
    document.getElementsByTagName('body')[0].style.overflow = "initial";
    
    var table = document.getElementById("galleries-table");
    var length = table.rows.length;
    
    //Loop through the table in the galleries modal and remove any rows, the table is blank for the next time that we can open it
    while(length>1){
        table.deleteRow(length-1);
        length = table.rows.length;
    }
}



/*
This function is used to generate the table with posts for the galleries that has already been saved and has
previously addes galleries posts
*/
function generate_galleries_table(response,shortcode_value,myCallback){
    
    var table = document.getElementById("galleries-table");
    var row, cell1, cell2, cell3, cell4;
    
    //Get the array with all the save ID's for the galleries
    var list = shortcode_value.split(',');
    
    //Loop through the array and generate table rows
    for(var j=0; j<list.length;j++){
        
		    for(var i=0; i<response.length;i++){
		        
		        if(list[j]==response[i].ID){
		        row = table.insertRow(table.rows.length);
		        
		        cell1 = row.insertCell(0);
                cell2 = row.insertCell(1);
                cell3 = row.insertCell(2);
                cell4 = row.insertCell(3);
                
		        cell1.innerHTML = response[i].ID;
		        if(response[i].thumbnail!=''){
		            cell2.innerHTML = '<img src="'+response[i].thumbnail+'" height="60px"/>';
		        }
		        cell3.innerHTML = response[i].post_title;
		        cell4.innerHTML = '<button type="button" onclick="del_galleries_table('+ (table.rows.length-1) +')" class="button button-small">Remove Entry</button>';
		        }
		            
		  }
    }    
	myCallback();
}



/*************************************************************************************************
 * 
 * THE FOLLOWING FUNCTIONS ARE USED FOR THE STAFF MODULE
 * 
 * ***********************************************************************************************/
 
/*
The open slider function is used to display the modal for the Staff Module
*/
function open_staff(p1,ele){
    //Display the staff modal
    var modal = document.getElementById(p1);
    modal.style.display = "block";
    document.getElementById('insert_staff').setAttribute('disabled', 'disabled');
    
    document.getElementById('staff-post').selectedIndex = 0;

    //Get the saved shortcode values from the staff
    var shortcode_value = ele.attributes['data-content'].value;

    var data = {
			'action': 'get_slider_posts',
			'shortcode-data': shortcode_value,
			'post-type': 'staff'
	};

    //Make an ajax call to wordpress and get the information about the saved post ID's as a response
	jQuery.post(ajaxurl, data, function(response) {
	    
            //The callback function (myCallback) updates the hidden input for the staff modal
		    var myCallback = function(){
                var table = document.getElementById("staff-table");
                var length = table.rows.length;

                var output = '';
                for (var i = 0; i < length; i++) {
                    if (i!=0){
                        if (output == ''){
                            output = output + table.rows[i].cells[0].innerHTML;
                        }else{
                            output = output + ',' + table.rows[i].cells[0].innerHTML;
                        }
                    }
                }
                document.getElementById('staff-selection').value = output;
            };
            
            //First call the generate_table function to generate a table for the saved values
            //Next use the callback function to calculate the shortcode value because initially it is set as ''
            generate_staff_table(response, shortcode_value, myCallback);
	});
    
    document.getElementsByTagName('body')[0].style.overflow = "hidden";
    document.getElementById('staff_save_button').setAttribute('href','javascript:save_staff_post(\''+ele.attributes['id'].value+'\');');
}



/*
This function is used to insert one of the staff posts in the staff modal as an option
Once the user selects a staff post to be added to the staff, the function generates a row with the post info
and adds the id of the post to the final value that needs to be saved
*/
function insert_staff_post(){

    var hidden_input = document.getElementById('staff-selection').value;
    if (hidden_input==''){
        document.getElementById('staff-selection').value = document.getElementById('staff-post').value;
    }else{
        document.getElementById('staff-selection').value = document.getElementById('staff-selection').value + ',' +document.getElementById('staff-post').value;
    }
    
    var url = document.getElementById('staff-post').options[document.getElementById('staff-post').selectedIndex].attributes['data-url'].value;
    var table = document.getElementById("staff-table");

    var x = document.getElementById("staff-table").rows.length;
    // Create an empty <tr> element and add it to the last position of the table:
    var row = table.insertRow(x);
    
    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    
    // Add some text to the new cells:
    cell1.innerHTML = document.getElementById('staff-post').value;
    if(url!=''){
    cell2.innerHTML = '<img src="'+decodeURIComponent(url)+'" height="60px"/>';
    }
    cell3.innerHTML = document.getElementById('staff-post').options[document.getElementById('staff-post').selectedIndex].text;
    cell4.innerHTML = '<button type="button" onclick="del_staff_table('+ x +')" class="button button-small">Remove Entry</button>';
    document.getElementById('staff-post').selectedIndex = 0;
    document.getElementById('insert_staff').setAttribute('disabled', 'disabled');
}



/*
This function is used to remove an added staff post to the staff in question
The function removes the selected row of the table and updates the value for the staff that needs to be saved
*/
function del_staff_table(el){
    
    var table = document.getElementById("staff-table");
    table.deleteRow(el);
    
    var length = table.rows.length;
    var output = '';
    
    //This loop is used to update the remove buttons in the table to the correct index because now one row is deleted and they are off
    for (var i = 0; i < length; i++) {
        if (i!=0){
        table.rows[i].cells[3].innerHTML = '<button type="button" onclick="del_staff_table('+ i +')" class="button button-small">Remove Entry</button>';
            if (output == ''){
                output = output + table.rows[i].cells[0].innerHTML;
            }else{
                output = output + ',' + table.rows[i].cells[0].innerHTML;
            }
        }
    }
    //At the end because we deleted one row, we have to update the hidden input in the modal
    document.getElementById('staff-selection').value = output;
}



/*
This function is used to save the value for the staff
Once the user adds all the desired staff posts he can save the value of the ID's to the staff with this function
*/
function save_staff_post(field){

    //Get and set the updated values
    var content = document.getElementById("staff-selection").value;
    document.getElementById(field).setAttribute('data-content',content);
    
    //Close the staff modal and refresh the visual editor values
    closestaff('staff');
    var elements = document.getElementById('left-defaults').getElementsByTagName("div");
    changeValue(elements);
}



/*
This function is used to close the staff modal
*/
function closestaff(p1) {
    
    //Close and reset the modals and page
    var modal = document.getElementById(p1);
    modal.style.display = "none";
    document.getElementsByTagName('body')[0].style.overflow = "initial";
    
    var table = document.getElementById("staff-table");
    var length = table.rows.length;
    
    //Loop through the table in the staff modal and remove any rows, the table is blank for the next time that we can open it
    while(length>1){
        table.deleteRow(length-1);
        length = table.rows.length;
    }
}



/*
This function is used to generate the table with posts for the staff that has already been saved and has
previously addes staff posts
*/
function generate_staff_table(response,shortcode_value,myCallback){
    
    var table = document.getElementById("staff-table");
    var row, cell1, cell2, cell3, cell4;
    
    //Get the array with all the save ID's for the staff
    var list = shortcode_value.split(',');
    
    //Loop through the array and generate table rows
    for(var j=0; j<list.length;j++){
        
		    for(var i=0; i<response.length;i++){
		        
		        if(list[j]==response[i].ID){
		        row = table.insertRow(table.rows.length);
		        
		        cell1 = row.insertCell(0);
                cell2 = row.insertCell(1);
                cell3 = row.insertCell(2);
                cell4 = row.insertCell(3);
                
		        cell1.innerHTML = response[i].ID;
		        if(response[i].thumbnail!=''){
		            cell2.innerHTML = '<img src="'+response[i].thumbnail+'" height="60px"/>';
		        }
		        cell3.innerHTML = response[i].post_title;
		        cell4.innerHTML = '<button type="button" onclick="del_staff_table('+ (table.rows.length-1) +')" class="button button-small">Remove Entry</button>';
		        }
		            
		  }
    }    
	myCallback();
}



/*************************************************************************************************
 * 
 * THE FOLLOWING FUNCTIONS ARE USED FOR THE TIMELINE MODULE
 * 
 * ***********************************************************************************************/
 
/*
The open timeline function is used to display the modal for the Timeline Module
*/
function open_timeline(p1,ele){
    //Display the timeline timeline
    var modal = document.getElementById(p1);
    modal.style.display = "block";
    document.getElementById('insert_event').setAttribute('disabled', 'disabled');
    
    document.getElementById('timeline-post').selectedIndex = 0;

    //Get the saved shortcode values from the timeline
    var shortcode_value = ele.attributes['data-content'].value;

    var data = {
			"action": "get_slider_posts",
			"shortcode-data": shortcode_value,
			"post-type": "timeline"
	};

    //Make an ajax call to wordpress and get the information about the saved post ID's as a response
	jQuery.post(ajaxurl, data, function(response) {
	    
            //The callback function (myCallback) updates the hidden input for the timeline modal
		    var myCallback = function(){
                var table = document.getElementById("timeline-table");
                var length = table.rows.length;

                var output = '';
                for (var i = 0; i < length; i++) {
                    if (i!=0){
                        if (output == ''){
                            output = output + table.rows[i].cells[0].innerHTML;
                        }else{
                            output = output + ',' + table.rows[i].cells[0].innerHTML;
                        }
                    }
                }
                document.getElementById('timeline-selection').value = output;
            };
            
            //First call the generate_table function to generate a table for the saved values
            //Next use the callback function to calculate the shortcode value because initially it is set as ''
            generate_timeline_table(response, shortcode_value, myCallback);
            
	});
  /*.fail( function(xhr, status, error){
    alert( xhr );
    alert( status );
    alert( error );
  });
  */
    
    document.getElementsByTagName('body')[0].style.overflow = "hidden";
    document.getElementById('timeline_save_button').setAttribute('href','javascript:save_timeline_post(\''+ele.attributes['id'].value+'\');');
}



/*
This function is used to insert one of the timeline posts in the timeline modal as an option
Once the user selects a timeline post to be added to the timeline, the function generates a row with the post info
and adds the id of the post to the final value that needs to be saved
*/
function insert_timeline_post(){

    var hidden_input = document.getElementById('timeline-selection').value;
    if (hidden_input==''){
        document.getElementById('timeline-selection').value = document.getElementById('timeline-post').value;
    }else{
        document.getElementById('timeline-selection').value = document.getElementById('timeline-selection').value + ',' +document.getElementById('timeline-post').value;
    }
    
    var bodytext = document.getElementById('timeline-post').options[document.getElementById('timeline-post').selectedIndex].attributes['data-url'].value;
    var table = document.getElementById("timeline-table");

    var x = document.getElementById("timeline-table").rows.length;
    // Create an empty <tr> element and add it to the last position of the table:
    var row = table.insertRow(x);
    
    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    
    // Add some text to the new cells:
    cell1.innerHTML = document.getElementById('timeline-post').value;
    cell2.innerHTML = document.getElementById('timeline-post').options[document.getElementById('timeline-post').selectedIndex].text;
    cell3.innerHTML = '<p>'+ decodeURIComponent(bodytext) + '</p>';
    cell4.innerHTML = '<button type="button" onclick="del_timeline_table('+ x +')" class="button button-small">Remove Entry</button>';
    document.getElementById('timeline-post').selectedIndex = 0;
    document.getElementById('insert_event').setAttribute('disabled', 'disabled');
}



/*
This function is used to remove an added timeline post to the timeline in question
The function removes the selected row of the table and updates the value for the timeline that needs to be saved
*/
function del_timeline_table(el){
    
    var table = document.getElementById("timeline-table");
    table.deleteRow(el);
    
    var length = table.rows.length;
    var output = '';
    
    //This loop is used to update the remove buttons in the table to the correct index because now one row is deleted and they are off
    for (var i = 0; i < length; i++) {
        if (i!=0){
        table.rows[i].cells[3].innerHTML = '<button type="button" onclick="del_timeline_table('+ i +')" class="button button-small">Remove Entry</button>';
            if (output == ''){
                output = output + table.rows[i].cells[0].innerHTML;
            }else{
                output = output + ',' + table.rows[i].cells[0].innerHTML;
            }
        }
    }
    //At the end because we deleted one row, we have to update the hidden input in the modal
    document.getElementById('timeline-selection').value = output;
}



/*
This function is used to save the value for the timeline
Once the user adds all the desired timeline posts he can save the value of the ID's to the timeline with this function
*/
function save_timeline_post(field){

    //Get and set the updated values
    var content = document.getElementById("timeline-selection").value;
    document.getElementById(field).setAttribute('data-content',content);
    
    //Close the timeline modal and refresh the visual editor values
    closetimeline('timeline');
    var elements = document.getElementById('left-defaults').getElementsByTagName("div");
    changeValue(elements);
}



/*
This function is used to close the timeline modal
*/
function closetimeline(p1) {
    
    //Close and reset the modals and page
    var modal = document.getElementById(p1);
    modal.style.display = "none";
    document.getElementsByTagName('body')[0].style.overflow = "initial";
    
    var table = document.getElementById("timeline-table");
    var length = table.rows.length;
    
    //Loop through the table in the timeline modal and remove any rows, the table is blank for the next time that we can open it
    while(length>1){
        table.deleteRow(length-1);
        length = table.rows.length;
    }
}



/*
This function is used to generate the table with posts for the timeline that has already been saved and has
previously addes timeline posts
*/
function generate_timeline_table(response,shortcode_value,myCallback){
    
    var table = document.getElementById("timeline-table");
    var row, cell1, cell2, cell3, cell4;
    
    //Get the array with all the save ID's for the timeline
    var list = shortcode_value.split(',');
    
    //Loop through the array and generate table rows
    for(var j=0; j<list.length;j++){
        
		    for(var i=0; i<response.length;i++){
		        
		        if(list[j]==response[i].ID){
		        row = table.insertRow(table.rows.length);
		        
		        cell1 = row.insertCell(0);
                cell2 = row.insertCell(1);
                cell3 = row.insertCell(2);
                cell4 = row.insertCell(3);
                
		        cell1.innerHTML = response[i].ID;
		        cell2.innerHTML = response[i].post_title;
		        cell3.innerHTML = '<p>'+response[i].post_content+'</p>';;
		        cell4.innerHTML = '<button type="button" onclick="del_timeline_table('+ (table.rows.length-1) +')" class="button button-small">Remove Entry</button>';
		        }
		            
		  }
    }    
	myCallback();
}



/*************************************************************************************************
 * 
 * THE FOLLOWING FUNCTIONS ARE USED FOR THE INFO BOXES MODULE
 * 
 * ***********************************************************************************************/
 
/*
The open infoboxes function is used to display the modal for the Infoboxes Module
*/
function open_infoboxes(p1,ele){
    //Display the infoboxes modal
    var modal = document.getElementById(p1);
    modal.style.display = "block";
    document.getElementById('insert_infoboxes').setAttribute('disabled', 'disabled');
    
    document.getElementById('infoboxes-post').selectedIndex = 0;

    //Get the saved shortcode values from the infoboxes
    var shortcode_value = ele.attributes['data-content'].value;

    var data = {
			'action': 'get_slider_posts',
			'shortcode-data': shortcode_value,
			'post-type': 'infoboxes'
	};

    //Make an ajax call to wordpress and get the information about the saved post ID's as a response
	jQuery.post(ajaxurl, data, function(response) {
	    
            //The callback function (myCallback) updates the hidden input for the infoboxes modal
		    var myCallback = function(){
                var table = document.getElementById("infoboxes-table");
                var length = table.rows.length;

                var output = '';
                for (var i = 0; i < length; i++) {
                    if (i!=0){
                        if (output == ''){
                            output = output + table.rows[i].cells[0].innerHTML;
                        }else{
                            output = output + ',' + table.rows[i].cells[0].innerHTML;
                        }
                    }
                }
                document.getElementById('infoboxes-selection').value = output;
            };
            
            //First call the generate_table function to generate a table for the saved values
            //Next use the callback function to calculate the shortcode value because initially it is set as ''
            generate_infoboxes_table(response, shortcode_value, myCallback);
	});
    
    document.getElementsByTagName('body')[0].style.overflow = "hidden";
    document.getElementById('infoboxes_save_button').setAttribute('href','javascript:save_infoboxes_post(\''+ele.attributes['id'].value+'\');');
}



/*
This function is used to insert one of the infoboxes posts in the infoboxes modal as an option
Once the user selects a infoboxes post to be added to the infoboxes, the function generates a row with the post info
and adds the id of the post to the final value that needs to be saved
*/
function insert_infoboxes_post(){

    var hidden_input = document.getElementById('infoboxes-selection').value;
    if (hidden_input==''){
        document.getElementById('infoboxes-selection').value = document.getElementById('infoboxes-post').value;
    }else{
        document.getElementById('infoboxes-selection').value = document.getElementById('infoboxes-selection').value + ',' +document.getElementById('infoboxes-post').value;
    }
    
    var content = document.getElementById('infoboxes-post').options[document.getElementById('infoboxes-post').selectedIndex].attributes['data-content'].value;
    var table = document.getElementById("infoboxes-table");

    var x = document.getElementById("infoboxes-table").rows.length;
    // Create an empty <tr> element and add it to the last position of the table:
    var row = table.insertRow(x);
    
    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    
    // Add some text to the new cells:
    cell1.innerHTML = document.getElementById('infoboxes-post').value;
    cell2.innerHTML = document.getElementById('infoboxes-post').options[document.getElementById('infoboxes-post').selectedIndex].text;
    cell3.innerHTML = content;
    cell4.innerHTML = '<button type="button" onclick="del_infoboxes_table('+ x +')" class="button button-small">Remove Entry</button>';
    
    document.getElementById('infoboxes-post').selectedIndex = 0;
    document.getElementById('insert_infoboxes').setAttribute('disabled', 'disabled');
}



/*
This function is used to remove an added infoboxes post to the infoboxes in question
The function removes the selected row of the table and updates the value for the infoboxes that needs to be saved
*/
function del_infoboxes_table(el){
    
    var table = document.getElementById("infoboxes-table");
    table.deleteRow(el);
    
    var length = table.rows.length;
    var output = '';
    
    //This loop is used to update the remove buttons in the table to the correct index because now one row is deleted and they are off
    for (var i = 0; i < length; i++) {
        if (i!=0){
        table.rows[i].cells[3].innerHTML = '<button type="button" onclick="del_infoboxes_table('+ i +')" class="button button-small">Remove Entry</button>';
            if (output == ''){
                output = output + table.rows[i].cells[0].innerHTML;
            }else{
                output = output + ',' + table.rows[i].cells[0].innerHTML;
            }
        }
    }
    //At the end because we deleted one row, we have to update the hidden input in the modal
    document.getElementById('infoboxes-selection').value = output;
}



/*
This function is used to save the value for the infoboxes
Once the user adds all the desired infoboxes posts he can save the value of the ID's to the infoboxes with this function
*/
function save_infoboxes_post(field){

    //Get and set the updated values
    var content = document.getElementById("infoboxes-selection").value;
    document.getElementById(field).setAttribute('data-content',content);
    
    //Close the infoboxes modal and refresh the visual editor values
    closeinfoboxes('infoboxes');
    var elements = document.getElementById('left-defaults').getElementsByTagName("div");
    changeValue(elements);
}



/*
This function is used to close the infoboxes modal
*/
function closeinfoboxes(p1) {
    
    //Close and reset the modals and page
    var modal = document.getElementById(p1);
    modal.style.display = "none";
    document.getElementsByTagName('body')[0].style.overflow = "initial";
    
    var table = document.getElementById("infoboxes-table");
    var length = table.rows.length;
    
    //Loop through the table in the infoboxes modal and remove any rows, the table is blank for the next time that we can open it
    while(length>1){
        table.deleteRow(length-1);
        length = table.rows.length;
    }
}



/*
This function is used to generate the table with posts for the infoboxes that has already been saved and has
previously addes infoboxes posts
*/
function generate_infoboxes_table(response,shortcode_value,myCallback){
    
    var table = document.getElementById("infoboxes-table");
    var row, cell1, cell2, cell3, cell4;
    
    //Get the array with all the save ID's for the infoboxes
    var list = shortcode_value.split(',');
    
    //Loop through the array and generate table rows
    for(var j=0; j<list.length;j++){
        
		    for(var i=0; i<response.length;i++){
		        
		        if(list[j]==response[i].ID){
		        row = table.insertRow(table.rows.length);
		        
		        cell1 = row.insertCell(0);
                cell2 = row.insertCell(1);
                cell3 = row.insertCell(2);
                cell4 = row.insertCell(3);
                
		        cell1.innerHTML = response[i].ID;
		        cell2.innerHTML = response[i].post_title;
		        cell3.innerHTML = '<p>'+response[i].post_content+'</p>';
		        cell4.innerHTML = '<button type="button" onclick="del_infoboxes_table('+ (table.rows.length-1) +')" class="button button-small">Remove Entry</button>';
		        }
		            
		  }
    }    
	myCallback();
}



/*************************************************************************************************
 * 
 * THE FOLLOWING FUNCTIONS ARE USED FOR THE BUTTON MODULE
 * 
 * ***********************************************************************************************/

/*
The open_button function is used to open the modal for the BUTTON modules
*/
function open_button(p1,ele){
    //Display the modal for title and paragraph
    var modal = document.getElementById(p1);
    modal.style.display = "block";
    
    //Update body and modal save button
    document.getElementsByTagName('body')[0].style.overflow = "hidden";
    document.getElementById('button_save_button').setAttribute('href','javascript:save_button_post(\''+ele.attributes['id'].value+'\');');
    
    //Get the value of the data-content attribute of the modal
    var shortcode_value = ele.attributes['data-content'].value;

    //If it has been previosly set, update the fields of the modal to the latest info, or if not, set them empty
    if(shortcode_value!=''){
        var list = shortcode_value.split(',');
        document.getElementById('button-url').value = decodeURIComponent(list[0]);
        document.getElementById('button-title').value = list[1];
        document.getElementById('button-class').value = list[2];
        document.getElementById('button-id').value = list[3];
    }else{
        document.getElementById('button-url').value = '';
        document.getElementById('button-title').value = '';
        document.getElementById('button-class').value = '';
        document.getElementById('button-id').value = '';
    }
}



/*
This function is used to close the button modal
*/
function closebutton(p1) {
    //Close and reset the modals and page
    var modal = document.getElementById(p1);
    modal.style.display = "none";
    document.getElementsByTagName('body')[0].style.overflow = "initial";
}



/*
This function is used to save the data from the button modal
It takes each input and saves in into the data-content attribute of the modal
*/
function save_button_post(p1){
    
    //Get the values from the modal
    var url = encodeURIComponent(document.getElementById('button-url').value);
    var title = document.getElementById('button-title').value;
    var clas = document.getElementById('button-class').value;
    var id = document.getElementById('button-id').value;
    
    //Set the output and assign it to the attribute
    var output = url + ',' + title  + ',' + clas + ',' + id;
    document.getElementById(p1).setAttribute('data-content', output);
    
    //Close the modal
    closebutton('my-button-id');
    
    //Update the visual editor fields
    var elements = document.getElementById('left-defaults').getElementsByTagName("div");
    changeValue(elements);
}

/**
 * 
 * This function is used for accordition and color picker script
 * 
**/
jQuery(document).ready(function($){
    $('.color-field').each(function(){
        $(this).wpColorPicker();
    });
    $('.accordionz').on({
        click: function(){
            $($(this).attr('data-acc')).toggle('fast');
        }
    });
});