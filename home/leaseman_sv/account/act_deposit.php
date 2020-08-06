<title>[131]입금리스트</title>
<?php
	include $_SERVER['DOCUMENT_ROOT']."/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/inc/header_inc.php";

	$sdate			= updateSQ($_GET[sdate]);
	$edate			= updateSQ($_GET[edate]);
	$search_cate	= updateSQ($_GET[search_cate]);
	$search_text	= updateSQ($_GET[search_text]);
	$b_idx			= updateSQ($_GET[b_idx]);
	$r_idx			= updateSQ($_GET[r_idx]);
	$g_idx			= updateSQ($_GET[g_idx]);
	$autos			= updateSQ($_GET[autos]);
	$date_tty		= updateSQ($_GET[date_tty]);
	$tax			= updateSQ($_GET[tax]);
	$cates2			= updateSQ($_GET[cates2]);

	if($autos == ""){
		if($sdate == ""){
			$sdate = date('Y-m-01');
		}

		if($edate == ""){
			$edate = date('Y-m-d');
		}
	}
	
	$g_list_rows = 100;

	if($date_tty == ""){
		$date_tty = "r_date";
	}

	if ($sdate != "") {
		if($date_tty == "r_date"){
			$strSql = $strSql." and max(s.r_date) >= '$sdate'";
		}else{
			$strSql = $strSql." and ( select concat( left(writeDate,4),'-',mid(writeDate,5,2),'-',mid(writeDate,7,2) ) from tbl_billa where ordernum = s.callnum ) >= '$sdate'";
		}
	}

	if ($edate != "") {
		if($date_tty == "r_date"){
			$strSql = $strSql." and max(s.r_date) <= '$edate'";
		}else{
			$strSql = $strSql." and ( select concat( left(writeDate,4),'-',mid(writeDate,5,2),'-',mid(writeDate,7,2) ) from tbl_billa where ordernum = s.callnum ) <= '$edate'";

		}
	}

	if ($search_text != "") {
		$strSql = $strSql." and u.$search_cate like '%$search_text%'";
	}

	

	if ($b_idx != "") {
		$strSql = $strSql." and c.b_idx = '$b_idx'";
	}

	if ($r_idx != "") {
		$strSql = $strSql." and c.r_idx = '$r_idx'";
	}

	if ($g_idx != "") {
		$strSql = $strSql." and c.g_idx = '$g_idx'";
	}

	if ($tax != "") {
		if($tax == "Y"){
			$strSql = $strSql." and t_tax > 0";
		}else if($tax == "N"){
			$strSql = $strSql." and t_tax = 0";
		}
	}

	if ($cates2 != "") {
		$strSql = $strSql." and income_type = '$cates2'";
	}
	
	

?>

