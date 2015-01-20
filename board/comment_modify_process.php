<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php	
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
	$updateTime = date("Y-m-d H:i:s",time());
	if($_POST['comment_mod_ta']=="") {
		echo '<script type="text/javascript">';
		echo 'alert("내용을 입력해주세요");';
		echo 'history.back(-1);';
		echo '</script>';
	} 
	else {
		if(isset($_SESSION['nickname']) && isset($_POST['comment_mod_ta']) && isset($_POST['modChecker'])) {
			$sqlConn->queryUpdateComment('content_comm', $_POST['comment_mod_ta'], 'index_comm', $_POST['modChecker']); 
			$sqlConn->queryUpdateComment('m_time_comm', $updateTime, 'index_comm', $_POST['modChecker']); 
			echo '<script type="text/javascript">';
			echo 'alert("댓글이 수정되었습니다.");';
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