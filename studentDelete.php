<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<?php
if(isset($_GET['UIN']) && is_numeric($_GET['UIN'])){
	$UIN = $_GET['UIN'];
	
	echo "UIN: ".$UIN."<br />";
	
	$result = mysqli_query($conn, "SELECT * FROM bbaonline.bbao_students_grades WHERE UIN = '$UIN'");
	if(mysqli_num_rows($result)==0) {
		
		$midResult = mysqli_query($conn, "SELECT s.UIN, s.studentLastName, s.studentFirstName, s.uicEmail, s.studentStatus, s.enrollmentType, s.studentStanding, s.enrollmentTerm, s.enrollmentYear from bbaonline.bbao_students_info s WHERE s.UIN = '$UIN'");
		
		while($row = mysqli_fetch_array($midResult)) 
		{
			$UIN = $row['UIN'];
			$studentLastName = $row['studentLastName'];
			$studentFirstName = $row['studentFirstName'];
			$uicEmail = $row['uicEmail'];
			$studentStatus = $row['studentStatus'];
			$enrollmentType = $row['enrollmentType'];
			$studentStanding = $row['studentStanding'];
			$enrollmentTerm = $row['enrollmentTerm'];
			$enrollmentYear = $row['enrollmentYear'];
		}
		
		mysqli_query($conn, "DELETE FROM bbaonline.bbao_students_info WHERE UIN=$UIN");
		
		$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Deleted student--UIN-Name-Email ID-Status-enrollmentType-Standing-enrollmentTerm-enrollmentYear---$UIN-$studentLastName, $studentFirstName-$uicEmail-$studentStatus-$enrollmentType-$studentStanding-$enrollmentTerm-$enrollmentYear')";
		
		echo $sql_log;
		
		if(mysqli_query($conn, $sql_log)){
			echo "Log added";
			//header("Location: studentListAll.php");
		}
	}
	else {
		echo "Entry still available for $UIN in Student_grades table";
		//header("Location: studentListAll.php");
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