<!-- 페이징 그리기 -->
<table>
    <tr>
        <td height="30" align="center" valign="middle" colspan="50" style="border:1px #CCCCCC solid;">
<?php
    $pageNum = ($_GET['page']) ? $_GET['page'] : 1;     //page : default - 1
    $list = ($_GET['list']) ? $_GET['list'] : 10; //page : default - 10
 
 
    $b_pageNum_list = 5; //블럭에 나타낼 페이지 번호 갯수
    $block = ceil($pageNum/$b_pageNum_list); //현재 리스트의 블럭 구하기
     
 
    $b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1; //현재 블럭에서 시작페이지 번호
    $b_end_page = $b_start_page + $b_pageNum_list - 1; //현재 블럭에서 마지막 페이지 번호
 
    $total_page =  ceil($buyTotalCount/$list); //총 페이지 수
 
    if ($b_end_page > $total_page) 
        $b_end_page = $total_page;
     
 
    if($pageNum <= 1){?>
        <font size=2  color=red>&lt;&lt;</font>
        <?}else{?>
            <font size=2><a href="/yw/buypaging.php?year=<?=$year?>&month=<?=$month?>&day=<?=$day?>&page=&list=<?=$list?>">&lt;&lt;</a></font>
        <?}
 
 
 
    if($block <=1){?>
        <font> </font>
    <?}else{?>
        <font size=2><a href="/yw/buypaging.php?year=<?=$year?>&month=<?=$month?>&day=<?=$day?>&page=<?=$b_start_page-1?>&list=<?=$list?>">&lt;</a></font>
    <?}
 
         
 
 
 
    for($j = $b_start_page; $j <=$b_end_page; $j++)
    {
 
        if($pageNum == $j)
        {?>
            <font size=2 color=red><?=$j?></font>
        <?}
        else{?>
            <font size=2><a href="/yw/buypaging.php?year=<?=$year?>&month=<?=$month?>&day=<?=$day?>&page=<?=$j?>&list=<?=$list?>"><?=$j?></a></font>
            <?
          }             
 
    }
 
 
 
    $total_block = ceil($total_page/$b_pageNum_list);
 
    if($block >= $total_block){?>
    <font> </font>
    <?}else{?>    
        <font size=2><a href="/yw/buypaging.php?year=<?=$year?>&month=<?=$month?>&day=<?=$day?>&page=<?=$b_end_page+1?>&list=<?=$list?>">&gt;</a></font>
    <?}
 
 
 
    if($pageNum >= $total_page){?>
 
            <font size=2 color=red>&gt;&gt;</font>
         
        <?}else{?>
            <font size=2><a href="/yw/buypaging.php?year=<?=$year?>&month=<?=$month?>&day=<?=$day?>&page=<?=$total_page?>&list=<?=$list?>">마지막</a></font>
 
        <?}
    ?>
    </td>
 
    </tr>
</table>