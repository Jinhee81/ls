<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<?
	$code			= "notice";
	$scategory		= updateSQ($_GET['scategory']);
	$search_word	= updateSQ($_GET['search_word']);
	$search_mode	= updateSQ($_GET['search_mode']);
	$is_category	= isBoardCategory($code);

	$g_list_rows	= 12;

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
	$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt from tbl_bbs_list where 1=1 ".$strSql;

	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);
?>
		<section id="container">
			<div class="sub_visual">
				<ul>
					<li>
						<img src="../img/sub/sub_visual_img01.png" width ="100%" alt="서브 비쥬얼 이미지">
					</li>
				</ul>
			</div>
			<div class="sub_visual one">
				<ul>
					<li>
						<img src="../img/mobile/sub_visual_img01.png" width ="100%" alt="서브 비쥬얼 이미지">
					</li>
				</ul>
			</div>
			<div class="wrap_1000 one">
				<div class="sub_tit">
					<h2>뉴스 & 공지사항</h2>
					<span>뉴스 & 공지사항 안내입니다.</span>
				</div>
			<fieldset>
				<div class="news_table">
					<table>
						<caption> 공지사항 </caption>
						<colgroup>
							<col width="6%">
							<col width>
							<col width="12%">
							<col width="8%">
						</colgroup>
						<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>날짜</th>
							<th>조회</th>
						</tr>
						</thead>
						<tbody>
							<?
									$nPage = ceil($nTotalCount / $g_list_rows);
									if ($pg == "") $pg = 1;
									$nFrom = ($pg - 1) * $g_list_rows;

									$sql    = $total_sql . " order by $orderStr notice_yn desc,  b_ref desc, b_step asc limit $nFrom, $g_list_rows ";

									$result = mysql_query($sql) or die (mysql_error());
									$num = $nTotalCount - $nFrom;

										while($row=mysql_fetch_array($result)){

											if ($row[notice_yn] == "Y") {
												$nums = "Notice";
											} else {
												$nums = $num;
											}
											$newStr = "";
											if (listNew(24, $row[r_date]) ==0) {
												$newStr = "<img src=\"/img_board/new.gif\" style=\"margin:1px 3px 0 5px;\" alt=\"신규게시물\" />";
											}

											$recStr = "";
											if ($row[recomm_yn] == "Y") {
												$recStr = "<font color=red>[추천]</font>";
											}
											$file_chk = "N";
											for ($i=1;$i<=5;$i++) {
												if ($row["rfile".$i]) {
													$file_chk = "Y";
												}
											}
										$img = "";
										$url = "";
										$youtubes		= explode("https://youtu.be/",$row[url]);
										$youtube_codes	= explode("?",$youtubes[1]);
										$youtube_code	= $youtube_codes[0];
										if ($row["ufile6"]) {
											if (substr(strtolower($row["ufile6"]),-3) == "jpg" || substr(strtolower($row["ufile6"]),-3) == "png" || substr(strtolower($row["ufile6"]),-3) == "gif" ) {
												$img = get_img($row["ufile6"], "/data/bbs/", 235, 235);
											}
										} elseif ($row["ufile1"]) {
											if (substr(strtolower($row["ufile1"]),-3) == "jpg" || substr(strtolower($row["ufile1"]),-3) == "png" || substr(strtolower($row["ufile1"]),-3) == "gif" ) {
												$img = get_img($row["ufile1"], "/data/bbs/", 229, 232);
											}
										} else {
											$img = getConImg(str_replace("","",viewSQ($row["contents"])));
										}

									?>
							<tr>
								<td>1</td>
								<td><a href="./news_view.php?code=<?=$code?>&bbs_idx=<?=$row['bbs_idx']?>&pg=<?=$pg?>"><?=$row['subject']?></a></td>
								<td><?=substr($row['r_date'],0,10)?></td>
								<td><?=$row['hit']?></td>
							</tr>
							<?}?>


						</tbody>
					<table>
					</fieldset>
				</div>
				<div class="paging">
					<ul class="page">
						<?echo ipageListing2($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?scategory=$scategory&search_mode=".$search_mode.$cate1.$cate2."&search_word=".$search_word."&code=".$code."&pg=")?>
					</ul>
				</div>
			</div>
		</section><!-- //container End -->
	<? include('../inc/footer.common.inc.php');?>

	</div><!--wrap_end-->
</body>
</html>
