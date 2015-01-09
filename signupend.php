<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
session_start();
	if(isset($_POST['signupID']) && isset($_POST['signupPASS'])) {
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
	<title>Sign up Succeed!</title>
</head>
<body>
	가입을 축하드립니다.
	<input type="button" value="로그인 화면으로" onclick="location.href='dblogin.html'"></button>
</body>
</html>