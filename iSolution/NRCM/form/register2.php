<?php
session_start();
$gender = ""; $organisation = ""; $employer = "";  $position = "";  $degree = ""; $degreeName = ""; $degreeTime = "";
$degreeInstitution = ""; $discipline = ""; $qualification = ""; $region = ""; $disability = ""; $dietary = ""; $agree=""; $uk="" ; $details = "";
 include $pathRoot.'site-resources/link.php';
mysql_query("SET NAMES UTF8");

$userID = $_SESSION['userID'];

if ($_POST['reg2']) {

	  foreach ($_POST as $key => $value) {
	  // First, replace UTF-8 characters.
	 $value = str_replace(
	 array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"),
	 array("'", "'", '"', '"', '-', '--', '...'),
	 $value);
	 // Next, replace their Windows-1252 equivalents.
	 $value = str_replace(
	 array(chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133)),
	 array("'", "'", '"', '"', '-', '--', '...'),
	 $value);
	 $value = mysql_real_escape_string($value);
	
	  $data[] = "$value";
	  if ($key == "gender") {$gender = $value;}
	  elseif ($key == "organisation") {$organisation = $value;}
	  elseif ($key == "employer") {$employer = $value;}
	  elseif ($key == "position") {$position = $value;}
	  
	  elseif ($key == "degree") {$degree = $value;}
	  elseif ($key == "degreeName") {$degreeName = $value;}
	  elseif ($key == "degreeTime") {$degreeTime = $value;}
	  elseif ($key == "degreeInstitution") {$degreeInstitution = $value;}
	  
	  elseif ($key == "discipline") {$discipline = $value;}
	  elseif ($key == "qualification") {$qualification = $value;}
	  elseif ($key == "region") {$region = $value;}
	  elseif ($key == "disability") {$disability = $value;}
	  elseif ($key == "dietary") {$dietary = $value;}
	  elseif ($key == "agree") {$agree = $value;}
	  elseif ($key == "uk") {$uk = $value;}
	  elseif ($key == "details") {$details = $value;}
	  elseif ($key == "pepa") {$pepa = $value;}
	  elseif ($key == "pepaEmail") {$pepaEmail = $value;}
	  
	 }
	 
}


else {

		$sql="SELECT * FROM UserProfile WHERE userID = '".$userID."'";
		$qry = mysql_query($sql);
		$row=mysql_fetch_array($qry);
		if (mysql_num_rows($qry) == 1) {
			$gender = $row['gender']; 
			$organisation = $row['organisation']; 
			$employer = $row['employer'];  
			$position = $row['position'];  
			$degree = $row['degree']; 
			$degreeName = $row['degreeName']; 
			$degreeTime = $row['degreeTime'];
			$degreeInstitution = $row['degreeInstitution']; 
			$discipline = $row['discipline']; 
			$qualification = $row['qualification']; 
			$region = $row['region']; 
			$disability = $row['disability']; 
			$dietary = $row['dietary']; 
			$agree=$row['agree'];
			$uk = $row['uk']; 
			$details=$row['details'];
		}
		
}




if (count($data) > 2) {
	$errortxt="";
	if ($position!="student") {
		if ($gender=="" || $organisation=="" || $employer=="" || $position=="" || $discipline=="" || $qualification=="" || $region=="" || $agree=="") {
			$errortxt = "<font color='red'>Please fill out the questions highlighted in red</font>";
		}
	}
	elseif($gender=="" || $organisation=="" || $employer=="" || $position=="" || $discipline=="" || $qualification=="" || $region=="" || $degree=="" || $degreeName=="" || $degreeTime=="" || $degreeInstitution=="" || $agree=="" || $uk=="") {
			$errortxt = "<font color='red'>Please fill out the questions highlighted in red</font>";
	}

}


?>	
    
     <?php 
