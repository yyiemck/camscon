<?php
session_start();	
$id = 'youngjin';
$pwd = 'wtf';
if(!empty($_POST['id']) && !empty($_POST['pwd'])){
    if($_POST['id'] == $id && $_POST['pwd'] == $pwd){
        $_SESSION['is_login'] = true;
        $_SESSION['nickname'] = '영진';
        header('Location: ./index.php');
        exit;
    }
}
echo '로그인 하지 못했습니다.';
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</html>