<?php session_start();
		 session_destroy();
		 unset($_SESSION['LoginUser']);
		 header("Location: Sign_in_up.php");

?>