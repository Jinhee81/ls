<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";


$lineup_file = $_SERVER['DOCUMENT_ROOT'].'/data/raw/lineup20210402.csv';

$lineup_array = array();

if(($h = fopen($lineup_file, 'r')) !== false) {
    while(($data = fgetcsv($h, 1000, ',')) !== false) {
        $lineup_array[] = $data;
    }

    fclose($h);
}

print_r($lineup_array);

$error = array();

for($i=0; $i < count($lineup_array); $i++) {
    $sql = "insert into lineup
                    (lineupcode, lineupname, modelcode, usepart)
                  values
                    ('{$lineup_array[$i][1]}',
                    '{$lineup_array[$i][0]}',
                    '{$lineup_array[$i][2]}',
                    '{$lineup_array[$i][3]}')";

    echo $sql."<br>";

    $result = mysqli_query($conn, $sql);

    if(!$result){
      array_push($error, $sql);
    }
}

print_r(count($lineup_array));echo "<br>";

echo "8<br>";
print_r($error);
 ?>