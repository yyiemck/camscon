<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php
	session_cache_limiter('');
	session_start();

	include('./dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();

	$inputToken = $_SESSION['id'].$_POST['pass'];
	$inputToken = MD5($inputToken);
	$getToken = "SELECT token FROM Member WHERE token='$inputToken'";
	$getToken = $sqlConn->dblink->query($getToken);
	if($getToken->num_rows) {
		$getToken = $getToken -> fetch_array();
	}
	else {
		$getToken = 0;
	}
	if($getToken['token']!=$inputToken) {
		echo '<script type="text/javascript">';
		echo 'alert("비밀번호가 틀렸습니다.");';
		echo 'location.replace("./form_withdraw.php");';
		echo '</script>';
	}
	else {
		$updateQuery = "DELETE FROM Member WHERE token='$inputToken'";
		$updateQuery = $sqlConn->dblink->query($updateQuery);
		echo '<script type="text/javascript">';
		echo 'alert("탈퇴되었습니다.");';
		unset ($_SESSION['nickname']);
		unset ($_SESSION['token']);
		unset ($_SESSION['islogin']);
		unset ($_SESSION['id']);
		echo 'location.replace("./dblogin.html");';
		echo '</script>';
	}
?>