<!-- count2, enddate2 컬럼이 원래 없었다가 생긴거여서 이것을 추가하는 프로세스파일, 프로세스 폴더 자체가 개발자만 사용하려고 만든거이다. -->
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$sql = "select
          id, monthCount, count2
        from realContract
        where user_id=1 and count2 is null
        ";
echo $sql;

$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}

// print_r($allRows);
//
for ($i=0; $i < count($allRows); $i++) {
  $sql_update = "
      update realContract
        set
          count2 = {$allRows[$i]['monthCount']}
        WHERE
          id = {$allRows[$i]['id']}
      ";
  // echo $sql_update;

  $result_update = mysqli_query($conn, $sql_update);

  if(!$result_update){
    echo "<script>alert('error');</script>";
    error_log(mysqli_error($conn));
    exit();
  }
}

echo "<script>alert('수정하였습니다.');
      </script>";

?>
