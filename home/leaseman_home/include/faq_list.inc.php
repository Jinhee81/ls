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

				<div class="tblList-top">
					<p class="total">전체 <?=$nTotalCount?>개의 게시글이 있습니다.</p>
					<form name=sfrm>
					<fieldset class="cSearch">
						<legend>검색</legend>
						<select  id="search_mode" name="search_mode" class="select" style="width:138px;" title="검색구분 선택">
							<option value="subject" <? if ($search_mode == "subject") {echo "selected"; } ?>>제목</option>
							<option value="contents" <? if ($search_mode == "contents") {echo "selected"; } ?>>내용</option>
						</select>
						<div class="text-guard">
							<input type="text" id="search_word" name="search_word" value="<?=$search_word?>"  placeholder="검색어를 입력해주세요" style="width:224px;" class="text">
							<a href="javascript:document.sfrm.submit();" class="btn-35 btn-gray">검색</a>
						</div>
					</fieldset>
					</form>
				</div>
				

				<ul class="faq">
					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;

						$sql    = $total_sql . " order by  notice_yn desc,  b_ref desc, b_step asc  limit $nFrom, $g_list_rows ";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						if ($nTotalCount == 0) {
					?>
					<li style="height:200px;line-height:200px;text-align:center;">
						검색결과가 없습니다.
					</li>
					<?
						}
						while($row=mysql_fetch_array($result)){
							if ($row[notice_yn] == "Y") {
								$str = "notice";
								$nums = "<img alt=\"공지\" src=\"/img_board/icon_tit.gif\">";
							} else {
								$str = "";
								$nums = $num;
							}
							$newStr = "";
							if (listNew(48, $row[r_date]) ==0) {
								$newStr = "<img src=\"/_images/common/icon_new.gif\"  alt=\"신규게시물\" />";
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
				<li>
					<div class="question">
						<strong><span class="icon_q">질문</span> <?=$row[subject]?> </strong>
					</div>
					<div class="answer closed">
						<span>A.</span> <?=viewSQ($row[contents])?>
					</div>
				</li>
					<?
						$num = $num - 1;
						}
					?>
			</ul>

				<div class="boardBottom" style="width:100%; margin:0 auto;">
						<? if ($_SESSION[member][level] == 1) { ?>
						<p class="fr btnList" style="clear:none"><a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&mode=write">글쓰기</a><span class="active"></span></p>
						<? } ?>
				</div>

					<div class="pagings">
						<ul>
						<?echo wpageListing($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=")?>
						</ul>
					</div><!-- //pagings -->
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