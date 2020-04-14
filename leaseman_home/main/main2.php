<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<style>
	.hidden_class{display:none}
</style>
		<section id="container">
			<div class="main_visual">
				<ul>
					<li>
						<img src="../img/main/main_visual_img01.png">
					</li>
					<li>
						<img src="../img/main/main_visual_img01.png">
					</li>
					<li>
						<img src="../img/main/main_visual_img01.png">
					</li>
				</ul>
			</div>
			<div class="main_visual one">
				<ul>
					<li>
						<img src="../img/mobile/main_visual_img01.png">
					</li>
					<li>
						<img src="../img/mobile/main_visual_img01.png">
					</li>
					<li>
						<img src="../img/mobile/main_visual_img01.png">
					</li>
				</ul>
			</div>
			<div class="wrap_1000 one">
				<div class="main_tit">
					<h1>이벤트 소개</h1>
					<span>아빠 엄마 이벤트 안내입니다.</span>
					<b class="tit_img01"><img src="../img/main/main_tit_img01.png" alt="이벤트 소개 이미지"></b>
					<p class="p_tag1">
						<br />우리는 놀줄아는 사람들입니다. 그리고 아빠들입니다. 우리가 하는 일은 일상에 지친,
						<br />고민에 빠진 분들에게. 희망이 되기 위해. 기쁨이 되려는 광대 입니다.
						<br />하지만. 정작 우리는 먹고살기 바빠.핑계에 주변
						<br />사회는 뒷전이었습니다.
					</p>
					<p class="p_tag2">
						<br />과연 우리가 어떻게 우리 사회에 보답을 해야할지
						<br />고민하고 고민하였습니다. 그리고 사회에 작은 보탬이
						<br />되보고 싶어. 도전합니다. 국내 소아암 백혈병 아이들..
						<br />아이들에게 어떻게 도움을 줄수 있을까?
						<br />오늘은 슈퍼맨이 되기 위해 헌혈부터 ~!
					</p>
					<b class="tit_img02"><img src="../img/main/main_tit_img02.png" alt="이벤트 소개 이미지"></b>
				</div>
				<ul class="main_txt">
					<li>
						<div>
							<b>STEP 01</b>
							<p>원하는 매장의
							<br />슈퍼맨릴레이 캠페인
							<br />일정확인</p>
						</div>
						<b>헌혈자 할인!</b>
					</li>
					<li>
						<div>
							<b>STEP 02</b>
							<p>그시간대 만큼은
							<br />낚시체험+커피 무료</p>
						</div>
						<b>헌혈자 할인!</b>
					</li>
					<li>
						<div>
							<b>STEP 03</b>
							<p>슈퍼맨 되기!
							<br />가까운 헌혈의집
							<br />방문하기(헌혈하기)!</p>
						</div>
						<b>헌혈자 할인!</b>
					</li>
					<li>
						<div>
							<b>STEP 04</b>
							<p>해당 낚시카페에
							<br />헌혈증 기부하기
							<br />*기부시 60분이용권제공*
							<br />혹은 본인이 소지한
							<br />헌혈증사이트 인증하기</p>
						</div>
						<b>헌혈자 할인!</b>
					</li>
					<li>
						<div>
							<b>STEP 05</b>
							<p>해당 낚시카페는
							<br />매월 본인 지역의 시청/구/군
							<br />헌혈증 기부</p>
						</div>
						<b>낚시카페가 할일</b>
					</li>
					<li>
						<div>
							<b>STEP 06</b>
							<p>지역 소아암,백혈병
							<br />아이들에게 헌혈증을
							<br />전달하기</p>
						</div>
						<b>시,군,군에서 할일</b>
					</li>
				</ul>
			</div>
			<div class="main_photo_box">
				<div class="wrap_1000">
					<h2>헌혈 인증샷</h2>
					<span>우리가 함께 참여하는 헌혈 릴레이~</span>
						<ul>
						<?
						$code			= "photo";
						$strSql = $strSql." and code = '$code'";
						$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt from tbl_bbs_list where 1=1 ".$strSql;
						$sql    = $total_sql . " order by bbs_idx desc  limit 0,12";
						$result = mysql_query($sql) or die (mysql_error());
						$nTotalCount = mysql_num_rows($result);
						$j =0;
							while($row=mysql_fetch_array($result)){
								$file_chk = "N";
								for ($i=1;$i<=5;$i++) {
									if ($row["rfile".$i]) {
										$file_chk = "Y";
									}
								}
								$img = "";
								$url = "";
								if ($row["ufile1"]) {
									if (substr(strtolower($row["ufile1"]),-3) == "jpg" || substr(strtolower($row["ufile1"]),-3) == "png" || substr(strtolower($row["ufile1"]),-3) == "gif" ) {
										$img = get_img($row["ufile1"], "/data/bbs/", 229, 232);
									}
								}

								if($j ==0 ||$j%2 ==0){
									echo "<li>";
									echo '<img src="'.$img.'">';
									if($nTotalCount <2){
										echo "</li>";
									}
								}else{
									echo '<img src="'.$img.'">';
									if($nTotalCount <=$j){
										echo "</li>";
									}else{
										echo "</li>";
									}
								}
								?>

							<?
							$j++;
							}
							?>
							<!-- <li>
								<img src="../img/main/main_sub_img03.png">
								<img src="../img/main/main_sub_img04.png">
							</li>
							<li>
								<img src="../img/main/main_sub_img05.png">
								<img src="../img/main/main_sub_img06.png">
							</li>
							<li>
								<img src="../img/main/main_sub_img01.png">
								<img src="../img/main/main_sub_img02.png">
							</li>
							<li>
								<img src="../img/main/main_sub_img03.png">
								<img src="../img/main/main_sub_img04.png">
							</li>
							<li>
								<img src="../img/main/main_sub_img05.png">
								<img src="../img/main/main_sub_img06.png">
							</li> -->
						</ul>
					<b class="more_btn"><a href="/sub/proof_shot.php">더보기</a></b>
				</div>
			</div>
			<div class="wrap_1000">
				<div class="main_event_box">
					<h2>이벤트 신청</h2>
					<span>우리가 함께 참여하는 헌혈 릴레이~</span>
						<ul>
							<?
							$code3			= "event";
							$g_list_rows	= 12;

							$strSql = " and code = '$code3'";
							$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt from tbl_bbs_list where 1=1 ".$strSql;

							$result = mysql_query($total_sql) or die (mysql_error());
							$nTotalCount2 = mysql_num_rows($result);
							$nPage = ceil($nTotalCount / $g_list_rows);
							if ($pg == "") $pg = 1;
							$nFrom = ($pg - 1) * $g_list_rows;

							$sql    = $total_sql . " order by $orderStr notice_yn desc,  b_ref desc, b_step asc limit $nFrom, $g_list_rows ";

							$result = mysql_query($sql) or die (mysql_error());
							$num = $nTotalCount2 - $nFrom;
							$event_limit =0;
							$event_msg ="";
							$num_count ="";
							$hidd_class ="";
							while($row2=mysql_fetch_array($result)){
								//카운트 가져오기
								//카운트 가져오기
								$sql_num ="
									select
										count(idx)as num,
										m_idx
									from tbl_inquiry
									where product_name ='".$row2['bbs_idx']."'
									";
									$sql_num2 ="
										select
											m_idx
										from tbl_inquiry
										where product_name ='".$row2['bbs_idx']."' and m_idx = '".$_SESSION['member']['idx']."'
										";
								$count_result =mysql_query($sql_num);
								$count_row =mysql_fetch_array($count_result);
								$num_count =$row2['option_type'] -$count_row['num'];
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




								$today =date('Ymd');
								$StartDay = str_replace("-","",$row2['cate1']);
								$LastDay = str_replace("-","",$row2['cate2']);
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
										$hidd_class ="hidden_class";
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
									$hidd_class ="hidden_class";
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
								<div class="event_tit">
									<p><?=$row2['company']?></p>
									<span class="blue"><?=$event_msg?></span>
								</div>
								<div class="event_txt">
									<p><?=$row2['subject']?>
									<br /><?=$row2['cate1']?> ~ <?=$row2['cate2']?>
									</p>
									<b class="<?=$hidd_class?$hidd_class:"blue on_btn"?>" title_idx ="<?=$row2['bbs_idx']?>">
										<a href="#!">신청하기</a>
									</b>
								</div>
							</li>
							<?}?>
						</ul>
					<b class="more_btn"><a href="/sub/Participatory_fishing.php">더보기</a></b>
				</div>
			</div>
		</div>
	<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->

