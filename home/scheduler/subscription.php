<?php
header('Content-Type: text/html; charset=UTF-8');
$conn = mysqli_connect("localhost", "leaseman", "leaseman!!22", "leaseman_svc");
date_default_timezone_set('Asia/Seoul');

require_once('/home/leaseman_home/svc/main/INIStdPayUtil.php');
require_once('/home/leaseman_home/svc/main/sha256.inc.php');
require_once('/home/leaseman_sv/stdpay/libs/HttpClient.php');
require_once('/home/leaseman_sv/phpexcel/Classes/PHPExcel/Exception.php');

$SignatureUtil   = new INIStdPayUtil();
$timestamp       = $SignatureUtil->getTimestamp();
// TEST
// $KEY = 'rKnPljRn5m6J9Mzz';

$KEY = 'xAEuCjrjqHsEAYNB';
$today = date("Y-m-d");
$subscriptionSql = "SELECT * FROM subscription AS sub LEFT JOIN user AS u ON sub.user_id = u.id WHERE sub.expecteddate= '" . $today . "'AND sub.billing_status='NO'";

$subscriptionResult = mysqli_query($conn,$subscriptionSql);
// 정기결제 crontab
while($row = mysqli_fetch_array($subscriptionResult)){

    $authUrl = 'https://iniapi.inicis.com/api/v1/billing';
    $authMapBill["type"] 		        = 'Billing';
    $authMapBill["paymethod"] 	        = 'Card';
    $authMapBill["timestamp"] 	        =  date('YmdHis');
    $authMapBill["clientIp"] 	        = '183.96.96.18';                    // 요청 서버IP
    $authMapBill["mid"] 	            = 'leasemanc2';                      // 가맹점 ID
    $authMapBill["url"] 	            = 'www.leaseman.co.kr';              // 가맹점 URL
    $authMapBill["moid"]                = 'leaseman_' . $timestamp;          // 가맹점 주문번호
    $authMapBill["price"]               = $row["payamount"];                 // 결제금액
    $authMapBill["billKey"]             = $row["bill_key"];                  // 승인요청할 빌링키 값
    $authMapBill["goodName"] 	        = $row["gradename"];                 // 상품명
    $authMapBill["buyerName"] 	        = $row["user_name"];                 // 구매자명
    $authMapBill["buyerEmail"] 	        = $row["email"];                     // 구매자 이메일
    $authMapBill["buyerTel"] 	        = $row["cellphone"];                 // 구매자 연락처
    $authMapBill["authentification"] 	= '00';                              // 본인인증 여부 00고정

    $hashArr = array('type', 'paymethod', 'timestamp','clientIp','mid','moid','price','billKey');
    $hashData = $KEY;

    foreach($hashArr as $h){
        $hashData .= "{$authMapBill[$h]}";
    }

    $authMapBill["hashData"] 	= hash("sha512", $hashData);

    $httpUtil = new HttpClient();

    //#####################
    // 4.API 통신 시작
    //#####################

    if ($httpUtil->processHTTP($authUrl, $authMapBill)) {
    // echo "<p><b>RESULT DATA :</b> $authResultString</p>";			//PRINT DATA
        $nextstartdate = date('Y-m-d', strtotime($today.'+1 days'));
        $nextenddate = date('Y-m-d', strtotime($nextstartdate.'+1 month -1 days'));

        $updateSubscription = "UPDATE subscription SET billing_status ='YES ' WHERE user_id = {$row['user_id']}";

        $insertSubscription = "INSERT INTO subscription
                                (expecteddate, startdate, enddate, gradename, payamount, user_id, billing_status)
                            VALUES
                                ('{$nextenddate}',
                                '{$nextstartdate}',
                                '{$nextenddate}',
                                '{$row['gradename']}',
                                '{$row['payamount']}',
                                 {$row['user_id']},
                                'NO'
                            )";
        mysqli_query($conn, $insertSubscription);

        $updateSubscription = mysqli_query($conn, $updateSubscription);

    }
}

?>
