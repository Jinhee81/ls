<?php
//도이치오토월드 물건수정화면 ㅠㅠ

$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");

header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set('Asia/Seoul');

$sql = "select * from group_in_building where building_id=35";

// echo $sql;
$result = mysqli_query($conn, $sql);

$allRows = array();
while($row=mysqli_fetch_array($result)){
  $allRows[] = $row;
}



for ($i=0; $i < count($allRows); $i++) {
  $sql2 = "select *
           from r_g_in_building
           where group_in_building_id={$allRows[$i]['id']}
           order by ordered
           ";
  // echo $sql2."<br>";
  $result2 = mysqli_query($conn, $sql2);

  $allRows[$i]['room'] = array();
  while($row2=mysqli_fetch_array($result2)){
    $allRows[$i]['room'][] = $row2;
  }
}


//
for ($i=0; $i < count($allRows); $i++) {
  for ($j=0; $j <count($allRows[$i]['room']); $j++) {
    $newName = $allRows[$i]['gName'].'_'.$allRows[$i]['room'][$j]['rName'];
    array_push($allRows[$i]['room'][$j], $newName);
  }
}

// print_r($allRows);
//
for ($i=0; $i < count($allRows); $i++) {
  for ($j=0; $j <count($allRows[$i]['room']); $j++) {
    // echo $allRows[$i]['room'][$j][4]."<br>";
    $sql4 = "select id
             from r_g_in_building
             where group_in_building_id=64
                   and rName='{$allRows[$i]['room'][$j][4]}'
             ";
    // echo $sql4."<br>";
    $result4 = mysqli_query($conn, $sql4);

    $row4 = mysqli_fetch_array($result4);

    $allRows[$i]['room'][$j][5] = $row4[0];
  }
}
//
// // print_r($allRows); echo "<br>";
//
$aa = array();
for ($i=0; $i < count($allRows); $i++) {
  for ($j=0; $j < count($allRows[$i]['room']); $j++) {
    $a = array();
    array_push($a, $allRows[$i]['room'][$j][0]);
    array_push($a, $allRows[$i]['room'][$j][5]);

    array_push($aa, $a);
  }
}
// print_r($aa);echo "<br>";
//
$sql5 = "select *
         from realContract
         where user_id=42
               and building_id=35";
$result5 = mysqli_query($conn, $sql5);

$allRows2 = array();
while($row5 = mysqli_fetch_array($result5)){
  $allRows2[] = $row5;
}

// print_r($allRows2); echo "<br>";

$number = 0;

for ($i=0; $i < count($allRows2); $i++) {
  $number += 1;
  $sql7 = "select *
           from customer
           where id={$allRows2[$i]['customer_id']}";
  echo $number.' : '.$sql7."<br>";
  $result7 = mysqli_query($conn, $sql7);
  $row7 = mysqli_fetch_array($result7);

  $sql8 = "select id
           from customer
           where
              user_id=42 and
              building_id=41 and
              companyname = '{$row7['companyname']}'
           ";
  echo $number.' : '.$sql8."<br>";
  $result8 = mysqli_query($conn, $sql8);
  $row8 = mysqli_fetch_array($result8);
  echo $number.' : '.$row8['id']."<br>";
  $allRows2[$i]['newCustomerId'] = $row8['id'];
}

print_r($allRows2);echo "<br>";

$number = 0;
for ($i=0; $i < count($allRows2); $i++) {
  for ($j=0; $j < count($aa); $j++) {
    if($allRows2[$i]['r_g_in_building_id']===$aa[$j][0]){
      $number += 1;

      $sql6 = "update realContract
               set
                  customer_id={$allRows2[$i]['newCustomerId']},
                  building_id=41,
                  group_in_building_id=64,
                  r_g_in_building_id={$aa[$j][1]}
               where id={$allRows2[$i]['id']}";
      echo $number.' : '.$sql6."<br>";

      $result6 = mysqli_query($conn, $sql6);

      if(!$result6){
        echo "<script>alert('error!');</script>";
        error_log(mysqli_error($conn));
        exit();
      }
    }
  }
}
//
echo "<script>alert('success!');</script>";


// print_r($allRows2[0])."<br>";




//이부분 주석처리 중요, insert into가 있어서 주석제외하면 또 실행한다.
// $ordered = 1;
//
// for ($i=0; $i < count($allRows); $i++) {
//   for ($j=0; $j <count($allRows[$i]['room']); $j++) {
//
//     $sql3 = "insert into r_g_in_building
//             (ordered, rName, group_in_building_id)
//             VALUES
//             ({$ordered},
//              '{$allRows[$i]['room'][$j][4]}',
//              65
//             )";
//     echo $sql3."<br>";
//     $ordered += 1;
//     $result3 = mysqli_query($conn, $sql3);
//
//     if(!$result3){
//       echo "<script>alert('error!');
//          </script>";
//          error_log(mysqli_error($conn));
//          exit();
//     }
//   }
// }
//
// echo "<script>alert('success!');</script>";
//이부분 주석처리 중요, insert into가 있어서 주석제외하면 또 실행한다.


// print_r($allRows);
 ?>
