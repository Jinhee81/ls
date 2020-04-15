<?php //빌딩만드는 파일
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

$filtered = array(
  'name' => mysqli_real_escape_string($conn, $_POST['name'])
);

$query = "
  select count(*) from building
  where
    user_id={$_SESSION['id']} and bName = '{$filtered['name']}'
    ;";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$r_count = (int)$row['count(*)'];
if ($r_count === 0) {
  $sql  = "
      INSERT INTO building (
          bName,
          pay,
          user_id,
          created
      ) VALUES (
          '{$filtered['name']}',
          '{$_POST['pay']}',
          {$_SESSION['id']},
          now()
      )";
} else {
  echo "<script>alert('같은 명칭이 이미 존재합니다.');
  location.href='building.php';
  </script>";
}

$result = mysqli_query($conn, $sql);
// echo $result;
if($result === false){
    echo mysqli_error($conn);
} else {
  echo
  "<script>
  alert('저장되었습니다.');
  window.location.href='building.php';
  </script>";
}
?>
