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
	<title>List Courses</title>
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
<h3>BBAO courses</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<?php
$result = mysqli_query($conn, "SELECT c.courseID, c.courseCode, c.courseName, c.department, c.semesterHours, (SELECT count(*) FROM bbao_courses_offering co where co.courseID = c.courseID) as count_offered FROM bbao_courses c ORDER BY courseCode asc");

echo "<table class=\"table table-hover\" width=\"100%\">";
echo "<thead><tr><th align=\"center\">Course ID</th><th>Course Code</th><th>Course Name</th><th>Department</th><th>Semester Hours</th><th align=\"center\">Number of Offering(s)</th><th colspan=\"2\">Actions</th></tr></thead>";
echo "<tbody>";
while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td align=\"center\">".$row['courseID']."</td>";
	echo "<td>".$row['courseCode']."</td>";
	echo "<td>".$row['courseName']."</td>";
	echo "<td>".$row['department']."</td>";
	echo "<td>".$row['semesterHours']."</td>";
	echo "<td align=\"center\">".$row['count_offered']."</td>";
	echo "<td><a href=\"courseEdit.php?courseID=".$row[courseID]."\"><code>"."EDIT"."</code></a></td>";
	echo "<td><a href=\"courseDelete.php?courseID=".$row[courseID]."\"><kbd>"."DELETE"."</kbd></a></td>";
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