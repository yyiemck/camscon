<?php
	session_cache_limiter('');
	session_start();

	unset($_SESSION['nickname']);
	unset($_SESSION['token']);	
	unset($_SESSION['islogin']);
	unset($_SESSION['id']);

	header('Location: ./dblogin.html');
?>

