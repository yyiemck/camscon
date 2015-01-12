<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
	session_cache_limiter('');
	session_start();

	$dbid = "root";
	$dbpass = "tkfakeh";
	$dbname ="mydb";
	$dbhost = "yj.dev";

	$sqlConn = mysql_connect($dbhost, $dbid, $dbpass);
	mysql_select_db($dbname, $sqlConn);
	$inputToken = $_SESSION['id'].$_POST['nowpass'];
	$inputToken = MD5($inputToken);
	$newToken = $_SESSION['id'].$_POST['afterpass'];
	$newToken = MD5($newToken);
	$getToken = "SELECT token FROM Member WHERE token='$inputToken'";
	$getToken = mysql_query($getToken);
	if(mysql_num_rows($getToken)){
		$getToken = mysql_result($getToken, 0);
	}
	else {
		$getToken = 0;
	}
	if($getToken!=$inputToken){
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
			$updateQuery = "UPDATE Member SET token='$newToken' WHERE token='$getToken'";
			$updateQuery = mysql_query($updateQuery);
			echo '<script type="text/javascript">';
			echo 'alert("비밀번호가 정상적으로 변경되었습니다.");';
			echo 'location.replace("./index.php");';
			echo '</script>';
		}
	}
?>