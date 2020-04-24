<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="환경설정" data-title="푸쉬메시지관리">푸쉬메시지 수정</h2>
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
							<caption>푸싱메시지</caption>
							<colgroup>
							</colgroup>
							<tbody>

								<tr>
									<th>등록자명</th>
									<td>정우성</td>
								</tr>
								<tr>
									<th>등록일시</th>
									<td class="date_list"></td>
								</tr>
								<tr>
									<th>발송일시</th>
									<td class="date_list">
										<input type="text" class="calendar" readonly>
										<input type="text" id="" name="" class="wd_140" placeholder="시간입력 예)15:00" />
									</td>
								</tr>
								<tr>
									<th>제목</th>
									<td><input type="text" id="" name="" class="wd_full" /></td>
								</tr>
								<tr>
									<th>내용</th>
									<td>
										<textarea name="" id="" cols="40" rows="20" readonly="" class="wd_full" ></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="com_btn_box">
						<div class="center">
							<a href="list03.php" class="gray_btn">리스트 이동</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>