<link href="/account/account.css" rel="stylesheet" type="text/css"/>
<script src="/account/account.js"></script>

	<section id="sub_container">		
		<div class="sub_wrap">
			<div class="act_deposit">
				<div class="com_hbox">
					<h2 class="com_h2" data-type="회계관리" data-title="입금리스트">[131]입금리스트</h2>
					<ul class="right">
						<?
						$sql_help = "select * from tbl_help where idx = 7";
						$result_help = mysql_query($sql_help);
						$row_help = mysql_fetch_array($result_help);
						if($row_help['status'] == "Y"){
						?>
						<li class="mar_r"><button type ="button" rel="7" class="pops_22btn"><img src="../img/ico/how_goods_icon.png"></button></li>
						<?}?>
						<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지" class="printman"></a></li>
						<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지" onclick="fn_excel_down();"></a></li>
					</ul>
				</div>
				
				<div class="search_st01">
					<form action="" method="get" name="frm" >
						<input type="hidden" name="autos" id="autos" value="Y" />
						<fieldset>
							<legend>검색 조회 양식</legend>			
							
							<div class="boxs">
								<select name="date_tty">
									<option value="r_date" <?if($date_tty=="r_date")echo"selected";?> >입금일</option>
									<option value="bil_date" <?if($date_tty=="bil_date")echo"selected";?> >세금계산서발행일</option>
								</select>
								<input type="text" name="sdate" value="<?=$sdate?>" class="calendar2 one" placeholder="2017-01-01">
								<p class="and_txt">~</p>
								<input type="text" name="edate" value="<?=$edate?>" class="calendar2 one" placeholder="2017-01-01" >
							</div>
							<div class="boxs">
								<!--<label class="input_name long_txt">방/좌석번호</label>-->

								<select name="b_idx" id="b_idx" class="mar_r10" onchange="chg_build(this);">
									<option rel="" value="">건물명</option>
									<?
									$sql_o = " select * from tbl_build where c_idx = '".$_SESSION[customer][idx]."' and status='0'  ";
									$result_o = mysql_query($sql_o) or die (mysql_error());
									while($row_o = mysql_fetch_array($result_o)){
									?>
										<option rel="<?=$row_o['pay_type']?>" value="<?=$row_o['idx']?>"><?=$row_o['aliasName']?></option>
									<?}?>
								</select>

								<select name="r_idx" id="r_idx" class="mar_r10">
									<option value="">호수</option>
								</select>
							</div>
							<div class="boxs">
								<select name="g_idx" id="g_idx">
									<option value="">상품</option>
									<?
									$sql_o = " select * from tbl_goods where c_idx = '".$_SESSION[customer][idx]."'  ";
									$result_o = mysql_query($sql_o) or die (mysql_error());
									while($row_o = mysql_fetch_array($result_o)){
									?>
										<option value="<?=$row_o['idx']?>"><?=$row_o['goodsname']?></option>
									<?}?>
								</select>

								<select name="tax" id="tax">
									<option value="" >세액</option>
									<option value="Y" <?if($tax=="Y")echo"selected";?> >세액있음</option>
									<option value="N" <?if($tax=="N")echo"selected";?> >세액없음</option>
								</select>


								<select name="cates2" id="cates2">
									<option value="">입금구분</option>
									<option value="2"	<?if($cates2=="2")echo "selected";?> >계좌</option>
									<option value="0"	<?if($cates2=="0")echo "selected";?> >현금</option>
									<option value="1"	<?if($cates2=="1")echo "selected";?> >카드</option>
								</select>


							</div>
							<div class="boxs">
								
								<select name="search_cate" id="search_text">
									<option value="user_name" <?if($search_cate=="user_name")echo"selected";?> >고객명</option>
									<option value="com_name" <?if($search_cate=="com_name")echo"selected";?> >사업자명</option>
								</select>
								<input type="text" name="search_text" id="search_text" value="<?=$search_text?>" class="">
								<button type="submit" class="btn_st01">조회</button>
							</div>
							
						</fieldset>
					</form>
				</div>



				<?

				$sql_sub = " SELECT   s.* 
									, c.b_idx
									, c.r_idx
									, c.g_idx
									, c.idx as cc_idx
									, g.goodsname
							        , b.aliasName 
									, r.roomname
									, c.period
									, u.user_name
									, u.r_idx user_idx
									, u.mobile, u.com_name, u_idx
									, count(*) as cnt_row
									, max(s.r_price) as max_r_price
									, max(s.r_date) as max_r_date
									, min(s.s_date) as t_s_date
									, max(s.e_date) as t_e_date
									, sum(s.supply) as t_supply
									, sum(s.tax) as t_tax
									, sum(s.cost) as t_cost
									, sum(s.total_price) as t_total_price
									, datediff(ifnull((date_format(max(s.r_date),'%Y-%m-%d') ),now() ) ,date_format(s.b_date,'%Y-%m-%d') ) as late_date
									
																				";
				$sql_sub .= "  FROM tbl_contract_sub s							";
				$sql_sub .= "  LEFT OUTER JOIN tbl_contract c					";
				$sql_sub .= "    ON s.c_idx = c.idx								";
				$sql_sub .= "  LEFT OUTER JOIN tbl_build b						";
				$sql_sub .= "    ON c.b_idx = b.idx								";
				$sql_sub .= "  LEFT OUTER JOIN tbl_room r						";
				$sql_sub .= "    ON c.r_idx = r.idx								";
				$sql_sub .= "  LEFT OUTER JOIN tbl_user u						";
				$sql_sub .= "    ON c.u_idx = u.r_idx							";
				$sql_sub .= "  LEFT OUTER JOIN tbl_goods g						";
				$sql_sub .= "    ON c.g_idx = g.idx								";
				$sql_sub .= " WHERE c.c_idx = '".$_SESSION[customer][idx]."'	";
				//$sql_sub .= "   AND c.status = 0								";
				//$sql_sub .= "   AND s.r_price !=''								";
				//$sql_sub .= "   AND s.r_date !=''								";
				//$sql_sub .= "   AND s.callnum !=''								";
				$sql_sub .= " GROUP by s.callnum								";
				$sql_sub .= " HAVING max(s.r_price) !=''						";
				$sql_sub .= "    AND s.callnum  != ''							";
				$sql_sub .= $strSql;
				//$sql_sub .= " ORDER BY idx ASC									";
				$sql_sub .= "   ";

				/*
				if($autos == ""){
					$sql_sub = "select * from tbl_contract where idx = '-1' ";
				}
				*/
				//echo $sql_sub;
				$result = mysql_query($sql_sub);
				$nTotalCount = mysql_num_rows($result);



				// 전체 합계 구하는거 추가 부분----------
				
				$tt_tmp_supply = 0;
				$tt_tmp_tax = 0;
				$tt_tmp_cost = 0;
				$tt_tmp_income = 0;
				while( $row_tmp = mysql_fetch_array($result) ){
					$tt_tmp_supply += $row_tmp['t_supply'];
					$tt_tmp_tax += $row_tmp['t_tax'];
					$tt_tmp_cost += $row_tmp['t_cost'];
					$tt_tmp_income += $row_tmp['max_r_price'];
				}


				// ----------------------------------------까지

				$nPage = ceil($nTotalCount / $g_list_rows);
				if ($pg == "") $pg = 1;
				$nFrom = ($pg - 1) * $g_list_rows;


				$excel_sql = $sql_sub . " order by max_r_date desc, idx ASC ";						
				
				$excel_sql = str_replace("\n"," ",$excel_sql);
				$excel_sql = str_replace("\t"," ",$excel_sql);


				//$sql_sub    = $sql_sub . " ORDER BY idx ASC limit $nFrom, $g_list_rows ";
				$sql_sub    = $sql_sub . " ORDER BY max_r_date desc, idx ASC limit $nFrom, $g_list_rows ";

				//echo $sql_sub;
				
				$result = mysql_query($sql_sub);
				?>

				
				<div class="com_btn_box">
					<div class="left">
						<select name="sms_type" id="sms_type" class="style_sel mar_r wd90">
							<option value="">상용구없음</option>
							<?
							$sql_sms = " select * from tbl_smsfavo where c_idx = '".$_SESSION[customer][idx]."' and status = 0 and displays = 4 ";
							$result_sms = mysql_query($sql_sms) or die (mysql_error());
							while($row_sms = mysql_fetch_array($result_sms)){
							?>
								<option value="<?=$row_sms['idx']?>"><?=$row_sms['aliasName']?></option>
							<?}?>
						</select>

						<button type="button" class="gray_btn wd_80 mar_r pops_05btn" onclick="fn_sms();" >문자메시지</button>
					</div>
					<div class="right">
						<button type="button" class="btn_st01 mar_r " onclick="fn_bills();">전자(세금)계산서발행</button><!-- 링크 연결... 링크주소 못받음 -->
						<!-- pops_21btn -->
						<!-- <button type="button" class="btn_st01 mar_r pops_09btn">거래명세표 발행</button> -->
						<!--
						<button type="button" class="blue_btn wd_70">일괄등록</button>
						-->
					</div>
				</div>
				
				<div class="com_info_tb">
					<ul>
						<li>
							<strong class="blue">전체 : <?=number_format($nTotalCount)?>건</strong> 공급가액 : <?=number_format($tt_tmp_supply)?>원 / 세액:<?=number_format($tt_tmp_tax)?>원 / 관리비 : <?=number_format($tt_tmp_cost)?>원 / 입금액 : <?=number_format($tt_tmp_income)?>원
						</li>
						<li>
							<strong class="blue">선택 : <span id="mon_cnt">0</span>건</strong> 공급가액 : <span id="mon_supply">0</span>원 / 세액 : <span id="mon_tax">0</span>원 / 관리비 : <span id="mon_cost">0</span>원 / 입금액 : <span id="mon_income">0</span>원
						</li>
					</ul>
				</div>
				
				<div class="com_tb01 thead_hg mar_b20">
					<table>
						<caption>입금리스트</caption>
						<colgroup>
							<col width="50px">
							<col width="50px">
						</colgroup>
						<thead>
							<tr>
								<th rowspan="3"><input type="checkbox" id="actdep_chk001" class="all_check"><label for="actdep_chk001"></label></th>
								<th rowspan="3">순번</th>
								<th rowspan="3">청구번호</th>
								<th rowspan="3">입금일</th>
								<!--
								<th rowspan="3"><p>입금</p><p>(개월)</p></th>
								<th rowspan="3">시작일</th>
								<th rowspan="3">종료일</th>
								-->
								<th rowspan="3">공급가액</th>
								<th rowspan="3">세액</th>
								<th rowspan="3">관리비</th>
								<th rowspan="3">입금액</th>
								<th rowspan="3"><p>입금</p><p>구분</p></th>
								<th rowspan="3">수납구분</th>
								<th rowspan="3">고객명</th>
								<th rowspan="3">사업자명</th>
								<th rowspan="3">상품</th>
								<th rowspan="3">건물별명</th>
								<th rowspan="3">방/<br />좌석번호</th>
								<th>세금계산서<br />발행일</th>
								<th colspan="2">전자계산서</th>
							</tr>
						</thead>
						<tbody>

						<?
						$num = $nTotalCount - $nFrom;

						while( $row = mysql_fetch_array($result) ){
							$nums = $num;

							$sql_bill = "select * from tbl_billa where ordernum = '".$row['callnum']."' ";
							$result_bill = mysql_query($sql_bill);
							$row_bill = mysql_fetch_array($result_bill);

							
							if($row['t_supply']-$row['max_r_price'] <= 0 ){
								$bill_chk71 = "t";
							}else{
								$bill_chk71 = "e";
							}

						
						?>

							<tr class="tr_sel" rel="<?=$row['callnum']?>" >
								
								<td>
									<input type="checkbox" name="chkNum[]" id="prc_goodchk<?=$nums?>" class="chksbox" value="<?=$row['u_idx']?>" rel="<?=$row['idx']?>" callnum="<?=$row['callnum']?>" tax="<?=$row['t_tax']?>" bill="<?=$row_bill['idx']?>" bill2="<?=$bill_chk71?>" supply=<?=$row['t_supply']?> tax=<?=$row['t_tax']?> cost=<?=$row['t_cost']?> income=<?=$row['max_r_price']?> income_type=<?=$row['income_type']?> ><label for="prc_goodchk<?=$nums?>"></label>


								</td>

								<td><?=$nums?></td>
								<!--
								<td><a href="#!" class="pops_03_1btn"><?=$row['callnum']?></a></td>
								-->
								<!--
								<td><a href="#!" class="pops_03btn" rel="<?=$row['user_idx']?>" ><?=$row['callnum']?></a></td>
								-->
								<td><a href="/contract/ctr_enroll_mod.php?idx=<?=$row['cc_idx']?>"  ><?=$row['callnum']?></a></td>
								
								<td style="color:ff0066;" ><?=$row['max_r_date']?></td>
								<!--
								<td><?=number_format($row['cnt_row'])?></td>
								<td><?=$row['t_s_date']?></td>
								<td><?=$row['t_e_date']?></td>
								-->
								<td><?=number_format($row['t_supply'])?></td>
								<td><?=number_format($row['t_tax'])?></td>
								<td><?=number_format($row['t_cost'])?></td>
								<td><?=number_format($row['max_r_price'])?></td>
								<td><?=$_income_type[$row['income_type']]?></td>
								<?
								if($row['late_date']>0){
									$late_chk = "(연체)";
								}else{
									$late_chk = "";
								}
																?>
								<td>
									<?
									if($row['t_supply']-$row['max_r_price'] <= 0 ){
										echo "완납";
									}else{
										echo "미납";
									}
									?>
									
									<?=$late_chk?>
								</td>
								<td><a href="#!" rel="<?=$row['u_idx']?>" class="pops_02btn" ><?=$row['user_name']?></a></td>
								<td><p class="over_txt2" title="<?=$row['com_name']?>"><?=$row['com_name']?></p></td>
								<td><?=$row['goodsname']?></td>
								<td><?=$row['aliasName']?></td>
								<td><?=$row['roomname']?></td>
								<td>
									<?
									if($row_bill['writeDate']){
										echo substr($row_bill['writeDate'],0,4) . "-" . substr($row_bill['writeDate'],4,2) . "-" . substr($row_bill['writeDate'],6,2);
									}
									?>
								</td>
								<td>
									<?if($row_bill['idx']){?>
									발행
									<?}?>
								</td>
								<td>
									<?if($row_bill['idx']){?>
									<b class="mar_r pops_20btn" rel="<?=$row['callnum']?>" >보기</b>
									<?}?>
								</td>
							</tr>

						<?
							$num = $num - 1;
						}
						?>

						</tbody>
					</table>
				</div>
				<br />
				<div class="deposit_box " style="display:none;">
					<div class="com_tb01">
						<table>
							<caption>입금리스트</caption>
							<colgroup>
								<col width="50px">
							</colgroup>
							<thead>
								<tr>
									<th>순번</th>
									<th>시작일</th>
									<th>종료일</th>
									<th>입금일</th>
									<th>입금액</th>
									<th>세액</th>
									<th>관리비</th>
								</tr>
							</thead>
							<tbody id="sub_table">

								
							
							</tbody>
						</table>
					</div>
				</div><!-- 위의 테이블 리스트 클릭시 해당 박스의 테이블에 리스트 생성 -->
			
			</div>

			<?php //include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?autos=$autos&sdate=$sdate&edate=$edate&g_idx=$g_idx&b_idx=$b_idx&r_idx=$r_idx&cates=$cates&searchtext=$searchtext&date_tty=$date_tty&tax=$tax&pg=")?>

		</div>
		
	
	</section><!-- //container End -->

	<script type="text/javascript">
	</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/inc/footer_inc.php";?>



