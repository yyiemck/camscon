<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	include('./dbinfo.php');
	session_cache_limiter('');
	session_start();	
	if(!isset($_SESSION['id'])) {	
		echo '<script type="text/javascript">';
		echo 'alert("잘못된 접근입니다.");';
		echo 'location.replace("./index.php");';
		echo '</script>';
		return 1;
	}
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
	$_SESSION['nickname'] = $_SESSION['id'];
	$getSessionToken = $_SESSION['token'];
	$_SESSION['islogin'] = 1;
	$id = $_SESSION['id'];
	$getDBToken = "SELECT token FROM Member WHERE id='$id';";
	$getDBToken = $sqlConn->dblink->query($getDBToken);
	$getDBToken = $getDBToken->fetch_array();
?>
<html>
<head>
	<title>Login End</title>
</head>
<body>
<?php
	if(($getDBToken['token'] == $getSessionToken) && $getSessionToken) {
		$login = 1;
		echo '<script type="text/javascript">';
		echo 'location.replace("./index.php");';
		echo '</script>';
	}
	else {
		$login = 0;
		echo "login failed";
	}
?>
</body>
</html>