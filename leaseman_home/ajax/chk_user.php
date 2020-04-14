<?php
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";


function Unescape($str) // UnescapeFunc는 아래에 정의되어 있음
{
  return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'UnescapeFunc', $str));
}
 
function UnescapeFunc($str)
{
  return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($str[1], 2, 2))).chr(hexdec(substr($str[1],0,2))));
}


$user_name = Unescape($_GET[user_name]);
$mobile = $_GET['mobile'];



$sql_m = "select count(*) as cnts from tbl_user where user_name = '".$user_name."' and mobile = '".$mobile."' and c_idx = '".$_SESSION[customer][idx]."' ";
$result_m = mysql_query($sql_m);
$row_m = mysql_fetch_array($result_m);

echo $row_m[cnts];
//echo $sql_m;
?>