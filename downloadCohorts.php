<?php
include('config.php');

$enrollmentType = mysqli_real_escape_string($conn, $_REQUEST['enrollmentType']);
$enrollmentTerm = mysqli_real_escape_string($conn, $_REQUEST['enrollmentTerm']);
$enrollmentYear = mysqli_real_escape_string($conn, $_REQUEST['enrollmentYear']);

/* echo $enrollmentType."<br />";
echo $enrollmentTerm."<br />";
echo $enrollmentYear."<br />";
 */
if ($enrollmentType == 0)
	$enrollmentTypeText = "FULL-TIME";
else $enrollmentTypeText = "PART-TIME";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=cohortReport_'.$enrollmentTypeText.'_'.$enrollmentTerm.'_'.$enrollmentYear.'.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('ENROLLMENT', $enrollmentTypeText));
fputcsv($output, array('TERM', $enrollmentTerm));
fputcsv($output, array('YEAR', $enrollmentYear)); 
fputcsv($output, array(' '));
fputcsv($output, array('COHORT'));

$result = mysqli_query($conn, "SELECT UIN, studentLastName, studentFirstName, uicEmail, studentStanding from bbaonline.bbao_students_info WHERE enrollmentType='$enrollmentType' AND enrollmentTerm='$enrollmentTerm' AND enrollmentYear='$enrollmentYear'");

fputcsv($output, array('UIN', 'LAST NAME', 'FIRST NAME', 'EMAIL', 'STUDENT STANDING'));

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	switch($row['studentStanding']) {
		case 0:	$studentStandingText = "Good";
				break;
		case 1: $studentStandingText = "Bad";
				break;
		case 2:	$studentStandingText = "Probation";
				break;
		case 3: $studentStandingText = "Last Chance probation";
				break;
		default: $studentStandingText = "N/A";
				break;
	}
	fputcsv($output, array($row['UIN'], $row['studentLastName'], $row['studentFirstName'], $row['uicEmail'], $studentStandingText));
}




	
?>