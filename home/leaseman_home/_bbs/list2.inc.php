				<div class="qna_list_box">
					<? $orderStr =" bbs_idx asc, ";
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
						<div class="qna_list_wrap">
							<div class="qna_list_content" style="display:block;">
								<ul class="qna_list">
									<li class="">
										<p class="qna_subject"><?=$row['subject']?></p>
										<div class="qna_cont"><?=viewSQ($row['contents'])?></div>
									</li>
								</ul>
							</div>
						</div>
						
						<?
						$num = $num - 1;
							}
						?>
					
			</div>
			<?echo ipagelisting2($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?scategory=$scategory&search_mode=".$search_mode."&search_word=".$search_word."&code=".$code."&pg=")?>

<script type="text/javascript">
$(document).ready(function(){
	$("#gnb > ul > li").eq(3).removeClass("active");
	$("#gnb > ul > li").eq(1).addClass("active");
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$(".qna_cont").slideUp();
	$(".qna_list> li >.qna_subject").click(function(){
		var $con = $(this).parent(".qna_list > li").find(".qna_cont");
		if($con.is(":visible")) {
			$con.slideUp();
			$(".qna_list > li").removeClass("active");
			$(".qna_list > li > .qna_subject").removeClass("on");
		} else {
			$(".qna_list >li .qna_cont:visible").slideUp();
			$(".qna_list > li").removeClass("active");
			$(".qna_list > li > .qna_subject").addClass("on");
			$(this).parent(".qna_list > li").addClass("active");
			$con.slideDown();
			}
		});
	});
</script>