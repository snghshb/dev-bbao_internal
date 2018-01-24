<?php
include('session.php');
//echo "login page";
include("config.php");
if (ADVISOR_ID != 0)
	header('Location: ./home.php');
else {	
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	// netID(username) and password sent from form
	$netID = mysqli_real_escape_string($conn,$_POST['netID']);
    $password = mysqli_real_escape_string($conn,$_POST['password']); 
	
	$sql = "SELECT advisorID FROM bbao_advisors WHERE netID = '$netID' and password = '$password';";
	$result = mysqli_query($conn,$sql);
	if (!mysqli_ping($conn)){
		echo 'Lost connection, exiting';
		exit();
	}
	if (!$result) {
		print($sql);
		printf("Error: %s\n", mysqli_error($sql));
		exit();
	}
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$active = $row['active'];
	
	$count = mysqli_num_rows($result);
	
	// If result matched $netID and $mypassword, table row must be 1 row
	
	if($count == 1) {
		//session_register("emailAddress");
        $_SESSION['login_user'] = $netID;
        header("location: home.php");
	}
	else {
		$error = "Your Login Name or Password is invalid";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--meta http-equiv="X-UA-Compatible" content="IE=edge"-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/custom.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<title>Advisor - Login</title>
	</head>
<body>
<div class="wrapper">
<div class="container full-width-div">
	<div class="page-header" align="center">
	<table border="0px">
			<tr>
				<td width="40%"><a href="./home.php">
				<img class="img-responsive" src="./css/images/logo.png" alt="logo" title="BBAO Internal database" width="40%" height="40%"/></a>
				</td>
				<td align="right">
				BBA - Online Completion program, Internal Database
				</td>
			</tr>
			<tr>
			<td>
				<button type="button" class="btn btn-default btn-md">
				<a href="./home.php"><span class="glyphicon glyphicon-home text-success"></span></a>
				</button>
			</td>
			<td align="right">
				<button type="button" class="btn btn-default btn-md">
				<a href="./home.php" target="_blank"><span class="glyphicon glyphicon-send text-warning"></span></a>
				</button>
			</td>
			</tr>
	</table>
	</div>
</div>
<div class="content" align="center">
<table border="0px" width="80%" height="400px" class="marginTable">
	<tr>
	<td align="center">
	<form action="" method ="post">
	<table class="loginForm">
		<tr>
			<td><h3>ADMINISTRATOR LOGIN PAGE</h3><hr /></td>
		</tr>
		<tr> 
		<td>
		<div class="form-group">
			<label for="emailAddress">NET ID</label>
			<input type="text" class="form-control" id="netID" name="netID">
		</div>
		</td>
		</tr>
		<tr> 
		<td>
		<div class="form-group">
			<label for="password">PASSWORD</label>
			<input type="password" class="form-control" id="password" name="password">
		</div>
		</td>
		</tr>
		<tr> 
		<td align="center">
			<hr /><button type="submit" class="btn btn-default">SUBMIT</button>
		</td>
		</tr>
	</table>
	</form>
	</td>
	</tr>
</table>
</div>
<footer class="footer">
	<div class="disclaimer">
		<small>UIC - Bachelors in Business Administration(Online) - Online Internal Database</small>
	</div>
</footer>
</div>
</body>
</html>
<?php
}
?>