<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
echo G5_POSTCODE_JS;    //다음 주소 js
$c_idx = $_GET['c_idx'];

$sql_m = "select * from tbl_customer where c_idx = '".$c_idx."' ";
$result_m = mysql_query($sql_m);
$row_m = mysql_fetch_array($result_m);

?>
<iframe name="ifm_users" id="ifm_users" src="" style="width:0px;height:0px;" ></iframe>

<section class="pops_wrap" >	
	<!-- 회원 추가-->
	<div class="pops_box pops_05">
		<div class="pops_h">
			<h2>회원정보</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_btn_box">
				<div class="left pxel">
				</div>
				<div class="right">
					<?if($row_m['status']==0){?>
						<button type="button" class="gray_btn" onClick="getUser('<?=$c_idx?>','o');">탈퇴처리</button>
					<?}else if($row_m['status']==1){?>
						<button type="button" class="gray_btn" onClick="getUser('<?=$c_idx?>','i');">탈퇴복원</button>
					<?}?>
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
								<col width="100px" />
								<col width="24%" />
								<col width="100px" />
								<col width="24%" />
								<col width="100px" />
								<col width="24%" />
						</colgroup>
						<tbody>
							<tr>
								<th>회원번호</th>
								<td><?=$row_m['user_code']?></td>
								<th>아이디</th>
								<td><?=$row_m['user_id']?></td>
								<th>비밀번호</th>
								<td><input type="password" id="user_pw" name="user_pw" value=""  /> <br/><span style="color:red;">(비밀번호 변경 시에만 입력하세요.)</span></td>
								<!-- <th>비밀번호 확인</th>
								<td><input type="password" id="user_pw2" name="user_pw2" value=""  /></td> -->
							</tr>
							
							<tr>
								<th>회원명</th>
								<td><input type="text" name="user_name" id="user_name" value="<?=$row_m['user_name']?>" /></td>
								<th>일반전화</th>
								<?
								$tel_arr = explode("-",$row_m['tel']);
								$tel1 = $tel_arr[0];
								$tel2 = $tel_arr[1];
								$tel3 = $tel_arr[2];
								?>
								<td class="ph">
									<input type="text" id="tel1" name="tel1" value="<?=$tel1?>" class="onlynum" maxlength="4"  /><span>-</span><input type="text" id="tel2" name="tel2" value="<?=$tel2?>"  class="onlynum" maxlength="4" /><span>-</span><input type="text" id="tel3" name="tel3" value="<?=$tel3?>"  class="onlynum" maxlength="4" />
								</td>
								<?
								$mobile_arr = explode("-",$row_m['mobile']);
								$mobile1 = $mobile_arr[0];
								$mobile2 = $mobile_arr[1];
								$mobile3 = $mobile_arr[2];
								?>
								<th>휴대폰</th>
								<td class="ph">
									<input type="text" id="mobile1" name="mobile1" value="<?=$mobile1?>"  class="onlynum" maxlength="4" /><span>-</span><input type="text" id="mobile2" name="mobile2" value="<?=$mobile2?>"  class="onlynum" maxlength="4" /><span>-</span><input type="text" id="mobile3" name="mobile3" value="<?=$mobile3?>"  class="onlynum" maxlength="4" />
								</td>
							</tr>
							<tr>
								<th>이메일</th>
								<?
								$email_arr = explode("@",$row_m['user_email']);
								$email1 = $email_arr[0];
								$email2 = $email_arr[1];
								?>
								<td class="email" colspan="3">
									<input type="text" id="email1" name="email1" value="<?=$email1?>" style="width:180px;"  /><span>@</span><input type="text" id="email2" name="email2" value="<?=$email2?>"  style="width:130px;"/>
									<select onchange="chg_email(this);" style="width:130px;height:30px;">
										<option value="">직접입력</option>
										<?foreach($_email_list as $key => $value){?>
											<option value="<?=$value?>" <?if($row_m['pay_type']==$key)echo "selected";?> ><?=$value?></option>
										<?}?>
									</select>
								</td>
								<th>생년월일</th>
								<td><?=$row_m['birthday']?></td>
