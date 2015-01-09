<html>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</html>
<?php
	//세션을 사용하기 위해 선언하는 부분
	session_cache_limiter('');
	session_start();
	
	//데이터베이스에 접근하기 위한 부분
	$dbid = "root";
	$dbpass = "tkfakeh";
	$dbname ="mydb";
	$dbhost = "yj.dev";

	$sqlConn = mysql_connect($dbhost, $dbid, $dbpass);
	mysql_select_db($dbname, $sqlConn);

	//아이디와 비밀번호의 값을 POST방식으로 받는 것
	$id = $_POST['signupID'];
	$pass = $_POST['signupPASS'];
	$forMD5 = $id.$pass;
	$check = "SELECT * FROM Member WHERE id='$id'";
	$check = mysql_query($check);
	$check = mysql_result($check, 0, "id");
	//아이디가 있다면
	if($id) {
		if(!$check){
			if($pass){
			$token = md5($forMD5);
			$setQuery= "INSERT INTO Member VALUES ('$id', '$pass', '$token')";
			$setQuery = mysql_query($setQuery);
			$setQuery = mysql_result($setQuery, 0);
			header('Location: ./signupend.html');
			return 0;
			}
			else {
				echo '<script type="text/javascript">';
				echo 'alert("비밀번호를 입력해주세요");';
				echo 'location.replace("./signup.html");';
				echo '</script>';
				return 1;
			}
		}
		else {
			echo '<script type="text/javascript">';
			echo 'alert("아이디가 중복되었습니다.");';
			echo 'location.replace("./signup.html");';
			echo '</script>';
			return 1;
		}
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("아이디를 입력해주세요.");';
		echo 'location.replace("./signup.html");';
		echo '</script>';
		return 1;
	}
?>
