<title>[111]고객리스트</title>
<?php
	include $_SERVER['DOCUMENT_ROOT']."/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/inc/header_inc.php";


	
	$sdate			= updateSQ($_GET[sdate]);
	$edate			= updateSQ($_GET[edate]);
	$cates			= updateSQ($_GET[cates]);
	$cates2			= updateSQ($_GET[cates2]);
	$cates3			= updateSQ($_GET[cates3]);
	$searchtext		= updateSQ($_GET[searchtext]);
	$searchtext2	= updateSQ($_GET[searchtext2]);
	$searchtext3	= updateSQ($_GET[searchtext3]);
	$pg				= updateSQ($_GET[pg]);
	$autos			= updateSQ($_GET[autos]);

	
	
	$g_list_rows = 100;

	$strSql = "";
	$sub_strSql = "";




	if($autos == ""){
		if ($sdate == "") {
			$sdate = date("Y-m-01");
		}

		if ($edate == "") {
			$edate = date("Y-m-d");
		}
	}


	if ($sdate != "") {
		 $sub_strSql .= " and u.r_date >= '".$sdate."'  ";
	}

	if ($edate != "") {
		 $sub_strSql .= " and left(u.r_date,10) <= '".$edate."'  ";
	}

	
	

	if ($searchtext != ""){
		$sub_strSql .= " and u.".$cates." like '%".$searchtext."%'  ";
	}

	if ($searchtext2 != ""){
		$sub_strSql .= " and u.".$cates2." like '%".$searchtext2."%'  ";
	}

	if ($searchtext3 != ""){
		$sub_strSql .= " and u.".$cates3." like '%".$searchtext3."%'  ";
	}
	
	
	$total_sql = " 
			select u.*
			  from (select * from tbl_user where c_idx = '".$_SESSION[customer][idx]."') u   
			where 1=1 ".$sub_strSql;
	//echo $total_sql;
	/*
	if($autos == ""){
		$total_sql = "select * from tbl_user where r_idx = 0 ";
	}
	*/
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/main/popup.php";?>
	<section id="container">		
		<div class="main_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="고객관리" data-title="고객리스트">[111] 고객리스트</h2>
				<ul class="right">
					<?
					$sql_help = "select * from tbl_help where idx = 0";
					$result_help = mysql_query($sql_help);
					$row_help = mysql_fetch_array($result_help);
					if($row_help['status'] == "Y"){
					?>
					<li class="mar_r"><button type ="button" rel="0" class="pops_22btn"><img src="../img/ico/how_goods_icon.png"></button></li>
					<?}?>
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지" class="printman"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지" onclick="fn_excel_down();"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="">
					<input type="hidden" name="autos" id="autos" value="Y" />
					<fieldset>
						<legend>검색 조회 양식</legend>



						<br  class="mo_br"/>
						<p class="input_name wd_57">등록일</p>
						<input type="text" name="sdate" value="<?=$sdate?>" class="calendar2" placeholder="2017-01-01">
						<p class="and_txt">~</p>
						<input type="text" name="edate" value="<?=$edate?>" class="calendar2" placeholder="2017-01-01" >


						

						<select name="cates" id="cates" class="wd_05 mar_r10">
							<option value="user_name">고객명</option>
							<option value="user_code">고객번호</option>
							<option value="email">이메일</option>
						</select>
						<input type="text" value="<?=$searchtext?>" name="searchtext" class="wd_139 mar_r20">


						<select name="cates2" id="cates2" class="wd_05 mar_r10">
							<option value="mobile">핸드폰</option>
						</select>
						<input type="text" value="<?=$searchtext2?>" name="searchtext2" class="wd_139 mar_r20">

						<select name="cates3" id="cates3" class="wd_05 mar_r10">
							<option value="com_name">사업자명</option>
							<option value="com_num">사업자번호</option>
						</select>
						<input type="text" value="<?=$searchtext3?>" name="searchtext3" class="wd_139 mar_r20">






						<button type="submit" class="lookup_btn">조회</button>
					</fieldset>
				</form>
			</div>

			<div class="com_btn_box">
				<div class="left">
					<select name="sms_type" id="sms_type" class="style_sel mar_r">
						<option value="">상용구없음</option>
						<?
						$sql_sms = " select * from tbl_smsfavo where c_idx = '".$_SESSION[customer][idx]."' and status = 0 and displays=0 ";
						$result_sms = mysql_query($sql_sms) or die (mysql_error());
						while($row_sms = mysql_fetch_array($result_sms)){
						?>
							<option value="<?=$row_sms['idx']?>"><?=$row_sms['aliasName']?></option>
						<?}?>
					</select>
					<button type="button" class="gray_btn wd_80 pops_05btn" onclick="fn_sms();" >문자메시지</button>
				</div>
				<div class="right">
					<button type="button" class="gray_btn mar_r wd_56" onclick="fn_dels();">삭제</button>
					<button type="button" class="gray_btn wd_70 mar_r inexcels">일괄등록</button>
					<button type="button" class="gray_btn wd_120 mar_r" onclick="fn_excel1();">일괄등록 양식다운</button>
					<!--
					<button type="button" class="blue_btn wd_70 pops_02_1btn">등록</button>
					-->
					<button type="button" class="blue_btn wd_70" onclick="location.href='/manage/mg_enroll.php';">등록</button>
					
				</div>
			</div>
			<div class="excel_up" >
				<div class="right">
					<form name="excel_up" action="/inc/excel_member.php" method="post" enctype="multipart/form-data">
						
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

	

			<div class="com_info_tb">
				<ul>
					<li>
						<strong class="blue">전체 : <?=number_format($nTotalCount)?>건</strong>
					</li>
					<li>
						<strong class="blue">선택 : <span id="mon_cnt">0</span>건</strong>
					</li>
				</ul>
			</div>

			<div class="com_tb01">
				<table>
					<caption>고객리스트 표</caption>
					<colgroup>
						<col width="50px">
					</colgroup>
					<thead>
						<tr>
							<th><input type="checkbox" id="ck00" class="all_check"><label for="ck00"></label></th>
							<th>순번</th>
							<th>고객명</th>
							<th>핸드폰</th>
							<th>성별</th>
							<th>이메일</th>
							<th>형태</th>
							<th>사업자명</th>
							<th>사업자번호</th>
							<th>임대<br />계약</th>
							<th>특이사항</th>
							<th>바로가기</th>
						</tr>
					</thead>
					<tbody>
					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;
						
						//$excel_sql = $total_sql . " order by r_idx desc limit $nFrom, $g_list_rows ";	화면 그대로 보이기
						$excel_sql = $total_sql . " order by r_idx desc ";
						
						
						$excel_sql = str_replace("\n"," ",$excel_sql);
						$excel_sql = str_replace("\t"," ",$excel_sql);
						//echo "sql : ".$excel_sql;

						


						$sql    = $total_sql . " order by r_idx desc limit $nFrom, $g_list_rows ";
						
						
						//echo $sql;
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						while($row=mysql_fetch_array($result)){
							$nums = $num;

							// 가장 마지막 계약건
							

							$sql_bu = " select count(*) as con_cnt, c.*, u.user_code, u.user_name,  u.mobile, u.email, u.com_type, u.com_name, b.aliasName, r.roomname, g.goodsname  from tbl_contract c LEFT OUTER JOIN tbl_user u ON c.u_idx = u.r_idx  LEFT OUTER JOIN tbl_build b ON c.b_idx = b.idx LEFT OUTER JOIN tbl_room r ON c.r_idx = r.idx  LEFT OUTER JOIN tbl_goods g ON c.g_idx = g.idx where c.u_idx = '".$row['r_idx']."' and c.con_type = 'c' order by idx desc limit 1 ";
							
							//echo $sql_bu."<br/><br/>";

							$result_bu = mysql_query($sql_bu);
							$row_bu = mysql_fetch_array($result_bu);

							

							

							// 삭제 가능한 여부
							$sql_cnt1 = "select count(*) as cnts from tbl_contract where u_idx = '".$row['r_idx']."' ";
							$result_cnt1 = mysql_query($sql_cnt1);
							$row_cnt1 = mysql_fetch_array($result_cnt1);

							$sql_cnt2 = "select count(*) as cnts from tbl_deposit where r_idx = '".$row['r_idx']."' ";
							$result_cnt2 = mysql_query($sql_cnt2);
							$row_cnt2 = mysql_fetch_array($result_cnt2);

							$rel_cnt = $row_cnt1[cnts] + $row_cnt2[cnts];

							$tmp_deposit = $row['deposit'];
							if($tmp_deposit==""){
								$tmp_deposit = 0;
							}

						?>

						<tr>
							<td><input type="checkbox" class="chksbox" id="ck<?=$nums?>" value="<?=$row['r_idx']?>" rel="<?=$rel_cnt?>" prices="<?=$tmp_deposit?>"  ><label for="ck<?=$nums?>"></label></td>
							<td><?=$nums?></td>
							<!--
							<td><a href="/manage/mg_mod.php?r_idx=<?=$row['r_idx']?>"><?=$row['user_name']?></a></td>
							-->
							<td><a href="#!" rel="<?=$row['r_idx']?>" class="pops_02btn" ><?=$row['user_name']?></a></td>
							<td><?=$row['mobile']?></td>
							<td>
								<?
								if($row['gender']=="m"){
									echo "남";
								}else{
									echo "여";
								}
								?>
							</td>
							<td><p class="over_txt" title="<?=$row['email']?>"><?=$row['email']?></p></td>
							<td><?=$_com_type[$row['com_type']]?></td>
							<td><p class="over_txt" title="<?=$row['com_name']?>"><?=$row['com_name']?></p></td>
							<td><p class="over_txt" title="<?=$row['com_num']?>"><?=$row['com_num']?></p></td>
							<td>
								<?if($row_bu['con_cnt']>0){?>
								<a href="#!" class="pops_03btn" rel="<?=$row['r_idx']?>" ><?=number_format($row_bu['con_cnt'])?></a>
								<?}?>
							</td>
							<td title="<?=$row['memo']?>"><?=mb_substr($row['memo'],0,15,"UTF-8")?></td>
							<td>
							<?if(get_cnt_tbl_contract('i') < get_contract_able($_pay_contract) ){?>
								<button type="button" class="btn_st02" onclick="location.href='/contract/ctr_enroll.php?u_idx=<?=$row['r_idx']?>';">계약</button>
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
			<?php //include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?autos=$autos&status=$status&sdate=$sdate&edate=$edate&g_idx=$g_idx&b_idx=$b_idx&r_idx=$r_idx&cates=$cates&searchtext=$searchtext&cates2=$cates2&searchtext2=$searchtext2&cates3=$cates3&searchtext3=$searchtext3&pg=")?>
		</div>
		
	
	</section><!-- //container End -->
	

<?php include $_SERVER['DOCUMENT_ROOT']."/inc/footer_inc.php";?>

<script type="text/javascript">



var cates = "<?=$cates?>";
var cates2 = "<?=$cates2?>";
var cates3 = "<?=$cates3?>";


if(cates){
	$("#cates").val(cates);
}

if(cates2){
	$("#cates2").val(cates2);
}

if(cates3){
	$("#cates3").val(cates3);
}


function fn_sms(){

	var chkCnt = 0;
	var chkId = "";
	var sms_type = $("#sms_type").val();

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

	//alert(chkId);
	//alert("/inc/send_sms.php?sms_type="+sms_type+"&chkId="+chkId);

	var tmps = "<iframe name='ifm_pops_05' id='ifm_pops_05' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);
	
	$("#ifm_pops_05").prop("src","/inc/send_sms.php?sms_type="+sms_type+"&chkId="+chkId);
	$('#ifm_pops_05').show();
	$('.pops_wrap, .pops_05').show();
	
}

function fn_dels(){

	if(confirm("정말 삭제하시겠습니까?")){

		var chkCnt = 0;
		var chkId = "";
		var chkdel = true;
		

		$(".chksbox").each(function(){
			if($(this).prop("checked")){
				chkCnt++;
				chkId += "|" + $(this).val() + "|";
				if( $(this).attr("rel") > 0){
					chkdel = false;
				}
			}
		});

		

		if(chkdel == false){
			alert("계약 또는 보증금을 먼저 삭제해주세요.");
			return false;
		}
		
		

		if(chkCnt==0){
			alert("하나 이상을 선택하세요.");
			return false;
		}



		$.ajax({
		  url     : "/ajax/del_user.php",
		  data    : "chkId="+chkId,
		  cache   : false,
		  success : function(data) {  
			data = data.trim();
			if(data == "y"){
				alert("삭제되었습니다.");
				location.reload();
			}
		  },
		  error   : function() {
		   alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		  }
		});


	}
}

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
	$(".all_check,  .chksbox").click(function(){
		
		var chkCnt=0;
		var chkprice=0;
	
		$(".chksbox").each(function(){
			if($(this).prop("checked")){
				chkCnt++;
				chkprice += parseInt($(this).attr("prices"));


			}
		});
	
		$("#mon_cnt").text(chkCnt);
		
	
	
	});
});


function fn_excel_down(){
	var sql = "<?=$excel_sql?>";
	window.open("./excel_main.php?sql="+sql);
}

function fn_excel1(){
	window.open("./tbl_user.xls");
}
</script>