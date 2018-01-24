<div align="center">
<table width="100%">
<tr><td>
<nav class="navbar navbar-default">
	<div class="container-navbar">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<li><a href="./home.php">Admin Home</a></li>
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Student<span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				<li role="separator" class="divider"></li>
                <li class="dropdown-header">Add New</li>
				<li><a href="./studentAddForm.php">Student</a></li>
				<li><a href="./studentSelectForm.php">Student Notes</a></li>
				<li role="separator" class="divider"></li>
                <li class="dropdown-header">View/Edit Existing</li>
				<li><a href="./studentListAll.php">Student Details</a></li>
			</ul>
			</li>
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Manage<span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				<li role="separator" class="divider"></li>
                <li class="dropdown-header">Add New</li>
				<li><a href="./instructorAddForm.php">Instructor</a></li>
				<li><a href="./courseAddForm.php">Course</a></li>
				<li><a href="./courseOfferingAddForm.php">Course Offering</a></li>
				<li><a href="./scheduleAddForm.php">Schedule</a></li>
				<li role="separator" class="divider"></li>
                <li class="dropdown-header">View/Edit Exiting</li>
				<li><a href="./instructorListAll.php">Instructor</a></li>
				<li><a href="./courseListAll.php">Course</a></li>
				<li><a href="./courseOfferingListAll.php">Course Offering</a></li>
				<li><a href="./scheduleListAll.php">Schedule</a></li>
			</ul>
			</li>
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Grades<span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				<li><a href="./studentGradesAddForm.php">Add New Student Grades</a></li>
				<li><a href="./gradesListAll.php">View/Edit Existing Student Grades</a></li>
				<li><a href="./assignScheduleForm.php">Assign Schedule</a></li>
				<li><a href="./uploadGradesForm.php">Upload Grades</a></li>
			</ul>
			</li>
			<li><a href="./searchStudent.php">Search Student</a></li>
			<li><a href="./bbaoReports.php">Reports</a></li>
			<!--li><a href="./bbaoSendEmails.php">Send Emails</a></li-->
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<li><a href="./adminhelp.php" target="_blank">Help</a></li>
		<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><?php include('session.php'); echo FNAME;?><span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<li><a href="./logout.php">Logout</a></li>
		</ul>
		</li>
		</ul>
	</div>
	</div>
</nav>
</td></tr>
</table>