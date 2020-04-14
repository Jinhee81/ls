<!-- 여러개를 청구취소하는 파일 -->

<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);
$filtered_id = mysqli_real_escape_string($conn, $_POST['contractId']);

$a = explode(",", $_POST['scheduleArray']);
// var_dump($a);

for ($i=0; $i < count($a)/2; $i++) {
  $payrow[$i]=[];
} //payrow라는 배열을 만듦

for ($i=0; $i < count($a); $i++) {
  if($i < 2){
    array_push($payrow[0], $a[$i]);
  } else {
    array_push($payrow[floor($i/2)], $a[$i]);
  }
} //배열에다가 청구데이터를 추가시킴

// print_r($payrow);

for ($i=0; $i < count($payrow); $i++) {
  $sql = "
          select payId from contractSchedule where idcontractSchedule={$payrow[$i][0]}";
  // echo $sql;
  $result = mysqli_query($conn, $sql);

  if($result){
    $row = mysqli_fetch_array($result);
    $sql_drop = "
                delete from paySchedule2 where idpaySchedule2={$row[0]}";
    // echo $sql_drop;
    $result_drop = mysqli_query($conn, $sql_drop);
    if($result_drop){
      $sql2 = "
              update contractSchedule
              set
                payId = null,
                payIdOrder = null
              where idcontractSchedule = {$payrow[$i][0]}
      "; //계약스케줄에서 청구번호와 청구순번 없애기
      $result2 = mysqli_query($conn, $sql2);

      $sql5 = "UPDATE realContract SET
                 updateTime = now()
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

      echo "<script>alert('청구취소하였습니다.');
               location.href='contractEdit3.php?id=$filtered_id';
            </script>";
      if($result2===false){
        echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
                 location.href='contractEdit3.php?id=$filtered_id';
           </script>";
        error_log(mysqli_error($conn));
      }
    } else {
      echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
               location.href='contractEdit3.php?id=$filtered_id';
         </script>";
      error_log(mysqli_error($conn));
    }
  } else {
    echo "<script>alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
             location.href='contractEdit3.php?id=$filtered_id';
       </script>";
    error_log(mysqli_error($conn));
  }
}
?>
