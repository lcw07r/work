<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $pathRoot = $_SERVER['DOCUMENT_ROOT'] . '/';
include $pathRoot.'site-resources/headfoot/auto-head-above.php'; ?>
<title>ESRC National Centre for Research Methods</title>
<?php include $pathRoot.'site-resources/headfoot/auto-head-below.php'; ?>

<script type="text/javascript">
var list_1 = [
<?php

$elements = array(
	1 => '1. apple',
	2 => '2. ball (5.2)',
	5 => '2.1.1. shoe',
	6 => '3. dog',
	7 => '0.1. antelope'
);

foreach ($elements as $id => $text) {
	echo "{id: $id, text: '$text'},\n";
}

?>
];

var list_2 = [
<?php

$elements = array(
	3 => '2.1. fish',
	4 => '2.2. rope'
);

foreach ($elements as $id => $text) {
	echo "{id: $id, text: '$text'},\n";
}

?>
];

function set_data(selector, data) {
	$(selector).data('data', data);
}

function set_filters(selector, sort_fn, filter_fn) {
	$(selector).data('sort_fn', sort_fn);
	$(selector).data('filter_fn', filter_fn);
}

function remove_item(selector, id) {
	var item;
	var data = $.grep($(selector).data('data'), function (value, index) {
		if (value.id == id) item = value;
		return value.id != id;
	});
	$(selector).data('data', data);
	return item;
}

function add_item(selector, item) {
	$(selector).data('data').push(item);
}

function layout_list(selector) {
	var data = $(selector).data('data').slice(0);
	if ($(selector).data('sort_fn')) data.sort($(selector).data('sort_fn'));
	if ($(selector).data('filter_fn')) data = $.map(data, $(selector).data('filter_fn'));
	$(selector).empty();
	for (var i = 0; i < data.length; i++) {
		$(selector).append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
	}
}

function sort_numeric(a, b) {
	var a_num = a.text.trim().match(/^([0-9]+\.?)+/)[0].split('.');
	var b_num = b.text.trim().match(/^([0-9]+\.?)+/)[0].split('.');
	for (var i = 0; i < a_num.length && i < b_num.length; i++) {
		if (a_num[i] != b_num[i]) return a_num[i] - b_num[i];
	}
	if (i >= a_num.length) return -1;
	if (i >= b_num.length) return 1;
	return 0;
}

function sort_alpha(a, b) {
	var a_text = a.text.trim().match(/^([0-9]+\.?)+\s*(.*)/)[2];
	var b_text = b.text.trim().match(/^([0-9]+\.?)+\s*(.*)/)[2];
	return a_text.localeCompare(b_text);
}

function filter_move_numbers(value, index) {
	var parts = value.text.match(/^(([0-9]+\.?)+)\s*(.*)/);
	return {
		id: value.id,
		text: parts[3] + ' (' + parts[1] + ')'
	};
}

function move_selected(selector_a, selector_b) {
	$(selector_a + ' option:selected').each(function () {
		add_item(selector_b, remove_item(selector_a, $(this).attr('value')));
	});
}

$(document).ready(function () {
	set_data('#list1', list_1);
	set_data('#list2', list_2);
	set_filters('#list1', sort_numeric, null);
	set_filters('#list2', sort_numeric, null);
	layout_list('#list1');
	layout_list('#list2');
});
</script>


</head>

<body onLoad="checkJavaScriptValidity()">
<?php include $pathRoot.'site-resources/headfoot/auto-header.php'; ?>
	
<div class="pageContent">

<p>
This is a test for building form:<br>

<?php 



if (isset($_POST['submit'])){     
	//If the form is submited: validate input, check required fields, set error message when applied;
	initialise();    
	if (array_filter($err)) {   
		//If has error found, out put the form again (with error messages) ;
		outputRegisterForm();  			
	}else {   
		// if pass all checks, out put the search result.
		outputSearchResult();  			
	}	
}else {	
	// If the form is not submited yet, define variables and out put the initial form
	$gender = $organisation = $employer = $position = $discipline = $qualification = $region = $details = $disability = $dietary = $agree = $keywordOrderOption  = "";
	$err = $chosenKeywords = array();
	outputRegisterForm();
}

?>


<!--

<select multiple id="list1" >
</select>

