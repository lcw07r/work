<html>
<body>

	
<div class="pageContent">

	<h1>Page Title Here</h1>

	<div>

	<?php

	//include $pathRoot.'site-resources/link.php';
	//mysql_query("SET NAMES UTF8");
	//$initialKeyWordOptions = getInitialKeyWordOptions();
	$initialKeyWordOptions=array();
	$initialKeyWordOptions[] = array('1.1.', '1.1.	line1');
	$initialKeyWordOptions[] = array('3.1.', '3.1.	line3');
	$initialKeyWordOptions[] = array('1.2.', '1.2.	line2');
	
	//out put main content
	if (isset($_POST['submit'])){     

		initialise();    //If the form is submited: validate input, check required fields, set error message when applied;
		if (array_filter($err)) {   //If has error found, out put the form again (with error messages) ;
			outputRegisterForm();  			
		}else {   // if pass all checks, out put the search result.
			outputSearchResult();  			
		}
		
	}else {
		
		// If the form is not submited yet, define variables and out put the initial form
		$gender = $organisation = $employer = $position = $discipline = $qualification = $region = $details = $disability = $dietary = $agree = $keywordOrderOption  = "";
		$err = $chosenKeywords = array();
 		outputRegisterForm();
	}
	
	
        if (isset($_GET['js_var'])) {
        	$php_var = $_GET['js_var'];
        	//$php_var = json_decode($_GET['js_var'], true); 
 		}else{
 			$php_var = "<br />*************js_var is not set!";
        	
        }
        
        echo "<br />=== ".$php_var." ======================<br />";

/*
        if (isset($_GET['sumbittedKeywords'])) {
        	$php_var = $_GET['sumbittedKeywords'];
        	//$php_var = json_decode($_GET['sumbittedKeywords'], true); 
 		}else{
 			$php_var = "<br />************* sumbittedKeywords is not set!";
        	
        }
        
        echo "<br />=== ".$php_var." ======================<br />";
*/



	?>
	</div>	

	<a href="#" id="link">Click me!</a>

</div>

<script>
      
        

function outputkeywordoptions(initialKeyWordOptions){  // aim result:  add keyword options to the select with <option value="'+keywordID+'">' + keyword + '</option>
	
	var initialKeyWordOptionsSelect = document.getElementById("initialKeyWordOptions");

	for(var i=0;i<initialKeyWordOptions.length;i++){
		
		var keyword = initialKeyWordOptions[ i ][1];
		var keywordID = initialKeyWordOptions[ i ][0];
	
		var option = document.createElement("option");	
		option.text = keyword;
		option.value = keywordID;
		initialKeyWordOptionsSelect.add(option);
	}
	
	updateKeywordOrder();
}

var initialKeyWordOptions = <?php echo json_encode($initialKeyWordOptions ); ?>;  // get the initial keyword options array from php variable
outputkeywordoptions(initialKeyWordOptions);  // fill the keyword selection box with the initial options

function sortAlphabetically(){    

	var keywordOptions = document.getElementById("initialKeyWordOptions");
	var initialKeyWordOptions = jQuery.makeArray(keywordOptions.options).sort(function(a,b) {
									return (a.innerHTML.match(/[^&+n+b+s+p+;][a-zA-Z][a-zA-Z ]{0,}/g) > b.innerHTML.match(/[^&+n+b+s+p+;][a-zA-Z][a-zA-Z ]{0,}/g)) ? 1 : -1;
								});
	$("#initialKeyWordOptions").html(initialKeyWordOptions); 	
	
	var chosenKeywords_select = document.getElementById("chosenKeywords_select");
	var chosenKeywords_select = jQuery.makeArray(chosenKeywords_select.options).sort(function(a,b) {
									return (a.innerHTML.match(/[^&+n+b+s+p+;][a-zA-Z][a-zA-Z ]{0,}/g) > b.innerHTML.match(/[^&+n+b+s+p+;][a-zA-Z][a-zA-Z ]{0,}/g)) ? 1 : -1;
								});
	$("#chosenKeywords_select").html(chosenKeywords_select); 
	
}

