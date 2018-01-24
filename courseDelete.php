<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<?php
if(isset($_GET['courseID']) && is_numeric($_GET['courseID'])){
	$courseID = $_GET['courseID'];
	$result = mysqli_query($conn, "SELECT * FROM bbaonline.bbao_courses_offering where courseID = '$courseID'");
	if(mysqli_num_rows($result)==0) {
		$midResult = mysqli_query($conn, "SELECT courseCode, courseName, department, semesterHours FROM bbaonline.bbao_courses where courseID = '$courseID'");
		while($row = mysqli_fetch_array($midResult)) 
		{
			$courseCode = $row['courseCode'];
			$courseName = $row['courseName'];
			$department = $row['department'];
			$semesterHours = $row['semesterHours'];
		}
		mysqli_query($conn, "DELETE FROM bbaonline.bbao_courses Where courseID='$courseID'");
		$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Deleted course, $courseCode -  $courseName(From department: $department, semester Hours: $semesterHours) ID: $courseID')";
		if(mysqli_query($conn, $sql_log)){
			//echo "Log added";
			header("Location: courseListAll.php");
		}
	}
	else {
		header("Location: courseListAll.php");
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