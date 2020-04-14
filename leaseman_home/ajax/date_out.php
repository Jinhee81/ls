<?php
include $_SERVER['DOCUMENT_ROOT']."/inc/head_inc.php";

$c_idx = $_SESSION[customer][idx];
$b_idx = $_GET['b_idx'];
$r_date = $_GET['r_date'];

$r_date = substr($r_date,0,7);

$sql_sub = "";
if($b_idx){
	$sql_sub = " and c.b_idx = '".$b_idx."' ";
}

$sql  = "";

$sql .= " SELECT s.ordernum,u.user_name, u.com_name, r.roomname, s.s_date	";
$sql .= "   FROM tbl_contract_sub s								";
$sql .= "   LEFT OUTER JOIN tbl_contract c						";
$sql .= "     ON s.c_idx = c.idx								";
$sql .= "   LEFT OUTER JOIN tbl_user u							";
$sql .= "     ON c.u_idx = u.r_idx								";
$sql .= "   LEFT OUTER JOIN tbl_room r							";
$sql .= "     ON c.r_idx = r.idx								";
$sql .= "  WHERE left(s.s_date,7) = '".$r_date."'				";
$sql .= "    AND c.c_idx = '".$c_idx."' 						";
$sql .= $sql_sub;
$sql .= "  ORDER BY s.callnum ASC								";

$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){
	
	$com_name = $row[com_name];

	if(mb_strlen($com_name) > 2){
		$com_name = mb_substr($com_name,0,2,"utf-8") . "..";
	}
?>

<script type="text/javascript">


var date_text = "<p class='start'><?=$row[roomname]?> <?=$row[user_name]?><span title='<?=$row[com_name]?>'>(<?=$com_name?>)</span> Start(<?=$row[ordernum]?>)</p>";
$("#date_<?=$row[s_date]?>",parent.document).append(date_text);


var tmp_cnt = $("#date_<?=$row[s_date]?>_cnt",parent.document).text();
tmp_cnt = parseInt(tmp_cnt) + 1;
$("#date_<?=$row[s_date]?>_cnt",parent.document).text(tmp_cnt);

if(tmp_cnt>4){
	$("#more_<?=$row[s_date]?>",parent.document).css("display","block");
}

</script>

<?}?>




<?
$sql  = "";

$sql .= " SELECT s.ordernum,u.user_name, u.com_name, r.roomname, s.e_date, c.e_date as c_end	";
$sql .= "   FROM tbl_contract_sub s								";
$sql .= "   LEFT OUTER JOIN tbl_contract c						";
$sql .= "     ON s.c_idx = c.idx								";
$sql .= "   LEFT OUTER JOIN tbl_user u							";
$sql .= "     ON c.u_idx = u.r_idx								";
$sql .= "   LEFT OUTER JOIN tbl_room r							";
$sql .= "     ON c.r_idx = r.idx								";
$sql .= "  WHERE left(s.e_date,7) = '".$r_date."'				";
$sql .= "    AND c.c_idx = '".$c_idx."' 						";
$sql .= $sql_sub;
$sql .= "  ORDER BY s.callnum ASC								";

$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){

	$com_name = $row[com_name];

	if(mb_strlen($com_name) > 2){
		$com_name = mb_substr($com_name,0,2,"utf-8") . "..";
	}

	if($row[e_date] == $row[c_end]){
		$last_txt = "/퇴실";
	}else{
		$last_txt = "";
	}


?>

<script type="text/javascript">


var date_text = "<p class='end'><?=$row[roomname]?> <?=$row[user_name]?><span title='<?=$row[com_name]?>'>(<?=$com_name?>)</span> End(<?=$row[ordernum]?>)<?=$last_txt?></p>";
$("#date_<?=$row[e_date]?>",parent.document).append(date_text);

var tmp_cnt = $("#date_<?=$row[e_date]?>_cnt",parent.document).text();
tmp_cnt = parseInt(tmp_cnt) + 1;
$("#date_<?=$row[e_date]?>_cnt",parent.document).text(tmp_cnt);

if(tmp_cnt>4){
	$("#more_<?=$row[e_date]?>",parent.document).css("display","block");
}

</script>

<?}?>