function sortByTypologySectionNumber(){

	var keywordOptions = document.getElementById("initialKeyWordOptions");
	var initialKeyWordOptions = jQuery.makeArray(keywordOptions.options).sort(function(a,b) {
									return (a.innerHTML > b.innerHTML) ? 1 : -1;
								});
	$("#initialKeyWordOptions").html(initialKeyWordOptions);  
	
	var chosenKeywords_select = document.getElementById("chosenKeywords_select");
	//console.log(chosenKeywords_select.options);
	var chosenKeywords_select = jQuery.makeArray(chosenKeywords_select.options).sort(function(a,b) {
									return (a.innerHTML > b.innerHTML) ? 1 : -1;
								});
	$("#chosenKeywords_select").html(chosenKeywords_select);  
}

function updateKeywordOrder(){
	
	if (document.getElementById("keywordOrderOption_1").checked ==true){
		sortAlphabetically();
	}else{
		sortByTypologySectionNumber();
	}

}



function addToList() {   
	// called when the Add button is clicked, aim to 1. added the selected keywords to the chosen keywords select; 2. remove the selected keywords from the initial keywords select

	var keywordOptions = document.getElementById("initialKeyWordOptions");
	var chosenKeywords_select = document.getElementById("chosenKeywords_select");
	var selectedKeywordIndex = new Array();

	if ($('#initialKeyWordOptions :selected').length +  chosenKeywords_select.options.length  > 15) {  
		alert("Sorry, you can only choose a maximum of 15 keywords.");
		return;
	}
	
    for (i = 0; i < keywordOptions.options.length; i++) {
    		
   		if (keywordOptions.options[ i ].selected) {
   		
     		var keyword = keywordOptions.options[ i ].text; 
    		var keywordID = keywordOptions.options[ i ].value;   
    		var option = document.createElement("option");
  
			option.text = keyword;
			option.value = keywordID;
			chosenKeywords_select.add(option);
			
			selectedKeywordIndex.push(i); // collect the keywords for move after the for loop
			
        }
    }
    

    
    var lastIndex = selectedKeywordIndex.length-1;
    for (i = lastIndex; i > -1; i--) {

		keywordOptions.options.remove(selectedKeywordIndex[i]);
    }
    
   updateKeywordOrder();   // sort the list

}	


function deleteFromList(){   // called when the Delete button is clicked, aim to 1. delect the selected keywords from the chosen keywords select; 2. add the selected keywords back to the initial keywords select


    var keywordOptions = document.getElementById("initialKeyWordOptions");
	var chosenKeywords_select = document.getElementById("chosenKeywords_select");
	var lastIndex = chosenKeywords_select.options.length -1;	
		
	for (i = lastIndex; i > -1; i--) {
	
   		if (chosenKeywords_select.options[ i ].selected) {   			
   			
   			var keyword = chosenKeywords_select.options[ i ].text;
   			var keywordID = chosenKeywords_select.options[ i ].value;
   			var option = document.createElement("option");
   			option.text = keyword;
   			option.value = keywordID;
			keywordOptions.add(option);   // add it back to the options list
   			 			
   			chosenKeywords_select.options.remove(i);   	// remove the selected item from the chosen keywords list
   			
		}    
    }
	//alert(typeof chosenKeywords_select.options);
	//console.log(chosenKeywords_select.options);
   updateKeywordOrder();   // sort the list  
}





     
     
  
  
		
var js_var  = ["Saab", "Volvo", "BMW"];      
document.getElementById("link").onclick = function () {

	
        var sumbittedKeywordObject  = document.getElementById("chosenKeywords_select");
        var sumbittedKeywords = new Array();
        alert(sumbittedKeywordObject.options.length);////////////////////////////////////////////  this is 0 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        for(var i=0;i<sumbittedKeywordObject.options.length;i++){    //trim the numbers and put the keywords in array
		 alert('ssssssss');
			var keyword = sumbittedKeywordObject.options[ i ].text; 
			alert(keyword);
			keyword.match(/[^&+n+b+s+p+;][a-zA-Z][a-zA-Z ]{0,}/g);
			//alert(sumbittedKeywords);
			sumbittedKeywords.push(keyword);
		}
		//alert(sumbittedKeywords);
	
	window.location = "?js_var=" + sumbittedKeywords;
	alert('eeeeeeeee');
}
        

</script>

</body>
</html>

<?php 

