<!DOCTYPE HTML>
<html>
<head>
    <!-- Bootstrap -->
    <link href="../includes/bootstrap-3.0.1-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
        
</head>
<body>



<?php
         // define variables and set to empty values
        $gender = $employer ="";
        $err = array("genderErr"=>"", "employerErr"=>"");


        //prepare the form fields for user input
        $formFields = array();
  //      $formFields[] = array("question"=>"Gender", "type"=>"text", "name"=>"gender", "id"=>"gender","value"=>$gender, "errMessage"=>$err["genderErr"], "required" =>"yes");
        $formFields[] = array("question"=>"Name of Employer or Institution registered at?", "type"=>"text", "name"=>"employer", "id"=>"employer", "value"=>$employer, "errMessage"=>$err["employerErr"], "required" =>"yes");
 
 
        $method = "GET";
        $action = htmlspecialchars($_SERVER["PHP_SELF"]);
		$form = '<form method="'.$method.'" action="'.$action.'" class="well form-horizontal" role="form">'."\n";
 
		$form .= '<p><span class="error">* required field.</span></p>';
        foreach ($formFields as $formField){
			if ($formField["type"] == "text"){
                $form .= '<div class="form-group">';
                $form .= '<label for="'.$formField["name"].'" >'.$formField["question"].'</label>'."\n";
                $form .= '<input type="'.$formField["type"].'" name="'.$formField["name"].'" id="'.$formField["id"].'" value="'.$formField["value"].'" />';
				
				if ($formField["required"] == "yes"){
					$form .= '<span class="error" > * '.$formField["errMessage"].'</span></div>'."\n";
				}else{
					$form .= '<span class="error" >  '.$formField["errMessage"].'</span></div>'."\n";
				}

               
			}
        }
		
		echo $form;
?>

<form>
First name: <input type="text" name="firstname"><br>
Last name: <input type="text" name="lastname">
</form>

<form>
<input type="radio" name="sex" value="male">Male<br>
<input type="radio" name="sex" value="female">Female
</form> 

<form>
<input type="checkbox" name="vehicle" value="Bike">I have a bike<br>
<input type="checkbox" name="vehicle" value="Car">I have a car
</form>

<form name="input" action="demo_form_action.asp" method="get">
Username: <input type="text" name="user">
<input type="submit" value="Submit">
</form>



</body>
</html>