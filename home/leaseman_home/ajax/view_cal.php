<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



$rel = $_GET['rel'];

$sql_m = "select * from tbl_contract_sub
where callnum = '".$rel."'
order by ordernum asc ";
$result_m = mysql_query($sql_m);

$row_cnt=0;


while($row_m = mysql_fetch_array($result_m)){
	$row_cnt++;

	if($row_m['r_price']){
		$r_price = $row_m['r_price'];
	}

	if($row_m['r_date']){
		$r_date = $row_m['r_date'];
	}
?>
	<tr>
		<td><?=$row_cnt?></td>
		<td><?=$row_m['s_date']?></td>
		<td><?=$row_m['e_date']?></td>
		<td><?=$r_date?></td>
		<td><?=number_format($r_price)?></td>
		<td><?=number_format($row_m['tax'])?></td>
		<td><?=number_format($row_m['cost'])?></td>
	</tr>
<?
}
?>