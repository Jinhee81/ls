<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/svc/main/INIStdPayUtil.php');
$SignatureUtil = new INIStdPayUtil();

$timestamp = $_GET['timestamp'];
$orderNumber = $_GET['orderNumber'];
$price = $_GET['price'];


$params = array(
    "oid" => $orderNumber,
    "price" => $price,
    "timestamp" => $timestamp
);

$sign = $SignatureUtil->makeSignature($params);

echo $sign;
?>