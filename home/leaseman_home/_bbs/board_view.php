<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<?
	include $_SERVER[DOCUMENT_ROOT]."/include/bbs_info.inc.php"; 
	$writer			= $_SESSION[member][name];
	$search_mode	= updateSQ($_GET[search_mode]);
	$search_word	= updateSQ($_GET[search_word]);
	$pg				= updateSQ($_GET[pg]);
	$bbs_idx		= updateSQ($_GET[bbs_idx]);
	$wDate			= date("Y-m-d H:i:s", time());
	$hit			= 0;
	//echo $_SERVER[DOCUMENT_ROOT].'/data/editor/';

	$mode			= updateSQ($_GET[mode]);

	$titleStr = "등록";
	$cnt = 0;
	if ($mode == "reply"){
		$total_sql	= " select * from tbl_bbs_list where bbs_idx='".$bbs_idx."'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);
		$subject	= "[re]".$row[subject];
		$contents	= "-------------------- 원본글 -------------------- <br>".$row[contents];
		$b_step		= $row[b_step];
		$b_level	= $row[b_level];
		$b_ref		= $row[b_ref];
		$secure_yn	= $row[secure_yn];
		$mode		= "reply";
	} elseif ($bbs_idx) {
		$count_sql ="update tbl_bbs_list set hit =hit+1 where bbs_idx ='".$bbs_idx."'";
		mysql_query($count_sql);
		$total_sql	= " select * from tbl_bbs_list where bbs_idx='".$bbs_idx."'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);
		$writer		= $row[writer];
		$hit		= $row[hit];
		$subject	= $row[subject];
		$simple		= $row[simple];
		$s_date		= $row[s_date];
		$e_date		= $row[e_date];
		if ($e_date == "")
		{
			$e_date = "계속";
		}
		$notice_yn	= $row[notice_yn];
		$secure_yn	= $row[secure_yn];
		$recomm_yn	= $row[recomm_yn];
		$contents	= $row[contents];
		$reply		= $row[reply];
		$category	= $row[category];
		$url		= $row[url];
		$cnt		= 0;
		$ufile1		= $row[ufile1];
		$rfile1		= $row[rfile1];

		$ufile2		= $row[ufile2];
		$rfile2		= $row[rfile2];

		$ufile3		= $row[ufile3];
		$rfile3		= $row[rfile3];

		$ufile4		= $row[ufile4];
		$rfile4		= $row[rfile4];

		$ufile5		= $row[ufile5];
		$rfile5		= $row[rfile5];

		$ufile6		= $row[ufile6];
		$rfile6		= $row[rfile6];
		$wDate		= $row[r_date];

		$file_check =false;
		if ($ufile1 != "")
		{
		$cnt		= $cnt + 1;
		$file_check =true;
		}
		if ($ufile2 != "")
		{
		$cnt		= $cnt + 1;
		$file_check =true;
		}
		if ($ufile3 != "")
		{
		$cnt		= $cnt + 1;
		$file_check =true;
		}
		if ($ufile4 != "")
		{
		$cnt		= $cnt + 1;
		$file_check =true;
		}
		if ($ufile5 != "")
		{
		$cnt		= $cnt + 1;
		$file_check =true;
		}
		if ($cnt < 1) {
		$cnt		= 1;
		}
	} else {
		$cnt		= 1;
	}

	if ($writer	== "") 
	{
		$writer = "관리자";
	}

	$class_name ="";
	if($code == "h_after" ||$code == "h_qna")
		$class_name="one";
	else if($code =="c_movie")
		$class_name ="movie";
?>
<script src="/js/jquery.form.js"></script>
	<style type="css/text">
	.hidden_class{display:none}
	</style>
		<section id="container">
			<? include_once $_SERVER[DOCUMENT_ROOT].$nav;?>
			<div class="wrap_1000">
				<div class="sub_visual <?=$visual_class?>">
					<h2><?=getBoardName($code)?></h2>
					<b><?=$info_txt1?></b>
					<p><?=$info_txt2?>
					<br /><?=$info_txt3?></b>
				</div>
				
				<? 
				if($code =="h_after")
					include "./view2.inc.php"; 
				else if($code =="h_movie")
					include "./view3.inc.php"; 
				else
					include "./view.inc.php"; 
				?>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->	
<script>
 	function search_it()
	{
		var frm = document.frmSearch;
		if (frm.search_word.value == "검색어 입력")
		{
			frm.search_word.value = "";
		}
		frm.submit();
	}
</script>