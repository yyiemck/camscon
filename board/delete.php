<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlLink = $sqlConn;
	$sqlConn = $sqlConn->dbConnect();
	$boardArray = $sqlLink->querySelectBoard('index', $_POST['ind']);
	if($_SESSION['nickname']!=$boardArray[0][1]){
		echo '<script type="text/javascript">';
		echo 'alert("권한이 없습니다.");';
		echo 'history.back(-1)';
		echo '</script>';
		return;
	}
	$sqlLink->queryDeleteBoard('index', $_POST['ind'], 'password', $_POST['val']);
	$sqlLink->queryDeleteCommentInBoard($_POST['ind']);
?>
<script type="text/javascript">
	alert('글이 삭제되었습니다.');
	location.replace("./board1.php");
</script>