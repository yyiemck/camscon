<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</html>
<?php
	include('./dbinfo.php');
	session_cache_limiter('');
	session_start();
	if(isset($_SESSION['islogin'])){
		if($_SESSION['islogin']){
		header('Location: ./index.php');
		}
	}
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
	if(isset($_POST['loginID']) && isset($_POST['loginPASS'])) {
		$id = $sqlConn->real_escape_string($_POST['loginID']);
		$pass = $sqlConn->real_escape_string($_POST['loginPASS']);
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("아이디나 비밀번호가 입력되지 않았습니다.");';
		echo 'location.replace("./dblogin.html");';
		echo '</script>';
		return 1;
	}
	//입력받은 아이디가 존재하는지 체크하기 위해 데이터베이스에서 id를 가져옴
	$getID = "SELECT userid FROM user WHERE userid='$id'";
	$getID = $sqlConn->query($getID);
	$getID = $getID->fetch_array();
	//아이디가 있다면
	if($getID['userid']) {
		//아이디를 바탕으로 그 아이디가 가진 곳의 비밀번호를 가져온다
		$getPASS = "SELECT password FROM user WHERE userid='$id'";
		$getPASS = $sqlConn->query($getPASS);
		$getPASS = $getPASS->fetch_array();
		
		//데이터베이스에서 가져온 비밀번호가 입력받은 비밀번호와 같다면,
		if($getPASS['password'] == $pass) {
			//64자리의 무작위 문자열을 생성한다.
			//이 64자리의 임의의 수가 바로 토큰으로 로그인 대조에 사용할 키 값.
			$token = md5($id.$pass);
			
			//방금 만든 토큰을 데이터베이스에 업데이트한다.
			//입력받은 아이디가 있는 위치에 업데이트.
		
			//세션에 토큰 즉 키 값을 등록한다.
			$_SESSION['userid'] = $id;
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