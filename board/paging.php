
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
  
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>    
        <?php
             //$pageNum = ($_GET['page']) ? $_GET['page'] : 1;     //page : default - 1
             //$list = ($_GET['list']) ? $_GET['list'] : 10;
             $pageNum = 1;
             $list = 10;   

             $b_pageNum_list = 5; //블럭에 나타낼 페이지 번호 갯수
             $block = ceil($pageNum/$b_pageNum_list); //현재 리스트의 블럭 구하기

             $b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1; //현재 블럭에서 시작페이지 번호
             $b_end_page = $b_start_page + $b_pageNum_list - 1; //현재 블럭에서 마지막 페이지 번호

             $TotalCount = 55;
             $total_page = ceil($TotalCount/$list); //총 페이지 수

             if($b_end_page > $total_page) {
                 $b_end_page = $total_page;
             }
             if($pageNum <= 1) { ?>
                <font size=2  color=red>처음</font>

        <?php   }
             else { ?>
                <font size=2><a href=".boardindex.php">처음</a></font>

        <?php   }
             if($block <=1) { ?>
                <font> </font>
        <?php   } 
             else { ?>
                <font size=2><a href=".boardindex.php?&amp;page= <? =$b_start_page-1 ?> &amp;list= <? =$list ?>">이전</a></font>
        <?php   }
            for($j = $b_start_page; $j <=$b_end_page; $j++) {
                if($pageNum == $j) { ?>
                    <font size=2 color=red> <?php echo $j ?></font>
        <?php      }
                else { ?>
                    <font size=2><a href="boardindex.php?&amp;page= <? =$j ?> &amp;list= <? =$list ?>"><?= $j ?></a></font>
        <?php
                }             
         
             }
             $total_block = ceil($total_page/$b_pageNum_list);
         
             if($block >= $total_block) { ?>
                <font> </font>
        <?php   }
             else { ?>    
                <font size=2><a href="boardindex.php?&amp;page= <?=$b_end_page+1 ?>&amp;list= <? =$list ?>">다음</a></font>
        <?php   }
             
             if($pageNum >= $total_page) { ?> 
                <font size=2 color=red>마지막</font>
        <?php   }
             else { ?>
                <font size=2><a href="boardindex.php?&amp;page= <? =$total_page ?> &amp;list= <? =$list ?>">마지막</a></font>
        <?php   } ?>