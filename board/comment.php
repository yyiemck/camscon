<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_cache_limiter('');
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
	$writeTime = date("Y-m-d H:i:s",time());	
	if(!isset($_POST['content_c'])) {
		echo '<script type="text/javascript">';
		echo 'location.replace("../index.php");';
		echo 'alert("올바른 접근이 아닙니다.");';
		echo '</script>';
	} 
	else {
		if(isset($_SESSION['nickname']) && $_POST['content_c']!="") {
			$sqlConn->queryInsertComment($_SESSION['nickname'], $_POST['content_c'], $writeTime, $_POST['boardindex']);
			echo '<script type="text/javascript">';
			echo 'alert("댓글이 작성되었습니다.");';
			if(isset($_POST['myread'])) {
				echo 'location.replace("./myread.php?param='.$_POST['boardindex'].'");';
			} 
			else {
				echo 'location.replace("./read.php?param='.$_POST['boardindex'].'");';
			}
			echo '</script>';
		}
		else {
			echo '<script type="text/javascript">';
			echo 'alert("내용을 입력해주세요");';
			if(isset($_POST['myread'])) {
				echo 'location.replace("./myread.php?param='.$_POST['boardindex'].'");';
			} 
			else {
				echo 'location.replace("./read.php?param='.$_POST['boardindex'].'");';
			}
			echo '</script>';
		}
	}
?>
