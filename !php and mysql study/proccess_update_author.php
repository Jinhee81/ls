<?php
$conn = mysqli_connect("127.0.0.1", "root", "wlsgml88", "opentutorials");
// print_r($_POST);
$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']),
  'name' => mysqli_real_escape_string($conn, $_POST['name']),
  'profile' => mysqli_real_escape_string($conn, $_POST['profile'])
);
$sql  = "
    UPDATE author
      SET
        name = '{$filtered['name']}',
        profile = '{$filtered['profile']}'
      WHERE
        id = {$filtered['id']}
    ";
// die($sql);
$result = mysqli_query($conn, $sql);

if($result === false){
  echo "저장되지 않았습니다.";
  error_log(mysqli_error($conn));
} else {
  header('Location: author.php?id='.$filtered['id']);
}

 ?>
