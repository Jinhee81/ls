<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 
?>
			<?
					$code			= "notice";
					$scategory		= updateSQ($_GET[scategory]);
					$search_word	= updateSQ($_GET[search_word]);
					$search_mode	= updateSQ($_GET[search_mode]);
					$is_category	= isBoardCategory($code);
					$g_list_rows	= 10;
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
								<td class="num"><?=$nums?></td>
								<td class="subject">
									<a href="notice_view.php?mode=view&bbs_idx=<?=$row[bbs_idx]?><?=$secureLink?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="over_txt"><?=$row[subject]?></a>
								</td>
								<td class="date"><?=substr($row[r_date],0,10)?></td>
								<td class="view_num"><?=$row[hit]?></td>
							</tr>
							<? 
								$num = $num - 1;
							} ?>


<?
	if ($pg >= $nPage)
	{
?>
	<script>
	$(".btn_wrap").hide();	
	</script>
<?
	}
?>