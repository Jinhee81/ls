<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>		
	<section id="container" >	
		<? include('contents_inc.php');?>		
		<div class="wrap_1000">	
			<div class="sub_tit">
				<h2>솔루션</h2>
			</div>
			<div class="section_box">
				<div class="sb_top">
					<h3>제품설명</h3>
					<p class="top_txt">JBDID 컨텐츠 관리 프로그램은 <span class="blue">DID솔루션 사용 경험이 없는 사용자도 바로 운용할 수 있도록 향상된 기능을 제공</span>합니다. <br />
					네트워크를 통해 원하는 장소의 디지털 정보 디스플레이(DID)에  <br />
					다양한 화면분할과 자막관리 등 영상 및 정보를 자유롭게 표현하고 제어할 수 있는 디지털 사이니지 관리 솔루션 입니다.</p>
				</div>
				<article class="system_box">
					<h4 class="sb_tit">시스템 구성 <span class="arrow"></span></h4>
					<div class="box_in">
						<figure><img src="../img/sub/contents01_img01.png" alt="시스템 구성"  class="web_img"/><img src="../img/sub/mo_contents01_img01.png" alt="시스템 구성" class="mo_img" /></figure>
					</div>				
				</article>
				<script type="text/javascript">
					$(function(){
						$(".sb_tit").on("click",function(){
							$(this).toggleClass("active");
							$(this).next(".box_in").slideToggle(200);
						});
					});
				</script>
				<article class="process_list">
					<h4>제품의 특장점</h4>
					<ul class="cols-05">
						<li>
							<span class="pl_icon"><img src="../img/sub/contents01_list_img01.png" alt="smart did 기기" /></span>
							<strong class="pl_txt">SMART DID 기기</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents01_list_img02.png" alt="smart 메뉴판" /></span>
							<strong class="pl_txt">SMART 메뉴판</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents01_list_img03.png" alt="관리 S/w" /></span>
							<strong class="pl_txt">관리 S/W</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents01_list_img04.png" alt="컨텐츠 제작/관리" /></span>
							<strong class="pl_txt">컨텐츠 제작/관리</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents01_list_img05.png" alt="원격 제어/관리" /></span>
							<strong class="pl_txt">원격 제어/관리</strong>
						</li>
					</ul>
				</article>
			</div>
		</div>
	</section>
<? include('../inc/footer.inc.php');?>	