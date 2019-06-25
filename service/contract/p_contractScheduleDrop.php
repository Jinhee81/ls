<!-- 삭제버튼 누르면 실행되는거, 계약스케줄을 삭제한다 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST);
// print_r($_SESSION);

$filtered_id = mysqli_real_escape_string($conn, $_POST['contractId']);

$a = explode(",", $_POST['contractScheduleIdArray']);

for ($i=0; $i < count($a); $i++) {
  $sql = "
        delete from contractSchedule where idcontractSchedule={$a[$i]}
  ";
  echo $sql;
  $result = mysqli_query($conn, $sql);

  if($result===false){
    echo "<script>alert('삭제에 문제가 생겼습니다. 관리자에게 문의하세요.');
          location.href = 'contractEdit3.php?id=$filtered_id';
          </script>";
    error_log(mysqli_error($conn));
  }
}

$sql2 = "select * from
        contractSchedule where realContract_id={$filtered_id}";
echo $sql2;

$result2 = mysqli_query($conn, $sql2);
while($row=mysqli_fetch_array($result2)){
  echo $row['ordered'], $row['mStartDate'], $row['mEndDate'];
}

// echo "<script>
//         alert('삭제하였습니다.');
//         location.href = 'contractEdit3.php?id=$filtered_id';
//       </script>";

?>
