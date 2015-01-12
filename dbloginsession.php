<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	include('./dbinfo.php');
	session_cache_limiter('');
	session_start();	
	if(!isset($_SESSION['id'])){	
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
	$getDBToken = $sqlConn->query($getDBToken);
	$getDBToken = $getDBToken->fetch_array();
?>

<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../package/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
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
		<button type="button" value="modify passwd" onclick=location.href="./form_modifypwd.php">비밀번호변경</button>
	</div>
</body>
</html>