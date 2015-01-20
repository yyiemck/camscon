<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
	$commArray = $sqlConn->querySelectComment('index_comm', $_POST['ind']);

	if($_SESSION['nickname']==$commArray[0][1]) {
		$sqlConn->queryDeleteComment('index_comm', $_POST["ind"]);
		echo '<script type="text/javascript">';
		echo 'alert("삭제되었습니다.");';
		echo 'history.back(-1)';
		echo '</script>';
		return;
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("권한이 없습니다.");';
		echo 'history.back(-1)';
		echo '</script>';
		return;
	}
?>