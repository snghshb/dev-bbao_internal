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
	<title>Add New Course Offering</title>
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
<h3>Add new Course Offering</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<form class="form-horizontal" action="courseOfferingAddNew.php" name="courseOfferingAddNewForm" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="control-label col-sm-2" for="courseID">Course Code</label>
		<div class="col-sm-10">
			<select class="form-control" id="courseID" name="courseID">
<?php
$sql = "SELECT courseID, courseCode, semesterHours from bbaonline.bbao_courses ORDER BY courseCode";
$result = mysqli_query($conn,$sql);
while($row = $result->fetch_assoc()) {
	echo "<option value='".$row['courseID']."'>".$row['courseCode']." (".$row['semesterHours'].")</option>";
}
?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="instructorID">Instructor</label>
		<div class="col-sm-10">
			<select class="form-control" id="instructorID" name="instructorID">
<?php
$sql1 = "SELECT instructorID, instructorFirstName, instructorLastName from bbaonline.bbao_instructors ORDER BY instructorLastName asc";
$result1 = mysqli_query($conn,$sql1);
while($row1 = $result1->fetch_assoc()) {
	echo "<option value='".$row1['instructorID']."'>".$row1['instructorLastName'].", ".$row1['instructorFirstName']."</option>";
}
?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="CRN">CRN</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="CRN" placeholder="CRN.." name="CRN">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="semesterTerm">Semester Term</label>
		<div class="col-sm-10">
			<select class="form-control" id="semesterTerm" name="semesterTerm">
				<option value='FA'>Fall</option>
				<option value='SP'>Spring</option>
				<option value='SU'>Summer</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="semesterYear">Semester Year</label>
		<div class="col-sm-10">
			<select class="form-control" id="semesterYear" name="semesterYear">
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
		<label class="control-label col-sm-2" for="part">Term Part</label>
		<div class="col-sm-10">
			<select class="form-control" id="part" name="part">
				<option value='A'>A</option>
				<option value='B'>B</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="type">Type</label>
		<div class="col-sm-10">
			<select class="form-control" id="type" name="type">
				<option value='Core'>Core(C)</option>
				<option value='Elective'>Elective(E)</option>
				<option value='Substitute'>Substitute(S)</option>
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