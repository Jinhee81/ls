<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>		
	<section id="container" >	
		<? include('cs_inc.php');?>		
		<div class="wrap_1000">
			<div class="sub_tit">
				<h2><span class="stm_active">공지사항</span></h2>
			</div>
			<div class="sc_top">
				
			</div>
			<div class="board_list">
			<? 
				$code			= "notice";
				$scategory		= updateSQ($_GET['scategory']);
				$search_word	= updateSQ($_GET['search_word']);
				$search_mode	= updateSQ($_GET['search_mode']);
				$is_category	= isBoardCategory($code);
				$g_list_rows	= 10;
				if ($search_word != "") {
					if ($search_mode != "") {
						$strSql = " and ".$search_mode." like '%".$search_word."%' ";
					} else {
						$strSql = " and (subject like '%".$search_word."%' or contents like '%".$search_word."%') ";
					}
				}
				if ($scategory != "") {
					$strSql = $strSql." and category = '".$scategory."'";
				}
				$strSql = $strSql." and code = '$code'";
				$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt from tbl_bbs_list where 1=1 ".$strSql;
				
				$result = mysql_query($total_sql) or die (mysql_error());
				$nTotalCount = mysql_num_rows($result);
			?>

				<form method=" " name=" " class="search-box">
					<fieldset>
						<legend>게시판 검색</legend>
						<select name="search_mode" id="">
							<option value="subject" <? if ($search_mode == "subject"){echo "selected"; } ?>>제목</option>
							<option value="contents" <? if ($search_mode == "contents"){echo "selected"; } ?>>내용</option>
						</select>
						<input type="text"  id="search_word" name="search_word" value="<?=$search_word?>" class="search-txt" placeholder="검색어를 입력해주세요.">
						<button type="submit" class="btn-search"><img src="/img/sub/btn_search_icon.png" alt="검색" /></button>
					</fieldset>
				</form>
				<table class="ta_list">
					<colgroup>
						<col class="num">
						<col class="subject">
						<col class="date">
						<col class="view_num">
					</colgroup>
					<thead>
						<tr>
							<th class="num">번호</th>
							<th class="subject">제목</th>
							<th class="date">작성일</th>
							<th class="view_num">조회</th>
						</tr>
					</thead>
					<tbody class="body_list">
						<?
							$nPage = ceil($nTotalCount / $g_list_rows);
							if ($pg == "") $pg = 1;
							$nFrom = ($pg - 1) * $g_list_rows;

							$sql    = $total_sql . " order by  notice_yn desc,  b_ref desc, b_step asc  limit $nFrom, $g_list_rows ";

							$result = mysql_query($sql) or die (mysql_error());
							$num = $nTotalCount - $nFrom;
							while($row=mysql_fetch_array($result)){
								if ($row['notice_yn'] == "Y") {
									$nClass="notice_bg";
									$nums = "<span>공지</span>";
								} else {
									$nClass="";
									$nums = $num;
								}
								$newStr = "";
								if (listNew(48, $row['r_date']) ==0) {
									$newStr = "<img src=\"/img_board/new.gif\" alt=\"new\">";
								}
								$file_chk = "N";
								for ($i=1;$i<=5;$i++) {
									if ($row["bfile".$i]) {
										$file_chk = "Y";
									}
								}
								$c_cnt = "";
								if ($row['comment_cnt'] > 0) {
									$c_cnt = "(".$row['comment_cnt'].")";
								}
								$rstr = "";
								for ($a=0 ; $a < $row['b_level']*3; $a++)
								{
									$rstr = $rstr."&nbsp;";
								}
								$rstr2 = "";
								if ($row['b_level'] > 0) {
									//$rstr2 = $rstr2."<img src='/_images/common/recomment.png'>&nbsp;";
								}

								$secureStr = "";
								if ($row['secure_yn'] == "Y") {
									$secureStr = "&nbsp;<img src='/_images/contents/lock_icon.png'>";
								} else {
									$secureLink = "";
								}
						?>

						<tr>
							<td class="num"><?=$nums?></td>
							<td class="subject">
								<a href="notice_view.php?mode=view&bbs_idx=<?=$row['bbs_idx']?><?=$secureLink?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="over_txt"><?=$row['subject']?></a>
							</td>
							<td class="date"><?=substr($row['r_date'],0,10)?></td>
							<td class="view_num"><?=$row['hit']?></td>
						</tr>
						<? 
							$num = $num - 1;
						} ?>
					</tbody>
				</table>
				<div class="pager">
					<ul class="pagination">
					<?echo ipageListing2($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?scategory=$scategory&search_mode=".$search_mode."&search_word=".$search_word."&code=".$code."&pg=")?>
						<!-- <li><a href="javascript: go_page(1);"><img src="/img/btn/pagerLL.png" alt=""></a></li>
						<li><a href="javascript: go_page(1);"><img src="/img/btn/pagerL.png" alt=""></a></li>
								<li class="num active"><a href="javascript: go_page(1);">1</a></li>
								<li class="num "><a href="javascript: go_page(2);">2</a></li>
								<li class="num "><a href="javascript: go_page(3);">3</a></li>
								<li class="num "><a href="javascript: go_page(4);">4</a></li>
								<li class="num "><a href="javascript: go_page(5);">5</a></li>
								<li class="num "><a href="javascript: go_page(6);">6</a></li>
								<li class="num "><a href="javascript: go_page(7);">7</a></li>
								<li class="num "><a href="javascript: go_page(8);">8</a></li>
								<li class="num "><a href="javascript: go_page(9);">9</a></li>
								<li class="num "><a href="javascript: go_page(10);">10</a></li>
								<li><a href="javascript: go_page(11);"><img src="/img/btn/pagerR.png" alt=""></a></li>
						<li><a href="javascript: go_page(24);"><img src="/img/btn/pagerRR.png" alt=""></a></li> -->
					</ul>
				</div>
			</div>
		</div>
	</section>
<? include('../inc/footer.inc.php');?>	