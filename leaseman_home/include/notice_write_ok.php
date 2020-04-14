<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 

	$upload="../data/bbs/";
	$category		= updateSQ($_POST[category]);
	$search_mode	= updateSQ($_POST[search_mode]);
	$search_word	= updateSQ($_POST[search_word]);
	$scategory		= updateSQ($_POST[scategory]);
	$pg				= updateSQ($_POST[pg]);
	$subject		= updateSQ($_POST[subject]);
	$code			= updateSQ($_POST[code]);
	$writer			= updateSQ($_POST[writer]);
	$contents		= $contents;
	$url			= updateSQ($_POST[url]);
	$hit			= updateSQ($_POST[hit]);
	$wYY			= updateSQ($_POST[wYY]);
	$wMM			= updateSQ($_POST[wMM]);
	$wDD			= updateSQ($_POST[wDD]);
	$wHH			= updateSQ($_POST[wHH]);
	$wII			= updateSQ($_POST[wII]);
	$wSS			= updateSQ($_POST[wSS]);
	$gourl			= updateSQ($_POST[gourl]);
	$user_id		= $_SESSION[customer][id];
	$m_idx			= $_SESSION[customer][idx];
	$writer			= updateSQ($_POST[writer]);
	$secure_yn		= updateSQ($_POST[secure_yn]);
	$mode			= updateSQ($_POST[mode]);

	$b_ref			= updateSQ($_POST[b_ref]);
	$b_step			= updateSQ($_POST[b_step]);
	$b_level		= updateSQ($_POST[b_level]);
	if ($writer == "") {
		$writer		= $_SESSION[customer][name];
	}

for ($i=1;$i<=5;$i++)
{
	if (${"del_".$i} =="Y")
	{ 
		$sql = "
			UPDATE tbl_bbs_list SET 
			ufile".$i."='',
			rfile".$i."=''
			WHERE bbs_idx='$bbs_idx'
		";
		mysql_query($sql) or die (mysql_error());
	} elseif($_FILES["bfile".$i]['name'])
	{
		$wow=$_FILES["bfile".$i]['name'];
		${"bfile_".$i}=$wow;
		$wow2=${"bfile".$i};//tmp 폴더의 파일
		${"rfile_".$i}=file_check($wow,$wow2,$upload,"N");
		if ($bbs_idx) {
				$sql = "
					UPDATE tbl_bbs_list SET 
					ufile".$i."='".${"rfile_".$i}."',
					rfile".$i."='".${"bfile_".$i}."'
					WHERE bbs_idx='$bbs_idx';
				";
				mysql_query($sql) or die (mysql_error());
		}
	}
}
	if ($subject == "") {
?>
	<Script>
		alert("정상적으로 이용 바랍니다.");
		history.back();
	</script>
<?
	exit();
	}
	
	if ($mode == "reply") {
		$sql = "update tbl_bbs_list set b_step = b_step + 1 where b_ref = '$b_ref' and b_step > $b_step";
		mysql_query($sql) or die (mysql_error());
		$b_step	 = $b_step + 1;
		$b_level = $b_level + 1;

		$sql = "INSERT INTO tbl_bbs_list (subject, simple, code, category, writer, notice_yn, contents, hit, secure_yn, passwd, user_id, m_idx, url, rfile1, ufile1, rfile2, ufile2, rfile3, ufile3, rfile4, ufile4, rfile5, ufile5, ip_address, b_ref, b_step, b_level, r_date)
				VALUES ('$subject', '$simple', '$code', '$category', '$writer', '$notice_yn', '$contents', 0, '$secure_yn', '$passwd', '$user_id', '$m_idx', '$url', '$bfile_1', '$rfile_1', '$bfile_2', '$rfile_2', '$bfile_3', '$rfile_3', '$bfile_4', '$rfile_4', '$bfile_5', '$rfile_5', '".$_SERVER["REMOTE_ADDR"]."', '$b_ref', '$b_step', '$b_level', now());";
		mysql_query($sql) or die (mysql_error());


		$str = "정상적으로 등록되었습니다.";
	} elseif ($bbs_idx) {
		$sql = "update tbl_bbs_list set subject='$subject', simple='$simple', category='$category', notice_yn='$notice_yn', secure_yn = '$secure_yn', contents = '$contents', writer = '$writer', url='$url' where bbs_idx='$bbs_idx'";
		$str = "정상적으로 수정되었습니다.";
		mysql_query($sql) or die (mysql_error());
	} else {
		$total_sql	= " select ifnull(max(bbs_idx),0)+1 as maxidx from tbl_bbs_list";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);
		$b_ref		= $row[maxidx];

		$sql = "INSERT INTO tbl_bbs_list (subject, simple, code, category, writer, notice_yn, contents, hit, secure_yn, passwd, user_id, m_idx, url, rfile1, ufile1, rfile2, ufile2, rfile3, ufile3, rfile4, ufile4, rfile5, ufile5, ip_address, b_ref, b_step, b_level, r_date)
				VALUES ('$subject', '$simple', '$code', '$category', '$writer', '$notice_yn', '$contents', 0, '$secure_yn', '$passwd', '$user_id', '$m_idx', '$url', '$bfile_1', '$rfile_1', '$bfile_2', '$rfile_2', '$bfile_3', '$rfile_3', '$bfile_4', '$rfile_4', '$bfile_5', '$rfile_5', '".$_SERVER["REMOTE_ADDR"]."', $b_ref, 0, 0, now());";

		$str = "정상적으로 등록되었습니다.";
		mysql_query($sql) or die (mysql_error());
	}

?>
<script>
	alert("<?=$str?>");
	location.href="<?=$gourl?>?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&pg=<?=$pg?>";
</script>

