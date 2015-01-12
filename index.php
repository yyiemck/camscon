<?php
session_start();
if($_SESSION['islogin']==0 || !isset($_SESSION['islogin'])){
   header('Location: ./dblogin.html');
}
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
</head>
  <body>
       <div class="container">
		<p class="login_message">
		<?php
			echo "$_SESSION[nickname] 님 <br>환영합니다 <br>";	
		?>
		</p>
		<button type="submit" value="logout" onclick=location.href="./dblogout.php">로그아웃</button><br>
		<button type="button" value="modify passwd" onclick=location.href="./form_modifypwd.php">비밀번호변경</button>
	</div>
</body>
</html>