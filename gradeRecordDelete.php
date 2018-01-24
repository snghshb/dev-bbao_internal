<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<?php

if(isset($_GET['recordID']) && is_numeric($_GET['recordID'])){
	$recordID = $_GET['recordID'];
	$result = mysqli_query($conn, "SELECT * FROM bbaonline.bbao_student_grades where recordID = '$recordID'");
	if(mysqli_num_rows($result)==0) {
		$midResult = mysqli_query($conn, "SELECT UIN, offeringID, grade FROM bbaonline.bbao_student_grades where recordID = '$recordID'");
		while($row = mysqli_fetch_array($midResult)) 
		{
			$UIN = $row['UIN'];
			$offeringID = $row['offeringID'];
			$grade = $row['grade'];
		}
		mysqli_query($conn, "DELETE FROM bbaonline.bbao_student_grades Where recordID='$recordID'");
		$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Deleted student grade for student $UIN, offeringID $offeringID, grade $grade')";
		if(mysqli_query($conn, $sql_log)){
			//echo "Log added";
			header("Location: gradesListAll.php");
		}
	}
	else {
		header("Location: gradesListAll.php");
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