<?php
    session_start();
    if(!isset($_SESSION['is_login'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
    include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

    // var_dump($_POST['brand']); echo 1;

    $a = json_decode($_POST['brand']);
    $b = json_decode($_POST['model']);
    $c = json_decode($_POST['lineup']);

    // print_r($a);

    // switch($a =="brandall") {
    //     case $b == "modelall": 

    //     break;
    // }

    if($a == "brandall" && $b == "modelall" && $c == "lineupall"){
        $sql = "select 
                    brand.name, modelname, lineupname, trimname, trimcode, trim.usepart, price
                from trim
                left join lineup on lineup.lineupcode = trim.lineupcode 
                left join model on lineup.modelcode = model.modelcode 
                left join brand on model.brandcode = brand.brandcode
                order by trimcode
                ";
            } elseif($a != "brandall" && $b == "modelall" && $c == "lineupall") {
                $sql = "select 
                brand.name, modelname, lineupname, trimname, trimcode, trim.usepart, price
                from trim
                left join lineup on lineup.lineupcode = trim.lineupcode 
                left join model on lineup.modelcode = model.modelcode 
                left join brand on model.brandcode = brand.brandcode
                where brand.brandcode = '{$a}'
                order by trimcode
                ";
            } elseif($a != "brandall" && $b != "modelall" && $c == "lineupall") {
                $sql = "select 
                brand.name, modelname, lineupname, trimname, trimcode, trim.usepart, price
                from trim
                left join lineup on lineup.lineupcode = trim.lineupcode 
                left join model on lineup.modelcode = model.modelcode 
                left join brand on model.brandcode = brand.brandcode
                where brand.brandcode = '{$a}' and
                model.modelcode = '{$b}'
                order by trimcode
                ";
            } elseif($a != "brandall" && $b != "modelall" && $c != "lineupall") {
                $sql = "select 
                brand.name, modelname, lineupname, trimname, trimcode, trim.usepart, price
                from trim
                left join lineup on lineup.lineupcode = trim.lineupcode 
                left join model on lineup.modelcode = model.modelcode 
                left join brand on model.brandcode = brand.brandcode
                where brand.brandcode = '{$a}' and
                model.modelcode = '{$b}' and
                lineup.lineupcode = '{$c}'
                order by trimcode
                ";
    }
    
    // echo $sql;
            
    $result = mysqli_query($conn, $sql);

    $allRows = array();
    while($row = mysqli_fetch_array($result)){
        $allRows[] = $row;
    }

    echo json_encode($allRows);
    
?>