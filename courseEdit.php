<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./login.php');
else {
//	function renderForm($courseID, $instructorFirstName, $instructorLastName, $instructorEmail, $error)
//	{
	function renderForm($courseID, $courseCode, $courseName, $department, $semesterHours, $error)
	{
		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Course Details</title>
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
	<h3>Edit information for course <?php echo $courseCode.", Hours: ".$semesterHours;?></h3>
		<hr />
<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}

?>
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="courseID" value="<?php echo $courseID; ?>"/>
							<div align="center">	
							<table width="80%" border="0px">							
								<!--tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Course ID</strong></td>
								<td><?php echo $courseID;?></td>
								</tr-->						
								<tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Course Code</strong></td>
								<td width="70%"><input type="text" name="courseCode" value = "<?php echo $courseCode;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Course Name</strong></td>
								<td><input type="text" name="courseName" value = "<?php echo $courseName;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Department</strong></td>
								<td><input type="text" name="department" value = "<?php echo $department;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Semester Hours</strong></td>
								<td><input type="text" name="semesterHours" value = "<?php echo $semesterHours;?>"/></td>
								</tr>
								<tr>
								<td align="right" colspan="2" style="padding-right: 10px;"><strong>All fields are required</strong></td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Update Course Record" name="submit"></td>
								</tr>
								</table>
							</div>
						</form>
				</td>
					</tr>
			
		</table>
</div>
<!--div id="includeFooter"></div>-->
</div>
</body>
</html>

</html>

<?php

	}
		
	include("config.php");
	
	// check if the form has been submitted. If it has, process the form and save it to the database
	$error = '';
	if (isset($_POST['submit']))
	{

		// confirm that the 'id' value is a valid integer before getting the form data

		if (is_numeric($_POST['courseID']))
		{

			// get form data, making sure it is valid

			//$courseID = $_POST['courseID'];
			
			$courseID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['courseID']));
			$courseCode = mysqli_real_escape_string($conn, htmlspecialchars($_POST['courseCode']));
			$courseName = mysqli_real_escape_string($conn, htmlspecialchars($_POST['courseName']));
			$department = mysqli_real_escape_string($conn, htmlspecialchars($_POST['department']));
			$semesterHours = mysqli_real_escape_string($conn, htmlspecialchars($_POST['semesterHours']));
			
			
			if ($courseCode == '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($courseID, $courseCode, $courseName, $department, $semesterHours, $error);
			}
			else 
			{
				mysqli_query($conn, "UPDATE bbaonline.bbao_courses SET courseCode='$courseCode', courseName = '$courseName', department = '$department', semesterHours = $semesterHours WHERE courseID='$courseID'");
				$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Updated a course with id $courseID')";
				if(mysqli_query($conn, $sql_log)){}
			}
				header("Location: ./courseListAll.php");
		} 
		else 
		{
			echo 'ERROR 1';
		}
	} 
	else 
	{
		// if the form hasn't been submitted, get the data from the db and display the form
		

		// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
		
		
		if (isset($_GET['courseID']) && is_numeric($_GET['courseID']) && $_GET['courseID'] > 0)
		{

			// query db

			$courseID = $_GET['courseID'];

			$result = mysqli_query($conn, "SELECT * FROM bbaonline.bbao_courses WHERE courseID=$courseID");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$courseCode = $row['courseCode'];
				$courseName = $row['courseName'];
				$department = $row['department'];
				$semesterHours = $row['semesterHours'];
				
				renderForm($courseID, $courseCode, $courseName, $department, $semesterHours, $error);
			} 
			else 
			{
				echo "No results";
			}
		} 
		else
		{
			echo "ERROR 2";
		}
	}
	$conn->close();

	}
?>
			
			