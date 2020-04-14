<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";


	$status			= updateSQ($_GET[status]);
	$sdate			= updateSQ($_GET[sdate]);
	$edate			= updateSQ($_GET[edate]);
	$cates			= updateSQ($_GET[cates]);
	$searchtext		= updateSQ($_GET[searchtext]);


	$g_list_rows = 10;

	$strSql = "";

	if($status != "") {
		 $strSql .= " and p.status = '".$status."'  ";
	}

	if($sdate != "") {
		 $strSql .= " and p.r_date >= '".$sdate."'  ";
	}

	if($edate != "") {
		 $strSql .= " and p.r_date <= '".$edate." 23:59:59'  ";
	}

	if($searchtext != ""){
		$strSql .= " and ".$cates." like '%".$searchtext."%'  ";
	}
	
	
	$total_sql = " 
			select p.*, a.user_name
			  from tbl_popup2 p
			  left outer join tbl_admin a
			    on p.reg_id = a.user_id
			 where 1=1  
		" . $strSql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2"  data-type="환경설정" data-title="팝업관리">팝업관리</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="" method="get" name="frm" >
					<fieldset>
						<legend>검색 조회 양식</legend>
						<label for="" class="csb_tit">등록일시</label>
						<input type="text" name="sdate" value="<?=$sdate?>" class="calendar2" placeholder="2017-01-01">
						<p class="and_txt">~</p>
						<input type="text" name="edate" value="<?=$edate?>" class="calendar2 mar_r10" placeholder="2017-01-01" >
						<select name="status" id="status" class="wd_03 mar_r10">
							<option value="" <? if ($status == "") { echo "selected"; } ?> >전체</option>	
							<option value="A" <? if ($status == "A") { echo "selected"; } ?> >자동노출</option>	
							<option value="B" <? if ($status == "B") { echo "selected"; } ?> >노출</option>	
							<option value="C" <? if ($status == "C") { echo "selected"; } ?> >비노출</option>	
						</select>
						<select name="cates" id="cates" class="wd_04 mar_r10">
							<option value="a.user_name" <?if($cates=="a.user_name")echo"selected";?> >등록자명</option>
							<option value="p.P_CONTENT" <?if($cates=="p.P_CONTENT")echo"selected";?> >내용</option>
						</select>
						<input type="text" name="searchtext" id="searchtext" value="<?=$searchtext?>" class="wd_200 mar_r10">
						<button type="submit" class="lookup_btn">조회</button>
					</fieldset>
				</form>
			</div>
			<div class="com_btn_box">				
				<div class="right">
					<button type="button" class="blue_btn" onClick="pops_04_2btn();">등록</button>				
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>팝업관리 표</caption>
					<colgroup>
						<col  width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>사용여부</th>
							<th>제목</th>
							<th>내용</th>
							<th>등록일시</th>
							<th>등록자명</th>
							<th>게시기간</th>
							<th>수정일시</th>
							<th>수정자명</th>
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

							$sql_ma = "select user_name from tbl_admin where user_id = '".$row['reg_id']."' ";
							$result_ma = mysql_query($sql_ma);
							$row_ma = mysql_fetch_array($result_ma);

							$sql_ma2 = "select user_name from tbl_admin where user_id = '".$row['mod_id']."' ";
							$result_ma2 = mysql_query($sql_ma2);
							$row_ma2 = mysql_fetch_array($result_ma2);
					?>

						<tr>
							<td><?=$nums?></td>
							<td>
							<?
							if($row[status] == "A"){
								echo "일정별 자동노출";
							}else if($row[status] == "B"){
								echo "강제 노출";
							}else if($row[status] == "C"){
								echo "강제 비노출";
							}
								
							?>	
							</td>
							<td><a href="list04_mod.php?idx=<?=$row['idx']?>" class="a_color01"><?=$row[P_SUBJECT]?></a></td>
							<td><a href="list04_mod.php?idx=<?=$row['idx']?>" class="a_color01"><?=mb_substr(strip_tags($row[P_CONTENT]),0,10,"UTF-8")?>....</a></td>
							<td><?=$row[r_date]?></td>
							<td><?=$row_ma['user_name']?></td>
							<td>
								<?=$row[P_STARTDAY]?> <?=$row[P_START_HH]?>:<?=$row[P_START_MM]?> ~ <?=$row[P_ENDDAY]?> <?=$row[P_END_HH]?>:<?=$row[P_END_MM]?>
							</td>
							<td><?=$row[mod_date]?></td>
							<td><?=$row_ma2['user_name']?></td>
						</tr>
					
					<?
					$num = $num - 1;
						}
					?>

					</tbody>
				</table>
			</div>
			<?php //include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?sdate=".$sdate."&edate=".$edate."&status=".$status."&cates=".$cates."&searchtext=".$searchtext."&pg=")?>
		</div>
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
