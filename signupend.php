<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
session_start();
	if(isset($_SESSION['signupID']) && isset($_SESSION['signupPASS'])) {
		unset($_SESSION['signupID']);
		unset($_SESSION['signupPASS']);
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("잘못된 접근입니다.");';
		echo 'location.replace("./signup.html");';
		echo '</script>';
		return 0;
	}
?>
<html>
<head>
	<style type="text/css">
	.myform {
		border: 2px solid silver;
		padding:1.2em;
		padding-top: 80px;
		border-radius: 8px;
		margin:auto;
		width: 350px;
		height: 240px;
		text-align: center;
		vertical-align: center;
	}
	.container {
		padding: 10px;
		max-width: 500px;
		margin:auto;
	}
	.signup_end {
		text-align: center;
	}
	.text1:hover{
		background-color: #DAA0DD;
		color: yellow;
	}
</style>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../package/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<title>Sign up Succeed!</title>
</head>
<body>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../package/bootstrap/js/bootstrap.min.js"></script>
	<div class="container">
		<h2 class="signup_end">가입완료!</h2>
		<form class="myform">	
	 		<div class="div_p">
        			<p>가입을 축하드립니다.</p>
     		</div>
     		<button type="button" class="btn btn-danger" id="rt">로그인 화면으로</button>
 		</form>
 	</div>
 	<script>
 		var returnbutton = document.getElementById('rt');
 		returnbutton.onclick = function(){
 			location.href="./dblogin.html";
 		}
 	</script>	
</body>
</html>