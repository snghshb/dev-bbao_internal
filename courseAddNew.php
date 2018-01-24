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
	
	$courseCode = mysqli_real_escape_string($conn, $_REQUEST['courseCode']);
	$courseName = mysqli_real_escape_string($conn, $_REQUEST['courseName']);
	$department = mysqli_real_escape_string($conn, $_REQUEST['department']);
	$semesterHours = mysqli_real_escape_string($conn, $_REQUEST['semesterHours']);
	
	echo $courseCode."<br />";
	echo $courseName."<br />";
	echo $department."<br />";
	echo $semesterHours."<br />";
	
	$check = "SELECT * FROM bbaonline.bbao_courses WHERE courseCode = '$courseCode' AND semesterHours = $semesterHours";
	//echo $check."<br />";
	
	if(mysqli_num_rows(mysqli_query($conn, $check)) > 0) {
		echo "<h3>Course already exists!</h3><div align=\"center\"><table width=\"80%\"><tr><td>";
		echo "The entry you are trying to make (Course Code: $courseCode, Hours: $semesterHours) already exists<br />";
		?>
		<br /><br /><br />
		<div align="center">
			<div id="includeTempMenu"></div>
		</div>
		<?php
	}
	else {
			$sql = "INSERT INTO bbaonline.bbao_courses (courseCode, courseName, department, semesterHours) VALUES ('$courseCode', '$courseName', '$department', $semesterHours)";
			//echo $sql."<br />";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Course added successfully</h3><div align=\"center\"><table width=\"80%\"><tr><td>";
				echo "New course ($courseCode: $courseName, by Department $department and $semesterHours Semester Hours) added successfully<br />";
				$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Inserted a new course, ($courseCode: $courseName', by Department $department and $semesterHours Semester Hours)')";
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