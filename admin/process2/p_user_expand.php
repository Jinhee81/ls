<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/admin/view/aconn.php";

print_r($_POST);echo "<br>";

$a = json_decode($_POST['userArray']);
print_r($a);echo "<br>";
print_r($_POST['expandDate']);echo "<br>";


for($i=0; $i<count($a); $i++) {
    $sql = "select count(*) from grade where user_id={$a[$i][1]}";
    echo $sql;

    $result = mysqli_query($conn, $sql);

    if(!$result){
        echo "<script>alert('count error occurred!');</script>";
        echo "<script>history.back();</script>";
        error_log(mysqli_error($conn));
        exit();
    } else {
        $row = mysqli_fetch_array($result);

        $sql2 = "update grade
                 set 
                    enddate =  '{$_POST['expandDate']}'
                 where user_id={$a[$i][1]} and
                      ordered = {$row[0]}
        ";
        echo $sql2;
        $result2 = mysqli_query($conn, $sql2);

        if(!$result2){
            echo "<script>alert('update error occurred!');</script>";
            echo "<script>history.back();</script>";
            error_log(mysqli_error($conn));
            exit();
        }
    }
}

echo "<script>alert('update completed!');</script>";
echo "<script>history.back();</script>";
?>