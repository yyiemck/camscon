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
		max-width: 1200px;
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
		border-radius: 8px;
	}
	.tag {
		width: 90px;
		margin: 5px;
		text-align: left;
		vertical-align: center;
	}
	.content {
		max-width: 400px;
		height: 360px;
	}
	.img_size {
		width: 125px;
		height: 125px;
	}
	.btn-group {
		display: block;
	}
	.mybtn {
		width: 100px;
	}
	.mybtn_2 {
		height:34px;
	}
	.divcol {
		border-right: 1px solid orange;
		margin-right: 20px;
		height: 550px;
	}
	.board_write {
		float: right;
		margin-left: 522px;
		height: 40px;
		text-align: right;
		vertical-align: text-bottom;
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
		<div class="col-md-2 divcol">
			<div class="img_btn">
				<img class="img_size" src="../images.jpg"></img><br>
				<div class="btn-group">
					<button type="button" class="mybtn btn btn-danger">
						<?php
						echo "$_SESSION[nickname]";	
						?>	
					</button>
					<button type="button" class="mybtn_2 btn btn-danger dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="../dblogout.php"><i class="glyphicon glyphicon-off"></i> 로그아웃</a></li>
						<li><a href="../form_modifypwd.php"><i class="glyphicon glyphicon-edit"></i> 비밀번호 변경</a></li>
						<li class="divider"></li>
						<li><a href="../form_withdraw.php"><i class="glyphicon glyphicon-trash"></i> 회원탈퇴</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-9">
		<ul class="nav nav-pills">
 			<li role="presentation"><a href="#">게시판1</a></li>
  			<li role="presentation"><a href="#">게시판2</a></li>
  			<li role="presentation"><a href="#">게시판3</a></li>
  			<button class="btn btn-default board_write" onclick=location.href="write.php">글쓰기</button>
		</ul>
		<form action="insert.php" method="POST">
			<table class="table1 table table-bordered">
				<tr>
					<td class="head" colspan="4">TITLE</td>
				</tr>
				<tr>
					<td class="tag">작성자</td>
					<td><?php echo "$_SESSION[nickname]"?></td>
				</tr>
				<tr>
				</tr>
				<tr>
					<td class="content" colspan="4">content content</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:center">
						<button class="btn btn-default" type="submit">수정</button>
						<button class="btn btn-default"type="reset">삭제</button>
						<button class="btn btn-default" type="button" onclick="history.back(-1)">뒤로</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	</div>
</body>
</html>