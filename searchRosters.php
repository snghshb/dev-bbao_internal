<?php
include('config.php'); 
include('session.php');
//include('downloadRosters.php'); 
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
<div class="content">
<table>
<tr>
<td>
<div align="center" style="padding: 20px 20px 20px 20px">
<table border="0px">
<tr>
<td valign="top" style="padding: 20px 20px 20px 20px">
<?php
//include('config.php'); 

$semesterTerm = mysqli_real_escape_string($conn, $_REQUEST['semesterTerm']);
$semesterYear = mysqli_real_escape_string($conn, $_REQUEST['semesterYear']);

echo "<h3>Rosters of ".$semesterTerm." ".$semesterYear." courses</h3><br />";
?>
<div class="btn-group-vertical">
<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#demoMain">CLICK TO VIEW ALL COURSES AND ROSTERS</button>
<a href="./downloadSemesterReport.php?semesterTerm=<?php echo $semesterTerm; ?>&semesterYear=<?php echo $semesterYear; ?>" target="_blank" class="btn btn-success" role="button">DOWNLOAD SEMESTER SUMMARY</a>
</div>
</td>
<td style="padding: 20px 20px 20px 20px">
<div id="demoMain" class="collapse">
<?php
$result = mysqli_query($conn, "SELECT offeringID, courseID, instructorID from bbaonline.bbao_courses_offering WHERE semesterTerm='$semesterTerm' AND semesterYear='$semesterYear' ORDER BY part asc");

while($row = mysqli_fetch_array($result)) {
	$offeringID = $row['offeringID'];
	$courseID = $row['courseID'];
	$instructorID = $row['instructorID'];
	
	//echo $courseID." ".$offeringID." ".$instructorID."<br />";
	
?>
<div align="center">
<table border="0px" width="100%">
<tr>
<td>Course
</td>
<td>
<?php
$result2 = mysqli_query($conn, "SELECT courseCode, courseName, semesterHours from bbaonline.bbao_courses WHERE courseID='$courseID'");

while($row2 = mysqli_fetch_array($result2)) {
	echo $row2['courseCode'].": ".$row2['courseName']." [Hours: ".$row2['semesterHours']."]";
}
?>
</td>
<td align="center" rowspan="4">
<div class="btn-group-vertical">
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal<?php echo $offeringID;?>">VIEW</button>
<div id="modal<?php echo $offeringID;?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">List of Students in 
<?php

$result2 = mysqli_query($conn, "SELECT courseCode, courseName, semesterHours from bbaonline.bbao_courses WHERE courseID='$courseID'");

while($row2 = mysqli_fetch_array($result2)) {
	echo $row2['courseCode'].": ".$row2['courseName']." [Hours: ".$row2['semesterHours']."]";
}

?>
</h4>
</div>
<div class="body">
<table border="0px" width="100%" class="table table-hover">
<thead>
<tr>
<!--th width="25%">RECORD ID</th-->
<th colspan="4">STUDENT</th><th width="25%">GRADE</th>
</tr>
</thead>
<tbody>
<?php

$result1 = mysqli_query($conn, "SELECT recordID, UIN, grade from bbaonline.bbao_students_grades WHERE offeringID='$offeringID' ORDER BY UIN");

while($row1 = mysqli_fetch_array($result1)) {
	echo "<tr>";
	//echo "<td>".$row1['recordID']."</td>";
	$UIN = $row1['UIN'];
	$result6 = mysqli_query($conn, "SELECT studentLastName, studentFirstName, uicEmail from bbaonline.bbao_students_info WHERE UIN='$UIN'");
	while($row6 = mysqli_fetch_array($result6)) {
		echo "<td>".$UIN."</td>";
		echo "<td>".$row6['studentLastName']."</td>";
		echo "<td>".$row6['studentFirstName']."</td>";
		echo "<td>(".$row6['uicEmail'].")</td>";
	}
	echo "<td align=\"center\">".$row1['grade']."</td>";
	echo "</tr>";
}
?>
</tbody>
</table>
</div>
<div class="modal-footer">
<a href="./downloadRosters.php?offeringID=<?php echo $offeringID; ?>" target="_blank" class="btn btn-warning" role="button">DOWNLOAD</a>
</div>
</div>
</div>
</div>
<a href="./downloadRosters.php?offeringID=<?php echo $offeringID; ?>" target="_blank" class="btn btn-warning" role="button">DOWNLOAD</a>
</div>
</td>
</tr>
<tr>
<td>Course Offering
</td>
<td>
<?php
$result3 = mysqli_query($conn, "SELECT CRN, semesterTerm, semesterYear, termCode, part, type from bbaonline.bbao_courses_offering WHERE offeringID='$offeringID'");

while($row3 = mysqli_fetch_array($result3)) {
	echo $row3['semesterTerm']." ".$row3['semesterYear']."(".$row3['termCode'].") Type: ".$row3['type']."&emsp;Part: ".$row3['part']."&emsp;CRN: ".$row3['CRN'];
}
?>
</td>
</tr>
<tr>
<td>Faculty
</td>
<td>
<?php
$result4 = mysqli_query($conn, "SELECT instructorFirstName, instructorLastName, instructorEmail from bbaonline.bbao_instructors WHERE instructorID='$instructorID'");

while($row4 = mysqli_fetch_array($result4)) {
	echo $row4['instructorLastName'].", ".$row4['instructorFirstName']." (".$row4['instructorEmail'].")";
}
?>
</td>
</tr>
<tr>
<td>Total Students</td>
<td>
<?php
$result5 = mysqli_query($conn, "SELECT COUNT(UIN) as totalStudents from bbaonline.bbao_students_grades WHERE offeringID='$offeringID'");

while($row5 = mysqli_fetch_array($result5)) {
	echo $row5['totalStudents'];
}
?>
</td>
</tr>
</table>
<hr />
</div>
<?php
}
?>
</div>
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