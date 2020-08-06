<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>		
	<section id="container" >	
		<? include('maintenance_inc.php');?>	
		<?
			$a_idx		= updateSQ($_GET["a_idx"]);
			$total_sql	= " select * from tbl_agency where 1=1 and a_idx='$a_idx' ";
			$result		= mysql_query($total_sql) or die (mysql_error());
			$row		= mysql_fetch_array($result);
			$lat		= $row["lat"];
			$lng		= $row["lng"];

		?>
		<div class="wrap_1000">
		<div class="sub_tit">
			<h2>지역별 서비스 센터</h2>
		</div>
			<div class="sc_top">
				<h3 class="sc_tit"><?=$row["agency_name"]?> 서비스센터</h3>
			</div>
			<div class="contact_wrap">
				<div class="board_view">
					<table class="ta_view">
						<colgroup>
							<col class="colw01">
							<col class="colw02">
						</colgroup>
						<thead>
							<tr>
								<th>매장명</th>
								<td><?=$row["agency_name"]?></td>
							</tr>
							<tr>
								<th>주소</th>
								<td><?=$row["addr1"]." ".$row["addr2"]?></td>
							</tr>
							<tr>
								<th>연락처</th>
								<td><a href="tel:<?=$row["phone"]?>"><?=$row["phone"]?></a></td>
							</tr>
							<tr>
								<th>영업시간</th>
								<td><?=$row["open_time"]?></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="2" class="view_content">
									<?=viewSQ($row["contents"])?>
									<div class="map_view">
						
										<?=$row["map"]?>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					
					<div class="btn_wrap">
						<a href="javascript:history.back();" class="go_list">목록으로</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	
<? include('../inc/footer.inc.php');?>	