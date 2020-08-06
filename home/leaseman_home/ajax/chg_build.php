<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";



$b_idx = $_GET['b_idx'];

$sql_m = "select * from tbl_room where b_idx = '".$b_idx."' and c_idx = '".$_SESSION[customer][idx]."' order by ordernum asc ";
$result_m = mysql_query($sql_m);

while($row_m = mysql_fetch_array($result_m)){
?>
	<option value="<?=$row_m[idx]?>"><?=$row_m[roomname]?></option>
<?
}
?>