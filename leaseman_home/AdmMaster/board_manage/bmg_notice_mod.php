<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="게시판관리" data-title="공지사항">공지사항 수정</h2>
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
							<caption>공지사항</caption>
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
									<td><input type="text" readonly="" value="AdmMasterin" id="" name=""  class="wd_200" /></td>
								</tr>
								<tr>
									<th>등록일시</th>
									<td><input type="text" readonly="" value="2016-11-30 17:00" id="" name=""  class="wd_200" /></td>
								</tr>
								<tr>
									<th>수정자명</th>
									<td><input type="text" readonly="" value="AdmMasterin" id="" name=""  class="wd_200" /></td>
								</tr>
								<tr>
									<th>수정일시</th>
									<td><input type="text" readonly="" value="2016-11-30 17:00" id="" name=""  class="wd_200" /></td>
								</tr>
								<tr>
									<th>제목</th>
									<td><input type="text" readonly="" value="[공지] 비즈피스휴무" id="" name=""  class="wd_full"/></td>
								</tr>
								<tr>
									<th>내용</th>
									<td>
										<textarea name="" id="" cols="40" rows="20" readonly="" class="wd_full" >에디트는 실개발 작업 중 넣을 예정입니다</textarea>
									</td>
								</tr>
								<tr>
									<th>첨부파일</th>
									<td><input type="file" id="" name="" /></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="com_btn_box">
						<div class="center">
							<a href="bmg_notice.php" class="gray_btn">리스트 이동</a>
						</div>
					</div>
				</fieldset>
			</form>
			
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
