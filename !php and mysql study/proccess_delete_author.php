<?php
$conn = mysqli_connect("127.0.0.1", "root", "wlsgml88", "opentutorials");

settype($_POST['id'], 'integer');
$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id'])
);
$sql  = "
    DELETE
      FROM author
      WHERE
        id = {$filtered['id']}
    ";
// 이거는 author_id와 관계된 모든 토픽을 지울때 사용하려는 명령어
$sql_all  = "
    DELETE
      FROM topic
      WHERE
        author_id = {$filtered['id']}
    ";
mysqli_query($conn, $sql_all);

//die($sql);
$result = mysqli_query($conn, $sql);
// echo $result;
// if($result === false){
//     echo mysqli_error($conn);
//}
if($result === false){
  echo "삭제하지못했습니다.";
  echo mysqli_error($conn);
} else {
  echo "<script>
    alert('관련 토픽 모두 삭제 완료하였습니다.');
    location.href='author.php';
    </script>";
}

 ?>
