<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";

	$m_idx	= updateSQ($_GET[m_idx]);
		
	
	$sql = " select * from tbl_admin where status = 'Y' and secede_yn = 'N' and m_idx = " . $m_idx;
	$result = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_array($result);


?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="환경설정" data-title="관리자관리">관리자 정보 수정</h2>
			</div>
			<form action="/AdmMaster/setting/man_mod_ok.php" method="post" name="frm" id="frm">
				<input type="hidden" name="m_idx" id="m_idx" value="<?=$m_idx?>" />
				<fieldset>
					<div class="com_btn_box">
						<div class="right">
							<button type="button" class="blue_btn " onclick="fn_del(<?=$m_idx?>);">삭제</button>
							<button type="button" class="blue_btn " onclick="fn_submit();">수정</button>
						</div>
					</div>
					<div class="com_tb01">
						<table class="ta_write01">
							<caption>공지사항</caption>
							<colgroup>
							</colgroup>
							<tbody>
								
								<tr>
									<th>이름(실명)</th>
									<td><input type="text" id="user_name" name="user_name" value="<?=$row['user_name']?>"  /></td>
								</tr>
								<tr>
									<th>아이디</th>
									<td><?=$row['user_id']?></td>
								</tr>
								
								<tr>
									<th>비밀번호</th>
									<td><input type="password" id="user_pw" name="user_pw"   /> <span>※ 변경 시에만 입력!</span></td>
								</tr>
								<tr>
									<th>이메일</th>
									<td><input type="email" id="user_email" name="user_email" value="<?=$row['user_email']?>"  /></td>
								</tr>
								<?
								$arr_mobile = explode("-", $row['mobile']);
								$mobile1 = $arr_mobile[0];
								$mobile2 = $arr_mobile[1];
								$mobile3 = $arr_mobile[2];
								?>
								<tr>
									<th>휴대폰</th>
									<td class="ph">
										<input type="text"id="mobile1" name="mobile1" value="<?=$mobile1?>" class="onlynum" maxlength="4"  /><span>-</span>
										<input type="text"id="mobile2" name="mobile2" value="<?=$mobile2?>" class="onlynum" maxlength="4"  /><span>-</span>
										<input type="text"id="mobile3" name="mobile3" value="<?=$mobile3?>" class="onlynum" maxlength="4"  />
									</td>
								</tr>
								<?
								$tmp_mod = $row['chmods'];
								$tmp_mod = substr($tmp_mod,1,sizeof($tmp_mod)-2);
								$arr_mod = explode("||",$tmp_mod);
								
								foreach($arr_mod as $key => $value){
									$chk_mod[$value] = "checked";

								}
								?>
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

													<li><input type="checkbox" id="k<?=$keys?>" name="chkNum[]" value="<?=$keys?>" <?=$chk_mod[$keys]?> /> <label for="k<?=$keys?>"><?=$values?></label></li>

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
					</div>
					<div class="com_btn_box">
						<div class="center">
							<a href="list02.php" class="gray_btn">리스트 이동</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>



<script type="text/javascript">

function fn_submit(){
	var frm = document.frm;

	if(frm.user_name.value == ""){
		alert("이름을 입력해주세요.");
		frm.user_name.focus();
		return false;
	}


	frm.submit();

}

function fn_del(idx){
	if(confirm("정말 삭제하시겠습니까?")){
		location.href="man_del.php?m_idx="+idx;
	}
}
</script>