</body>
</html>

<script>
		$('.main_visual ul').bxSlider({
	  mode:'horizontal', //default : 'horizontal', options: 'horizontal', 'vertical', 'fade'
	  speed:500, //default:500 이미지변환 속도
	  pause:5000,
	  auto: true, //default:false 자동 시작
	  captions: false, // 이미지의 title 속성이 노출된다.
	  controls:true,
	  autoControls: false //default:false 정지,시작 콘트롤 노출, css 수정이 필요
	});
</script>

<script type="text/javascript">
		$(document).ready(function(){
			var setting = {
				centerMode: true,
			  speed: 500,
				slidesToScroll: 3,
				centerPadding: '0',
			  slidesToShow: 3,
			  centerPadding: '',
			  dots: false,
			 // variableWidth: true,
			 // focusOnSelect: true,
			  responsive: [
				{
				  breakpoint: 1000,
				  settings: {
					variableWidth: false,
					centerPadding: '0',
					arrows: false,
					slidesToShow: 7
				  }
				},
				{
				  breakpoint: 730,
				  settings: {
					variableWidth: false,
					centerPadding: '0',
					arrows: false,
					slidesToShow: 1
				  }
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			  ]
			}
			var $slide = $(".main_photo_box ul")
			$slide.slick(setting);
		});


		$(function(){
			$(".on_btn").click(function(){
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
					url: "../sub/event_add.php",
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