function getInitialKeyWordOptions(){
	//global $initialKeyWordOptions;
	$sql = "Select * from ncrm_keywords order by class_id";
	$result = mysql_query($sql);
	
	while($row = mysql_fetch_array($result)){
		
		$initialKeyWordOptions[] = array($row['class_id'], $row['class_name']);
	}
	return $initialKeyWordOptions;
}

/**
* This function set the form data and build the form
*/
function outputRegisterForm(){
	global $err, $gender, $organisation, $employer, $position, $discipline, $qualification, $region, $details, $disability, $dietary, $agree, $keywordOrderOption;

	$formFields = array();
	$formFields[] = array("question"=>"Gender", "type"=>"radio", "name"=>"gender", "id"=>"gender","value"=>$gender, "options"=>array(array("male", "Male"), array("female", "Female")), "errMessage"=>$err["genderErr"], "required" =>"yes", "layout"=>"inline");
	$formFields[] = array("question"=>"In what type of organisation do you currently work or study", "type"=>"radio", "name"=>"organisation", "id"=>"organisation","value"=>$organisation, "options"=>array(array("university", "University/College"), array("institute", "Research Institute"), array("public-sector","Government/other public-sector organisation"), array("private-sector","Private-sector organisation"), array("voluntary-sector","Voluntary-sector organisation"), array("other","Other (including freelance)")), "errMessage"=>$err["organisationErr"], "required" =>"yes");
	$formFields[] = array("question"=>"Name of Employer or Institution registered at?", "type"=>"text", "name"=>"employer", "id"=>"employer", "value"=>$employer, "errMessage"=>$err["employerErr"], "required" =>"yes");
	$formFields[] = array("question"=>"What is your current position?", "type"=>"radio", "name"=>"position", "id"=>"position","value"=>$position, "options"=>array(array("junior","Junior Researcher (e.g. Research Officer, Research Fellow, Lecturer etc.)"), array("senior","Senior Researcher (e.g. Senior Research Officer, Senior Lecturer etc.)"), array("professor","Professor/Reader/Head of Unit/Director"), array("student","Student"), array("other","Other")), "errMessage"=>$err["positionErr"], "required" =>"yes");
	$formFields[] = array("question"=>"What is your disciplinary area of expertise?", "type"=>"select", "name"=>"discipline", "id"=>"discipline","value"=>$discipline, "options"=>array("", "Area studies", "Demography", "Economic and Social History", "Economics", "Education", "Environmental planning", "Human Geography", "Linguistics", "Management and Business Studies", "Political Science and International Studies", "Psychology", "Social Anthropology", "Social Policy", "Social Work", "Socio-Legal Studies", "Sociology", "Science and Technology Studies", "Statistics, Methods and Computing", "Disciplines outside the Social Sciences", "Arts and Humanities", "Biological Sciences", "Engineering and Physical Sciences", "Environmental Science", "Medical Sciences"), "errMessage"=>$err["disciplineErr"], "required" =>"yes");
	$formFields[] = array("question"=>"Highest Qualification?", "type"=>"radio", "name"=>"qualification", "id"=>"qualification","value"=>$qualification, "options"=>array(array("bachelors","Bachelors degree"), array("masters","Masters degree"), array("doctoral","Doctoral degree"), array("none","None of these")), "errMessage"=>$err["qualificationErr"], "required" =>"yes");
	$formFields[] = array("question"=>"What do you consider to be your region?", "type"=>"select", "name"=>"region", "id"=>"region","value"=>$region, "options"=>array("", "London", "South-East", "South-West", "East of England", "Midlands", "North-West", "North-East", "Wales",  "Scotland", "Northern Ireland", "EU (other than UK)", "Outside the EU"), "errMessage"=>$err["regionErr"], "required" =>"yes");
	//$formFields[] = array("question"=>"Please provide details to support your booking (e.g. student no. or name of institution/ESRC research project/charity organisation) ", "type"=>"textarea", "name"=>"details", "id"=>"details", "value"=>$details, "errMessage"=>$err["detailsErr"], "required" =>"no");
	//$formFields[] = array("question"=>"Do you have any disability which may require special arrangement of facilities (please give details)? ", "type"=>"textarea", "name"=>"disability", "id"=>"disability", "value"=>$disability, "errMessage"=>$err["disabilityErr"], "required" =>"no");
	//$formFields[] = array("question"=>"Do you have any special dietary or other requirements?", "type"=>"textarea", "name"=>"dietary", "id"=>"dietary", "value"=>$dietary, "errMessage"=>$err["dietaryErr"], "required" =>"no");
	$formFields[] = array("question"=>"I agree to the terms and conditions", "type"=>"checkbox", "name"=>"agree", "id"=>"agree", "value"=>$agree, "errMessage"=>$err["agreeErr"], "required" =>"yes");

	$formFields[] = array("question"=>"Event / course keywords", "type"=>"custome", "name"=>"eventAndCourseKeywords", "id"=>"eventAndCourseKeywords", "value"=>$eventAndCourseKeywords, "functionCall"=>"eventAndCourseKeywords", "errMessage"=>$err["chosenKeywordErr"], "required" =>"yes");
	
//	$formFields[] = array("type"=>"hidden", "name"=>"initialKeyWordOptions_orderedByTpology", "id"=>"initialKeyWordOptions_orderedByTpology", "value"=>$initialKeyWordOptions_orderedByTpology);

	$formFields[] = array("type"=>"submit", "value"=>"submit", "name"=>"submit", "id"=>"submit");

	$method = "POST";
	$action = htmlspecialchars($_SERVER["PHP_SELF"]);
	
	$form = builtHTMLform($method, $action, $formFields);
	echo $form;
}

