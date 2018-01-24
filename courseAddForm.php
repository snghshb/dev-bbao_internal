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
	<title>Add New Course</title>
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
<h3>Add new Course</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<div align="right">Fields marked by * are manadatory<hr /></div>
<form class="form-horizontal" action="courseAddNew.php" name="courseAddNewForm" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="control-label col-sm-2" for="courseCode">Course Code</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="courseCode" placeholder="Enter Course Code" name="courseCode">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="courseName">Course Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="courseName" placeholder="Enter Course Name" name="courseName">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="department">Department</label>
		<div class="col-sm-10">
			<select class="form-control" id="department" name="department">
				<option value='Accounting'>Accounting</option>
				<option value='Business Communications'>Business Communications</option>
				<option value='Economics'>Economics</option>
				<option value='Entrpreneurship'>Entrpreneurship</option>
				<option value='Information and Decision Sciences'>Information and Decision Sciences</option>
				<option value='Management'>Management</option>
				<option value='Marketing'>Marketing</option>	
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="semesterHours">Semester Hours</label>
		<div class="col-sm-10">
			<select class="form-control" id="semesterHours" name="semesterHours">
				<option value='0'>0</option>
				<option value='1'>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option>
				<option value='4'>4</option>
				<option value='5'>5</option>
				<option value='6'>6</option>	
			</select>
		</div>
	</div>
	<div class="form-group">        
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Add new Course</button>
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