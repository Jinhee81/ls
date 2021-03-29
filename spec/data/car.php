<?php
// include 'view/conn.php';
$brand_file = $_SERVER['DOCUMENT_ROOT'].'/spec/data/raw/brand.csv';

$brand_array = array();

if(($h = fopen($brand_file, 'r')) !== false) {
    while(($data = fgetcsv($h, 1000, ',')) !== false) {
        $brand_array[] = $data;
    }

    fclose($h);
}

// print_r($brand_array);echo "<br>";

$model_file = $_SERVER['DOCUMENT_ROOT'].'/spec/data/raw/model.csv';

$model_array = array();

if(($h = fopen($model_file, 'r')) !== false) {
    while(($data = fgetcsv($h, 1000, ',')) !== false) {
        $model_array[] = $data;
    }

    fclose($h);
}

// print_r($model_array);echo "<br>";

$lineup_file = $_SERVER['DOCUMENT_ROOT'].'/spec/data/raw/lineup.csv';

$lineup_array = array();

if(($h = fopen($lineup_file, 'r')) !== false) {
    while(($data = fgetcsv($h, 1000, ',')) !== false) {
        $lineup_array[] = $data;
    }

    fclose($h);
}

// print_r($lineup_array);echo "<br>";

$trim_file = $_SERVER['DOCUMENT_ROOT'].'/spec/data/raw/trim.csv';

$trim_array = array();

if(($h = fopen($trim_file, 'r')) !== false) {
    while(($data = fgetcsv($h, 1000, ',')) !== false) {
        $trim_array[] = $data;
    }

    fclose($h);
}

// print_r($trim_array);echo "<br>";
// echo 14;

// for ($i=0; $i < count($brand_array); $i++){

//     for($j=0; $j < count($brand_array[$i]); $j++){
//         $sql = "insert into brand
//                 (brandcode, name, div)
//                 values
//                 (
//                     {$brand_array[$i][$j][1]}, 
//                     '{$brand_array[$i][$j][0]}', 
//                     '{$brand_array[$i][$j][2]}'
//                 )";
//         echo $sql."<br>";
//     }
// }
?>