<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";

	
	$sdate	= updateSQ($_GET[sdate]);
	$edate	= updateSQ($_GET[edate]);
	
	$g_list_rows = 10;

	$strSql = "";

	if ($sdate != "") {
		 $strSql .= " and r_date >= '".$sdate."'  ";
	}

	if ($edate != "") {
		 $strSql .= " and r_date <= '".$edate." 23:59:59'  ";
	}
	
	
	$total_sql = " select * from tbl_admin where status = 'Y' and secede_yn = 'N'  " . $strSql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);

?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2"  data-type="환경설정" data-title="관리자관리">관리자관리</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="" method="get" >
					<fieldset>
						<legend>검색 조회 양식</legend>
						<label for="" class="csb_tit">가입일</label>
						<input type="text" name="sdate" value="<?=$sdate?>" class="calendar2" placeholder="2017-01-01">
						<p class="and_txt">~</p>
						<input type="text" name="edate" value="<?=$edate?>" class="calendar2 mar_r10" placeholder="2017-01-01" >
						<button type="submit" class="lookup_btn">조회</button>
					</fieldset>
				</form>
			</div>
			<div class="com_btn_box">				
				<div class="right">
					<button type="button" class="blue_btn" onClick="pops_04btn();">관리자 추가</button>				
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>관리자관리 표</caption>
					<colgroup>
						
					</colgroup>
					<thead>
						<tr>
							<th>아이디</th>
							<th>이름</th>
							<th>연락처</th>
							<th>권한</th>
							<th>가입일</th>
						</tr>
					</thead>
					<tbody>

					<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;
						
						$sql    = $total_sql . " order by m_idx desc limit $nFrom, $g_list_rows ";
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						while($row=mysql_fetch_array($result)){
							$nums = $num;
					?>
						<tr>
							<td><a href="list02_mod.php?m_idx=<?=$row['m_idx']?>" class="a_color01"><?=$row['user_id']?></a></td>
							<td><a href="list02_mod.php?m_idx=<?=$row['m_idx']?>" class="a_color01"><?=$row['user_name']?></a></td>
							<td><a href="list02_mod.php?m_idx=<?=$row['m_idx']?>" class="a_color01"><?=$row['mobile']?></a></td>
							<td>
								<?
								$tmp_mod = $row['chmods'];
								$tmp_mod = substr($tmp_mod,1,sizeof($tmp_mod)-2);
								$arr_mod = explode("||",$tmp_mod);
								foreach($arr_mod as $key => $value){
									if($key>0)
										echo ", ";
									echo $_master_nol[$value];

								}
								?>
							</td>
							<td><?=substr($row['r_date'],0,10)?></td>
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