<div>
<button onclick="move_selected('#list1', '#list2'); layout_list('#list1'); layout_list('#list2');">&rarr;</button><br>
<button onclick="move_selected('#list2', '#list1'); layout_list('#list1'); layout_list('#list2');">&larr;</button>
</div>
<select multiple id="list2" >
</select>
</p>
<p>
You can sort and filter the <b>first list</b> using these buttons:<br>
<button onclick="set_filters('#list1', sort_numeric, null); layout_list('#list1');">Numeric sort</button>
<button onclick="set_filters('#list1', sort_alpha, filter_move_numbers); layout_list('#list1');">Alphabetic sort</button>
</p>
<p>
You can sort and filter the <b>second list</b> using these buttons:<br>
<button onclick="set_filters('#list2', sort_numeric, null); layout_list('#list2');">Numeric sort</button>
<button onclick="set_filters('#list2', sort_alpha, filter_move_numbers); layout_list('#list2');">Alphabetic sort</button>
</p>

-->
 

<?php include $pathRoot.'site-resources/headfoot/auto-footer.php'; ?>
</body>
</html>


<?php
/**
* This function gets the required data for buiding the form fields 
*/
function outputRegisterForm()
{   
	global $err, $gender, $organisation, $employer, $position, $discipline, $qualification, $region, $details, $disability, $dietary, $agree, $keywordOrderOption;

	$method = "POST";
	$action = htmlspecialchars($_SERVER["PHP_SELF"]);
	$formID = "register";
   	
	$form  = '<form method="'.$method.'" action="'.$action.'" id="'.$formID.'">'."\n";
    $form .= '<p>Fields marked with a <span class="red">* </span>are mandatory.</p>';

	$form .= buildRadioField(array("labelText"=>"Gender", "discription"=>"", "name"=>"gender", "value"=>$gender, "options"=>array(array("value"=>"male", "text"=>"Male"), array("value"=>"female", "text"=>"Female")), "required" =>"yes", "layout"=>"inline"));
	$form .= buildRadioField(array("labelText"=>"In what type of organisation do you currently work or study", "discription"=>"", "type"=>"radio", "name"=>"organisation", "id"=>"organisation","value"=>$organisation, "options"=>array(array("value"=>"university", "text"=>"University/College"), array("value"=>"institute", "text"=>"Research Institute"), array("value"=>"public-sector","text"=>"Government/other public-sector organisation"), array("value"=>"private-sector","text"=>"Private-sector organisation"), array("value"=>"voluntary-sector","text"=>"Voluntary-sector organisation"), array("value"=>"other","text"=>"Other (including freelance)")), "required" =>"yes"));
	$form .= buildTextField(array("labelText"=>"Name of Employer or Institution registered at?", "type"=>"text", "name"=>"employer", "id"=>"employer", "value"=>$employer,  "required" =>"yes"));
	$form .= buildRadioField(array("labelText"=>"What is your current position?", "discription"=>"", "name"=>"position", "value"=>$position, "options"=>array(array("value"=>"junior", "text"=>"Junior Researcher (e.g. Research Officer, Research Fellow, Lecturer etc.)"), array("value"=>"senior", "text"=>"Senior Researcher (e.g. Senior Research Officer, Senior Lecturer etc.)"), array("value"=>"professor", "text"=>"Professor/Reader/Head of Unit/Director"), array("value"=>"student", "text"=>"Student"), array("value"=>"other", "text"=>"Other")), "required" =>"yes", "layout"=>"inline"));
	$form .= buildSelectField(array("labelText"=>"What is your disciplinary area of expertise? ", "name"=>"discipline", "id"=>"discipline", "value"=>$discipline, 	 "options"=>array("", "Area studies", "Demography", "Economic and Social History", "Economics", "Education", "Environmental planning", "Human Geography", "Linguistics", "Management and Business Studies", "Political Science and International Studies", "Psychology", "Social Anthropology", "Social Policy", "Social Work", "Socio-Legal Studies", "Sociology", "Science and Technology Studies", "Statistics, Methods and Computing", "Disciplines outside the Social Sciences", "Arts and Humanities", "Biological Sciences", "Engineering and Physical Sciences", "Environmental Science", "Medical Sciences")));
	$form .= buildRadioField(array("labelText"=>"Highest Qualification?", "discription"=>"", "name"=>"qualification", "value"=>$qualification, "options"=>array(array("value"=>"bachelors", "text"=>"Bachelors degree"), array("value"=>"masters", "text"=>"Masters degree"), array("value"=>"doctoral", "text"=>"Doctoral degree"), array("value"=>"none", "text"=>"None of these")), "required" =>"yes", "layout"=>"inline"));
	$form .= buildSelectField(array("labelText"=>"What do you consider to be your region?  ", "name"=>"region", "id"=>"region", "value"=>$region, 	 "options"=>array("", "London", "South-East", "South-West", "East of England", "Midlands", "North-West", "North-East", "Wales",  "Scotland", "Northern Ireland", "EU (other than UK)", "Outside the EU")));


	$form .= buildRadioField(array("labelText"=>"Event / course keywords", "discription"=>"", "type"=>"radio", "name"=>"keywordOrderoptions", "id"=>"keywordOrderoptions","value"=>$keywordOrderoption, "options"=>array(array("value"=>"typology", "text"=>"Display keywords as research methods typology", "onclick"=>"set_filters('#list1', sort_numeric, null); layout_list('#list1'); set_filters('#list2', sort_numeric, null); layout_list('#list2');"), array("value"=>"alphabetically", "text"=>" Display keywords alphabetically", "onclick"=>"set_filters('#list1', sort_alpha, filter_move_numbers); layout_list('#list1'); set_filters('#list2', sort_alpha); layout_list('#list2');"))));
	$form .= buildEmptySelectField(array("labelText"=>"", "discription"=>"Please select from the list of pre-specified keywords. To select/de-select multiple items, hold down the control key.", "name"=>"list1", "id"=>"list1", "multiple"=>"yes", "size"=>10));
	$form .= buildButtonField(array("type"=>"button",  "buttonText"=>"&darr; Add &darr;", "value"=>"add", "name"=>"add", "id"=>"add", "onclick"=>"move_selected('#list1', '#list2'); layout_list('#list1'); layout_list('#list2');"));
	$form .= buildButtonField(array("type"=>"button",  "buttonText"=>"&uarr; Delete &uarr;", "value"=>"delete", "name"=>"delete", "id"=>"delete", "onclick"=>"move_selected('#list2', '#list1'); layout_list('#list1'); layout_list('#list2');"));
	$form .= buildEmptySelectField(array("labelText"=>"", "discription"=>"Your chosen keywords", "name"=>"list2", "id"=>"list2", "multiple"=>"yes", "size"=>10));
	$form .= buildButtonField(array("type"=>"button",  "buttonText"=>"Submit", "value"=>"submit"));

	$form .= buildcheckboxField(array("labelText"=>"I agree to the terms and conditions", "name"=>"agree", "value"=>$agree, "required" =>"yes"));


/*	$formFields[] = array("labelText"=>"Name of Employer or Institution registered at?", "type"=>"text", "name"=>"employer", "id"=>"employer", "value"=>$employer, "errMessage"=>$err["employerErr"], "required" =>"yes");
	$formFields[] = array("labelText"=>"What is your current position?", "type"=>"radio", "name"=>"position", "id"=>"position","value"=>$position, "options"=>array(array("junior","Junior Researcher (e.g. Research Officer, Research Fellow, Lecturer etc.)"), array("senior","Senior Researcher (e.g. Senior Research Officer, Senior Lecturer etc.)"), array("professor","Professor/Reader/Head of Unit/Director"), array("student","Student"), array("other","Other")), "errMessage"=>$err["positionErr"], "required" =>"yes");
	$formFields[] = array("labelText"=>"What is your disciplinary area of expertise?", "type"=>"select", "name"=>"discipline", "id"=>"discipline","value"=>$discipline, "options"=>array("", "Area studies", "Demography", "Economic and Social History", "Economics", "Education", "Environmental planning", "Human Geography", "Linguistics", "Management and Business Studies", "Political Science and International Studies", "Psychology", "Social Anthropology", "Social Policy", "Social Work", "Socio-Legal Studies", "Sociology", "Science and Technology Studies", "Statistics, Methods and Computing", "Disciplines outside the Social Sciences", "Arts and Humanities", "Biological Sciences", "Engineering and Physical Sciences", "Environmental Science", "Medical Sciences"), "errMessage"=>$err["disciplineErr"], "required" =>"yes");
	$formFields[] = array("labelText"=>"Highest Qualification?", "type"=>"radio", "name"=>"qualification", "id"=>"qualification","value"=>$qualification, "options"=>array(array("bachelors","Bachelors degree"), array("masters","Masters degree"), array("doctoral","Doctoral degree"), array("none","None of these")), "errMessage"=>$err["qualificationErr"], "required" =>"yes");
	$formFields[] = array("labelText"=>"What do you consider to be your region?", "type"=>"select", "name"=>"region", "id"=>"region","value"=>$region, "options"=>array("", "London", "South-East", "South-West", "East of England", "Midlands", "North-West", "North-East", "Wales",  "Scotland", "Northern Ireland", "EU (other than UK)", "Outside the EU"), "errMessage"=>$err["regionErr"], "required" =>"yes");
	$formFields[] = array("labelText"=>"I agree to the terms and conditions", "type"=>"checkbox", "name"=>"agree", "id"=>"agree", "value"=>$agree, "errMessage"=>$err["agreeErr"], "required" =>"yes");

	$formFields[] = array("labelText"=>"Event / course keywords", "type"=>"custome", "name"=>"eventAndCourseKeywords", "id"=>"eventAndCourseKeywords", "value"=>$eventAndCourseKeywords, "functionCall"=>"eventAndCourseKeywords", "errMessage"=>$err["chosenKeywordErr"], "required" =>"yes");
*/
//	$formFields[] = array("type"=>"submit", "value"=>"submit", "name"=>"submit", "id"=>"submit");
		

	
//	$form = builtHTMLform($method, $action, $formFields, $formID);

    $form .= '</form>';
	echo $form;

}

