<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 
?>
<option value="">시/군/구 선택</option>	
<?
	$sql    = " select distinct gugun from tbl_area where sido='".$_GET["sido"]."' ";
	echo $sql;
	$result = mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_array($result))
	{
?>
<option value="<?=$row["gugun"]?>"><?=$row["gugun"]?></option>
<? } ?>