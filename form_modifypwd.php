<?php
session_start();
if($_SESSION['islogin']==0 || !isset($_SESSION['islogin'])){
   header('Location: ./index.php');
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<head>
	<style type="text/css">
	form {
		border: 2px solid gray;
		padding:1.2em;
		padding-left: 60px;
		padding-top: 60px;
		border-radius: 5px;
		margin: auto;
		width: 350px;
		height: 240px;
	}
	span {
		display: inline-block;
		border: 1px solid black;
		width: 120px;
		text-align: center;
		margin: 1px;
	}
	.container {
		padding: 10px;
		max-width: 500px;
		margin:auto;
	}
	.login {
		text-align: center;
	}
	.submit1 {
		display: inline-block;
		background-color: black;
		font-family: "Verdana";
		font-size: 20px;
		font-weight: bold;
		color: yellow;
		width: 100px;
	}
	.text1 {
		margin:1px;
		margin-left: 10px;
		width: 160px;
		height: 25px;
		font-size: 16px;
	}
	.text1:hover{
		background-color: purple;
		color: yellow;
	}
	</style>
	<title>비밀번호 수정</title>
</head>
<body>
	<div class="container">
		<h2 class="login">비밀번호 수정</h2>
	 	<form action="modifypwd.php" method="POST">
	 		<p>
         	   		<span>현재 비밀번호</span><input type="password" class="text1" name="nowpass" /><br>
         	   		<span>수정할 비밀번호</span><input type="password" class="text1" name="afterpass" />
         	   		<span>비밀번호 확인</span><input type="password" class="text1" name="afterpass1" />
         	   	</p>
         	   	<button class="submit1" type="submit">Modify</button>
         	   	<button class="submit1" type="button" onclick=location.href="./index.php">돌아가기</button>
     	</form>
 	</div>

</body>
</html>