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
	<title>List Course Offerings</title>
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
<h3>BBAO course offerings</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<?php
$result = mysqli_query($conn, "SELECT i.instructorID, i.instructorFirstName, i.instructorLastName, i.instructorEmail, c.courseID, c.courseCode, c.courseName, c.department, c.semesterHours, co.offeringID, co.semesterTerm, co.semesterYear, co.part, co.type, co.CRN, co.termCode, (SELECT COUNT(*) FROM bbaonline.bbao_students_grades sg WHERE sg.offeringID=co.offeringID) as totalEnrolled FROM bbao_instructors i, bbao_courses c, bbao_courses_offering co WHERE i.instructorID=co.instructorID AND c.courseID = co.courseID ORDER BY co.termCode desc");

echo "<table class=\"table table-hover\" width=\"100%\">";
//echo "<thead><tr><th>Instructor ID</th><th>Instructor Info</th><th>Course ID</th><th>Course Info</th><th>Offering ID</th><th>Semester Term</th><th>Semester Year</th><th>Part</th><th>Type</th><th colspan=\"2\">Actions</th></tr></thead>";
echo "<tbody>";
while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td align=\"right\"><strong>Instructor Details</strong><br /><strong>Course Information</strong><br /><strong>Offering Information</strong><br /><strong>Students enrolled</strong></td>";
	echo "<td>[".$row['instructorID']."] ".$row['instructorFirstName']." ".$row['instructorLastName']." (".$row['instructorEmail'].")<br />";
	echo "[".$row['courseID']."] ".$row['courseCode'].": ".$row['courseName']." (".$row[semesterHours].")<br />";
	echo "[".$row['offeringID']."] <strong>Term: </strong>".$row['semesterTerm'].$row['semesterYear']."(".$row['termCode'].")&ensp;<strong>Part: </strong>".$row['part']."&ensp;<strong>Type: </strong>".$row['type']."&ensp;<strong>CRN: </strong>".$row['CRN']."<br />";
	echo $row['totalEnrolled'];
	echo "</td>";
	echo "<td>";
	echo "<a href=\"courseOfferingEdit.php?offeringID=".$row['offeringID']."\"><code>"."EDIT"."</code></a><br /><br />";
	echo "<a href=\"courseOfferingDelete.php?offeringID=".$row['offeringID']."\"><kbd>"."DELETE"."</kbd></a>";
	echo "</td>";
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