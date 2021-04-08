<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/admin/view/aconn.php";

// print_r($_POST['userArray']);echo "<br>";

$a = json_decode($_POST['userArray']);
// print_r($a);echo "<br>";

for($i=0; $i<count($a); $i++) {
    $sql = "delete from user where id={$a[$i][1]}";
    echo $sql;

    $result = mysqli_query($conn, $sql);

    if(!$result){
        echo "<script>alert('삭제과정에 문제생겼음');</script>";
        echo "<script>history.back();</script>";
        error_log(mysqli_error($conn));
        exit();
    }
}

echo "<script>alert('delete completed!');</script>";
echo "<script>history.back();</script>";

?>