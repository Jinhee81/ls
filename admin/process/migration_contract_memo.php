<?php
$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman");//old db
$conn2 = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");//new db

header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set('Asia/Seoul');

$old_user_id = 45;
$new_user_id = 28;
$allRows = array();
$error = array();

$sql = "select id, old_idx1
        from realContract
        where user_id={$new_user_id}";

// echo $sql."<br>";

$result = mysqli_query($conn2, $sql);

while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}

for ($i=0; $i < count($allRows); $i++) {
  $sql2 = "select count(*) from tbl_contract_memo
           where c_idx={$allRows[$i]['old_idx1']}";
  // echo $sql2."<br>";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);

  if((int)$row2[0]>0){
    $sql3 = "select
                idx, c_idx, writer, content, r_date
             from tbl_contract_memo
             where c_idx={$allRows[$i]['old_idx1']}";
    // echo $sql3."<br>";
    $result3 = mysqli_query($conn, $sql3);

    $allRows[$i]['memo'] = array();
    while($row3 = mysqli_fetch_array($result3)){
      array_push($allRows[$i]['memo'], $row3);
    }

  }
}

for ($i=0; $i < count($allRows); $i++) {
  if($allRows[$i]['memo']){
    for ($j=0; $j < count($allRows[$i]['memo']); $j++) {
      $sql4 = "insert into realContract_memo
               (memoCreator, memoContent, created, realContract_id)
               VALUES
               ('{$allRows[$i]['memo'][$j]['writer']}',
                '{$allRows[$i]['memo'][$j]['content']}',
                '{$allRows[$i]['memo'][$j]['r_date']}',
                {$allRows[$i]['id']}
               )
              ";
      // echo $sql4;
      $result4 = mysqli_query($conn2, $sql4);

      if(!$result4){
        array_push($error, $allRows[$i]['id']);
      }
    }

  }
}

// for ($i=0; $i < count($allRows); $i++) {
//   if((int)$allRows[$i]['old_idx1']===4087){
//     print_r($allRows[$i]);
//   }
// }

echo "memo insert error : ";print_r(count($error));echo "<br>";
print_r($error);


 ?>
