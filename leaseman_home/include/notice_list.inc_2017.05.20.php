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


				<div class="search_wrap">
					<form name=sfrm>
						<fieldset>
							<legend>이벤트</legend>
							<select class="select1" name="search_mode"  title="검색구분 선택">
								<option value="subject" <? if ($search_mode == "subject"){echo "selected"; } ?>>제목</option>
								<option value="contents" <? if ($search_mode == "contents"){echo "selected"; } ?>>내용</option>
							</select>
							<input type="text"  id="search_word" name="search_word" value="<?=$search_word?>" placeholder="검색어를 입력해주세요" onclick="this.placeholder=''" onblur="this.placeholder='검색어를 입력해주세요'" onfocus="this.placeholder=''">
							<button type="button" onclick="javascript:document.sfrm.submit();">검색하기</button>
						</fieldset>
					</form>
				</div>
				<div class="notice_tb">
					<table>
						<caption>공지사항</caption>
						<colgroup>
							<col width="92px">
							<col width="713px">
							<col width="87px">
							<col width="108px">
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>제목</th>
								<th>등록일</th>
								<th>조회수</th>
							</tr>
						</thead>
						<tbody>
							<?
								$nPage = ceil($nTotalCount / $g_list_rows);
								if ($pg == "") $pg = 1;
								$nFrom = ($pg - 1) * $g_list_rows;

								$sql    = $total_sql . " order by  notice_yn desc,  b_ref desc, b_step asc  limit $nFrom, $g_list_rows ";
								$result = mysql_query($sql) or die (mysql_error());
								$num = $nTotalCount - $nFrom;
								while($row=mysql_fetch_array($result)){
									if ($row[notice_yn] == "Y") {
										$nClass="notice_bg";
										$nums = "공지";
									} else {
										$nClass="";
										$nums = $num;
									}
									$newStr = "";
									if (listNew(48, $row[r_date]) ==0) {
										$newStr = "<img src=\"/img_board/new.gif\" alt=\"new\">";
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
									$rstr = "";
									for ($a=0 ; $a < $row[b_level]*3; $a++)
									{
										$rstr = $rstr."&nbsp;";
									}
									$rstr2 = "";
									if ($row[b_level] > 0) {
										//$rstr2 = $rstr2."<img src='/_images/common/recomment.png'>&nbsp;";
									}

									$secureStr = "";
									if ($row[secure_yn] == "Y") {
										$secureStr = "&nbsp;<img src='/_images/contents/lock_icon.png'>";
									} else {
										$secureLink = "";
									}
							?>
					
							<tr>
								<td class="number"><span>[</span><?=$nums?><span>]</span></td>
								<td class="name_txt"><a href="<?=$_SERVER[PHP_SELF]?>?mode=view&bbs_idx=<?=$row[bbs_idx]?><?=$secureLink?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="over_txt"><?=$row[subject]?></a></td>
								<td class="date_txt"><?=str_replace("-",".",substr($row[r_date],0,10))?></td>
								<td class="counter"><?=$row[hit]?></td>
							</tr>
							<?
								$num = $num - 1;
								}
							?>
							
						</tbody>
					</table>
				</div>
				<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=")?>

					

				
