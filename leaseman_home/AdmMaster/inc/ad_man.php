<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";

?>
<section class="pops_wrap">	
	<div class="pops_box pops_04">
		<div class="pops_h">
			<h2>관리자 추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form action="/AdmMaster/setting/man_ok.php" method="post" name="frm" id="frm">
					<fieldset>
						<legend>관리자 추가 / 수정</legend>
						<table class="ta_write01">
							<caption>관리자</caption>
							<colgroup>
							</colgroup>
							<tbody>
								
								<tr>
									<th>이름(실명)</th>
									<td><input type="text" id="user_name" name="user_name" value=""  /></td>
								</tr>
								<tr>
									<th>아이디</th>
									<td>
										<input type="text" id="user_id" name="user_id" value=""  />
										<span id="chkid"></span>
									</td>
								</tr>
								
								<tr>
									<th>비밀번호</th>
									<td><input type="password" id="user_pw" name="user_pw"   /></td>
								</tr>
								<tr>
									<th>이메일</th>
									<td><input type="email" id="user_email" name="user_email" value=""  /></td>
								</tr>
								<tr>
									<th>휴대폰</th>
									<td class="ph">
										<input type="text"id="mobile1" name="mobile1" value="" class="onlynum" maxlength="4"  /><span>-</span>
										<input type="text"id="mobile2" name="mobile2" value="" class="onlynum" maxlength="4"  /><span>-</span>
										<input type="text"id="mobile3" name="mobile3" value="" class="onlynum" maxlength="4"  />
									</td>
								</tr>
								<tr>
									<th>권한설정</th>
									<td>
										<ul class="adm_setting">
										<?
										foreach($_master_nol as $keys => $values){

											if($keys%10==0){
												if($keys>10){
										?>
													</ul>
												</li>
										<?
												}
										?>
							
											<li>
												<strong><?=$values?></strong>
												<ul class="depth02">
										<?
												continue;
											}
										?>

													<li><input type="checkbox" id="k<?=$keys?>" name="chkNum[]" value="<?=$keys?>" checked="checked" /> <label for="k<?=$keys?>"><?=$values?></label></li>

										<?
										}
										?>
												</ul>
											</li>

											
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r" onclick="fn_submit();";>저장</button>
							<button type="button" class="gray pops_close_sub">취소</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

$(document).ready(function(){
	$("#user_id").keyup(function(){

		var tmp_id = $(this).val();
		
		if(tmp_id == ""){
			$("#chkid").text("");
			return false;
		}
		
		$.ajax({
		  url     : "/AdmMaster/ajax/chk_ids.php",
		  data    : "chkid="+tmp_id,
		  cache   : false,
		  success : function(data) {  
			  
			if(data == 0){
				$("#chkid").text("사용가능합니다.");
			}else{
				$("#chkid").text("이미 등록된 아이디입니다.");
			}

		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});

	});

});

function fn_submit(){
	var frm = document.frm;

	if(frm.user_name.value == ""){
		alert("이름을 입력해주세요.");
		frm.user_name.focus();
		return false;
	}

	if(frm.user_id.value == ""){
		alert("아이디를 입력해주세요.");
		frm.user_id.focus();
		return false;
	}

	if(frm.user_pw.value == ""){
		alert("비밀번호를 입력해주세요.");
		frm.user_pw.focus();
		return false;
	}

	frm.submit();

}


</script>