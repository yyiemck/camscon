<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_cache_limiter('');
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
	$writeTime = date("Y-m-d H:i:s",time());
	if($_POST['title']=="") {
		echo '<script type="text/javascript">';
		echo 'alert("글의 제목을 입력해주세요");';
		echo 'location.replace("./write.php");';
		echo '</script>';
	} 
	else if($_POST['content']=="") {
		echo '<script type="text/javascript">';
		echo 'alert("글의 내용을 입력해주세요");';
		echo 'location.replace("./write.php");';
		echo '</script>';
	} 
	else if($_POST['passwd']=="") {
		echo '<script type="text/javascript">';
		echo 'alert("비밀번호를 입력해주세요");';
		echo 'location.replace("./write.php");';
		echo '</script>';
	} 
	else {
		if(isset($_SESSION['nickname']) && isset($_POST['passwd']) && isset($_POST['title']) && isset($_POST['content'])) {
			$sqlConn->queryInsertBoard($_SESSION['nickname'], $_POST['passwd'], $_POST['title'], $_POST['content'], $writeTime, 0, $_POST['board_number']);
			echo '<script type="text/javascript">';
			echo 'alert("글이 작성되었습니다.");';
			echo 'location.replace("./board1.php?board='.$_POST['board_number'].'");';
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