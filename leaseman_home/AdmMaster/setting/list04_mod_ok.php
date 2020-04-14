<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	
	$P_START_HH = str_pad(@trim($P_START_HH), 2, "0", STR_PAD_LEFT);
	$P_START_MM = str_pad(@trim($P_START_MM), 2, "0", STR_PAD_LEFT);
	$P_END_HH = str_pad(@trim($P_END_HH), 2, "0", STR_PAD_LEFT);
	$P_END_MM = str_pad(@trim($P_END_MM), 2, "0", STR_PAD_LEFT);



	if($idx){
		$sql = "
				UPDATE tbl_popup2 SET 
					P_SUBJECT		= '".$P_SUBJECT."', 
					P_STARTDAY		= '".$P_STARTDAY."', 
					P_START_HH		= '".$P_START_HH."', 
					P_START_MM		= '".$P_START_MM."', 
					P_ENDDAY		= '".$P_ENDDAY."', 
					P_END_HH		= '".$P_END_HH."', 
					P_END_MM		= '".$P_END_MM."', 
					status			= '".$status."', 
					is_mobile		= '".$is_mobile."', 

					P_MOVEURL		= '".$P_MOVEURL."',  
					P_WIN_WIDTH		= '".$P_WIN_WIDTH."',  
					P_WIN_HEIGHT	= '".$P_WIN_HEIGHT."',  
					P_WIN_TOP		= '".$P_WIN_TOP."',  
					P_WIN_LEFT		= '".$P_WIN_LEFT."',  
					P_STYLE			= '".$P_STYLE."',  

					mod_date		= now(),  
					mod_id			= '".$_SESSION[member][id]."',  



					P_CONTENT		= '".$P_CONTENT."'
				WHERE idx='$idx';
			";

		mysql_query($sql);
	}


?>

<script type="text/javascript">
	var idx = "<?=$idx?>";
	alert("수정되었습니다.");
	location.href="/AdmMaster/setting/list04_mod.php?idx="+idx;
</script>