<!-- 								<th>추천인아이디</th>
								<td></td> -->
							</tr>
							<tr>
								<th>우편번호</th>
								<td><input type="text" id="zipcode" name="zipcode" value="<?=$row_m['zipcode']?>" readonly  /> <button type="button" class="gray_btn" onclick="win_zip_item('mod_customer', 'zipcode', 'addr', 'addr2');" >찾기</button></td>
								<th>주소</th>
								<td class="address_input" colspan="3">
									<div class="box"><input type="text" id="addr" name="addr" value="<?=$row_m['addr']?>" readonly  /></div>
									<div class="box"><input type="text" id="addr2" name="addr2" value="<?=$row_m['addr2']?>"  /></div>
								</td>

							</tr>
							<?
								$_tmp_row1 = get_last_payment_user_idx($c_idx);
							?>
							<tr>
								<th>유/무료구분</th>
								<td>
									<?
									if($_tmp_row1['g_levels'] > 0 ){
										echo "유료";
									}else{
										echo "무료";
									}
									?>
								</td>
								<th>등급</th>
								<td >
									<select name="level" id="level" class="wh100" >
										<?
										foreach($_pay_level as $key => $value){
											if($key == 99)
												continue;
										?>
											<option value="<?=$key?>" <?if($_tmp_row1['g_levels']==$key)echo "selected";?> ><?=$value?></option>
										<?}?>
									</select>

								</td>
								<th>추천아이디</th>
								<td><?=$row_m['reco_id']?></td>
							</tr>
							
							<tr>
								<th>등급시작일</th>
								<td>
									<?=substr($_tmp_row1['pay_regdate'],0,10)?>
								</td>
								<th>등급종료일</th>
								<td><?=substr($_tmp_row1['edate'],0,10)?></td>
								<th>수납방법</th>
								<td>카드결제</td>
							</tr>
							<tr>
								<th>건물수</th>
								<td>
								<?
								$sql_bs = "select count(*) as cnts from tbl_build where c_idx = '".$c_idx."' ";
								$result_bs = mysql_query($sql_bs);
								$row_bs = mysql_fetch_array($result_bs);
								echo number_format($row_bs['cnts']);


								?>
								</td>
								<th>가입일</th>
								<td><?=$row_m['r_date']?></td>
								<?
								$e_date = $row_m['e_date'];
								if($e_date == "0000-00-00 00:00:00"){
									$e_date = "";
								}else{
									$e_date = substr($e_date,0,10);
								}
								?>
								<th>팝빌아이디</th>
								<td><input type="text" id="pop_id" name="pop_id" value="<?=$row_m['pop_id']?>"  /> </td>
								
							</tr>

							<tr>
								<th>사업자번호</th>
								<td colspan="5"><input type="text" id="com_num" name="com_num" value="<?=$row_m['com_num']?>"   /></td>
								
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
						<button type="button" class="blue mar_r" onclick="fn_extend(<?=$c_idx?>)">30일 연장</button>
						<button type="button" class="blue mar_r" onclick="fn_submit();">수정</button>
						<?if($row_m['status']==1){?>
						<button type="button" class="gray" onclick="fn_dels(<?=$c_idx?>)">삭제</button>
						<?}?>
					</div>
				</fieldset>
			</div>
		</div>

	</div>
</section>


<script type="text/javascript">


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

	

	if(frm.user_name.value==""){
		alert("회원명을 입력해주세요.");
		frm.user_name.focus();
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


function getUser(c_idx, types){
	
	var msg = "";

	if(types == "o"){
		msg = "정말 탈퇴처리 하시겠습니까?";
	}else{
		msg = "정말 탈퇴복원 하시겠습니까?";
	}

	if(confirm(msg)){
		$("#ifm_users").prop("src","/AdmMaster/inc/chg_cuscus.php?c_idx="+c_idx+"&types="+types);
	}
	
}

function fn_dels(c_idx){
	if(confirm("정말 삭제하시겠습니까?")){
		$("#ifm_users").prop("src","/AdmMaster/inc/del_cuscus.php?c_idx="+c_idx);
	}
}


function fn_extend(c_idx){
	if(confirm("정말 연장하시겠습니까?")){
		$("#ifm_users").prop("src","/AdmMaster/inc/extend_cuscus.php?c_idx="+c_idx);
	}
}


</script>