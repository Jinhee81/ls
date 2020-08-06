<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";

?>


<?
	$sdate		= updateSQ($_GET[sdate]);
	$edate		= updateSQ($_GET[edate]);
	$now_level	= updateSQ($_GET[now_level]);
	$cates		= updateSQ($_GET[cates]);
	$searchtext	= updateSQ($_GET[searchtext]);
	

	
	$g_list_rows = 10;
	
	if ($searchtext != "") {
		$strSql = $strSql." and ".$cates." like '%".$searchtext."%'";
	}
	

	if ($now_level != "") {
		if($now_level == 0){
			$strSql = $strSql." and ( select g_levels from tbl_payment where status = 'Y' and goods_type='g_level' and c_idx = c.c_idx ) is null ";
		}else{
			$strSql = $strSql." and ( select g_levels from tbl_payment where status = 'Y' and goods_type='g_level' and c_idx = c.c_idx ) = '".$now_level."' ";
		}
	}

	if ($sdate != "") {
		 $strSql .= " and r_date >= '".$sdate."'  ";
	}

	if ($edate != "") {
		 $strSql .= " and r_date <= '".$edate." 23:59:59'  ";
	}
	
	$total_sql = " 
			select c.* , ( select g_levels from tbl_payment where status = 'Y' and goods_type='g_level' and c_idx = c.c_idx  order by idx desc limit 1 ) as now_level
			from tbl_customer c where status = 0 
		".$strSql;
	
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="회원관리" data-title="회원리스트">회원리스트</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">

				<form action="" method="get" >
					<fieldset>
						<legend>검색 조회 양식</legend>
						<select name="" id="" class="mar_r10">
							<option value="">가입일</option>
							<!--	탈퇴자는 안나오기 때문에 필요가 없음
							<option value="">탈퇴일</option>
							-->
						</select>

						<input type="text" name="sdate" value="<?=$sdate?>" class="calendar2" placeholder="2017-01-01">
						<p class="and_txt">~</p>
						<input type="text" name="edate" value="<?=$edate?>" class="calendar2 mar_r10" placeholder="2017-01-01" >
						
						<select name="now_level" id="now_level" class="mar_r10">
							<option value="">등급</option>
							<?
							foreach($_pay_level as $key => $value){
								if($key == 99)
									continue;

								if($key == 0)
									$value = "무료";
							?>
								<option value="<?=$key?>" ><?=$value?></option>
							<?}?>
						</select>
						<select name="" id="" class="mar_r10">
							<option value="">카드결제</option>
						</select>
						<select name="cates" id="cates" class="mar_r10">
							<option value="c.user_code" <?if($cates=="c.user_code")echo"selected";?> >회원번호</option>
							<option value="c.user_name" <?if($cates=="c.user_name")echo"selected";?> >회원명</option>
							<option value="c.user_id" <?if($cates=="c.user_id")echo"selected";?> >회원아이디</option>
							<option value="c.reco_id" <?if($cates=="c.reco_id")echo"selected";?> >추천인아이디</option>
						</select>
						<input type="text" name="searchtext" value="<?=$searchtext?>" class="wd_200 mar_r10">
						<button type="submit" class="lookup_btn">조회</button>
					</fieldset>
				</form>


			</div>
			<div class="com_btn_box">
				<div class="right">
					<!-- <button type="button" class="blue_btn">사업자/개인변경</button> -->
					<button type="button" class="blue_btn" onClick="pops_05btn();">회원추가</button>
					<button type="button" class="gray_btn" onClick="fn_sms();">문자메시지</button>
					<button type="button" class="gray_btn" onclick="fn_outs();">탈퇴</button>
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>회원리스트 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th><input type="checkbox" id="cklist_00" class="all_check"><label for="cklist_00"></label></th>
							<th>순번</th>
							<th>회원번호</th>
							<th>아이디</th>
							<th>회원명</th>
							<th>생년월일</th>
							<th>일반전화</th>	
							<th>휴대폰</th>	
							<th>우편번호</th>	
							<th>주소</th>
							<th>이메일</th>
							<th>추천인아이디</th>
							<th>상태</th>
							<th>등급</th>
							<th>코인</th>
							<th>수납방법</th>
							<th>건물수</th>
							<th>사용정보</th>
							<th>가입경로</th>
							<th>가입일</th>
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

							$_tmp_addr = $row['addr']." ".$row['addr2'];
							$_tmp_email = $row['user_email'];
						?>


						<tr>
							<td><input type="checkbox" id="chks<?=$nums?>" value="<?=$row['c_idx']?>" class="bbs_idx input_check chksbox" /><label for="chks<?=$nums?>"></label></td>
							<td><?=$nums?></td>
							<td><a href="javascript:pops_05_1btn('<?=$row['c_idx']?>');"><?=$row['user_code']?></a></td>
							<td><?=$row['user_id']?></td>
							<td><?=$row['user_name']?></td>
							<td><?=$row['birthday']?></td>							
							<td><?=$row['tel']?></td>
							<td><?=$row['mobile']?></td>
							<td><?=$row['zipcode']?></td>

							<td title="<?=$_tmp_addr?>"><?=mb_substr($_tmp_addr,0,7,"UTF-8")?></td>
							<td title="<?=$_tmp_email?>"><?=mb_substr($_tmp_email,0,7,"UTF-8")?></td>
							
							<td><?=$row['reco_id']?></td>
							
							<td>
							<?
								if($row['level']==0){
									echo "무료";
								}else{
									$usr_last_pay_row = get_last_payment_user_idx($row['c_idx']);
									$user_last_edate = $usr_last_pay_row['edate'];
									$user_last_edate = substr($user_last_edate,0,10);
									$now_date = date('Y-m-d');
									
									if($user_last_edate>=$now_date){
										echo "사용";
									}else{
										echo "만료";
									}
								}
							?>
							</td>

							<td><?=$_admin_level[$row['level']]?></td>
							<td><?=number_format($row['coin'])?></td>
							<td><?//=$_admin_pay_type[$row['pay_type']]?>카드결제</td>
							<td>
								<?
								$sql_b_tmp = " select count(*) cnts from tbl_build where c_idx = '".$row['c_idx']."'; ";
								$result_b_tmp = mysql_query($sql_b_tmp);
								$row_b_tmp = mysql_fetch_array($result_b_tmp);

								if($row_b_tmp['cnts']>0){
								?>
								<a href="javascript:pops_05_2btn('<?=$row['c_idx']?>');"><?=number_format($row_b_tmp['cnts'])?></a>
								<?}?>
							</td>
							<td><a href="javascript:pops_05_3btn('<?=$row['c_idx']?>');">보기</a></td>
							<td><?=$row['sign_up_path']?></td>
							<td><?=substr($row['r_date'],0,10)?></td>
							
						</tr>

						<?
						$num = $num - 1;
							}
						?>


						<!--
						<tr>
							<td><input type="checkbox" id="cklist_02"><label for="cklist_02"></label></td>
							<td>39</td>
							<td><a href="javascript:pops_05_1btn();">10001000</a></td>
							<td>자기가만든거</td>
							<td>사업자</td>
							<td>19860242-0022448</td>							
							<td>031-879-5050</td>
							<td>010-6815-1132</td>
							<td></td>
							<td>의정부시장암동160-9</td>
							<td></td>
							<td></td>
							<td>무료<br />일반<br />화이트<br />실버<br />골드<br />VIP</td>
							<td>휴대폰청구서<br />자동이체<br />신용카드</td>
							<td><a href="javascript:pops_05_2btn();">1</a></td>
							<td><a href="javascript:pops_05_3btn();">보기</a></td>
							<td>2016-08-22</td>
							<td>2016-09-25</td>
						</tr>
						-->
						
					</tbody>
				</table>
			</div>
			<?php //include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?pg=")?>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>


