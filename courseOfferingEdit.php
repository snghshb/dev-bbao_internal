<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./login.php');
else {
//	function renderForm($courseID, $courseCode, $courseName, $department, $semesterHours, $error)
//	{
	function renderForm($courseID, $courseCode, $courseName, $department, $semesterHours, $instructorID, $instructorFirstName, $instructorLastName, $instructorEmail, $offeringID, $semesterTerm, $semesterYear, $part, $type, $CRN, $termCode, $error)
	{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Course Offering Details</title>
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
	<h3>Edit information for course offering<?php echo $semesterTerm ." ".$semesterYear." ".$courseCode.", Hours: ".$semesterHours;?></h3>
		<hr />
<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}

?>
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="offeringID" value="<?php echo $offeringID; ?>"/>
							<div align="center">	
							<table width="80%" border="0px">							
								<!--tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Offering ID</strong></td>
								<td><?php echo $offeringID;?></td>
								</tr-->
								<tr>
								<td colspan="2">Course: <?php echo $courseCode.": ".$courseName.". Semester Hours: ".$semesterHours;?></td>
								</tr>
								<tr>
								<td colspan="2">Course Faculty: <?php echo $instructorLastName.", ".$instructorFirstName." (Email: ".$instructorEmail.")";?></td>
								</tr>
								<tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Semester Term</strong></td>
								<td width="70%"><input type="text" name="semesterTerm" value = "<?php echo $semesterTerm;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Semester year</strong></td>
								<td><input type="text" name="semesterYear" value = "<?php echo $semesterYear;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Term Code</strong></td>
								<td><input type="text" name="termCode" value = "<?php echo $termCode;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Part</strong></td>
								<td><input type="text" name="part" value = "<?php echo $part;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Type</strong></td>
								<td><input type="text" name="type" value = "<?php echo $type;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>CRN</strong></td>
								<td><input type="text" name="CRN" value = "<?php echo $CRN;?>"/></td>
								</tr>
								<tr>
								<td align="right" colspan="2" style="padding-right: 10px;"><strong>All fields are required</strong></td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Update Offering Record" name="submit"></td>
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

		if (is_numeric($_POST['offeringID']))
		{

			// get form data, making sure it is valid
			echo $_POST['offeringID']."<br />";

			//$courseID = $_POST['courseID'];
			$offeringID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['offeringID']));
			$courseID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['courseID']));
			$courseCode = mysqli_real_escape_string($conn, htmlspecialchars($_POST['courseCode']));
			$courseName = mysqli_real_escape_string($conn, htmlspecialchars($_POST['courseName']));
			$department = mysqli_real_escape_string($conn, htmlspecialchars($_POST['department']));
			$semesterHours = mysqli_real_escape_string($conn, htmlspecialchars($_POST['semesterHours']));
			$instructorID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['instructorID']));
			$instructorFirstName = mysqli_real_escape_string($conn, htmlspecialchars($_POST['instructorFirstName']));
			$instructorLastName = mysqli_real_escape_string($conn, htmlspecialchars($_POST['instructorLastName']));
			$instructorEmail = mysqli_real_escape_string($conn, htmlspecialchars($_POST['instructorEmail']));
			$semesterTerm = mysqli_real_escape_string($conn, htmlspecialchars($_POST['semesterTerm']));
			$semesterYear = mysqli_real_escape_string($conn, htmlspecialchars($_POST['semesterYear']));
			$part = mysqli_real_escape_string($conn, htmlspecialchars($_POST['part']));
			$type  = mysqli_real_escape_string($conn, htmlspecialchars($_POST['type']));
			$CRN  = mysqli_real_escape_string($conn, htmlspecialchars($_POST['CRN']));
			$termCode  = mysqli_real_escape_string($conn, htmlspecialchars($_POST['termCode']));
			
			if ($semesterTerm == '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($courseID, $courseCode, $courseName, $department, $semesterHours, $instructorID, $instructorFirstName, $instructorLastName, $instructorEmail, $offeringID, $semesterTerm, $semesterYear, $part, $type, $CRN, $termCode, $error);
			}
			else 
			{
				mysqli_query($conn, "UPDATE bbaonline.bbao_courses_offering SET semesterTerm='$semesterTerm', semesterYear = $semesterYear, part = '$part', type = '$type', CRN='$CRN', termCode='$termCode' WHERE offeringID='$offeringID'");
				$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Updated a course offering with id $offeringID')";
				if(mysqli_query($conn, $sql_log)){}
			}
				header("Location: ./courseOfferingListAll.php");
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
		
		
		if (isset($_GET['offeringID']) && is_numeric($_GET['offeringID']) && $_GET['offeringID'] > 0)
		{

			// query db

			$offeringID = $_GET['offeringID'];
			echo $offeringID."<br />";

			$result = mysqli_query($conn, "SELECT i.instructorID, i.instructorFirstName, i.instructorLastName, i.instructorEmail, c.courseID, c.courseCode, c.courseName, c.department, c.semesterHours, co.offeringID, co.semesterTerm, co.semesterYear, co.part, co.type, co.CRN, co.termCode FROM bbao_instructors i, bbao_courses c, bbao_courses_offering co WHERE co.offeringID = $offeringID AND i.instructorID=co.instructorID AND c.courseID = co.courseID");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$courseID = $row['courseID'];
				$courseCode = $row['courseCode'];
				$courseName = $row['courseName'];
				$department = $row['department'];
				$semesterHours = $row['semesterHours'];
				$instructorID = $row['instructorID'];
				$instructorFirstName = $row['instructorFirstName'];
				$instructorLastName = $row['instructorLastName'];
				$instructorEmail = $row['instructorEmail'];
				$semesterTerm = $row['semesterTerm'];
				$semesterYear = $row['semesterYear'];
				$part = $row['part'];
				$type = $row['type'];
				$CRN = $row['CRN'];
				$termCode = $row['termCode'];
				
				renderForm($courseID, $courseCode, $courseName, $department, $semesterHours, $instructorID, $instructorFirstName, $instructorLastName, $instructorEmail, $offeringID, $semesterTerm, $semesterYear, $part, $type, $CRN, $termCode, $error);
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