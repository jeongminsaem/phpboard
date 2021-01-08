<?php
     include "common/lib.php";

    $idx = $_GET['idx'];
    $idx = mysqli_real_escape_string($connect, $idx);

    $query = "select * from board where idx='$idx'";
    $result = mysqli_query($connect, $query); 
    $detail = mysqli_fetch_array($result);

    
    $filepath = $detail['filepath'];
    $filesize = filesize($filepath); 
    $filename = $detail['filename'];

    //헤더 설정
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$filename"); 
    header("Content-Transfer-Encoding: binary");
    //header("Content-Length: $filesize"); 

    ob_clean();
    flush(); 
    readfile($filepath); 

?>