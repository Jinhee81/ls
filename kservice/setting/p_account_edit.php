<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
include $_SERVER['DOCUMENT_ROOT'] . "/view/conn.php";

//print_r($_POST);
echo "<br>";

$fil = array(
    'department' => mysqli_real_escape_string($conn, $_POST['department']),
    'position' => mysqli_real_escape_string($conn, $_POST['position']),
    'name' => mysqli_real_escape_string($conn, $_POST['name']),
    'phone1' => mysqli_real_escape_string($conn, $_POST['phone1']),
    'phone2' => mysqli_real_escape_string($conn, $_POST['phone2']),
    'phone3' => mysqli_real_escape_string($conn, $_POST['phone3']),
    'email' => mysqli_real_escape_string($conn, $_POST['email']),
    'in_date' => mysqli_real_escape_string($conn, $_POST['in_date']),
    'id' => mysqli_real_escape_string($conn, $_POST['id']),
    'password' => mysqli_real_escape_string($conn, $_POST['password']),
    'etc' => mysqli_real_escape_string($conn, $_POST['etc']),
    'usercode' => mysqli_real_escape_string($conn, $_POST['usercode'])
);

$sql = "update user
set
    department = '{$fil['department']}',
        position = '{$fil['position']}',
        name = '{$fil['name']}',
        phone1 = '{$fil['phone1']}',
        phone2 = '{$fil['phone2']}',
        phone3 = '{$fil['phone3']}',
        email = '{$fil['email']}',
        in_date = '{$fil['in_date']}',
        out_date = '{$fil['out_date']}',
        id = '{$fil['id']}',
        password = '{$fil['password']}',
        etc = '{$fil['etc']}'
    where usercode = {$fil['usercode']}
        ";

// echo $sql;

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "<script>alert('수정과정에 문제 생겼습니다. 관리자에게 문의하세요.');</script>";
     echo "<script>history.back();</script>";
    error_log(mysqli_error($conn));
    exit();
} else {
    echo "<script>alert('수정하였습니다.');</script>";
     echo "<script>history.back();</script>";
}


?>