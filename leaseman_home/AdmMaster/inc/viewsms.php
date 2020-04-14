<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";



$idx = $_GET['idx'];
$types = $_GET['types'];

//echo $types;
if($types=="S"){

	$total_sql = "
	select h.idx, h.phone, h.CALLBACK, h.regdate, h.msg, h.status, h.u_idx, h.c_idx, h.sms_type, h.pc_type, c.user_name, c.user_id, c.user_code
	 from (
	  SELECT 
	   tr_num as idx 
	  ,tr_phone as phone
	  ,tr_callback as callback
	  ,tr_realsenddate as regdate
	  ,tr_msg as msg
	  ,tr_sendstat as status
	  ,tr_etc5 as u_idx
	  ,tr_etc6 as c_idx
	  ,'S' as sms_type
	  ,tr_etc1 as pc_type
	  FROM SC_TRAN SC 
	 WHERE tr_num = '".$idx."'
	 ) h 
	 LEFT OUTER JOIN tbl_customer c
	 on h.u_idx = c.c_idx
	 ";
	
}else{

	$total_sql = "
	select h.idx, h.phone, h.CALLBACK, h.regdate, h.msg, h.status, h.u_idx, h.c_idx, h.sms_type, h.pc_type, c.user_name, c.user_id, c.user_code
	 from (
	  SELECT 
	   msgkey as idx
	  ,phone as phone
	  ,callback as callback
	  ,sentdate as regdate
	  ,msg as msg
	  ,status as status
	  ,etc2 as u_idx
	  ,etc3 as c_idx
	  ,'M' as sms_type
	  ,etc1 as pc_type
	  FROM MMS_MSG
	  where msgkey = '".$idx."'
	 ) h
	 LEFT OUTER JOIN tbl_customer c
	 on h.u_idx = c.c_idx
	";

}
//echo "total_sql : " . $total_sql;
$result = mysql_query($total_sql) or die (mysql_error());
$row = mysql_fetch_array($result);


?>
<section class="pops_wrap">
	<div class="pops_box pops_01">
		<div class="pops_h">
			<h2>문자메시지</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01 com_pdv">
				
				<form name="frm_sms" action="/AdmMaster/inc/send_msg_re.php">
					<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />
					<input type="hidden" name="types" id="types" value="<?=$types?>" />

					<fieldset>
						<legend>문자메시지 입력 양식</legend>
						<div class="sms_view">
							
							<div class="sms_viewbox">
								

									<fieldset>
										<legend>메시지 보기 창</legend>
										<textarea name="" id="" readonly><?=$row['msg']?></textarea>
										<p class="right_byte"><?=mb_strlen($row['msg'], 'euc-kr')?> / 80bytes</p>
										<ul class="sms_viewul">
											<li><p>이름</p><input type="text" name="" id="" value="<?=$row['user_name']?>" readonly></li>
											<li><p>수신번호</p><input type="text" name="" id="" value="<?=$row['phone']?>" readonly ></li>
											<li><p>발신번호</p><input type="text" name="" id="" value="<?=$row['CALLBACK']?>" readonly ></li>
										</ul>
									</fieldset>
								
							</div>
						</div>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r" onclick="fn_send();">재전송</button>
							<button type="button" class="gray pops_close">닫기</button>
						</div>
					</fieldset>	
				</form>

			</div>
		</div>
	</div>
</section>



<script type="text/javascript">


function fn_send(){
	
	var frm = document.frm_sms;
	frm.submit();

}

</script>