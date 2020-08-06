<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
echo G5_POSTCODE_JS;    //다음 주소 js
?>

<section class="pops_wrap" >	
	<!-- 회원 추가-->
	<div class="pops_box pops_05" style="top:0px;" >
	
		<div class="pops_con">
			<div class="com_tb01">
				<iframe style="width:0px;height:0px;" name="ifms"></iframe>
					<fieldset>
						<legend>관리자 추가</legend>

						<form name="add_customer" action="../member/member_ok.php" target="ifms" method="post">
						<input type="hidden" name="id_chk" id="id_chk" value="" />

						<table class="ta_write01">
							<caption>관리자</caption>
							<colgroup>
								<col width="100px" />
								<col width="24%" />
								<col width="100px" />
								<col width="24%" />
								<col width="100px" />
								<col width="24%" />
							</colgroup>
							<tbody>
								<tr>
									<th>아이디</th>
									<td><input type="text" id="user_id" name="user_id" value="" class="onlyeng"   /> <button type="button" class="gray_btn" onclick="chk_userid();">중복확인</button>
										<p class="idTxt01">아이디 중복체크버튼을 눌러주세요</p> <!-- 버튼입력전 -->

										<p class="idTxt01 chk_true" style="display:none;" >사용가능한 ID입니다.</p> <!-- 버튼입력후 아이디사용가능할때 -->
										<p class="idTxt02 chk_false" style="display:none;" >이미 사용중인 ID 입니다.</p> <!-- 버튼입력전 아이디사용불가능할때-->
									</td>
									<th>비밀번호</th>
									<td><input type="password" id="user_pw" name="user_pw" value=""  /></td>
									<th>비밀번호 확인</th>
									<td><input type="password" id="user_pw2" name="user_pw2" value=""  /></td>
									
								</tr>
								
								<tr>
									<th>회원명</th>
									<td><input type="text" id="user_name" name="user_name" value=""  /></td>
									<th>일반전화</th>
									<td class="ph">
										<input type="text" id="tel1" name="tel1" value="" class="onlynum" maxlength="4"  /><span>-</span><input type="text" id="tel2" name="tel2" value=""  class="onlynum" maxlength="4" /><span>-</span><input type="text" id="tel3" name="tel3" value=""  class="onlynum" maxlength="4" />
									</td>
									<th>휴대폰</th>
									<td class="ph">
										<input type="text" id="mobile1" name="mobile1" value=""  class="onlynum" maxlength="4" /><span>-</span><input type="text" id="mobile2" name="mobile2" value=""  class="onlynum" maxlength="4" /><span>-</span><input type="text" id="mobile3" name="mobile3" value=""  class="onlynum" maxlength="4" />
									</td>
								</tr>
								<tr>
									<th>생년월일</th>
									<td><input type="text" id="birthday" name="birthday" value="" class="calendar2" readonly  /></td>
									<th>이메일</th>
									<td class="email">
										<input type="text" id="email1" name="email1" value=""  /><span>@</span><input type="text" id="email2" name="email2" value=""  />
										<select onchange="chg_email(this);">
											<option value="">직접입력</option>
											<?
											foreach($_email_list as $value)
												echo "<option value='".$value."'>".$value."</option>";
											?>
										</select>
									</td>
									<th>추천인아이디</th>
									<td><input type="text" id="reco_id" name="reco_id" value="" readonly  />  <button type="button" class="gray_btn" onClick="btn_id_layer();">검색</button></td>
								</tr>
								<tr>
									<th>우편번호</th>
									<td><input type="text" id="zipcode" name="zipcode" value="" readonly  /> <button type="button" class="gray_btn" onclick="win_zip_item('add_customer', 'zipcode', 'addr', 'addr2');" >찾기</button></td>
									<th>주소</th>
									<td class="address_input" colspan="3">
										<div class="box"><input type="text" id="addr" name="addr" value="" readonly  /></div>
										<div class="box"><input type="text" id="addr2" name="addr2" value=""  /></div>
									</td>									
								</tr>								
								<tr>
									<th>유/무료구분</th>
									<td>
										<select name="pay_yn" id="pay_yn" class="wh100">
											<?foreach($_admin_pay_yn as $key => $value){?>
												<option value="<?=$key?>"><?=$value?></option>
											<?}?>
										</select>
									</td>
									<th>등급</th>
									<td>
										<select name="level" id="level" class="wh100" >
											<?foreach($_admin_level as $key => $value){?>
												<option value="<?=$key?>"><?=$value?></option>
											<?}?>
										</select>
									</td>
									<th>팝빌아이디</th>
									<td><input type="text" id="pop_id" name="pop_id" value=""  /></td>
								</tr>

								<tr>
									<th>등급시작일</th>
									<td><input type="text" id="l_sdate" name="l_sdate" value="" class="calendar2" readonly  /></td>
									<th>등급종료일</th>
									<td><input type="text" id="l_edate" name="l_edate" value="" class="calendar2" readonly  /></td>
									<th>수납방법</th>
									<td>
										<select name="pay_type" id="pay_type" class="wh100">
											<?foreach($_admin_pay_type as $key => $value){?>
												<option value="<?=$key?>"><?=$value?></option>
											<?}?>
										</select>
									</td>
								</tr>

								<tr>
									<th>사업자번호</th>
									<td colspan="5"><input type="text" id="com_num" name="com_num" value=""   /></td>
									
								</tr>


							</tbody>
						</table>
						</form>

						<div class="id_layer">
							<div class="top">
								<h3>추천인 아이디 검색</h3>
								<a href="#!" class="layer_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
							</div>
							<div class="con">
								<div class="id_list_con">
									<input type="text" name="reco_txt" id="reco_txt" placeholder="검색어를 입력하세요." class="onlyeng" /> <button type="button" class="gray_btn" onclick="reco_btn();" >확인</button>
									<ul class="id_list" id="reco_id_list">
									</ul>
								</div>
							</div>
						</div>
						<script type="text/javascript">
						function btn_id_layer(){

							$(".id_layer").show();

						};
						$(function(){
							$(".layer_close").on("click",function(){
								$(this).parent().parent(".id_layer").hide();
							});
							$(".id_list_con").keydown(function(){
								$(".id_list").show();
							});
						});
						</script>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r" onclick="fn_submit();">저장</button>
							<!--
							<button type="button" class="gray pops_close">취소</button>
							-->
						</div>
					</fieldset>
			</div>
		</div>
	</div>
