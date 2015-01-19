<?php
session_start();
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<head>
	<title>쓰기쓰기쓰기쓰기</title>
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
	}
	.text1 {	
		max-width: 100px;
		margin: 2px;
	}
	.text2 {
		max-width: 400px;
		margin: 2px;
	}
	.text3 {
		max-width: 700px;
		margin: 2px;
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
	.img_btn {
		padding-left: 16px;
		margin-top: 10px;
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
		background-image: url("../sidebg.jpg");
		background-size: 300%;
		border-right: 1px solid orange;
		margin-right: 20px;
		height: 100%;
	}
	.dropd {
		position: absolute;
		padding: 0;
		height: 24px;
		bottom: 5px;
	}
	.select_tag {
		vertical-align: center;
		padding-top: 4px;
		top: 2px;
		max-width: 200px;
	}
	.dropd_tag {
		width:100px;
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
				<li role="presentation"><a href="board1.php?board=1">게시판1</a></li>
				<li role="presentation"><a href="board1.php?board=2">게시판2</a></li>
				<li role="presentation"><a href="board1.php?board=3">게시판3</a></li>
				<li role="presentation"><a href="board1.php">전체 게시판</a></li>
			</ul>
			<form action="write_process.php" method="POST">
				<table class="table1 table table-bordered">
					<tr>
						<td class="head" colspan="5">Write Form</td>
						
					</tr>
					<tr>
						<td class="tag">이름</td>
						<td class="select_tag	">&nbsp;<?php echo "$_SESSION[nickname]"?></td>
						<td class="dropd_tag">
							<div class="btn-group dropd">
  								<select name="board_number" class="btn btn-warning">
  									<option value="1">게시판1</option>
  									<option value="2">게시판2</option>
  									<option value="3">게시판3</option> 
  								</select>
							</div>
						</td>

					</tr>
					<tr>
						<td class="tag">비밀번호</td>
						<td class="box" colspan="4">
							<input type="password" class="text1 form-control" name="passwd"/>
						</td>
					</tr>
					<tr>
						<td class="tag">제목</td>
						<td class="box" colspan="4">
							<input type="text" class="text2 form-control" name="title"/>
						</td>
					</tr>
					<tr>
						<td class="tag">내용</td>
						<td class="box" colspan="4">
							<textarea name="content" class="text3 form-control" cols="20" rows="10"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="5" style="text-align:center">
							<button name="sbmt" class="btn btn-default" type="submit">글쓰기</button>
							<button class="btn btn-default" type="reset">지우기</button>
							<button class="btn btn-default" type="button" onclick="history.back(-1)">뒤로</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		var optselect = document.getElementsByTagName('option');
		var tapselect = document.getElementsByTagName('li');
		if(<?php echo $_REQUEST['req']?>==2){
			optselect[1].selected="selected";
			tapselect[5].className="active";
		} else if(<?php echo $_REQUEST['req']?>==3) {
			optselect[2].selected="selected";
			tapselect[6].className="active";
		} else {
			optselect[0].selected="selected";
			if(<?php echo $_REQUEST['req']?>==1){
				tapselect[4].className="active";	
			}
			else {
				tapselect[7].className="active";
			}
			
		}
	</script>
</body>
</html>