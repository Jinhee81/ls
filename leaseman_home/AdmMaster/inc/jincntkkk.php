<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";

	$c_idx		= updateSQ($_GET[idx]);

	$temp_years = $_GET['temp_years'];

	if($temp_years == ""){
		$temp_years = date("Y");
	}



?>
<section class="pops_wrap">
	<div class="pops_box pops_05_3 one">
		<div class="pops_h">
			<h2>사용건수</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01 one">
				<div class="ta_overwrap01">
					<div class="search_st01 two">
						<form action="" name="frm" method="get" >
							<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />
							<fieldset>
								<legend>검색 조회 양식</legend>
								<div class="boxs one">
									<label class="input_name long_txt">사용건수조회</label>
									
									<select name="temp_years" id="temp_years" class="mar_r10" onchange="fn_chg_year();" >
										
										<? for( $i=date('Y')-2; $i<=date('Y'); $i++){ ?>
										<option value="<?=$i?>" <?if($temp_years == $i)echo"selected";?> ><?=$i?></option>
										<? } ?>

									</select>							

								</div>
							</fieldset>
						</form>
					</div>
					<table class="more_border">
						<caption>사용건수조회</caption>
						<colgroup>
							<col width="8%">
							<col width="8%">
							<col>
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
						</colgroup>
						<thead>
							<tr>
								<th rowspan="3">년</th>
								<th rowspan="3">월</th>
								<th rowspan="3">계약</th>
								<th rowspan="3">기타계약</th>
								<th colspan ="4">정기권사용</th>
								<th colspan ="4">코인사용</th>
							</tr>
							<tr>
								<th colspan="3">문자</th>
								<th rowspan="2">세금계산서</th>
								<th colspan="3">문자</th>
								<th rowspan="2">세금계산서
								<br />(차감코인)</th>
							</tr>
							<tr>
								<th>단문(차감건수)</th>
								<th>전문(차감건수)</th>
								<th>전체(차감건수)</th>
								<th>단문(차감코인)</th>
								<th>전문(차감코인)</th>
								<th>전체(차감코인)</th>
							</tr>
						</thead>
						<tbody>
					
							<?
							for($mon = 1; $mon <=12; $mon++){ 
								
								$length6 = $temp_years . str_pad($mon,2,'0',STR_PAD_LEFT);
								$length7 = $temp_years . "-" . str_pad($mon,2,'0',STR_PAD_LEFT);

								// 세금계산서
								$sql_bill = " select sum(if(send_type='P',1,0)) cnt_p, sum(if(send_type='L',1,0)) cnt_l from tbl_billa where c_idx = '".$c_idx." ' and left(writeDate,6) = '" . $length6 . "' ";
								$result_bill = mysql_query($sql_bill);
								$row_bill = mysql_fetch_array($result_bill);
								
								// 문자
								$sql_sms = " select 
													 sum(if(h.spend_type='L' && h.sms_type='S',1,0)) as cnt_level_sms
													,sum(if(h.spend_type='L' && h.sms_type='M',1,0)) as cnt_level_mms
													,sum(if(h.spend_type='P' && h.sms_type='S',1,0)) as cnt_point_sms
													,sum(if(h.spend_type='P' && h.sms_type='M',1,0)) as cnt_point_mms
												from (
												  ( SELECT tr_num as idx ,tr_phone as phone ,tr_callback as callback ,tr_realsenddate as regdate ,tr_msg as msg ,tr_sendstat as status ,tr_etc5 as u_idx ,tr_etc6 as c_idx ,tr_etc4 as spend_type ,'S' as sms_type ,tr_etc1 as pc_type FROM SC_TRAN SC WHERE tr_sendstat = '2' ) 
												union all
												  ( SELECT msgkey as idx ,phone as phone ,callback as callback ,TERMINATEDDATE as regdate ,msg as msg ,status as status ,etc2 as u_idx ,etc3 as c_idx ,etc4 as spend_type ,'M' as sms_type ,etc1 as pc_type FROM MMS_MSG where status = '3' ) ) h 
												LEFT OUTER JOIN tbl_user u on h.u_idx = u.r_idx where h.c_idx = '".$c_idx."' and  left(h.regdate,7) = '".$length7."'
											";
								$result_sms = mysql_query($sql_sms);
								$row_sms = mysql_fetch_array($result_sms);
							?>
								<tr>
									<td><?=$temp_years?></td>
									<td><?=$mon?></td>
									<td>전체<?=number_format( get_cnt_tbl_contract_date_cus($c_idx,$length7,'') )?> (진행<?=number_format( get_cnt_tbl_contract_date_cus($c_idx,$length7,'i') )?>,종료<?=number_format( get_cnt_tbl_contract_date_cus($c_idx,$length7,'e') )?>)</td>
									<td><?=number_format( get_cnt_tbl_contract_etc_date($length7) )?></td>
									<td><?=number_format($row_sms['cnt_level_sms'])?></td>
									<td><?=number_format($row_sms['cnt_level_mms'])?></td>
									<td><?=number_format($row_sms['cnt_level_sms']+$row_sms['cnt_level_mms'])?></td>
									<td><?=number_format($row_bill['cnt_l'])?></td>
									<td><?=number_format($row_sms['cnt_point_sms']*$_danga_price[0])?></td>
									<td><?=number_format($row_sms['cnt_point_mms']*$_danga_price[1])?></td>
									<td><?=number_format($row_sms['cnt_point_sms']*$_danga_price[0]+$row_sms['cnt_point_mms']*$_danga_price[1])?></td>
									<td><?=number_format($row_bill['cnt_p']*$_danga_price[2])?></td>
								</tr>
							<?}?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

function fn_chg_year(){
	document.frm.submit();
}

</script>