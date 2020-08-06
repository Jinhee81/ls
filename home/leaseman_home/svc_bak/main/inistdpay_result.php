<?php

header('Content-Type: text/html; charset=UTF-8');

session_start();

//print_r($_SESSION);
if (empty($_POST)) alertAndLocation("잘못된 접근 경로입니다.", "payment.php");

include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

function alertAndLocation($msg, $url){
    echo "
    <script>
        alert('{$msg}');
        location.href = '{$url}';
    </script>";
}

$signKey = array(
    'pay' =>  "SU5JTElURV9UUklQTEVERVNfS0VZU1RS",
    'bill' => "SU5JTElURV9UUklQTEVERVNfS0VZU1RS"
);


        require_once($_SERVER['DOCUMENT_ROOT'].'/svc/main/INIStdPayUtil.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/svc/main/stdpay3/libs/HttpClient.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/svc/main/sha256.inc.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/svc/main/stdpay3/libs/json_lib.php');

        $util = new INIStdPayUtil();
        // $KEY = 'xAEuCjrjqHsEAYNB'; 실결제
        $KEY = 'rKnPljRn5m6J9Mzz';
        try {

            //#############################
            // 인증결과 파라미터 일괄 수신
            //#############################

            //#####################
            // 인증이 성공일 경우만
            //#####################
            if (strcmp("0000", $_REQUEST["resultCode"]) == 0) {

                // 인증성공

                parse_str($_REQUEST['merchantData'], $post);

                //############################################
                // 1.전문 필드 값 설정(***가맹점 개발수정***)
                //############################################

                $mid 				= $_REQUEST["mid"];     						// 가맹점 ID 수신 받은 데이터로 설정

                $signKey 			= isset($post['paydiv']) && $post['paydiv'] == 'monthly' ? $signKey['bill'] : $signKey['pay']; 			// 가맹점에 제공된 키(이니라이트키) (가맹점 수정후 고정) !!!절대!! 전문 데이터로 설정금지

                $timestamp 			= $util->getTimestamp();   						// util에 의해서 자동생성

                $charset 			= "UTF-8";        								// 리턴형식[UTF-8,EUC-KR](가맹점 수정후 고정)

                $format 			= "JSON";        								// 리턴형식[XML,JSON,NVP](가맹점 수정후 고정)

                $authToken 			= $_REQUEST["authToken"];   					// 취소 요청 tid에 따라서 유동적(가맹점 수정후 고정)

                $authUrl 			= $_REQUEST["authUrl"];    						// 승인요청 API url(수신 받은 값으로 설정, 임의 세팅 금지)

                $netCancel 			= $_REQUEST["netCancelUrl"];   					// 망취소 API url(수신 받은f값으로 설정, 임의 세팅 금지)

                $mKey 				= hash("sha256", $signKey);						// 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)

                $merchantData       = $_REQUEST["merchantData"][$signKey];



                //#####################
                // 2.signature 생성
                //#####################
                $signParam["authToken"] = $authToken;  		// 필수
                $signParam["timestamp"] = $timestamp;  		// 필수
                // signature 데이터 생성 (모듈에서 자동으로 signParam을 알파벳 순으로 정렬후 NVP 방식으로 나열해 hash)
                $signature = $util->makeSignature($signParam);


                //#####################
                // 3.API 요청 전문 생성
                //#####################
                $authMap["mid"] 		= $mid;   			// 필수
                $authMap["authToken"] 	= $authToken; 		// 필수
                $authMap["signature"] 	= $signature; 		// 필수
                $authMap["timestamp"] 	= $timestamp; 		// 필수
                $authMap["charset"] 	= $charset;  		// default=UTF-8
                $authMap["format"] 		= $format;  		// default=XML

                try {

                    $httpUtil = new HttpClient();

                    //#####################
                    // 4.API 통신 시작
                    //#####################

                    $authResultString = "";
                    if ($httpUtil->processHTTP($authUrl, $authMap)) {
                        $authResultString = $httpUtil->body;
                        // echo "<p><b>RESULT DATA :</b> $authResultString</p>";			//PRINT DATA
                    } else {
                        // echo "Http Connect Error\n";
                        // echo $httpUtil->errormsg;

                        throw new Exception("Http Connect Error");
                    }

                    //############################################################
                    //5.API 통신결과 처리(***가맹점 개발수정***)
                    //############################################################
                    $resultMap = json_decode($authResultString, true);

                    /*************************  결제보안 추가 2016-05-18 START ****************************/
                    $secureMap["mid"]		= $mid;							//mid
                    $secureMap["tstamp"]	= $timestamp;					//timestemp
                    $secureMap["MOID"]		= $resultMap["MOID"];			//MOID
                    $secureMap["TotPrice"]	= $resultMap["TotPrice"];		//TotPrice

                    // signature 데이터 생성
                    $secureSignature = $util->makeSignatureAuth($secureMap);
                    /*************************  결제보안 추가 2016-05-18 END ****************************/

                    // ordered 추가
                    $fil['session_id'] = mysqli_real_escape_string($conn, $post['user_id']);

                    $sql = "select count(*) from grade where user_id={$fil['session_id']}";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);

                    $ordered = (int)$row[0] + 1;

					if ((strcmp("0000", $resultMap["resultCode"]) == 0) && (strcmp($secureSignature, $resultMap["authSignature"]) == 0) ){	//결제보안 추가 2016-05-18
					   /*****************************************************************************
				       * 여기에 가맹점 내부 DB에 결제 결과를 반영하는 관련 프로그램 코드를 구현한다.

						 [중요!] 승인내용에 이상이 없음을 확인한 뒤 가맹점 DB에 해당건이 정상처리 되었음을 반영함
								  처리중 에러 발생시 망취소를 한다.
				       ******************************************************************************/

                        // if (isset($resultMap["payMethod"]) && strcmp("Bill", $resultMap["payMethod"]) == 0) { //빌링결제
                        //     //  echo "<tr><th class='line' colspan='2'><p></p></th></tr>
		                //     // <tr><th class='td01'><p>빌링키</p></th>
		                //     // <td class='td02'><p>" . @(in_array($resultMap["CARD_BillKey"] , $resultMap) ? $resultMap["CARD_BillKey"] : "null" ) . "</p></td></tr>";
                        // }
                        // else if (isset($resultMap["payMethod"]) && strcmp("Auth", $resultMap["payMethod"]) == 0){//빌링결제
                        //
                        //     if (isset($resultMap["payMethodDetail"]) && strcmp("BILL_CARD", $resultMap["payMethodDetail"]) == 0) {
                        //         // echo "<td class='td02'><p>" . @(in_array($resultMap["CARD_BillKey"] , $resultMap) ? $resultMap["CARD_BillKey"] : "null" ) . "</p></td></tr>";
                        //     }
                        //
                        //
                        // }
                        // else { //카드
                        // }

                        // 결제 히스토리 필요 : $resultMap["tid"]

                        if (isset($post['paydiv'])) {

                            // 결제시
                            // if ($post['paydiv'] == 'monthonly') {
                            $gradename = isset($post['paydiv']) && $post['paydiv'] == 'monthly' ? "{$post['gradename']}(s)" : $post['gradename'];

                            $gradeSql = "insert into grade
                                        (gradename, executivedate, startdate, enddate,
                                            formonth, payamount, ordered, user_id)
                                        VALUES
                                        ('{$gradename}',
                                            '{$post['today']}',
                                            '{$post['today']}',
                                            '{$post['month1later']}',
                                            1,
                                            {$post['amount']},
                                            {$ordered},
                                            {$fil['session_id']}
                                        )
                                        ";

                            $gradeResult = mysqli_query($conn, $gradeSql);

                            if(!$gradeResult){
                                alertAndLocation('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(3) ', 'payment.php');
                                error_log(mysqli_error($conn));
                                exit;
                            }
                            else {
                                $userSql = "update user
                                        set
                                            gradename='{$gradename}'
                                        where id = {$fil['session_id']}";
                                $userResult = mysqli_query($conn, $userSql);

                                if(!$userResult){
                                    alertAndLocation('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(4)', 'payment.php');
                                    error_log(mysqli_error($conn));
                                    exit;
                                }
                            }

                            if ($post['paydiv'] == 'monthly') {  // 정기결제

                                if(isset($resultMap["CARD_BillKey"])) {

                                    $authUrl = 'https://iniapi.inicis.com/api/v1/billing';

                                    $authMapBill["type"] 		= 'Billing';
                                    $authMapBill["paymethod"] 	= 'Card';
                                    $authMapBill["timestamp"] 	= date('YmdHis');
                                    $authMapBill["clientIp"] 	= $_SERVER["REMOTE_ADDR"];
                                    $authMapBill["mid"] 	    = $resultMap["mid"];
                                    $authMapBill["url"] 	    = $_SERVER["HTTP_HOST"];
                                    $authMapBill["moid"]        = $resultMap["MOID"];
                                    $authMapBill["price"]       = $resultMap["TotPrice"];
                                    $authMapBill["billKey"]     = $resultMap["CARD_BillKey"];
                                    $authMapBill["goodName"] 	= $resultMap["goodName"];
                                    $authMapBill["buyerName"] 	= $resultMap["buyerName"];
                                    $authMapBill["buyerEmail"] 	= $resultMap["buyerEmail"];
                                    $authMapBill["buyerTel"] 	= $resultMap["buyerTel"];
                                    $authMapBill["authentification"] 	= '00';


                                    $hashArr = array('type', 'paymethod', 'timestamp','clientIp','mid','moid','price','billKey');
                                    $hashData = $KEY;
                                    foreach($hashArr as $h){
                                        $hashData .= "{$authMapBill[$h]}";
                                    }

                                    $authMapBill["hashData"] 	= hash("sha512", $hashData);

                                    try {

                                        $httpUtil = new HttpClient();

                                        //#####################
                                        // 4.API 통신 시작
                                        //#####################

                                        $authResultString = "";
                                        if ($httpUtil->processHTTP($authUrl, $authMapBill)) {
                                            $authResultString = $httpUtil->body;
                                            // echo "<p><b>RESULT DATA :</b> $authResultString</p>";			//PRINT DATA

                                            // user bill key 값 세팅
                                            $userSql = "update user
                                                        set
                                                            bill_key='{$resultMap['CARD_BillKey']}'
                                                        where id = {$fil['session_id']}";
                                            $userResult = mysqli_query($conn, $userSql);

                                            if(!$userResult){
                                                alertAndLocation('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(4)', 'payment.php');
                                                error_log(mysqli_error($conn));
                                                exit;
                                            }

                                            $nextstartdate = date('Y-m-d', strtotime($_POST['month1later'].'+1 days'));
                                            $nextenddate = date('Y-m-d', strtotime($nextstartdate.'+1 month -1 days'));

                                            // 구독 페이지 저장
                                            $sql7 = "insert into subscription
                                                    (expecteddate, startdate, enddate, gradename, payamount, user_id, billing_key, billing_status)
                                                    VALUES
                                                    ('{$post['month1later']}',
                                                    '{$nextstartdate}',
                                                    '{$nextenddate}',
                                                    '{$post['gradename']}(s)',
                                                    '{$post['amount']}',
                                                    {$fil['session_id']},
                                                    '{$resultMap['CARD_BillKey']}',
                                                    'YES'
                                                    )";

                                            $result7 = mysqli_query($conn, $sql7);

                                            if(!$result7){
                                                 "<script>alert('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(7)');
                                                   location.href = 'http://www.leaseman.co.kr/svc/main/payment.php';
                                                   </script>";
                                                alertAndLocation('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(7)', 'payment.php');
                                                error_log(mysqli_error($conn));
                                                exit;
                                            }
                                        } else {
                                            // echo "Http Connect Error\n";
                                            // echo $httpUtil->errormsg;

                                            throw new Exception("Http Connect Error");
                                        }


                                    } catch (Exception $e) {
                                        //    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                                        //####################################
                                        // 실패시 처리(***가맹점 개발수정***)
                                        //####################################
                                        //---- db 저장 실패시 등 예외처리----//
                                        $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                                        // echo $s;

                                        //#####################
                                        // 망취소 API
                                        //#####################

                                        $netcancelResultString = ""; // 망취소 요청 API url(고정, 임의 세팅 금지)
                                        if ($httpUtil->processHTTP($netCancel, $authMapBill)) {
                                            $netcancelResultString = $httpUtil->body;
                                        } else {
                                            // echo "Http Connect Error\n";
                                            // echo $httpUtil->errormsg;

                                            throw new Exception("Http Connect Error");
                                        }

                                        //  echo "<br/>## 망취소 API 결과 ##<br/>";

                                        /*##XML output##*/

                                         // 취소 결과 확인
                                        //  echo "<p>". $netcancelResultString . "</p>";
                                    }
                                }
                            }

                            alertAndLocation('결제 완료하였습니다.', 'main.php');
                            exit;
                        }
                    }
                    else {
                        // 거래 실패

						// echo "<tr><th class='line' colspan='2'><p></p></th></tr>
	                    //     <tr><th class='td01'><p>결과 코드</p></th>
	                    //     <td class='td02'><p>" . @(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" ) . "</p></td></tr>";

						//결제보안키가 다른 경우.
						if (strcmp($secureSignature, $resultMap["authSignature"]) != 0) {
							// echo "<tr><th class='line' colspan='2'><p></p></th></tr>
							// 	<tr><th class='td01'><p>결과 내용</p></th>
							// 	<td class='td02'><p>" . "* 데이터 위변조 체크 실패" . "</p></td></tr>";

							//망취소
							if(strcmp("0000", $resultMap["resultCode"]) == 0) {
								throw new Exception("데이터 위변조 체크 실패");
							}
						} else {
							// echo "<tr><th class='line' colspan='2'><p></p></th></tr>
							// 	<tr><th class='td01'><p>결과 내용</p></th>
							// 	<td class='td02'><p>" . @(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" ) . "</p></td></tr>";
						}

                    }





                    // 수신결과를 파싱후 resultCode가 "0000"이면 승인성공 이외 실패
                    // 가맹점에서 스스로 파싱후 내부 DB 처리 후 화면에 결과 표시
                    // payViewType을 popup으로 해서 결제를 하셨을 경우
                    // 내부처리후 스크립트를 이용해 opener의 화면 전환처리를 하세요
                    //throw new Exception("강제 Exception");
                } catch (Exception $e) {
                    //    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                    //####################################
                    // 실패시 처리(***가맹점 개발수정***)
                    //####################################
                    //---- db 저장 실패시 등 예외처리----//
                    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                    // echo $s;

                    //#####################
                    // 망취소 API
                    //#####################

                    $netcancelResultString = ""; // 망취소 요청 API url(고정, 임의 세팅 금지)
                    if ($httpUtil->processHTTP($netCancel, $authMap)) {
                        $netcancelResultString = $httpUtil->body;
                    } else {
                        // echo "Http Connect Error\n";
                        // echo $httpUtil->errormsg;

                        throw new Exception("Http Connect Error");
                    }

                    // echo "<br/>## 망취소 API 결과 ##<br/>";

                    /*##XML output##*/
                    //$netcancelResultString = str_replace("<", "&lt;", $$netcancelResultString);
                    //$netcancelResultString = str_replace(">", "&gt;", $$netcancelResultString);

                    // 취소 결과 확인
                    // echo "<p>". $netcancelResultString . "</p>";
                }
            } else {

                //#############
                // 인증 실패시
                //#############
                // echo "<br/>";
                // echo "####인증실패####";

            }
        } catch (Exception $e) {
            $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
            // echo $s;
        }
?>
