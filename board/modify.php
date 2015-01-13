<?php
session_start();
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<head>
	<title>BOARD write</title>
	<style type="text/css">
	form {
		margin: auto;
	}
	tr {
		margin: 20px;
	}
	.container {
		max-width: 600px;
		margin: auto;
		margin-top: 30px;
	}
	.head {
		height: 20px;
		padding:10px;
		margin-bottom: 10px;
		text-align: center;
		background-color: #999999;
		color: white;
		font-weight: bold;
	}
	.table1 {
		max-width: 580px;
	}
	.text1 {	
		max-width: 100px;
		margin: 5px;
	}
	.text2{
		max-width: 400px;
		margin: 5px;
	}
	.tag {
		width: 90px;
		margin: 5px;
		text-align: left;
		vertical-align: center;
	}
	.box {
		max-width: 400px;
	}
	</style>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../../package/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../../package/bootstrap/js/bootstrap.min.js"></script>
	<div class="container">
		<ul class="nav nav-pills">
 			<li role="presentation"><a href="#">게시판</a></li>
  			<li role="presentation"><a href="write.php">글쓰기</a></li>
		</ul>
		<form action="insert.php" method="POST">
			<table class="table1 table table-bordered">
				<tr>
					<td class="head" colspan="4">Modify Form</td>
				</tr>
				<tr>
					<td class="tag">이름</td>
					<td><?php echo "$_SESSION[nickname]"?></td>
				</tr>
				<tr>
					<td class="tag">비밀번호</td>
					<td class="box">
						<input type="password" class="text1 form-control" name="passwd"/>
					</td>
				</tr>
				<tr>
					<td class="tag">제목</td>
					<td class="box">
						<input type="text" class="text2 form-control" name="title"/>
					</td>
				</tr>
				<tr>
					<td class="tag">내용</td>
					<td class="box">
						<textarea name="content" class="text2 form-control" cols="20" rows="10"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:center">
						<input type="submit" value="저장"></input>
						<input type="reset" value="다시 쓰기"></input>
						<input type="button" value="되돌아가기" onclick="history.back(-1)"></input>
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>