<!-- 지출입력화면에서 실제로는 고정비를 업데이트하는 프로세스파일-->
<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);


$a = explode(',',$_POST['editableArray1']);
$b = explode(',',$_POST['editableArray2']);
// print_r($a);


for ($i=0; $i < count($a); $i++) {
  $sql = "
         update costlist
         set
            editable = 'yes'
         where id = {$a[$i]}
  ";
  // echo $sql;
  $result = mysqli_query($conn, $sql);
  if(!$result){
    echo "<script>alert('편집과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
                      history.back();
          </script>";
        error_log(mysqli_error($conn));
        exit();
  }
}

for ($i=0; $i < count($b); $i++) {
  $sql2 = "
         update costlist
         set
            editable = 'yes'
         where id = {$b[$i]}
  ";
  // echo $sql2;
  $result2 = mysqli_query($conn, $sql2);
  if(!$result2){
    echo "<script>alert('편집과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
                      history.back();
          </script>";
        error_log(mysqli_error($conn));
        exit();
  }
}

echo "<script>
         location.href='flexCost.php';
      </script>";

 ?>
