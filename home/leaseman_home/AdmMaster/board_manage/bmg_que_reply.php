<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="게시판관리" data-title="1:1질문관리">1:1질문관리 답변달기</h2>
			</div>
			<br />
			<div class="com_tb01">
				<table class="ta_write01">
					<caption>질문관리 답변달기</caption>
					<colgroup>
					</colgroup>
					<tbody>
						<!-- <tr>
							<th>사용</th>
							<td colspan="3">
								<div class="radio_list">
									<span><input type="radio" id="" name="" /> <label for="">사용</label></span>
									<span><input type="radio" id="" name="" /> <label for="">숨김</label></span>
									<span><input type="radio" id="" name="" /> <label for="">삭제</label></span>
								</div>
							</td>
						</tr> -->
						<tr>
							<th>글쓴이</th>
							<td colspan="3">sales19</td>
						</tr>
						<tr>
							<th>등록일시</th>
							<td colspan="3">2016-11-30 17:00</td>
						</tr>
						<tr>
							<th>유형</th>
							<td></td>
							<th>첨부파일</th>
							<td><a href="#">image.jpg <img src="../img/main/download_icon.png" alt="첨부파일" style="width:22px;margin-top:-3px;" /></a></td>
						</tr>
						<tr>
							<th>질문</th>
							<td colspan="3">가입은 어떻게 해야하나요?</td>
						</tr>
						<tr>
							<th>질문 내용</th>
							<td colspan="3">가입은 어떻게 해야해</td>
						</tr>
						<tr>
							<th>답변</th>
							<td colspan="3">
								<textarea name="" id="" cols="40" rows="20" class="wd_full" ></textarea>
								<div class="file_add">
									<input type="file" id="" name="" />
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="com_btn_box">
				<div class="center">
					<a href="#" class="blue_btn">답변</a>
					<a href="bmg_que.php" class="gray_btn">취소</a>
				</div>
			</div>
		
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
