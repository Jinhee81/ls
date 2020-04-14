<?
	include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";
	header("Content-Type: text/html; charset=utf-8");

	////////////////////////////////////////////////////////////
	// register_globals = Off
	////////////////////////////////////////////////////////////
		if($_GET) @extract($_GET);
		if($_POST) @extract($_POST);
		if($_COOKIE) @extract($_COOKIE);


	////////////////////////////////////////////////////////////
	$upload="../data/bbs/";
	$subject		= updateSQ($_POST['subject']);

	$code			= updateSQ($_POST['code']);
	$writer		= updateSQ($_POST['writer']);
	$email		= updateSQ($_POST['email']);
	$user_id	= updateSQ($_POST['user_id']);
  $m_idx		= updateSQ($_POST['m_idx']);

	$r_date			= "now()";


for ($i=1;$i<=6;$i++)
{
	$wow=$_FILES["ufile".$i]['name'];

	${"rfile_".$i}=$wow;
	$wow2=$_FILES["ufile".$i]['tmp_name'];//tmp 폴더의 파일
  ${"ufile_".$i}=file_check($wow,$wow2,$upload,"N");

}

	$total_sql	= " select ifnull(max(bbs_idx),0)+1 as maxbbs_idx from tbl_bbs_list";
	$result		= mysql_query($total_sql) or die (mysql_error());
	$row		= mysql_fetch_array($result);
	$b_ref		= $row[maxbbs_idx];

	$sql = "
    INSERT INTO tbl_bbs_list set
    subject ='".$subject."',
    code ='".$code."',
    writer ='".$write."',
    user_id ='".$user_id."',
		m_idx ='".$m_idx."',
    ufile1 ='".$ufile_1."',
    rfile1 ='".$rfile_1."',
    ip_address ='".$_SERVER['REMOTE_ADDR']."',
    b_ref ='".$b_ref."',
    b_step ='0',
    b_level ='0',
    recomm_yn ='".$recomm_yn."',
    email ='".$email."',
    r_date =now()
    ";
    $db = mysql_query($sql);
    $msg ="인증샷이 등록되었습니다.";
    $url ='./proof_shot.php';
    alert_msg($msg);
?>
