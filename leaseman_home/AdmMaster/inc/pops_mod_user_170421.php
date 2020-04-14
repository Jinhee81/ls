<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
echo G5_POSTCODE_JS;    //다음 주소 js
$c_idx = $_GET['c_idx'];

$sql_m = "select * from tbl_customer where c_idx = '".$c_idx."' ";
$result_m = mysql_query($sql_m);
$row_m = mysql_fetch_array($result_m);

?>

<section class="pops_wrap" >	
	<!-- 회원 추가-->
	<div class="pops_box pops_05" style="top:0px;" >
		<div class="pops_con">
			<div class="com_btn_box">
				<div class="left pxel">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</div>
				<div class="right">
					<button type="button" class="gray_btn" onClick="pops_07btn('l','<?=$c_idx?>');">탈퇴처리</button>
				</div>
			</div>
			<div class="com_tb01">
				<iframe style="width:0px;height:0px;" name="ifms"></iframe>



				<fieldset>
					<legend>회원정보</legend>

					<form name="mod_customer" action="../member/member_mod_ok.php" target="ifms" method="post">
					<input type="hidden" name="c_idx" id="c_idx" value="<?=$c_idx?>" />

					<table class="ta_write01">
						<caption>회원정보</caption>
						<colgroup>
						</colgroup>
						<tbody>
							<tr>
								<th>회원번호</th>
								<td><?=$row_m['user_code']?></td>
								<th>추천인아이디</th>
								<td><input type="text" id="reco_id" name="reco_id" value="<?=$row_m['reco_id']?>" readonly  />  <button type="button" class="gray_btn" onClick="btn_id_layer();">검색</button></td>
							</tr>

							<tr>
								<th>아이디</th>
								<td><?=$row_m['user_id']?></td>
								<th>유/무료구분</th>
								<td>
									<select name="pay_yn" id="pay_yn" class="wh100">
										<?foreach($_admin_pay_yn as $key => $value){?>
											<option value="<?=$key?>"><?=$value?></option>
										<?}?>
									</select>
								</td>
							</tr>

							<tr>
								<th>비밀번호</th>
								<td><input type="password" id="user_pw" name="user_pw" value=""  /> <span style="color:red;">(비밀번호 변경 시에만 입력하세요.)</span></td>
								<th>비밀번호 확인</th>
								<td><input type="password" id="user_pw2" name="user_pw2" value=""  /></td>
							</tr>


							<tr>
								<th>회원명</th>
								<td><?=$row_m['user_name']?></td>
								<th>등급</th>
								<td>
									<select name="level" id="level" class="wh100" >
										<?foreach($_admin_level as $key => $value){?>
											<option value="<?=$key?>" <?if($row_m['level']==$key)echo "selected";?> ><?=$value?></option>
										<?}?>
									</select>
								</td>
							</tr>

							<tr>
								<th>생년월일</th>
								<td><?=$row_m['birthday']?></td>
								<th>등급시작일</th>
								<td><input type="text" id="l_sdate" name="l_sdate" value="<?=$row_m['l_sdate']?>" class="calendar2" readonly  /></td>
							</tr>
							<?
							$tel_arr = explode("-",$row_m['tel']);
							$tel1 = $tel_arr[0];
							$tel2 = $tel_arr[1];
							$tel3 = $tel_arr[2];
							?>
							<tr>
								<th>일반전화</th>
								<td class="ph">
									<input type="text" id="tel1" name="tel1" value="<?=$tel1?>" class="onlynum" maxlength="4"  /><span>-</span><input type="text" id="tel2" name="tel2" value="<?=$tel2?>"  class="onlynum" maxlength="4" /><span>-</span><input type="text" id="tel3" name="tel3" value="<?=$tel3?>"  class="onlynum" maxlength="4" />
								</td>
								<th>등급종료일</th>
								<td><input type="text" id="l_edate" name="l_edate" value="<?=$row_m['l_edate']?>" class="calendar2" readonly  /></td>
								
							</tr>
							<?
							$mobile_arr = explode("-",$row_m['mobile']);
							$mobile1 = $mobile_arr[0];
							$mobile2 = $mobile_arr[1];
							$mobile3 = $mobile_arr[2];
							?>
							<tr>
								<th>휴대폰</th>
								<td class="ph">
									<input type="text" id="mobile1" name="mobile1" value="<?=$mobile1?>"  class="onlynum" maxlength="4" /><span>-</span><input type="text" id="mobile2" name="mobile2" value="<?=$mobile2?>"  class="onlynum" maxlength="4" /><span>-</span><input type="text" id="mobile3" name="mobile3" value="<?=$mobile3?>"  class="onlynum" maxlength="4" />
								</td>
								<th>수납방법</th>
								<td>
									<select name="pay_type" id="pay_type" class="wh100">
										<?foreach($_admin_pay_type as $key => $value){?>
											<option value="<?=$key?>" <?if($row_m['pay_type']==$key)echo "selected";?> ><?=$value?></option>
										<?}?>
									</select>
								</td>
							</tr>

							<tr>
								<th>우편번호</th>
								<td><input type="text" id="zipcode" name="zipcode" value="<?=$row_m['zipcode']?>" readonly  /> <button type="button" class="gray_btn" onclick="win_zip_item('add_customer', 'zipcode', 'addr', 'addr2');" >찾기</button></td>
								<th>건물수</th>
								<td>건물수?</td>
							</tr>

							<tr>
								<th>주소</th>
								<td class="address_input">
									<div class="box"><input type="text" id="addr" name="addr" value="<?=$row_m['addr']?>" readonly  /></div>
									<div class="box"><input type="text" id="addr2" name="addr2" value="<?=$row_m['addr2']?>"  /></div>
								</td>
								<th>가입일</th>
								<td><?=$row_m['r_date']?></td>
							</tr>


							<?
							$email_arr = explode("@",$row_m['user_email']);
							$email1 = $email_arr[0];
							$email2 = $email_arr[1];
							?>

							<tr>
								<th>이메일</th>
								<td class="email">
									<input type="text" id="email1" name="email1" value="<?=$email1?>"  /> @ <input type="text" id="email2" name="email2" value="<?=$email2?>"  />
									<select onchange="chg_email(this);">
										<option value="">직접입력</option>
										<?foreach($_email_list as $key => $value){?>
											<option value="<?=$value?>" <?if($row_m['pay_type']==$key)echo "selected";?> ><?=$value?></option>
										<?}?>
									</select>
								</td>
								<?
								$e_date = $row_m['e_date'];
								if($e_date == "0000-00-00 00:00:00"){
									$e_date = "";
								}else{
									$e_date = substr($e_date,0,10);
								}
								?>
								<th>탈퇴일</th>
								<td><input type="text" id="e_date" name="e_date" value="<?=$e_date?>" class="calendar2" readonly  /></td>
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
						<button type="button" class="blue mar_r" onclick="fn_submit();">수정</button>
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

	$("#level").val(2);
	$("#level option").each(function(){
		if($(this).val()>2)
			$(this).attr("disabled",true);

	});

	var pay_yn = "<?=$row_m['pay_yn']?>";
	var level = "<?=$row_m['level']?>";

	$("#pay_yn").val(pay_yn);
	if(pay_yn=="y"){
		$("#level").val(3);
		$("#level option").each(function(){
			if($(this).val()==2){
				$(this).attr("disabled",true);
			}else{
				$(this).attr("disabled",false);
			}

		});
	}
	$("#level").val(level);



	
	

	$("#pay_yn").change(function(){
		var chk_yn = $(this).val();
		if(chk_yn=="y"){
			
			$("#level").val(3);
			$("#level option").each(function(){
				if($(this).val()==2){
					$(this).attr("disabled",true);
				}else{
					$(this).attr("disabled",false);
				}

			});
		}else{
			
			$("#level").val(2);
			$("#level option").each(function(){
				if($(this).val()>2){
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
	var frm = document.mod_customer;

	if(frm.user_pw.value!=""){
		
		if(frm.user_pw.value != frm.user_pw2.value){
			alert("비밀번호가 일치하지 않습니다.");
			frm.user_pw2.focus();
			return false;
		}

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


	
	/*
	if(frm.reco_id.value==""){
		alert("추천인아이디를 입력해주세요.");
		frm.reco_id.focus();
		return false;
	}
	*/




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