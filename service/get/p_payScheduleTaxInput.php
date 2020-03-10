<!-- 세금계산서일자 또는 현금영수증 일자 넣는거 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$a = json_decode($_POST['taxArray']);

for ($i=0; $i < count($a); $i++) {
  $sql = "update paySchedule2
          set
              taxSelect = '{$_POST['taxSelect']}',
              taxDate = '{$_POST['taxDate']}'
          WHERE
              idpaySchedule2 = {$a[$i][1]}";
  // echo $sql;

  $result = mysqli_query($conn, $sql);
  if(!$result){
    echo "<script>alert('발행과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
                  location.href='getfinished.php';
            </script>";
    error_log(mysqli_error($conn));
    exit();
  }
}

echo "<script>alert('발행완료하였습니다.');
         history.back();
      </script>";
?>
