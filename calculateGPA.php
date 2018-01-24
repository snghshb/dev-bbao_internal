<?php
error_reporting(0);
function calculateGPA($UIN) {
	include ('config.php');
	$tempUIN=$UIN;
	$result = mysqli_query($conn, "SELECT g.grade, c.semesterHours from bbaonline.bbao_students_grades g, bbao_courses_offering co, bbao_courses c where g.UIN = '$tempUIN' AND g.offeringID=co.offeringID AND co.courseID=c.courseID");
	
	$hours=0;
	$gradePoints=0;
	
	while($row = mysqli_fetch_array($result)) {
	
	$multiplier=0;
	
	$hours += $row['semesterHours'];
	
	switch ($row['grade']) {
		case 'A': 	$multiplier=4;
					break;
		case 'B':	$multiplier=3;
					break;
		case 'C':	$multiplier=2;
					break;
		case 'D':	$multiplier=1;
					break;
		case 'N':	//$multiplier=0;
					$hours -= $row['semesterHours'];
					break;
		case 'F':	break;
		case 'W':	$hours -= $row['semesterHours'];
	}
	
	$temp = $row['semesterHours']*$multiplier;
	$gradePoints += $temp;
	
	}
	
	//echo "Total Grade points: ".$gradePoints."<br />Total Hours: ".$hours."<br />";
	
	$gpa= $gradePoints/$hours;
	
	//echo "GPA= ".$gpa;
	
	return $gpa;
}

?>