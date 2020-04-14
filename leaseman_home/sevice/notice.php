<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<style type="css/text">
	.hidden_class{display:none}
</style>
		<section id="container">
			<? include('../sevice/sub_nav_03.php');?>
			<div class="wrap_1000">
				<div class="sub_visual five">
					<h2>공지사항</h2>
					<b>리스맨의 공지사항입니다.</b>
					<p>최적의 임대관리전문시스템 리스맨으로
					<br />더욱 쉽게 임대관리를 시작하세요!</b>
				</div>
				<div class="notice">	
					<form>
						<div class="input_notice">
							<select>
								<option>전체</option>
								<option>제목</option>
								<option>내용</option>
							</select>
							<input type="text" />
							<button type="button">검색</button>
						</div>
					
						<table>
							<legend>공지사항</legend>
							<thead>
								<tr>
									<th>번호</th>
									<th>제목</th>
									<th>작성일</th>
									<th>조회수</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>공지</td>
									<td><a href="../sevice/notice_view.php">리스맨 회원제 약관이 변동되었습니다. 회원분들께서는 반드시 숙지 부탁드립니다.</a></td>
									<td>2017.06.13</td>
									<td>20</td>
								</tr>
								<tr>
									<td>공지</td>
									<td><a href="../sevice/notice_view.php">리스맨 이용약관 변동 안내</a></td>
									<td>2017.06.13</td>
									<td>15</td>
								</tr>
								<tr>
									<td>86</td>
									<td><a href="../sevice/notice_view.php">리스맨 우수회원들을 위한 2017년 7월 프로모션 </a></td>
									<td>2017.06.13</td>
									<td>20</td>
								</tr>
								<tr>
									<td>85</td>
									<td><a href="../inc/notice_view.php">리스맨 서비스 개선 안내 17.03.10(금) 00:00 ~ 04:00</a></td>
									<td>2017.06.13</td>
									<td>20</td>
								</tr>
								<tr>
									<td>84</td>
									<td><a href="../sevice/notice_view.php">리스맨 시스템 점검안내 17.02.21(화) 04:00 ~ 05:00</a></td>
									<td>2017.06.13</td>
									<td>120</td>
								</tr>
								<tr>
									<td>83</td>
									<td><a href="../sevice/notice_view.php">리스맨우수회원들을 위한 한달무료 프로모션" 할인 안내</a></td>
									<td>2017.06.13</td>
									<td>20</td>
								</tr>
								<tr>
									<td>82</td>
									<td><a href="../sevice/notice_view.php">리스맨 우수회원들을 위한 2017년 7월 프로모션 </a></td>
									<td>2017.06.13</td>
									<td>20</td>
								</tr>
								<tr>
									<td>81</td>
									<td><a href="../sevice/notice_view.php">리스맨 서비스 개선 안내 17.03.10(금) 00:00 ~ 04:00</a></td>
									<td>2017.06.13</td>
									<td>5</td>
								</tr>
								<tr>
									<td>80</td>
									<td><a href="../sevice/notice_view.php">리스맨 시스템 점검안내 17.02.21(화) 04:00 ~ 05:00</a></td>
									<td>2017.06.13</td>
									<td>5</td>
								</tr>
								<tr>
									<td>79</td>
									<td><a href="../sevice/notice_view.php">리스맨우수회원들을 위한 한달무료 프로모션" 할인 안내</a></td>
									<td>2017.06.13</td>
									<td>33</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div class="paging">
					<ul>
						<li><a href="#!"><img src="../img/btn/prev_left.png"></a></li>
						<li class="left_paging"><a href="#!"><img src="../img/btn/prev.png"></a></li>
						<li><a href="#!"  class="active">1</a></li>
						<li><a href="#!">2</a></li>
						<li><a href="#!">3</a></li>
						<li><a href="#!">4</a></li>
						<li class="right_paging"><a href="#!"><img src="../img/btn/next.png"></a></li>
						<li><a href="#!"><img src="../img/btn/next_right.png"></a></li>
					</ul>
				</div>
			</div>
			<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->

</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$("#gnb > ul > li").eq(3).addClass("active");
});
</script>
