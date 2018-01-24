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
	<title>List all subjects for student</title>
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
<h3>Enrolled subjects and grades for student 
<?php echo $_GET['UIN']; ?>
</h3>
<hr />
<div align="center">
<table width="80%">
<tr>
<td>
<?php
//echo "studentViewAllGrades.php";
$UIN = $_GET['UIN'];
$result = mysqli_query($conn, "SELECT g.recordID, g.grade, c.courseCode, c.semesterHours, co.CRN, co.semesterTerm, co.semesterYear, co.part, co.type from bbaonline.bbao_students_grades g, bbao_courses_offering co, bbao_courses c where g.UIN = '$UIN' AND g.offeringID=co.offeringID AND co.courseID=c.courseID ORDER BY co.termCode, co.part");
echo "<table class=\"table table-hover\" width=\"100%\">";
echo "<thead><tr><th>Record ID</th><th colspan=\"6\">Course</th><th>Grade</th><th colspan=\"2\">Action</th></thead>";

$hours=0;
$gradePoints=0;

while($row = mysqli_fetch_array($result)) {
	$multiplier=0;
	echo "<tr>";
	echo "<td>".$row['recordID']."</td>";
	echo "<td>".$row['courseCode']."(".$row['semesterHours'].")</td>";
	echo "<td>".$row['CRN']."</td>";
	echo "<td>".$row['semesterTerm']."</td>";
	echo "<td>".$row['semesterYear']."</td>";
	echo "<td>".$row['part']."</td>";
	echo "<td>".$row['type']."</td>";
	echo "<td>".$row['grade']."</td>";
	echo "<td><a href=\"studentEditGrade.php?UIN=".$UIN."&recordID=".$row['recordID']."\">"."<kbd>TBA link</kbd>"."</a></td>";
	echo "</tr>";
	$hours += $row['semesterHours'];
	switch ($row['grade']) {
		case 'A': 	$multiplier=4;
					break;
		case 'B':	$multiplier=3;
					break;
		case 'C':	$multiplier=2;
					break;
		case 'D':	$multiplier=1;
					break;
		case 'F':	break;
		case 'N':	$hours -= $row['semesterHours'];
					break;
		case 'W':	$hours -= $row['semesterHours'];
	}
	$temp = $row['semesterHours']*$multiplier;
	$gradePoints += $temp;
}
echo "</tbody>";
echo "</table>";
echo "<hr />";
?>
</td>
</tr>
<tr>
<td>
<?php 
echo "Total Grade points: ".$gradePoints."<br />Total Hours: ".$hours."<br />";
$gpa=$gradePoints/$hours;
echo "<h3>GPA= ".$gpa."</h3>";
?>
</td>
</tr>
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