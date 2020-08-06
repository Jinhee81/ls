<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";

	$sdate		= updateSQ($_GET[sdate]);
	$edate		= updateSQ($_GET[edate]);
	$sms_type	= updateSQ($_GET[sms_type]);
	$stats		= updateSQ($_GET[stats]);
	$pc_type	= updateSQ($_GET[pc_type]);
	$cates		= updateSQ($_GET[cates]);
	$searchtext	= updateSQ($_GET[searchtext]);
	$pg			= updateSQ($_GET[pg]);

	$g_list_rows = 10;

	$strSql = "";

	if ($sdate != "") {
		 $strSql .= " and h.regdate >= '".$sdate."'  ";
	}

	if ($edate != "") {
		 $strSql .= " and h.regdate <= '".$edate." 23:59:59'  ";
	}

	if ($sms_type != "") {
		 $strSql .= " and h.sms_type = '".$sms_type."'  ";
	}

	if ($stats != "") {
		if($stats == "n"){
			$strSql .= " and 1 = 2  ";
		}
		 
	}

	if ($pc_type != "") {
		 $strSql .= " and h.pc_type = '".$pc_type."'  ";
	}



	if ($searchtext != "") {
		$strSql .= " and c.".$cates." like '%$searchtext%' ";
	}

	$total_sql = "
	select h.idx, h.phone, h.CALLBACK, h.regdate, h.msg, h.status, h.u_idx, h.c_idx, h.spend_type, h.sms_type, h.pc_type, c.user_name, c.user_id, c.user_code
	 from (
	 (
	  SELECT 
	   tr_num as idx 
	  ,tr_phone as phone
	  ,tr_callback as callback
	  ,tr_realsenddate as regdate
	  ,tr_msg as msg
	  ,tr_sendstat as status
	  ,tr_etc5 as u_idx
	  ,tr_etc6 as c_idx
	  ,tr_etc4 as spend_type
	  ,'S' as sms_type
	  ,tr_etc1 as pc_type
	  FROM SC_TRAN SC 
	 WHERE tr_sendstat = '2'
	 )
	 union all
	 (
	  SELECT 
	   msgkey as idx
	  ,phone as phone
	  ,callback as callback
	  ,TERMINATEDDATE as regdate
	  ,msg as msg
	  ,status as status
	  ,etc2 as u_idx
	  ,etc3 as c_idx
	  ,etc4 as spend_type
	  ,'M' as sms_type
	  ,etc1 as pc_type
	  FROM MMS_MSG
	  where status = '3'
	 )
	 ) h
	 LEFT OUTER JOIN tbl_customer c
	 on h.u_idx = c.c_idx
	 where spend_type = 'M'
	 ".$strSql;

	

	//echo $total_sql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);



?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="회원관리" data-title="보낸문자리스트">보낸문자리스트</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="" method="get" >
					<fieldset>
						<legend>검색 조회 양식</legend>
						<label for="" class="csb_tit">전송일시</label>
						<input type="text" name="sdate" value="<?=$sdate?>"  class="calendar2" placeholder="2017-01-01">
						<p class="and_txt">~</p>
						<input type="text" name="edate" value="<?=$edate?>"  class="calendar2 mar_r10" placeholder="2017-01-01" >
						
						<select name="sms_type" id="sms_type" class=" mar_r10">
							<option value="">전체</option>
							<option value="S" <?if($sms_type=="S")echo"selected";?> >단문</option>
							<option value="M" <?if($sms_type=="M")echo"selected";?> >장문</option>
						</select>

						<select name="stats" id="stats" class=" mar_r10">
							<option value="">전체</option>
							<option value="y" <?if($stats=="y")echo"selected";?> >성공</option>
							<option value="n" <?if($stats=="n")echo"selected";?> >실패</option>
						</select>
						<select name="cates" id="cates" class=" mar_r10">
							<option value="user_name" <?if($cates=="user_name")echo"selected";?> >회원명</option>
							<option value="user_id" <?if($cates=="user_id")echo"selected";?> >아이디</option>
							<option value="h.phone" <?if($cates=="h.phone")echo"selected";?> >휴대폰</option>


						</select>
						<input type="text" name="searchtext" id="searchtext" value="<?=$searchtext?>" class="wd_200 mar_r10">
						<button type="submit" class="lookup_btn">조회</button>
					</fieldset>
				</form>
			</div>
			<!-- <div class="com_btn_box">
				<div class="right">
					<button type="button" class="gray_btn" onclick="pops_01btn();">문자메시지</button>
				</div>
			</div> -->
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>문자리스트 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>

					<thead>
						<tr>
							<th>순번</th>
							<th>유형</th>
							<th>전송일시</th>
							<th>회원번호</th>
							<th>회원명</th>
							<th>아이디</th>
							<th>휴대폰</th>
							<th>내용</th>
							<th>메시지</th>
							<th>상태</th>
						</tr>
					</thead>

					<tbody>

					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;
						
						$sql    = $total_sql . " order by regdate desc limit $nFrom, $g_list_rows ";
						//echo $sql . "<br/>";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						while($row=mysql_fetch_array($result)){
							$nums = $num;
					?>

						<tr>
							<td><?=$nums?></td>
							<td>
								<?
								if($row['sms_type']=="S"){
									echo "단문";
								}else{
									echo "장문";
								}
								?>
							</td>
							<td><?=$row['regdate']?></td>
							<td><?=$row['user_code']?></td>
							<td><?=$row['user_name']?></td>
							<td><?=$row['user_id']?></td>
							<td><?=$row['phone']?></td>
							<td><?=mb_substr($row['msg'],0,15,"UTF-8")?>...</td>
							<td><a href="javascript:pops_01btn('<?=$row['idx']?>','<?=$row['sms_type']?>');">보기</a></td>
							<td>성공</td>
						</tr>
					<?
					$num = $num - 1;
						}
					?>

					</tbody>
				</table>
			</div>
			<?php //include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?sdate=$sdate&edate=$edate&sms_type=$sms_type&stats=$stats&pc_type=$pc_type&cates=$cates&searchtext=$searchtext&pg=")?>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
