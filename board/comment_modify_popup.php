<?php
session_start();
if(!isset($_POST['is_ajax'])) exit;
include('../dbinfo.php');
$sqlConn = new dbinfo();
$sqlLink = $sqlConn;
$sqlConn = $sqlConn->dbConnect();
$is_ajax=$_POST['is_ajax'];
$commIndex = $_POST['commIndex'];
$commArray = $sqlLink->querySelectComment('index_comm', $commIndex);
if($commArray[0][1] != $_SESSION['nickname']) exit;
if(!$is_ajax) exit;
echo "success";
?>
