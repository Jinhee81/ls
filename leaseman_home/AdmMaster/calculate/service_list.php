<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";



	$temp_years		= updateSQ($_GET[temp_years]);
	$c_month		= updateSQ($_GET[c_month]);
	$cates			= updateSQ($_GET[cates]);
	$searchtext		= updateSQ($_GET[searchtext]);
	
	
	if($temp_years==""){
		$temp_years = date('Y');
	}

	if($c_month==""){
		$c_month = date('m');
	}

	if( strlen($c_month)<2){
		$c_month = "0".$c_month;
	}

	$length6 = $temp_years . str_pad($c_month,2,'0',STR_PAD_LEFT);
	$length7 = $temp_years . "-" . str_pad($c_month,2,'0',STR_PAD_LEFT);



	$g_list_rows = 10;

	$strSql = "";

	

	if ($searchtext != "") {
		 $strSql .= " and ".$cates." like '%".$searchtext."%'  ";
	}
	
	
	$total_sql = " select c_idx, user_code, user_id, user_name from tbl_customer where 1=1 " . $strSql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);


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

						<form action="" method="get" >
							<fieldset>
								<legend>검색 조회 양식</legend>
								<div class="boxs">
									<label class="input_name long_txt">사용건수조회</label>
									
									<select name="temp_years" id="temp_years" class="mar_r10" onchange="fn_chg_year();" >
										
										<? for( $i=date('Y')-2; $i<=date('Y'); $i++){ ?>
										<option value="<?=$i?>" <?if($temp_years == $i)echo"selected";?> ><?=$i?></option>
										<? } ?>

									</select>							
									<select name="c_month" class="">
									<?for($month=1; $month<=12; $month++){?>
										<option value="<?=$month?>" <?if($c_month == $month)echo"selected";?> ><?=$month?>월</option>
									<?}?>
									</select>
									<select class="" name="cates">
										<option value="user_code">회원번호</option>
									</select>
									<input type="text" name="searchtext" value="<?=$searchtext?>">
										
									</input>
									<button type="submit">조회</button>
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
								$nPage = ceil($nTotalCount / $g_list_rows);
								if ($pg == "") $pg = 1;
								$nFrom = ($pg - 1) * $g_list_rows;
								
								$sql    = $total_sql . " order by c_idx desc limit $nFrom, $g_list_rows ";
								$result = mysql_query($sql) or die (mysql_error());
								$num = $nTotalCount - $nFrom;
								while($row=mysql_fetch_array($result)){
									$nums = $num;

									$_tmp_idx = $row['c_idx'];
									$c_idx = $_tmp_idx;
							

									
									
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
									<td><?=$nums?></td>
									<td><?=$row['user_code']?></td>
									<td><?=$row['user_name']?></td>
									<td><?=$row['user_id']?></td>
									<td><?=$temp_years?></td>
									<td><?=$c_month?></td>

									<td>전체<?=number_format( get_cnt_tbl_contract_date_cus($_tmp_idx,$length7,'') )?> (진행<?=number_format( get_cnt_tbl_contract_date_cus($_tmp_idx,$length7,'i') )?>,종료<?=number_format( get_cnt_tbl_contract_date_cus($_tmp_idx,$length7,'e') )?>)</td>
									<td><?=number_format( get_cnt_tbl_contract_etc_date_cus($_tmp_idx,$length7) )?></td>

									<td><?=number_format($row_sms['cnt_level_sms'])?></td>
									<td><?=number_format($row_sms['cnt_level_mms'])?></td>
									<td><?=number_format($row_sms['cnt_level_sms']+$row_sms['cnt_level_mms'])?></td>
									<td><?=number_format($row_bill['cnt_l'])?></td>
									
									<td><?=number_format($row_sms['cnt_point_sms']*$_danga_price[0])?></td>
									<td><?=number_format($row_sms['cnt_point_mms']*$_danga_price[1])?></td>
									<td><?=number_format($row_sms['cnt_point_sms']*$_danga_price[0]+$row_sms['cnt_point_mms']*$_danga_price[1])?></td>

									<td><?=number_format($row_bill['cnt_p']*$_danga_price[2])?></td>
								</tr>

							<?
							$num = $num - 1;
								}
							?>

							</tbody>
						</table>
					</div>
					
				</div>
			
			</div><!-- 서브 구분 -->

		</div>
	</section><!-- //container End -->
			<?php //include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?temp_years=".$temp_years."&c_month=".$c_month."&cates=".$cates."&searchtext=".$searchtext."&pg=")?>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