if (count($data) > 2 && $errortxt=="") {

	$sql="SELECT * FROM UserProfile WHERE userID = '".$userID."'";
$qry = mysql_query($sql);
$result=mysql_fetch_array($qry);

if (mysql_num_rows($qry) == 0) {

	$sql="INSERT INTO UserProfile ( userID, gender, organisation, employer, position, degree, degreeName, degreeTime, degreeInstitution, discipline, qualification, region, disability, dietary, agree, uk, details) VALUES ('$userID', '$gender', '$organisation', '$employer', '$position', '$degree', '$degreeName', '$degreeTime', '$degreeInstitution', '$discipline', '$qualification', '$region', '$disability', '$dietary', '$agree', '$uk', '$details')";
	
	$qry = mysql_query($sql);
	echo mysql_error();


}

else {
  	

	$sql="UPDATE UserProfile SET gender = '$gender', organisation = '$organisation', employer = '$employer', position = '$position', degree = '$degree', degreeName = '$degreeName', degreeTime = '$degreeTime', degreeInstitution = '$degreeInstitution', discipline = '$discipline', qualification = '$qualification', region = '$region', disability = '$disability', dietary = '$dietary', agree = '$agree', uk = '$uk', details = '$details' WHERE userID = '$userID'";
	$qry = mysql_query($sql);
	echo mysql_error();
}
	
	
    echo "<p>Thank you for registering your details, you will receive a confirmation email soon</p><br><br>";
	
	$eventID = mysql_real_escape_string($_REQUEST['id']);
	$sql = "SELECT establishment, title FROM ncrm_records WHERE record_id = '$eventID'"; 
	$qry = mysql_query($sql);
	$row = mysql_fetch_array($qry);
	$node = $row['establishment']; 
	$title = $row['title']; 
	
	//kylie_g@ifs.org.uk
	//enquires@pepa.ac.uk
	if ($node == "PEPA") {$admin_email = "enquiries@pepa.ac.uk";}
	elseif ($node == "NOVEL") {$admin_email = "novella@ioe.ac.uk";}
	elseif ($node == "PATH") {$admin_email = "pathways@lshtm.ac.uk";}
	elseif ($node == "TALIS") {$admin_email = "a.oneill@leeds.ac.uk";}
	else {$admin_email = "je1@soton.ac.uk";}
	$subject = "New Booking: ".$title;
	
	
	
	$sql="SELECT * FROM UserDetails INNER JOIN UserProfile ON UserDetails.userID = UserProfile.userID WHERE UserDetails.userID = '".$userID."'";
	$qry = mysql_query($sql);
	$row=mysql_fetch_array($qry);
	
	
	if ($node == "PEPA") {
		$message = "Thank you for your booking request, a member of staff will be in contact with you shortly.  Please note that your booking is not guaranteed until you have received a confirmation email from the PEPA administrator.". "\n\n";
		
	}
	else {
		$message = "This is your booking confirmation". "\n\n";
		
		if ($node == "PATH") {
		$message.="You will be contacted shortly for payment options". "\n\n";
		}
	}
	 
	$message.=$row['title']." ".$row['firstname']." ".$row['initial']." ".$row['lastname']."\n".
	$row['email']."\n".
	$row['address1']."\n".
	$row['address2']."\n".
	$row['town']."\n".
	$row['postcode']."\n".
	$row['country']."\n".
	$row['telephone']."\n\n".
	
	"Gender: ".$row['gender']."\n". 
	"Type of Organisation: ".$row['organisation']."\n". 
	"Employer or Institution: ".$row['employer']."\n".  
	"Current position: ".$row['position']."\n"; 
	 
	if ($row['position'] == "Student") {
		$message.= "Type of degree: ".$row['degree']."\n". 
		"Name of degree: ".$row['degreeName']."\n". 
		"Registered: ".$row['degreeTime']."\n".
		"University/College: ".$row['degreeInstitution']."\n".
		"UK based:" .$row['uk']."\n";
	}
	
	$message.= "Discipline: ".$row['discipline']."\n". 
	"Highest Qualification: ".$row['qualification']."\n". 
	"Region: ".$row['region']."\n";
	
	if ($pepa!="") {
	$message.="Pepa Question: ".$pepa."\n";
	}
	
	if ($pepaEmail!="") {
	$message.="Pepa Email consent: ".$pepaEmail."\n";
	}
	
	if ($row['details'] != "") { 
		$message.="Details: ".$row['details']."\n";
	}
	if ($row['disability'] != "" || $row['dietary'] != "") {
		$message.= "\nDietary/disability requirements:\n".
		$row['disability'] ."\n". 
		$row['dietary']."\n";
	}
	
	
	$headers = 'From: '.$admin_email . "\r\n". 'Cc: '.$row['email']. "\r\n";
	if ($eventID=="3167" || $eventID=="3296" || $eventID=="3483" || $eventID=="3584" || $eventID=="3768" || $eventID=="3764" || $eventID=="3642" || $eventID=="3770" || $eventID=="3769") {
		//do nothing
	}
	else {
		mail($admin_email, $subject, $message, $headers);
	}
	

}
else {

	$sql = "SELECT establishment FROM ncrm_records WHERE record_id = '$eventID'"; 
	$qry = mysql_query($sql);
	$row = mysql_fetch_array($qry);
	$node = $row['establishment']; 
	
?>
     <form name="myform" id="myform"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
	<input type="hidden" id="reg2" name="reg2" value="1"/>
	<input type="hidden" id="userID" name="userID" value="<?=$userID?>" />
  <table border="0" cellpadding="3" cellspacing="0" width="90%"><tr><td><strong>Gender <font color="red">*</font></strong></td></tr>
  <tr id="genderRow"><td>
  <input type="radio" name="gender" id="gender1" value="Male" <?=($gender == "Male") ? "checked" : ""?>>&nbsp;&nbsp;Male&nbsp;&nbsp;
  <input type="radio" name="gender" id="gender2" value="Female" <?=($gender == "Female") ? "checked" : ""?>>&nbsp;&nbsp;Female
  </td></tr>	
  <tr><td></td></tr>
  <tr><td><strong>In what type of organisation do you currently work or study <font color="red">*</font></strong></td></tr>
    
  <tr id="organisationRow1"><td><input type="radio" name="organisation" id="organisation1" value="University/College" <?=($organisation == "University/College") ? "checked" : ""?>>&nbsp;&nbsp;University/College</td></tr>
  <tr id="organisationRow2"><td><input type="radio" name="organisation" id="organisation2" value="Research Institute" <?=($organisation == "Research Institute") ? "checked" : ""?>>&nbsp;&nbsp;Research Institute</td></tr>
  <tr id="organisationRow3"><td><input type="radio" name="organisation" id="organisation3" value="Government/other public-sector organisation" <?=($organisation == "Government/other public-sector organisation") ? "checked" : ""?>>&nbsp;&nbsp;Government/other public-sector organisation</td></tr>
  <tr id="organisationRow4"><td><input type="radio" name="organisation" id="organisation4" value="Private-sector organisation" <?=($organisation == "Private-sector organisation") ? "checked" : ""?>>&nbsp;&nbsp;Private-sector organisation</td></tr>
  <tr id="organisationRow5"><td><input type="radio" name="organisation" id="organisation5" value="Voluntary-sector organisation" <?=($organisation == "Voluntary-sector organisation") ? "checked" : ""?>>&nbsp;&nbsp;Voluntary-sector organisation</td></tr>
  <tr id="organisationRow6"><td><input type="radio" name="organisation" id="organisation6" value="Other" <?=($organisation == "Other") ? "checked" : ""?>>&nbsp;&nbsp;Other (including freelance)</td></tr>
  <tr><td></td></tr>
    
    
    
  <tr><td><strong>Name of Employer or Institution registered at? <font color="red">*</font></strong></td></tr>
  <tr id="employerRow"><td><input type="text" name="employer" id="employer" size="80%" maxlength="90" value="<?=$employer?>" /></td></tr>
  <tr><td></td></tr>
    
  <?php $hide = "document.getElementById('showStudent').style.display='none';";
	  $show = "var browserName=navigator.appName; 
    			var browserVer=parseInt(navigator.appVersion);	
				if (browserName=='Microsoft Internet Explorer' && browserVer<8) {
					document.getElementById('showStudent').style.display='block';
				}
				else {
					document.getElementById('showStudent').style.display='table-row';
				}";
?>
    
  <tr><td><strong>What is your current position? <font color="red">*</font></strong></td></tr>
  <tr id="positionRow1"><td><input type="radio" name="position" id="position1" onClick="<?=$hide?>" value="Junior Researcher" <?=($position == "Junior Researcher") ? "checked" : ""?>>&nbsp;&nbsp;Junior Researcher (e.g. Research Officer, Research Fellow, Lecturer etc.)</td></tr>
  <tr id="positionRow2"><td><input type="radio" name="position" id="position2" onClick="<?=$hide?>" value="Senior Researcher" <?=($position == "Senior Researcher") ? "checked" : ""?>>&nbsp;&nbsp;Senior Researcher (e.g. Senior Research Officer, Senior Lecturer etc.)</td></tr>
  <tr id="positionRow3"><td><input type="radio" name="position" id="position3"  onClick="<?=$hide?>" value="Professor/Reader/Head of Unit/Director" <?=($position == "Professor/Reader/Head of Unit/Director") ? "checked" : ""?>>&nbsp;&nbsp;Professor/Reader/Head of Unit/Director</td></tr>
  <tr id="positionRow4"><td><input type="radio" name="position" id="position4" onClick="<?=$show?>" value="Student" <?=($position == "Student") ? "checked" : ""?>>&nbsp;&nbsp;Student</td></tr>
  <tr id="positionRow5"><td><input type="radio" name="position" id="position5" onClick="<?=$hide?>" value="Other" <?=($position == "Other") ? "checked" : ""?>>&nbsp;&nbsp;Other </td></tr>
  <tr><td></td></tr></table>
  
<table border="0" cellpadding="3" cellspacing="0" width="90%" <?=($position == "Student") ? "" : "style='display:none'"?> id='showStudent'>
  <tr><td><strong>Type of degree which you are registered for? <font color="red">*</font></strong></td></tr>
  <tr id="degreeRow1"><td><input type="radio" name="degree" id="degree1" value="First degree" <?=($degree == "First degree") ? "checked" : ""?>>&nbsp;&nbsp;First degree</td></tr>
  <tr id="degreeRow2"><td><input type="radio" name="degree" id="degree2" value="Masters degree" <?=($degree == "Masters degree") ? "checked" : ""?>>&nbsp;&nbsp;Masters degree</td></tr>
  <tr id="degreeRow3"><td><input type="radio" name="degree" id="degree3" value="Doctoral degree" <?=($degree == "Doctoral degree") ? "checked" : ""?>>&nbsp;&nbsp;Doctoral degree</td></tr>
  <tr><td></td></tr>
  <tr><td><strong>Name of degree</strong></td></tr>
  <tr id="degreeNameRow"><td><input type="text" name="degreeName" id="degreeName" size="80%" maxlength="90" value="<?=$degreeName?>"/></td></tr>
  <tr><td></td></tr>
  <tr><td><strong>Are you registered full-time or part-time? <font color="red">*</font></strong></td></tr>
  <tr id="degreeTimeRow1"><td><input type="radio" name="degreeTime" id="degreeTime1" value="Full-time" <?=($degreeTime == "Full-time") ? "checked" : ""?>>&nbsp;&nbsp;Full-time</td></tr>
  <tr id="degreeTimeRow2"><td><input type="radio" name="degreeTime" id="degreeTime2" value="Part-time" <?=($degreeTime == "Part-time") ? "checked" : ""?>>&nbsp;&nbsp;Part-time</td></tr>
  <tr><td></td></tr>
  <tr><td><strong>The University or College at which you are registered? <font color="red">*</font></strong></td></tr>
  <tr id="degreeInstitutionRow"><td><input type="text" name="degreeInstitution" id="degreeInstitution" size="80%" maxlength="90" value="<?=$degreeInstitution?>"/></td></tr>
  <tr><td></td></tr>
  <tr><td><strong>Are you currently registered at a UK University/College? <font color="red">*</font></strong></td></tr>
   <tr id="ukRow"><td>
  <input type="radio" name="uk" id="ukYes" value="Yes" <?=($uk == "Yes") ? "checked" : ""?>>&nbsp;&nbsp;Yes&nbsp;&nbsp;
  <input type="radio" name="uk" id="ukNo" value="No" <?=($uk == "No") ? "checked" : ""?>>&nbsp;&nbsp;No
  </td></tr>	
  <tr><td></td></tr>
  
  </table>
  
<table border="0" cellpadding="3" cellspacing="0" width="90%">
  <tr><td><strong>What is your disciplinary area of expertise? <font color="red">*</font></strong></td></tr>
  <tr><td>
  <select name="discipline" id="discipline" style="width: 92%;">
    <option value="<?=$discipline?>"><?=$discipline?></option>
    <option value="Area studies">Area studies </option>
    <option value="Demography">Demography</option>
    <option value="Economic and Social History">Economic and Social History</option>
    <option value="Economics">Economics</option>
    <option value="Education">Education</option>
    <option value="Environmental planning">Environmental planning</option>
    <option value="Human Geography">Human Geography</option>
    <option value="Linguistics">Linguistics</option>
    <option value="Management and Business Studies">Management and Business Studies</option>
    <option value="Political Science and International Studies">Political Science and International Studies</option>
    <option value="Psychology">Psychology</option>
    <option value="Social Anthropology">Social Anthropology</option>
    <option value="Social Policy">Social Policy</option>
    <option value="Social Work">Social Work</option>
    <option value="Socio-Legal Studies">Socio-Legal Studies</option>
    <option value="Sociology">Sociology</option>
    <option value="Science and Technology Studies">Science and Technology Studies</option>
    <option value="Statistics, Methods and Computing">Statistics, Methods and Computing</option>
    <option style="font-weight:bold" disabled="disabled" value="Disciplines outside the Social Sciences">Disciplines outside the Social Sciences</option>
    <option value="Arts and Humanities">Arts and Humanities</option>
    <option value="Biological Sciences">Biological Sciences</option>
    <option value="Engineering and Physical Sciences">Engineering and Physical Sciences</option>
    <option value="Environmental Science">Environmental Science</option>
    <option value="Medical Sciences">Medical Sciences</option>
    </select>
  </td></tr>
  <tr><td></td></tr>
  <tr><td><strong>Highest Qualification <font color="red">*</font></strong></td></tr>
  <tr id="qualificationRow1"><td><input type="radio" name="qualification" id="qualification1" value="Bachelors degree" <?=($qualification == "Bachelors degree") ? "checked" : ""?>>&nbsp;&nbsp;Bachelors degree</td></tr>
  <tr id="qualificationRow2"><td><input type="radio" name="qualification" id="qualification2" value="Masters degree" <?=($qualification == "Masters degree") ? "checked" : ""?>>&nbsp;&nbsp;Masters degree</td></tr>
  <tr id="qualificationRow3"><td><input type="radio" name="qualification" id="qualification3" value="Doctoral degree" <?=($qualification == "Doctoral degree") ? "checked" : ""?>>&nbsp;&nbsp;Doctoral degree</td></tr>
  <tr id="qualificationRow4"><td><input type="radio" name="qualification" id="qualification4" value="None of these" <?=($qualification == "none") ? "None of these" : ""?>>&nbsp;&nbsp;None of these</td></tr>
  <tr><td></td></tr>
  
  <?php if ($node == "PEPA") {?>
   <tr><td><strong>Please identify if you are any of the following<font color="red">*</font></strong></td></tr>
  <tr><td>
  <select name="pepa" id="pepa" style="width: 92%;">
   
    <option value="postgraduate student at a UK university">postgraduate student at a UK university 
</option>
    <option value="academic at a UK university">academic at a UK university 
</option>
    <option value="academic at a university overseas">academic at a university overseas </option>
    <option value="other">other</option>

    </select>
  </td></tr>								
  <tr><td></td></tr>
  
  <tr><td><strong>Please indicate whether you consent to your email address being shared with the delegates on this course.</strong>  (The purpose of this is to facilitate discussion and networking among delegates.  Your email address will not be shared with anyone outside of your course.)
</td></tr>
<tr><td><input type="checkbox" name="pepaEmail" value="Yes">&nbsp;&nbsp;Yes&nbsp;&nbsp;<input type="checkbox" name="pepaEmail" value="No">&nbsp;&nbsp;No</td></tr>
  
  
  
  <?php } ?>
  <tr><td><strong>What do you consider to be your region? <font color="red">*</font></strong></td></tr>
  <tr><td>
  <select name="region" id="region" style="width: 92%;">
    <option value="<?=$region?>"><?=$region?></option>
    <option value="London">London</option>
    <option value="South-East">South-East</option>
    <option value="South-West">South-West</option>
    <option value="East of England">East of England</option>
    <option value="Midlands">Midlands</option>
    <option value="North-West">North-West</option>
    <option value="North-East">North-East</option>
    <option value="Wales">Wales</option>
    <option value="Scotland">Scotland</option>
    <option value="Northern Ireland">Northern Ireland</option>
    <option value="EU (other than UK)">EU (other than UK)</option>
    <option value="Outside the EU">Outside the EU</option>
    </select>
  </td></tr>								
  <tr><td></td></tr>
  <tr><td><strong>Please provide details to support your booking (e.g. student no. or name of institution/ESRC research project/charity organisation) </strong></td></tr>
  <tr><td>
  <textarea name="details" id="details" cols="50" rows="4" >
<?=$details?>
</textarea>
  </td></tr>

  <tr><td></td></tr>
  <tr><td><strong>Do you have any disability which may require special arrangement of facilities (please give details)?</strong></td></tr>
  <tr><td>
  <textarea name="disability" id="disability" cols="50" rows="4" >
<?=$disability?>
</textarea>
  </td></tr>
  <tr><td></td></tr>
  
  <tr><td><strong>Do you have any special dietary or other requirements?</strong></td></tr>
  <tr><td>
  <textarea name="dietary" id="dietary" cols="50" rows="4">
<?=$dietary?>
</textarea>
  </td></tr>
  <tr><td></td></tr>
  
  <tr id="agreeRow"><td><strong>I agree to the <a href="http://www.ncrm.ac.uk/about/terms.php" target="_blank">terms and conditions</a> <font color="red">*</font></strong>&nbsp;&nbsp;<input type="checkbox" name="agree" id="agree" value="agree" <?php /* ($agree == "agree") ? "checked" : "" */ ?> /></td></tr>
  <tr><td></td></tr>
  
  <tr><td>
  <?php 
//echo $errortxt;
?>
  <span id="loading"></span><span id="warning" style="border:1px #ff0000 solid;background-color:pink;color:red;display:none;"><font color='red'>Please fill out the questions highlighted in red</font></span>
  </td></tr>
  <tr><td align="center"><br>
  <input type="submit" onclick="return validateDetails();" id="continuebutton" class="integralbutton" value="Continue" />
  

  </td></tr></table>
       </form>
     <?php 
}
?>