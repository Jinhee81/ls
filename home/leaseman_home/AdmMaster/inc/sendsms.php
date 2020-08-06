<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";


$chkId		= $_GET['chkId'];




?>
<section class="pops_wrap">	
	
	<div class="pops_box pops_01_1">
		<div class="pops_h">
			<h2>문자메시지</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01 com_pdv">
				<form name="frm_sms" action="/AdmMaster/inc/send_msg_tong.php">
					<input type="hidden" name="fromhp" id="fromhp" value="<?=$_SESSION[member][mobile]?>" />
					<input type="hidden" name="goname" id="goname" value="<?=$_SESSION[member][idx]?>" />
					<input type="hidden" name="len_sms" id="len_sms" value="" readonly>



					<?
					$chkId = substr($chkId,1,strlen($chkId)-2);
					$array_chk = explode("||",$chkId);
					
					$text1 = "";
					for($i=0; $i<sizeof($array_chk); $i++){

						// 회원 정보
						$sql_m = "select * from tbl_customer where c_idx = '".$array_chk[$i]."'";
						$result_m = mysql_query($sql_m);
						$row_m = mysql_fetch_array($result_m);

						if($text1!=""){
							$text1 .= ", ";
						}
						$text1 .= $row_m['user_name'];
					?>

					<input type="hidden" name="r_idx_<?=$i?>" value="<?=$array_chk[$i]?>" readonly>
					<input type="hidden" name="chkNum[]" id="pops_02ck<?=$i?>" class="style_chk" value="<?=$i?>" >
					<input type="hidden" name="phone_<?=$i?>" value="<?=$row_m['mobile']?>" readonly>
					


					<?
					}
					?>


					<fieldset>
						<legend>문자메시지 입력 양식</legend>
						<div class="sms_view">
							
							<div class="sms_viewbox">
								
									<fieldset>
										<legend>메시지 보기 창</legend>
										<textarea class="sms_text one" name="sms_text" id="sms_text"></textarea>
										<p class="right_byte area_box_txt">0 / 80bytes</p>	
										<div class="sms_txt">
											<p class="tit01">회원명/건수</p>
											<p class="txt01"><?=$text1?></p>
											<p class="txt02">총 <?=sizeof($array_chk)?>건</p>
										</div>
									</fieldset>
								
							</div>
						</div>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r" onclick="fn_send();" >전송</button>
							<button type="button" class="gray pops_close_sub">닫기</button>
						</div>
					</fieldset>	
				</form>
			</div>
		</div>
	</div>
</section>



<script type="text/javascript">

var total_cnt = "<?=sizeof($array_chk)?>";

$(document).ready(function(){
	
	$(".sms_text").keyup(function(){
		var tmp_sms = $(this).val();

		$("#len_sms").val( chk_byte(tmp_sms) );

		var tmp_txt = chk_byte(tmp_sms)+" / 80byte";
		$(".area_box_txt").text(tmp_txt);

	});

});


function chk_byte(str){

	var l = 0;
    for (var i=0; i<str.length; i++){
		l += (str.charCodeAt(i) > 128) ? 2 : 1;
	}
    return l;

}


function fn_send(){

	var frm = document.frm_sms;
	frm.submit();

}

</script>