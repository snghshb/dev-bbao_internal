<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<?php
$UIN = mysqli_real_escape_string($conn, $_REQUEST['UIN']);
$communicationMode = mysqli_real_escape_string($conn, $_REQUEST['communicationMode']);
$studentNotes  = mysqli_real_escape_string($conn, $_REQUEST['studentNotes']);

echo $UIN."<br />";
echo $communicationMode."<br />";
echo $studentNotes."<br />";

$sql = "INSERT INTO bbaonline.bbao_students_notes (UIN, advisorID, communicationMode, studentNotes) VALUES ($UIN,".ADVISOR_ID.", $communicationMode, '$studentNotes')";
			echo $sql."<br />";
if(mysqli_query($conn, $sql)) {
	//echo "<h3>Instructor added successfully</h3><div align=\"center\"><table width=\"80%\"><tr><td>";
	//echo "New instructor (Instructor name '$instructorFirstName $instructorLastName', Email: $instructorEmail) added successfully<br />";
	$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Advisor inserted new note for student: $UIN)";
	if(mysqli_query($conn, $sql_log)){
		//echo "Log added";
	}
/* 	$location="'Location: ./studentNotesAddForm.php?UIN=".$UIN."'";
	echo $location;
	header($location); */
	header('Location:studentNotesAddForm.php?UIN='.$UIN);
}
	

?>
<?php
	$conn->close();
}
?>