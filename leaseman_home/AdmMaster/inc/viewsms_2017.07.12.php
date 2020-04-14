<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
?>
<section class="pops_wrap">
	<div class="pops_box pops_01">
		<div class="pops_h">
			<h2>문자메시지</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01 com_pdv">
				<form action="">
					<fieldset>
						<legend>문자메시지 입력 양식</legend>
						<div class="sms_view">
							
							<div class="sms_viewbox">
								<form action="">
									<fieldset>
										<legend>메시지 보기 창</legend>
										<textarea name="" id=""></textarea>
										<p class="right_byte">0 / 90bytes</p>
										<ul class="sms_viewul">
											<li><p>이름</p><input type="text" value="박지애"></li>
											<li><p>수신번호</p><input type="text" value="010-9787-5168"></li>
											<li><p>발신번호</p><input type="text" value="010-9787-5168"></li>
										</ul>
									</fieldset>
								</form>
							</div>
						</div>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r">재전송</button>
							<button type="button" class="gray">닫기</button>
						</div>
					</fieldset>	
				</form>
			</div>
		</div>
	</div>
</section>