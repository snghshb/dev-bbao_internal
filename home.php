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
	<title>Advisor Homepage</title>
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
<h1>Hello <?php echo $login_session;?>!</h1>
<hr />
Welcome to the advisor's home page<br />
Please check the Help tab in the right hand corner before starting to use the website<br /><br />
Start by clicking any of the tasks in the Navigation bar<br /><hr />
<?php
$result = mysqli_query($conn, "SELECT COUNT(s.UIN) as allStudent from bbaonline.bbao_students_info s");
while($row = mysqli_fetch_array($result)) {
	echo "There are ".$row[allStudent]." students currently enrolled in the program<br />";
}
$result = mysqli_query($conn, "select distinct enrollmentType, count(enrollmentType) as CountOf from `bbao_students_info` group by enrollmentType");
while($row = mysqli_fetch_array($result)) {
	echo "There are ".$row[CountOf]." students currently enrolled ";
	if ($row[enrollmentType] == 0)
		echo "Full time";
	else echo "Part time";
	echo "<br />";
}
$result = mysqli_query($conn, "select distinct enrollmentTerm, enrollmentYear, count(enrollmentType) as CountOf from `bbao_students_info` group by enrollmentTerm, enrollmentYear");
while($row = mysqli_fetch_array($result)) {
	echo "There are ".$row[CountOf]." students currently enrolled in the ".$row['enrollmentTerm']." ".$row['enrollmentYear']." cohort<br />";
}
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
}
?>