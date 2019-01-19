<?php
require('view/conn.php');
$sql  = "
    INSERT INTO author (
        name,
        profile
    ) VALUES (
        '{$_POST['name']}',
        '{$_POST['profile']}'
    )";
$result = mysqli_query($conn, $sql);
if($result === false){
    echo mysqli_error($conn);
} else {
  echo "저장되었습니다.<a href='admin/user_list.php'>돌아가기</a>";
}
 ?>
