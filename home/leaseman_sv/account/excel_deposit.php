<?
	include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
	
	header("Content-Type: text/html; charset=utf-8");

	
	header("Content-type: application/vnd.ms-excel; charset=UTF-8"); 
	Header("Content-type: charset=utf-8");
	header("Content-Disposition: attachment; filename=ctr_deposit.xls");
	Header("Content-Description: PHP3 Generated Data");
	Header("Pragma: no-cache");
	Header("Expires: 0");
	


	$sql = $_GET['sql'];

	//echo $sql;


	?>
	<style type="text/css">
		.coltype1{background:yellow}
		.coltype2{background:yellowgreen}
	</style>


	<table border="1">
		<thead>
			<tr></tr>
			<tr></tr>
			<tr>
				<th class="coltype1">순번</th>
				<th class="coltype2">계약일</th>
				<th class="coltype2">계약번호</th>
				<th class="coltype2">보증금</th>
				<th class="coltype2">계약시작일</th>
				<th class="coltype2">계약종료일</th>
				<th class="coltype2">계약개월</th>
				<th class="coltype2">월이용료</th>
				<th class="coltype1">청구번호</th>
				<th class="coltype1">입금일</th>
				<th class="coltype1">청구시작일</th>
				<th class="coltype1">청구종료일</th>
				<th class="coltype1">청구개월</th>
				<th class="coltype1">공급가액</th>
				<th class="coltype1">세액</th>
				<th class="coltype1">관리비</th>
				<th class="coltype1">입금액</th>
				<th class="coltype1">입금구분</th>
				<th class="coltype1">수납구분</th>
				<th class="coltype2">생년월일</th>
				<th class="coltype2">성별</th>
				<th class="coltype1">고객명</th>
				<th class="coltype2">사업자번호</th>
				<th class="coltype1">사업자명</th>
				<th class="coltype1">상품</th>
				<th class="coltype1">건물별명</th>
				<th class="coltype1">방/좌석번호</th>
				<th class="coltype1">세금계산서 발행일</th>
				<th class="coltype1">전자계산서</th>
			</tr>
		</thead>
		<tbody>
		<?
			
			
			//echo $sql;
			$result = mysql_query($sql) or die (mysql_error());
			
			$nTotalCount = mysql_num_rows($result);
			$num = $nTotalCount;

			while($row=mysql_fetch_array($result)){
				$nums = $num;

				$sql_bill = "select * from tbl_billa where ordernum = '".$row['callnum']."' ";
				$result_bill = mysql_query($sql_bill);
				$row_bill = mysql_fetch_array($result_bill);

				
				if($row['t_supply']-$row['max_r_price'] <= 0 ){
					$bill_chk71 = "t";
				}else{
					$bill_chk71 = "e";
				}
				

				$sql_main = "select * from tbl_contract where idx = '".$row['cc_idx']."' ";
				$result_main = mysql_query($sql_main);
				$row_main = mysql_fetch_array($result_main);


				$sql_man = "select * from tbl_user where r_idx = '".$row['user_idx']."' ";
				$result_man = mysql_query($sql_man);
				$row_man = mysql_fetch_array($result_man);
				


			?>

			<tr>
				<td><?=$nums?></td>
				<td><?=$row_main['c_date']?></td>
				<td><?=$row_main['ordernum']?></td>
				<td><?=number_format($row_main['de_in']-$row_main['de_out'])?></td>
				<td><?=$row_main['s_date']?></td>
				<td><?=$row_main['e_date']?></td>
				<td><?=$row_main['period']?></td>
				<td><?=number_format($row_main['total_price'])?></td>
				<td><?=$row['callnum']?></td>
				<td><?=$row['max_r_date']?></td>
				<td><?=$row['t_s_date']?></td>
				<td><?=$row['t_e_date']?></td>
				<td style="text-align:center;"><?=$row['cnt_row']?></td>
				<td><?=number_format($row['t_supply'])?></td>
				<td><?=number_format($row['t_tax'])?></td>
				<td><?=number_format($row['t_cost'])?></td>
				<td><?=number_format($row['max_r_price'])?></td>
				<td><?=$_income_type[$row['income_type']]?></td>
				<?
				if($row['late_date']>0){
					$late_chk = "(연체)";
				}else{
					$late_chk = "";
				}
												?>
				<td>
					<?
					if($row['t_supply']-$row['max_r_price'] <= 0 ){
						echo "완납";
					}else{
						echo "미납";
					}
					?>
					
					<?=$late_chk?>
				</td>


				<td><?=$row_man['birthday']?></td>
				<td>
					<?
					if($row_man['gender']=="m"){
						echo "남";
					}else if($row_man['gender']=="w"){
						echo "여";
					}
					
					?>
				</td>
				<td><?=$row_man['user_name']?></td>
				<td style="text-align:left;"><?=$row_man['com_num']?></td>


				<td style="text-align:left;"><?=$row['com_name']?></td>

				<td style="text-align:left;"><?=$row['goodsname']?></td>
				<td style="text-align:left;"><?=$row['aliasName']?></td>
				<td style="text-align:left;"><?=$row['roomname']?></td>


				<td style="text-align:center;">
					<?
					if($row_bill['writeDate']){
						echo substr($row_bill['writeDate'],0,4) . "-" . substr($row_bill['writeDate'],4,2) . "-" . substr($row_bill['writeDate'],6,2);
					}
					?>
				</td>
				<td style="text-align:center;"><?if($row_bill['idx']){?>
				발행
				<?}?></td>
				
			</tr>

			<?
			$num = $num - 1;
				}
			?>
			
		</tbody>
	</table>