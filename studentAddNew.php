<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add New Student</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/custom.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans">
	<script> 
    $(function(){
      $("#includeHeader").load("header.html"); 
    });
    </script>
	<script> 
    $(function(){
      $("#includeNavbar").load("navbar.php"); 
    });
    </script>
	<script> 
    $(function(){
      $("#includeFooter").load("footer.html"); 
    });
    </script>
</head>
<body>
<div class="wrapper">
<div id="includeHeader"></div>
<div id="includeNavbar"></div>
<div class="content" align="center">
<table width="80%">
<tr>
<td>
<?php

	//echo "inserting new instructor<br />";
	
	// Check connection
	if($conn === false){
		die("ERROR: Could not connect to database. " . mysqli_connect_error());
	}
	
	$UIN = mysqli_real_escape_string($conn, $_REQUEST['UIN']);
	$studentLastName = mysqli_real_escape_string($conn, $_REQUEST['studentLastName']);
	$studentFirstName = mysqli_real_escape_string($conn, $_REQUEST['studentFirstName']);
	$uicEmail = mysqli_real_escape_string($conn, $_REQUEST['uicEmail']);
	$studentStatus = mysqli_real_escape_string($conn, $_REQUEST['studentStatus']);
	$enrollmentType = mysqli_real_escape_string($conn, $_REQUEST['enrollmentType']);
	$studentStanding = mysqli_real_escape_string($conn, $_REQUEST['studentStanding']);
	$enrollmentTerm = mysqli_real_escape_string($conn, $_REQUEST['enrollmentTerm']);
	$enrollmentYear = mysqli_real_escape_string($conn, $_REQUEST['enrollmentYear']);
	
	echo "UIN: ".$UIN."<br />";
	echo "Last Name: ".$studentLastName."<br />";
	echo "First Name: ".$studentFirstName."<br />";
	echo "UIC Email: ".$uicEmail."<br />";
	echo "Status: ".$studentStatus."<br />";
	echo "Enrollment type: ".$enrollmentType."<br />";
	echo "Student Standing: ".$studentStanding."<br />";
	echo "Enrollment Term: ".$enrollmentTerm."<br />";
	echo "Enrollment Year: ".$enrollmentYear."<br />";
	
	
	$check = "SELECT * FROM bbaonline.bbao_students_info WHERE UIN = '$UIN'";
	echo $check."<br />";
	
	if(mysqli_num_rows(mysqli_query($conn, $check)) > 0) {
		echo "<h3>Student already exists!</h3><div align=\"center\"><table width=\"80%\"><tr><td>";
		echo "The Student with UIN $UIN already exists<br />";
		echo "Add a new student <a href=\"./studentAddForm.php\">here</a><br />";
		echo "<a href=\"./studentListAll.php\">Click here</a> to view a list of all students in the BBA Online program";
	}
	else { 
			$sql = "INSERT INTO bbaonline.bbao_students_info (UIN, studentLastName, studentFirstName, uicEmail, studentStatus, enrollmentType, studentStanding, enrollmentTerm, enrollmentYear) VALUES ($UIN, '$studentLastName', '$studentFirstName', '$uicEmail', $studentStatus, $enrollmentType, $studentStanding, '$enrollmentTerm', '$enrollmentYear')";
			//echo $sql."<br />";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Student added successfully</h3><div align=\"center\"><table width=\"80%\"><tr><td>";
				echo "New Student $UIN: $studentLastName, $studentFirstName added successfully<br />";
				$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Inserted a new student with UIN: $UIN')";
				if(mysqli_query($conn, $sql_log)){
					//echo "Log added";
				}
			}
			echo "Add a new student <a href=\"./studentAddForm.php\">here</a><br />";
			echo "<a href=\"./studentListAll.php\">Click here</a> to view a list of all students in the BBA Online program";
		 }
?>
</td>
</tr>
</table>
</div>
</td>
</tr>
<tr>
<td><p>&nbsp;</p></td>
</tr>
</table>
</div>
<div class="push"></div>
</div>
<div id="includeFooter"></div>
</body>
</html>
<?php
	$conn->close();
}
?>