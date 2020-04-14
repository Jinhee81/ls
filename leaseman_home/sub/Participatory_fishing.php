<? include_once('../inc/head.inc.php');?>
<? include_once('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}

	$code			= "event";
	$scategory		= updateSQ($_GET['scategory']);
	$search_word	= updateSQ($_GET['search_word']);
	$search_mode	= updateSQ($_GET['search_mode']);
	$is_category	= isBoardCategory($code);

	$g_list_rows	= 12;


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
<style>
	.hidden_class{display:none}
</style>
		<section id="container">
			<div class="sub_visual">
				<ul>
					<li>
						<img src="../img/sub/sub_visual_img01.png" width ="100%" alt="서브 비쥬얼 이미지">
					</li>
				</ul>
			</div>
			<div class="sub_visual one">
				<ul>
					<li>
						<img src="../img/mobile/sub_visual_img01.png" width ="100%" alt="서브 비쥬얼 이미지">
					</li>
				</ul>
			</div>
			<div class="wrap_1000 one">
				<div class="sub_tit">
					<h2>참여 낚시 카페</h2>
					<span>아빠 엄마 헌혈 이벤트 안내입니다</span>
				</div>
				<div class="sub_input">
					<form name="frmsearch" method="get">
						<input type="hidden" name="code" value="<?=$code?>">
						<input type="hidden" name="scategory" value="<?=$scategory?>">
						<select name="search_mode" id="search_mode">
							<option value="subject">제목</option>
							<!-- <option value="StatOne">진행</option>
							<option value="StatTwo">진행마감</option> -->
						</select>
						<input type="text" name="search_word" value="" placeholder="검색어를 입력해주세요">
						<b class="go_btn"><a href="#!">검색하기</a></b>
					</form>

				</div>
				<ul class="fishing_event">
					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;

						$sql    = $total_sql . " order by $orderStr notice_yn desc,  b_ref desc, b_step asc limit $nFrom, $g_list_rows ";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						$event_limit =0;
						$event_msg ="";
						$num_count ="";
						while($row=mysql_fetch_array($result)){
							//카운트 가져오기
							$sql_num ="
								select
									count(idx)as num,
									m_idx
								from tbl_inquiry
								where product_name ='".$row['bbs_idx']."'
								";
								$sql_num2 ="
									select
										m_idx
									from tbl_inquiry
									where product_name ='".$row['bbs_idx']."' and m_idx = '".$_SESSION['member']['idx']."'
									";
							$count_result =mysql_query($sql_num);
							$count_row =mysql_fetch_array($count_result);
							$num_count =$row['option_type'] -$count_row['num'];
							$count_result2 =mysql_query($sql_num2);
							$count_row2 =mysql_fetch_array($count_result2);

							if($is_member =="admin"){//관리자 신청하기 숨기기
								$hidd_class ="hidden_class";
							}

							//등록된 회원 idx
							if($_SESSION['member']['idx'] == $count_row2['m_idx']){
								$hidd_class ="hidden_class";
							}else{
								$hidd_class ="";
							}
							//등록된 회원 idx
							if($count_row['m_idx']){
								if($_SESSION['member']['idx'] == $count_row['m_idx']){
									$hidd_class ="hidden_class";
								}

							}else{
								//echo "신청가능";


							}


							$today =date('Ymd');
							$StartDay = str_replace("-","",$row['cate1']);
							$LastDay = str_replace("-","",$row['cate2']);
							if($today < $StartDay){
								//echo "이벤트 시작전입니다.";
								$event_limit =1;
								$event_msg ="준비중";
							}
							if($today >= $StartDay && $today <= $LastDay){
								//echo "이벤트 중입니다.";
								if($num_count ==0){
									$event_limit =3;
									$event_msg ="종료";
									$event_color ="gray";
								}else{
									$event_limit =2;
									$event_msg ="진행중";
									$event_color ="orage";
								}

							}
							if($today >= $StartDay && $today > $LastDay){
								//echo "이벤트 종료입니다.";
								$event_limit =3;
								$event_msg ="종료";
								$event_color ="gray";
							}

							if ($row['notice_yn'] == "Y") {
								$nums = "Notice";
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
							$img = "";
							//echo $row[url];
							$url = "";
							$youtubes		= explode("https://youtu.be/",$row[url]);
							$youtube_codes	= explode("?",$youtubes[1]);
							$youtube_code	= $youtube_codes[0];
					if ($row["ufile6"]) {
						if (substr(strtolower($row["ufile6"]),-3) == "jpg" || substr(strtolower($row["ufile6"]),-3) == "png" || substr(strtolower($row["ufile6"]),-3) == "gif" ) {
							$img = get_img($row["ufile6"], "/data/bbs/", 331, 204);
						}
					} elseif ($youtube_code != "")
					{
						$img = "http://img.youtube.com/vi/".$youtube_code."/hqdefault.jpg";
					} elseif ($row["ufile1"]) {
						if (substr(strtolower($row["ufile1"]),-3) == "jpg" || substr(strtolower($row["ufile1"]),-3) == "png" || substr(strtolower($row["ufile1"]),-3) == "gif" ) {
							$img = get_img($row["ufile1"], "/data/bbs/", 331, 204);
						}
					} else {
						$img = getConImg(str_replace("","",viewSQ($row["contents"])));
					}
				?>

					<li>
						<a href="./Participatory_fishing_view.php?bbs_idx=<?=$row['bbs_idx']?>&code=<?=$code?>"><img src="<?=$img?>" alt ="<?=$row['subject']?>"></a>
						<div>
							<h4><?=$row['company']?></h4>
							<span><?=$row['cate1']?> ~ <?=$row['cate2']?></span>
							<a href="./Participatory_fishing_view.php?bbs_idx=<?=$row['bbs_idx']?>&code=<?=$code?>">
								<h3><?=$row['subject']?><?if($event_limit==2){?><b style="color:#4280a3"> (남은신청수:<?=$num_count?>)</b><?}?></h3>
							</a>
							<p><?=nl2br(mb_substr($row['simple'],0,12,'utf-8'))?></p>
							<?if($event_limit ==2){//이벤트 기간일때만 신청하기 보이기?>
							<b class ="<?=$hidd_class?$hidd_class:"event_go_btn"?>" title_idx ="<?=$row['bbs_idx']?>">
								<a href="#!" >신청하기</a>
							</b>
							<?}?>
							<span class="<?=$event_color?> radius_span"><?=$event_msg?></span>
						</div>
					</li>
				<?}?>
				</ul>
				<div class="paging">
					<ul class="page">
					<?echo ipageListing2($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?scategory=$scategory&search_mode=".$search_mode.$cate1.$cate2."&search_word=".$search_word."&code=".$code."&pg=")?>
					</ul>
				</div>
			</div>
	<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->

</body>
</html>

<script>
	$(function(){
		$(".go_btn").click(function(){
			var search_text =$("input[name=search_word]").val();
			//var search_tab =$("#search_mode").val();
			if(search_text ==""){
				alert("검색어를 입력해주세요.");
				$("input[name=search_word]").focus();
			}else
				document.frmsearch.submit();
		});
		$(".event_go_btn").click(function(){
			var member = '<?=$is_member?>';
			if(!member){
				alert("로그인후 이용해 주세요");
				$("#open_on").trigger('click');
			}else{
				var event_idx =$(this).attr('title_idx');
				event_submit(event_idx);
			}
		});

		//event 신청하기
		function event_submit(event_idx){
			$.ajax({
					url: "./event_add.php",
					type: "POST",
					data: "bbs_idx="+event_idx,
					error : function(request, status, error) {
					 //통신 에러 발생시 처리
						alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
						$("#ajax_loader").addClass("display-none");
					}
					,complete: function(request, status, error) {
						$("#ajax_loader").addClass("display-none");
					}
					, success : function(response, status, request) {
						data =JSON.parse(response);

						if(data.stat ==1){
							alert(data.msg);
						}else{
							alert(data.msg);
							location.reload();
						}

					}
				});
		}
	});
</script>
