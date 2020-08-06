<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";

	$cate_date		= updateSQ($_GET[cate_date]);
	$sdate			= updateSQ($_GET[sdate]);
	$edate			= updateSQ($_GET[edate]);
	$cates			= updateSQ($_GET[cates]);
	$searchtext		= updateSQ($_GET[searchtext]);


	$g_list_rows = 10;

	$strSql = "";

	if($sdate != "") {
		 $strSql .= " and ".$cate_date." >= '".$sdate."'  ";
	}

	if($edate != "") {
		 $strSql .= " and ".$cate_date." <= '".$edate." 23:59:59'  ";
	}

	if($searchtext != ""){
		$strSql .= " and ".$cates." like '%".$searchtext."%'  ";
	}
	
	
	$total_sql = " select * from tbl_push where 1=1  " . $strSql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);

?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2"  data-type="환경설정" data-title="푸쉬메시지관리">푸쉬메시지관리</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="" method="get">
					<fieldset>
						<legend>검색 조회 양식</legend>
						<select name="cate_date" id="cate_date" class="mar_r10">
							<option value="reg_date" <?if($cate_date=="reg_date")echo"selected";?>>등록일시</option>
							<option value="real_send_time" <?if($cate_date=="real_send_time")echo"selected";?>>발송일시</option>
						</select>
						<input type="text" name="sdate" value="<?=$sdate?>" class="calendar2" placeholder="2017-01-01">
						<p class="and_txt">~</p>
						<input type="text" name="edate" value="<?=$edate?>" class="calendar2 mar_r10" placeholder="2017-01-01" >

						<select name="cates" id="cates" class="mar_r10">
							<option value="title" <?if($cates=="title")echo"selected";?>>제목</option>
							<option value="content" <?if($cates=="content")echo"selected";?>>내용</option>
						</select>
						<input type="text" name="searchtext" value="<?=$searchtext?>" class="wd_200 mar_r10">
						<button type="submit" class="lookup_btn">조회</button>
					</fieldset>
				</form>
			</div>
			<div class="com_btn_box">				
				<div class="right">
					<button type="button" class="blue_btn" onClick="pops_04_1btn();">추가</button>				
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>푸싱메시지관리 표</caption>
					<colgroup>
						<col  width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>등록자명</th>
							<th>제목</th>
							<th>내용</th>
							<th>수정자명</th>
							<th>수정일시</th>
							<th>등록일시</th>
							<th>발송일시</th>
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
					?>

						<tr>
							<td><?=$nums?></td>
							<td><?=$row_ma['user_name']?></td>
							<td><a href="list03_mod.php?idx=<?=$row['idx']?>" class="a_color01"><?=$row['title']?></a></td>
							<td><a href="list03_mod.php?idx=<?=$row['idx']?>" class="a_color01"><?=mb_substr(strip_tags($row['content']),0,10,"UTF-8")?> ....</a></td>
							<td><?=$row['mod_id']?></td>
							<td><?=$row['mod_date']?></td>
							<td><?=$row['reg_date']?></td>
							<td><?=$row['real_send_time']?></td>
						</tr>
					
					<?
					$num = $num - 1;
						}
					?>

					</tbody>
				</table>
			</div>
			<?php //include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
			<?echo wmpagelisting($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?sdate=".$sdate."&edate=".$edate."&pg=")?>
		</div>
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
