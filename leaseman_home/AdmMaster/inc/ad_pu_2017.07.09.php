<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
?>
<section class="pops_wrap">
	<div class="pops_box pops_04_1">
		<div class="pops_h">
			<h2>푸쉬메시지 추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form action="">
					<fieldset>
						<legend>푸쉬메시지 추가</legend>
						<table class="ta_write01">
							<caption>푸쉬메시지</caption>
							<colgroup>
							</colgroup>
							<tbody>
								<tr>
									<th>사용여부</th>
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
									<td>store03</td>
								</tr>
								<tr>
									<th>발송일시</th>
									<td class="date_list">
										<input type="text" class="calendar" readonly>
									</td>
								</tr>
								<tr>
									<th>발송대상</th>
									<td>
										<input type="text" id="" name="" class="wd_200"/>
										<button type="button" class="blue_btn">업로드</button>
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
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">저장</button>
							<button type="button" class="gray">취소</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</section>