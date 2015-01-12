<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	include('./dbinfo.php');
	session_cache_limiter('');
	session_start();	
	if(!isset($_SESSION['userid'])){	
		echo '<script type="text/javascript">';
		echo 'alert("잘못된 접근입니다.");';
		echo 'location.replace("./index.php");';
		echo '</script>';
		return 1;
	}
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
	$_SESSION['nickname'] = $_SESSION['userid'];
	$getSessionToken = $_SESSION['token'];
	$_SESSION['islogin'] = 1;
	$id = $_SESSION['userid'];
	$getDBToken = "SELECT token FROM user WHERE userid='$id';";
	$getDBToken = $sqlConn->query($getDBToken);
	$getDBToken = $getDBToken->fetch_array();
?>
<html>
<head>
	<title>Login End</title>
</head>
<body>
<<<<<<< HEAD
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../package/bootstrap/js/bootstrap.min.js"></script>
	<div class="container">
		<p class="login_message">
		<?php
			if(($getDBToken['token'] == $getSessionToken) && $getSessionToken){
				//로그인 인정
				$login = 1;
				echo "$id 님 <br>환영합니다 <br>";
			}
			else {
				$login = 0;
				echo "login failed";
			}
		?>
		</p>
		<button type="submit" value="logout" onclick=location.href="./dblogout.php">로그아웃</button><br>
		<button type="button" value="modify passwd" onclick=location.href="./form_modifypwd.php">비밀번호변경</button><br>
		<button type="button" value="withdraw" onclick=location.href="./form_withdraw.php">회원탈퇴</button><br>
	</div>
=======
	<?php
		if(($getDBToken['token'] == $getSessionToken) && $getSessionToken){
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
>>>>>>> 8f2002d7911b4f45bab88574dc89a01f2bfeae0f
</body>
</html>