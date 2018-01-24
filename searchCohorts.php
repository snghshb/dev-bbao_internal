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
	<title>BBA Online - Reports</title>
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
	function validateForm()
	{
		var a=document.forms[instructorAddNewForm][instructorEmail].value;
		if (a==null || a=="")
		{
			alert("Email is a required field");
			return false;
		}
	}
	</script>
</head>
<body>
<div class="wrapper">
<div id="includeHeader"></div>
<div id="includeNavbar"></div>
<div class="content" align="center">
<table width="90%" border="0px">
<tr>
<td style="padding: 20px 20px 20px 20px;">
<?php
include('config.php');

$enrollmentType = mysqli_real_escape_string($conn, $_REQUEST['enrollmentType']);
$enrollmentTerm = mysqli_real_escape_string($conn, $_REQUEST['enrollmentTerm']);
$enrollmentYear = mysqli_real_escape_string($conn, $_REQUEST['enrollmentYear']);

/* echo $enrollmentType."<br />";
echo $enrollmentTerm."<br />";
echo $enrollmentYear."<br />";
 */
?>
<a href="./downloadCohorts.php?enrollmentTerm=<?php echo $enrollmentTerm; ?>&enrollmentYear=<?php echo $enrollmentYear; ?>&enrollmentType=<?php echo $enrollmentType; ?>" target="_blank" class="btn btn-success" role="button">DOWNLOAD COHORT INFORMATION</a>
<?php

 
$result = mysqli_query($conn, "SELECT UIN, studentLastName, studentFirstName, uicEmail, studentStanding from bbaonline.bbao_students_info WHERE enrollmentType='$enrollmentType' AND enrollmentTerm='$enrollmentTerm' AND enrollmentYear='$enrollmentYear'");

echo "<table border=\"0px\" class=\"table table-hover\">";
echo "<thead>";
echo "<tr>";
echo "<th>UIN</th><th>LAST NAME</th><th>FIRST NAME</th><th>EMAIL</th><th>STUDENT STANDING</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>".$row['UIN']."</td>";
	echo "<td>".$row['studentLastName']."</td>";
	echo "<td>".$row['studentFirstName']."</td>";
	echo "<td>".$row['uicEmail']."</td>";
	echo "<td>";
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
}
echo "</tbody>";
echo "</table>";
?>
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