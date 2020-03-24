<?php //고객생성 파일
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);

$filtered = array(
  'id' => mysqli_real_escape_string($conn, $_POST['id']), //고객아이디
  'sid' => mysqli_real_escape_string($conn, $_SESSION['id']) //세션,로그인아이디
);

settype($filtered['id'], 'integer');
settype($filtered['sid'], 'integer');

$sql = "DELETE from customer where
        id = {$filtered['id']} and user_id={$filtered['sid']}";
// echo $sql;
$result = mysqli_query($conn, $sql);
if ($result){
  echo "<script>alert('삭제하였습니다');
  location.href='customer.php';</script>";
} else {
  echo "삭제할 수 없습니다.";
  error_log(mysqli_error($conn));
}
?>
