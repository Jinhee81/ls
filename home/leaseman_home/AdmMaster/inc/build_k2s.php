<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";

	$idx		= updateSQ($_GET[idx]);

	$sql = "select * from tbl_build where c_idx = '".$idx."' ";
	$result = mysql_query($sql);
	


?>
<section class="pops_wrap">	
	<div class="pops_box pops_05_2">
		<div class="pops_h">
			<h2>건물관리</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_hbox">
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>건물관리 표</caption>
					<colgroup>
						<col width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>형태</th>
							<th>건물별명</th>
							<th>우편번호</th>
							<th>소재지</th>
							<th><span class="color01">방/좌석(개)</span></th>
							<th><span class="color01">선불후불</span></th>
							<th><span class="color01">보안시설</span></th>
						</tr>
					</thead>
					<tbody>
					<?
					$nums = 0;
					while($row = mysql_fetch_array($result)){
						$nums++;

						$sql_r = "select count(*) cnts from tbl_room where b_idx = '".$row[idx]."' ";
						$result_r = mysql_query($sql_r);
						$row_r = mysql_fetch_array($result_r);

					?>
						<tr>
							<td><?=$nums?></td>
							<td><?=$_admin_house_type[$row['house_type']]?></td>
							<td><?=$row['aliasName']?></td>
							<td><?=$row['zipcode']?></td>
							<td><?=$row['addr']?></td>
							<td><?=number_format($row_r['cnts'])?></td>
							<td><?=$_pay_type[$row['pay_type']]?></td>
							<td><?=$_security[$row['security']]?></td>
						</tr>
					<?}?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>