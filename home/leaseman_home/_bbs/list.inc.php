			<div class="notice <?=$class_name?>">
				<form NAME="frmSearch" Method="GET"  >
					<INPUT TYPE="hidden" NAME="code" VALUE="<?=$code?>">
					<INPUT TYPE="hidden" NAME="scategory" VALUE="<?=$scategory?>">
					<div class="input_notice">
						<select>
							<option name="search_mode" value="" <? if ($search_mode == "") {echo "selected";} ?>>전체</option>
							<option name="search_mode" value="subject" <? if ($search_mode == "subject") {echo "selected";} ?>>제목</option>
							<option name="search_mode" value="contents" <? if ($search_mode == "contents") {echo "selected";} ?>>내용</option>
						</select>
						<input type="text" name="search_word" value='<?=$search_word?>'/>
						<button type="button" onclick="search_it()">검색</button>
						<?if($isRight == "Y"){?>
						<!-- <b class="write_on">
							<a href="./board_write.php?code=<?=$code?>">
								글쓰기
							</a>
						</b> -->
						<?}?>
					</div>
				</form>
				<table>
					<legend><?=getBoardName($code)?></legend>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>작성일</th>
							<th>조회수</th>
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
								$nums = "공지";
							} else {
								$nums = $num;
							}
							$newStr = "";
							if (listNew(24, $row['r_date']) ==0) {
								$newStr = "<img src=\"/img_board/new.gif\" style=\"margin:1px 3px 0 5px;\" alt=\"신규게시물\" />";
							}

							$recStr = "";
							if ($row['recomm_yn'] == "Y") {
								$recStr = "<font color=red>[추천]</font>";
							}
							$file_chk = "N";
							for ($i=1;$i<=5;$i++) {
								if ($row["rfile".$i]) {
									$file_chk = "Y";
								}
							}
							$rstr = "";
							for ($i=1;$i<=$row['b_level'];$i++) {
								$rstr = $rstr."&nbsp;&nbsp;";
							}
							if ($row['b_level'] > 0) {
								$rstr = $rstr."ㄴ";
							}
							$c_cnt = "";
							if ($row['comment_cnt'] > 0) {
								$c_cnt = "(".$row['comment_cnt'].")";
							}
							$secureStr = "";
							if ($row['secure_yn'] == "Y") {
								$secureStr = "<img src='/img_board/icon_key.gif'>";
							}
						?>
						<tr>
							<td><?=$nums?></td>
							<td>
								<?=$rstr?>
								<a href="board_view.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&bbs_idx=<?=$row['bbs_idx']?>&pg=<?=$pg?>">
								<? if ($is_category == "Y") { ?>
									<? if ($row['category'] != "") {echo "[".$row['category']."]";} ?>
								<? } ?>
								<?=$recStr?> <?=$row['subject']?> <?=$secureStr?>
								<?=$c_cnt?>
								</a>
							</td>
							<td><?=str_replace("-",'.',substr($row['r_date'],0,10))?></td>
							<td><?=$row['hit']?></td>
						</tr>
						<?
						$num = $num - 1;
							}
						?>
					</tbody>
				</table>
			</div>
			<?echo ipagelisting2($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?scategory=$scategory&search_mode=".$search_mode."&search_word=".$search_word."&code=".$code."&pg=")?>
