<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";

$sms_cnt = $_GET['sms_cnt'];
$mms_cnt = $_GET['mms_cnt'];

$out_put = sms_able($sms_cnt, $mms_cnt,$_danga_price);
//$out_put = "A";

echo $out_put;
?>