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
					$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt from tbl_bbs_list where user_id='".$_SESSION[customer][id]."' ".$strSql;
					$result = mysql_query($total_sql) or die (mysql_error());
					$nTotalCount = mysql_num_rows($result);
				?>







				<div class="com_btn_box">
					<div class="right">
						<button type="button" class="blue_btn wd_70 pops_11btn">문의하기</button>
					</div>
				</div>

				<div class="com_tb01">
					<table>
						<caption>1:1질문관리</caption>
						<colgroup>
							<col width="50px">
							<col width="auto">
							<col width="75%">
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>유형</th>
								<th>질문</th>
								<th>상태</th>
								<th>등록일</th>
							</tr>
						</thead>
						<tbody>

						<?
							$nPage = ceil($nTotalCount / $g_list_rows);
							if ($pg == "") $pg = 1;
							$nFrom = ($pg - 1) * $g_list_rows;

							$sql    = $total_sql . " order by  notice_yn desc,  b_ref desc, b_step asc, r_date desc  limit $nFrom, $g_list_rows ";
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
								<td><?=$nums?></td>
								<td><a href="bmg_que_view.php"><?=$row[category]?></a></td>
								<td><a href="<?=$_SERVER[PHP_SELF]?>?mode=view&bbs_idx=<?=$row[bbs_idx]?><?=$secureLink?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="over_txt"><?=$row[subject]?></a></td>
								<td>
								<?
								if($row[reply]==""){
									echo "답변대기";
								}else{
									echo "답변완료";
								}
								?>
								</td>
								<td><?=str_replace("-",".",substr($row[r_date],0,10))?></td>
							</tr>

						<?
							$num = $num - 1;
							}
						?>
							
						</tbody>
					</table>
				</div>
				
				<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=")?>