/**
* This function build a HTML form with the provided form data
*/
function builtHTMLform($method, $action, $formFields){
	$form = '<form method="'.$method.'" action="'.$action.'" class="well" >'; 
	$form .= '<p>Fields marked with a <span class="red">* </span>are mandatory.</p>';

	foreach ($formFields as $formField){

		$form .= '<div class="form-group">';
	
		$form .= '<label for="'.$formField["name"].'" >'.$formField["question"].'</label>';	

		if ($formField["required"] == "yes"){
			$form .=  '<span class="red" > * </span>';
		}	
						
		$form .= '<span class="red" > '.$formField["errMessage"].'</span><br/>';	
		
		if ($formField["type"] == "text"){	
			$field = buildTextField($formField);
			$form .= $field;
		}
	
		if ($formField["type"] == "textarea"){	
			$field = buildTextareaField($formField);
			$form .= $field;
		}
	
		if ($formField["type"] == "radio"){    
			
			$field = buildRadioField($formField);
			$form .= $field;						
		}
	
		if ($formField["type"] == "select"){   
			$field = buildSelectField($formField);
			$form .= $field;				             			
		}
		
		if ($formField["type"] == "checkbox"){	
			$field = buildCheckboxField($formField);
			$form .= $field;
		}
		
		if ($formField["type"] == "custome"){	
			$field = $formField["functionCall"]();
			$form .= $field;	
		}	
		
		if (($formField["type"] == "submit") || ($formField["type"] == "button") ||  ($formField["type"] == "reset")){	
			$field = buildButtonField($formField);
			$form .= $field;			
		}
		
		if ($formField["type"] == "hidden"){	
			$field = buildCHiddenField($formField);
			$form .= $field;
		}
	
		$form .= '</div>';
	}
	
	$form .= '</form>';
	$form .= '<br/><br/>';
	
	return $form;
}

function buildCHiddenField($formField){
	$field .= '<input type="'.$formField["type"].'" name="'.$formField["name"].'" id="'.$formField["id"].'" value="'.$formField["value"].'" class="form-control"/>';
	return $field; 
}


function buildTextField($formField){
	$field .= '<input type="'.$formField["type"].'" name="'.$formField["name"].'" id="'.$formField["id"].'" value="'.$formField["value"].'" class="form-control"/>';
	return $field; 
}

function buildTextareaField($formField){
	$field .= '<'.$formField["type"].' name="'.$formField["name"].'" id="'.$formField["id"].'" value="'.$formField["value"].'" class="form-control"  rows="4">'.$formField["value"].'</textarea>';
	return $field; 
}

function buildCheckboxField($formField){
	$field = '<input type="'.$formField["type"].'" name="'.$formField["name"].'" id="'.$formField["id"].'" value="'.$formField["value"].'" ';	
	
	if ($formField["value"] == 1){
		$field .= ' checked="checked" ';
	}					
	$field .= ' > ';	
	return $field; 
}

