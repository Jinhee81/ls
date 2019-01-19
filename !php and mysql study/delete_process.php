<?php
$conn = mysqli_connect("127.0.0.1", "root", "wlsgml88", "opentutorials");

settype($_POST['id'], 'integer');
$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id'])
);
$sql  = "
    DELETE
      FROM topic
      WHERE
        id = {$filtered['id']}
    ";

// die($sql);
$result = mysqli_query($conn, $sql);
// echo $result;
// if($result === false){
//     echo mysqli_error($conn);
//}
if($result === false){
  echo "삭제하지못했습니다.";
  echo mysqli_error($conn);
} else {
  echo "삭제하였습니다.<a href='index.php'>돌아가기</a>";
}

 ?>
