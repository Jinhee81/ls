						<form name=lfrm id=lfrm>
						<ul class="gallery-wrap" style="text-align:center;width:1500px; margin: 0 auto; }">
					
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
							<li class="gallery-list" style="width:280px">
								<a href="board_view.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&bbs_idx=<?=$row[bbs_idx]?>&pg=<?=$pg?>">
									<p class="pic"  style="width:280px"><img src="<?=$img?>" alt="<?=$row[subject]?>"></p>
									<p class="pic-info">
										<input type="checkbox" id="" name="bbs_idx[]" value="<?=$row[bbs_idx]?>" class="bbs_idx input_check" />
										<?=$row[subject]?>
									</p>
								</a>
							</li>

							
							<?
							$num = $num - 1;
								}
							?>
					</ul>
					</form>