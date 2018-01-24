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
	<title>Add New Schedule</title>
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
<h3>Add new Schedule</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<form class="form-horizontal" action="scheduleAddNew.php" name="scheduleAddNewForm" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="control-label col-sm-2" for="enrolledTerm">Enrolled Term</label>
		<div class="col-sm-10">
			<select class="form-control" id="enrolledTerm" name="enrolledTerm">
				<option value='FA'>Fall</option>
				<option value='SP'>Spring</option>
				<option value='SU'>Summer</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="enrolledYear">Semester Year</label>
		<div class="col-sm-10">
			<select class="form-control" id="enrolledYear" name="enrolledYear">
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
		<label class="control-label col-sm-2" for="enrollmentType">Enrollment Type</label>
		<div class="col-sm-10">
			<select class="form-control" id="enrollmentType" name="enrollmentType">
				<option value='0'>Full Time</option>
				<option value='1'>Part Time</option>
			</select>
		</div>
	</div>
	<div class="form-group">        
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Add Schedule</button>
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
}
?>