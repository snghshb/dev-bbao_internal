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
	<title>Add New Student</title>
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
<h3>Add new Student</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<form class="form-horizontal" action="studentAddNew.php" name="studentAddNewForm" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="control-label col-sm-2" for="UIN">UIN</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="UIN" placeholder="Enter UIN" name="UIN">
		</div>
	</div><div class="form-group">
		<label class="control-label col-sm-2" for="studentLastName">Last Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="studentLastName" placeholder="Enter Last Name" name="studentLastName">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="studentFirstName">First Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="studentFirstName" placeholder="Enter First Name" name="studentFirstName">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="uicEmail">UIC Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="uicEmail" placeholder="Enter UIC Email" name="uicEmail">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="studentStatus">Student Status</label>
		<div class="col-sm-10">
			<select class="form-control" id="studentStatus" name="studentStatus">
				<option value='0'>Enrolled</option>
				<option value='1'>Debarred</option>
				<option value='2'>Dismissed</option>
				<option value='3'>Dropped Out</option>
				<option value='4'>Graduated</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="enrollmentType">Enrollment Type</label>
		<div class="col-sm-10">
			<select class="form-control" id="enrollmentType" name="enrollmentType">
				<option value='0'>Full Time</option>
				<option value='1'>Part Time</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="studentStanding">Student Standing</label>
		<div class="col-sm-10">
			<select class="form-control" id="studentStanding" name="studentStanding">
				<option value='0'>Good</option>
				<option value='1'>Bad</option>
				<option value='2'>Probation</option>
				<option value='3'>Last chance Probation</option>
			</select>
		</div>
	</div>
		<div class="form-group">
		<label class="control-label col-sm-2" for="enrollmentTerm">Semester Term</label>
		<div class="col-sm-10">
			<select class="form-control" id="enrollmentTerm" name="enrollmentTerm">
				<option value='FA'>Fall</option>
				<option value='SP'>Spring</option>
				<option value='SU'>Summer</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="enrollmentYear">Enrollment Year</label>
		<div class="col-sm-10">
			<select class="form-control" id="enrollmentYear" name="enrollmentYear">
				<option value='2015'>2015</option>
				<option value='2016'>2016</option>
				<option value='2017'>2017</option>
				<option value='2018'>2018</option>
				<option value='2019'>2019</option>
				<option value='2020'>2020</option>
			</select>
		</div>
	</div>
	<div class="form-group">        
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Add new Student</button>
		</div>
    </div>
	<hr />
</form>
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
/*
0	American Indian or Alaskan Native
1	Asian
2	Black or African American
3	Hispanic or Latino
4	White
5	Two or more races
6	N/A
*/
}
?>