<?php
	session_start();
	if($_SESSION['islogin']==0 || !isset($_SESSION['islogin'])) {
		header('Location: ./index.php');
	}
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<head>
	<style type="text/css">
		.myform {
			border: 2px solid silver;
			padding:1em;
			padding-top: 50px;
			border-radius: 8px;
			margin:auto;
			width: 350px;
			height: 350px;
		}
		span {
			display: inline-block;
			border: 1px solid black;
			width: 100px;
			text-align: center;
			margin: 1px;
			margin-top:30px;
		}
		.container {
			padding: 10px;
			max-width: 500px;
			margin:auto;
		}
		.withdraw {
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
			margin-bottom: 30px;
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
	<title>회원탈퇴</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../package/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../package/bootstrap/js/bootstrap.min.js"></script>
	<div class="container">
		<h2 class="withdraw">회원탈퇴</h2>
		<form action="withdraw.php" class="myform" method="POST">
			<h4 class="withdraw">비밀번호를 한번 더 입력해주세요</h4>
			<p class="p_texttype">
				<span>비밀번호</span><input type="password" class="text1 form-control" name="pass" />
			</p>
			<div class="div_btn">
				<button class="btn btn-primary" type="submit">탈퇴</button>
				<button class="btn btn-default" type="button" id="rt">돌아가기</button>
			</div>
		</form>
	</div>
	<script>
 		var returnbutton = document.getElementById('rt');
 		returnbutton.onclick = function() {
 			location.href="./index.php";
 		}
 	</script>
</body>
</html>