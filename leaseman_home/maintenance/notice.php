<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>	
	
	<section id="container" class="sub notice">
		<? include('community.inc.php');?>	
		<div class="sub_content">
			<div class="wrap_1200">
				<div class="sc_top">
					<h2 class="sc_tit">공지사항</h2>
					<p class="sc_txt">153포인츠에서 고객님께 알려드립니다.</p>
				</div>
				<div class="board_list">
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
						</tbody>
					</table>
					<? if ($nPage > 1) { ?>
					<div class="btn_wrap">
						<a href="javascript:get_list()" class="more">더보기</a>
					</div>
					<? } ?>
				</div>
			</div>
		</div>
	</section>
<script>
	var pg = 1;
	function get_list()
	{
		pg = pg + 1;
        $.ajax({
			url: "get_notice.php",
			type: "GET",
			data: "search_name=<?=$search_name?>&sido=<?=$sido?>&gugun=<?=$gugun?>&pg="+pg,
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				//alert(response);
				$(".body_list").append(response);

			}
        });
	}
</script>
<? include('../inc/footer.inc.php');?>	