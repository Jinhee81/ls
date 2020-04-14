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

				<div class="listBox02 mt20">
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
							$rstr = "";
							for ($a=0 ; $a < $row[b_level]*3; $a++)
							{
								$rstr = $rstr."&nbsp;";
							}
							$rstr2 = "";
							if ($row[b_level] > 0) {
								$rstr2 = $rstr2."ㄴ";
							}
							$rstr2 = $rstr.$rstr2;

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
					?>
					<a href="<?=$_SERVER[PHP_SELF]?>?mode=view&bbs_idx=<?=$row[bbs_idx]?><?=$secureLink?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>"><dl >
						<dt ><?=$rstr2?>
								<?=strcut_utf8($row[subject],68)?> 
								<?=$c_cnt?><?=$newStr?><?=$secureStr?></dt>
						<dd ><span class="date"><?=str_replace("-",".",substr($row[r_date],0,10))?></span></dd>
					</dl></a>
					<?
						$num = $num - 1;
						}
					?>
				</div>

					<? if ($code == "free") { ?>
						<p class="btnWrite mt20"><a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&mode=write">글작성</a></p>
					<? } else { ?>
						<? if ($_SESSION[member][level] == 1) { ?>
						<p class="btnWrite mt20"><a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&mode=write">글작성</a></p>
						<div class="clear"></div>
						<? } ?>
					<? } ?>
					<? if ($isReply == "Y") { ?>
						<div class="btnWrite">
							<a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&mode=write">글쓰기</a>
						</div>
					<? } else { ?>
						<? if ($_SESSION[member][level] == 1) { ?>
						<div class="btnWrite">
							<a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&mode=write">글쓰기</a>
						</div>
						<? } ?>
					<? } ?>


				<div class="paging" style="padding-top:20px">
					<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?search_mode=$search_mode&search_word=$search_word&pg=")?>
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


				
				<!-- 실콘텐츠 시작 //--> 