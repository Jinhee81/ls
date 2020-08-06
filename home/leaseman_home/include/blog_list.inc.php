<?
					$code			= updateSQ($code);
					$scategory		= updateSQ($_GET[scategory]);
					$search_word	= updateSQ($_GET[search_word]);
					$search_mode	= updateSQ($_GET[search_mode]);
					$is_category	= isBoardCategory($code);
					$g_list_rows = 10;
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
				<div class="tblList-top">
				<form name=sfrm>
					<p class="total">전체 <?=$nTotalCount?>개의 게시글이 있습니다.</p>
					<fieldset class="cSearch">
						<legend>검색</legend>
						<select class="select" name="search_mode" style="width:138px;" title="검색구분 선택">
							<option value="subject" <? if ($search_mode == "subject"){echo "selected"; } ?>>제목</option>
							<option value="contents" <? if ($search_mode == "contents"){echo "selected"; } ?>>내용</option>
						</select>
						<div class="text-guard">
							<input type="text"  id="search_word" name="search_word" value="<?=$search_word?>" placeholder="검색어를 입력해주세요" style="width:224px;" class="text" />
							<a href="javascript:document.sfrm.submit();" class="btn btn-gray">검색</a>
						</div>

					</fieldset>
				</form>
				</div>
				<div class="thumb-board">
					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;

						$sql    = $total_sql . " order by  notice_yn desc,  b_ref desc, b_step asc  limit $nFrom, $g_list_rows ";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						while($row=mysql_fetch_array($result)){
							if ($row[notice_yn] == "Y") {
								$str = "th";
								$nums = "<img alt=\"공지\" src=\"/img_board/icon_tit.gif\">";
							} else {
								$str = "td";
								$nums = $num;
							}
							$newStr = "";
							if (listNew(48, $row[r_date]) ==0) {
								$newStr = "<img src=\"/img_board/new.gif\" style=\"margin:1px 3px 0 5px;\" alt=\"신규게시물\" />";
							}
							$file_chk = "N";
							for ($i=1;$i<=5;$i++) {
								if ($row["bfile".$i]) {
									$file_chk = "Y";
								}
							}
							$c_cnt = "";
							if ($row[comment_cnt] > 0) {
								$c_cnt = "(".$row[comment_cnt].")";
							}
							$rstr = $row[b_level]*15;
							$rstr2 = "";
							if ($row[b_level] > 0) {
								$rstr2 = $rstr2."ㄴ";
							}

							$secureStr = "";
							if ($row[secure_yn] == "Y") {
								$secureStr = "<img src='/img_board/icon_key.gif'>";
								if ($_SESSION[member][level] == "0") {
									$secureLink = "";
								} else {
									$secureLink = "&smode=secure";
								}
							} else {
								$secureLink = "";
							}
							if ($row["ufile1"]) {
								$img = get_img($row["ufile1"], "/data/bbs/", 230, 150);
							} else {
								$img = getConImg(viewSQ($row["contents"]));
							}
							if ($img == "")
							{
								$img = "/_images/family/noimg_200120.jpg";
							}
					?>
				<div class="thumb-box">
					<a href="<?=$_SERVER[PHP_SELF]?>?mode=view&bbs_idx=<?=$row[bbs_idx]?><?=$secureLink?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>">
						<div class="info">
							<strong class="tit"><?=$row[subject]?></strong>
							<ul class="info-list"><li><?
								echo strip_tags(viewSQ($row[contents]));
							 ?></li>
							</ul>
						</div>
						<p class="pic">
							<img src="<?=$img?>">
						</p>
					</a>
				</div>

						<?
							$num = $num - 1;
							}
						?>
					</div>


				<div class="pagings">
					<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=")?>
				</div>
				<form name="vfrm" action="" method="post">
					<input type=hidden name="mode" value="view">
					<input type=hidden name="bbs_idx" name="bbs_idx" value="">
					<input type=hidden name="search_mode" value="<?=$search_mode?>">
					<input type=hidden name="search_word" value="<?=$search_word?>">
					<input type=hidden name="pg" value="<?=$pg?>">
					<input type=hidden name="pass" value="">
				</form>
				<script>
					function press_it(num)
					{
						if(event.keyCode == 13)
						{
							pass_it(num);
						}
					 }
					function pass_it(num)
					{
						if ($("#passwd_"+num).val() == "")
						{
							alert("패스워드를 입력하셔야 합니다.");
							return;
						}
						document.vfrm.bbs_idx.value = num;
						document.vfrm.pass.value = $("#passwd_"+num).val();
						document.vfrm.submit();
					}
				</script>