/**
* This function builts the form section
* @param string $method the method that used for post the form
* @param string $action where the form post to
* @param string $formFields the array that contains all the form fields data
* @param string $formID the id of the form
* @return string $form the html form data
*/
/*
function htmlForm($method, $action, $formFields, $formID){
        $form = '<form method="'.$method.'" action="'.$action.'" id="'.$formID.'">'."\n";
        $form .= '<p>Fields marked with a <span class="red">* </span>are mandatory.</p>';
		
        foreach ($formFields as $formField){
                $form .= '<div>';
                $form .= '<label for="'.$formField["name"].'">'.$formField["labelText"].'</label>'."\n";
                $form .= '<div><input type="'.$formField["type"].'" name="'.$formField["name"].'" id="'.$formField["id"].'" value="'.$formField["value"].'" /><span class="'.$formField["class"].'" > * '.$formField["errMessage"].'</span></div>'."\n";
                $form .= '</div>';
        }
        
        $form .= '<div class="form-group">';
        $form .= '<div class="col-sm-offset-2 col-sm-10"><input class="btn btn-primary" type="submit" name="submit" value="Submit"></div>'."\n";
        $form .= '</div>';
        $form .= '</form>';
        $form .= '<br/><br/>';
        return $form;
}
*/



/**
* This function builts a checkbox field
* @param array $formField the array that contains the elements of the form field, 
* @return string $field - the string with the coresponding tags and data to outpu the form field
*/
function buildcheckboxField($formField){

	$field = '<div>';
// need to work on this !!!!!!!!!!!!!!!!!!!!!!!!!
	$field .= '</div>';
	return $field; 

}



