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
	<title>Upload Grades</title>
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
<h3>Upload Grades</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<form class="form-horizontal" action="uploadGradesNew.php" name="uploadGradesNew" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="control-label col-sm-2" for="offeringID">Course Offering</label>
		<div class="col-sm-10">
			<select class="form-control" id="offeringID" name="offeringID">
<?php
$sql = "SELECT c.courseCode, c.semesterHours, i.instructorFirstName, i.instructorLastName, co.offeringID, co.semesterTerm, co.semesterYear FROM bbaonline.bbao_courses c, bbaonline.bbao_instructors i, bbaonline.bbao_courses_offering co WHERE c.courseID = co.courseID AND i.instructorID = co.instructorID ORDER BY co.termCode, co.part";
$result = mysqli_query($conn,$sql);
while($row = $result->fetch_assoc()) {
	echo "<option value='".$row['offeringID']."'>".$row['courseCode']." (".$row['semesterHours'].") - ".$row['semesterTerm'].$row['semesterYear'].". Prof: ".$row['instructorLastName'].", ".$row['instructorFirstName']."</option>";
}
?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="grade">Upload Grades</label>
		<div class="col-sm-10">
		<input type="file" name="grade" id="grade" class="form-group">
		</div>
	</div>
	<div class="form-group">        
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Upload Grades</button>
		</div>
    </div>
	<div>
	<p>Notes<br />select student, course offering, grade and click on add grades. Entries are made. <br />N grade not taken/not applicable/currently enrolled</p>
	</div>
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