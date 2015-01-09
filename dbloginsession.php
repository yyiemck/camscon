<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_cache_limiter('');
	session_start();	
	if(!isset($_SESSION['id'])){	
		echo '<script type="text/javascript">';
		echo 'alert("잘못된 접근입니다.");';
		echo 'location.replace("./index.php");';
		echo '</script>';
		return 1;
	}
	$dbid = "root";
	$dbpass = "tkfakeh";
	$dbname ="mydb";
	$dbhost = "yj.dev";
	
	$sqlConn = mysql_connect($dbhost, $dbid, $dbpass);
	mysql_select_db($dbname, $sqlConn);
	$_SESSION['nickname'] = $_SESSION['id'];

	//세션에서 토큰(키 값)을 가져온다.
	$getSessionToken = $_SESSION['token'];
	//세션에서 아이디를 가져온다.
	$_SESSION['islogin'] = 1;
	$id = $_SESSION['id'];
	$getDBToken = "SELECT token FROM Member WHERE id='$id';";
	$getDBToken = mysql_query($getDBToken);
	$getDBToken = mysql_result($getDBToken, 0);
?>
<html>
<head>
	<style type="text/css">
		button {
			width: 100px;
		}
		.container {
			border: 2px solid gray;
			padding:0.8em 1.4em; 
			border-radius: 5px;
			margin: auto;
			width: 500px;
			height: 240px;
		}
		.login_message{
			text-align: center;
			border: 1px solid green;
			width: 98px;
			position: relative;
			margin-bottom: 0;
		}
	</style>
	<title>Login End</title>
</head>
<body>
	<div class="container">
		<p class="login_message">
		<?php
			if($getDBToken == $getSessionToken && $getSessionToken){
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
		<button type="button" value="modify passwd" onclick=location.href="./form_modifypwd.php">비밀번호변경</button>
	</div>
</body>
</html>