<?php

include "common/lib.php";

    $idx = $_GET['idx'];
    $idx = mysqli_real_escape_string($connect, $idx);
    // 내용 조회 
    $query = "select * from board where idx='$idx'";
    $result = mysqli_query($connect, $query); 
    $detail = mysqli_fetch_array($result);

    //조회수 
    $sql = "update board set count = count + 1 where idx='$idx'"; 
    $result = mysqli_query($connect, $sql); 

    
?>

<table width=800 class="table table">

    <tr class="table-active">
        <th style="width:100px;">이름</th>
        <td><?=$detail['nickname']?></td>
    </tr>
    <tr>
        <th>제목</th>
        <td><?=$detail['title']?></td>
    </tr>
    <tr>
        <th style="height: 300px;">내용</th>
        <td><?=$detail['content']?></td>
    </tr>
    <tr>
        <th>다운로드</th>
        <td><a href="download.php?idx=<?=$detail['idx']?>"><?=$detail['filename']?></a></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;">
            <a href="list.php" class="btn btn-info" style="float:left;">목록</a>
            <a href="delete.php?idx=<?=$detail['idx']?>" style="float:right;" class="btn btn-info" onclick="return confirm('삭제하시겠습니까?');">삭제</a>
            <a href="modify.php?idx=<?=$detail['idx']?>" style="float:right;" class="btn btn-info">수정</a>
        </td>
    </tr>   
 
</table>

