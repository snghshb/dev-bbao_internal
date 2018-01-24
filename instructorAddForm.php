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
	<title>Add New Instructor</title>
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
<table width="80%">
<tr>
<td>
<h3>Add new Instructor</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<div align="right">Fields marked by * are manadatory<hr /></div>
<form class="form-horizontal" action="instructorAddNew.php" name="instructorAddNewForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="control-label col-sm-2" for="instructorFirstName">First Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="instructorFirstName" placeholder="Enter First Name" name="instructorFirstName">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="instructorLastName">Last Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="instructorLastName" placeholder="Enter Last Name" name="instructorLastName">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="instructorEmail">Email*</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="instructorEmail" placeholder="Enter UIC Email" name="instructorEmail">
		</div>
	</div>
	<div class="form-group">        
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Add new Instructor</button>
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