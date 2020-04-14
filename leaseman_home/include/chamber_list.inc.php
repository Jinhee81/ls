			<?
					$code			= updateSQ($code);
					$scategory		= updateSQ($_GET[scategory]);
					$search_word	= updateSQ($_GET[search_word]);
					$search_mode	= updateSQ($_GET[search_mode]);
					$is_category	= isBoardCategory($code);
					$g_list_rows = 10;
					if ($search_word != "") {
						
						$strSql = " and (subject like '%$search_word%' or contents like '%$search_word%') ";
						
					}
					if ($scategory != "") {
						$strSql = $strSql." and category = '$scategory'";
					}
					$strSql = $strSql." and code = '$code'";
					$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt from tbl_bbs_list where 1=1 ".$strSql;
					$result = mysql_query($total_sql) or die (mysql_error());
					$nTotalCount = mysql_num_rows($result);
				?>






				<div class="search_st01">
					<form name=sfrm>
						<fieldset>
							<legend>검색 조회 양식</legend>
							<div class="boxs">
								<input type="text"  id="search_word" name="search_word" value="<?=$search_word?>" placeholder="검색어를 입력해주세요.">
								<button type="submit" class="btn_st01">검색</button>
							</div>
						</fieldset>
					</form>
				</div>


				<div class="com_tb01">
					<table>
						<caption>자료실관리 표</caption>
						<colgroup>
							<col width="50px">
							<col width="auto">
							<col width="75%">
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>분류</th>
								<th>내용</th>
								<th>Download</th>
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
								<td><?=$nums?></td>
								<td><?=$row[category]?></td>
								<td>
									<a href="<?=$_SERVER[PHP_SELF]?>?mode=view&bbs_idx=<?=$row[bbs_idx]?><?=$secureLink?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="over_txt"><?=$row[subject]?></a>
								</td>
								<td>
									<? if ($ufile1 != "") { ?>
										<a href="/include/dn.php?mode=bbs&ufile=<?=$ufile1?>&rfile=<?=$ufile1?>" download>Download <img src="../img/main/download_icon.png" alt="첨부파일" style="width:22px;margin-top:-3px;"></a>
									<? } ?>									


									


								</td>
							</tr>
						<?
							$num = $num - 1;
							}
						?>

						</tbody>
					</table>
				</div>
				
				<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=")?>
