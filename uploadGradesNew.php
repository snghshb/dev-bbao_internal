<?php
//include('config.php'); 
include('session.php'); 
$conn = mysqli_connect('localhost','root','I12bsafe2','bbaonline_test');
if (ADVISOR_ID === 0)
	header('Location: ./login.php');
else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Upload Grades</title>
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
	<script> 
    $(function(){
      $("#includeTempMenu").load("tempMenu.html"); 
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

<?php
$offeringID = mysqli_real_escape_string($conn, $_REQUEST['offeringID']);
$grade = mysqli_real_escape_string($conn, $_REQUEST['grade']);
$has_title_row = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(is_uploaded_file($_FILES['grade']['tmp_name'])){
        $filename = basename($_FILES['grade']['name']);
        
        if(substr($filename, -3) == 'csv'){
            $tmpfile = $_FILES['grade']['tmp_name'];
            if (($fh = fopen($tmpfile, "r")) !== FALSE) {
                $i = 0;
				echo "<h3>Following grades have been added to the database.</h3><div align=\"center\">";
				echo "<table class=\"table table-hover\" width=\"100%\">";
				echo "<thead><tr><th>UIN</th><th>Grades</th></tr></thead>";
				echo "<tbody>";
                while (($items = fgetcsv($fh, 10000, ",")) !== FALSE) {
					if($has_title_row === true && $i == 0){ //first row of CSV file
						$j = count($items);
						for ($x = 0; $x < $j; $x++) {
							if (stripos($items[$x], 'uin') !== false) {
								$UIN = $x;
							}
							if (stripos($items[$x], 'grade') !== false) {
								$grade2 = $x;
							}
						}
					}
					if($i !== 0) {
						$sql = "UPDATE bbaonline_test.bbao_students_grades SET grade = '$items[$grade2]' WHERE UIN = $items[$UIN] AND offeringID = $offeringID;";
						if(mysqli_query($conn, $sql)) {	
							echo "<tr><td>";
							echo $items[$UIN];
							echo "</td><td>";
							echo $items[$grade2];
							echo "</td></tr>";
							$sql_log = "INSERT INTO bbaonline_test.bbao_advisors_log (advisorID, action) VALUES (".ADVISOR_ID.", 'Updated a grade for Course Offering: $offeringID and UIN: $items[$UIN]')";
							if(mysqli_query($conn, $sql_log)){
								//echo "Log added";
							}
						}
                    }
                    $i++;
					
                }
				echo "</tbody></table></div>";


            }
        }
        else{
            die('Invalid file format uploaded. Please upload CSV.');
        }
    }
    else{
        die('Please upload a CSV file.');
    }
}
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