<script type="text/javascript">

$(document).ready(function(){
	var now_level = "<?=$now_level?>";
	$("#now_level").val(now_level);
});



function fn_sms(){

	var chkCnt = 0;
	var chkId = "";

	$(".chksbox").each(function(){
		if($(this).prop("checked")){
			chkCnt++;
			chkId += "|" + $(this).val() + "|";
		}
	});

	if(chkCnt==0){
		alert("하나 이상을 선택하세요.");
		return false;
	}

	
	var tmps = "<iframe name='ifm_pops_01_1' id='ifm_pops_01_1' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);
	//alert("/AdmMaster/inc/sendsms.php?chkId="+chkId);
	$("#ifm_pops_01_1").attr("src","/AdmMaster/inc/sendsms.php?chkId="+chkId);
	$('#ifm_pops_01_1').show();
	$('.pops_wrap, .pops_01_1').show();

	
}

function fn_outs(){

	var chkCnt = 0;
	var chkId = "";

	$(".chksbox").each(function(){
		if($(this).prop("checked")){
			chkCnt++;
			chkId += "|" + $(this).val() + "|";
		}
	});

	if(chkCnt==0){
		alert("하나 이상을 선택하세요.");
		return false;
	}

	if(confirm("정말 탈퇴시키겠습니까?")){
		location.href="/AdmMaster/inc/cus_out.php?chkId="+chkId;
	}

}

</script>