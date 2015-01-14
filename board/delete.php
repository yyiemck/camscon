<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlLink = $sqlConn;
	$sqlConn = $sqlConn->dbConnect();
	$sqlLink->queryDeleteBoard('index', $_POST['ind'], 'password', $_POST['val']);
?>
<script type="text/javascript">
	alert('글이 삭제되었습니다.');
	location.replace("./board1.php");
</script>