<script type="text/javascript">

function chg_build(obj){

	var b_idx = obj.value;

	$.ajax({
	  url     : "/ajax/chg_build.php",
	  data    : "b_idx="+b_idx,
	  cache   : false,
	  success : function(data) {  
		$("#r_idx").html(data);
	  },
	  error   : function() {
	   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	  }
	});

}

$(document).ready(function(){
	var b_idx = "<?=$b_idx?>";
	var r_idx = "<?=$r_idx?>";
	var g_idx = "<?=$g_idx?>";

	if(b_idx){
		$("#b_idx").val(b_idx);

		$.ajax({
		  url     : "/ajax/chg_build.php",
		  data    : "b_idx="+b_idx,
		  cache   : false,
		  success : function(data) {  
			  
			$("#r_idx").html(data);
			$("#r_idx").val(r_idx);
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});
	}

	if(g_idx){
		$("#g_idx").val(g_idx);
	}


	$(".tr_sel").click(function(){
		var rel = $(this).attr("rel");
		
		$.ajax({
		  url     : "/ajax/view_cal.php",
		  data    : "rel="+rel,
		  cache   : false,
		  success : function(data) {  
			  
			$("#sub_table").html(data);
			
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});
	
	});



	$(".all_check,  .chksbox").click(function(){
		
		var chkCnt		=0;
		var chksupply	=0;
		var chktax		=0;
		var chkcost		=0;
		var chkincome	=0;
	
		$(".chksbox").each(function(){
			if($(this).prop("checked")){
				chkCnt++;
				chksupply += parseInt($(this).attr("supply"));
				chktax += parseInt($(this).attr("tax"));
				chkcost += parseInt($(this).attr("cost"));
				chkincome += parseInt($(this).attr("income"));

			}
		});
	
		$("#mon_cnt").text(chkCnt);
		$("#mon_supply").text(number_format(chksupply));
		$("#mon_tax").text(number_format(chktax));
		$("#mon_cost").text(number_format(chkcost));
		$("#mon_income").text(number_format(chkincome));
	
	
	});


});



function fn_sms(){

	var chkCnt = 0;
	var chkId = "";
	var sms_type = $("#sms_type").val();
	var subIdx = "";

	$(".chksbox").each(function(){
		if($(this).prop("checked")){
			chkCnt++;
			chkId += "|" + $(this).val() + "|";
			subIdx += "|" + $(this).attr("rel") + "|";

		}
	});
	
	
	if(chkCnt==0){
		alert("하나 이상을 선택하세요.");
		return false;
	}

	//alert(sms_type);
	//alert(chkId);
	//alert(subIdx);

	//alert("/inc/send_sms.php?sms_type="+sms_type+"&chkId="+chkId+"&chkIdx="+chkIdx);

	var tmps = "<iframe name='ifm_pops_05' id='ifm_pops_05' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);
	//alert("/inc/send_sms.php?sms_type="+sms_type+"&chkId="+chkId+"&subIdx="+subIdx );
	$("#ifm_pops_05").prop("src","/inc/send_sms.php?sms_type="+sms_type+"&chkId="+chkId+"&subIdx="+subIdx );
	$('#ifm_pops_05').show();
	$('.pops_wrap, .pops_05').show();
	$('.pops_wrap, .pops_05').show();
}

function fn_excel_down(){
	var sql = "<?=$excel_sql?>";
	window.open("./excel_deposit.php?sql="+sql);
}

function fn_bills(){

	var chkCnt = 0;
	var chkId = "";
	var subIdx = "";
	var bool_chk = true;

	$(".chksbox").each(function(){
		if($(this).prop("checked")){

			if( $(this).attr("income_type") == 1){
				alert("카드 결제는 발행이 불가능합니다. ");
				bool_chk = false;
				return false;
			}

			chkCnt++;
			chkId += "|" + $(this).val() + "|";
			subIdx += "|" + $(this).attr("callnum") + "|";

		}
	});

	if(!bool_chk){
		return false;
	}


	
	if(chkCnt==0){
		alert("하나 이상을 선택하세요.");
		return false;
	}

	//alert(chkId);
	//alert(subIdx);

	if(chkCnt==1){

		var tmps = "<iframe name='ifm_pops_21' id='ifm_pops_21' class='popup_iframe'   scrolling='no' src=''></iframe>";
		$("#wrap").append(tmps);
		//alert( "/inc/tax_invoice2.php?chkId="+chkId+"&callnum="+subIdx );
	
		$("#ifm_pops_21").attr("src","/inc/tax_invoice2.php?chkId="+chkId+"&callnum="+subIdx);
		$('#ifm_pops_21').show();
		$('.pops_wrap, .pops_21').show();
	}else{

		//alert("복수 선택시엔 자동 처리!");

		/*
		사전 확인사항
		1. 선택한 것들이 발행 가능한지 하나 하나 확인 (세액이 있나?)
		2. 선택한 수량 만큼 발행 가능한지 확인하자
		3. 
		*/

		var chk_bill_able = true;

		
		// 사전에 이미 발행했거나, 발행이 불가능한 것이 있는지 확인하자
		$(".chksbox").each(function(){
			if($(this).prop("checked")){
				
				if( $(this).attr("tax") == "" || $(this).attr("tax") == 0 ){
					chk_bill_able = false;
				}
				
				if( $(this).attr("bill") != "" ){
					chk_bill_able = false;
				}

				if( $(this).attr("bill2") == "e" ){
					chk_bill_able = false;
				}
			}
		});

		if(!chk_bill_able){
			alert("발급할 수 없는 내역이 있습니다.");
			return false;
		}


		// 해당 개수 만큼 발급이 가능한지 먼저 알아보자
		$.ajax({
		  url     : "/ajax/chk_bill_able.php",
		  data    : "chkCnt="+chkCnt,
		  cache   : false,
		  success : function(data) {  
			data = data.trim();
			  
			if(data == "Y"){

				$.ajax({
				  url     : "/pop/TaxinvoiceExample/bill_to_db_multi.php",
				  data    : "subIdx="+subIdx,
				  cache   : false,
				  success : function(data) {  
					alert(data);
					location.reload();



				  },
				  error   : function() {
				   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				  }
				});




			}else{
			
				alert("잔여 수량이 부족합니다.\r\n충전해주세요.");
				return false;

			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});



	}

}




</script>