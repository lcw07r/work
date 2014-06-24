<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $pathRoot = $_SERVER['DOCUMENT_ROOT'] . '/';
	include $pathRoot.'site-resources/headfoot/auto-head-above.php'; ?>
	<title>ESRC National Centre for Research Methods</title>
	<?php include $pathRoot.'site-resources/headfoot/auto-head-below.php'; ?>
	
    <!-- Bootstrap -  this can be moved in to desktop-head-below.php
    <link href="/incoming/bootstrap-3.0.1-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    -->
</head>

<body onLoad="checkJavaScriptValidity()">
<?php include $pathRoot.'site-resources/headfoot/auto-header.php'; ?>
	
<div class="pageContent">

	<h1>Explore</h1>
	
	<div>
	
	<?php

	 // define variables and set to empty values
	$gender = $organisation = $employer = $position = $discipline = $qualification = $region = $details = $disability = $dietary ="";
	$err = array("noAnswerErr"=>"", "employerErr"=>"", "detailsErr"=>"", "disabilityErr"=>"", "dietaryErr"=>"");

	// prepare data - if submit: validate text input, check required fields and set error message when applied
	initialise($err, $gender, $organisation, $employer, $position, $discipline, $qualification, $region, $details, $disability, $dietary);

	// prepare the form fields
	
	
	
	
	
	
	$formFields = array();
	$formFields[] = array("question"=>"Gender", "type"=>"radio", "name"=>"gender", "id"=>"gender","value"=>$gender, "options"=>array("Male", "Female"), "errMessage"=>$err["noAnswerErr"], "required" =>"yes");
	$formFields[] = array("question"=>"In what type of organisation do you currently work or study", "type"=>"radio", "name"=>"organisation", "id"=>"organisation","value"=>$organisation, "options"=>array("University/College", "Research Institute", "Government/other public-sector organisation", "Private-sector organisation", "Voluntary-sector organisation", "Other (including freelance)"), "errMessage"=>$err["noAnswerErr"], "required" =>"yes");
	$formFields[] = array("question"=>"Name of Employer or Institution registered at?", "type"=>"text", "name"=>"employer", "id"=>"employer", "value"=>$employer, "errMessage"=>$err["employerErr"], "required" =>"yes");
	$formFields[] = array("question"=>"What is your current position?", "type"=>"radio", "name"=>"position", "id"=>"position","value"=>$position, "options"=>array("Junior Researcher (e.g. Research Officer, Research Fellow, Lecturer etc.)", "Senior Researcher (e.g. Senior Research Officer, Senior Lecturer etc.)", "Professor/Reader/Head of Unit/Director", "Student", "Other"), "errMessage"=>$err["noAnswerErr"], "required" =>"yes");
	$formFields[] = array("question"=>"What is your disciplinary area of expertise?", "type"=>"select", "name"=>"discipline", "id"=>"discipline","value"=>$discipline, "options"=>array("", "Area studies", "Demography", "Economic and Social History", "Economics", "Education", "Environmental planning", "Human Geography", "Linguistics", "Management and Business Studies", "Political Science and International Studies", "Psychology", "Social Anthropology", "Social Policy", "Social Work", "Socio-Legal Studies", "Sociology", "Science and Technology Studies", "Statistics, Methods and Computing", "Disciplines outside the Social Sciences", "Arts and Humanities", "Biological Sciences", "Engineering and Physical Sciences", "Environmental Science", "Medical Sciences"), "errMessage"=>$err["noAnswerErr"], "required" =>"yes");
	$formFields[] = array("question"=>"Highest Qualification?", "type"=>"radio", "name"=>"qualification", "id"=>"qualification","value"=>$qualification, "options"=>array("Bachelors degree", "Masters degree", "Doctoral degree", "None of these"), "errMessage"=>$err["noAnswerErr"], "required" =>"yes");
	$formFields[] = array("question"=>"What do you consider to be your region?", "type"=>"select", "name"=>"region", "id"=>"region","value"=>$region, "options"=>array("", "London", "South-East", "South-West", "East of England", "Midlands", "North-West", "North-East", "Wales",  "Scotland", "Northern Ireland", "EU (other than UK)", "Outside the EU"), "errMessage"=>$err["noAnswerErr"], "required" =>"yes");
	$formFields[] = array("question"=>"Please provide details to support your booking (e.g. student no. or name of institution/ESRC research project/charity organisation) ", "type"=>"textarea", "name"=>"details", "id"=>"details", "value"=>$details, "errMessage"=>$err["detailsErr"], "required" =>"no");
	$formFields[] = array("question"=>"Do you have any disability which may require special arrangement of facilities (please give details)? ", "type"=>"textarea", "name"=>"disability", "id"=>"disability", "value"=>$disability, "errMessage"=>$err["disabilityErr"], "required" =>"no");
	$formFields[] = array("question"=>"Do you have any special dietary or other requirements?", "type"=>"textarea", "name"=>"dietary", "id"=>"dietary", "value"=>$dietary, "errMessage"=>$err["dietaryErr"], "required" =>"no");


	$method = "POST";
	$action = htmlspecialchars($_SERVER["PHP_SELF"]);
	$form = '<form method="'.$method.'" action="'.$action.'" class="well form-horizontal" role="form">'; 
	$form .= '<p><span class="red">* required field.</span></p>';
	
	foreach ($formFields as $formField){
	
		$form .= '<div class="form-group">';
		
		$form .= '<label for="'.$formField["name"].'" >'.$formField["question"].'</label>';	

		if ($formField["required"] == "yes"){
			$form .=  '<span class="red" > * </span><br/>';
		}			
					
		$form .= '<br/><span class="red" > '.$formField["errMessage"].'</span></div><br/>';	
	
		if ($formField["type"] == "text"){	
			$form .= '<input type="'.$formField["type"].'" name="'.$formField["name"].'" id="'.$formField["id"].'" value="'.$formField["value"].'" class="form-control"/>';	
		}
		
		if ($formField["type"] == "textarea"){	
			$form .= '<'.$formField["type"].' name="'.$formField["name"].'" id="'.$formField["id"].'" value="'.$formField["value"].'" class="form-control"  rows="4"></textarea>';	
		}
		
		if ($formField["type"] == "radio"){    
			$form .= '<div class="radio">';
			foreach ($formField["options"] as $optionKey => $optionValue){
				$form .= '<input type="'.$formField["type"].'" name="'.$formField["name"].'" id="'.$optionKey.'"  value="'.$optionValue.'"   ';						
				if ($formField["value"] == $optionValue){
					$form .= ' "checked" ';
				}					
				$form .= ' > '.$optionValue;	
			}  
			$form .= '</div>';             			
		}
		
		if ($formField["type"] == "select"){   
			$form .= '<select class="form-control" name="'.$formField["name"].'">';
			foreach ($formField["options"] as $optionKey => $optionValue){
				$form .= '<option value="'.$optionValue.'"';						
				if ($formField["value"] == $optionValue){
					$form .= ' "checked" ';
				}					
				$form .= '> '.$optionValue.' </option>   ';	
			} 
			$form .= '</select>';  				             			
		}
	}
	
	
	$form .= '<div class="form-group">';
	$form .= '<div class="col-sm-offset-2 col-sm-10"><input class="btn btn-primary" type="submit" name="submit" value="Submit"></div>';
	$form .= '</div>';
	$form .= '</form>';
	$form .= '<br/><br/>';
        
	echo $form;






	?>	




	</div>
	
