<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<?php
if(isset($_GET['instructorID']) && is_numeric($_GET['instructorID'])){
	$instructorID = $_GET['instructorID'];
	$result = mysqli_query($conn, "SELECT * FROM bbaonline.bbao_courses_offering where instructorID = '$instructorID'");
	if(mysqli_num_rows($result)==0) {
		$midResult = mysqli_query($conn, "SELECT instructorFirstName, instructorLastName, instructorEmail FROM bbaonline.bbao_instructors where instructorID = '$instructorID'");
		while($row = mysqli_fetch_array($midResult)) 
		{
			$instructorFirstName = $row['instructorFirstName'];
			$instructorLastName = $row['instructorLastName'];
			$instructorEmail = $row['instructorEmail'];
		}
		mysqli_query($conn, "DELETE FROM bbaonline.bbao_instructors Where instructorID='$instructorID'");
		$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Deleted instructor, $instructorFirstName $instructorLastName. Email Address: $instructorEmail. ID: $instructorID')";
		if(mysqli_query($conn, $sql_log)){
			//echo "Log added";
			header("Location: instructorListAll.php");
		}
	}
	else {
		header("Location: instructorListAll.php");
	}
}
else {
	echo "value not passed";
}
?>
<?php
	$conn->close();
}
?>