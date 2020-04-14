<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="게시판관리" data-title="FAQ">FAQ 수정</h2>
			</div>
			<form action="">
				<fieldset>
					<div class="com_btn_box">
						<div class="right">
							<button type="button" class="blue_btn ">저장</button>
						</div>
					</div>
					<div class="com_tb01">
						<table class="ta_write01">
							<caption>FAQ</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>사용</th>
									<td>
										<div class="radio_list">
											<span><input type="radio" id="" name="" /> <label for="">사용</label></span>
											<span><input type="radio" id="" name="" /> <label for="">숨김</label></span>
											<span><input type="radio" id="" name="" /> <label for="">삭제</label></span>
										</div>
									</td>
								</tr>
								<tr>
									<th>등록자명</th>
									<td>AdmMasterin</td>
								</tr>
								<tr>
									<th>등록일시</th>
									<td>2016-11-30 17:00</td>
								</tr>
								<!-- <tr>
									<th>분류</th>
									<td>
										<select name="" id=""  class="wd_200">
											<option value="">가입문의</option>
											<option value="">분양문의</option>
										</select>
									</td>
								</tr> -->
								<tr>
									<th>첨부파일</th>
									<td><a href="#">image.jpg <img src="../img/main/download_icon.png" alt="첨부파일" style="width:22px;margin-top:-3px;" /></a></td>
								</tr>
								<tr>
									<th>질문</th>
									<td>가입에 필요한 양식이 있나요?</td>
								</tr>
								<tr>
									<th>답변</th>
									<td>
										<textarea name="" id="" cols="40" rows="20" readonly="" class="wd_full" ></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="com_btn_box">
						<div class="center">
							<a href="bmg_faq.php" class="gray_btn">리스트 이동</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
