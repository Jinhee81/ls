<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
$idx =$_POST['idx'];
$user_pw =$_POST['user_pw'];
$sql ="select idx, user_pw from tbl_inquiry where idx ='".$idx."'";
$result =mysql_query($sql) or die(mysql_error());
$row =mysql_fetch_array($result);
$list =array();
if($user_pw == $row['user_pw']){
	$row['check'] ="Y";
	$list =$row;
}else{
	$row['check'] ="N";
	$row['msg'] ="비밀번호가 일치하지 않습니다.";
	$list =$row;
}
echo json_encode($list);
?>