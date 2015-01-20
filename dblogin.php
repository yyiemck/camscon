<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</html>
<?php
	include('./dbinfo.php');
	session_cache_limiter('');
	session_start();
	if(isset($_SESSION['islogin'])) {
		if($_SESSION['islogin']) {
			header('Location: ./index.php');
		}
	}
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
	if(isset($_POST['loginID']) && isset($_POST['loginPASS'])) {
		$id = $sqlConn->dblink->real_escape_string($_POST['loginID']);
		$pass = $sqlConn->dblink->real_escape_string($_POST['loginPASS']);
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("아이디나 비밀번호가 입력되지 않았습니다.");';
		echo 'location.replace("./dblogin.html");';
		echo '</script>';
		return 1;
	}
	$getID = "SELECT id FROM Member WHERE id='$id'";
	$getID = $sqlConn->dblink->query($getID);
	$getID = $getID->fetch_array();
	//아이디가 있다면
	if($getID['id']) {
		$getPASS = "SELECT password FROM Member WHERE id='$id'";
		$getPASS = $sqlConn->dblink->query($getPASS);
		$getPASS = $getPASS->fetch_array();
		
		if($getPASS['password'] == $pass) {
			$token = md5($id.$pass);
			$_SESSION['id'] = $id;
			$_SESSION['token'] = $token;
			header('Location: ./dbloginsession.php');
			return 0;
		}
		else {
			echo '<script type="text/javascript">';
			echo 'alert("비밀번호가 틀립니다.");';
			echo 'location.replace("./dblogin.html");';
			echo '</script>';
			return 1;
		}
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("아이디가 존재하지 않습니다.");';
		echo 'location.replace("./dblogin.html");';
		echo '</script>';
		return 1;
	}
?>