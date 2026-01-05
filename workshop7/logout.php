<?php 
if (isset($_GET['logout'])){
	session_destroy();
	header("Refresh:2, url='login.php'");
	exit();
}
?>