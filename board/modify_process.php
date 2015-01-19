<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_cache_limiter('');
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlLink = $sqlConn;
	$sqlConn = $sqlConn->dbConnect();
	$updateTime = date("Y-m-d H:i:s",time());
	if($_POST['title']==""){
		echo '<script type="text/javascript">';
		echo 'alert("글의 제목을 입력해주세요");';
		echo 'location.replace("./modify.php");';
		echo '</script>';
	} else if($_POST['content']==""){
		echo '<script type="text/javascript">';
		echo 'alert("글의 내용을 입력해주세요");';
		echo 'location.replace("./modify.php");';
		echo '</script>';
	} else if($_POST['passwd']==""){
		echo '<script type="text/javascript">';
		echo 'alert("비밀번호를 입력해주세요");';
		echo 'location.replace("./modify.php");';
		echo '</script>';
	} else {
		if(isset($_SESSION['nickname']) && isset($_POST['passwd']) && isset($_POST['title']) && isset($_POST['content'])){
			$sqlLink->queryUpdateBoard('password', $_POST['passwd'], 'index', $_POST['ind']);
			$sqlLink->queryUpdateBoard('title', $_POST['title'], 'index', $_POST['ind']); 
			$sqlLink->queryUpdateBoard('content', $_POST['content'], 'index', $_POST['ind']); 
			$sqlLink->queryUpdateBoard('modifytime', $updateTime, 'index', $_POST['ind']); 
			echo '<script type="text/javascript">';
			echo 'alert("글이 수정되었습니다.");';
			echo 'history.back(-1);';
			echo '</script>';
		}
		else {
			echo '<script type="text/javascript">';
			echo 'alert("올바른 접근이 아닙니다.");';
			echo 'location.replace("../index.php");';
			echo '</script>';
		}
	}
?>