</section>


<script type="text/javascript">

$(document).ready(function(){

	$("#level").val(0);
	$("#level option").each(function(){
		if($(this).val()>0)
			$(this).attr("disabled",true);

	});


	$("#user_id").keyup(function(){
		$("#id_chk").val("");
		$(".chk_true").hide();
		$(".chk_false").hide();
	});

	

	$("#pay_yn").change(function(){
		var chk_yn = $(this).val();
		if(chk_yn=="y"){
			
			$("#level").val(3);
			$("#level option").each(function(){
				if($(this).val()==0){
					$(this).attr("disabled",true);
				}else{
					$(this).attr("disabled",false);
				}

			});
		}else{
			
			$("#level").val(0);
			$("#level option").each(function(){
				if($(this).val()>0){
					$(this).attr("disabled",true);
				}else{
					$(this).attr("disabled",false);
				}

			});
		}
	
	});

});

function chg_email(obj){
	$(obj).parent().find("input").eq(1).val($(obj).val());
}


function chk_userid(){
	var user_id = $("#user_id").val().trim();

	if(user_id==""){
		alert("아이디를 입력해주세요.");
		return false;
	}

	$.ajax({
	  url     : "/ajax/adm/id_check.php",
	  data    : "user_id="+user_id,
	  cache   : false,
	  success : function(data) {  
		data = parseInt(data);

		if(data>0){
			$(".chk_true").hide();
			$(".chk_false").show();
			$("#id_chk").val("");
		}else{
			$(".chk_true").show();
			$(".chk_false").hide();
			$("#id_chk").val("y");
		}
	  },
	  error   : function() {
	   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	  }
	});

}

function reco_btn(){
	var user_id = $("#reco_txt").val();
	
	if(user_id == ""){
		alert("검색어를 입력하세요.");
		$("#reco_txt").focus();
		return false;
	}

	$.ajax({
	  url     : "/ajax/adm/recoid_check.php",
	  data    : "user_id="+user_id,
	  cache   : false,
	  success : function(data) {  
		$("#reco_id_list").html(data);
	  },
	  error   : function() {
	   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	  }
	});
}

function reco_subs(obj){
	$("#reco_id").val( $(obj).text() );
	$(".id_layer").hide();
}

function fn_submit(){
	var frm = document.add_customer;

	if(frm.user_id.value==""){
		alert("아이디를 입력해주세요.");
		frm.user_id.focus();
		return false;
	}

	if(frm.id_chk.value!="y"){
		alert("아이디 중복체크를 해주세요.");
		frm.id_chk.focus();
		return false;
	}

	if(frm.email1.value==""){
		alert("이메일을 입력해주세요.");
		frm.email1.focus();
		return false;
	}

	if(frm.email2.value==""){
		alert("이메일을 입력해주세요.");
		frm.email2.focus();
		return false;
	}


	if(frm.user_pw.value==""){
		alert("비밀번호를 입력해주세요.");
		frm.user_pw.focus();
		return false;
	}

	if(frm.user_pw.value != frm.user_pw2.value){
		alert("비밀번호가 일치하지 않습니다.");
		frm.user_pw2.focus();
		return false;
	}


	if(frm.user_name.value==""){
		alert("회원명을 입력해주세요.");
		frm.user_name.focus();
		return false;
	}
	/*
	if(frm.reco_id.value==""){
		alert("추천인아이디를 입력해주세요.");
		frm.reco_id.focus();
		return false;
	}
	*/


	if(frm.birthday.value==""){
		alert("생년월일을 입력해주세요.");
		frm.birthday.focus();
		return false;
	}

	if(frm.tel1.value=="" || frm.tel2.value=="" || frm.tel3.value==""){
		alert("전화번호를 입력해주세요.");
		frm.tel1.focus();
		return false;
	}

	if(frm.mobile1.value=="" || frm.mobile2.value=="" || frm.mobile3.value==""){
		alert("휴대전화 번호를 입력해주세요.");
		frm.mobile1.focus();
		return false;
	}


	if(frm.zipcode.value==""){
		alert("주소를 입력해주세요.");
		frm.zipcode.focus();
		return false;
	}

	if(frm.addr.value==""){
		alert("주소를 입력해주세요.");
		frm.addr.focus();
		return false;
	}

	if(frm.addr2.value==""){
		alert("주소를 입력해주세요.");
		frm.addr2.focus();
		return false;
	}

	frm.submit();


}



</script>