function buildRadioField($formField){
	$field = "";
	foreach ($formField["options"] as $optionKey => $optionValue){
		if($formField["layout"] == "inline"){
			$field .= '<div class="radio_inline">';
		}else{
			$field .= '<div>';
		}
				
		//$field .= '<input type="'.$formField["type"].'" onclick="'.$formField["onclick"].'" name="'.$formField["name"].'" id="'.$formField["name"].'_'.$optionKey.'"  value="'.$optionKey.'"   ';	
		$field .= '<input type="'.$formField["type"].'" onclick="'.$formField["onclick"].'" name="'.$formField["name"].'" id="'.$formField["name"].'_'.$optionKey.'"    value="'.$optionValue[0].'" ';	  // $optionValue[0]: option value;  $optionValue[1]: option text;

		/*
		if ($formField["postedValueOption"] == "selectedOptionKey"){
			$field .= ' value="'.$optionKey.'"  ';
			if ($formField["value"] == $optionKey){
				$field .= ' checked="checked" ';
			}
		}else{
			$field .= ' value="'.$optionValue.'"  ';
			if ($formField["value"] == $optionValue){
				$field .= ' checked="checked" ';
			}
		}
		*/
							
		if ($formField["value"] == $optionValue[0]){    //[0]: option value;  [1]: option text;
			$field .= ' checked="checked" ';
		}	
						
		$field .= ' > '.$optionValue[1];	
		$field .= '</div>'; 
	}
	return $field; 
}

function buildSelectField($formField){
	$field = '<select class="form-control" name="'.$formField["name"].'"  id="'.$formField["id"].'" size='.$formField["size"].'  multiple="'.$formField["multiple"].'">';
	foreach ($formField["options"] as $optionKey => $optionValue){
		$field .= '<option value="'.$optionValue.'"';	
		if (($formField["value"] == $optionValue) || (is_array($formField["value"]) && in_array($optionValue, $formField["value"]))){	// check for both single and multiple selects				
			$field .= ' selected="selected" ';
		}
		if ($formField["showOptionKey"] == "yes"){
			$field .= '>'.$optionKey."  ".$optionValue.' </option>   ';			
		}else{					
			$field .= '>'.$optionValue.' </option>   ';	
		}
	} 
	$field .= '</select>';
	return $field; 
}

function buildButtonField($formField){
	$field = '<div class="form-group">';
	$field .= '<input type="'.$formField["type"].'" name="'.$formField["name"].'"  id="'.$formField["id"].'"  value="'.$formField["value"].'" onlick="'.$formField["onclickFunction"].'"/>';
	$field .= '</div>';
	return $field; 
}

function buildMultipleButtonsField($formField){
	$field = '<div class="form-group '.$formField["class"].'">';		
	if (is_array($formField["buttonList"])){
		foreach ($formField["buttonList"] as $button){
			$field .= '<input type="'.$button["type"].'" name="'.$button["name"].'"  id="'.$button["id"].'" value="'.$button["value"].'" onclick="'.$button["onclick"].'"/>   ';
		}
	}	
	$field .= '</div>';	
	return $field; 
}

/**
* This function prepare the user input data as default output values when the form is submitted to itself
*/
function initialise()
{
	global $err, $gender, $organisation, $employer, $position, $discipline, $qualification, $region, $details, $disability, $dietary, $agree, $chosenKeywords, $keywordOrderOption;

	// check if any of the required fields are empty, if yes, set error messages; if not, validate the data

	if (empty($_POST["gender"]) && $_POST["gender"] != 0){
		$err["genderErr"] = "gender is required";
	}else{
		$gender = test_input($_POST["gender"]);
	}

	if (empty($_POST["organisation"]) && $_POST["organisation"] != 0){
		$err["organisationErr"] = "organisation is required";
	}else{
		$organisation = test_input($_POST["organisation"]);
	}

	if (empty($_POST["employer"])){
		$err["employerErr"] = "employer is required";
	}else{
		$employer = test_input($_POST["employer"]);
	}

	if (empty($_POST["position"]) && $_POST["position"] != 0){
		$err["positionErr"] = "position is required";
	}else{
		$position = test_input($_POST["position"]);
	}

	if (empty($_POST["discipline"])){
		$err["disciplineErr"] = "discipline is required";
	}else{
		$discipline = test_input($_POST["discipline"]);
	}

	if (empty($_POST["qualification"]) && $_POST["qualification"] != 0){
		$err["qualificationErr"] = "qualification is required";
	}else{
		$qualification = test_input($_POST["qualification"]);
	}

	if (empty($_POST["region"])){
		$err["regionErr"] = "region is required";
	}else{
		$region = test_input($_POST["region"]);
	}  
	
	$details = test_input($_POST["details"]);
	$disability = test_input($_POST["disability"]);
	$dietary = test_input($_POST["dietary"]);	
	
	$keywordOrderOption = test_input($_POST["keywordOrderOption"]);
	

	if (!isset($_POST["agree"])){
		$err["agreeErr"] = "agree is required";
	}else{
		$agree = 1;
	}
	
	if (empty($_POST["chosenKeywords_select"])){
		$err["chosenKeywordErr"] = "please select keyword(s)";
	}else{
		$chosenKeywords = test_input($_POST["chosenKeywords_select"]);
	}
	echo "  ---------------------------------- ".$_POST["chosenKeywords_select"];

}

