<? include_once('../inc/head.inc.php');?>
<? include_once('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include_once $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<style>
	.hidden_class{display:none}
	#header{height:113px;}
</style>
		<section id="container">
			<div class="main_visual">
				<div class="wrap_1000">	
					<ul>
						<li class="one">
							<b>임대사업관리는
							<br />이제 <span>리스맨</span>에게 맡겨주세요!</b>
							<p>임대관리전문시스템 리스맨이 여러분의 임대사업을
							<br />더욱 스마트하게 도와드립니다.</p>
						</li>
						<li class="two">
							<b>당신의 듬직한 직원
							<br />착하고 똑똑한 <span>리스맨</span></b>
							<p>고객관리 및 회계리포트 문자메시지와 세금계산서까지
							<br />당신의 듬직한 직원 리스맨이 도와드립니다!</p>
						</li>
						<li class="three">
							<b>완벽한 내부 통제기능 
							<br /> <span>리스맨</span>에서 시작하세요!</b>
							<p>리스맨은 보다 체계적인 내부질서를 확립시키고
							<br />투명하고 선진화된 내부 문화를 만들어냅니다
							<br />사업의 번창을 위하여 리스맨은 꼭 필요합니다!</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="wrap_1000">	
				<div class="main_advantage">
					<h2>서비스 장점</h2>
					<ul>
						<li>
							<img src="../img/main/main_sevice_img01.png" alt="리스맨의 서비스 장점">
							<div>	
								<b>통합관리시스템</b>
								<p>임대비용관리부터 세금계산서 출력까지
								<br />임대사업에 필요한 모든 것을 
								<br />스마트하게 관리해드립니다.</p>
							</div>
						</li>
						<li>
							<img src="../img/main/main_sevice_img02.png" alt="리스맨의 서비스 장점">
							<div>	
								<b>알기쉬운 시스템</b>
								<p>사용자 중심의 UX 디자인으로
								<br />누구라도 쉽게 시스템 적응이 빠르며
								<br />관리시간이 단축됩니다.</p>
							</div>
						</li>
						<li>
							<img src="../img/main/main_sevice_img03.png" alt="리스맨의 서비스 장점">
							<div>	
								<b>문자메시지 발송</b>
								<p>단체 메시지 발송이 가능하여
								<br />고객들에게 빠르게 임대관련 
								<br />내용전달이 가능합니다.</p>
							</div>
						</li>
						<li>
							<img src="../img/main/main_sevice_img04.png"  alt="리스맨의 서비스 장점">
							<div>	
								<b>다양한 디바이스 연동</b>
								<p>데스크탑, 노트북, 태블릿, 모바일등
								<br />다양한 디바이스에서 연동되어
								<br />언제 어디서든 관리자에 접근이 가능합니다. </p>
							</div>
						</li>
						<li>
							<img src="../img/main/main_sevice_img05.png" alt="리스맨의 서비스 장점">
							<div>
								<b>세금계산서 출력</b>
								<p>스마트한 임대관리 뿐아니라
								<br />세금계산서 출력이 가능하여
								<br />관리자가 더욱 손 쉽습니다.</p>
							</div>
						</li>
						<li>
							<img src="../img/main/main_sevice_img06.png" alt="리스맨의 서비스 장점">
							<div>	
								<b>모든 정보를 한눈에</b>
								<p>임대사업관련된 정보들을 한눈에
								<br />보실 수 있어 리스맨은
								<br />관리가 더욱 편리해집니다.</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="main_download">
				<h2>다운로드</h2>
				<div class="wrap_1000">		
					<div class="main_down one">
						<img src="../img/main/main_down_img01.png">
						<b>리스맨 APP 다운로드</b>
						<p>스마트폰으로 스마트하게 관리하자.</p>
						<b class="down_btn">
							<a href="https://play.google.com/store/apps/details?id=jbink.jnk.leaseman"
							alt="리스맨 어플 받기" target="_blank"><img src="../img/ico/google.png" alt="구글 플레이 이미지"></a>
						</b>
					</div>
					<div class="main_down two">
						<img src="../img/main/main_down_img02.png">
						<b>리스맨 PC버전</b>
						<p>데스크탑, 노트북 등 다양한 디바이스에서 로그인하자.</p>
						<b class="down_btn">
							<a href="http://sv.leaseman.co.kr/" target ="blank_" alt="리스맨 서비스 페이지로 이용">
								<img src="../img/ico/pc_vision.png">PC 버전 로그인
							</a>
						</b>
					</div>
				</div>	
			</div>
			<div class="wrap_1000">	
				<div class="main_service">
					<h2>고객센터</h2>
					<ul>
						<li>
							<b>공지사항/이벤트</b>
							<?
								$sql ="select * from tbl_bbs_list where code ='h_notice' order by bbs_idx desc limit 3";
								$result =mysql_query($sql);
								while($row =mysql_fetch_array($result)){
							?>
							<p>- <a href="/_bbs/board_view.php?code=h_notice&bbs_idx=<?=$row['bbs_idx']?>"><?=$row['subject']?></a></p><span><?=substr($row['r_date'],0,10)?></span>
							<?}?>
							<!-- <p>- 리스맨 홈페이지가 오픈되었습..</p><span>2016-05-24</span>
							<p>- 리스맨 홈페이지가 오픈되었습..</p><span>2016-05-24</span> -->
							<b class="more_btn">
								<a href="/_bbs/board_list.php?code=h_notice">더 보기<img src="../img/btn/more_view.png"></a>
							</b>
						</li>
						<li>
							<b>후기 게시판</b>
							<?
								$sql ="select * from tbl_bbs_list where code ='h_after' order by bbs_idx desc limit 3";
								$result =mysql_query($sql);
								while($row =mysql_fetch_array($result)){
							?>
							<p>- <a href="/_bbs/board_view.php?code=h_after&bbs_idx=<?=$row['bbs_idx']?>"><?=$row['subject']?></a></p><span><?=substr($row['r_date'],0,10)?></span>
							<?}?>
							<!-- <p>- 리스맨 홈페이지가 오픈되었습..</p><span>2016-05-24</span>
							<p>- 리스맨 홈페이지가 오픈되었습..</p><span>2016-05-24</span>
							<p>- 리스맨 홈페이지가 오픈되었습..</p><span>2016-05-24</span> -->
							<b class="more_btn">
								<a href="/_bbs/board_list.php?code=h_after">더 보기<img src="../img/btn/more_view.png"></a>
							</b>
						</li>
						<li>
							<ul>
								<li>
									<a href="https://open.kakao.com/o/sZsgqby" target="_blank">
										<b>카카오톡 플러스</b>
										<p>아이디 : 리스맨</p>
									</a>
								</li>
								<li>
									<a href="/_bbs/board_write.php?code=h_qna">
										<b>문의하기</b>
										<p>언제든지 문의하세요!</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
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

