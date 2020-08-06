<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
include_once($_SERVER['DOCUMENT_ROOT'].'/inc/mailer.lib.php');
$user_id =$_POST['user_id'];
$user_email =$_POST['user_email'];
$sql ="select user_pw, user_id, c_idx,user_name, user_email from tbl_customer where user_email ='".$user_email."'";
$result =mysql_query($sql) or die(mysql_error());
$row =mysql_fetch_array($result);
$list =array();
if($user_id == $row['user_id']){
	//password update
	$return_pass =get_rand(8);
	$sql ="update tbl_customer set user_pw =password('".$return_pass."') where c_idx ='".$row['c_idx']."'";
	mysql_query($sql);
	
	$row['check'] ="Y";
	$list =$row;
	$user_name =$row['user_name'];
	$admin_title ="리스맨";
	$from_email ="114@leaseman.co.kr";
	$subject = $user_name.'님 비밀번호 찾기입니다.';


	ob_start();
	include_once ('./password_find_form_mail.php');
	$content = ob_get_contents();
	ob_end_clean();
	mailer($admin_title, $from_email, $user_email, $subject, $content, 1);
}else{
	$row['check'] ="N";
	$row['msg'] ="일치하는 정보가 없습니다.";
	$list =$row;
}
echo json_encode($list);
?>