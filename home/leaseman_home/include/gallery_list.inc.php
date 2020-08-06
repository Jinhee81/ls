				<?
					$code			= updateSQ($code);
					$scategory		= updateSQ($_GET[scategory]);
					$search_word	= updateSQ($_GET[search_word]);
					$search_mode	= updateSQ($_GET[search_mode]);
					$is_category	= isBoardCategory($code);
					$g_list_rows = 8;
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

					<form name=sfrm>
					<div class="sub_search_box">
						<select class="select1" name="search_mode"  title="검색구분 선택">
							<option value="subject" <? if ($search_mode == "subject"){echo "selected"; } ?>>제목</option>
							<option value="contents" <? if ($search_mode == "contents"){echo "selected"; } ?>>내용</option>
						</select>
						<input type="text"  id="search_word" name="search_word" value="<?=$search_word?>" placeholder="검색어를 입력해주세요"  class="search_box1">
						<button type="button" onclick="javascript:document.sfrm.submit();" title="검색" class="search_btn1"></button>
					</div>
					</form>

					<div class="table_wrap pt50">
						<div class="gallery_wrap">
							<ul class="gallery_list">
					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;

						$sql    = $total_sql . " order by  notice_yn desc,  b_ref desc, b_step asc  limit $nFrom, $g_list_rows ";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						$ii = 0;
						while($row=mysql_fetch_array($result)){
							if ($row[notice_yn] == "Y") {
								$nums = "<img alt=\"공지\" src=\"/img_board/icon_tit.gif\">";
							} else {
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
								if ($row["ufile6"]) {
									$img = get_img($row["ufile6"], "/data/bbs/", 268, 194);
								} else {
									$img = getConImg(viewSQ($row["contents"]));
								}
								if ($img == "")
								{
									$img = "/_images/contents/gallery_no_img.png";
								}
					?>
								<li>
									<a  href="<?=$_SERVER[PHP_SELF]?>?mode=view&bbs_idx=<?=$row[bbs_idx]?><?=$secureLink?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" title="<?=$row[subject]?>">
										<div class="gallery_img"><img src="<?=$img?>"></div>
										<div class="gallery_title pt20"><?=strcut_utf8(strip_tags(viewSQ($row[subject])), 100, true, '..')?></div>
										<div class="gallery_date pt10"><?=str_replace("-",".",substr($row[r_date],0,10))?></div>
									</a>
								</li>


						<?
							$num = $num - 1;
							$ii = $ii + 1;
							}
						?>
							</ul>
						</div>
										
					</div><!--table_end-->

				<div class="pagings">
					<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=")?>
				</div>

				