</div>



<?php include $pathRoot.'site-resources/headfoot/auto-footer.php'; ?>
</body>
</html>


<?php
/**
* This function prepare the user input data as default output values when the form is submitted to itself
*/
function initialise(&$err, &$gender, &$organisation, &$employer, &$position, &$discipline, &$qualification, &$region, &$details, &$disability, &$dietary)
{
	if(isset($_POST['submit'])){
	
		// check if any of the required fields are empty, if yes, set error messages; if not, validate the data
		
		if (empty($_POST["gender"])){
			$err["genderErr"] = "gender is required";
		}else{
			$gender = test_input($_POST["gender"]);
		}
		
		if (empty($_POST["organisation"])){
			$err["organisationErr"] = "organisation is required";
		}else{
			$organisation = test_input($_POST["organisation"]);
		}
		
		if (empty($_POST["employer"])){
			$err["employerErr"] = "employer is required";
		}else{
			$employer = test_input($_POST["employer"]);
		}
		
		if (empty($_POST["position"])){
			$err["positionErr"] = "position is required";
		}else{
			$position = test_input($_POST["position"]);
		}
		
		if (empty($_POST["discipline"])){
			$err["disciplineErr"] = "discipline is required";
		}else{
			$discipline = test_input($_POST["discipline"]);
		}
		
		if (empty($_POST["qualification"])){
			$err["qualificationErr"] = "qualification is required";
		}else{
			$qualification = test_input($_POST["qualification"]);
		}
		
		if (empty($_POST["region"])){
			$err["regionErr"] = "region is required";
		}else{
			$region = test_input($_POST["region"]);
		}  	
	}   
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>