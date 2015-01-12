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
	.myform {
		border: 2px solid silver;
		padding:1em;
		padding-top: 30px;
		border-radius: 8px;
		margin:auto;
		width: 350px;
		height: 350px;
	}
	span {
		display: inline-block;
		border: 1px solid black;
		width: 120px;
		text-align: center;
		margin: 1px;
		margin-top:15px;
	}
	.container {
		padding: 10px;
		max-width: 500px;
		margin:auto;
	}
	.login {
		text-align: center;
	}
	.text1 {
		margin:1px;
		margin-left: 10px;
		width: 150px;
		height: 25px;
		font-size: 16px;
	}
	.p_texttype{
		padding-left: 40px;
		display: inline-block;
		margin-bottom: 20px;
	}
	.div_btn {
		text-align: center;
		margin: auto;
	}
	.text1:hover{
		background-color: #DAA0DD;
		color: yellow;
	}
</style>
	</style>
	<title>비밀번호 수정</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../package/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../package/bootstrap/js/bootstrap.min.js"></script>
	<div class="container">
		<h2 class="login">비밀번호 수정</h2>
	 	<form action="modifypwd.php" class="myform" method="POST">
	 		<p class="p_texttype">
         	   		<span>현재 비밀번호</span><input type="password" class="text1 form-control" name="nowpass" />
         	   		<span>수정할 비밀번호</span><input type="password" class="text1 form-control" name="afterpass" />
         	   		<span>비밀번호 확인</span><input type="password" class="text1 form-control" name="afterpass1" />
         	   	</p>
         	   	<div class="div_btn">
         		   	<button class="btn btn-primary" type="submit">Modify</button>
         	   		<button class="btn btn-default" type="button" onclick=location.href="./index.php">돌아가기</button>
     		</div>
     	</form>
 	</div>

</body>
</html>