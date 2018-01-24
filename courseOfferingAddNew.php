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
	<title>Add New Course</title>
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
	<script> 
    $(function(){
      $("#includeTempMenu").load("tempMenu.html"); 
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
	
	$courseID = mysqli_real_escape_string($conn, $_REQUEST['courseID']);
	$instructorID = mysqli_real_escape_string($conn, $_REQUEST['instructorID']);
	$CRN = mysqli_real_escape_string($conn, $_REQUEST['CRN']);
	$semesterTerm = mysqli_real_escape_string($conn, $_REQUEST['semesterTerm']);
	$semesterYear = mysqli_real_escape_string($conn, $_REQUEST['semesterYear']);
	$part = mysqli_real_escape_string($conn, $_REQUEST['part']);
	$type = mysqli_real_escape_string($conn, $_REQUEST['type']);
	
	echo $courseID."<br />";
	echo $instructorID."<br />";
	echo $CRN."<br />";
	echo $semesterTerm."<br />";
	echo $semesterYear."<br />";
	echo $part."<br />";
	echo $type."<br />";
	
	switch ($semesterTerm) {
		case 'SP': 	$temp = '1';
					break;
		case 'SU': 	$temp = '5';
					break;
		case 'FA': 	$temp = '8';
					break;
		default:	break;
	}
	settype($semesterYear, "string");
	$termCode = '2'.$semesterYear.$temp;
	settype($termCode, "integer");
	//echo gettype($termCode);
	
	settype($semesterYear, "integer");
	
	/* $check = "SELECT * FROM bbaonline.bbao_courses_offering WHERE courseCode = '$courseCode' AND semesterHours = $semesterHours";
	//echo $check."<br />";
	
	if(mysqli_num_rows(mysqli_query($conn, $check)) > 0) {
		echo "<h3>Course already exists!</h3><div align=\"center\"><table width=\"80%\"><tr><td>";
		echo "The entry you are trying to make (Course Code: $courseCode, Hours: $semesterHours) already exists<br />";
		echo "Add a new course <a href=\"./courseAddForm.php\">here</a><br />";
		echo "<a href=\"./courseListAll.php\">Click here</a> to view a list of all available courses in the BBA Online program";
	}
	else { */
			$sql = "INSERT INTO bbaonline.bbao_courses_offering (courseID, instructorID, CRN, semesterTerm, semesterYear, part, type, termCode) VALUES ($courseID, $instructorID, $CRN, '$semesterTerm', $semesterYear, '$part', '$type', $termCode)";
			//echo $sql."<br />";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Course Offering added successfully</h3><div align=\"center\"><table width=\"80%\"><tr><td>";
				echo "New course offering added successfully<br />";
				$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'uploaded grades.')";
				if(mysqli_query($conn, $sql_log)){
					//echo "Log added";
				}
			}
			?>
			<br /><br /><br />
			<div align="center">
				<div id="includeTempMenu"></div>
			</div>
		<?php
		//}
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