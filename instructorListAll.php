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
	<title>List Instructor</title>
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
<h3>Listed Instructors</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<?php
$result = mysqli_query($conn, "SELECT i.instructorID, i.instructorFirstName, i.instructorLastName, i.instructorEmail, (SELECT count(*) FROM bbao_courses_offering co where co.instructorID = i.instructorID) as count_taught FROM bbao_instructors i ORDER BY instructorLastName asc");

echo "<table class=\"table table-hover\" width=\"100%\">";
echo "<thead><tr><th align=\"center\">Instructor ID</th><th>Last Name</th><th>First Name</th><th>Email address</th><th align=\"center\">Subjects taught</th><th colspan=\"2\">Actions</th></tr></thead>";
echo "<tbody>";
while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td align=\"center\">".$row['instructorID']."</td>";
	echo "<td>".$row['instructorLastName']."</td>";
	echo "<td>".$row['instructorFirstName']."</td>";
	echo "<td>".$row['instructorEmail']."</td>";
	echo "<td align=\"center\">".$row['count_taught']."</td>";
	echo "<td><a href=\"instructorEdit.php?instructorID=".$row[instructorID]."\"><code>"."EDIT"."</code></a></td>";
	echo "<td><a href=\"instructorDelete.php?instructorID=".$row[instructorID]."\"><kbd>"."DELETE"."</kbd></a></td>";
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