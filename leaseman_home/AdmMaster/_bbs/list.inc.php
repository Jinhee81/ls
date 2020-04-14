					<div class="listBottom">
						<form name=lfrm id=lfrm>
						<table cellpadding="0" cellspacing="0" summary="" class="listTable schedule">
						<caption></caption>
						<colgroup>
						<col width="5%" />
						<col width="5%" />						
						<col width="*" />
						<? if ($skin != "faq") {?>
						<col width="10%" />		
						<? if ($skin == "chamber") {?>
						<col width="8%" />
						<?}?>
						<col width="12%" />
						<col width="7%" />
						<? } ?>
						<col width="7%" />
						</colgroup>
						<thead>
							<tr>
								<th>선택</th>
								<th>번호</th>
								<th>제목</th>
								 <? if ($skin != "faq") {?>
								<th>작성자</th>
								<? if ($skin == "chamber") {?>
								<th>첨부파일</th>
								<?}?>
								<th>작성일</th>
								<th>조회</th>
								<? } ?>
								<th>관리</th>
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
								$rstr = "";
								for ($i=1;$i<=$row[b_level];$i++) {
									$rstr = $rstr."&nbsp;&nbsp;";
								}
								if ($row[b_level] > 0) {
									$rstr = $rstr."ㄴ";
								}
								$c_cnt = "";
								if ($row[comment_cnt] > 0) {
									$c_cnt = "(".$row[comment_cnt].")";
								}
								$secureStr = "";
								if ($row[secure_yn] == "Y") {
									$secureStr = "<img src='/img_board/icon_key.gif'>";
								}
							?>
							<tr style="height:35px">
								<td><input type="checkbox" id="" name="bbs_idx[]" value="<?=$row[bbs_idx]?>" class="bbs_idx input_check" /></td>
								<td><?=$nums?></td>
								<td class="tal bold txt_black"><?=$rstr?><a href="board_view.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&bbs_idx=<?=$row[bbs_idx]?>&pg=<?=$pg?>">
										<? if ($is_category == "Y") { ?>
											<? if ($row[category] != "") {echo "[".$row[category]."]";} ?>
										<? } ?>
										<?=$recStr?> <?=$row[subject]?> <?=$secureStr?>
										<?=$c_cnt?>
										</a>
								</td>
								<? if ($skin != "faq") {?>
								<td class="bold"><?=$row[writer]?></td>

								<? if ($skin == "chamber") {?>
								<td>
									<? if ($file_chk == "Y") { ?>
									<img src="/AdmMaster/_images/content/icon_file.png" alt="파일" />
									<? } ?>
								</td>
								<?}?>
								<td><?=$row[r_date]?></td>
								<td><?=$row[hit]?></td>
								<? } ?>
								<td>
									<a href="board_write.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&bbs_idx=<?=$row[bbs_idx]?>&pg=<?=$pg?>"><img src="/AdmMaster/_images/common/ico_setting2.png" alt="설정" /></a> &nbsp;  
									<a href="javascript:del_chk('<?=$row[bbs_idx]?>')"><img src="/AdmMaster/_images/common/ico_error.png" alt="에러" /></a>
								</td>
							</tr>
							<?
							$num = $num - 1;
								}
							?>
						</tbody>
						</table>
						</form>
					</div><!-- // listBottom -->