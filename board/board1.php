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
	$sqlConn = $sqlConn->dbConnect();
?>
<html>
<head>
	<title>게시판게시판게시판게시판</title>
	<style type="text/css">
		.container {
			max-width: 1200px;
			margin: auto;
			margin-top: 30px;
		}	
		.footer {
			position: absolute;
			width: 100%;
			height: 330px;
			top: 650px;
			border: 1px solid black;
			text-align: center;
		}
		.divcol {
			background-image: url("../sidebg.jpg");
			background-size: 300%;
			border-right: 1px solid orange;
			margin-right: 20px;
			height: 100%;
		}
		.titleLink {
			color: black;
		}
		.titleLink:hover {
			color: black;
			text-decoration: none;
		}
		.boardName {
			height: 20px;
			padding:10px;
			margin-bottom: 10px;
			background-color: #999999;
			color: white;
			font-weight: bold;
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
		.page_container {
			position: absolute;
			margin-left: auto;
			margin-right: auto;
			left: 0;
			right: 0;
			top: 540px;
			text-align: center;
		}
		.board_write {
			float: right;
			height: 40px;
			text-align: right;
			vertical-align: text-bottom;
		}
		.columnAlignCenter {
			text-align: center;
		}
		.search_child {
			position: absolute;
			top: 516px;
			left: 640px;
		}
		.search_i {
			margin-left:10px;
			text-align:center;
		}
		.ad_div {
			background-color: black;
			color: white;
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
		/* If Search */
		if(isset($_GET['title'])) {
			if(!isset($_GET['board']) || $_GET['board']==0) {
				$_GET['board']=0;
				$boardArray = $sqlConn->querySearchBoard(1, 'title', $_GET['title'], NULL, NULL, NULL, NULL);
			}
			else {
				$boardArray = $sqlConn->querySearchBoard(2, 'title', $_GET['title'], 'boardNum', $_GET['board'], NULL, NULL);	
			}
		}
		/* If Not Search*/
		else {
			if(!isset($_REQUEST['board']) || $_REQUEST['board']==0) {
				$_REQUEST['board']=0;
				$_GET['board']=0;
				$boardArray = $sqlConn->querySelectBoard(0, NULL, NULL, NULL, NULL);
			}
			else {
				$boardArray = $sqlConn->querySelectBoard(1, 'boardNum', $_REQUEST['board'], NULL, NULL);
			}	
		}	 	
		$i=0;
		$length = count($boardArray);
		$pageInOneBlock = 5; //블럭에 나타낼 페이지 번호 갯수
	     	$block = ceil($pageNum/$pageInOneBlock); //현재 리스트의 블럭 구하기
	     	$pageStartInBlock = ( ($block - 1) * $pageInOneBlock ) + 1; //현재 블럭에서 시작페이지 번호
	     	$pageEndInBlock = $pageStartInBlock + $pageInOneBlock - 1; //현재 블럭에서 마지막 페이지 번호
	     	$totalCount = $length;
	     	$totalPage = ceil($totalCount/$list); //총 페이지 수
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
						<li><a href="javascript:myboardpopup();"><i class="glyphicon glyphicon-book"></i> 내 글 보기</a></li>
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
					switch($_REQUEST['board']) {
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
	  			<button class="btn btn-default board_write">글쓰기</button>
			</ul>
			<!-- BOARD PRINT START -->
			<form action="insert.php" method="POST">
				<table class="table1 table">
					<tr>
					<?php
						switch($_REQUEST['board']) {
							case 1: ?>
							<td class="boardName" colspan="15">게시판1</td><?php
	  						break;
							case 2: ?>
							<td class="boardName" colspan="15">게시판2</td><?php
	  						break;
							case 3: ?>
							<td class="boardName" colspan="15">게시판3</td><?php
	  						break;
	  						case 0: default: ?>	
	  						<td class="boardName" colspan="15">전체 게시판</td><?php
	  						break;
						}
					?>	
					</tr>
					<tr>
						<td class="col-sm-1"></td>
						<td class="col-sm-7">제목</td>
						<td class="col-sm-1">작성자</td>
						<td class="col-sm-2 columnAlignCenter">작성시간</td>
						<td class="col-sm-3">&nbsp;조회수</td>
					</tr>
					<?php
						if($length-$i>$list) {
							while($i < $list*$pageNum) {
								$commCount = count($sqlConn->querySelectComment('boardindex', $boardArray[$i][0]));
								$i_post= $boardArray[$i][0];
								$time_short = strtotime($boardArray[$i][5]);
								$time_short = date("H:i", $time_short);
								echo "<tr><td class='col-sm-1'>";
								echo $boardArray[$i][0];
								echo "</td><td class='col-sm-7'><a class='titleLink' href='read.php?param=$i_post'>";
								echo $boardArray[$i][3];
								if($commCount!=0) {
									echo "&nbsp;<b>[".$commCount."]</b>";
								}
								echo "</a></td><td class='col-sm-1'>";
								echo $boardArray[$i][1];
								echo "</td><td class='col-sm-2 columnAlignCenter'>";
								echo $time_short;
								echo "</td><td class='col-sm-3 columnAlignCenter'>";
								echo $boardArray[$i][7];
								echo "</td></tr>";
								$i++;
							}
						}
						else {
							while($i < $length) {
								$commCount = count($sqlConn->querySelectComment('boardindex', $boardArray[$i][0]));
								$i_post= $boardArray[$i][0];
								$time_short = strtotime($boardArray[$i][5]);
								$time_short = date("H:i", $time_short);
								echo "<tr><td class='col-sm-1'>";
								echo $boardArray[$i][0];
								echo "</td><td class='col-sm-7'><a class='titleLink' href='read.php?param=$i_post'>";
								echo $boardArray[$i][3];
								if($commCount!=0) {
									echo "&nbsp;<b>[".$commCount."]</b>";
								}
								echo "</a></td><td class='col-sm-1'>";
								echo $boardArray[$i][1];
								echo "</td><td class='col-sm-2 columnAlignCenter'>";
								echo $time_short;
								echo "</td><td class='col-sm-3 columnAlignCenter'>";
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
					<input type="text" name="search" class="search1" value=""/>
					<i class="glyphicon glyphicon-search search_i" type="submit"></i>
				</div>
			</div>
			<form name="form1" method="GET">
					<input type="hidden" id="title" name="title" value="">
					<input type="hidden" name="board" value=<?php echo $_GET['board']?>>		
			</form>
			<!-- PAGING START --> 
			<br><br>
			<nav class="page_container">
				<ul class="pagination">
				<?php
		     		     	if($pageEndInBlock > $totalPage) {
		          		    	$pageEndInBlock = $totalPage;
		          		}
		          		if($pageNum <= 1) { ?>
		                	<li class="disabled"><span>&laquo;</span></li><?php   
		         		}
		         		else { ?>
		               		<li><a href="board1.php?board=<?php echo $_REQUEST['board']?>"><span>&laquo;</span></a></li><?php 
		      		}
		          		if($block <=1) { ?>
		                	<li class="disabled"><span>&lt;</span></li><?php   
		      		}
		      		else { ?>
		                	<li><a href="board1.php?board=<?php echo $_REQUEST['board']?>&amp;page=<?=$pageStartInBlock-1?>"><span>&lt;</span></a></li><?php   }
		        		for($j = $pageStartInBlock; $j <=$pageEndInBlock; $j++) {
		              		if($pageNum == $j) { ?>
		               			<li class="active"><span><?php echo $j ?></span></li><?php      
		      			} 
		      			else { ?>
		               			<li><a href="board1.php?board=<?php echo $_REQUEST['board']?>&amp;page=<?=$j?>" aria-label="Previous"><span aria-hidden="true"><?=$j?></span></a></li><?php
		              		}                
		         		}
		         	 	$totalBlock = ceil($totalPage/$pageInOneBlock);
		         		if($block >= $totalBlock) { ?>
		              		<li class="disabled"><span>&gt;</span></li><?php   
			     		} 
			     		else { ?>    
		              		<li><a href="board1.php?board=<?php echo $_REQUEST['board']?>&amp;page=<?=$pageEndInBlock+1?>"><span>&gt;</span></a></li><?php   
		          		}
			     		if($pageNum >= $totalPage) { ?> 
		              	 	<li class="disabled"><span>&raquo;</span></li><?php 
		          		} 
		          		else { ?>
		              		<li><a href="board1.php?board=<?php echo $_REQUEST['board']?>&amp;page=<?=$totalPage?>"><span>&raquo;</span></a></li><?php   
		              	} 
		          	?>
		   		</ul>
			</nav>
			<!-- PAGING END -->
			<div class="footer">
				<p class="ad_div">ADVERTISEMENT</p>
				<div class="ad1">
					<a href="http://linegame.line-rangers.co.kr/" onclick="clickcr(this, 'squ.issue','78005901_0000000D5C01', '', event, 1);">
					<img src="http://img.naver.net/static/www/u/2015/0119/nmms_154842962.jpg" alt="라인레인저스 사전예약 이벤트" width="300" height="220"></a>
					<input type="hidden" id="csi" value="1"><a id="aw0" target="_blank" href="http://www.googleadservices.com/pagead/aclk?sa=L&amp;ai=Cvf_JfLe8VKOgIZKl9AXruoLQBJCfs4QG4Nup5cABhcidwgUQASC2u-IDYJuD6YScKaAB2P61zAPIAQKpAkm114ZK4g8-qAMByAPBBKoEwQFP0LAr8WWne6jII7ijzb4MS_08QAjAR_fpOa37k-mo1QuQHwAciQHY3qN9f4m2qpENYoVVfsTUfiTSxSe7w1Of1k9KnFuulON5RMES6eis0wk5RFlH-tmzLFSbMXzitu7LtVJlmwlPLv_McxpipdPh260bJyd7KphTfu4S2Wt170tCytvhWaUKPChJh6-JaYl2UQtG-NTcgEX9ZDNPySf8dLeiQUp4E_SszgZ59LpZ939Xq58nR_xrU_-1mvMvKqj-iAYBoAYCgAeQgcoz&amp;num=1&amp;cid=5GhyRV-B7uMGTw_HCsv52Mdr&amp;sig=AOD64_1YrmpFWMANVjoQ7OPgSxSQCcqcqw&amp;client=ca-pub-3326313360473532&amp;adurl=http://www.bdu.ac.kr&amp;nm=3&amp;mb=2&amp;bg=!A0RgovDX6PE7KgIAAAAkUgAAAA8qAQilHuuChSoZ3W4bq0uqHBpCk70gONX555jbdUkmoQPGuhKxcDBoTrSj8kE9eDqxKUeZvxunOcLDJJ1epK4ZurBkptV-4BcnDJY0C18zGDCeVJOlVcdN_VbUzr5a__Cy8CZTBX0cNVcbzAP7s5GSqnPThvY3n4oaANZNiJbPUA2L-_Hf4szkUkYWMmuTIrTJtxdF3LotUgU5bNtrO2NvjCOPcCRdNdIbhE0qgt6Yw5JM6hTZL7g3vXzppPxQT57JVgrhDVLI1H1vsGsuuBCgL-gtfkJa3N4Sqpiet_qpahW_541O0GTN-1SeFXed-lY8p1Brdy-RL_yaP_WhJneb0fi_i_HKeGa1K7w" data-original-click-url="http://www.googleadservices.com/pagead/aclk?sa=L&amp;ai=Cvf_JfLe8VKOgIZKl9AXruoLQBJCfs4QG4Nup5cABhcidwgUQASC2u-IDYJuD6YScKaAB2P61zAPIAQKpAkm114ZK4g8-qAMByAPBBKoEwQFP0LAr8WWne6jII7ijzb4MS_08QAjAR_fpOa37k-mo1QuQHwAciQHY3qN9f4m2qpENYoVVfsTUfiTSxSe7w1Of1k9KnFuulON5RMES6eis0wk5RFlH-tmzLFSbMXzitu7LtVJlmwlPLv_McxpipdPh260bJyd7KphTfu4S2Wt170tCytvhWaUKPChJh6-JaYl2UQtG-NTcgEX9ZDNPySf8dLeiQUp4E_SszgZ59LpZ939Xq58nR_xrU_-1mvMvKqj-iAYBoAYCgAeQgcoz&amp;num=1&amp;cid=5GhyRV-B7uMGTw_HCsv52Mdr&amp;sig=AOD64_1YrmpFWMANVjoQ7OPgSxSQCcqcqw&amp;client=ca-pub-3326313360473532&amp;adurl=http://www.bdu.ac.kr"><img src="http://pagead2.googlesyndication.com/simgad/8798789136172985400" border="0" width="336" class="img_ad"></a>
				</div>	
			</div>	
		</div>
	</div>
	<script type="text/javascript">
		function myboardpopup() {
			window.open("./myboard.php","myboard","width=1180, height=800, menubar=no, scrollbars=no, status=no, toolbar=no, resizable=no");
		}
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
		var boardWrite = document.getElementsByClassName('board_write')[0];
		boardWrite.onclick = function() {
			location.href = "write.php?req=<?php echo $_REQUEST['board']?>";
		}
		document.getElementsByClassName('search_i')[0].addEventListener("click", function(e) {search_title(0);});
		document.getElementsByClassName('search1')[0].addEventListener("keypress", function(e) {search_title(event);});

	</script>
</body>
</html>