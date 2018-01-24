<?php
include('config.php');

$semesterTerm = mysqli_real_escape_string($conn, $_REQUEST['semesterTerm']);
$semesterYear = mysqli_real_escape_string($conn, $_REQUEST['semesterYear']);

//echo $semesterTerm."<br />".$semesterYear;

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=summary_'.$semesterTerm.'_'.$semesterYear.'.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('TERM', $semesterTerm." ".$semesterYear));

fputcsv($output, array('COURSE', 'CRN', 'HOURS', 'INSTRUCTOR LAST NAME', 'INSTRUCTOR FIRST NAME', 'INSTRUCTOR EMAIL', 'PART', 'TYPE', 'STUDENTS ENROLLED'));

$result = mysqli_query($conn, "SELECT c.courseCode, co.CRN, c.semesterHours, i.instructorLastName, i.instructorFirstName, i.instructorEmail, co.part, co.type, (SELECT COUNT(*) FROM bbao_students_grades g WHERE g.offeringID = co.offeringID) as studentsEnrolled FROM bbaonline.bbao_courses c, bbaonline.bbao_instructors i, bbaonline.bbao_courses_offering co WHERE c.courseID=co.courseID AND i.instructorID=co.instructorID AND co.semesterTerm = '$semesterTerm' AND co.semesterYear = '$semesterYear' ORDER BY part asc");

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	/* $courseID = $row['courseID'];
	$courseCode = $row['courseCode'];
	$semesterHours = $row['semesterHours'];
	$instructorID = $row['instructorID'];
	$instructorFirstName = $row['instructorFirstName'];
	$instructorLastName = $row['instructorLastName'];
	$instructorEmail = $row['instructorEmail'];
	$CRN = $row['CRN'];
	$termCode = $row['termCode'];
	$part = $row['part'];
	$type = $row['type'];
	$studentsEnrolled = $row['studentsEnrolled']; */
	
	fputcsv($output, $row);
}

?>