<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_cache_limiter('');
	session_start();
	include('./dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
	$inputToken = $_SESSION['id'].$_POST['nowpass'];
	$inputToken = MD5($inputToken);
	$inputPass = $_POST['afterpass'];
	$newToken = $_SESSION['id'].$_POST['afterpass'];
	$newToken = MD5($newToken);

	$getToken = "SELECT token FROM Member WHERE token='$inputToken'";
	$getToken =  $sqlConn->query($getToken);
	if($getToken->num_rows){
		$getToken = $getToken->fetch_array();
	}
	else {
		$getToken = 0;
	}
	if($getToken['token']!=$inputToken){
		echo '<script type="text/javascript">';
		echo 'alert("현재 비밀번호가 틀렸습니다.");';
		echo 'location.replace("./form_modifypwd.php");';
		echo '</script>';
	}
	else {
		if($_POST['afterpass']!=$_POST['afterpass1']) {
			echo '<script type="text/javascript">';
			echo 'alert("확인 비밀번호가 수정 비밀번호와 다릅니다.");';
			echo 'location.replace("./form_modifypwd.php");';
			echo '</script>';
		}
		else {
			$updateQuery = "UPDATE Member SET token='$newToken', password='$inputPass' WHERE token='$getToken[token]'";
			$updateQuer	y = $sqlConn->query($updateQuery);
			echo '<script type="text/javascript">';
			echo 'alert("비밀번호가 정상적으로 변경되었습니다.");';
			echo 'location.replace("./index.php");';
			echo '</script>';
		}
	}
?>