/**
* This function builts a radio field
* @param array $formField the array that contains the elements of the form field, 
*	- these elements can be: labelText, discription, name, (selected)value, options - array of arrays("value", "text"), errMessage, required, onclick function, inlineLayout;
* @return string $field - the string with the coresponding tags and data to outpu the form field
* 
* e.g. 	buildRadioField(array("labelText"=>"Gender", "discription"=>"aaaaa", "name"=>"gender", "value"=>$gender, "options"=>array(array("male", "Male"), array("female", "Female")), "required" =>"yes"));
*/
function buildRadioField($formField){

	$field = '<div>';
	$field .= '<label for="'.$formField["name"].'" >'.$formField["labelText"].'</label>'."\n";	
	$field .= '<p>'.$formField["discription"].'</p>';
	foreach ($formField["options"] as $optionKey => $optionValue){
	
		$field .= '<div><input type="radio" name="'.$formField["name"].'" id="'.$formField["name"].'_'.$optionKey.'"    value="'.$optionValue["value"].'"  ';	  // $optionValue[0]: option value;  $optionValue[1]: option text;
							
		if ($formField["value"] == $optionValue["value"]){    //[0]: option value;  [1]: option text;
			$field .= ' checked="checked" ';
		}	
		
		if ($optionValue["onclick"] != null){    //[0]: option value;  [1]: option text;
			$field .= ' onclick="'.$optionValue["onclick"].'" ';
		}		
						
		$field .= ' > '.$optionValue["text"].'</div>';	

	}
	$field .= '</div>';
	return $field; 

}

