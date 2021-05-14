<?php
session_start();
if(!isset($_SESSION['is_login'])){
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);

$fil = array(
    'firstDate' => mysqli_real_escape_string($conn, $_POST['firstDate']),
    'channel' => mysqli_real_escape_string($conn, $_POST['channel']),
    'danawaNumber' => mysqli_real_escape_string($conn, $_POST['danawaNumber']),
    'customerName' => mysqli_real_escape_string($conn, $_POST['customerName']),
    'customerContact' => mysqli_real_escape_string($conn, $_POST['customerContact']),
    'customerLocation' => mysqli_real_escape_string($conn, $_POST['customerLocation']),
    'rentlease' => mysqli_real_escape_string($conn, $_POST['rentlease']),
    'customerContent' => mysqli_real_escape_string($conn, $_POST['customerContent']),
    'salesContent' => mysqli_real_escape_string($conn, $_POST['salesContent']),
    'department' => mysqli_real_escape_string($conn, $_POST['department']),
    'salesman' => mysqli_real_escape_string($conn, $_POST['salesman']),
    'idnote' => mysqli_real_escape_string($conn, $_POST['idnote'])
);

// print_r($fil);

$sql = "select * from user where name='{$fil['salesman']}'";
// echo $sql;

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);

if($row['department']!=$fil['department']){
    echo json_encode('account_error');
    exit();
}

$sql2 = "update note
         set
            firstDate = '{$fil['firstDate']}',
            channel = '{$fil['channel']}',
            danawaNumber = '{$fil['danawaNumber']}',
            c_name = '{$fil['customerName']}',
            c_contact = '{$fil['customerContact']}',
            c_location = '{$fil['c_location']}',
            rentlease = '{$fil['rentlease']}',
            c_content = '{$fil['customerContent']}',
            sales_content = '{$fil['salesContent']}',
            usercode = {$row['usercode']}
          where idnote = {$fil['idnote']}
        ";
// echo $sql2;

$result2 = mysqli_query($conn, $sql2);

if(!$result2){
  echo json_encode('save_error');
  exit();
} else {
  echo json_encode('success');
}

?>
