<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<?php
$UIN = mysqli_real_escape_string($conn, $_REQUEST['UIN']);
$offeringID = mysqli_real_escape_string($conn, $_REQUEST['offeringID']);
$grade  = mysqli_real_escape_string($conn, $_REQUEST['grade']);

echo $UIN."<br />";
echo $offeringID."<br />";
echo $grade."<br />";

$sql = "INSERT INTO bbaonline.bbao_students_grades (UIN, offeringID, grade) VALUES ($UIN, $offeringID, '$grade')";
echo $sql."<br />";

if(mysqli_query($conn, $sql)) {
	//echo "<h3>Instructor added successfully</h3><div align=\"center\"><table width=\"80%\"><tr><td>";
	//echo "New instructor (Instructor name '$instructorFirstName $instructorLastName', Email: $instructorEmail) added successfully<br />";
	
	$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Advisor inserted new grade for student, $UIN, course offering $offeringID, grade $grade')";
	
	if(mysqli_query($conn, $sql_log)){
		//echo "Log added";
	}
	
	header('Location: ./studentGradesAddForm.php');

}
?>
<?php
	$conn->close();
}
?>