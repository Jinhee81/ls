<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/main/INIStdPayUtil.php';
$SignatureUtil = new INIStdPayUtil();

//############################################
// 1.전문 필드 값 설정(***가맹점 개발수정***)
//############################################
// 여기에 설정된 값은 Form 필드에 동일한 값으로 설정
$mid = "leaseman12";                            // 이니시스 에서 발급받은 mid 값   
$signKey = "RkMwWkwyMjVxR2NVT1Y4RlpJRVJIZz09";  // 상점정보->부가정보->웹결제signkey 생성조회

$timestamp = $SignatureUtil->getTimestamp();    // util에 의해서 자동생성

//###################################
// 2. 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)
//###################################
$mKey = $SignatureUtil->makeHash($signKey, "sha256");

$params = array(
    "oid" => $P_OID,         // 가맹점 주문번호(가맹점에서 직접 설정)
    "price" => $nTotalPrice,     // 상품가격(특수기호 제외, 가맹점에서 직접 설정)
    "timestamp" => $timestamp
);
$sign = $SignatureUtil->makeSignature($params, "sha256");

?>
<form id="SendPayForm_id" name="" method="POST">
<input type="hidden" name="version" value="1.0" />                  <!-- 기본값 -->
<input type="hidden" name="mid" value="<?=$mid?>" />                <!-- 이니시스 에서 발급받은 mid 값 -->
<input type="hidden" name="goodname" value="<?=$strGoodsName?>" />  <!-- 상품이름 -->
<input type="hidden" name="oid" value="<?=$P_OID?>" />              <!-- 주문번호 -->
<input type="hidden" name="price" value="<?=$nTotalPrice?>" />      <!-- 상품결제요청 가격 -->
<input type="hidden" name="currency" value="WON" />                 <!-- 결제 단위 -->
<input type="hidden" name="buyername" value="<?=$strArrUser[0]['user_nm']?>" />    <!-- 결제요청 user 이름 -->
<input type="hidden" name="buyertel" value="<?=$strArrUser[0]['user_id']?>" />     <!-- 결제요청 user 전화번호 -->
<input type="hidden" name="timestamp" value="<?=$timestamp?>" />                   <!-- 위에서 생성한 timestamp 값 -->
<input type="hidden" name="signature" value="<?=$sign?>" >                         <!-- 위에서 생성한 sign 값 -->
<input type="hidden" name="returnUrl" value="https://<?=$config['domain']?>/inicis_step1.php" /> <!-- 결제요청 처리 url -->
<input type="hidden" name="mKey" value="<?=$mKey?>" />                             <!-- 위에서 생성한 mKey 값 -->
<input type="hidden" name="gopaymethod" value="" />                  <!-- 하나의 결제 수단만을 제공할 경우 -->     
<input type="hidden" name="merchantData" value="<?=$P_NOTI?>" />     <!-- 인증 성공시 가맹점으로 리턴변수(개발자 개인변수) -->
<input type="hidden" name="acceptmethod" value="HPP(1):CARDPOINT:va_receipt:below1000" />   <!-- 결제수단별 추가 옵션값 -->
<input type="hidden" name="buyeremail" value="<?=$strArrUser[0]['email']?>" />                <!-- user 메일 -->
</form>
 

<script language="javascript" type="text/javascript" src="https://stgstdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script>

<!--// 실결제 스크립트 //-->
<script type="text/javascript">
jQuery(document).ready( function() {
            // 결제버튼 클릭시
            jQuery('.btn-join').click( function() {
                  INIStdPay.pay('SendPayForm_id');
            } );
} );
</script>
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/main/INIStdPayUtil.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/main/stdpay3/libs/HttpClient.php';
 
$util = new INIStdPayUtil();
 
