<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 
	mysql_query("SET AUTOCOMMIT=0");
	mysql_query("START TRANSACTION");

	$upload="../../data/bbs/";
	$category		= updateSQ($_POST[category]);
	$search_mode	= updateSQ($_POST[search_mode]);
	$search_word	= updateSQ($_POST[search_word]);
	$scategory		= updateSQ($_POST[scategory]);
	$pg				= updateSQ($_POST[pg]);
	$subject		= updateSQ($_POST[subject]);
	$simple			= updateSQ($_POST[simple]);
	$code			= updateSQ($_POST[code]);
	$writer			= updateSQ($_POST[writer]);
	$contents		= updateSQ($_POST[contents]);
	$reply			= updateSQ($_POST[reply]);
	$url			= updateSQ($_POST[url]);
	$hit			= updateSQ($_POST[hit]);
	$mode			= updateSQ($_POST[mode]);

	$b_ref			= updateSQ($_POST[b_ref]);
	$b_step			= updateSQ($_POST[b_step]);
	$recomm_yn		= updateSQ($_POST[recomm_yn]);
	$b_level		= updateSQ($_POST[b_level]);
	$user_email		= updateSQ($_POST[user_email]);
	$user_hp		= updateSQ($_POST[user_hp]);
	$user_id		= $_SESSION[member][id];
	if ($writer == "") {
		$writer		= $_SESSION[member][name];
	}
	
	if(!$hit)
		$hit =0;
//	$r_date			= $wYY."-".$wMM."-".$wDD." ".$wHH.":".$wII.":".$wSS;
	if ($wdate)
	{
		$r_date			= "'".$wdate."'";
	} else {
		$r_date			= "now()";
	}

for ($i=1;$i<=6;$i++)
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
	} elseif($_FILES["ufile".$i]['name'])
	{
		$wow=$_FILES["ufile".$i]['name'];
		if (no_file_ext($_FILES["ufile".$i]['name']) != "Y") {
			echo "NF";
			exit();
		}

		${"rfile_".$i}=$wow;
		$wow2=$_FILES["ufile".$i]['tmp_name'];//tmp 폴더의 파일
		${"ufile_".$i}=file_check($wow,$wow2,$upload,"N");
		if ($bbs_idx) {
				$sql = "
					UPDATE tbl_bbs_list SET 
					ufile".$i."='".${"ufile_".$i}."',
					rfile".$i."='".${"rfile_".$i}."'
					WHERE bbs_idx='$bbs_idx';
				";
				mysql_query($sql) or die (mysql_error());
		}
	}
}
	if ($mode == "reply") {
		$sql = "update tbl_bbs_list set b_step = b_step + 1 where b_ref = '$b_ref' and b_step > $b_step";
		mysql_query($sql) or die (mysql_error());
		$b_step	 = $b_step + 1;
		$b_level = $b_level + 1;

		$sql = "INSERT INTO tbl_bbs_list (subject, code, category, simple, writer, notice_yn, secure_yn, contents, reply, hit, user_id, url, ufile1, rfile1, ufile2, rfile2, ufile3, rfile3, ufile4, rfile4, ufile5, rfile5, ufile6, rfile6, ip_address, b_ref, b_step, b_level, recomm_yn, r_date)
				VALUES ('$subject', '$code', '$category', '$simple', '$writer', '$notice_yn', '$secure_yn', '$contents', '$reply', 0, '$user_id', '$url', '$ufile_1', '$rfile_1', '$ufile_2', '$rfile_2', '$ufile_3', '$rfile_3', '$ufile_4', '$rfile_4', '$ufile_5', '$rfile_5','$ufile_6', '$rfile_6', '".$_SERVER["REMOTE_ADDR"]."', '$b_ref', '$b_step', '$b_level', '$recomm_yn', $r_date);";
		$db = mysql_query($sql);

	} elseif ($bbs_idx) {
		$sql = "update tbl_bbs_list set subject='$subject', hit='$hit', simple='$simple', s_date='$s_date', e_date='$e_date', secure_yn='$secure_yn', category='$category', contents='$contents', reply='$reply', notice_yn = '$notice_yn'";
		if ($wdate)
		{
			$sql = $sql.",  r_date = $r_date ";
		}
		$sql = $sql.",  recomm_yn = '$recomm_yn', url='$url' where bbs_idx='$bbs_idx'";
		$db = mysql_query($sql);
	} else {
		$total_sql	= " select ifnull(max(bbs_idx),0)+1 as maxbbs_idx from tbl_bbs_list";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);
		$b_ref		= $row[maxbbs_idx];

		$sql = "INSERT INTO tbl_bbs_list (subject, simple, s_date, e_date, code, category, country_code, writer, notice_yn, secure_yn, contents, reply, hit, user_id, url, ufile1, rfile1, ufile2, rfile2, ufile3, rfile3, ufile4, rfile4, ufile5, rfile5, ufile6, rfile6, ip_address, b_ref, b_step, b_level, recomm_yn, r_date,email,user_hp)
				VALUES ('$subject', '$simple', '$s_date', '$e_date', '$code', '$category',  '', '$writer', '$notice_yn', '$secure_yn', '$contents', '$reply', $hit, '$user_id', '$url', '$ufile_1', '$rfile_1', '$ufile_2', '$rfile_2', '$ufile_3', '$rfile_3', '$ufile_4', '$rfile_4', '$ufile_5', '$rfile_5', '$ufile_6', '$rfile_6',  '".$_SERVER["REMOTE_ADDR"]."', '$b_ref', 0, 0, '$recomm_yn', $r_date, '$user_email', '$user_hp');";
		$db = mysql_query($sql);
	}

	if ($db) {
		echo "OK";
		mysql_query("COMMIT");
	} else {        
		//rollback
		mysql_query("ROLLBACK");
		echo "NO";
	}
?>
