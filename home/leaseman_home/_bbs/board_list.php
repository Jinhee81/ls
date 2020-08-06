<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<style type="css/text">
	.hidden_class{display:none}
</style>
<?
	include $_SERVER[DOCUMENT_ROOT]."/include/bbs_info.inc.php"; 
	$scategory		= updateSQ($_GET[scategory]);
	$search_word	= updateSQ($_GET[search_word]);
	$search_mode	= updateSQ($_GET[search_mode]);
	$is_category	= isBoardCategory($code);
	if($code=="h_movie"){
		$g_list_rows = 12;
	}else{
		$g_list_rows = 10;
	}
	if ($search_word != "") {
		if ($search_mode != "") {
			$strSql = " and $search_mode like '%$search_word%' ";
		} else {
			$strSql = " and (subject like '%$search_word%' or contents like '%$search_word%') ";
		}
	}
	if ($scategory != "") {
		$strSql = $strSql." and category = '$scategory'";
	}
	$strSql = $strSql." and code = '$code'";
	$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt  from tbl_bbs_list where 1=1 ".$strSql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);

	$class_name ="";
	if($code == "h_after" ||$code == "h_qna"){
		$class_name="one";
	}
	else if($code =="c_movie"){
		$class_name ="movie";
	}
	
	
?>
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
				if ($skin == "gallery" || $skin == "media" || $skin == "event" )
				{
					include "./photo.inc.php"; 
				} else {
					if($code =="h_faq")
						include "./list2.inc.php"; 
					else
						include "./list.inc.php"; 
				}
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