try {
    //#############################
    // 인증결과 파라미터 일괄 수신
    //#############################
    //echo "<pre>" . var_dump($_REQUEST) . "</pre>";
 
    // 인증 실패시
    if (strcmp("0000", $_REQUEST["resultCode"]) != 0) {
        echo "
";
        throw new Exception("####인증실패####");
    }
 
    //############################################
    // 1.전문 필드 값 설정(***가맹점 개발수정***)
    //############################################;
    $mid        = $_REQUEST["mid"];         // 가맹점 ID 수신 받은 데이터로 설정
    $signKey    = "상점관리자에서 생성";        // 상점정보->부가정보->웹결제signkey 생성조회
    $timestamp  = $util->getTimestamp();     // util에 의해서 자동생성
    $charset    = "UTF-8";              // 리턴형식[UTF-8,EUC-KR](가맹점 수정후 고정)
    $format     = "JSON";               // 리턴형식[XML,JSON,NVP](가맹점 수정후 고정)
    $orderNumber    = $_REQUEST["orderNumber"]; // orderNumber 
    $oP_NOTI    = $_REQUEST['merchantData'];    // 인증 성공시 가맹점으로 리턴변수(개발자 개인변수)
    $authToken  = $_REQUEST["authToken"];       // 취소 요청 tid에 따라서 유동적(가맹점 수정후 고정)
    $authUrl    = $_REQUEST["authUrl"];     // 승인요청 API url(수신 받은 값으로 설정, 임의 세팅 금지)
    $netCancel  = $_REQUEST["netCancelUrl"];    // 망취소 API url(수신 받은f값으로 설정, 임의 세팅 금지)
    $mKey       = hash("sha256", $signKey); // 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)
 
    //#####################
    // 2.signature 생성
    //#####################
    $signParam["authToken"]     = $authToken;   // 필수
    $signParam["timestamp"]     = $timestamp;   // 필수
    // signature 데이터 생성 (모듈에서 자동으로 signParam을 알파벳 순으로 정렬후 NVP 방식으로 나열해 hash)
    $signature = $util->makeSignature($signParam);
 
    //#####################
    // 3.API 요청 전문 생성
    //#####################
    $authMap["mid"]     = $mid;     // 필수
    $authMap["authToken"]   = $authToken;   // 필수
    $authMap["signature"]   = $signature;   // 필수
    $authMap["timestamp"]   = $timestamp;   // 필수
    $authMap["charset"]     = $charset;     // default=UTF-8
    $authMap["format"]  = $format;      // default=XML
 
    $oDBConnect->beginTransaction();
    try {
        //#####################
        // 4.API 통신 시작
        //#####################
        $httpUtil = new HttpClient();
        $authResultString = "";
 
        if ($httpUtil->processHTTP($authUrl, $authMap)) {
            $authResultString = $httpUtil->body;
        } else {
            echo "Http Connect Error\n";
            echo $httpUtil->errormsg;
            throw new Exception("Http Connect Error");
        }
 
        //############################################################
        //5.API 통신결과 처리(***가맹점 개발수정***)
        //############################################################
        $resultMap = json_decode($authResultString, true);
 
 
        //print_r($resultMap);
        $secureMap["mid"]   = $mid;             //이니시스 에서 발급받은 mid 값
        $secureMap["tstamp"]    = $timestamp;           //timestemp
        $secureMap["MOID"]  = $resultMap["MOID"];       //주문번호
        $secureMap["TotPrice"]  = $resultMap["TotPrice"];   //상점에서 결제요청된 가격
 
        // signature 데이터 생성 
        $secureSignature = $util->makeSignatureAuth($secureMap);
 
        if ((strcmp("0000", $resultMap["resultCode"]) == 0) && (strcmp($secureSignature, $resultMap["authSignature"]) == 0) ){
            /*****************************************************************************
            * 승인내용에 이상이 없음을 확인한 뒤 DB에 정상처리 되었음을 반영. 
            * 처리중 에러 발생시 망취소를 한다.   
            ******************************************************************************/
            // 기승인 TID 여부 확인
            $strArrPG   = sql_fetch('SELECT * FROM pg_result WHERE user_id = ? AND tid = ?', array($oP_NOTI->user_id, $resultMap["tid"]), 0);
            if( count($strArrPG) >= 1 ) {
                // 망취소
                throw new Exception("이미 주문접수가 되어있습니다! 다시시도해주세요!(10)");  
            }
 
            // 승인된 주문기초내역을 DB 에 저장
            $strPGSql   = "INSERT INTO pg_result ($strFileds, cret_id, cret_ip, cret_dtm) ";
            $strPGSql  .= "VALUES ($strValues, ?, ?, ?)";
            $oResult    = sql_query($strPGSql, array( $oP_NOTI->user_id, $config['ip'], $config['date3'] ));
            if( $oResult->errorInfo()[0] != 0000 ) {
                // 망취소
                throw new Exception('주문이 실패하였습니다! 관리자에게 문의해주세요!(1)');
            }
 
        } else {
            echo "<pre>";
            echo "<table width='565' border='0' cellspacing='0' cellpadding='0'>";
            echo "<tr><th class='td01'><p>거래 성공 여부</p></th>";
            echo "<td class='td02'><p>실패</p></td></tr>";
            echo "<tr><th class='line' colspan='2'><p></p></th></tr>
            <tr><th class='td01'><p>결과 코드</p></th>
            <td class='td02'><p>" . @(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" ) . "</p></td></tr>";
            echo "</table>
            <span style='padding-left : 100px;'></span> 
            </pre>";
            return;
 
            //결제보안키가 다른 경우.
            if (strcmp($secureSignature, $resultMap["authSignature"]) != 0) {
                if(strcmp("0000", $resultMap["resultCode"]) == 0) {
                    // 망취소
                    throw new Exception("데이터 위변조 체크 실패");
                }
            } else {
                echo "<pre>";
                echo "<table width='565' border='0' cellspacing='0' cellpadding='0'>";
                echo "<tr><th class='line' colspan='2'><p></p></th></tr>
                <tr><th class='td01'><p>결과 내용</p></th>
                <td class='td02'><p>" . @(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" ) . "</p></td></tr>";
                echo "</table>
                <span style='padding-left : 100px;'></span> 
                </pre>";
                return;
            }
 
        }
 
        if (isset($resultMap["payMethod"]) && strcmp("VBank", $resultMap["payMethod"]) == 0) { //가상계좌
 
            //*******************************************
            //  vacct_result 저장 & pg기승인 START
            //*******************************************
 
            // 기승인 TID 여부 확인
            $strArrPG   = sql_fetch('SELECT * FROM vacct_result WHERE user_id = ? AND tid = ?', array($oP_NOTI->user_id, $resultMap["tid"]), 0);
            if( count($strArrPG) >= 1 ) {
                // 망취소
                throw new Exception("이미 주문접수가 되어있습니다! 다시시도해주세요!(10)");  
            }
            // 승인된 가상계좌내역을 DB 에 저장
            $strPGSql   = "INSERT INTO vacct_result ($strFileds, cret_id, cret_ip, cret_dtm) ";
            $strPGSql  .= "VALUES ($strValues, ?, ?, ?)";
            $oResult    = sql_query($strPGSql, array( $oP_NOTI->user_id, $config['ip'], $config['date3'] ));
            if( $oResult->errorInfo()[0] != 0000 ) {
                // 망취소
                throw new Exception('주문이 실패하였습니다! 관리자에게 문의해주세요!(2)');
            }
 
            //*******************************************
            //  vacct_result 저장 & pg기승인 END
            //*******************************************
 
        } else if (isset($resultMap["payMethod"]) && strcmp("DirectBank", $resultMap["payMethod"]) == 0) { //실시간계좌이체
 
        } else if (isset($resultMap["payMethod"]) && strcmp("HPP", $resultMap["payMethod"]) == 0) { //휴대폰
 
            //*******************************************
            //  hp_result 저장 & pg기승인 START
            //*******************************************
 
            // 기승인 TID 여부 확인
            $strArrPG   = sql_fetch('SELECT * FROM hp_result WHERE user_id = ? AND tid = ?', array($oP_NOTI->user_id, $resultMap["tid"]), 0);
            if( count($strArrPG) >= 1 ) {
                // 망취소
                throw new Exception("이미 주문접수가 되어있습니다! 다시시도해주세요!(10)");  
            }
            // 승인된 휴대폰내역을 DB 에 저장
            $strPGSql   = "INSERT INTO hp_result ($strFileds, cret_id, cret_ip, cret_dtm) ";
            $strPGSql  .= "VALUES ($strValues, ?, ?, ?)";
            $oResult    = sql_query($strPGSql, array( $oP_NOTI->user_id, $config['ip'], $config['date3'] ));
            if( $oResult->errorInfo()[0] != 0000 ) {
                // 망취소
                throw new Exception('주문이 실패하였습니다! 관리자에게 문의해주세요!(2)');
            }
 
            //*******************************************
            //  hp_result 저장 & pg기승인 END
            //*******************************************
 
        } else if (isset($resultMap["payMethod"]) && strcmp("KWPY", $resultMap["payMethod"]) == 0) { //뱅크월렛 카카오
 
        } else if (isset($resultMap["payMethod"]) && strcmp("Culture", $resultMap["payMethod"]) == 0) { //문화상품권
 
        } else if (isset($resultMap["payMethod"]) && strcmp("DGCL", $resultMap["payMethod"]) == 0) { //게임문화상품권
 
        } else if (isset($resultMap["payMethod"]) && strcmp("OCBPoint", $resultMap["payMethod"]) == 0) { //오케이 캐쉬백
 
        } else if (isset($resultMap["payMethod"]) && (strcmp("GSPT", $resultMap["payMethod"]) == 0)) { //GSPoint
 
        } else if (isset($resultMap["payMethod"]) && strcmp("UPNT", $resultMap["payMethod"]) == 0) {  //U-포인트
 
        } else if (isset($resultMap["payMethod"]) && strcmp("KWPY", $resultMap["payMethod"]) == 0) {  //뱅크월렛 카카오
 
        } else if (isset($resultMap["payMethod"]) && strcmp("YPAY", $resultMap["payMethod"]) == 0) { //엘로우 페이
 
        } else if (isset($resultMap["payMethod"]) && strcmp("TEEN", $resultMap["payMethod"]) == 0) { //틴캐시
 
        } else if (isset($resultMap["payMethod"]) && strcmp("Bookcash", $resultMap["payMethod"]) == 0) { //도서문화상품권
 
        } else if (isset($resultMap["payMethod"]) && strcmp("PhoneBill", $resultMap["payMethod"]) == 0) { //폰빌전화결제
 
        } else if (isset($resultMap["payMethod"]) && strcmp("Bill", $resultMap["payMethod"]) == 0) { //빌링결제
 
        } else { //카드
            //*******************************************
            //  card_result 저장 & pg기승인 START
            //*******************************************
 
            // 기승인 TID 여부 확인
            $strArrPG   = sql_fetch('SELECT * FROM card_result WHERE user_id = ? AND tid = ?', array($oP_NOTI->user_id, $resultMap["tid"]), 0);
            if( count($strArrPG) >= 1 ) {
                // 망취소
                throw new Exception("이미 주문접수가 되어있습니다! 다시시도해주세요!(10)");  
            }
            // 승인된 카드내역을 DB 에 저장
            $strPGSql   = "INSERT INTO card_result ($strFileds, cret_id, cret_ip, cret_dtm) ";
            $strPGSql  .= "VALUES ($strValues, ?, ?, ?)";
            $oResult    = sql_query($strPGSql, array( $oP_NOTI->user_id, $config['ip'], $config['date3'] ));
            if( $oResult->errorInfo()[0] != 0000 ) {
                // 망취소
                throw new Exception('주문이 실패하였습니다! 관리자에게 문의해주세요!(2)');
            }
 
            //*******************************************
            //  card_result 저장 & pg기승인 END
            //*******************************************
 
        }
 
        /*
        echo "<pre>";
        echo "<table width='565' border='0' cellspacing='0' cellpadding='0'>";
        //공통 부분만
        echo
        "<tr><th class='line' colspan='2'><p></p></th></tr>
        <tr><th class='td01'><p>거래 번호</p></th>
        <td class='td02'><p>" . @(in_array($resultMap["tid"] , $resultMap) ? $resultMap["tid"] : "null" ) . "</p></td></tr>
        <tr><th class='line' colspan='2'><p></p></th></tr>
        <tr><th class='td01'><p>결제방법(지불수단)</p></th>
        <td class='td02'><p>" . @(in_array($resultMap["payMethod"] , $resultMap) ? $resultMap["payMethod"] : "null" ) . "</p></td></tr>
        <tr><th class='line' colspan='2'><p></p></th></tr>
        <tr><th class='td01'><p>결과 코드</p></th>
        <td class='td02'><p>" . @(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" ) . "</p></td></tr>
        <tr><th class='line' colspan='2'><p></p></th></tr>
        <tr><th class='td01'><p>결과 내용</p></th>
        <td class='td02'><p>" . @(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" ) . "</p></td></tr>
        <tr><th class='line' colspan='2'><p></p></th></tr>
        <tr><th class='td01'><p>결제완료금액</p></th>
        <td class='td02'><p>" . @(in_array($resultMap["TotPrice"] , $resultMap) ? $resultMap["TotPrice"] : "null" ) . "원</p></td></tr>
        <tr><th class='line' colspan='2'><p></p></th></tr>
        <tr><th class='td01'><p>주문 번호</p></th>
        <td class='td02'><p>" . @(in_array($resultMap["MOID"] , $resultMap) ? $resultMap["MOID"] : "null" )  . "</p></td></tr>
        <tr><th class='line' colspan='2'><p></p></th></tr>
        <tr><th class='td01'><p>승인날짜</p></th>
        <td class='td02'><p>" . @(in_array($resultMap["applDate"] , $resultMap) ? $resultMap["applDate"] : "null" ) . "</p></td></tr>
        <tr><th class='line' colspan='2'><p></p></th></tr>
        <tr><th class='td01'><p>승인시간</p></th>
        <td class='td02'><p>" . @(in_array($resultMap["applTime"] , $resultMap) ? $resultMap["applTime"] : "null" ) . "</p></td></tr>
        <tr><th class='line' colspan='2'><p></p></th></tr>";
        echo "</table>
        <span style='padding-left : 100px;'></span> 
        </pre>";
        */
 
 
        //*******************************************
        //  주문테이블에 주문서 집어넣기 START
        //*******************************************
 
 
        // order에 주문서 insert
        $strOrderSql     = "INSERT INTO order ($strFileds, cret_id, cret_ip, cret_dtm) ";
        $strOrderSql    .= "VALUES ($strValues, ?, ?, ?)";
        $oResult     = sql_query($strOrderSql, array( $oP_NOTI->user_id, $config['ip'], $config['date3'] ));
 
        if( $oResult->errorInfo()[0] != 0000 ) {
            throw new Exception('주문이 실패하였습니다! 관리자에게 문의해주세요!(3)');
        }
 
        //*******************************************
        //  주문테이블에 주문서 집어넣기 END
        //*******************************************
 
        // 수신결과를 파싱후 resultCode가 "0000"이면 승인성공 이외 실패
        // 가맹점에서 스스로 파싱후 내부 DB 처리 후 화면에 결과 표시
        //throw new Exception("강제 Exception");
        $oDBConnect->commit();
        //$oDBConnect->rollBack();
 
    } catch (Exception $e) {
        // 실패시 처리(***가맹점 개발수정***)
        $oDBConnect->rollBack();
 
        $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
        echo $s;
 
        // 망취소 API
        $netcancelResultString = ""; // 망취소 요청 API url(고정, 임의 세팅 금지)
 
        if ($httpUtil->processHTTP($netCancel, $authMap)) {
            $netcancelResultString = $httpUtil->body;
        } else {
            echo "Http Connect Error\n";
            echo $httpUtil->errormsg;
 
            throw new Exception("Http Connect Error");
        }
 
        echo "
## 망취소 API 결과 ##
";
        echo "<p>". $netcancelResultString . "</p>";
    }
 
} catch (Exception $e) {
    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
    echo $s;
}
 
 
// 가상계좌 일경우 가상계좌안내 페이지로 이동
if( $nPtype == 3 ) {
    require_once './order_finish.php';
// 신용카드 일경우 결제완료 페이지로 이동
} else if( $nPtype == 1 || $nPtype == 5 ) {
    require_once './pay_finish.php';
// 휴대폰 일경우 결제완료 페이지로 이동
} else if( $nPtype == 4 ) {
    require_once './pay_finish.php';
}
?>