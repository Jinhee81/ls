<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
// error_reporting(E_ALL);

// ini_set("display_errors", 1);
// print_r($_REQUEST);

$file_id = $_REQUEST['file_id'];
$sql = "SELECT file_id, name_orig, name_save from
        upload_file where file_id='{$file_id}'";
// $stmt = mysqli_prepare($conn, $sql);
// $bind = mysqli_stmt_bind_param($stmt, "s", $file_id);
// $exec = mysqli_stmt_execute($stmt);

// $result = mysqli_stmt_get_result($stmt);
// $row = mysqli_fetch_array($result);
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$name_orig = $row['name_orig'];
$name_save = $row['name_save'];

$fileDir = "data/";
$fullPath = $fileDir."/".$name_save;
$length = filesize($fullPath);

header("Content-type: application/octet-stream");
header("Content-length: $length");
header("Content-Disposition: attachment; filename=".iconv('utf-8', 'euc-kr', $name_orig));
header("Content-Transfer-Encoding: binary");

$fh = fopen($fullPath, "r");
fpassthru($fh);

// mysqli_free_result($result);
// mysqli_stmt_close($stmt);
// mysqli_close($conn);

exit;
 ?>
