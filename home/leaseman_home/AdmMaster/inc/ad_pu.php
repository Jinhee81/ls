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
				<form action="/AdmMaster/setting/push_ok.php" name="frm" method="post" >
					<fieldset>
						<legend>푸쉬메시지 추가</legend>
						<table class="ta_write01">
							<caption>푸쉬메시지</caption>
							<colgroup>
							</colgroup>
							<tbody>
								
								<tr>
									<th>등록자명</th>
									<td><?=$_SESSION[member][id]?></td>
								</tr>
								<tr>
									<th>발송일시</th>
									<td class="date_list">
										<input type="text" name="send_date" class="calendar2" placeholder="2017-01-01" > <input type="text" name="send_time" placeholder="시간입력 예)15:00" >
									</td>
								</tr>
								<tr>
									<th>제목</th>
									<td><input type="text" id="title" name="title" class="wd_full" /></td>
								</tr>
								<tr>
									<th>내용</th>
									<td>
										<textarea name="content" id="content" cols="40" rows="20" class="wd_full" ></textarea>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r" onclick="fn_submit();" >저장</button>
							<button type="button" class="gray pops_close_sub">취소</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</section>


<script type="text/javascript">

function fn_submit(){
	var frm = document.frm;

	if(frm.title.value == ""){
		alert("제목을 등록해주세요.");
		frm.title.focus();
		return false;
	}

	if(frm.content.value == ""){
		alert("내용을 등록해주세요.");
		frm.content.focus();
		return false;
	}

	frm.submit();
}


</script>