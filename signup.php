<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_cache_limiter('');
	session_start();
	
	$dbid = "root";
	$dbpass = "tkfakeh";
	$dbname ="mydb";
	$dbhost = "yj.dev";

	$sqlConn = mysql_connect($dbhost, $dbid, $dbpass);
	mysql_select_db($dbname, $sqlConn);
	if(isset($_POST['signupID']) && isset($_POST['signupPASS']) && $_POST['signupID']!="" && $_POST['signupPASS']!="") {
		$id = $_POST['signupID'];
		$pass = $_POST['signupPASS'];
		$forMD5 = $id.$pass;	
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("아이디나 비밀번호가 입력되지 않았습니다.");';
		echo 'location.replace("./signup.html");';
		echo '</script>';
		return 0;
	}
	$check = "SELECT * FROM Member WHERE id='$id'";
	$check = mysql_query($check);
	$check = mysql_result($check, 0, "id");
	
	if($id) {
		if(!$check){
			if($pass){
			$token = md5($forMD5);
			$setQuery= "INSERT INTO Member VALUES ('$id', '$pass', '$token')";
			$setQuery = mysql_query($setQuery);
			$setQuery = mysql_result($setQuery, 0);
			header('Location: ./signupend.php');
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
