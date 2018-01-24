<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./login.php');
else {
	function renderForm($UIN, $recordID, $grade, $error)
	{
		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Grade for Student</title>
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
	<h3>Edit grade for UIN <?php echo $UIN.", Record ID: ".$recordID;?></h3>
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
								<td width="30%" align="right" style="padding-right: 10px;"><strong>UIN</strong></td>
								<td width="70%"><?php echo $UIN;?></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Record ID</strong></td>
								<td><?php echo $recordID;?></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Grade</strong></td>
								<td><input type="text" name="grade" value = "<?php echo $grade;?>"/></td>
								</tr>
								<tr>
								<td align="right" colspan="2" style="padding-right: 10px;"><strong>All fields are required</strong></td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Update Grade Record" name="submit"></td>
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

		if (is_numeric($_POST['recordID']))
		{

			// get form data, making sure it is valid

			//$courseID = $_POST['courseID'];
			
			$UIN = mysqli_real_escape_string($conn, htmlspecialchars($_POST['UIN']));
			$recordID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['recordID']));
			//$grade = mysqli_real_escape_string($conn, htmlspecialchars($_POST['grade']));
			
			if ($grade == '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($UIN, $recordID, $grade, $error);
			}
			else 
			{
				mysqli_query($conn, "UPDATE bbaonline.bbao_students_grades SET grade='$grade' WHERE recordID='$recordID'");
				$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Updated student grade for record id $recordID')";
				if(mysqli_query($conn, $sql_log)){}
			}
				header('Location: ./studentViewAllGrades.php?UIN='.$UIN);
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
		
		
		if (isset($_GET['recordID']) && is_numeric($_GET['recordID']) && $_GET['recordID'] > 0 && isset($_GET['UIN']) && is_numeric($_GET['UIN']) && $_GET['UIN'] > 0)
		{

			// query db

			$recordID = $_GET['recordID'];
			$UIN = $_GET['UIN'];

			$result = mysqli_query($conn, "SELECT recordID, UIN, grade FROM bbaonline.bbao_students_grades WHERE recordID=$recordID");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$grade = $row['grade'];
				$UIN = $row['UIN'];
				$recordID = $row['recordID'];
				
				renderForm($UIN, $recordID, $grade, $error);
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
			
			