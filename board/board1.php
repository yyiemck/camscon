<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
session_start();
include('../dbinfo.php');
if(!isset($_SESSION['id'])){	
	echo '<script type="text/javascript">';
	echo 'alert("잘못된 접근입니다.");';
	echo 'location.replace("../index.php");';
	echo '</script>';
	return 1;
}
$sqlConn = new dbinfo();
$sqlLink = $sqlConn;
$sqlConn = $sqlConn->dbConnect();
?>
<html>
<head>
	<title>게시판게시판게시판게시판</title>
	<style type="text/css">
	form {
		margin: auto;
	}
	tr {
		margin: 20px;
	}
	.linker {
		color: black;
	}
	.linker:hover {
		color: black;
		text-decoration: none;
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
	.page_able {
		color: blue;
	}
	.page_disable {
		color: gray;
	}
	.page_now {
		color: red;
		border: 2px red solid;
	}
	.board_write {
		float: right;
		margin-left: 402px;
		height: 40px;
		text-align: right;
		vertical-align: text-bottom;
	}
	.page {
		text-align: center;
		font-size: 20px;
	}
	.search_child {
		float: right;
	}
	.search_i {
		float: right;
		margin-left:10px;
		text-align:center;
	}
	</style>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../../package/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
	<?php
		if(isset($_GET['page'])) {
			$pageNum = $_GET['page'];     //page : default - 1
			$list = 10;  
	     	}
	   	else {
		   	$pageNum = 1;
		  	$list = 10;  
		}
		if(isset($_GET['title'])){
				if(!isset($_GET['board']) || $_GET['board']==0) {
					$_GET['board']=0;
					$boardArray = $sqlLink->querySearchBoard1('title', $_GET['title']);
				}
				else {
					$boardArray = $sqlLink->querySearchBoard2('title', $_GET['title'], 'boardNum', $_GET['board']);	
				}
		}
		else {
			if(!isset($_REQUEST['board']) || $_REQUEST['board']==0) {
				$_REQUEST['board']=0;
				$_GET['board']=0;
				$boardArray = $sqlLink->querySelectBoardAll();
			}
			else {
				$boardArray = $sqlLink->querySelectBoard('boardNum', $_REQUEST['board']);
			}	
		}	 	
		$i=0;
		$length = count($boardArray);
		$b_pageNum_list = 5; //블럭에 나타낼 페이지 번호 갯수
	     	$block = ceil($pageNum/$b_pageNum_list); //현재 리스트의 블럭 구하기
	     	$b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1; //현재 블럭에서 시작페이지 번호
	     	$b_end_page = $b_start_page + $b_pageNum_list - 1; //현재 블럭에서 마지막 페이지 번호
	     	$TotalCount = $length;
	     	$total_page = ceil($TotalCount/$list); //총 페이지 수
		$i = ($pageNum-1) * $list;
	?>
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
			<?php
				switch($_REQUEST['board']){
					case 1: ?>
						<li role="presentation" class="active"><a href="board1.php?board=1">게시판1</a></li>
  						<li role="presentation"><a href="board1.php?board=2">게시판2</a></li>
  						<li role="presentation"><a href="board1.php?board=3">게시판3</a></li>
  						<li role="presentation"><a href="board1.php?board=0">전체 게시판</a></li><?php
  						break;
					case 2: ?>
						<li role="presentation"><a href="board1.php?board=1">게시판1</a></li>
  						<li role="presentation" class="active"><a href="board1.php?board=2">게시판2</a></li>
  						<li role="presentation"><a href="board1.php?board=3">게시판3</a></li>
  						<li role="presentation"><a href="board1.php?board=0">전체 게시판</a></li><?php
  						break;
					case 3: ?>
						<li role="presentation"><a href="board1.php?board=1">게시판1</a></li>
  						<li role="presentation"><a href="board1.php?board=2">게시판2</a></li>
  						<li role="presentation" class="active"><a href="board1.php?board=3">게시판3</a></li>
  						<li role="presentation"><a href="board1.php?board=0">전체 게시판</a></li><?php
  						break;
  					case 0: default: ?>	
  						<li role="presentation"><a href="board1.php?board=1">게시판1</a></li>
  						<li role="presentation"><a href="board1.php?board=2">게시판2</a></li>
  						<li role="presentation"><a href="board1.php?board=3">게시판3</a></li>
  						<li role="presentation" class="active"><a href="board1.php?board=0">전체 게시판</a></li><?php
  						break;
				}
			?>
  			<button class="btn btn-default board_write" onclick=location.href="write.php?req=<?php echo $_REQUEST['board']?>">글쓰기</button>
		</ul>
		<!-- BOARD PRINT START -->
		<form action="insert.php" method="POST">
			<table class="table1 table">
				<tr>
					<?php
					switch($_REQUEST['board']){
					case 1: ?>
						<td class="head" colspan="15">게시판1</td><?php
  						break;
					case 2: ?>
						<td class="head" colspan="15">게시판2</td><?php
  						break;
					case 3: ?>
						<td class="head" colspan="15">게시판3</td><?php
  						break;
  					case 0: default: ?>	
  						<td class="head" colspan="15">전체 게시판</td><?php
  						break;
					}
					?>	
				</tr>
				<tr>
					<td class="col-sm-1">#</td>
					<td class="col-sm-7">제목</td>
					<td class="col-sm-1">작성자</td>
					<td class="col-sm-2">작성시간</td>
					<td class="col-sm-3">조회수</td>
				</tr>
				<?php
					if($length-$i>$list){
						while($i < $list*$pageNum){
							$commCount = count($sqlLink->querySelectComment('boardindex', $boardArray[$i][0]));
							$i_post= $boardArray[$i][0];
							$time_short = strtotime($boardArray[$i][5]);
							$time_short = date("H:i", $time_short);
							echo "<tr><td class='col-sm-1'>";
							echo $boardArray[$i][0];
							echo "</td><td class='col-sm-7'><a class='linker' href='read.php?param=$i_post'>";
							echo $boardArray[$i][3];
							if($commCount!=0) {
								echo "&nbsp;<b>[".$commCount."]</b>";
							}
							echo "</a></td><td class='col-sm-1'>";
							echo $boardArray[$i][1];
							echo "</td><td class='col-sm-2'>";
							echo $time_short;
							echo "</td><td class='col-sm-3'>";
							echo $boardArray[$i][7];
							echo "</td></tr>";
							$i++;
						}
					}
					else {
						while($i < $length){
							$commCount = count($sqlLink->querySelectComment('boardindex', $boardArray[$i][0]));
							$i_post= $boardArray[$i][0];
							$time_short = strtotime($boardArray[$i][5]);
							$time_short = date("H:i", $time_short);
							echo "<tr><td class='col-sm-1'>";
							echo $boardArray[$i][0];
							echo "</td><td class='col-sm-7'><a class='linker' href='read.php?param=$i_post'>";
							echo $boardArray[$i][3];
							if($commCount!=0) {
								echo "&nbsp;<b>[".$commCount."]</b>";
							}
							echo "</a></td><td class='col-sm-1'>";
							echo $boardArray[$i][1];
							echo "</td><td class='col-sm-2'>";
							echo $time_short;
							echo "</td><td class='col-sm-3'>";
							echo $boardArray[$i][7];
							echo "</td></tr>";
							$i++;
						}
					}				
					?>
			</table>
		</form>
		<!-- BOARD PRINT END -->
		<div class="search">
			<?php
			if(isset($_GET['title'])){?>
			<span>현재 검색 단어 : <?php echo isset($_GET['title'])?$_GET['title']:NULL; ?></span>
			<?php }?>
			<div class="search_child">
				<input type="text" name="search" class="search1" value="" onkeypress="search_title(event)"/>
				<i class="glyphicon glyphicon-search search_i" type="submit" onclick="search_title(0)"></i>
			</div>
		</div>
		<form name="form1" method="GET">
				<input type="hidden" id="title" name="title" value="">
				<input type="hidden" name="board" value=<?php echo $_GET['board']?>>		
		</form>
		<!-- PAGING START --> 
		<div class="page">
			<?php
	         	
	          	if($b_end_page > $total_page) {
	              	$b_end_page = $total_page;
	          	}
	          	if($pageNum <= 1) { ?>
	                <span class="page_disable">&lt;&lt;</span>
	         	<?php   
	         	} else { ?>
	                <span class="page_disable"><a href="board1.php?board=<?php echo $_REQUEST['board']?>">&lt;&lt;</a></span>
	          <?php 
	      	}
	          	if($block <=1) { ?>
	                <span class="page_disable">&lt;</span>
	          <?php   
	      	} else { ?>
	                <span class="page_disable"><a href="board1.php?board=<?php echo $_REQUEST['board']?>&amp;page=<?=$b_start_page-1?>">&lt;</a></span>
	          <?php   }
	        	for($j = $b_start_page; $j <=$b_end_page; $j++) {
	              	if($pageNum == $j) { ?>
	               		<span class="page_now"><?php echo $j ?></span>
	          <?php      
	      	} else { ?>
	               	<span class="page_able"><a href="board1.php?board=<?php echo $_REQUEST['board']?>&amp;page=<?=$j?>"><?=$j?></a></span>
	          <?php
	              	}                
	         	}
	          	$total_block = ceil($total_page/$b_pageNum_list);
	         	if($block >= $total_block) { ?>
	              	<span class="page_disable">&gt;</span>
	       	<?php   
		     	} else { ?>    
	              	<span class="page_disable"><a href="board1.php?board=<?php echo $_REQUEST['board']?>&amp;page=<?=$b_end_page+1?>">&gt;</a></span>
	          	<?php   
	          	}
		     	if($pageNum >= $total_page) { ?> 
	              	 <span class="page_disable">&gt;&gt;</span>
	          	<?php 
	          	} else { ?>
	              	<span class="page_disable"><a href="board1.php?board=<?php echo $_REQUEST['board']?>&amp;page=<?=$total_page?>">&gt;&gt;</a></span>
	          <?php   } ?>
	    </div>
	    <!-- PAGING END -->
	</div>
	</div>
	<script type="text/javascript">
		function search_title(e) {
			if(e==0 || e.keyCode ==13){
			var search = document.getElementsByClassName('search1')[0].value;
			if(document.getElementsByClassName('search1')[0].value=="") {
				alert('검색어를 입력해주세요.');
				return;
			}
			else { 
				document.getElementById('title').value = search;
				document.form1.submit();
			}
		}	
	}
	</script>
</body>
</html>