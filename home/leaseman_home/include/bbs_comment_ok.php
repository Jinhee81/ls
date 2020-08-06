<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 
	include $_SERVER[DOCUMENT_ROOT]."/include/user_check.php"; 

	$upload="../data/comment/";
	$code		= updateSQ($_POST[code]);
	$bbs_idx	= updateSQ($_POST[bbs_idx]);
	$m_idx		= $_SESSION[member][idx];
	$writer		= $_SESSION[member][name];
	$comment	= updateSQ($_POST[comment]);

	for ($i=1;$i<=1;$i++)
	{
			if($_FILES["bfile".$i]['name'])
			{
					$wow=$_FILES["bfile".$i]['name'];
					if (check_file_ext($wow, "jpg;gif") == false)
					{
						alert_msg("업로드 불가한 확장자입니다.","blank");
						exit();
					}
					${"bfile_".$i}=$wow;
					$wow2=${"bfile".$i};//tmp 폴더의 파일
					${"rfile_".$i}=file_check($wow,$wow2,$upload,"N");
			}
	}

	if ($comment == "") {
		alert_msg("정상적으로 이용바랍니다.","blank");
		exit();
	}
	$sql = "INSERT INTO  tbl_bbs_comment (code, bbs_idx, m_idx, bfile1, rfile1, writer, comment, ip_address, r_date)
			VALUES ('$code', '$bbs_idx', '$m_idx', '$bfile_1', '$rfile_1', '$writer', '$comment',  '".$_SERVER["REMOTE_ADDR"]."', now());";
	$str = "정상적으로 등록되었습니다.";
	mysql_query($sql) or die (mysql_error());

?>
<script>
	alert("<?=$str?>");
	parent.location.reload();
</script>

