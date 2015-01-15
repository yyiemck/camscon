<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_cache_limiter('');
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlLink = $sqlConn;
	$sqlConn = $sqlConn->dbConnect();
	$writeTime = date("Y-m-d H:i:s",time());
	
	echo $_POST['content'];
	if($_POST['content']==""){
		echo '<script type="text/javascript">';
		echo 'alert("내용을 입력해주세요");';
		echo 'location.replace("./read.php?param='.$_POST['boardindex'].'");';
		echo '</script>';
	} 
	else {
		if(isset($_SESSION['nickname']) && isset($_POST['content'])){
			$sqlLink->queryInsertComment($_SESSION['nickname'], $_POST['content'], $writeTime, $_POST['boardindex']);
			echo '<script type="text/javascript">';
			echo 'alert("댓글이 작성되었습니다.");';
			echo 'location.replace("./read.php?param='.$_POST['boardindex'].'");';
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