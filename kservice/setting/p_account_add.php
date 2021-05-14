<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
include $_SERVER['DOCUMENT_ROOT'] . "/view/conn.php";

// print_r($_POST);
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
    'etc' => mysqli_real_escape_string($conn, $_POST['etc'])
);

$sql = "insert into user
        (department, position, name, phone1, phone2, phone3, email, in_date, id, password, etc)
        values
        (
            '{$fil['department']}',
            '{$fil['position']}',
            '{$fil['name']}',
            '{$fil['phone1']}',
            '{$fil['phone2']}',
            '{$fil['phone3']}',
            '{$fil['email']}',
            '{$fil['in_date']}',
            '{$fil['id']}',
            '{$fil['password']}',
            '{$fil['etc']}'
        )
        ";

// echo $sql;

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "<script>alert('저장과정에 문제 생겼습니다. 관리자에게 문의하세요.');</script>";
    echo "<script>history.back();</script>";
    error_log(mysqli_error($conn));
    exit();
} else {
    echo "<script>alert('저장하였습니다.');</script>";
    echo "<script>history.back();</script>";
}


?>
