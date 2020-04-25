<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);

$a = json_decode($_POST['roomArray']);

// print_r($a);

$sql_count = "select count(*) from r_g_in_building where group_in_building_id={$_POST['groupId']}";
$result_count = mysqli_query($conn, $sql_count);
$row = mysqli_fetch_array($result_count);
// print_r($row); //당방그룹의 방개수를 파악한다.

$changecount = $row[0]+(int)$_POST['count'];

if($changecount > 100){
  echo "<script>
            alert('관리번호는 100개를 초과할 수 없습니다.');
            history.back();
        </script>";
  exit();
}

$order = $row[0] + 1;
for ($i=0; $i < count($a); $i++) {

  $sql_check = "select count(*) from r_g_in_building
                where group_in_building_id = {$_POST['groupId']}
                      and rName = '{$a[$i]}'";
  $result_check = mysqli_query($conn, $sql_check);

  if(!$result_check){
    echo "<script>
            alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(1).');
            history.back();
         </script>";
    exit();
  } else {
    $row_check = mysqli_fetch_array($result_check);

    // echo 'solmi';
    //
    // print_r((int)$row_check[0]);
    // print_r($_POST['groupName']);
    // print_r($a[$i]);

    if((int)$row_check[0] >= 1){

      echo "<script>
              alert('".$_POST['groupName']." 그룹명의 ".$a[$i]." 관리번호는 이미 존재하기때문에 추가 안되요. 다시 확인하고 입력해주세요.');
              history.back();
           </script>";
      exit();
    } else {
      $sql = "INSERT INTO r_g_in_building
        (ordered, rName, group_in_building_id)
        VALUES (
        {$order},
        '{$a[$i]}',
        {$_POST['groupId']}
        )
      ";
      // echo $sql;
      $result = mysqli_query($conn, $sql);
      if(!$result){
        echo "<script>
                alert('저장과정에 문제가 생겼습니다. 관리자에게 문의하세요(2).');
                history.back();
             </script>";
        exit();
      }
      $order += 1;
    } //result }
  } //result check }
}//for }


$sql_update = "
  UPDATE group_in_building
  SET
    count = {$changecount},
    updated = NOW()
  WHERE
    id = {$_POST['groupId']}
  ";
// echo $sql_update;
$result_update = mysqli_query($conn, $sql_update); //방갯수를 변경시킨다.

echo "<script>
        alert('추가하였습니다.');
        history.back();
      </script>";

?>
