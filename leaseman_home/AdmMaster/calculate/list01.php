<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";


	$sdate		= updateSQ($_GET[sdate]);
	$edate		= updateSQ($_GET[edate]);
	$g_levels	= updateSQ($_GET[g_levels]);
	$cates2		= updateSQ($_GET[cates2]);
	$cates		= updateSQ($_GET[cates]);
	$searchtext	= updateSQ($_GET[searchtext]);
	
	
	$g_list_rows = 10;

	$strSql = "";

	if ($sdate != "") {
		 $strSql .= " and p.pay_regdate >= '".$sdate."'  ";
	}

	if ($edate != "") {
		 $strSql .= " and p.pay_regdate <= '".$edate." 23:59:59'  ";
	}

	if ($g_levels != "") {
		 $strSql .= " and p.g_levels = '".$g_levels."'  ";
	}

	if ($cates2 != "") {
		 $strSql .= " and p.pay_type like '%".$cates2."%'  ";
	}

	if ($searchtext != "") {
		 $strSql .= " and ".$cates." like '%".$searchtext."%'  ";
	}
	
	
	$total_sql = " 	
					select p.*, c.user_id, c.user_code, c.user_email, c.user_name, c2.user_id as reco_ids
						, (select count(*) cnts from tbl_payment where goods_type = 'g_level' and pay_regdate <= p.pay_regdate and status = 'Y' and c_idx = c.c_idx ) as wtf
					  from tbl_payment p
					  left outer join tbl_customer c
						on p.c_idx = c.c_idx
					  left outer join tbl_customer c2
						on c.reco_id = c2.c_idx
					 where p.status = 'Y'		 
		" . $strSql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);


	$sql_p = " select sum(price) as t_price
					  from tbl_payment p
					  left outer join tbl_customer c
						on p.c_idx = c.c_idx
					  left outer join tbl_customer c2
						on c.reco_id = c2.c_idx
					 where p.status = 'Y'		 
		" . $strSql;
	$result_p = mysql_query($sql_p) or die (mysql_error());
	$row_p = mysql_fetch_array($result_p);

?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="정산관리" data-title="입금리스트">입금리스트</h2>
			</div>
			<div class="com_search_box">
				<form action="" method="get" >
					<fieldset>
						<legend>검색 조회 양식</legend>
						<label for="" class="csb_tit">입금일</label>
						<input type="text" name="sdate" value="<?=$sdate?>" class="calendar2" placeholder="2017-01-01">
						<p class="and_txt">~</p>
						<input type="text" name="edate" value="<?=$edate?>" class="calendar2 mar_r10" placeholder="2017-01-01" >
						
						<select name="g_levels" id="g_levels" class=" mar_r10">
							<option value="">등급</option>
							<?foreach($_pay_level as $key=>$value){
								if($key == 0 || $key == 99)
									continue;
							?>
								<option value="<?=$key?>" <?if($g_levels==$key)echo "selected";?> ><?=$value?></option>
							<?}?>
						</select>
						
						<select name="cates2" id="cates2" class=" mar_r10">
							<option value="">결제방법</option>
							<option value="Card"		<?if($cates2=="Card")echo "selected";?> >신용카드</option>
							<option value="DirectBank"	<?if($cates2=="DirectBank")echo "selected";?> >계좌이체</option>
							<option value="VBank"		<?if($cates2=="VBank")echo "selected";?> >무통장입금</option>
							<option value="HPP"			<?if($cates2=="HPP")echo "selected";?> >휴대폰</option>

						</select>
						<select name="cates" id="cates" class=" mar_r10">
							<option value="c.user_code"	<?if($cates=="c.user_code")echo "selected";?> >회원번호</option>
							<option value="c.user_name"	<?if($cates=="c.user_name")echo "selected";?> >회원명</option>
							<option value="c.user_id"	<?if($cates=="c.user_id")echo "selected";?> >아이디</option>
						</select>
						<input type="text" name="searchtext" value="<?=$searchtext?>" class="wd_200 mar_r10">
						<button type="submit" class="lookup_btn">조회</button>
					</fieldset>
				</form>
			</div>
			<div class="com_info_tb">
				<ul>
					<li>
						<strong class="blue">총 <?=number_format($nTotalCount)?>건</strong> / 금액 <?=number_format($row_p[t_price])?>원
					</li>
				</ul>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>정산관리</caption>
					<colgroup>
						<col  width="50px;"/>
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>결제일</th>
							<th>회원번호</th>
							<th>회원명</th>
							<th>아이디</th>
							<th>등급</th>
							<th>상품</th>
							<th>시작일</th>
							<th>종료일</th>							
							<th>결제상세</th>							
							<th>결제금액</th>
							<th>결제회차</th>
							<th>추천인아이디</th>
						</tr>
					</thead>
					<tbody>

					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;
						
						$sql    = $total_sql . " order by p.idx desc limit $nFrom, $g_list_rows ";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						while($row=mysql_fetch_array($result)){
							$nums = $num;
					?>

						<tr>
							<td><?=$nums?></td>
							<td><?=substr($row['pay_regdate'],0,10)?></td>
							<td><?=$row['user_code']?></td>
							<td><?=$row['user_name']?></td>
							<td><?=$row['user_id']?></td>
							<td>
							<?
							if($row['goods_type']=="g_level"){
								echo $_pay_level[$row['g_levels']];
							}
							?>
							</td>
							<td>
							<?
							if($row['goods_type']=="g_level"){
								echo "정기권";
							}else if($row['goods_type']=="g_coin"){
								echo "코인";
							}
							?>
							</td>
							<td><?=substr($row['regdate'],0,10)?></td>
							<td><?=substr($row['edate'],0,10)?></td>
							<td><?=ini_payMethod($row['pay_type'])?></td>
							<td><?=number_format($row['price'])?></td>
							<td>
							<?
							if($row['goods_type']=="g_level"){
								echo number_format($row['wtf']);
							}
							?>
							</td>
							<td><?=$row['reco_ids']?></td>
						</tr>

					<?
					$num = $num - 1;
						}
					?>

					</tbody>
				</table>
			</div>
			<?php //include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?sdate=".$sdate."&edate=".$edate."&g_levels=".$g_levels."&cates2=".$cates2."&cates=".$cates."&searchtext=".$searchtext."&pg=")?>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