/**
* This function builds an empty select field, its options need to be provided in javascript
* @param array $formField the array that contains the elements of the form field, 
*	- these elements can be: labelText, discription, name, multiple;
* @return string $field - the string with the coresponding tags and data to outpu the form field
* 
* e.g.	buildEmptySelectField(array("labelText"=>"aaa", "discription"=>"bbb", "name"=>"list1", "id"=>"list1", "multiple"=>"yes", "size"=>10));
*/
function buildEmptySelectField($formField){
	$field = '<div>';
	$field .= '<label for="'.$formField["name"].'" >'.$formField["labelText"].'</label>'."\n";	
	$field .= '<p>'.$formField["discription"].'</p>';
	$field .= '<select name="'.$formField["name"].'"  id="'.$formField["id"].'" size='.$formField["size"];
	if ($formField["multiple"] == "yes"){    //[0]: option value;  [1]: option text;
		$field .= " multiple " ;
	}	
	$field .= ' ></select>';	
	$field .= '</div>';
	return $field; 
}


/**
* This function builds a select field
* @param array $formField the array that contains the elements of the form field, 
*	- these elements can be: labelText, discription, name, multiple;
* @return string $field - the string with the coresponding tags and data to outpu the form field
* 
* e.g.	
*/
function buildSelectField($formField){
	$field = '<div>';
	$field .= '<label for="'.$formField["name"].'" >'.$formField["labelText"].'</label>'."\n";	
	$field .= '<p>'.$formField["discription"].'</p>';
	$field .= '<select name="'.$formField["name"].'"  id="'.$formField["id"].'" size='.$formField["size"];
	
	if ($formField["multiple"] == "yes"){    //[0]: option value;  [1]: option text;
		$field .= " multiple " ;
	}	
	$field .= ' >';	
		
	foreach ($formField["options"] as $optionKey => $optionValue){
		$field .= '<option value="'.$optionValue.'"';	
		if (($formField["value"] == $optionValue) || (is_array($formField["value"]) && in_array($optionValue, $formField["value"]))){	// check for both single and multiple selects				
			$field .= ' selected="selected" ';
		}
		$field .= '>'.$optionValue.' </option>   ';	
	}
	
	$field .= '</select></div>';
	return $field; 
}


/**
* This function builds a button 
* @param array $formField the array that contains the elements of the form field, 
* @return string $field - the string with the coresponding tags and data to outpu the button
* 
* e.g.	buildButtonField(array("type"=>"button",  "buttonText"=>"&dArr; Add &dArr;", "value"=>"add", "name"=>"add", "id"=>"add"));
*/
function buildButtonField($formField){
	$field = '<div>';
	$field .= '<button type="'.$formField["type"].'"  value="'.$formField["value"].'" name="'.$formField["name"].'" id="'.$formField["id"].'" ';
	if ($formField["onclick"] != null){    
		$field .= ' onclick="'.$formField["onclick"].'"' ;
	}
	
	$field .= '>'.$formField["buttonText"];
	$field .= '</button>';	
	$field .= '</div>';
	return $field; 
}

/**
* This function builds a text field 
* @param array $formField the array that contains the elements of the form field, 
* @return string $field - the string with the coresponding tags and data to outpu the button
* 
* e.g.	buildTextField(array("labelText"=>"Name of Employer or Institution registered at?", "type"=>"text", "name"=>"employer", "id"=>"employer", "value"=>$employer,  "required" =>"yes"));

*/
function buildTextField($formField){
	$field = '<div>';
	$field .= '<label for="'.$formField["name"].'" >'.$formField["labelText"].'</label>'."\n";	
	$field .= '<p>'.$formField["discription"].'</p>';
	$field .= '<input type="text" name="'.$formField["name"].'"  id="'.$formField["id"].'" value="'.$formField["value"].'" ><br>  ';
	$field .= '</div>';
	return $field; 
}
?>
