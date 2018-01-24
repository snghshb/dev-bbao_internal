<?php
include('config.php');
include('calculateGPA.php');
$UIN = mysqli_real_escape_string($conn, $_REQUEST['UIN']);
//echo $UIN;

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=studentReport_'.$UIN.'.csv');

$output = fopen('php://output', 'w');

$result = mysqli_query($conn, "SELECT s.UIN, s.studentLastName, s.studentFirstName, s.uicEmail, s.studentStatus, s.enrollmentType, s.studentStanding, s.enrollmentTerm, s.enrollmentYear, s.projectedGraduatingTerm, s.projectedGraduatingYear, s.actualGraduatingTerm, s.actualGraduatingYear, s.transferGPA from bbaonline.bbao_students_info s where s.UIN = '$UIN'");

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$studentLastName = $row['studentLastName'];
	$studentFirstName = $row['studentFirstName'];
	$uicEmail = $row['uicEmail'];
	$studentStatus = $row['studentStatus'];
	$enrollmentType = $row['enrollmentType'];
	$studentStanding = $row['studentStanding'];
	$enrollmentTerm = $row['enrollmentTerm'];
	$enrollmentYear = $row['enrollmentYear'];
	$projectedGraduatingTerm = $row['projectedGraduatingTerm'];
	$projectedGraduatingYear = $row['projectedGraduatingYear'];
	$actualGraduatingTerm = $row['actualGraduatingTerm'];
	$actualGraduatingYear = $row['actualGraduatingYear'];
	$transferGPA = $row['transferGPA'];
	
	$calculatedGPA=calculateGPA($UIN);
	
	switch($row['studentStatus']) {
		case 0:	$studentStatusText = "Enrolled";
				break;
		case 1: $studentStatusText = "Debarred";
				break;
		case 2:	$studentStatusText = "Dismissed";
				break;
		case 3: $studentStatusText = "Dropped Out";
				break;
		case 4:	$studentStatusText = "Graduated";
				break;
		default: $studentStatusText = "N/A";
				break;
	}
	
	if ($row['enrollmentType'] == 0)
		$enrollmentTypeText = "Full Time";
	else echo "Part Time";
	
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
	
	fputcsv($output, array('PERSONAL INFORMATION'));
	fputcsv($output, array('UIN', $UIN, 'Name', $studentLastName.', '.$studentFirstName));
	fputcsv($output, array(''));
	fputcsv($output, array('ACADEMIC INFORMATION'));
	fputcsv($output, array('Transfer GPA', $transferGPA, ' ','Current GPA', $calculatedGPA));
	fputcsv($output, array('Student Status', $studentStatusText, 'Enrollment Type', $enrollmentTypeText, 'Student Standing', $studentStandingText));
	fputcsv($output, array('Enrollment Term', $enrollmentTerm.' '.$enrollmentYear, 'Projected Graduating Term', $projectedGraduatingTerm.' '.$projectedGraduatingYear, 'Actual Graduating Term', $actualGraduatingTerm.' '.$actualGraduatingYear));
	fputcsv($output, array(''));
	fputcsv($output, array('COURSES'));
	
	$result1 = mysqli_query($conn, "SELECT g.recordID, g.grade, c.courseCode, c.semesterHours, co.CRN, co.semesterTerm, co.semesterYear, co.part, co.type from bbaonline.bbao_students_grades g, bbao_courses_offering co, bbao_courses c where g.UIN = '$UIN' AND g.offeringID=co.offeringID AND co.courseID=c.courseID");
	
	fputcsv($output, array('COURSE', 'CRN', 'TERM', 'YEAR', 'PART', 'SUBJECT TYPE', 'GRADE'));
	
	$hours=0;
	$gradePoints=0;
	
	while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
		$multiplier=0;
		
		fputcsv($output, array($row1['courseCode']."(".$row1['semesterHours'].")", $row1['CRN'], $row1['semesterTerm'], $row1['semesterYear'], $row1['part'], $row1['type'], $row1['grade']));
		
		$hours += $row1['semesterHours'];
		
		switch ($row1['grade']) {
			case 'A': 	$multiplier=4;
					break;
			case 'B':	$multiplier=3;
					break;
			case 'C':	$multiplier=2;
					break;
			case 'D':	$multiplier=1;
					break;
			case 'F':	break;
			case 'W':	$hours -= $row1['semesterHours'];
		}
		
		$temp = $row1['semesterHours']*$multiplier;
		$gradePoints += $temp;
	}
	
	fputcsv($output, array(''));
	fputcsv($output, array('Total Grade Points', $gradePoints));
	fputcsv($output, array('Total Hours', $hours));
}
?>