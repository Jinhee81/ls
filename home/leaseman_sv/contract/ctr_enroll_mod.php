<title>[126] 계약보기</title>
<?php
	include $_SERVER['DOCUMENT_ROOT']."/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/inc/header_inc.php";
?>



<?
	$idx = $_GET['idx'];

	$total_sql = " select c.*, u.memo, u.user_code, u.user_name,  u.mobile, u.email, u.com_type, u.com_name, u.r_idx as user_idx, b.aliasName, r.roomname, g.goodsname  from tbl_contract c LEFT OUTER JOIN tbl_user u ON c.u_idx = u.r_idx  LEFT OUTER JOIN tbl_build b ON c.b_idx = b.idx LEFT OUTER JOIN tbl_room r ON c.r_idx = r.idx  LEFT OUTER JOIN tbl_goods g ON c.g_idx = g.idx where c.c_idx = '".$_SESSION[customer][idx]."' and c.idx = '".$idx."' ";
	$result = mysql_query($total_sql) or die (mysql_error());
	$row = mysql_fetch_array($result);

	
	$sql_cnt = "SELECT @RN:=@RN+1 AS ROWNUM, TB.*
	FROM(
		select *
		from tbl_contract where u_idx = '".$row['u_idx']."' 
		and con_type = 'c' 
		order by s_date asc, r_date desc
	) AS TB, 
	(SELECT @RN:=0) AS R
	";

	//echo $sql_cnt . "<br/>";
	$result_cnt = mysql_query($sql_cnt);
	$tmps_de_cnt = "";
	while($row_cnt = mysql_fetch_array($result_cnt)){
		if($idx == $row_cnt['idx']){
			$tmps_de_cnt = $row_cnt['ROWNUM'];
		}
	}

?>



