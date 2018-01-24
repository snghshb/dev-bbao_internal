<?php
error_reporting(0);
include('config.php');
session_start();

$user_check = $_SESSION['login_user'];
//echo $_SESSION['login_user'];
$ses_sql = mysqli_query($conn,"select advisorID, advisorFirstName, advisorLastName from bbaonline.bbao_advisors where netID = '$user_check' ");
   
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  
$name = $row['advisorFirstName']." ".$row['advisorLastName'];

$advisorID = $row['advisorID'];

define('ADVISOR_ID', $advisorID);
//echo ADVISOR_ID;
$login_session = $name;
define('FNAME', $row['advisorFirstName']);
/* if(!isset($_SESSION['login_user'])){
      header("location: login.php");
   } */
?>