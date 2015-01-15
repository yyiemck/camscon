<?php
	session_cache_limiter('');
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlLink = $sqlConn;
	$sqlConn = $sqlConn->dbConnect();
	$writeTime = date("Y-m-d H:i:s",time());

?>