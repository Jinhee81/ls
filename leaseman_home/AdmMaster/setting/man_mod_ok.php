<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	
	$user_name		= updateSQ($_POST[user_name]);
	$m_idx			= updateSQ($_POST[m_idx]);
	$user_pw		= updateSQ($_POST[user_pw]);
	$user_email		= updateSQ($_POST[user_email]);
	$mobile1		= updateSQ($_POST[mobile1]);
	$mobile2		= updateSQ($_POST[mobile2]);
	$mobile3		= updateSQ($_POST[mobile3]);
	$mobile = $mobile1 . "-" . $mobile2 . "-" . $mobile3;

	$ors = "";


	for($nn = 0; $nn < sizeof($chkNum); $nn++){
		$ors .= "|".$chkNum[$nn]."|";
	}

	//echo $ors;

	if($user_pw!=""){
		$sql_detail .= " ,user_pw = password('".$user_pw."') ";
	}



	$sql = "";
	$sql = $sql . "UPDATE  tbl_admin "							;
	$sql = $sql . "   SET  user_name = '[%user_name%]' "		;
	$sql = $sql . "     ,  user_email = '[%user_email%]' "		;
	$sql = $sql . "     ,  mobile = '[%mobile%]' "				;
	$sql = $sql . "     ,  chmods = '[%chmods%]' "				;
	$sql = $sql . "     ,  m_date = now() "						;
	$sql = $sql . $sql_detail;
	$sql = $sql . "WHERE m_idx = '[%m_idx%]' "						;

	
	$sql = str_replace("[%m_idx%]",   				$m_idx,					$sql);
	$sql = str_replace("[%user_name%]",				$user_name,				$sql);
	$sql = str_replace("[%user_email%]",			$user_email,			$sql);
    $sql = str_replace("[%mobile%]",				$mobile,				$sql);
	$sql = str_replace("[%chmods%]",				$ors,					$sql);
	

	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());

	


?>

<script type="text/javascript">
	var idx = "<?=$m_idx?>";
	alert("수정되었습니다.");
	location.href="/AdmMaster/setting/list02_mod.php?m_idx="+idx;
</script>