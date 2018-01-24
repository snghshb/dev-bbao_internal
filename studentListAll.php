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
<h3>BBAO Student List</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<?php
$result = mysqli_query($conn, "SELECT s.UIN, s.studentLastName, s.studentFirstName, s.uicEmail, s.studentStatus, s.enrollmentType, s.studentStanding, s.enrollmentTerm, s.enrollmentYear from bbaonline.bbao_students_info s ORDER BY s.enrollmentYear, s.UIN");

echo "<table class=\"table table-hover\" width=\"100%\">";
echo "<thead><tr><th>UIN</th><th>Student Last Name</th><th>Student First Name</th><th>UIC Email</th><th>Student Status</th><th>Enrollment Type</th><th>Student Standing</th><th>Enrollment Term</th><th>Enrollment Year</th><th colspan=\"4\">Actions</th></tr></thead>";
echo "<tbody>";
while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>".$row['UIN']."</td>";
	echo "<td>".$row['studentLastName']."</td>";
	echo "<td>".$row['studentFirstName']."</td>";
	echo "<td>".$row['uicEmail']."</td>";
	echo "<td>";
	switch ($row['studentStatus']) {
		case 0: echo "Enrolled";
				break;
		case 1: echo "Debarred";
				break;
		case 2: echo "Dismissed";
				break;
		case 3: echo "Dropped Out";
				break;
		case 4: echo "Graduated";
				break;		
	}
	echo "</td>";
	echo "<td>";
	if($row['enrollmentType'] == 0)
		echo "Full Time";
	else echo "Part Time";
	echo "</td>";
	echo "<td>";
	switch($row['studentStanding']) {
		case 0: echo "Good";
				break;
		case 1: echo "Bad";
				break;
		case 2: echo "Probabtion";
				break;
		case 3: echo "Last Chance probation";
				break;
	}
	
	echo "</td>";
	echo "<td>".$row['enrollmentTerm']."</td>";
	echo "<td>".$row['enrollmentYear']."</td>";
	echo "<td><a href=\"studentViewAllGrades.php?UIN=".$row['UIN']."\"><button type=\"button\" class=\"btn btn-xs\">GRADES</button></a></td>";
	echo "<td><a href=\"studentNotesAddForm.php?UIN=".$row['UIN']."\"><button type=\"button\" class=\"btn  btn-xs\">COMMENTS</button></a></td>";
	echo "<td><a href=\"studentViewAllDetails.php?UIN=".$row['UIN']."\"><button type=\"button\" class=\"btn btn-xs\">DETAILS</button></a></td>";
	echo "<td><a href=\"studentEdit.php?UIN=".$row['UIN']."\"><button type=\"button\" class=\"btn btn-warning btn-xs\">EDIT</button></a></td>";
	//echo "<td><a href=\"studentDelete.php?UIN=".$row['UIN']."\"><button type=\"button\" class=\"btn btn-danger btn-xs\">DELETE</button></a></td>";
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