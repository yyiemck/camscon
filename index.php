<?php
session_start();
if($_SESSION['islogin']==0 || !isset($_SESSION['islogin'])){
	header('Location: ./dblogin.html');
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../package/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<style type="text/css">
	.myform {
		border: 2px solid silver;
		padding:1.2em;
		padding-top: 50px;
		border-radius: 8px;
		margin:auto;
		width: 350px;
		height: 350px;
	}
	.img_size {
		width: 125px;
		height: 125px;
	}
	.mybtn {
		width: 100px;
	}
	.mybtn_2 {
		padding: 14px;
	}
	.container {
		padding: 10px;
		max-width: 500px;
		margin:auto;
		text-align: center;
	}
	</style>
</head>
<body>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../package/bootstrap/js/bootstrap.min.js"></script>
	<div class="container">
		<h2 class="login">Welcome!</h2>
		<form class="myform">
			<div class="img_btn">
				<img class="img_size" src="./images.jpg"></img><br>
				<div class="btn-group">
					<button type="button" class="mybtn btn btn-danger">
						<?php
						echo "$_SESSION[nickname]";	
						?>	
					</button>
					<button type="button" class="mybtn_2 btn btn-danger dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="./dblogout.php"><i class="glyphicon glyphicon-off"></i> 로그아웃</a></li>
						<li><a href="./form_modifypwd.php"><i class="glyphicon glyphicon-edit"></i> 비밀번호 변경</a></li>
						<li class="divider"></li>
						<li><a href="./form_withdraw.php"><i class="glyphicon glyphicon-trash"></i> 회원탈퇴</a></li>
					</ul>
				</div>
			</div>
		</form>
	</div>
</body>
</html>