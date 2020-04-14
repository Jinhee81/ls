<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>	
<?
	if (get_device() == "P") { 
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
		<section id="container">		
			<div class="sub_visual">		
				<ul>
					<li>
						<img src="../img/main/main_visual_img01.png" width ="100%" alt="서브 비쥬얼 이미지">
					</li>
				</ul>
			</div>
			<div class="sub_visual one">		
				<ul>
					<li>
						<img src="../img/mobile/main_visual_img01.png" width ="100%" alt="서브 비쥬얼 이미지">
					</li>
				</ul>
			</div>
			<div class="wrap_1000 one">
				<div class="sub_tit">
					<h2>이벤트 소개</h2>
					<span>아빠 엄마 이벤트 안내입니다.</span>
				</div>	
					<div class="wrap_in">
				<div class="board_view">
					<table class="ta_view">
						<colgroup>
							<col class="colw01">
							<col class="colw02">
							<col class="colw01">
							<col class="colw02">
						</colgroup>
						<thead>
							<tr>
								<th>제목</th>
								<td>김차장 사이트 오픈안내</td>
								<th>작성일</th>
								<td>2017.06.28</td>
							</tr>
							<tr>
								<th>작성자</th>
								<td>관리자</td>
								<th>조회수</th>
								<td>8</td>
							</tr>
						</thead>
						<tbody>
						<tr>
							<td colspan="4" class="view_content">
							</td>
						</tr>
						</tbody>
						<tfoot>
							<tr class="prevpage">
								<th>이전글</th>
								<td colspan="3"><a href="#"></a></td>
							</tr>
							<tr class="nextpage">
								<th>다음글</th>
								<td colspan="3"><a href="#"></a></td>
							</tr>
						</tfoot>
					</table>
					<div class="btn_wrap">
						<a href="../sub/Participatory_fishing.php" class="go_list">목록으로</a>
						<div class="inline">	
							<b class="ok_btn"><a href="#">등록</a></b>
							<b class="cancel_btn"><a href="#">취소</a></b>
						</div>
					</div>
				</div>
			</div>
				</div>
			</div>
		</div>
	<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->	
	
</body>
</html>
