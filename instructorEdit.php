<?php
include('session.php'); 
if (ADMIN_ID === 0)
	header('Location: ./login.php');
else {
//	function renderForm($publisher_id, $publisher_name, $publisher_city, $publisher_state, $publisher_country, $error)
//	{
	function renderForm($instructorID, $instructorFirstName, $instructorLastName, $instructorEmail, $error)
	{
		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Instructor Details</title>
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
	<h3>Edit information for Instructor <?php echo $instructorFirstName." ".$instructorLastName;?></h3>
		<hr />
<?php

		// if there are any errors, display them

		if ($error != '')

		{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

		}

?>
							<form action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="instructorID" value="<?php echo $instructorID; ?>"/>
							<div align="center">	
							<table width="80%" border="0px">							
								<!--tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>Instructor ID</strong></td>
								<td><?php //echo $instructorID;?></td>
								</tr-->						
								<tr>
								<td width="30%" align="right" style="padding-right: 10px;"><strong>First Name</strong></td>
								<td width="70%"><input type="text" name="instructorFirstName" value = "<?php echo $instructorFirstName;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Last Name</strong></td>
								<td><input type="text" name="instructorLastName" value = "<?php echo $instructorLastName;?>"/></td>
								</tr>
								<tr>
								<td align="right" style="padding-right: 10px;"><strong>Email</strong></td>
								<td><input type="text" name="instructorEmail" value = "<?php echo $instructorEmail;?>"/></td>
								</tr>
								<tr>
								<td align="right" colspan="2" style="padding-right: 10px;"><strong>All fields are required</strong></td>
								</tr>
								<tr>
								<td colspan="2" align="center"><input type="submit" value = "Update Record" name="submit"></td>
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

		if (is_numeric($_POST['instructorID']))
		{

			// get form data, making sure it is valid

			//$instructorID = $_POST['instructorID'];
			
			$instructorID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['instructorID']));
			$instructorFirstName = mysqli_real_escape_string($conn, htmlspecialchars($_POST['instructorFirstName']));
			$instructorLastName = mysqli_real_escape_string($conn, htmlspecialchars($_POST['instructorLastName']));
			$instructorEmail = mysqli_real_escape_string($conn, htmlspecialchars($_POST['instructorEmail']));
			
			if ($instructorFirstName == '')
			{
				$error = 'ERROR: Please fill in all required fields';
				renderForm($instructorID, $instructorFirstName, $instructorLastName, $instructorEmail, $error);
			}
			else 
			{
				mysqli_query($conn, "UPDATE bbaonline.bbao_instructors SET instructorFirstName='$instructorFirstName', instructorLastName = '$instructorLastName', instructorEmail = '$instructorEmail' WHERE instructorID='$instructorID'");
				$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Updated an instructor with id $instructorID')";
				if(mysqli_query($conn, $sql_log)){}
			}
				header("Location: ./instructorListAll.php");
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
		
		
		if (isset($_GET['instructorID']) && is_numeric($_GET['instructorID']) && $_GET['instructorID'] > 0)
		{

			// query db

			$instructorID = $_GET['instructorID'];

			$result = mysqli_query($conn, "SELECT * FROM bbaonline.bbao_instructors WHERE instructorID=$instructorID");

			$row = mysqli_fetch_array($result);

			if($row)
			{
				// get data from db
				$instructorFirstName = $row['instructorFirstName'];
				$instructorLastName = $row['instructorLastName'];
				$instructorEmail = $row['instructorEmail'];

				renderForm($instructorID, $instructorFirstName, $instructorLastName, $instructorEmail, $error);
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
			
			