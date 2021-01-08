<?php
  include "common/lib.php";

    $idx = $_GET['idx'];
    $idx = mysqli_real_escape_string($connect, $idx);

    $query = "delete from board where idx='$idx'";
    $result = mysqli_query($connect, $query); 
   
?>

<script>


location.href="list.php";

</script>
