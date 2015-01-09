<?php
	//세션을 사용하기 위해 선언하는 부분
	session_cache_limiter('');
	session_start();

	//세션에 등록된 아이디 가져오기
	$id = $_SESSION['id'];

	//세션에 등록된 토큰 파기
	$_SESSION['nickname'] = "";
	$_SESSION['token'] = 0;	
	$_SESSION['islogin'] = 0;
	//세션에 등록된 아이디 파기
	$_SESSION['id'] = 0;

	//데이터베이스에서 토큰 초기화
	header('Location: ./dblogin.html');
?>

