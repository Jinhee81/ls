<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 
?>
<?
$g_list_rows = 10;
if ($search_name)
{
	$strSql = $strSql." and replace(".$search_category.",'-','') like '%".str_replace("-","",$search_name)."%' ";
}
if ($sido)
{
	$strSql = $strSql." and sido = '".$sido."' ";
}
if ($gugun)
{
	$strSql = $strSql." and gugun = '".$gugun."' ";
}
$total_sql = " select * from tbl_agency where 1=1 $strSql ";
$result = mysql_query($total_sql) or die (mysql_error());
$nTotalCount = mysql_num_rows($result);

$nPage = ceil($nTotalCount / $g_list_rows);
if ($pg == "") $pg = 1;
$nFrom = ($pg - 1) * $g_list_rows;

$sql    = $total_sql . " order by a_idx desc limit $nFrom, $g_list_rows ";
$result = mysql_query($sql) or die (mysql_error());
$num = $nTotalCount - $nFrom;
?>
<?
while($row=mysql_fetch_array($result)){
?>
<tr>
										<td class="store"><?=$row["agency_name"]?></td>
										<td class="subject"><a href="store_view.php?a_idx=<?=$row["a_idx"]?>&search_name=<?=$search_name?>&sido=<?=$sido?>&gugun=<?=$gugun?>"><?=$row["addr1"]." ".$row["addr2"]?></a></td>
										<td  class="phone">
											<a href="tel:<?=$row["phone"]?>"><?=$row["phone"]?></a>
										</td>
								
										<td class="view_more"><a href="store_view.php?a_idx=<?=$row["a_idx"]?>&search_name=<?=$search_name?>&sido=<?=$sido?>&gugun=<?=$gugun?>" class="btn_more">상세정보</a></td>
</tr>
<? } ?>
<?
	if ($pg >= $nPage)
	{
?>
	<script>
	$(".btn_wrap").hide();	
	</script>
<?
	}
?>