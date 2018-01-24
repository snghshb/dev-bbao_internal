<?php

include('config.php');
$offeringID = mysqli_real_escape_string($conn, $_REQUEST['offeringID']);

$result = mysqli_query($conn, "SELECT c.courseID, c.courseCode, i.instructorID, i.instructorFirstName, i.instructorLastName, i.instructorEmail, co.CRN, co.semesterTerm, co.semesterYear, co.termCode, co.part, co.type FROM bbaonline.bbao_courses c, bbaonline.bbao_instructors i, bbaonline.bbao_courses_offering co WHERE c.courseID=co.courseID AND i.instructorID=co.instructorID AND co.offeringID = $offeringID");

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$courseID = $row['courseID'];
	$courseCode = $row['courseCode'];
	$instructorID = $row['instructorID'];
	$instructorFirstName = $row['instructorFirstName'];
	$instructorLastName = $row['instructorLastName'];
	$instructorEmail = $row['instructorEmail'];
	$CRN = $row['CRN'];
	$semesterTerm = $row['semesterTerm'];
	$semesterYear = $row['semesterYear'];
	$termCode = $row['termCode'];
	$part = $row['part'];
	$type = $row['type'];
}

//$fileName = 'roster_'.$termCode.'_'.$part.'_'.$courseCode.'.csv';

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=roster_'.$termCode.'_'.$part.'_'.$courseCode.'.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

fputcsv($output, array('TERM', $semesterTerm." ".$semesterYear." (".$termCode.") PART:".$part));
fputcsv($output, array('SUBJECT', $courseCode." (CRN: ".$CRN.")"));
fputcsv($output, array('INSTRUCTOR', $instructorLastName.", ".$instructorFirstName." (".$instructorEmail.")"));
fputcsv($output, array('COHORT'));

// output the column headings
fputcsv($output, array('UIN', 'LAST NAME', 'FIRST NAME', 'EMAIL', 'grade'));

// fetch the data
$result1 = mysqli_query($conn, "SELECT s.UIN, s.studentLastName, s.studentFirstname, s.uicEmail , g.grade from bbaonline.bbao_students_info s, bbaonline.bbao_students_grades g WHERE offeringID='$offeringID' AND s.UIN=g.UIN ORDER BY s.UIN");

while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
	fputcsv($output, $row1);
	
}

?>