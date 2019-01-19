<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$sql = "select count(*) from building where user_id={$_SESSION['id']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$b_count = (int)$row['count(*)'];

var_dump($b_count);
var_dump($row['count(*)']);
if($b_count == 0){
  echo "<meta http-equiv='refresh' content='0; url=/service/setting/building.php'>"; 
} else {
  echo "건물있음";
}
?>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
