<?php
	//세션을 사용하기 위해 선언하는 부분
	session_cache_limiter('');
	session_start();
	if($_SESSION['islogin']==0 || !isset($_SESSION['islogin'])){
   		header('Location: ./dblogin.html');
   	}
	//데이터베이스에 접근하기 위한 부분
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
	//*사실 아이디와 같은부분은 서버에 부담을 최소화하기위해 쿠키에 저장하는게 바람직하다.
	
	//데이터베이스에서 id가 가진 토큰을 가져온다.
	$getDBToken = "SELECT token FROM Member WHERE id='$id';x";
	$getDBToken = mysql_query($getDBToken);
	$getDBToken = mysql_result($getDBToken, 0);
	//세션에 등록한 토큰과 데이터베이스의 토큰이 일치하면
	
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
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