<iframe name="ifm_users" id="ifm_users" src="" style="width:0px;height:0px;" ></iframe>
	<section id="sub_container">		

	
	
	<style>

	.file_input_textbox{ width:250px; float:left;}

	.file_input_div{position:relative;width:100px;height:30px;overflow:hidden; display:inline-block; float:left; }
	.file_input_div::after{content:"파일선택"; position:absolute; left:0; top:6px; width:100%; height:100%; text-align:center;
	letter-spacing:1px; font-weight:bold; color:#333;}
	.file_input_hidden{width:100px; height:30px;  border-left:0;  }
	.com_another .search_st03 input.file_input_button{width:100px;height:30px;position:absolute; top:0px; background-color:#aaa; color:#fff; 
	background:#fff; border:1px solid #d9d9d9; border-left:0; cursor:pointer;}

	.file_input_hidden{font-size:45px; position:absolute; right:0px; top:0px; opacity:0; color:#333; border-style:solid;background:#fff; 
	border:1px solid #d9d9d9; z-index:10; cursor:pointer;}
	.filter:alpha(opacity=0); 

	-ms-filter:"alpha(opacity=0)"; 

	-khtml-opacity:0; 

	-moz-opacity:0;}

	</style>

	<link href="/contract/contract.css" rel="stylesheet" type="text/css"/>
	<script src="/contract/contract.js"></script>




		<div class="sub_wrap">
			<div class="ctr_enroll">
				<div class="com_hbox">
					<h2 class="com_h2" data-type="계약관리"  data-title="계약관리">계약보기</h2>
					<ul class="right">
						<?
						$sql_help = "select * from tbl_help where idx = 3";
						$result_help = mysql_query($sql_help);
						$row_help = mysql_fetch_array($result_help);
						if($row_help['status'] == "Y"){
						?>
						<li class="mar_r"><button type ="button" rel="3" class="pops_22btn"><img src="../img/ico/how_goods_icon.png"></button></li>
						<?}?>
						<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지" class="printman"></a></li>

						<!-- 
						<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
						<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li> -->
					</ul>
					
						
					
				</div>

				<div class="com_btn_box">
					<div class="left">
						계약번호 : <?=$row['ordernum']?>
					</div>
					<div class="right">
					<?
					// 목록 리스트
					$list_link = $_SESSION[customer][ref];
					if($list_link==""){
						$list_link = "ctr_list.php";
					}
					?>
						<button type="button" class="gray_btn wd_90 mar_r " onclick="fn_sms('<?=$row[u_idx]?>');"  >문자보내기</a></button>

						<button type="button" class="gray_btn wd_56 mar_r" onClick="location.href='/contract/<?=$list_link?>?chk_de=1'">목록</button>
						<!--
						<button type="button" class="gray_btn wd_90 mar_r" onClick="location.href='/manage/mg_mod.php?r_idx=<?=$row['u_idx']?>'">고객정보수정</button>
						-->
						<button type="button" rel="<?=$row['user_idx']?>" class="gray_btn wd_90 mar_r pops_02btn" >고객정보수정</button>
						
						<button type="button" class="gray_btn wd_90 mar_r pops_03btn" rel="<?=$row['u_idx']?>" >고객계약조회</a></button>

						<button type="button" class="gray_btn wd_70 mar_r pops_07btn" rel="<?=$row['idx']?>" >계약종료</button>
						<!--
						<button type="button" class="gray_btn wd_70 mar_r pops_07btn" onclick="fn_ends(<?=$row['idx']?>);">계약종료</button>
						-->
						<button type="button" class="gray_btn wd_56 mar_r">초기화</button>
						<button type="button" class="gray_btn wd_56 mar_r" onclick="fn_dels(<?=$row['idx']?>);">삭제</button>
						<button type="button" class="blue_btn wd_120 mar_r" onclick="fn_save2();" >보증금/환불수정</button>
						<button type="button" class="blue_btn wd_56" onclick="fn_save();" >수정</button>		
						
					</div>
				</div>
				<div class="com_tb01 enroll">
					<form name="fm_encroll" id="fm_encroll" method="post" action="./enroll_mod_period_ok.php" target="ifm_users" >
						<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />
						<input type="hidden" name="delchk" id="delchk" value="" />
						<!--
						<input type="hidden" name="pay_type" id="pay_type" value="<?=$row['pay_type']?>" />
						-->
						
						
						<fieldset>
							<table style="min-width:1200px;">
								<colgroup>
									<col width="120px">	
									<col width="30%">	
									<col width="120px">	
									<col width="30%">	
									<col width="120px">	
									<col width="30%">	
								</colgroup>
								<tbody>
									<tr>
										<th>&#183; 고객명</th>
										<td><span style="margin-right:10px;" id="user_name" ></span></td>
										<th>&#183; 핸드폰</th>
										<td id="mobile"></td>
										<th>&#183; 계약회차</th>
										<td>
										<?
											/*
											$sql_cc = "select count(*) as cnts from tbl_contract where con_type = 'c'  and u_idx = '".$row['user_idx']."' and idx <= $idx";
											$result_cc = mysql_query($sql_cc);
											$row_cc = mysql_fetch_array($result_cc);
											echo $row_cc['cnts'];
											*/
											echo $tmps_de_cnt;

											


										?>
											<?//=$row['period']?>
										</td>
									</tr>
									<tr>
										<th>&#183; 형태</th>
										<td id="com_type"></td>
										<th>&#183; 사업자명</th>
										<td id="com_name"></td>
										<th>&#183; 사업자번호</th>
										<td id="com_num"></td>
										
									</tr>
									<tr>
										<th>&#183; 특이사항</th>
										<td colspan="5" id="memo"><?=$row['memo']?></td>
									</tr>
									<tr>
										<th>&#183; 상품</th>
										<td>
											<select name="g_idx" id="g_idx">
												<?
												$sql_o = " select * from tbl_goods where types='0' and  c_idx = '".$_SESSION[customer][idx]."'  ";
												$result_o = mysql_query($sql_o) or die (mysql_error());
												while($row_o = mysql_fetch_array($result_o)){
												?>
													<option value="<?=$row_o['idx']?>" <?if($row_o['idx']==$row['g_idx'])echo "selected";?> ><?=$row_o['goodsname']?></option>
												<?}?>
											</select>
										</td>
										<th>&#183; 방/좌석번호</th>
										<td colspan="3">

											<select name="sb_chk" id="sb_chk" onchange="chg_sb(this);">
												<option value="">전체</option>
												<option value="s" selected>공실</option>
												<option value="b">만실</option>
											</select>

											<select name="b_idx" id="b_idx" onchange="chg_build(this);">
												<option rel="" value="">건물별명</option>
												<?
												$sql_o = " select * from tbl_build where c_idx = '".$_SESSION[customer][idx]."' and status='0'  ";
												$result_o = mysql_query($sql_o) or die (mysql_error());
												while($row_o = mysql_fetch_array($result_o)){
												?>
													<option rel="<?=$row_o['pay_type']?>" value="<?=$row_o['idx']?>" <?if($row_o['idx']==$row['b_idx'])echo "selected";?> ><?=$row_o['aliasName']?></option>
												<?}?>
											</select>

											<select name="gr_idx" id="gr_idx" onchange="chg_gr_idx(this)">
												<option value="">방그룹명</option>
												<?
												$sql_o = " select * from tbl_rgroup where b_idx = '".$row['b_idx']."' ";
												$result_o = mysql_query($sql_o) or die (mysql_error());
												while($row_o = mysql_fetch_array($result_o)){
												?>
													<option value="<?=$row_o['idx']?>" <?if($r_idx==$row_o['idx'])echo"selected";?> ><?=$row_o['g_name']?></option>
												<?}?>
											</select>

											<select name="r_idx" id="r_idx">
												<?
												$sql_o = " select * from tbl_room where c_idx = '".$_SESSION[customer][idx]."' and b_idx='".$row['b_idx']."' order by ordernum asc  ";
												$result_o = mysql_query($sql_o) or die (mysql_error());
												while($row_o = mysql_fetch_array($result_o)){
													if($row_o['idx']==$row['r_idx']){
														$chk_rgroup = $row_o['rgroup'];
													}
												?>
													<option value="<?=$row_o['idx']?>" <?if($row_o['idx']==$row['r_idx'])echo "selected";?> ><?=$row_o['roomname']?></option>
												<?}?>
											</select>
											<select name="pay_type" id="pay_type">
												<?foreach($_pay_type as $key => $value){?>
												<option value="<?=$key?>" <?if($key==$row['pay_type']){echo"selected";}?>  ><?=$value?></option>
												<?}?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
							<table>
								<colgroup>
									<col width="120px">	
									<col width="20%">	
									<col width="120px">	
									<col width="20%">	
									<col width="120px">	
									<col width="20%">	
									<col width="120px">	
									<col width="20%">	
								</colgroup>
								<tbody>
									<tr>
										
										<th>&#183; 기간</th>
										<td><input type="text" class="wd_70 ta_right onlynum" name="period" id="period" value="<?=$row['period']?>" /><span class="txt01">개월</span></td>
										<th>&#183; 시작일</th>
										<td><input type="text" name="s_date" id="s_date" class="calendar2" value="<?=$row['s_date']?>" readonly></td>
										<th>&#183; 종료일</th>
										<td><input type="text" name="e_date" id="e_date" class="" value="<?=$row['e_date']?>" readonly></td>

										<th>&#183; 계약일</th>
										<td><input type="text" name="c_date" id="c_date" value="<?=$row['c_date']?>" class="calendar2" readonly></td>
									</tr>




									<tr>
										<th>&#183; 월이용료</th>
										<td colspan="7" class="another">
											<div class="inline_block">	
												<span class="tit">공급가액</span><input type="text" name="supply" id="supply" class="wd_139 ta_right onlynum numcom" value="<?=$row['supply']?>"><span class="txt01">원</span>
											</div>
											<div class="inline_block">
												<span class="tit">세액</span><input type="text" name="tax" id="tax" class="wd_139 ta_right onlynum numcom" value="<?=$row['tax']?>"><span class="txt01">원</span>
											</div>
											<div class="inline_block">
												<span class="tit">관리비</span><input type="text" name="cost" id="cost" class="wd_139 ta_right onlynump numcom"	value="<?=$row['cost']?>"><span class="txt01">원</span>
											</div>
											<div class="inline_block">
												<span class="tit">합계</span><input type="text" name="total_price" id="total_price" readonly class="wd_139 ta_right onlynum numcom" value="<?=$row['total_price']?>"><span class="txt01">원</span>
											</div>	
										</td>
									</tr>
									<tr>
										<th>&#183; 보증금</th>
										<td colspan="7" class="another">
											<div class="inline_block">
												<span class="tit">입금액</span><input type="text" name="de_in" id="de_in" class="wd_139 ta_right onlynum numcom" value="<?=$row['de_in']?>"><span class="txt01">원</span>
											</div>
											<div class="inline_block">
												<span class="tit">입금일</span><input type="text" name="de_in_date" id="de_in_date" class="calendar2" value="<?=$row['de_in_date']?>">
											</div>
											<div class="inline_block">
												<span class="tit">출금액</span><input type="text" name="de_out" id="de_out" class="wd_139 ta_right onlynum numcom" value="<?=$row['de_out']?>"><span class="txt01">원</span>
											</div>
											<div class="inline_block">
												<span class="tit">출금일</span><input type="text" name="de_out_date" id="de_out_date" class="calendar2" value="<?=$row['de_out_date']?>">
											</div>
											<div class="inline_block">
												<span class="tit">잔액</span><input type="text" name="de_bal" id="de_bal" readonly class="wd_139 ta_right onlynum numcom" value="<?=$row['de_bal']?>"><span class="txt01">원</span>
											</div>
										</td>
									</tr>

									<tr>
										<th>&#183; 환불</th>
										<td colspan="7" class="another">
											<div class="inline_block">
												<span class="tit">환불액</span><input type="text" name="outmoney" id="outmoney" class="wd_139 ta_right onlynum numcom" value="<?=$row['outmoney']?>"><span class="txt01">원</span>
											</div>
											<div class="inline_block">
												<span class="tit">환불일</span><input type="text" name="outm_date" id="outm_date" class="calendar2" value="<?=$row['outm_date']?>">
											</div>
											
										</td>
									</tr>



								</tbody>
							</table>
							<table>
								<colgroup>
									<col width="120px">	
									<col width="30%">	
									<col width="120px">	
									<col width="30%">	
									<col width="120px">	
									<col width="30%">	
								</colgroup>
								<tbody>
									<tr>
										<th>&#183; 상태</th>
										<td>
											<?
											$tmp_status = $row['status'];

											if($row['e_date'] < date('Y-m-d') ){
												$tmp_status = 1;
											}
											?>
											<?=$_enroll_status[$tmp_status]?>

										</td>
										<th>&#183; 등록일시</th>
										<td><?=$row['r_date']?></td>
										
										<th>&#183; 수정일시</th>
										<td><?=$row['m_date']?></td>
										
									</tr>
								</tbody>
							</table>
						</fieldset>
					</form>
				</div>
				<div class="search_st01 ">
					<form action="">
						<fieldset>
							<legend>검색 조회 양식</legend>
							<span class="boxs">
								<button type="button" class="btn_st01" onclick="addMonth(1)">추가</button>
								<button type="button" class="btn_st01" onclick="addMonth(-1)">삭제</button>
							</span>
							<span class="boxs">
								<label class="input_name">입금예정일묶음</label>
								<input type="text" name="b_date" id="b_date" class="calendar2 " >
							</span>
							<span class="boxs">
								<label class="input_name">입금구분</label>
								<select name="income_type" id="income_type">
									<?foreach($_income_type as $key => $value ){?>
									<option value="<?=$key?>"><?=$value?></option>
									<?}?>
									
								</select>
								<!--
								<button type="button" class="btn_st01">넣기</button>
								-->
							</span>
							<span class="boxs left">
								<button type="button" class="btn_st01 one" onclick="fn_subsave('<?=$idx?>');" >청구설정</button>
								<!--<button type="button" class="btn_st01" onclick="fn_calls('<?=$idx?>');" >청구설정</button>-->
								<button type="button" class="btn_st02" onclick="fn_del_calls('<?=$idx?>');" >청구취소</button>							
								<!--	 
								<button type="button" class="btn_st01" onclick="fn_exceldown('<?=$row['idx']?>');" >엑셀다운</button>
								<button type="button" class="btn_st01 inexcels">일괄등록</button>
								-->
								<button type="button" class="btn_st01" onclick="fn_all_m3('<?=$row['idx']?>');">일괄입금</button>
								<!--
								<button type="button" class="btn_st01" onclick="fn_all_m('<?=$row['idx']?>');">일괄입금</button>
								-->
								<button type="button" class="btn_st01" onclick="fn_all_m2('<?=$row['idx']?>');">일괄입금취소</button>
							</span>
						</fieldset>
					</form>
				</div>


				<div class="excel_up" >
					<div class="right">
						<form name="excel_up" action="/inc/excel_in_price.php" method="post" enctype="multipart/form-data">
							
							<span>엑셀 업로드</span>
							<input name="excel_up" type="file" id="excel_up" />
							<button type="button" class="blue_btn wd_70" onclick="fn_exel_up();" >등록</button>
							<button type="button" class="gray_btn wd_70 excel_close" >취소</button>
							
						</form>
					</div>
				</div>
				<script type="text/javascript">
					function fn_exel_up(){
						var frm = document.excel_up;
						if(frm.excel_up.value==""){
							alert("파일을 등록해주세요.");
							return false;
						}
						frm.submit();
					}
				</script>



				<?

				$sql_sum = "select sum(supply) as t_supply, sum(tax) as t_tax, sum(cost) as t_cost, sum(total_price) as t_total_price  from tbl_contract_sub where c_idx = '".$idx."' and status = 1 ";
				$result_sum = mysql_query($sql_sum);
				$row_sum = mysql_fetch_array($result_sum);


				$sql_sub = "select * 
							, datediff(ifnull((date_format(r_date,'%Y-%m-%d') ),now() )    ,date_format(b_date,'%Y-%m-%d') ) as late_date
							";

				$sql_sub .= " from tbl_contract_sub ";
				$sql_sub .= " where c_idx = '".$row['idx']."'  ";
				$sql_sub .= " order by ordernum asc ";

				//echo $sql_sub;
				$result_sub = mysql_query($sql_sub);


				?>

				<div class="com_tb01">
					<form name="fm_sub" id="fm_sub" method="post" action="" target="ifm_users" > <!--  target="ifm_users" -->
						<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />
					<table style="min-width:1300px;">
						<caption>계약 등록 표</caption>
						<colgroup>
							<col width="50px">
							<col width="50px">
						</colgroup>
						<thead>
							<tr>
								<th><input type="checkbox" id="ctr_enrollck01" class="all_check"><label for="ctr_enrollck01"></label></th>
								<th>순번</th>
								<th>시작일</th>
								<th>종료일</th>
								<th>공급가액</th>
								<th>세액</th>
								<th>관리비</th>
								<th>예정금액</th>
								<th>
									<div class="check">
										<input type="text" class="onlynum numcom" style="width:110px;text-align:left;" name="re_day" id="re_day" maxlength="2" value="" placeholder="예정일변경"/ >
										<button type="button" onclick="chg_re_day('<?=$idx?>');" class="btn_st01 img" ><img src="../img/sub/check_img.png"></button>
									</div>
								</th>
								<th>
									<p>입금<br />구분</p>
								</th>
								<th>
									<p>청구<br />번호</p>
								</th>

								<th>입금일</th>
								<th>입금액</th>
								<th>수납구분</th>
								<th>미납액</th>
								<th>연체일수</th>
								<th>연체이자</th>

								<th>세금계산서</th>
							</tr>
						</thead>
						<tbody>
							

							<?
							$num_row = 0;
							$sum_late_price = 0;
							$sum_late_date = 0;
							$sum_late_rate = 0;

							$old_callnum = "";

							$del_smile = 0;	// 삭제 못할래
							$hold_date = "";

							while($row_sub = mysql_fetch_array($result_sub)){
								$num_row++;

								if($old_callnum != $row_sub['callnum']){
									$old_callnum = $row_sub['callnum'];
									$print_callnum = $old_callnum;
									$hold_date = $row_sub['r_date'];
								}else{
									$print_callnum = "";
									

								}



								//연체일
								if($print_callnum){

									if($row_sub['late_date']>0){
										$late_date = $row_sub['late_date'];
									}else{
										$late_date = "0";
									}

									// 연체이자, 미납액 구하기
									$sql_sub2 = "select * 
												, datediff(ifnull((date_format(max(r_date),'%Y-%m-%d') ),now() )    ,date_format(b_date,'%Y-%m-%d') ) as late_date
												, count(*) as cnt_row
												, sum(supply) as t_supply
												, sum(tax) as t_tax
												, sum(cost) as t_cost
												, sum(total_price) as t_total_price
												, min(s_date) as t_s_date
												, max(e_date) as t_e_date
												, max(r_date) as t_r_date
												, max(r_price) as t_r_price
												";


									$sql_sub2 .= " from tbl_contract_sub ";
									$sql_sub2 .= " where callnum = '".$print_callnum."'  ";
									$sql_sub2 .= " order by ordernum asc ";

									//echo $print_callnum."<br/>".$sql_sub2 . "<br/>";
									$result_sub2 = mysql_query($sql_sub2);
									$row_sub2 = mysql_fetch_array($result_sub2);



									//연체이자
									if($late_date>0){
										$late_rate = round(($row_sub2['t_total_price'] * 0.2 / 365 * $late_date),0);
									}else{
										$late_rate = "0";
									}

									//미납액
									/*
									if($late_date>0){
										$late_price = $row_sub2['t_total_price'] - $row_sub2['t_r_price'] + $late_rate;
									}else{
										$late_price = "0";
									}
									*/

									// 연체이자는 제외시켜달라는 요청
									//$late_price = $row_sub2['t_total_price'] - $row_sub2['t_r_price'] + $late_rate;
									$late_price = $row_sub2['t_total_price'] - $row_sub2['t_r_price'];
									

									$sum_late_price += $late_price;
									$sum_late_date += $late_date;
									$sum_late_rate += $late_rate;
								}

								
						?>

							<tr>
								<td>
									<?if($row_co['t_r_price']==""){?>
									<input type="checkbox" name="chkNum[]" id="ctr_enrollck<?=$row_sub['ordernum']?>" class="chk_list" value="<?=$row_sub['idx']?>" price="<?=$row_sub['supply']+$row_sub['tax']+$row_sub['cost']?>" callnum="<?=$row_sub['callnum']?>" ><label for="ctr_enrollck<?=$row_sub['ordernum']?>"></label>
									<?}?>
								</td>
								<td><?=$row_sub['ordernum']?></td>
								<td><?=$row_sub['s_date']?></td>
								<td><?=$row_sub['e_date']?></td>

								<?if($row_sub['callnum']==""){?>
									<td class="align_r2">
										<input type="text" class="onlynum numcom allchk" style="width:70px;text-align:right;" name="supply<?=$row_sub['idx']?>" id="supply<?=$row_sub['idx']?>" value="<?=number_format($row_sub['supply'])?>" />
									</td>
									<td class="align_r2">
										<input type="text" class="onlynum numcom allchk" style="width:70px;text-align:right;" name="tax<?=$row_sub['idx']?>" id="tax<?=$row_sub['idx']?>" value="<?=number_format($row_sub['tax'])?>" />
									</td>
									<td class="align_r2">
										<input type="text" class="onlynum numcom allchk" style="width:70px;text-align:right;" name="cost<?=$row_sub['idx']?>" id="cost<?=$row_sub['idx']?>" value="<?=number_format($row_sub['cost'])?>" />
									</td>
									<td class="align_r2"><?=number_format($row_sub['supply']+$row_sub['tax']+$row_sub['cost'])?></td>
									<td><input type="text" style="width:90px;" class="calendar2  allchk" name="b_date<?=$row_sub['idx']?>" id="b_date<?=$row_sub['idx']?>" value="<?=$row_sub['b_date']?>"></td>
									
									<!--
									<td>
										<select name="income_type<?=$row_sub['idx']?>" id="income_type<?=$row_sub['idx']?>">
											<?foreach($_income_type as $key => $value ){?>
											<option value="<?=$key?>" <?if($key==$row_sub['income_type'])echo"selected";?> ><?=$value?></option>
											<?}?>											
										</select>
									</td>
									-->

								<?}else{?>
									<td class="align_r2"><?=number_format($row_sub['supply'])?></td>
									<td class="align_r2"><?=number_format($row_sub['tax'])?></td>
									<td class="align_r2"><?=number_format($row_sub['cost'])?></td>
									<td class="align_r2"><?=number_format($row_sub['supply']+$row_sub['tax']+$row_sub['cost'])?></td>
									<td><?=$row_sub['b_date']?></td>
									
								<?}?>

								<td><?=$_income_type[$row_sub['income_type']]?></td>


								<?if($print_callnum){
									$del_smile++;
								?>
									<td>
										<a href="#!" class="pops_19btn" rel="<?=$print_callnum?>" ><?=$print_callnum?></a>
									</td>
									<td><?=$row_sub['r_date']?></td>
									<td><?=number_format($row_sub['r_price'])?></td>
									<td>
										<?
										if($row_sub['r_price']==""){
											if($row_sub['late_date']>0){
												echo "미납";
											}else{
												echo "입금대기";
											}
										}else{
											//if($late_price>0){	 변덕으로 인하여 이자는 뺴고서 완납 여부 정함
											if( ($late_price - $late_rate) > 0){
												echo "미납";
											}else{
												echo "완납";
												
											}
											if($late_date>0){
												echo "(연체)";
											}
										}
										?>
									</td>
									<td><?=number_format($late_price)?></td>
									<td><?=number_format($late_date)?></td>
									<td><?=number_format($late_rate)?></td>

								<?}else{?>

									<td></td>
									<td><?=$hold_date?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>

								<?}?>

								<?
								$sql_bill = "select * from tbl_billa where ordernum = '".$print_callnum."' ";
								$result_bill = mysql_query($sql_bill);
								$row_bill = mysql_fetch_array($result_bill);
								?>
								<td>
									<?if($print_callnum){?>
										<?if($row_bill['idx']){?>
											<b class="mar_r pops_20btn" rel="<?=$print_callnum?>" >보기</b>
										<?}else{
											echo "-";
										}?>
									<?}else{
										echo "";
									}
									?>
								</td>
							</tr>

							<?
								}
							?>
							
						</tbody>
					</table>
					</form>
				</div>




				<!-- 하단 추가 부분 시작 -->


				<div class="com_another">
					<form name="frm_file" id="frm_file" action="bbs_proc.ajax.php" method="post" enctype="multipart/form-data" >
						<input type="hidden" name="memo_c_idx" id="memo_c_idx" value="<?=$idx?>" />

						<div class="search_st03">
							<!--
							<input type="file" class="upload_file">
							-->

							<input type="text" id="fileName" class="file_input_textbox left" readonly="readonly" style="width:326px;">

							<div class="file_input_div">

								<input type="button" value="파일선택" class="file_input_button" >

							   <input type="file" name="ufile1" class="file_input_hidden" onchange="javascript:document.getElementById('fileName').value = this.value.split('\\')[this.value.split('\\').length-1]"> 
							  파일선택


							</div>

							<!--
							<button type="button" class="left" onclick="fn_send_file();">등록</button>
							-->
							<button type="submit" class="left">등록</button>
						</div>

					</form>

						<?
						// 파일 관련 내용을 뽑자
						$sql_file = "select * from tbl_contract_file where c_idx = '".$idx."' order by idx asc ";
						//echo $sql_file;
						$result_file = mysql_query($sql_file);
						$file_total = mysql_num_rows($result_file);
						//echo $file_total;
						?>


						<div class="table_another">
							<table>
								<colgroup>
									<col style="width:10%">
									<col style="*">
									<col style="width:15%">
									<col style="width:17%">
									<col style="width:10%">
								</colgroup>
								<legend></legend>
								<thead>
									<tr>
										<th>순번</th>
										<th>파일명</th>
										<th>용량</th>
										<th>등록일시</th>
										<th>관리</th>
									</tr>
								</thead>
								<tbody>
								<?
								if($file_total == 0){
								?>
									<tr>
										<td colspan="5">등록된 파일이 없습니다.</td>

									</tr>
								<?
								}
								
								$nu_row = 0;
								while($row_file = mysql_fetch_array($result_file) ){
									$nu_row++;
									$rfile1 = $row_file['rfile1'];
									$ufile1 = $row_file['ufile1'];
								?>
									<tr>
										<td><?=$nu_row?></td>
										<td class="conts ">
											<a href="/include/dn.php?mode=contract&ufile=<?=$ufile1?>&rfile=<?=$rfile1?>"><?=$rfile1?></a>
										</td>
										<td>
											<?
												$imageSize = filesize($_SERVER['DOCUMENT_ROOT'].'/data/contract/'.$ufile1) / 1024;
												$imageSize = round($imageSize,2);
												echo $imageSize . " KB";
												//formatSize
												
											?>
										</td>
										<td><?=$row_file['r_date']?></td>
										<td><a href="#!" onclick="del_file('<?=$row_file['idx']?>');" >삭제</a></td>
									</tr>


								<?
								}
								?>
									
								</tbody>
							</table>	
								
						</div>




						<div class="search_st03">
							<form name="frm_memo" method="post">
								<input type="hidden" id="memo_c_idx" value="<?=$idx?>" />
								<input type="text" id="memo_writer" placeholder="작성자" class="writer" value="<?=$_SESSION[customer][name]?>" />
								<input type="text" id="memo_content" placeholder="내용을 입력해주세요." />
								<button type="button" onclick="send_memo();">등록</button>
							</form>
						</div>

						<script type="text/javascript">

							$(document).ready(function(){
								$("#memo_writer, #memo_content").keyup(function(e){
									if(e.keyCode == 13){
										send_memo();
									}
								});
							});

							function send_memo(){
								var memo_c_idx = $("#memo_c_idx").val().trim();
								var memo_writer = $("#memo_writer").val().trim();
								var memo_content = $("#memo_content").val();

								if(memo_c_idx == ""){
									alert("Error! 계약번호를 확인할 수 없습니다.");
									return false;
								}

								if(memo_writer == ""){
									alert("작성자를 입력해주세요.");
									$("#memo_writer").focus();
									return false;
								}

								if(memo_content == ""){
									alert("내용을 입력해주세요.");
									$("#memo_content").focus();
									return false;
								}
									

								memo_content = memo_content.replace(/\+/g,'||053||');
																

								$.ajax({
								  url     : "/ajax/con_memo_add.php",
								  type	  : "POST",
								  data    : "memo_c_idx="+memo_c_idx+"&memo_writer="+memo_writer+"&memo_content="+memo_content,
								  cache   : false,
								  success : function(data) {  
									data = data.trim();
									if(data=="y"){
										alert("등록되었습니다.");
										location.reload();
									}else{
										alert(data);
									}
								  },
								  error   : function() {
								   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
								  }
							   });


							}
						</script>


						<?
						// 메모 관련 내용을 뽑자
						$sql_memo = "select * from tbl_contract_memo where c_idx = '".$idx."' order by idx asc ";
						//echo $sql_memo;
						$result_memo = mysql_query($sql_memo);
						$memo_total = mysql_num_rows($result_memo);
						//echo $memo_total;
						?>

						<div class="table_another">
							<table>
								<legend></legend>
								<colgroup>
									<col width="10%">
									<col width="21%">
									<col width="*">
									<col width="14%">
									<col width="14%">
								</colgroup>
								<thead>
									<tr>
										<th>순번</th>
										<th>작성자</th>
										<th>내용</th>
										<th>등록일시</th>
										<th>관리</th>
									</tr>
								</thead>
								<tbody>
								<?
								if($memo_total == 0){
								?>
									<tr>
										<td colspan="5">등록된 글이 없습니다.</td>

									</tr>
								<?
								}
								
								$nu_row = 0;
								while($row_memo = mysql_fetch_array($result_memo) ){
									$nu_row++;
								?>
								
									
									<tr>
										<td><?=$nu_row?> <input type="hidden" name="memo_idx" value="<?=$row_memo['idx']?>" /></td>
										<td>
											<span class="r_views"><?=$row_memo['writer']?></span>
											<span class="r_mod"><input type="text" name="writer" value="<?=$row_memo['writer']?>" /></span>
										</td>
										<td class="conts ">
											<span class="r_views"><?=$row_memo['content']?></span>
											<span class="r_mod"><input type="text" name="content" value="<?=$row_memo['content']?>" style="width:80%;" /> <button type="button" class="left" onclick="mod_memo_sub(this)">수정</button></span>
										</td>
										<td><?=$row_memo['r_date']?></td>
										<td>
											<a href="#!" onclick="mod_memo(this);">수정</a>
											<a href="#!" onclick="del_memo('<?=$row_memo['idx']?>');">삭제</a>
										</td>
									</tr>
								
								<?
								}
								?>

								</tbody>
							</table>	
						</div>
					
				</div>



			<!-- 하단 추가 부분 끝 -->

				
			</div>
		</div>
		
	
	</section><!-- //container End -->

	<script type="text/javascript">
	</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/inc/footer_inc.php";?>



<script type="text/javascript">

var set_idx = "<?=$row['u_idx']?>";



$(document).ready(function(){
	if(set_idx){
		getUser(set_idx);
	}

	$("#period, #s_date").change(function(){
		fn_lastdate();
	});


	$("#supply, #tax, #cost").change(function(){
		var supply = $("#supply").val();
		var tax = $("#tax").val();
		var cost = $("#cost").val();

		supply = nocomma(supply);
		tax = nocomma(tax);
		cost = nocomma(cost);


		if(supply=="")supply=0;
		if(tax=="")tax=0;
		if(cost=="")cost=0;

		var totalPrice = parseInt(supply) + parseInt(tax) + parseInt(cost);
		totalPrice = number_format(totalPrice);
		
		$("#total_price").val(totalPrice);
	});

	$("#supply, #tax, #cost").blur(function(){
		var supply = $("#supply").val();
		var tax = $("#tax").val();
		var cost = $("#cost").val();

		supply = nocomma(supply);
		tax = nocomma(tax);
		cost = nocomma(cost);


		if(supply=="")supply=0;
		if(tax=="")tax=0;
		if(cost=="")cost=0;

		var totalPrice = parseInt(supply) + parseInt(tax) + parseInt(cost);
		totalPrice = number_format(totalPrice);
		
		$("#total_price").val(totalPrice);
	});

	$("#tax, #cost").click(function(){
		if($(this).val()=="0"){
			$(this).val("");
		}
	});

	$("#tax, #cost").focus(function(){
		if($(this).val()=="0"){
			$(this).val("");
			$(this).focus();
		}
	});
	$("#tax, #cost").blur(function(){
		if($(this).val()==""){
			$(this).val("0");
		}
	});
	


	//-----------

	$("#de_in, #de_out").change(function(){
		var de_in = $("#de_in").val();
		var de_out = $("#de_out").val();
		de_in = nocomma(de_in);
		de_out = nocomma(de_out);

		if(de_in=="")de_in=0;
		if(de_out=="")de_out=0;

		var totalPrice = parseInt(de_in) - parseInt(de_out);
		/*
		if(totalPrice<0){
			alert("잔액이 0보다 작습니다. 확인해주세요.");
		}
		*/
		totalPrice = number_format(totalPrice);
		
		$("#de_bal").val(totalPrice);
	});


	$("#de_in, #de_out").blur(function(){
		var de_in = $("#de_in").val();
		var de_out = $("#de_out").val();
		de_in = nocomma(de_in);
		de_out = nocomma(de_out);

		if(de_in=="")de_in=0;
		if(de_out=="")de_out=0;

		var totalPrice = parseInt(de_in) - parseInt(de_out);
		
		if(totalPrice<0){
			alert("잔액이 0보다 작습니다. 확인해주세요.");
		}
		
		totalPrice = number_format(totalPrice);
		
		$("#de_bal").val(totalPrice);
	});






});


function addMonth(adds){
	var msg = "";
	if(adds == -1){
		msg = "삭제";
		$("#delchk").val('m');
	}else{
		msg = "추가";
		$("#delchk").val('p');
	}

	if( confirm(msg+" 하시겠습니까?") ){

		var nowMonth = $("#period").val();
		if( parseInt(nowMonth) < 2 && adds == -1){
			alert("더 이상 삭제가 불가능합니다.");
			return false;
		}

		if( parseInt(nowMonth) >= 72 && adds == 1){
			alert("더 이상 추가가 불가능합니다.");
			return false;
		}

		nowMonth = parseInt(nowMonth) + adds;
		$("#period").val(nowMonth);
		fn_lastdate();
		
		document.fm_encroll.submit();
	}



	
}


function fn_subsave(idx){
	var chkcnt = 0;
	var chkval = "";
	var bool_chk = true;
	var b_date = $("#b_date").val();
	var total_price = 0;
	var total_cnt = 0;

	

	$(".chk_list").each(function(){
		if( $(this).prop("checked") ){
			total_cnt++;
		}
	});

	
	$(".chk_list").each(function(){
		if( $(this).prop("checked") ){
			// 청구번호가 없는 것은 팅겨야함
			
			
			if( $(this).attr("callnum") != ""){
				alert("청구된 내역은 수정할 수 없습니다.");
				bool_chk = false;
				return false;
			}


			if(chkcnt == 0 && total_cnt == 1){

				var supply = $(this).closest("tr").find("input").eq(1).val();
				var tax = $(this).closest("tr").find("input").eq(2).val();
				var cost = $(this).closest("tr").find("input").eq(3).val();

				/*
				alert( supply );
				alert( tax );
				alert( cost );
				*/

				
				if( supply == 0 && tax == 0 && cost == 0 ){
					alert("예정금액이 0원을 초과해야 청구설정 가능합니다!");
					bool_chk = false;
					return false;
				}
			}


			// 복수로 보냈을 경우
			if(chkcnt == 0 && total_cnt > 1 && b_date != ""){
				var supply = $(this).closest("tr").find("input").eq(1).val();
				var tax = $(this).closest("tr").find("input").eq(2).val();
				var cost = $(this).closest("tr").find("input").eq(3).val();

				/*
				alert( supply );
				alert( tax );
				alert( cost );
				*/

				
				if( supply == 0 && tax == 0 && cost == 0 ){
					alert("첫달 예정금액이 0원이 될 수는 없습니다.");
					bool_chk = false;
					return false;
				}
			}
		
			chkcnt++;
			chkval += "|"+ $(this).val() +"|";
		}
	});

		
	if(!bool_chk){
		return false;
	}
	
	
	if(chkcnt == 0){
		alert("한개 이상 선택해주세요.");
		return false;
	}

	
	// 	form fm_sub action 값 수정

	var frm = document.fm_sub;
	fm_sub.action = "ctr_enroll_mod_ok.php";
	number_submit(frm);
	fm_sub.submit();


	
}


function fn_calls(idx){
	
	var chkcnt = 0;
	var chkval = "";
	var bool_chk = true;
	var b_date = $("#b_date").val();
	var total_price = 0;

	
	$(".chk_list").each(function(){
		if( $(this).prop("checked") ){
			// 입금예정 묶음일 경우 전체 합계를 구해야함
			total_price = parseInt(total_price) + parseInt($(this).attr("price"));
			if(b_date==""){
				if( $(this).attr("price") == 0){
					alert("예정금액이 0원을 초과해야 청구설정 가능합니다.");
					bool_chk = false;
					return false;
				}
			}
			chkcnt++;
			chkval += "|"+ $(this).val() +"|";
		}
	});

	if(bool_chk){
		if(total_price == 0){
			alert("전체 예정금액이 0원을 초과해야 청구설정 가능합니다.");
			bool_chk = false;
		}
	}
	
	if(!bool_chk){
		return false;
	}
	
	
	if(chkcnt == 0){
		alert("한개 이상 선택해주세요.");
		return false;
	}

	
	var income_type = $("#income_type").val();
	/*
	if(b_date == ""){
		alert("입금예정일을 선택해주세요.");
		return false;
	}
	*/

	//alert(chkval);
	//alert(income_type);

	
	$.ajax({
	  url     : "/ajax/chg_contract_sub.php",
	  type	  : "POST",
	  data    : "chkval="+chkval+"&b_date="+b_date+"&income_type="+income_type,
	  cache   : false,
	  success : function(data) {  
		data = data.trim();
		if(data=="y"){
			alert("청구되었습니다.");
			location.href="/contract/ctr_enroll_mod.php?idx="+idx;
			//location.reload();
		}
	  },
	  error   : function() {
	   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	  }
	});
	
}

function fn_del_calls(idx){
	var chkcnt = 0;
	var chkval = "";
	var bool_chk = true;
	$(".chk_list").each(function(){
		if( $(this).prop("checked") ){
			/*
			if( $(this).attr("price") == 0){
				alert("예정금액이 0원을 초과해야 청구설정 가능합니다");
				bool_chk = false;
				return false;
			}
			*/

			chkcnt++;
			chkval += "|"+ $(this).val() +"|";
		}
	});

	if(!bool_chk){
		return false;
	}

	
	
	if(chkcnt == 0){
		alert("한개 이상 선택해주세요.");
		return false;
	}

	if(confirm("청구 취소를 하시겠습니까?")){
	
		$.ajax({
		  url     : "/ajax/chg_contract_sub_del.php",
		  type	  : "POST",
		  data    : "chkval="+chkval,
		  cache   : false,
		  success : function(data) {  
			data = data.trim();
			if(data=="y"){
				alert("청구 취소되었습니다.");
				//parent.location.reload();
				location.href="/contract/ctr_enroll_mod.php?idx="+idx;

			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});
	}
}


function chg_re_day(idx){
	
	var re_day = $("#re_day").val();

	if(re_day == ""){
		alert("예정일을 입력해주세요.");
		return false;
	}

	re_day = parseInt(re_day);

	if(re_day>31 || re_day<1){
		alert("예정일은 1부터 31까지만 입력가능합니다.");
		return false;
	}

	if(re_day<10){
		re_day = "0"+re_day;
	}

	//alert(re_day);

	
	

	if(confirm("예정일을 모두 변경 하시겠습니까?")){
	
		$.ajax({
		  url     : "/ajax/chg_re_day.php",
		  type	  : "GET",
		  data    : "idx="+idx+"&re_day="+re_day,
		  cache   : false,
		  success : function(data) {  
			data = data.trim();
			if(data=="y"){
				alert("예정일이 수정되었습니다.");
				parent.location.reload();
				

			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});
	}
}


function getUser(r_idx){
	$("#ifm_users").prop("src","/ajax/getUserInfo.php?r_idx="+r_idx);
	
}

function chg_sb(obj){

	var sb_chk = obj.value;
	var rg_idx = "";
	var b_idx = $("#b_idx").val();

	viewroom(b_idx, rg_idx, sb_chk);
}

function chg_build(obj){

	var b_idx = obj.value;
	var rg_idx = "";
	viewgroup(b_idx);
	
	var sb_chk = $("#sb_chk").val();

	viewroom(b_idx, rg_idx, sb_chk);	
	
}

function chg_gr_idx(obj){

	// 건물 키값
	var b_idx = $("#b_idx").val();

	// 그룹 키값
	var rg_idx = obj.value;

	// 상주 여부 체크
	var sb_chk = $("#sb_chk").val();

	viewroom(b_idx, rg_idx, sb_chk);

}

function viewgroup(b_idx){
	$.ajax({
	  url     : "/ajax/chg_group.php",
	  data    : "b_idx="+b_idx+"&sb_chk="+sb_chk,
	  cache   : false,
	  success : function(data) {
		data = data.trim();
		$("#gr_idx").html(data);
	  },
	  error   : function() {
	   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	  }
	});
}

function viewroom(b_idx, rg_idx, sb_chk){
	
	$.ajax({
	  url     : "/ajax/chg_build.php",
	  data    : "b_idx="+b_idx+"&rg_idx="+rg_idx+"&sb_chk="+sb_chk,
	  cache   : false,
	  success : function(data) {
		data = data.trim();
		$("#r_idx").html(data);
	  },
	  error   : function() {
	   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	  }
	});



	$.ajax({
	  url     : "/ajax/chg_build2.php",
	  data    : "b_idx="+b_idx,
	  cache   : false,
	  success : function(data) {  
		data = data.trim();
		  
		$("#pay_type option").each(function(){
			if( $(this).val() == data){
				//$(this).attr("disabled",false);
			}else{
				//$(this).attr("disabled",true);
			}
		
		});
		$("#pay_type").val(data);
	  },
	  error   : function() {
	   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	  }
	});

}


function fn_lastdate(){
	if( $("#period").val() != "" && $("#s_date").val() != ""){
		var term = $("#period").val();
		var sdate = $("#s_date").val();
		
		var s_date = new Date(sdate); 

		var tmp_year = s_date.getFullYear();
		var tmp_month = s_date.getMonth();
		tmp_month = parseInt(tmp_month) + parseInt(term);
		var tmp_date = s_date.getDate();
		tmp_date = parseInt(tmp_date) -1;


		var new_date = new Date(tmp_year, tmp_month, tmp_date);

		var tmp_date2 = new_date.getDate();
		var tmp_month2 = new_date.getMonth();
		tmp_month2 = parseInt(tmp_month2);

		//alert( "ss : " + (tmp_date - tmp_date2) );

		if( tmp_date > tmp_date2 ){
			new_date = new Date(tmp_year, tmp_month+1, 0);
			//alert(tmp_date + " : " + tmp_date2);
		}

		var new_year = new_date.getFullYear();
		var new_month = new_date.getMonth()+1;
		if(new_month<10){
			new_month = "0"+new_month;
		}
		var new_date = new_date.getDate();
		if(new_date<10){
			new_date = "0"+new_date;
		}
		
		new_date = new_year+"-"+new_month+"-"+new_date;

		$("#e_date").val(new_date);

		//alert(new_date);
		
	}
}

function fn_save2(){
	var frm = document.fm_encroll;

	frm.action="./enroll_mod_de_ok.php";
	number_submit(frm);
	frm.submit();

}

function fn_save(){
	var frm = document.fm_encroll;

	if( parseInt(frm.period.value) > 72){
		alert("72개월을 넘을 수 없습니다.");
		frm.period.focus();
		return false;
	}

	var sub_idx = <?=$del_smile?>;
	sub_idx = parseInt(sub_idx);
	
	if(sub_idx>0){
		alert("수정이 불가능합니다.");
		return false;
	}


	
	

	if(frm.g_idx.value==""){
		alert("상품을 선택해주세요.");
		frm.g_idx.focus();
		return false;
	}

	if(frm.b_idx.value==""){
		alert("건물을 선택해주세요.");
		frm.b_idx.focus();
		return false;
	}

	if(frm.r_idx.value==""){
		alert("방을 선택해주세요.");
		frm.r_idx.focus();
		return false;
	}

	if(frm.pay_type.value==""){
		alert("선.후불을 선택해주세요.");
		frm.pay_type.focus();
		return false;
	}

	/*
	if(frm.c_date.value==""){
		alert("계약일을 선택해주세요.");
		frm.c_date.focus();
		return false;
	}
	*/

	if(frm.period.value==""){
		alert("기간을 입력해주세요.");
		frm.period.focus();
		return false;
	}

	if(frm.s_date.value==""){
		alert("시작일을 선택해주세요.");
		frm.s_date.focus();
		return false;
	}

	if(frm.e_date.value==""){
		alert("종료일을 선택해주세요.");
		frm.e_date.focus();
		return false;
	}

	if(frm.supply.value==""){
		alert("공급가액을 입력해주세요.");
		frm.supply.focus();
		return false;
	}

	if(frm.tax.value==""){
		alert("세액일을 입력해주세요.");
		frm.tax.focus();
		return false;
	}

	if(frm.cost.value==""){
		alert("관리비를 입력해주세요.");
		frm.cost.focus();
		return false;
	}

	if(frm.total_price.value==""){
		alert("합계를 입력해주세요.");
		frm.total_price.focus();
		return false;
	}

	frm.action="./enroll_mod_ok.php";
	number_submit(frm);
	frm.submit();
	
	
}


function fn_dels(idx){

	// 서브 계약이 있으면 삭제 절대 못하게 막아버려
	
	var sub_idx = <?=$del_smile?>;
	sub_idx = parseInt(sub_idx);
	
	if(sub_idx>0){
		alert("삭제가 불가능합니다.");
		return false;
	}

	if(confirm("정말 삭제하시겠습니까?")){
		location.href="/contract/ctr_dels.php?idx="+idx;
	}
}


function fn_ends(idx){
	if(confirm("정말 계약을 종료하시겠습니까?")){
		location.href="/contract/ctr_ends.php?idx="+idx;
	}
}

function fn_exceldown(idx){
	window.open("./excel_ctr_enroll.php?idx="+idx);
}


function fn_all_m3(idx){

	if(confirm("일괄입금(청구)은 청구 설정 된 전체 내역에 처리되며, 그룹으로 묶인 경우에는 사용할 수 없습니다.\r진행하시겠습니까?")){	
		$.ajax({
		  url     : "/ajax/all_price_in_sk.php",
		  data    : "idx="+idx,
		  cache   : false,
		  success : function(data) {  
			data = data.trim();
			if(data == "Y"){
				alert("처리되었습니다.");
				location.reload();
			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});
	}

}


function fn_all_m(idx){

	if(confirm("일괄 입금은 전체 내역에 처리되며, 그룹으로 묶인 경우에는 사용할 수 없습니다.\r진행하시겠습니까?")){	
		$.ajax({
		  url     : "/ajax/all_price_in.php",
		  data    : "idx="+idx,
		  cache   : false,
		  success : function(data) {  
			data = data.trim();
			if(data == "Y"){
				alert("처리되었습니다.");
				location.reload();
			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});
	}

}

function fn_all_m2(idx){

	if(confirm("일괄 입금취소는 전체 내역에 처리되며, 그룹으로 묶인 경우에는 사용할 수 없습니다.\r진행하시겠습니까?")){	
		$.ajax({
		  url     : "/ajax/all_price_in2.php",
		  data    : "idx="+idx,
		  cache   : false,
		  success : function(data) {  
			data = data.trim();
			if(data == "M"){
				alert("세금계산서 발행건이 있습니다.");
			}else if(data == "Y"){
				alert("처리되었습니다.");
				location.reload();
			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});
	}

}

function del_memo(idx){
	if(idx == ""){
		alert("Error! Not found idx key value!");
		return false;
	}

	if(confirm("정말 삭제하시겠습니까?")){

		$.ajax({
		  url     : "/ajax/con_memo_del.php",
		  type	  : "POST",
		  data    : "idx="+idx,
		  cache   : false,
		  success : function(data) {  
			data = data.trim();
			if(data=="y"){
				alert("삭제되었습니다.");
				location.reload();
			}else{
				alert(data);
			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
	   });

	}

}



function del_file(idx){
	if(idx == ""){
		alert("Error! Not found idx key value!");
		return false;
	}

	if(confirm("정말 삭제하시겠습니까?")){

		$.ajax({
		  url     : "/ajax/con_file_del.php",
		  type	  : "POST",
		  data    : "idx="+idx,
		  cache   : false,
		  success : function(data) {  
			data = data.trim();
			if(data=="y"){
				alert("삭제되었습니다.");
				location.reload();
			}else{
				alert(data);
			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
	   });

	}

}


function mod_memo(obj){

	$(obj).closest("tr").find(".r_views").hide();
	$(obj).closest("tr").find(".r_mod").show();	

}

function mod_memo_sub(obj){
	var frm = $(obj).closest("tr").html();
	var memo_idx = $(obj).closest("tr").find("input[name=memo_idx]").val();	
	var memo_writer = $(obj).closest("tr").find(".r_mod").find("input[name=writer]").val();	
	var memo_content = $(obj).closest("tr").find(".r_mod").find("input[name=content]").val();	
	
	/*
	alert( frm );
	alert( memo_idx );
	alert( memo_writer );
	alert( memo_content );
	*/

	
	memo_content = memo_content.replace(/\+/g,'||053||');

	if(memo_idx == ""){
		alert("Error! 계약번호를 확인할 수 없습니다.");
		return false;
	}

	if(memo_writer == ""){
		alert("작성자를 입력해주세요.");
		$(obj).closest("tr").find(".r_mod").find("input[name=writer]").focus();	
		return false;
	}

	if(memo_content == ""){
		alert("내용을 입력해주세요.");
		$(obj).closest("tr").find(".r_mod").find("input[name=content]").focus();	
		return false;
	}


	$.ajax({
	  url     : "/ajax/con_memo_mod.php",
	  type	  : "POST",
	  data    : "memo_idx="+memo_idx+"&memo_writer="+memo_writer+"&memo_content="+memo_content,
	  cache   : false,
	  success : function(data) {  
		data = data.trim();
		if(data=="y"){
			alert("수정되었습니다.");
			location.reload();
		}else{
			alert(data);
		}
	  },
	  error   : function() {
	   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	  }
   });

}


$(function(){
	$("#frm_file").ajaxForm({
		url: "bbs_proc.ajax.php",
		type: "POST",
		data: $("#frm_file").serialize(),
		error : function(request, status, error) {
		 //통신 에러 발생시 처리
			alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
			$("#ajax_loader").addClass("display-none");
		}
		, success : function(response, status, request) {
			response = response.trim();
			if (response == "OK") {
				
				alert_("정상적으로 등록되었습니다.");
				location.reload();
				
				return;
			} else if (response == "NF") {
				alert_("업로드 금지 파일입니다.");
				return;
			} else {
				alert(response);
				alert_("오류가 발생하였습니다!!");
				return;
			}
		}
	});
});


$(document).ready(function(){
	
	var rgroup = "<?=$chk_rgroup?>";

	if(rgroup == 0){
		rgroup = "";
	}

	$("#gr_idx").val(rgroup);


	$(".allchk").focus(function(){
		$(this).select();
	});

});


function fn_sms(u_idx){

	var chkCnt = 1;
	var chkId = "|"+u_idx+"|";
	var sms_type = "";

	

	if(chkCnt==0){
		alert("하나 이상을 선택하세요.");
		return false;
	}

	//alert(chkId);
	//alert("/inc/send_sms.php?sms_type="+sms_type+"&chkId="+chkId);

	var tmps = "<iframe name='ifm_pops_05' id='ifm_pops_05' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);
	
	$("#ifm_pops_05").prop("src","/inc/send_sms.php?sms_type="+sms_type+"&chkId="+chkId);
	$('#ifm_pops_05').show();
	$('.pops_wrap, .pops_05').show();
	
}
											
</script>