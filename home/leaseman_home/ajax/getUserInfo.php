<?
include $_SERVER['DOCUMENT_ROOT']."/inc/head_inc.php"; 
header("Content-Type: text/html; charset=utf-8");

$r_idx = $_GET['r_idx'];

$sql_m = "select * from tbl_user where r_idx = '".$r_idx."' and c_idx = '".$_SESSION[customer][idx]."' ";
$result_m = mysql_query($sql_m);
$row_m = mysql_fetch_array($result_m);

?>

<script type="text/javascript">
$(document).ready(function(){
	
	var user_name = "<?=$row_m['user_name']?>";
	$("#user_name",parent.document).html(user_name);

	var mobile = "<?=$row_m['mobile']?>";
	$("#mobile",parent.document).html(mobile);

	var com_type = "<?=$_com_type[$row_m['com_type']]?>";
	$("#com_type",parent.document).html(com_type);

	var com_name = "<?=$row_m['com_name']?>";
	$("#com_name",parent.document).html(com_name);

	var com_num = "<?=$row_m['com_num']?>";
	$("#com_num",parent.document).html(com_num);

	var memo = "<?=$row_m['memo']?>";
	$("#memo",parent.document).html(memo);

	var u_idx = "<?=$row_m['r_idx']?>";
	$("#u_idx",parent.document).val(u_idx);

});

</script>