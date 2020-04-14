<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";

	$sdate			= updateSQ($_GET[sdate]);
	$edate			= updateSQ($_GET[edate]);
	$events			= updateSQ($_GET[events]);
	$cates			= updateSQ($_GET[cates]);
	$searchtext		= updateSQ($_GET[searchtext]);


	

	$g_list_rows = 10;

	$strSql = "";

	if ($sdate != "") {
		 $strSql .= " and c_date >= '".$sdate."'  ";
	}

	if ($edate != "") {
		 $strSql .= " and c_date <= '".$edate." 23:59:59'  ";
	}

	if ($events != "") {
		 $strSql .= " and events = '".$events."'  ";
	}

	if ($searchtext != "") {
		$strSql = $strSql." and ".$cates." like '%".$searchtext."%'";
	}

	
	
	$total_sql = " 
		select h.*, c.user_code, c.user_id, c.user_name
		from 
		(
		  (
			select c_idx, r_date as c_date, '회원가입' as events, '0' as levels from tbl_customer
		  ) union all (
			select c_idx, e_date as c_date, '회원탈퇴' as events, '99' as levels from tbl_customer where e_date > '0001-01-01 00:00:00'
		  ) union all (
			select c_idx, regdate as c_date, '회원등급변경' as events, g_levels as levels from tbl_payment  where status = 'Y' and goods_type = 'g_level'
		  )
		) h
		left outer join tbl_customer c
		 on h.c_idx = c.c_idx
		where 1=1 
	" . $strSql;

	//echo "total_sql : " . $total_sql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);

?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="회원관리" data-title="이벤트조회">이벤트조회</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="">
					<fieldset>
						<legend>검색 조회 양식</legend>
						<span class="csb_tit">발생일 From ~ To</span>
						<input type="text" name="sdate" value="<?=$sdate?>" class="calendar2" placeholder="2017-01-01">
						<p class="and_txt">~</p>
						<input type="text" name="edate" value="<?=$edate?>" class="calendar2 mar_r10" placeholder="2017-01-01" >
						
						<select name="events" id="events" class=" mar_r10">
							<option value="">이벤트명콤보</option>
							<option value="회원가입" <?if($events=="회원가입")echo"selected";?> >회원가입</option>
							<option value="회원탈퇴" <?if($events=="회원탈퇴")echo"selected";?> >회원탈퇴</option>
							<option value="회원등급변경" <?if($events=="회원등급변경")echo"selected";?> >회원등급변경</option>
						</select>

						<select name="cates" id="cates" class=" mar_r10">
							<option value="user_code" <?if($cates=="user_code")echo"selected";?> >회원번호</option>
							<option value="user_name" <?if($cates=="user_name")echo"selected";?> >회원명</option>
							<option value="user_id" <?if($cates=="user_id")echo"selected";?> >아이디</option>
						</select>
						<input type="text" name="searchtext" value="<?=$searchtext?>" class="wd_200 mar_r10">
						<button type="submit" class="lookup_btn">조회</button>
					</fieldset>
				</form>
			</div>
			
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>이벤트조회 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>아이디</th>
							<th>회원번호</th>
							<th>회원명</th>
							<th>이벤트발생일</th>
							<th>이벤트명</th>
							<th>등급</th>
						</tr>
					</thead>
					<tbody>
						<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;
						
						$sql    = $total_sql . " order by c_date desc limit $nFrom, $g_list_rows ";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						while($row=mysql_fetch_array($result)){
							$nums = $num;

						?>

						<tr>
							<td><?=$nums?></td>
							<td><?=$row['user_id']?></td>
							<td><a href="javascript:pops_05_1btn();"><?=$row['user_code']?></a><!-- 8자리 --></td>
							<td><?=$row['user_name']?></td>
							<td><?=substr($row['c_date'],0,10)?></td>
							<td><?=$row['events']?></td>
							<td><?=$_pay_level[$row['levels']]?></td>
						</tr>

						<?
						$num = $num - 1;
							}
						?>

						
						
					</tbody>
				</table>
			</div>
			<?php //include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?sdate=$sdate&edate=$edate&events=$events&cates=$cates&searchtext=$searchtext&pg=")?>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
