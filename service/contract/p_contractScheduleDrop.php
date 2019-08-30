<!-- 삭제버튼 누르면 실행되는거, 계약스케줄을 삭제한다 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$filtered_id = mysqli_real_escape_string($conn, $_POST['contractId']);

$a = explode(",", $_POST['contractScheduleIdArray']);

for ($i=0; $i < count($a); $i++) {
  $sql = "
        delete from contractSchedule where idcontractSchedule={$a[$i]}
  ";
  // echo $sql;
  $result = mysqli_query($conn, $sql);

  if($result===false){
    echo "<script>alert('삭제에 문제가 생겼습니다. 관리자에게 문의하세요.');
          location.href = 'contractEdit3.php?id=$filtered_id';
          </script>";
    error_log(mysqli_error($conn));
  }
}

$sql5 = "UPDATE realContract SET
           updateTime = now(),
           updatePerson = '{$_SESSION['id']}'
         WHERE
           id = {$filtered_id}
        ";
// echo $sql5;
$result5 = mysqli_query($conn, $sql5);

if($result5===false){
  echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
        location.href = 'contractEdit3.php?id=$filtered_id';
        </script>";
  error_log(mysqli_error($conn));
  exit();
}

echo "<script>
        alert('삭제하였습니다.');
        location.href = 'contractEdit3.php?id=$filtered_id';
      </script>";

?>
