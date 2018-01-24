<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<?php
if(isset($_GET['offeringID']) && is_numeric($_GET['offeringID'])){
	$offeringID = $_GET['offeringID'];
	
	echo "offerind ID: ".$offeringID."<br />";
	
	$result = mysqli_query($conn, "SELECT * FROM bbaonline.bbao_students_grades WHERE offeringID = '$offeringID'");
	if(mysqli_num_rows($result)==0) {
		
		$midResult = mysqli_query($conn, "SELECT courseID, instructorID, semesterTerm, semesterYear, part, type FROM bbaonline.bbao_courses_offering WHERE offeringID = '$offeringID'");
		
		while($row = mysqli_fetch_array($midResult)) 
		{
			$courseID = $row['courseID'];
			$instructorID = $row['instructorID'];
			$semesterTerm = $row['semesterTerm'];
			$semesterYear = $row['semesterYear'];
			$part = $row['part'];
			$type = $row['type'];
		}
		
		mysqli_query($conn, "DELETE FROM bbaonline.bbao_courses_offering WHERE offeringID=$offeringID");
		
		$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Deleted course offering--Offering ID-Instructor ID-Course ID-Sem-Year-Part-Type---$offeringID-$instructorID-$courseID-$semesterTerm-$semesterYear-$part-$type')";
		
		echo $sql_log;
		
		if(mysqli_query($conn, $sql_log)){
			echo "Log added";
			//header("Location: courseOfferingListAll.php");
		}
	}
	else {
		echo "Entry still available in Student_grades table";
		//header("Location: courseListAll.php");
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