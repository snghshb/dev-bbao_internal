<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./login.php');
else {
//	function renderForm($courseID, $courseCode, $courseName, $department, $semesterHours, $error)
//	{
	function renderForm($UIN, $studentLastName, $studentFirstName, $uicEmail, $studentStatus, $enrollmentType, $studentStanding, $enrollmentTerm, $enrollmentYear, $error)
	{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Student details</title>
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
	<h3>Edit information for student <?php echo $studentLastName .", ".$studentFirstName;?></h3>
		<hr />
<?php

		// if there are any errors, display them

		if ($error != '')
		{		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
		}

?>
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="UIN" value="<?php echo $UIN; ?>"/>
							<div align="center">	
							<table width="80%" border="0px">							
								<!--tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>UIN</strong></td>
								<td><?php echo $UIN;?></td>
								</tr-->
								<tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Last Name</strong></td>
								<td width="70%"><input type="text" name="studentLastName" value = "<?php echo $studentLastName;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>First Name</strong></td>
								<td><input type="text" name="studentFirstName" value = "<?php echo $studentFirstName;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Email</strong></td>
								<td><input type="text" name="uicEmail" value = "<?php echo $uicEmail;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Student Status</strong></td>
								<td><input type="text" name="studentStatus" value = "<?php echo $studentStatus;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Enrollment Type</strong></td>
								<td><input type="text" name="enrollmentType" value = "<?php echo $enrollmentType;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Student Standing</strong></td>
								<td><input type="text" name="studentStanding" value = "<?php echo $studentStanding;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Enrollment Type</strong></td>
								<td><input type="text" name="enrollmentTerm" value = "<?php echo $enrollmentTerm;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Enrollment Year</strong></td>
								<td><input type="text" name="enrollmentYear" value = "<?php echo $enrollmentYear;?>"/></td>
								</tr>
								<tr>
								<td align="right" colspan="2" style="padding-right: 10px;"><strong>All fields are required</strong></td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Update Student Record" name="submit"></td>
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

		if (is_numeric($_POST['UIN']))
		{

			// get form data, making sure it is valid
			echo $_POST['UIN']."<br />";
//$UIN, $studentLastName, $studentFirstName, $uicEmail, $studentStatus, $enrollmentType, $studentStanding, $enrollmentTerm, $enrollmentYear, $error
			//$courseID = $_POST['courseID'];
			$UIN = mysqli_real_escape_string($conn, htmlspecialchars($_POST['UIN']));
			$studentLastName = mysqli_real_escape_string($conn, htmlspecialchars($_POST['studentLastName']));
			$studentFirstName = mysqli_real_escape_string($conn, htmlspecialchars($_POST['studentFirstName']));
			$uicEmail = mysqli_real_escape_string($conn, htmlspecialchars($_POST['uicEmail']));
			$studentStatus = mysqli_real_escape_string($conn, htmlspecialchars($_POST['studentStatus']));
			$enrollmentType = mysqli_real_escape_string($conn, htmlspecialchars($_POST['enrollmentType']));
			$studentStanding = mysqli_real_escape_string($conn, htmlspecialchars($_POST['studentStanding']));
			$enrollmentTerm = mysqli_real_escape_string($conn, htmlspecialchars($_POST['enrollmentTerm']));
			$enrollmentYear = mysqli_real_escape_string($conn, htmlspecialchars($_POST['enrollmentYear']));
			
			if ($studentLastName == '')
			{ echo "<br />2";
				$error = 'ERROR: Please fill in all required fields';
				renderForm($UIN, $studentLastName, $studentFirstName, $uicEmail, $studentStatus, $enrollmentType, $studentStanding, $enrollmentTerm, $enrollmentYear, $error);
			}
			else 
			{
				//mysqli_query($conn, "UPDATE bbaonline.bbao_courses_offering SET semesterTerm='$semesterTerm', semesterYear = $semesterYear, part = '$part', type = '$type' WHERE offeringID='$offeringID'");
				
				mysqli_query($conn, "UPDATE bbaonline.bbao_students_info SET studentLastName='$studentLastName', studentFirstName='$studentFirstName', uicEmail='$uicEmail', studentStatus=$studentStatus, enrollmentType=$enrollmentType, studentStanding=$studentStanding, enrollmentTerm='$enrollmentTerm', enrollmentYear=$enrollmentYear WHERE UIN = '$UIN'");
				//echo "<br />3";
				$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Updated a student with UIN $UIN')";
				if(mysqli_query($conn, $sql_log)){}
			}
				header("Location: ./studentListAll.php");
				//echo "<br />4";
		} 
		else 
		{
			echo 'ERROR 1';
			//echo "<br />5";
		}
	} 
	else 
	{
		// if the form hasn't been submitted, get the data from the db and display the form
		

		// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
		
		
		if (isset($_GET['UIN']) && is_numeric($_GET['UIN']) && $_GET['UIN'] > 0)
		{

			// query db

			$UIN = $_GET['UIN'];
			echo $UIN."<br />";

			$result = mysqli_query($conn, "SELECT s.UIN, s.studentLastName, s.studentFirstName, s.uicEmail, s.studentStatus, s.enrollmentType, s.studentStanding, s.enrollmentTerm, s.enrollmentYear from bbaonline.bbao_students_info s WHERE s.UIN = $UIN");

			$row = mysqli_fetch_array($result);
			
			if($row)
			{
				// get data from db
				$UIN = $row['UIN'];
				$studentLastName = $row['studentLastName'];
				$studentFirstName = $row['studentFirstName'];
				$uicEmail = $row['uicEmail'];
				$studentStatus = $row['studentStatus'];
				$enrollmentType = $row['enrollmentType'];
				$studentStanding = $row['studentStanding'];
				$enrollmentTerm = $row['enrollmentTerm'];
				$enrollmentYear = $row['enrollmentYear'];
				
				renderForm($UIN, $studentLastName, $studentFirstName, $uicEmail, $studentStatus, $enrollmentType, $studentStanding, $enrollmentTerm, $enrollmentYear, $error);
			} 
			else 
			{
				echo "No results";
			}
		} 
		else
		{
			echo "ERROR 2";
			//echo "<br />8";
		}
	}
	$conn->close();

	}
?>