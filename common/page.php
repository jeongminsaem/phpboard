<?php

$page_num = 5; //한페이지에 보여질 목록
$block_num = 5; //보여질 블럭 수 



//첫페이지 

 if(isset($_GET['start'])){
     $start = $_GET['start'];
 }else{
     $start = 0;
    }

//$page = ($_GET['page'])?$_GET['page']:1;


$query = "select count(*) as total from board "; 
$result = mysqli_query($connect, $query);
$tmp = mysqli_fetch_array($result);
$total = $tmp['total'];



$pages = $total / $page_num; 
?>