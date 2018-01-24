<?php
include('config.php'); 
include('session.php'); 
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>List Students</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/custom.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans">
	<script> 
    $(function(){
      $("#includeHeader").load("header.html"); 
    });
    </script>
	<script> 
    $(function(){
      $("#includeNavbar").load("navbar.php"); 
    });
    </script>
	<script> 
    $(function(){
      $("#includeFooter").load("footer.html"); 
    });
    </script>
</head>
<body>
<div class="wrapper">
<div id="includeHeader"></div>
<div id="includeNavbar"></div>
<div class="content" align="center">
<table width="80%">
<tr>
<td>
<h3>Add Student Notes</h3>
<div align="center">
<table width="80%">
<tr>
<td>
<?php
if (isset($_GET['UIN']) && is_numeric($_GET['UIN']) && $_GET['UIN'] > 0) {
	$UIN = $_GET['UIN'];
}
else $UIN = mysqli_real_escape_string($conn, $_REQUEST['UIN']);
$sql = "SELECT UIN, studentLastName, studentFirstName from bbaonline.bbao_students_info where UIN=$UIN";
$result = mysqli_query($conn,$sql);
while($row = $result->fetch_assoc()) {
	$UIN = $row['UIN'];
	$studentLastName = $row['studentLastName'];
	$studentFirstName = $row['studentFirstName'];
}
//echo "<br />".ADVISOR_ID;
?>
<form class="form-horizontal" action="studentNotesAddNew.php" name="studentNotesAddNewForm" method="post" enctype="multipart/form-data" >
	<input type="hidden" name="UIN" value="<?php echo $UIN; ?>"/>
	<div class="form-group">
		<label class="control-label col-sm-12" for="name">
		<button class=\"btn btn-default\"><a href=studentViewAllDetails.php?UIN=<?php echo $UIN;?>>
		<?php echo $studentLastName.", ".$studentFirstName." (".$UIN.")";?></a>
		</button>
		</label>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3" for="communicationMode">Communication Mode</label>
		<div class="col-sm-9">
			<select class="form-control" id="communicationMode" name="communicationMode">
				<option value='0'>Email</option>
				<option value='1'>Phone</option>
				<option value='2'>Video/Skype</option>
				<option value='3'>In Person</option>
			</select>
		</div>
	</div>
	<div class="form-group">
      <label for="studentNotes">Notes</label>
      <textarea class="form-control" rows="5" id="studentNotes" name="studentNotes"></textarea>
    </div>
	<div class="form-group">        
		<div class="col-sm-12">
			<button type="submit" class="btn btn-default">Add Note</button>
		</div>
    </div>
	<hr />
</form>
</td>
</tr>
<tr>
<td>
<?php
$result1 = mysqli_query($conn, "SELECT notesDate, advisorID, communicationMode, studentNotes from bbaonline.bbao_students_notes WHERE UIN='$UIN' ORDER BY notesDate desc");

echo "<table class=\"table table-hover\" width=\"100%\">";
echo "<thead><tr><th>Date (server time is in PST)</th><th>ADVISOR</th><th>Mode</th><th>Notes</th></thead>";
echo "<tbody>";
while($row1 = mysqli_fetch_array($result1)) {
	echo "<tr>";
	echo "<td>".$row1['notesDate']."</td>";
	echo "<td>";
	$advisorID=$row1['advisorID'];
	$result2 = mysqli_query($conn, "SELECT advisorFirstName, advisorLastName from bbaonline.bbao_advisors WHERE advisorID ='$advisorID'");
	while($row2 = mysqli_fetch_array($result2)) {
		echo $row2['advisorFirstName']." ".$row2['advisorLastName'];
	}
	echo "</td>";
	echo "<td>";
	switch ($row1['communicationMode']) {
		case 0: echo "Email";
				break;
		case 1: echo "Phone";
				break;
		case 2: echo "Video/Skype";
				break;
		case 3: echo "In Person";
				break;
		default: echo "N/A";
	}
	echo "</td>";
	echo "<td>".$row1['studentNotes']."</td>";
	echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "<hr />";
?>
</td>
</tr>
</table>
</div>
</td>
</tr>
<tr>
<td><p>&nbsp;</p></td>
</tr>
</table>
</div>
<div class="push"></div>
</div>
<div id="includeFooter"></div>
</body>
</html>
<?php
	$conn->close();
}
?>