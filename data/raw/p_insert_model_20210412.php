<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";


$model_file = $_SERVER['DOCUMENT_ROOT'].'/data/raw/model20210412.csv';

$model_array = array();

if(($h = fopen($model_file, 'r')) !== false) {
    while(($data = fgetcsv($h, 1000, ',')) !== false) {
        $model_array[] = $data;
    }

    fclose($h);
}

print_r($model_array);

$error = array();

for($i=0; $i < count($model_array); $i++) {
    $sql = "insert into model
                    (modelcode, modelname, brandcode, danawacode)
                  values
                    ('{$model_array[$i][2]}',
                    '{$model_array[$i][0]}',
                    '{$model_array[$i][1]}',
                    '{$model_array[$i][3]}')";

    echo $sql."<br>";

    $result = mysqli_query($conn, $sql);

    if(!$result){
      array_push($error, $sql);
    }
}

// print_r(count($model_array));echo "<br>";

echo "6<br>";
print_r($error);
 ?>