/**
* This function validate input data
*/
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/**
* This function set the content of a custome form field that named eventAndCourseKeywords
*/
function eventAndCourseKeywords(){
	global $keywordOrderOption,  $chosenKeywords, $initialKeyWordOptions;

	
	$field = '<p>Please select from the list of pre-specified keywords.  To select/de-select multiple items, hold down the control key.</p>';	


	$formField4 = array("type"=>"radio", "name"=>"keywordOrderOption", "id"=>"keywordOrderOption", "onclick"=>"updateKeywordOrder()", "value"=>$keywordOrderOption, "options"=>array(array("typology","Display keywords as research methods typology"), array("alphabetically"," Display keywords alphabetically")));
	$field .= buildRadioField($formField4);
	
	//$formField1 = array("name"=>"initialKeyWordOptions", "id"=>"initialKeyWordOptions","multiple"=>"multiple", "size"=>10, "showOptionKey"=>"no", "options"=>$initialKeyWordOptions, "errMessage"=>$err["keywordOptionsErr"], "required" =>"yes");
	$formField1 = array("name"=>"initialKeyWordOptions", "id"=>"initialKeyWordOptions", "multiple"=>"multiple", "size"=>10, "showOptionKey"=>"no", "options"=>$chosenKeywords,  "required" =>"yes");
	$field .= buildSelectField($formField1);
	


  	$formField3 = array("fieldType"=>"buttons", "class"=>"center",  "buttonList"=>array(array("type"=>"button", "value"=>" ↓ Add ↓ ", "name"=>"add", "id"=>"add", "onclick"=>"addToList()"), array("type"=>"button", "value"=>" ↑ Delete ↑ ", "name"=>"delete", "id"=>"delete", "onclick"=>"deleteFromList()"))   );
	$field .= buildMultipleButtonsField($formField3);
	
	$field .= '<span class="tooltip">Your chosen keywords</span>';
	$formField2 = array("name"=>"chosenKeywords_select", "id"=>"chosenKeywords_select", "multiple"=>"multiple", "size"=>10, "showOptionKey"=>"no", "options"=>$chosenKeywords, "errMessage"=>$err["chosenKeywordErr"], "required" =>"yes");
	$field .= buildSelectField($formField2);

//	$field .= '<select id="keywordChosenList"></select>';
	
	//$formField5 = array("type"=>"textarea", "name"=>"chosenKeywords", "id"=>"chosenKeywords",   "required" =>"no");
	//$field .= buildTextareaField($formField5);

	return $field;
}

function outputSearchResult(){
	global $err, $gender, $organisation, $employer, $position, $discipline, $qualification, $region, $details, $disability, $dietary, $agree, $chosenKeywords;

 echo '6666aaaa';
 echo '<br/>err: '.$err;
 echo '<br/>gender: '.$gender;
 echo '<br/>organisation: '.$organisation;
 echo '<br/>employer: '.$employer;
 echo '<br/>position: '.$position;
 echo '<br/>discipline: '.$discipline;
 echo '<br/>qualification: '.$qualification;
 echo '<br/>region: '.$region;
 
 echo '<br/>agree: '.$agree;
 echo '<br/>chosenKeywords: '.$chosenKeywords;
 var_dump($err);

 
}
?>

