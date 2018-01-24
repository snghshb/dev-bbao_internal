<?php
session_start();
unset($_SESSION['login_user']);        
unset($_SESSION["password"]);
   
session_destroy();
echo "successfully logged out";
?>
<html>
<body>
<a href="./login.php">Login again</a>
</body>
</html>