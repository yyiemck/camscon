<?php
	session_start();
	include('../dbinfo.php');
	$sqlConn = new dbinfo();
	$sqlConn = $sqlConn->dbConnect();
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<head>
	<title>내 글 보기</title>
	<style type="text/css">
		form {
			margin: auto;
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
		.content {
			max-width: 400px;
			min-height: 400px;
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
		.content_container {
			margin-top: 0;
			padding: 0 10px 10px 10px;
			overflow: auto;
			border: 0;
		}
		.button_container {
			margin: auto;
			margin-bottom: 10px;
			text-align: center;
			padding: 5px;
		}
		.comment_container {
			min-height: 60px;
			overflow: auto;
			border: 1px solid #DDD;
		}
		.comment_writer {
			padding: 0 5px 0 10px;
			margin-top: 10px;
			font-weight: bold;
		}
		.comment_content {
			word-wrap:break-word;word-break:break-all;
			overflow:hidden;
			overflow:scroll; 
			overflow:auto; 
			max-width: 410px;
		}
		.comment_time {
			padding-right: 0;
			text-align: center;
			margin-top: 5px;
			height:60px;
		}
		.comment_button {
			display: inline-block;
			margin-top: 5px;
			padding-left: 45px;
			text-align: center;
		}
		.comm_write {
			padding-top: 5px;
			border-top: 2px solid black;
			border-bottom: 2px solid black;
			vertical-align: middle;
			margin-bottom: 20px;
		}
		.comm_ta {
			background-color: #F5F5F5;
		}
		.comm_write_writer {
			display: inline-block;
			vertical-align: top;
			padding-left: 5px;
			margin-top: 30px;
			width: 60px;
		}
		.comm_write_content {
			display: inline-block;
		}
		.comm_write_button {
			display: inline-block;
			width: 100px;
			vertical-align: top;
			text-align: center;
			margin-top: 30px;
		}
		.MCLabel {
			vertical-align: top;
			padding-left: 5px;
			margin-top: 30px;
			width: 60px;	
		}
	</style>
	<link href="../../package/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../../package/bootstrap/js/bootstrap.min.js"></script>
	<div class="container">
	<!-- hasParam (normal access), hitCount test START-->
	<?php
		if(!isset($_REQUEST['param'])) {
			echo "<script>";
			echo "history.back(-1)";
			echo "</script>";
		}
		$boardArray = $sqlConn->querySelectBoard(1, 'index', $_REQUEST['param'], NULL, NULL);
		if($boardArray[0][1] != $_SESSION['nickname']) {
			$boardArray[0][7]++; // increase hit count
		}
	?>
	<!-- hasParam (normal access), hitCount test END-->
		<!-- Board Tab Layout Start -->
		<ul class="nav nav-pills">
		<?php
			$boardTag = $boardArray[0][8];
		?>
			<li class="liclass" role="presentation"><a href="myboard.php?board=1">게시판1</a></li>
			<li class="liclass" role="presentation"><a href="myboard.php?board=2">게시판2</a></li>
			<li class="liclass" role="presentation"><a href="myboard.php?board=3">게시판3</a></li>
			<li class="liclass" role="presentation"><a href="myboard.php?board=0">전체 게시판</a></li>
		</ul>
		<!-- Board Tab Layout End -->
		<table class="table table-bordered">
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
		</table>
		<!-- READ part HEAD END -->
		<div class="content_container">
			<p class="content">
			<?php 
				echo "<script type='text/javascript'>";
				$boardArray[0][4] = str_replace("\r\n", "<br/>",htmlspecialchars_decode($boardArray[0][4]));
				echo "</script>";
				echo $boardArray[0][4]
			?>
			</p>
		</div>
		<div class="button_container">
			<button class="btn btn-default" type="button" data-toggle="modal" data-target=".bs-example-modal-sm2">수정</button>
			<button class="btn btn-default"type="button" data-toggle="modal" data-target=".bs-example-modal-sm">삭제</button>
			<button class="btn btn-default toBoard" type="button">뒤로</button>
		</div>
		<!-- Comment Print Form START -->
		<?php
			$commArray = $sqlConn->querySelectComment('boardindex',$boardArray[0][0]);
			$commCount = count($commArray);
			$a=0;
			while($a < $commCount) {
				echo "<div class='comment_container'><div class='comment_writer col-sm-2'>";
				echo nl2br($commArray[$a][1]);
				echo "</div><div class='comment_content col-sm-9'>";
				echo nl2br($commArray[$a][2]);
				echo "</div><div class='comment_time col-sm-2'>";
				echo $commArray[$a][4];
				echo "</div><div class='comment_button col-sm-2'>";
				echo "<button class='mod' name='".$commArray[$a][0]."' value='".$commArray[$a][2]."' data-toggle='modal' data-target='.bs-example-modal-lg'>수정</button><br><button class='del' name='".$commArray[$a][0]."'>삭제</button>";
				echo "</div></div>";
				$a++;
			}
		?>
		<!-- Comment Print Form END -->
		<!-- Comment Write Form START -->
		<div class="comm_write">
			<div class="comm_write_writer"><?php echo $_SESSION['nickname']?></div>
			<div style="display:inline-block">
				<form name="form4" method="POST" action="./comment.php">
					<div class="comm_write_content"><textarea class="form-control cwcarea" cols="74" rows="4" style="font-size:14px" name="content_c"></textarea></div>
					<div class="comm_write_button"><button class="transp">전송</button></div>
					<input type="hidden" name="boardindex" value=<?php echo $boardArray[0][0]?>>
					<input type="hidden" name="myread" value=1>
				</form>
			</div>
		</div>
		<!-- Comment Write Form END -->
		<!-- DELETE Modal START -->
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">삭제</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="message-text" class="control-label">Password:</label>
							<input type="password" class="form-control" value="" id="message-text"/>
						</div>		
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
						<button type="submit" class="btn btn-primary check1" id="check">확인</button>
					</div>
				</div>
			</div>
		</div>
		<!-- DELETE Modal END -->
		<!-- MODIFY Modal START -->
		<div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">수정</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="message-text" class="control-label">Password:</label>
							<input type="password" class="form-control2" value="" id="message-text"/>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
						<button type="button" class="btn btn-primary check1" id="check">확인</button>
					</div>
				</div>
			</div>
		</div>
		<!-- MODIFY Modal END -->
		<!-- MODIFY Comment Modal START -->
		<div class="modal fade bs-example-modal-lg" id="cm_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">댓글 수정</h4>
					</div>
					<div class="modal-body">
						<form name="form5" method="POST" action="comment_modify_process.php">
							<div class="form-group">
								<label for="message-text" class="control-label MCLabel"><?php echo $_SESSION['nickname']?>&nbsp;</label>
								<textarea id="comment_mod" name="comment_mod_ta" cols="94" rows="4"></textarea>
								<input type="hidden" id="modCommCheck" name="modChecker" value=""/>
							</div>
						</form> 
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
						<button type="button" class="btn btn-primary" id="modCommSubmit">확인</button>
					</div>
				</div>
			</div>
		</div>
  		<!-- MODIFY Comment Modal END -->
	</div>
	<!-- UPDATE Hit count increased START -->
	<?php
		$sqlConn->queryUpdateBoard('hit', $boardArray[0][7], 'index', $boardArray[0][0]);
	?>
	<!-- UPDATE Hit count increased END-->
	<!-- Abstract FORM to communicate START -->
	<form name="form1" method="POST" action="./delete.php">
		<input type="hidden" name="ind" value=<?php echo $boardArray[0][0]?>>
		<input type="hidden" name="val" value=<?php echo $boardArray[0][2]?>>
	</form>
	<form name="form2" method="POST" action="./modify.php?req=<?php echo $boardArray[0][8]?>">
		<input type="hidden" name="ind" value=<?php echo $boardArray[0][0]?>>
		<input type="hidden" name="val" value=<?php echo $boardArray[0][2]?>>
		<input type="hidden" name="myread">
	</form> 
	<form name="form3" method="POST" action="./comment_delete.php">
		<input type="hidden" id="ind3" name="ind" value=""></input>
	</form>
	<!-- Abstract FORM to communicate END -->
	<script type="text/javascript">
		var i=0;
		// decide Tab activities START
		var boardTag = <?php echo $boardTag?>;
		var liclass = document.getElementsByClassName('liclass');
		liclass[boardTag-1].className="liclass active";
		// decide Tab activities END
		function check_submit(pass) {
			if (document.getElementsByClassName('form-control')[1].value =="") {
				alert('비밀번호를 입력해야 글을 삭제할 수 있습니다.');
				return;
			} 
			else {
				var checkv = document.getElementsByClassName('form-control')[1].value;
				if(checkv=="<?php echo $boardArray[0][2]?>") {
					document.form1.submit();
				} else {
					alert('비밀번호가 잘못되었습니다.');
				}			
			}
		}
		function check_modify(pass) {
			if (document.getElementsByClassName('form-control2')[0].value=="") {
				alert('비밀번호를 입력해야 글을 수정할 수 있습니다.');
				return;
			} 
			else {
				var checkv = document.getElementsByClassName('form-control2')[0].value;
				if(checkv=="<?php echo $boardArray[0][2]?>") {
					document.form2.submit();
				} else {
					alert('비밀번호가 잘못되었습니다.');
				}			
			}
		}
		// Comment DELETION START
		var del = document.getElementsByClassName('del');
		for(i=0; i<<?php echo $commCount ?>; i++) {
			(function() {	
				var val = del[i].name;
				del[i].onclick = function(event) {
					if (confirm("정말 삭제하시겠습니까??") == true) { 
						var ind = document.getElementById('ind3');         
						ind.setAttribute("value", val); 
						var del_c = document.form3;
						del_c.submit();
					}
					else {
						return;
					}
				};
			})();
		}
		// Comment DELETION END
		// Comment MODIFICATION Nickname Check START
		var mod = document.getElementsByClassName('mod');
		for(i=0; i<<?php echo $commCount ?>; i++) {
			(function() {
				var val2 = mod[i].name;
				var cont2 = mod[i].value;
				var formdata = {
					commIndex: val2,
					is_ajax: 1
				};
				mod[i].onclick = function(event) {
					$.ajax({
						type: "POST",
						url: "comment_modify_popup.php",
						data: formdata,
						success: function(response) {
							if (response == 'success') {
								$("#comment_mod").val(cont2);
								$("#modCommCheck").val(val2);
							}
							else {
								alert('권한이 없습니다.');
								$("#cm_modal").modal('toggle');
							}
						}
					});
				};
			})();	
		}
		// Comment MODIFICATION Nickname Check END
		var modSubmit = document.getElementById('modCommSubmit');
		(function () {
			modSubmit.onclick = function(event) {
				document.form5.submit();
			};
		})();	
		// ----------Enable ENTER KEY in Modal. START
		function search_title(d, e) {
			if(d==0 && e.keyCode == 13) {
				check_submit(e);
			} else if(d==1 && e.keyCode == 13) {
				check_modify(e);
			}		
		}
		// ------------Enable ENTER KEY in Modal. END

		// EVENT LISTENERS
		document.getElementsByClassName('toBoard')[0].addEventListener("click", function() {history.back(-1);});
		document.getElementsByClassName('check1')[0].addEventListener("click", function(p) {check_submit();});
		document.getElementsByClassName('check1')[1].addEventListener("click", function(p) {check_modify();});
		document.getElementsByClassName('form-control')[1].addEventListener("keypress", function(d,e) {search_title(0, event);});
		document.getElementsByClassName('form-control2')[0].addEventListener("keypress", function(d,e) {search_title(1, event);});
	</script>
</body>
</html>