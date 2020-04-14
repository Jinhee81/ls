<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/main/lib.inc.php";
header("Content-Type: text/html; charset=utf-8");

        require_once('/svc/main/INIStdPayUtil.php');
        require_once('/svc/main/stdpay3/libs/HttpClient.php');
        require_once('/svc/main/sha256.inc.php');
        require_once('/svc/main/stdpay3/libs/json_lib.php');

        $util = new INIStdPayUtil();
	
        try {

            //#############################
            // 인증결과 파라미터 일괄 수신
            //#############################

            //#####################
            // 인증이 성공일 경우만
            //#####################
            if (strcmp("0000", $_REQUEST["resultCode"]) == 0) {

                //echo "####인증성공/승인요청####";
				//echo "<br/>";
				
                //############################################
                // 1.전문 필드 값 설정(***가맹점 개발수정***)
                //############################################
				
                $mid 				= $_REQUEST["mid"];     						// 가맹점 ID 수신 받은 데이터로 설정

                $signKey 			= "RkMwWkwyMjVxR2NVT1Y4RlpJRVJIZz09"; 			// 가맹점에 제공된 키(이니라이트키) (가맹점 수정후 고정) !!!절대!! 전문 데이터로 설정금지

                $timestamp 			= $util->getTimestamp();   						// util에 의해서 자동생성

                $charset 			= "UTF-8";        								// 리턴형식[UTF-8,EUC-KR](가맹점 수정후 고정)

                $format 			= "JSON";        								// 리턴형식[XML,JSON,NVP](가맹점 수정후 고정)

                $authToken 			= $_REQUEST["authToken"];   					// 취소 요청 tid에 따라서 유동적(가맹점 수정후 고정)

                $authUrl 			= $_REQUEST["authUrl"];    						// 승인요청 API url(수신 받은 값으로 설정, 임의 세팅 금지)

                $netCancel 			= $_REQUEST["netCancelUrl"];   					// 망취소 API url(수신 받은f값으로 설정, 임의 세팅 금지)

				$mKey 				= hash("sha256", $signKey);						// 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)
				
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
                        //echo "<p><b>RESULT DATA :</b> $authResultString</p>";			//PRINT DATA
                    } else {
                        //echo "Http Connect Error\n";
                        //echo $httpUtil->errormsg;

                        throw new Exception("Http Connect Error");
                    }

                    //############################################################
                    //5.API 통신결과 처리(***가맹점 개발수정***)
                    //############################################################
                    //echo "## 승인 API 결과 ##";
                    
                    $resultMap = json_decode($authResultString, true);
					//echo "<pre>";
                    //echo "<table width='565' border='0' cellspacing='0' cellpadding='0'>";

                    /*************************  결제보안 추가 2016-05-18 START ****************************/ 
                    $secureMap["mid"]		= $mid;							//mid
                    $secureMap["tstamp"]	= $timestamp;					//timestemp
                    $secureMap["MOID"]		= $resultMap["MOID"];			//MOID
                    $secureMap["TotPrice"]	= $resultMap["TotPrice"];		//TotPrice
                    
                    // signature 데이터 생성 
                    $secureSignature = $util->makeSignatureAuth($secureMap);
                    /*************************  결제보안 추가 2016-05-18 END ****************************/

					if ((strcmp("0000", $resultMap["resultCode"]) == 0) && (strcmp($secureSignature, $resultMap["authSignature"]) == 0) ){	//결제보안 추가 2016-05-18
					   /*****************************************************************************
				       * 여기에 가맹점 내부 DB에 결제 결과를 반영하는 관련 프로그램 코드를 구현한다.  
					   
						 [중요!] 승인내용에 이상이 없음을 확인한 뒤 가맹점 DB에 해당건이 정상처리 되었음을 반영함
								  처리중 에러 발생시 망취소를 한다.
				       ******************************************************************************/

                        //echo "<tr><th class='td01'><p>거래 성공 여부</p></th>";
                        //echo "<p>성공</p></br>";
						//echo $resultMap["CARD_BillKey"] . "<br/>";



						$tmp_date = $resultMap["applDate"];
						$tmp_time = $resultMap["applTime"];
						$pay_datetime = substr($tmp_date,0,4) . "-" . substr($tmp_date,4,2) . "-" . substr($tmp_date,6,2) . " " . substr($tmp_time,0,2) . ":".substr($tmp_time,2,2) . ":".substr($tmp_time,4,2);
						
						//echo $tmp_date . " " . $tmp_time;
						//echo $pay_datetime;
						
		
						/*						
						$sql_er = "update tbl_payment set status='Y', return_code = '".$resultMap["resultCode"]."' , return_msg = '".$resultMap["resultMsg"]."', pay_type='".$resultMap["payMethod"]."' , pay_regdate='".$pay_datetime."' where oid = '".$resultMap["MOID"]."' ";
						*/
						
						// 빌링 키값만 저장 받고 실제 결제는 이루어 지지 않음

						$sql_er = "update tbl_payment set bill_able='Y', bill_key = '".$resultMap["CARD_BillKey"]."' , pay_type='Card' where oid = '".$resultMap["MOID"]."' ";
						mysql_query($sql_er);



						// // 주문한 결제 타입을 알아보자
						// $sql_pa = "select * from tbl_payment where oid = '".$resultMap["MOID"]."' ";
						// $result_pa = mysql_query($sql_pa);
						// $row_pa = mysql_fetch_array($result_pa);

						// $c_idx	= $_SESSION[customer][idx]; // 고객 번호
				
						// if($row_pa['goods_type']=="g_coin"){	// 코인 정보 추가

						// 	$sql = "";
						// 	$sql = $sql . "INSERT INTO	  tbl_coin "					;
						// 	$sql = $sql .			   " (c_idx "     					;
						// 	$sql = $sql .			   " ,coin "						;
						// 	$sql = $sql .			   " ,memo "						;
						// 	$sql = $sql .			   " ,regdate) "					;
						// 	$sql = $sql .	   "VALUES "						        ;
						// 	$sql = $sql .			   " ('[%c_idx%]' "					;
						// 	$sql = $sql .			   " ,'[%coin%]' "					;
						// 	$sql = $sql .			   " ,'충전' "					;
						// 	$sql = $sql .			   " , now() ) "    				;

							
						// 	$sql = str_replace("[%c_idx%]",   			$c_idx,						$sql);
						// 	$sql = str_replace("[%coin%]",				$row_pa['price'],			$sql);	

						// 	mysql_query("set names utf8" );
						// 	mysql_query($sql) or die(mysql_error());


						// 	// 코인을 구매했다면 tbl_customer 테이블에 coin을 update 하자
						// 	$sql = "";
						// 	$sql = $sql . " update tbl_customer set coin = coin+'[%coin%]' where c_idx = '[%c_idx%]' " ;

						// 	$sql = str_replace("[%c_idx%]",   			$c_idx,						$sql);
						// 	$sql = str_replace("[%coin%]",				$row_pa['price'],			$sql);	

						// 	mysql_query("set names utf8" );
						// 	mysql_query($sql) or die(mysql_error());

						// }else{	// 등급제 상품을 구입 시에

						// 	if($row_pa['g_levels']){	// 새로운 레벨이 정보가 있다면 tbl_customer level 정보를 변경
						// 		/*
						// 		$sql = "";
						// 		$sql = $sql . "update tbl_customer set level = '".$row_pa['g_levels']."' where c_idx = '".$c_idx."' ";
						// 		mysql_query("set names utf8" );
						// 		mysql_query($sql) or die(mysql_error());


								
						// 		$_SESSION[customer][level] = $row_pa['g_levels'];
						// 		*/
								
						// 	}

						// }


						?>
						<script type="text/javascript">
						
							var oid = '<?=$resultMap["MOID"]?>';
							//alert("결제 완료.");
							//location.href="/preference/payment_list.php";
							
							// 빌링 결제 페이지로 이동
							location.href="/main/bill_first.php?oid="+oid;


						</script>

						<?
						exit;




						exit;
					} else {

						// 실패시에 이쪽!!!

						$sql_er = "update tbl_payment set status='N', return_code = '".$resultMap["resultCode"]."' , return_msg = '".$resultMap["resultMsg"]."' where oid = '".$resultMap["MOID"]."' ";
						mysql_query($sql_er);

						/*
                        echo "<tr><th class='td01'><p>거래 성공 여부</p></th>";
                        echo "<td class='td02'><p>실패</p></td></tr>";
						echo "<tr><th class='line' colspan='2'><p></p></th></tr>
	                        <tr><th class='td01'><p>결과 코드</p></th>
	                        <td class='td02'><p>" . @(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" ) . "</p></td></tr>";
						
						//결제보안키가 다른 경우.
						if (strcmp($secureSignature, $resultMap["authSignature"]) != 0) {
							echo "<tr><th class='line' colspan='2'><p></p></th></tr>
								<tr><th class='td01'><p>결과 내용</p></th>
								<td class='td02'><p>" . "* 데이터 위변조 체크 실패" . "</p></td></tr>";

							//망취소
							if(strcmp("0000", $resultMap["resultCode"]) == 0) {
								throw new Exception("데이터 위변조 체크 실패");
							}
						} else {
							echo "<tr><th class='line' colspan='2'><p></p></th></tr>
								<tr><th class='td01'><p>결과 내용</p></th>
								<td class='td02'><p>" . @(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" ) . "</p></td></tr>";
						}
						*/

						?>
						<script type="text/javascript">
							var msg = '<?=$resultMap["resultMsg"]?>';
							alert("결제 실패 : " + msg);
							location.href="/main/payment.php";
						</script>

						<?
						exit;

                    }

                } catch (Exception $e) {
                    //    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                    //####################################
                    // 실패시 처리(***가맹점 개발수정***)
                    //####################################
                    //---- db 저장 실패시 등 예외처리----//
                    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                    echo $s;

                    //#####################
                    // 망취소 API
                    //#####################

                    $netcancelResultString = ""; // 망취소 요청 API url(고정, 임의 세팅 금지)
                    if ($httpUtil->processHTTP($netCancel, $authMap)) {
                        $netcancelResultString = $httpUtil->body;
                    } else {
                        echo "Http Connect Error\n";
                        echo $httpUtil->errormsg;

                        throw new Exception("Http Connect Error");
                    }

                    echo "<br/>## 망취소 API 결과 ##<br/>";
                    
                    /*##XML output##*/
                    //$netcancelResultString = str_replace("<", "&lt;", $$netcancelResultString);
                    //$netcancelResultString = str_replace(">", "&gt;", $$netcancelResultString);

                    // 취소 결과 확인
                    echo "<p>". $netcancelResultString . "</p>";
                }


				?>
				<script type="text/javascript">
					alert("결제 오류! 관리자에게 문의하세요.");
					location.href="/main/payment.php";
				</script>
				<?
				exit;


            } else {

                //#############
                // 인증 실패시
                //#############
                echo "<br/>";
                echo "####인증실패####";

                echo "<pre>" . var_dump($_REQUEST) . "</pre>";

			?>
				<script type="text/javascript">
					alert("결제 오류(인증실패)! 관리자에게 문의하세요.");
					location.href="/main/payment.php";
				</script>
			<?
				exit;


            }
        } catch (Exception $e) {
            $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
            echo $s;
        }
?>