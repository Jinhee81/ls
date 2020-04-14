						<div class="video">
							<ul>
							<?
							$orderStr =" bbs_idx asc, ";
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
								if ($row["ufile6"]) {
									$img = get_img($row["ufile6"], "/data/bbs/", 320, 150);
								} else {
									$img = getConImg(viewSQ($row["contents"]));
								}
								if ($img == "")
								{
									$img = "/_images/contents/gallery_no_img.png";
								}
							?>
								<li>
									<a href="board_view.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&bbs_idx=<?=$row[bbs_idx]?>&pg=<?=$pg?>">
										<div class="video_box">
										<img src="<?=$img?>" alt="<?=$row[subject]?>">
										</div>
										<div class="video_txt">
											<b><?=$row['subject']?></b>
											<!-- <p>리스맨 어디까지 사용해 봤니?</p> -->
											<span><?=str_replace("-",'.',substr($row['r_date'],0,10))?></span>
										</div>
									</a>
								</li>
							<?
							$num = $num - 1;
								}
							?>
								
							</ul>
						</div>
						<?echo ipagelisting2($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?scategory=$scategory&search_mode=".$search_mode."&search_word=".$search_word."&code=".$code."&pg=")?>