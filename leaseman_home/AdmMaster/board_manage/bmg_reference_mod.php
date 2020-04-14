<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="게시판관리" data-title="자료실관리">자료 수정</h2>
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
							<caption>자료실 수정</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>사용</th>
									<td colspan="3">
										<div class="radio_list">
											<span><input type="radio" id="" name="" /> <label for="">사용</label></span>
											<span><input type="radio" id="" name="" /> <label for="">숨김</label></span>
											<span><input type="radio" id="" name="" /> <label for="">삭제</label></span>
										</div>
									</td>
								</tr>
								<tr>
									<th>등록자명</th>
									<td colspan="3">sales19</td>
								</tr>
								<tr>
									<th>등록일시</th>
									<td colspan="3">2016-11-30 17:00</td>
								</tr>
								<tr>
									<th>분류</th>
									<td>
										<select name="" id="">
											<option value="">문서</option>
											<option value="">가이드</option>
											<option value="">기타</option>
										</select>
									</td>
									<th>첨부파일</th>
									<td><input type="file" id="" name="" /></td>
								</tr>
								<tr>
									<th>제목</th>
									<td colspan="3"><input type="text" id="" name="" value="문서2"  class="wd_full" /></td>
								</tr>
								<tr>
									<th>내용</th>
									<td colspan="3">
										<textarea name="" id="" cols="40" rows="20" class="wd_full" ></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="com_btn_box">
						<div class="center">
							<a href="bmg_reference.php" class="gray_btn">리스트이동</a>
						</div>
					</div>
				</fieldset>
			</form>
			
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
