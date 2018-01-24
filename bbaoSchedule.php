<?php

include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
	
	$enrollmentType = mysqli_real_escape_string($conn, $_REQUEST['enrollmentType']);
	$enrollmentTerm = mysqli_real_escape_string($conn, $_REQUEST['enrollmentTerm']);
	$enrollmentYear = mysqli_real_escape_string($conn, $_REQUEST['enrollmentYear']);
	
	echo $enrollmentTerm." ".$enrollmentYear."<br />";
	
	//$enrollmentType = 0;		//later; user defined. 0=full time, 1=part time
	//$enrollmentTerm = "FA";		//later; user defined
	//$enrollmentYear = "2015";	//later; user defined
	
	$coursesPartTime = array("BA200", "MGMT340", "MKTG360", "IDS200", "MGMT350", "ENTR310", "IDS355", "ACTG210", "ECON220", "FIN300", "ACTG211", "ACTG355", "BA290", "IDS270", "IDS371", "FIN444", "MGMT460", "IDS312", "BA300", "BA495");
	
	$coursesFullTime = array("BA290", "BA200", "MGMT340", "ACTG210", "MKTG360", "ECON220", "IDS200", "FIN300", "MGMT350", "ACTG211", "ENTR310", "ACTG355", "", "IDS355", "", "IDS270", "IDS371", "MGMT460", "FIN444", "IDS312", "BA300", "BA495");
	
	//check for enrollment type. 1=part time, 0=full time
	
	if ($enrollmentType == 0) {
		for($i=0; $i<count($coursesFullTime); $i++) {
		echo $coursesFullTime[$i]." ";
		
		$result = mysqli_query($conn, "SELECT courseID as courseID FROM bbaonline.bbao_courses WHERE courseCode = '$coursesFullTime[$i]'");
		
		while($row = mysqli_fetch_array($result)) {
			echo $row['courseID'];
		}
		
		echo "<br />";
		
	}
	}
	
	else {
		for($i=0; $i<count($coursesPartTime); $i++) {
		echo $coursesPartTime[$i]." ";
		
		$result = mysqli_query($conn, "SELECT courseID as courseID FROM bbaonline.bbao_courses WHERE courseCode = '$coursesPartTime[$i]'");
		
		while($row = mysqli_fetch_array($result)) {
			echo $row['courseID'];
		}
		
		echo "<br />";
		
	}

	}
}
?>