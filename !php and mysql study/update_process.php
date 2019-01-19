<?php
$conn = mysqli_connect("127.0.0.1", "root", "wlsgml88", "opentutorials");

settype($_POST['id'], 'integer');
$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']),
  'title' => mysqli_real_escape_string($conn, $_POST['title']),
  'description' => mysqli_real_escape_string($conn, $_POST['description'])
);
$sql  = "
    UPDATE topic
      SET
        title = '{$filtered['title']}',
        description = '{$filtered['description']}'
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
  echo "저장되지 않았습니다.";
  error_log(mysqli_error($conn));
} else {
  echo "저장되었습니다.<a href='index.php'>돌아가기</a>";
}

 ?>
