<?php
$conn = mysqli_connect("127.0.0.1", "root", "wlsgml88", "opentutorials");
// print_r($_POST);

$filtered = array(
  'title' => mysqli_real_escape_string($conn, $_POST['title']),
  'description' => mysqli_real_escape_string($conn, $_POST['description']),
  'author_id' => mysqli_real_escape_string($conn, $_POST['author_id'])
);
settype($filtered['author_id'], 'integer');
$sql  = "
    INSERT INTO topic (
        title,
        description,
        created,
        author_id
    ) VALUES (
        '{$filtered['title']}',
        '{$filtered['description']}',
        NOW(),
        '{$filtered['author_id']}'
    )";

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
