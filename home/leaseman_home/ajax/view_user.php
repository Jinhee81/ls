<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



	$rel = $_GET['rel'];


	$sql_sub = "SELECT s.*, datediff(ifnull((date_format(s.r_date,'%Y-%m-%d') ),now() )    ,date_format(s.b_date,'%Y-%m-%d') ) as late_date 
	  FROM tbl_contract_sub s
	  LEFT OUTER JOIN tbl_contract c
		ON c.idx = s.c_idx
	 WHERE c.ordernum = '".$rel."'
	 ORDER BY s.ordernum ASC
	 ";
	//echo $sql_sub;
	$result_sub = mysql_query($sql_sub);



	$num_row = 0;
	$sum_late_price = 0;
	$sum_late_date = 0;
	$sum_late_rate = 0;

	$old_callnum = "";

	while($row_sub = mysql_fetch_array($result_sub)){
		$num_row++;

		if($old_callnum != $row_sub['callnum']){
			$old_callnum = $row_sub['callnum'];
			$print_callnum = $old_callnum;
		}else{
			$print_callnum = "";

		}



		//연체일
		if($print_callnum){

			if($row_sub['late_date']>0){
				$late_date = $row_sub['late_date'];
			}else{
				$late_date = "0";
			}

			// 연체이자, 미납액 구하기
			$sql_sub2 = "select * 
						, datediff(ifnull((date_format(max(r_date),'%Y-%m-%d') ),now() )    ,date_format(b_date,'%Y-%m-%d') ) as late_date
						, count(*) as cnt_row
						, sum(supply) as t_supply
						, sum(tax) as t_tax
						, sum(cost) as t_cost
						, sum(total_price) as t_total_price
						, min(s_date) as t_s_date
						, max(e_date) as t_e_date
						, max(r_date) as t_r_date
						, max(r_price) as t_r_price
						";


			$sql_sub2 .= " from tbl_contract_sub ";
			$sql_sub2 .= " where callnum = '".$print_callnum."'  ";
			$sql_sub2 .= " order by ordernum asc ";

			//echo $print_callnum."<br/>".$sql_sub2 . "<br/>";
			$result_sub2 = mysql_query($sql_sub2);
			$row_sub2 = mysql_fetch_array($result_sub2);



			//연체이자
			if($late_date>0){
				$late_rate = round(($row_sub2['t_total_price'] * 0.2 / 365 * $late_date),0);
			}else{
				$late_rate = "0";
			}

			//미납액
			/*
			if($late_date>0){
				$late_price = $row_sub2['t_total_price'] - $row_sub2['t_r_price'] + $late_rate;
			}else{
				$late_price = "0";
			}
			*/
			$late_price = $row_sub2['t_total_price'] - $row_sub2['t_r_price'] + $late_rate;
			

			$sum_late_price += $late_price;
			$sum_late_date += $late_date;
			$sum_late_rate += $late_rate;
		}

		
?>

		<tr>
			<td><?=$row_sub['ordernum']?></td>
			<td><?=$row_sub['s_date']?></td>
			<td><?=$row_sub['e_date']?></td>
			<td><?=$row_sub['b_date']?></td>
			<td><?=number_format($row_sub['supply'])?></td>
			<td><?=number_format($row_sub['tax'])?></td>
			<td><?=number_format($row_sub['cost'])?></td>
			<td><?=number_format($row_sub['supply']+$row_sub['tax']+$row_sub['cost'])?></td>


			<?if($print_callnum){
			?>

			<td><?=$row_sub['r_date']?></td>
			<td><?=number_format($row_sub['r_price'])?></td>
			<td><?=$_income_type[$row_sub['income_type']]?></td>
			<td>
				<?
				if($row_sub['r_price']==""){
					if($row_sub['late_date']>0){
						echo "미납";
					}else{
						echo "입금대기";
					}
				}else{
					if($late_price>0){
						echo "미납";
					}else{
						echo "완납";
						
					}
					if($late_date>0){
						echo "(연체)";
					}
				}
				?>
			</td>
			<td><?=number_format($late_price)?></td>
			<td><?=number_format($late_date)?></td>
			<td><?=number_format($late_rate)?></td>
			<?}else{?>

				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
					
			<?}?>
		</tr>
<?
	}
?>