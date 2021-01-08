<?php

    include "common/lib.php";

    $idx = $_GET['idx'];
    $idx = mysqli_real_escape_string($connect, $idx);

    $query = "select * from board where idx='$idx'";
    $result = mysqli_query($connect, $query); 
    $detail = mysqli_fetch_array($result);

?>

<form action="insert.php" method="post" name="insert" enctype="multipart/form-data">
<table width=800 class="table table" style="">
    <input type="hidden" name="idx" value="<?=$detail['idx']?>">
    <tr>
        <th>이름</th>
        <td><input type="text" name="nickname" id="nickname" value="<?=$detail['nickname']?>"></td>
    </tr>
    <tr>
        <th>제목</th>
        <td><input type="text" name="title" id="title" value="<?=$detail['title']?>" style="width:100%"></td>
    </tr>
    <tr>
        <th>내용</th>
        <td><textarea name="content" id="content" style="width:100%; height: 400px"><?=$detail['content']?></textarea></td>
    </tr>
    <tr>
        <th>파일첨부</th>
        <td id='file-name'><?=$detail['filename']?>
        <?php 
            if($detail['filename'] != null ){
             echo '<a href=# class="btn btn-info" id="delete-file" onclick="del_file()">삭제</a>';
            }
        ?> 
        </td>
       
    </tr> 
    <tr>
        <th></th>
        <td><input type="file" name="upload" >
        <input type="hidden" name="attach" /></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;">
         <input type="button" class="btn btn-info" onclick="check()" value="저장">
         <input type="button" class="btn btn-info" onclick="history.go(-1)" value="취소">
        </td>
    </tr>
    
 
</table>
</form>


<script type="text/javascript">
        
    function del_file(){ 
        alert("삭제합니다");
        document.getElementById("file-name").innerText = null;
    }

    // 글쓰기 항목 체크 
    function check(){

        var blank_pattern = /^\s+|\s+$/g; //공백체크 
        var nickname = document.getElementById("nickname").value.replace(blank_pattern, "") ; 
        var title = document.getElementById("title").value.replace(blank_pattern, "") ; 
        var content = document.getElementById("content").value.replace(blank_pattern, "") ; 


        if (nickname == '') {
            alert('닉네임을 입력하세요');
            return false;
        }
        if (title == '') {
            alert('제목을 입력하세요');
            return false;
        }
        
        if (content == '') {
            alert('내용을 입력하세요');
            return false;
        }

       
        document.getElementsByName("attach")[0].setAttribute( 'value',  document.getElementById("file-name").innerText );
        document.insert.submit();

    }


   

</script>