<?
					$code			= updateSQ($code);
					$scategory		= updateSQ($_GET[scategory]);
					$search_word	= updateSQ($_GET[search_word]);
					$search_mode	= updateSQ($_GET[search_mode]);
					$is_category	= isBoardCategory($code);
					$g_list_rows = 12;
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
					$total_sql = " select * from tbl_bbs_list where 1=1 ".$strSql;
					$result = mysql_query($total_sql) or die (mysql_error());
					$nTotalCount = mysql_num_rows($result);
				?>

				<div class="search_wrap">
					<form name=sfrm>
						<fieldset>
							<legend>이벤트</legend>
							<select class="select1" name="search_mode"  title="검색구분 선택">
								<option value="subject" <? if ($search_mode == "subject"){echo "selected"; } ?>>제목</option>
								<option value="simple" <? if ($search_mode == "simple"){echo "selected"; } ?>>간략설명</option>
								<option value="contents" <? if ($search_mode == "contents"){echo "selected"; } ?>>내용</option>
							</select>
							<input type="text"  id="search_word" name="search_word" value="<?=$search_word?>" placeholder="검색어를 입력해주세요" onclick="this.placeholder=''" onblur="this.placeholder='검색어를 입력해주세요'" onfocus="this.placeholder=''">
							<button type="button" onclick="javascript:document.sfrm.submit();">검색하기</button>
						</fieldset>
					</form>
				</div>



				<div class="event_list">
					<ul class="event_listul">
					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;

						$sql    = $total_sql . " order by  notice_yn desc,  b_ref desc, b_step asc  limit $nFrom, $g_list_rows ";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						while($row=mysql_fetch_array($result)){
							if ($row[notice_yn] == "Y") {
								$nClass="noti_wrap";
								$nClass2="noti_bedge";
								$nums = "공지";
							} else {
								$nClass="";
								$nClass2="noti_num";
								$nums = $num;
							}
							$newStr = "";
							if (listNew(48, $row[r_date]) ==0) {
								$newStr = "<img style='margin-left:10px;' src=\"/img_board/new.gif\" alt=\"new\">";
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

								if ($row["ufile6"]) {
									$img = get_img($row["ufile6"], "/data/bbs/", 413, 207);
								} else {
									$img = getConImg(viewSQ($row["contents"]));
								}
								if ($img == "")
								{
									$img = "/_images/contents/gallery_no_img.png";
								}
							$e_date		= $row[e_date];
							if ($e_date == "")
							{
								$e_date = "계속";
							}
					?>

						<li>
							
							<div class="event_ig">
								<img src="<?=$img?>" alt="맛있는 요리준비"><!-- 331 x 240 사이즈 -->
							</div>
							<div class="event_txt">
								<p class="date"><?=$row[s_date]?> ~ <?=$e_date?></p>
								<a href="<?=$_SERVER[PHP_SELF]?>?mode=view&bbs_idx=<?=$row[bbs_idx]?><?=$secureLink?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" title="<?=$row[subject]?>" class="link_txt">
									<h3><?=$row[subject]?></h3>
									<p class="here_txt"><?=$row[simple]?></p>
								</a>
								<? 
								if ($row["s_date"] > date("Y-m-d")) { ?>
								<p class="how_txt off"><span>진행</span>예정</p>
								<? } elseif ($row["s_date"] <= date("Y-m-d") && $row["e_date"] >= date("Y-m-d")) { ?>
								<p class="how_txt on">진행중</p>
								<? } elseif ($row["e_date"] < date("Y-m-d")) { ?>
								<p class="how_txt off"><span>진행</span>마감</p>
								<? } ?>
							</div>
						</li>
							


					<?
						$num = $num - 1;
						}
					?>
		</ul>
	</div>
	<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=")?>
				
