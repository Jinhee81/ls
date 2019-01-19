<?php
$conn = mysqli_connect("127.0.0.1", "root", "wlsgml88", "opentutorials");
// print_r($_POST);
$filtered = array(
  'name' => mysqli_real_escape_string($conn, $_POST['name']),
  'profile' => mysqli_real_escape_string($conn, $_POST['profile'])
);
$sql  = "
    INSERT INTO author (
        name,
        profile
    ) VALUES (
        '{$filtered['name']}',
        '{$filtered['profile']}'
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
  header('Location: author.php');
}

 ?>
