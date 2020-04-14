<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
$user_name =$_POST['user_name'];
$user_email =$_POST['user_email'];
$sql ="select user_id, c_idx,user_name, user_email from tbl_customer where user_email ='".$user_email."'";
$result =mysql_query($sql) or die(mysql_error());
$row =mysql_fetch_array($result);
$list =array();
if($user_name == $row['user_name']){
	$row['check'] ="Y";
	$list =$row;
}else{
	$row['check'] ="N";
	$row['msg'] ="일치하는 정보가 없습니다.";
	$list =$row;
}
echo json_encode($list);
?>