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
	table {
		margin: auto;
		width: 580px;
		border: 1px solid gray;
		cellpadding: 10px;
		border-spacing: 10px;;
	}
	.container {
		max-width: 1200px;
		margin: auto;
		margin-top: 100px;
	}
	.head {
		height: 20px;
		padding:10px;
		text-align: center;
		background-color: #999999;
		color: white;
		font-weight: bold;
	}
	.tag {
		width: 90px;
		text-align: left;
	}
	.box {
		width: ;
	}
	</style>
</head>
<body>
	<div class="container">
		<form action="insert.php" method="POST">
			<table>
				<tr>
					<td class="head" colspan="10">Write Form</td>
				</tr>
				<tr>
					<td class="tag">이름</td>
					<td><?php echo "$_SESSION[nickname]"?></td>
				</tr>
				<tr>
					<td class="tag">비밀번호</td>
					<td class="box">
						<input type="password" name="passwd"/>
					</td>
				</tr>
				<tr>
					<td class="tag">제목</td>
					<td class="box">
						<input type="text" name="title"/>
					</td>
				</tr>
				<tr>
					<td class="tag">내용</td>
					<td class="box">
						<textarea name="content" cols="65" rows="15"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="10" style="text-align:center">
						<input type="submit" value="글쓰기"></input>
						<input type="reset" value="다시 쓰기"></input>
						<input type="button" value="되돌아가기" onclick="history.back(-1)"></input>
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>