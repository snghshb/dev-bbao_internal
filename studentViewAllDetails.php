<?php
include('config.php'); 
include('session.php');
include('calculateGPA.php');
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Student Details</title>
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
<h3>View all information for student 
<?php echo $_GET['UIN']; ?>
</h3>
<hr />
<div align="center">
<table width="80%">
<tr>
<td>
<?php
$UIN = $_GET['UIN'];
//echo $UIN;
$result = mysqli_query($conn, "SELECT s.UIN, s.studentLastName, s.studentFirstName, s.uicEmail, s.studentStatus, s.enrollmentType, s.studentStanding, s.enrollmentTerm, s.enrollmentYear, s.projectedGraduatingTerm, s.projectedGraduatingYear, s.actualGraduatingTerm, s.actualGraduatingYear, s.transferGPA, s.phoneNumber, s.gender, s.ethnicity, s.dateOfBirth, s.addressStreet, s.addressCity, s.addressState, s.addressZipcode from bbaonline.bbao_students_info s where s.UIN = '$UIN'");

echo "<table class=\"table table-striped\" width=\"100%\" border=\"0px\">";
//echo "<thead><tr><th>UIN</th><th>Student Last Name</th><th>Student First Name</th><th>UIC Email</th><th>Student Status</th><th>Enrollment Type</th><th>Student Standing</th><th>Enrollment Term</th><th>Enrollment Year</th><th>projectedGraduatingTerm</th><th>projectedGraduatingYear</th><th>actualGraduatingTerm</th><th>actualGraduatingYear</th><th>transferGPA</th><th>phoneNumber</th><th>gender</th><th>ethnicity</th><th>dateOfBirth</th><th>addressStreet</th><th>addressCity</th><th>addressState</th><th>addressZipcode</th></tr></thead>";
echo "<tbody>";
while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td colspan=\"6\"><strong>Personal information</strong></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>UIN</td><td>".$row['UIN']."</td><td>Name</td><td colspan=\"3\">".$row['studentLastName'].", ".$row['studentFirstName']." (".$row['uicEmail'].")</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan=\"6\"><strong>Academic information</strong></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Transfer GPA</td><td colspan=\"2\">".$row['transferGPA']."</td>";
	echo "<td>Current GPA</td><td colspan=\"2\"><strong>";
	$calculatedGPA=calculateGPA($UIN);
	echo $calculatedGPA;
	echo "</strong></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Student Status</td><td>";
	switch($row['studentStatus']) {
		case 0:	echo "Enrolled";
				break;
		case 1: echo "Debarred";
				break;
		case 2:	echo "Dismissed";
				break;
		case 3: echo "Dropped Out";
				break;
		case 4:	echo "Graduated";
				break;
		default: echo "N/A";
				break;
	}
	echo "</td><td>Enrollment Type</td><td>";
	if ($row['enrollmentType'] == 0)
		echo "Full Time";
	else echo "Part Time";
	echo "</td><td>Student Standing</td><td>";
	switch($row['studentStanding']) {
		case 0:	echo "Good";
				break;
		case 1: echo "Bad";
				break;
		case 2:	echo "Probation";
				break;
		case 3: echo "Last Chance probation";
				break;
		default: echo "N/A";
				break;
	}
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Enrollment Term</td><td>".$row['enrollmentTerm']." ".$row['enrollmentYear']."</td><td>Projected Graduating Term</td><td>".$row['projectedGraduatingTerm']." ".$row['projectedGraduatingYear']."</td>";
	echo "<td>Actual Graduated Term</td><td>";
	if ($row['studentStatus'] == 0)
		echo "Currently enrolled in program";
	else if ($row['studentStatus']>0 && $row['studentStatus']<4)
		echo "Did not graduate";
		else echo $row['actualGraduatingTerm']." ".$row['actualGraduatingYear'];
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan=\"6\"><strong>Demographic information</strong></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Gender</td><td>";
	if ($row['gender'] == 0)
		echo "Female";
	else echo "Male";
	echo "</td>";
	echo "<td>Date of Birth</td><td>".$row['dateOfBirth']."</td>";
	echo "<td>Ethnicity</td><td>";
	switch($row['ethnicity']) {
		case 0:	echo "American Indian or Alaskan Native";
				break;
		case 1: echo "Asian";
				break;
		case 2:	echo "Black or African American";
				break;
		case 3: echo "Hispanic or Latino";
				break;
		case 4:	echo "White";
				break;
		case 5:	echo "Two or more races";
				break;
		case 6:	
		default: echo "N/A";
				break;
	}
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan=\"6\"><strong>Additional information</strong></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Phone Number</td><td>".$row['phoneNumber']."</td>";
	echo "<td>Address</td><td colspan=\"5\">".$row['addressStreet'].", ".$row['addressCity'].", ".$row['addressState'].", ".$row['addressZipcode'].".</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan=\"3\">";
	echo "<a href=\"studentNotesAddForm.php?UIN=".$UIN."\"><code>VIEW COMMENTS</code></a>&emsp;";
	echo "<a href=\"studentViewAllGrades.php?UIN=".$UIN."\"><code>VIEW GRADES</code></a>&emsp;";
	echo "<a href=\"downloadStudentReport.php?UIN=".$UIN."\" target=\"_blank\"><code>DOWNLOAD STUDENT REPORT</code></a>&emsp;";
	echo "</td>";
	echo "<td colspan=\"3\" align=\"right\">";
	echo "<a href=\"studentEdit.php?UIN=".$UIN."\"><code>EDIT</code></a>&emsp;";
	echo "<a href=\"studentDelete.php?UIN=".$row['UIN']."\"><kbd>DELETE</kbd></a>";
	echo "</td>";
	echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "<hr /></td></tr>";
?>
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