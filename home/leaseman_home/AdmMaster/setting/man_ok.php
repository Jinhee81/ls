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
	$user_id		= updateSQ($_POST[user_id]);
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

	$sql = "select count(*) cnts from tbl_admin where user_id = '".$user_id."' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	if($row['cnts']>0){
	?>
		<script type="text/javascript">
			alert("이미 등록된 아이디입니다.");
			parent.location.reload();
		</script>
	<?
		exit;
	}


	$sql = "";
	$sql = $sql . "INSERT INTO	  tbl_admin "					;
	$sql = $sql .			   " (user_id "     				;
	$sql = $sql .			   " ,user_pw "						;
	$sql = $sql .			   " ,user_name "					;
	$sql = $sql .			   " ,user_email "					;
	$sql = $sql .			   " ,user_level "					;
	$sql = $sql .			   " ,mobile "						;
	$sql = $sql .			   " ,status "						;
    $sql = $sql .			   " ,secede_yn "					;
	$sql = $sql .			   " ,chmods "						;
	$sql = $sql .			   " ,r_date) "						;
	$sql = $sql .	   "VALUES "						        ;
	$sql = $sql .			   " ('[%user_id%]' "				;
	$sql = $sql .			   " ,password('[%user_pw%]') "		;
	$sql = $sql .			   " ,'[%user_name%]' "				;
	$sql = $sql .			   " ,'[%user_email%]' "			;
	$sql = $sql .			   " ,'1' "							;
	$sql = $sql .			   " ,'[%mobile%]' "				;
	$sql = $sql .			   " ,'Y' "							;
	$sql = $sql .			   " ,'N' "							;
	$sql = $sql .			   " ,'[%chmods%]' "				;
    $sql = $sql .			   " ,now() ) "    					;

	$sql = str_replace("[%user_id%]",   			$user_id,				$sql);
	$sql = str_replace("[%user_pw%]",				$user_pw,				$sql);
	$sql = str_replace("[%user_name%]",				$user_name,				$sql);
	$sql = str_replace("[%user_email%]",			$user_email,			$sql);
	$sql = str_replace("[%mobile%]",				$mobile,				$sql);
	$sql = str_replace("[%chmods%]",				$ors,					$sql);
	

	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());

	


?>

<script type="text/javascript">
	alert("등록되었습니다.");
	parent.location.reload();
</script>