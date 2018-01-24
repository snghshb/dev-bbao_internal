<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
//echo "page to assign schedule";

include('config.php');

//Assign UIN to student whose manual entry was made in student_grades
$UIN = 650631062;

//$result = mysqli_query($conn, "");
//while($row = mysqli_fetch_array($result))
//$row['UIN']
//enrollmentType
//enrollmentTerm
//enrollmentYear

$result = mysqli_query($conn, "SELECT enrollmentType, enrollmentTerm, enrollmentYear FROM bbaonline.bbao_students_info WHERE UIN = $UIN");

while($row = mysqli_fetch_array($result)) {
	$enrollmentType = $row['enrollmentType'];
	$enrollmentTerm = $row['enrollmentTerm'];
	$enrollmentYear = $row['enrollmentYear'];
}

//get enrollmentType, enrollmentTerm, enrollmentYear for student mentioned above
//echo $enrollmentType." ".$enrollmentTerm." ".$enrollmentYear;


$result1 = mysqli_query($conn, "SELECT UIN from bbaonline.bbao_students_info WHERE enrollmentTerm LIKE '$enrollmentTerm' AND enrollmentType = $enrollmentType AND enrollmentYear = $enrollmentYear AND UIN != $UIN");

while($row1 = mysqli_fetch_array($result1)) {
	
	$result2 = mysqli_query($conn, "SELECT offeringID FROM bbaonline.bbao_students_grades WHERE UIN=$UIN");
	
	$studentUIN = $row1['UIN'];
	
	while($row2 = mysqli_fetch_array($result2)) {
		
		//echo $row1['UIN']." ".$row2['offeringID']." N<br />";
		
		$offeringID = $row2['offeringID'];
		
		//if (mysqli_num_rows(mysqli_query($conn, "SELECT COUNT(*) FROM bbaonline.bbao_students_grades WHERE UIN=$studentUIN AND offeringID=$offeringID")) === 0) {
			$sql = "INSERT INTO bbaonline.bbao_students_grades (UIN, offeringID, grade) VALUES ($studentUIN, $offeringID, 'N')";
			if(mysqli_query($conn, $sql)) {
				echo "entry added for student";
				$sql_log = "INSERT INTO bbaonline.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Inserted entry for $studentUIN, offering ID $offeringID, grade N";
				if(mysqli_query($conn, $sql_log)){
					echo "Log added";
				}
			}
		//}
	}
	
	echo "Entries made for student ".$row1['UIN']."<br /><hr />";
		
}

//echo "</table>";


$conn->close();
}
?>