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
						<img src="../img/main/main_visual_img01.png" width ="100%">
					</li>
				</ul>
			</div>
			<div class="sub_visual one">		
				<ul>
					<li>
						<img src="../img/mobile/main_visual_img01.png" width ="100%">
					</li>
				</ul>
			</div>
			<div class="wrap_1000 one">
				<div class="sub_tit">
					<h2>인증샷 올리기</h1>
					<span>아빠 엄마 이벤트 안내입니다.</span>
				</div>
				<div class="shot_table">
					<table>
						<colgroup>
							<col class="colw01">
							<col class="colw02">
						</colgroup>
						<thead>
							<tr>
								<th>작성자</th>
								<td><input type ="text" placeholder = "관리자" class="shot_input"></td>
							</tr>
							<tr>
								<th>등록일</th>
								<td><input type ="text" placeholder = "2017-06-29 10:48:13" class="shot_input"></td>
							</tr>
							<tr>
								<th>제목</th>
								<td><input type ="text" class="shot_input2"></td>
							</tr>
							<tr>
								<th>내용</th>
								<td><textarea class="text_area" style="resize: none;"></textarea></td>
							</tr>
							<tr>
								<th>파일첨부</th>
								<td><input type ="file" class="file_up"></td>
							</tr>
						</thead>
					</table>
					<div class="inline">	
						<b class="ok_btn"><a href="#">등록</a></b>
						<b class="cancel_btn"><a href="#">취소</a></b>
					</div>
				</div>
			</div>
		</div>
	<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->	
	
</body>
</html>
