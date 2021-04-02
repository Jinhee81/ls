<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

include "../car.php"; //db에 인서트할때는 파일에서 불러온 car 파일이 필요하다. 이건 한번만 하는 작업이다.

// print_r($trim_array);echo "<br>";

$error = array();

for($i=0; $i < count($lineup_array); $i++) {
    $sql = "insert into lineup
                    (lineupcode, lineupname, modelcode, usepart)
                  values
                    ('{$lineup_array[$i][1]}',
                    '{$lineup_array[$i][0]}',
                    {$lineup_array[$i][2]},
                    '{$lineup_array[$i][3]}')";

    // echo $sql."<br>";

    $result = mysqli_query($conn, $sql);

    if(!$result){
      array_push($error, $sql);
    }
}

// print_r(count($lineup_array));echo "<br>";

echo "3<br>";
print_r($error);
 ?>