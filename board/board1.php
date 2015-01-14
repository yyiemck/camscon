<?php
session_start();
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<head>
	<title>BOARD</title>
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
	.page {
		font-size:20px;
		text-align:center;
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
	 			<li role="presentation" class="active"><a href="board1.php">게시판1</a></li>
	  			<li role="presentation"><a href="board2.php">게시판2</a></li>
	  			<li role="presentation"><a href="board3.php">게시판3</a></li>
	  			<button class="btn btn-default board_write" onclick=location.href="write.php">글쓰기</button>
			</ul>
			<form action="insert.php" method="POST">
				<table class="table1 table">
					<tr>
						<td class="head" colspan="15">게시판1</td>
					</tr>
					<tr>
						<td class="col-sm-1">#</td>
						<td class="col-sm-7">제목</td>
						<td class="col-sm-1">작성자</td>
						<td class="col-sm-2">작성시간</td>
						<td class="col-sm-3">조회수</td>
					</tr>
					<tr>
						<td class="col-sm-1">1</td>
						<td class="col-sm-7">aaaaaaaaaaa</td>
						<td class="col-sm-1">heyhey</td>
						<td class="col-sm-2">19:05</td>
						<td class="col-sm-3">17</td>
					</tr>
					<tr>
						<td class="col-sm-1">2</td>
						<td class="col-sm-7">aasdfdasfaaaaaaaaaa</td>
						<td class="col-sm-1">heyheydasdfdd</td>
						<td class="col-sm-2">19:07</td>
						<td class="col-sm-3">12</td>
					</tr>
				</table>
			</form>
			<div class="page">
				<?php
			   if(isset($_GET['page']) &&isset($_GET['list'])) {
	             $pageNum = ($_GET['page']);     //page : default - 1
	             $list = 10;
	         	   }
	         	   else {
	         	   	$pageNum = 1;
	              $list = 10;  
	         	   }
	          

	             $b_pageNum_list = 5; //블럭에 나타낼 페이지 번호 갯수
	             $block = ceil($pageNum/$b_pageNum_list); //현재 리스트의 블럭 구하기

	             $b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1; //현재 블럭에서 시작페이지 번호
	             $b_end_page = $b_start_page + $b_pageNum_list - 1; //현재 블럭에서 마지막 페이지 번호

	             $TotalCount = 75;
	             $total_page = ceil($TotalCount/$list); //총 페이지 수

	             if($b_end_page > $total_page) {
	                 $b_end_page = $total_page;
	             }
	             if($pageNum <= 1) { ?>
	                <font color=grey>&lt;&lt;</font>

	          <?php   }
	             else { ?>
	                <font color=grey><a href="board1.php">&lt;&lt;</a></font>

	          <?php   }
	             if($block <=1) { ?>
	                <font color=grey>&lt;</font>
	          <?php   } 
	             else { ?>
	                <font color=grey><a href="board1.php?&amp;page=<?=$b_start_page-1?>&amp;list=<?=$list?>">&lt;</a></font>
	          <?php   }
	            for($j = $b_start_page; $j <=$b_end_page; $j++) {
	                if($pageNum == $j) { ?>
	                    <font color=red>   <?php echo $j ?></font>
	          <?php      }
	                else { ?>
	                    <font color=blue><a href="board1.php?&amp;page=<?=$j?>&amp;list=<?=$list?>"><?=$j?></a></font>
	          <?php
	                }             
	         
	             }
	             $total_block = ceil($total_page/$b_pageNum_list);
	         
	             if($block >= $total_block) { ?>
	                <font color=grey>&gt;</font>
	          <?php   }
	             else { ?>    
	                <font color=grey><a href="board1.php?&amp;page=<?=$b_end_page+1?>&amp;list=<?=$list?>">&gt;</a></font>
	          <?php   }
	             
	             if($pageNum >= $total_page) { ?> 
	                <font color=grey>&gt;&gt;</font>
	          <?php   }
	             else { ?>
	                <font color=grey><a href="board1.php?&amp;page=<?=$total_page?> &amp;list=<?=$list?>">&gt;&gt;</a></font>
	          <?php   } ?>
	    </div>
		</div>
	</div>
</body>
</html>