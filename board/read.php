<?php
session_start();
include('../dbinfo.php');
$sqlConn = new dbinfo();
$sqlLink = $sqlConn;
$sqlConn = $sqlConn->dbConnect();
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
		margin-left: 402px;
		height: 40px;
		text-align: right;
		vertical-align: text-bottom;
	}
	.comm_write {
		vertical-align: center;	
		border-top: 2px solid black;
		border-bottom: 2px solid black;
	}
	.transp {
		float: right;
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
		<?php
			$boardArray = $sqlLink->querySelectBoard('index', $_REQUEST['param']);
			$boardArray[0][7]++; // increase hit count
		?>
		<div class="col-md-9">
		<!-- Board Tab Layout Start -->
		<ul class="nav nav-pills">
			<?php
			$boardTag = $boardArray[0][8];
			?>
  			<li class="liclass" role="presentation"><a href="board1.php?board=1">게시판1</a></li>
  			<li class="liclass" role="presentation"><a href="board1.php?board=2">게시판2</a></li>
  			<li class="liclass" role="presentation"><a href="board1.php?board=3">게시판3</a></li>
  			<li class="liclass" role="presentation"><a href="board1.php?board=0">전체 게시판</a></li>
  			<button class="btn btn-default board_write" onclick=location.href="write.php?req=<?php echo $boardArray[0][8]?>">글쓰기</button>
		</ul>
		<!-- Board Tab Layout End -->
			<table class="table1 table table-bordered">
				<!-- READ part HEAD Start -->
				<tr>
					<td class="head" colspan="4"><?php echo $boardArray[0][3]?></td>
				</tr>
				<tr>
					<td class="tag">작성자</td>
					<td><?php echo $boardArray[0][1]?></td>
					<td class="tag">조회수</td>
					<td><?php echo $boardArray[0][7]?></td>
				</tr>
				<tr>
					<td class="tag">작성 시간</td>
					<td><?php echo $boardArray[0][5]?></td>
					<td class="tag">수정 시간</td>
					<td><?php echo $boardArray[0][6]?></td>
				</tr>
				<!-- READ part HEAD END -->
				<tr>
					<td class="content" colspan="4"><?php echo $boardArray[0][4]?></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:center">
						<button class="btn btn-default" type="button" data-toggle="modal" data-target=".bs-example-modal-sm2">수정</button>
						<button class="btn btn-default"type="button" data-toggle="modal" data-target=".bs-example-modal-sm">삭제</button>
						<button class="btn btn-default" type="button" onclick="history.back(-1)">뒤로</button>
					</td>
				</tr>
				<?php
					$commArray = $sqlLink->querySelectComment('boardindex',$boardArray[0][8]);
					$commCount = count($commArray);
					$a=0;
					while($a < $commCount){
						echo "<tr><td>";
						echo $commArray[$a][1];
						echo "</td><td colspan='3'>";
						echo $commArray[$a][2];
						echo "</td></tr>";
						$a++;
					}
				?>
				<!-- READ part Comment Start -->
				<tr class="comm_write">
					<td><?php echo $_SESSION['nickname']?></td>
					<td colspan="3">
						<form method="POST" action="./comment.php"><textarea cols="78" rows="4" style="font-size:14px" name="content"></textarea><button class="transp">전송</button>
							<input type="hidden" name="boardindex" value=<?php echo $boardArray[0][8]?>>
						</form>
					</td>
				</tr>
				</div>
			</table>
		

		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
 			<div class="modal-dialog modal-sm">
    				<div class="modal-content">
      				<div class="modal-header">
         					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    						<h4 class="modal-title" id="exampleModalLabel">삭제</h4>
    					</div>
    					<div class="modal-body">
    						<form>
    							<div class="form-group">
            						<label for="message-text" class="control-label">Password:</label>
            						<input type="password" class="form-control" value="" id="message-text"/>
          						</div>
        					</form>  
      				</div>
      				<div class="modal-footer">
        				     <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
        					<button type="button" class="btn btn-primary" id="check" onclick="check_submit('<?=$boardArray[0][2]?>');">확인</button>
      				</div>
    				</div>
  			</div>
		</div>
		<div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
 			<div class="modal-dialog modal-sm">
    				<div class="modal-content">
      				<div class="modal-header">
         					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    						<h4 class="modal-title" id="exampleModalLabel">수정</h4>
    					</div>
    					<div class="modal-body">
    						<form>
    							<div class="form-group">
            						<label for="message-text" class="control-label">Password:</label>
            						<input type="password" class="form-control2" value="" id="message-text"/>
          						</div>
        					</form>  
      				</div>
      				<div class="modal-footer">
        				     <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
        					<button type="button" class="btn btn-primary" id="check" onclick="check_modify()">확인</button>
      				</div>
    				</div>
  			</div>
		</div>
	</div>
	</div>
	<?php
		$sqlLink->queryUpdateBoard('hit', $boardArray[0][7], 'index', $boardArray[0][0]);
	?>
	<form name="form1" method="POST" action="./delete.php">
		<input type="hidden" name="ind" value=<?php echo $boardArray[0][0]?>>
		<input type="hidden" name="val" value=<?php echo $boardArray[0][2]?>>
	</form>
	<form name="form2" method="POST" action="./modify.php?req=<?php echo $boardArray[0][8]?>">
		<input type="hidden" name="ind" value=<?php echo $boardArray[0][0]?>>
		<input type="hidden" name="val" value=<?php echo $boardArray[0][2]?>>
	</form> 	
	<script type="text/javascript">
		var boardTag = <?php echo $boardTag?>;
		var liclass = document.getElementsByClassName('liclass');
		liclass[boardTag-1].className="liclass active";

		function check_submit(pass) {
			if (document.getElementsByClassName('form-control')[0].value =="") {
				alert('비밀번호를 입력해야 글을 삭제할 수 있습니다.');
				return;
			} 
			else {
				var checkv = document.getElementsByClassName('form-control')[0].value;
				if(checkv=="<?php echo $boardArray[0][2]?>"){
					document.form1.submit();
				} else {
					alert('비밀번호가 잘못되었습니다.');
				}			
			}
		}
		function check_modify(pass) {
			if (document.getElementsByClassName('form-control2')[0].value =="") {
				alert('비밀번호를 입력해야 글을 수정할 수 있습니다.');
				return;
			} 
			else {
				var checkv = document.getElementsByClassName('form-control2')[0].value;
				if(checkv=="<?php echo $boardArray[0][2]?>"){
					document.form2.submit();
				} else {
					alert('비밀번호가 잘못되었습니다.');
				}			
			}
		}
	</script>
</body>
</html>