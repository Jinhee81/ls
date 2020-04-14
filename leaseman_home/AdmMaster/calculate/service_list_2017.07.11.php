<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox one">
				<h2 class="com_h2" data-type="정산관리" data-title="서비스사용내역">서비스사용내역</h2>
			</div>
			<section id="sub_container">		
		<div class="sub_wrap">
			<div class="syn_use">
				<div class="com_tb01 one">
					<div class="search_st01 one">
						<form action="">
							<fieldset>
								<legend>검색 조회 양식</legend>
								<div class="boxs">
									<label class="input_name long_txt">사용건수조회</label>
									
									<select name="temp_years" id="temp_years" class="mar_r10" onchange="fn_chg_year();" >
										
										<? for( $i=date('Y')-2; $i<=date('Y'); $i++){ ?>
										<option value="<?=$i?>" <?if($temp_years == $i)echo"selected";?> ><?=$i?></option>
										<? } ?>

									</select>							
									<select class="">
										<option>
											7월
										</option>
									</select>
									<select class="">
										<option>
											회원번호
										</option>
									</select>
									<input type="text">
										
									</input>
									<button type="button">조회</button>
								</div>
							</fieldset>
						</form>
					</div>
					<div class="ta_overwrap01">
						<table class="more_border">
							<caption>사용건수조회</caption>
							<colgroup>
							<col width="5.8%">
							<col width="5.8%">
							<col width="5.8%">
							<col width="5.8%">
							<col width="5.8%">
							<col width="4%">
							<col width="7.6%">
							<col width="5.8%">
							<col width="7%">
							<col width="7%">
							<col width="7%">
							<col width="5.8%">
							<col width="7%">
							<col width="7%">
							<col width="7%">
							<col width="5.8%">
						</colgroup>
							<thead>
								<tr>
									<th rowspan="3">순번</th>
									<th rowspan="3">회원정보</th>
									<th rowspan="3">회원명</th>
									<th rowspan="3">아이디</th>
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
									<td>1</td>
									<td>22222</td>
									<td>홍길동</td>
									<td>아이디</td>
									<td><?=$temp_years?></td>
									<td><?=$mon?></td>

									<td>전체<?=number_format( get_cnt_tbl_contract_date($length7,'') )?> (진행<?=number_format( get_cnt_tbl_contract_date($length7,'i') )?>,종료<?=number_format( get_cnt_tbl_contract_date($length7,'e') )?>)</td>
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
			
			</div><!-- 서브 구분 -->

		</div>
	</section><!-- //container End -->
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
