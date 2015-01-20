<?php
	session_start();
	if($_SESSION['islogin']==0 || !isset($_SESSION['islogin'])) {
		header('Location: ../dblogin.html');
	} 
	else {
		header('Location: ./board1.php');
	}
?>