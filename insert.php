<?php

include "common/lib.php";


     $idx = $_POST['idx'];
     $nickname = $_POST['nickname'];
     $title = $_POST['title'];
     $content = $_POST['content'];
     $attach = $_POST['attach'];

     $nickname = mysqli_real_escape_string($connect, $nickname);
     $title = mysqli_real_escape_string($connect, $title);
     $content = mysqli_real_escape_string($connect, $content);
     $writedate = date("Y-m-d");
     

    
    if($idx != null){  //수정

            $query = "select * from board where idx='$idx'";
            $result = mysqli_query($connect, $query); 
            $detail = mysqli_fetch_array($result);
           
            if ($_FILES["upload"]["size"] > 0) { //새로운 첨부파일 있음 
              $file_name = $_FILES['upload']['name'];           
              $tmp_file = $_FILES['upload']['tmp_name'];     
              $file_path = './files/'.$file_name;                  
              move_uploaded_file($tmp_file, $file_path);
              echo "첨부파일 있음";
                    //원래 있었는데 변경하면서 바꿔 첨부 하는 경우 원래 파일을 삭제 
                    if (!empty($detail['filepath'])) { 
                      $file_path = $detail['filepath'];  
               //       unlink($file_path);             
                      echo "---- 원 첨부파일 삭제";
                    }

            } else {  // 첨부 안함.   - 그대로 두는 경우, 삭제한경우 
                  
                  if ($attach == null) {  //첨부파일 삭제 
                    echo "파일 삭제";
                        if (!empty($detail['filepath'])) { 
                          $file_path = $detail['filepath'];  
                  //        unlink($file_path);                             
                        }

                  } else { //1-1 첨부파일 그대로     
                    echo "파일 그대로";    
                      $file_path = $detail['filepath'];
                      $file_name = $detail['filename']; 
                      
                  } 
          }




    $query = "update board set nickname='$nickname', title='$title', content='$content', filepath='$file_path', filename='$file_name' where idx='$idx'";
  
        
    } else { //새 글 
          if (!empty($_FILES)) {
            echo "첨부파일";
             $file_name = $_FILES['upload']['name'];
             $tmp_file = $_FILES['upload']['tmp_name'];
          
             $file_path = './files/'.$file_name;                  
             move_uploaded_file($tmp_file, $file_path);
            
             
            } 

              $query = "insert into board(nickname, title, content, writedate, filepath, filename)
              values('$nickname','$title','$content','$writedate', '$file_path', '$file_name')"; 
      }
     mysqli_query($connect, $query);
?>

<script>
   location.href='list.php';
</script>


