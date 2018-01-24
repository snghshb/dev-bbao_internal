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
	<title>List Students</title>
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
$offeringID = mysqli_real_escape_string($conn, $_REQUEST['offeringID']);

//echo $offeringID."<br />";

$sql = "SELECT c.courseCode, c.courseName, c.semesterHours, i.instructorFirstName, i.instructorLastName, co.semesterTerm, co.semesterYear, co.part, co.type FROM bbaonline.bbao_courses c, bbaonline.bbao_instructors i, bbaonline.bbao_courses_offering co WHERE co.offeringID = '$offeringID' AND c.courseID = co.courseID AND i.instructorID = co.instructorID";

//echo $sql;

$result = mysqli_query($conn,$sql);

while($row = $result->fetch_assoc()) {
	echo "<h3>".$row['courseCode']." (".$row['semesterHours'].") - ".$row['semesterTerm'].$row['semesterYear'].". Prof: ".$row['instructorLastName'].", ".$row['instructorFirstName']."</h3>";
}
?>
<div align="center">
<table width="80%">
<tr>
<td>
<?php

$sql1 = "SELECT s.UIN, s.studentLastName, s.studentFirstName, g.grade, g.recordID FROM bbaonline.bbao_students_info s, bbaonline.bbao_students_grades g WHERE s.UIN=g.UIN AND g.offeringID = '$offeringID'";

echo "<table class=\"table table-hover\" width=\"100%\">";
echo "<thead><tr><th>UIN</th><th>Student Last Name</th><th>Student First Name</th><th>Grade</th><th>Action</th></tr></thead>";
echo "<tbody>";

$result1 = mysqli_query($conn,$sql1);

while($row1 = $result1->fetch_assoc()) {
	echo "<tr>";
	echo "<td>".$row1['UIN']."</td>";
	echo "<td>".$row1['studentLastName']."</td>";
	echo "<td>".$row1['studentFirstName']."</td>";
	echo "<td>".$row1['grade']."</td>";
	echo "<td><a href=\"gradeRecordDelete.php?recordID=".$row1[recordID]."\"><kbd>"."DELETE"."</kbd></a></td>";
	echo "</tr>";
}

echo "</tbody>";
echo "</table>";
echo "<hr />";

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