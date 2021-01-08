<?php
      include "common/lib.php";
    include "common/page.php";
   

    
    if(!empty($_GET['keyword'])){  //검색어 있을 때 
        $search = $_GET['search'];      
        $keyword = $_GET['keyword'];  
       
        if ($search == 'all') {  // 전체 검색 
           $query = "SELECT * FROM board where title LIKE '%$keyword%' or nickname LIKE '%$keyword%' or content LIKE '%$keyword%' ";                  
        } else {        
           $query = "SELECT * FROM board where $search LIKE '%$keyword%' "; 
        }      
   } else { //검색어 없을 때
        $query = "SELECT * FROM board order by idx desc limit $start, $page_num";    
        $search = ""; 
        $keyword = "";    
   }

   $result = mysqli_query($connect, $query);
?>



<form class="navbar-form" method="get" action=""> 
    <select class="custom-select" name="search" style="width:150px;float:left;">
        <option value="all" <?=($search == "all")?"selected":""?>>전체</option>        
		<option value="title" <?=($search == "title")?"selected":""?>>제목</option>
		<option value="content" <?=($search == "content")?"selected":""?>>내용</option>
        <option value="nickname" <?=($search == "nickname")?"selected":""?>>이름</option> 
    </select>
    <input type="text" name="keyword" style="width: 250px; float:left;"class="form-control" placeholder="검색 후 엔터" value="<?= $keyword ?>">
</form>


<table width=800 class="table table-hover" style="text-align: center;">
    <tr class="table-primary">
        <th style="width:70px;">NO</th>
        <th style="width:670px;">제목</th>
        <th style="width:40px;">글쓴이</th>
        <th style="width:50px;">날짜</th>   
        <th style="width:100px;">조회수</th>           
    </tr>

<?php    

 

while($data = mysqli_fetch_array($result)){
?>
    <tr>
        <td> <?=$data['idx']?></td>
        <td><a href = "detail.php?idx=<?=$data['idx']?>"><?=$data['title']?></a>&nbsp;&nbsp;<?php if($data['filename']){ echo '<i class="fas fa-file-image"></i>'; }?></td>
        <td> <?=$data['nickname']?></td>
        <td> <?=$data['writedate']?></td>
        <td> <?=$data['count']?></td>
    </tr>
<?php } ?>
</table>




<?php 
    for($i=0; $i<=$pages; $i++){
        $no = $page_num * $i;
?>
   <a href=list.php?start=<?=$no?>>[<?=$i+1?>]</a> 

<?php  
}
 ?>

<a href="write.php" class="btn btn-info" style="float:right;">글쓰기</a>

