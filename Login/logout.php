<?php
	session_start();
	session_unset();
	setcookie("name", "", time()-3600,"/");	
	session_destroy();
	header("Location:http://localhost/120170770_101/login.php");
?>