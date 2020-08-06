<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";

	$sdate			= updateSQ($_GET[sdate]);
	$edate			= updateSQ($_GET[edate]);


	$cates		= updateSQ($_GET[cates]);
	$search_word	= updateSQ($_GET[search_word]);
	$search_mode	= updateSQ($_GET[search_mode]);
	
	$g_list_rows = 10;

	$strSql = "";

	if ($searchtext != "") {
		$strSql .= " and ".$cates." like '%$searchtext%' ";
	}

	if ($sdate != "") {
		 $strSql .= " and c.r_date >= '".$sdate."'  ";
	}

	if ($edate != "") {
		 $strSql .= " and c.r_date <= '".$edate."'  ";
	}
	
	
	$total_sql = " 
					select b.*, c.user_id, c.user_code, c.user_name, c.r_date as in_ddd, (select count(*) cnts from tbl_room where b_idx = b.idx) as r_cnt
					, (select count(*) from tbl_build where c_idx = b.c_idx and status = 0) as t_cnt
					, (select count(*) from tbl_build where c_idx = b.c_idx and status = 0 and idx <= b.idx ) as e_cnt
					  from tbl_build b
					  left outer join tbl_customer c
						on b.c_idx = c.c_idx
					  where b.status = '0'  
				 " . $strSql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="데이터관리" data-title="건물리스트">건물리스트</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="" method="get" >
					<fieldset>
						<legend>검색 조회 양식</legend>
						<input type="text" name="sdate" value="<?=$sdate?>" class="calendar2" placeholder="2017-01-01">
						<p class="and_txt">~</p>
						<input type="text" name="edate" value="<?=$edate?>" class="calendar2 mar_r10" placeholder="2017-01-01" >
						<select name="cates" id="cates" class="mar_r10">
							<option value="c.user_code"	 <?if($cates=="c.user_code")echo"selected";?>	>회원번호</option>
							<option value="c.user_name"	 <?if($cates=="c.user_name")echo"selected";?>	>회원명</option>
							<option value="c.user_id"	 <?if($cates=="c.user_id")echo"selected";?>		>아이디</option>
							<option value="b.addr"		 <?if($cates=="b.addr")echo"selected";?>		>주소</option>
						</select>
						<input type="text" value="<?=$searchtext?>" name="searchtext" class="wd_200 mar_r10">
						<button type="submit" class="lookup_btn">조회</button>
					</fieldset>
				</form>
			</div>

			<div class="com_tb01">
				<table class="ta_list01">
					<caption>건물리스트 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>아이디</th>
							<th>회원번호</th>
							<th>회원명</th>
							<th>가입일</th>
							<th>형태</th>
							<th>건물별명</th>
							<th>우편번호</th>
							<th>주소</th>
							<th>전화번호</th>
							<th>이메일</th>
							<th>방/좌석개수</th>
							<th>선불/후불</th>
							<th>보안시설</th>
							<th>구분</th>
							<th>사업자명</th>
							<th>사업자번호</th>
							<th>대표자명</th>
							<th>업태</th>
							<th>종목</th>
							<th>부가세</th>
						</tr>
					</thead>
					<tbody>
					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;
						
						$sql    = $total_sql . " order by idx desc limit $nFrom, $g_list_rows ";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						while($row=mysql_fetch_array($result)){
							$nums = $num;
					?>

						<tr>
							<td><?=$nums?></td>
							<td><?=$row['user_id']?></td>
							<td><?=$row['user_code']?></td>
							<td><?=$row['user_name']?></td>
							<td><?=substr($row['in_ddd'],0,10)?></td>
							<td>
								<?=$_admin_house_type[$row['house_type']]?> (<?=$row['e_cnt']?> / <?=$row['t_cnt']?>)
							</td>
							<td><?=$row['aliasName']?></td>
							<td><?=$row['zipcode']?></td>
							<td><?=$row['addr']?></td>
							<td><?=$row['tel']?></td>
							<td><?=$row['email']?></td>
							<td><?=number_format($row['r_cnt'])?></td>
							<td><?=$_pay_type[$row['pay_type']]?></td>
							<td><?=$_security[$row['security']]?></td>
							<td><?=$_com_type[$row['com_type']]?></td>
							<td><?=$row['com_name']?></td>
							<td>
								<?
								if($row['com_num']!="--"){
									echo $row['com_num'];
								}
								?>
							</td>
							<td><?=$row['com_oder']?></td>

							<td><?=$row['com_kind1']?></td>
							<td><?=$row['com_kind2']?></td>
							<td>
								<?
								if($row['com_type']>0){
									echo $_add_tax[$row['tax']];
								}
								?>
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
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?sdate=".$sdate."&edate=".$edate."&cates=".$cates."&searchtext=".$searchtext."&pg=")?>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
