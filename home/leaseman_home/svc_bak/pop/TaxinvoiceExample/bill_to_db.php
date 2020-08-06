<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

include 'common.php';



////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	$callnum				= updateSQ($_POST[callnum]);
	$_in_invoiceeEmail1		= updateSQ($_POST[invoiceeEmail1]);
	$_in_WriteDate			= updateSQ($_POST[WriteDate]);
	$_in_remark1			= updateSQ($_POST[remark1]);
	$sss_month				= updateSQ($_POST[sss_month]);
	$sss_day				= updateSQ($_POST[sss_day]);

	$_in_WriteDate = str_replace("-","",$_in_WriteDate);
	/*
	echo "callnum : " . $callnum . "<br/>";
	echo "invoiceeEmail1 : " . $_in_invoiceeEmail1 . "<br/>";
	echo "WriteDate : " . $_in_WriteDate . "<br/>";
	echo "remark1 : " . $_in_remark1 . "<br/>";
	*/
	

	/* 등록 불가 사유 확인 */

	// 이미 등록 된 내용인지 확인
	$sql_bi = "select count(*) cnts from tbl_billa where ordernum = '".$callnum."' ";
	$result_bi = mysql_query($sql_bi);
	$row_bi = mysql_fetch_array($result_bi);



	// 입금 내역에서 정보를 가지고 옴
	$sql_cs = " select * from tbl_contract_sub where callnum = '".$callnum."' order by idx asc limit 1 ";
	$result_cs = mysql_query($sql_cs) or die (mysql_error());
	$row_cs = mysql_fetch_array($result_cs);

	// 총 합계금액 확인
	$sql_cs_t = " select sum(supply) as t_supply, sum(tax) as t_tax from tbl_contract_sub where callnum = '".$callnum."' ";
	$result_cs_t = mysql_query($sql_cs_t) or die (mysql_error());
	$row_cs_t = mysql_fetch_array($result_cs_t);


	$sql_c = " select * from tbl_contract where idx = '".$row_cs['c_idx']."' ";
	$result_c = mysql_query($sql_c) or die (mysql_error());
	$row_c = mysql_fetch_array($result_c);

	$_tmp_b_idx = $row_c['b_idx'];
	$chkId = $row_c['u_idx'];

	// 방 정보에서 공급자 정보를 가지고 옴
	$sql_b = " select * from tbl_build where idx = '".$_tmp_b_idx."' ";
	$result_b = mysql_query($sql_b) or die (mysql_error());
	$row_b = mysql_fetch_array($result_b);

	// chkId에서 공급받는자 정보를 가지고 옴
	$sql_m = " select * from tbl_user where r_idx = '".$chkId."' ";
	$result_m = mysql_query($sql_m) or die (mysql_error());
	$row_m = mysql_fetch_array($result_m);


	//******************** 팅겨야 되는 놈들 **********************/
	$_you_out = "N";


	// tbl_billa 테이블에 이미 있는 데이터라면 팅하자!
	if($row_bi['cnts']>0){
		$_you_out = "Y";
	}


	// 세액이 없으면 팅겨버렷!
	if($row_cs['tax'] == "" || $row_cs['tax'] == 0){
		$_you_out = "Y";
	}


	// 무료회원 팅겨버렷!
	if(get_user_info('level')==0){
		$_you_out = "Y";
	}

	// 공급받는 자가 개인일 경우에도 팅기자
	if($row_m['com_type'] == 0){
		$_you_out = "Y";
	}


	// 개인회원 팅겨버렷! (사업자 회원만 가능)
	if($row_b['com_type'] == 0){
		$_you_out = "Y";
	}


	// 세금 계산서 발행 못할바엔 나가버렷!

	if( bill_able(1,$_danga_price) == "N"){
		$_you_out = "Y";
	}

	if( get_user_info('pop_id') == "" ){
		$_you_out = "Y";
	}

	if( get_user_info('com_num') == "" ){
		$_you_out = "Y";
	}



	if($_you_out=="Y"){
	?>
		<script type="text/javascript">
			alert("발급할 수 없습니다.");
			parent.location.reload();
		</script>
	<?
	}
	//***************************************************************/

	// 기본적으로 callnum 만 받았을 때 DB에 자동 세팅되도록 하고 그 외에 위에 받은 값이 있을 경우에는 덮어 씌울께

	// 팝빌회원 사업자번호, '-' 제외 10자리
	$_tmp_com_num = $row_m['com_num'];
	$_tmp_com_num = str_replace("-","",$_tmp_com_num);
	
	//$testCorpNum = '1908600646';
	$testCorpNum = get_user_info('com_num');


	$testCorpNum = str_replace("-","",$testCorpNum);
	
	$info_result = $TaxinvoiceService->GetCorpInfo($testCorpNum);
	


	// 팝빌회원 아이디
	//$testUserID = 'bizffice';
	$testUserID = get_user_info('pop_id');


	// 세금계산서 문서관리번호
	// - 최대 24자리 숫자, 영문, '-', '_' 조합으로 사업자별로 중복되지 않도록 구성
	//$invoicerMgtKey = '20170628-2-01';
	$invoicerMgtKey = date('Ymd').'-'.$callnum;


	// 지연발행 강제여부
	$forceIssue = false;

	// 즉시발행 메모
	$memo = '즉시발행 메모';

	// 안내메일 제목, 미기재시 기본제목으로 전송
	$emailSubject = '';

	// 거래명세서 동시작성 여부
	$writeSpecification = false;

	// 거래명세서 동시작성시 명세서 관리번호
	// - 최대 24자리 숫자, 영문, '-', '_' 조합으로 사업자별로 중복되지 않도록 구성
	$dealInvoiceMgtKey = '';
	

	/************************************************************
	*                        세금계산서 정보
	************************************************************/


	// [필수] 작성일자, 형식(yyyyMMdd) 예)20150101
	$writeDate = date('Ymd');
	if($_in_WriteDate){
		$writeDate = $_in_WriteDate;
	}


	// [필수] 발행형태, '정발행', '역발행', '위수탁' 중 기재
	$issueType = '정발행';

	// [필수] 과금방향,
	// - '정과금'(공급자 과금), '역과금'(공급받는자 과금) 중 기재, 역과금은 역발행시에만 가능.
	$chargeDirection = '정과금';
	
	// [필수] '영수', '청구' 중 기재
	$purposeType = '영수';
	
	// [필수] 과세형태, '과세', '영세', '면세' 중 기재
	$taxType = '과세';

	// [필수] 발행시점, 발행예정시 동작, '직접발행', '승인시자동발행' 중 기재
	$issueTiming = '직접발행';


    /************************************************************
    *                         공급자 정보
    ************************************************************/

	// [필수] 공급자 사업자번호
	$invoicerCorpNum = $testCorpNum;
	$invoicerCorpNum = str_replace("-","",$invoicerCorpNum);
	
	

	// 공급자 종사업장 식별번호, 4자리 숫자 문자열
	$invoicerTaxRegID = '';

	// [필수] 공급자 상호
	//$invoicerCorpName = $row_b['com_name'];
	$invoicerCorpName = $info_result->corpName;
	
	// [필수] 공급자 문서관리번호, 최대 24자리 숫자, 영문, '-', '_' 조합으로 사업자별로 중복되지 않도록 구성
	$invoicerMgtKey = $invoicerMgtKey;
	
	// [필수] 공급자 대표자성명
    //$invoicerCEOName = $row_b['com_oder'];
	$invoicerCEOName = $info_result->ceoname;

	// 공급자 주소
	//$invoicerAddr = $row_b['addr'];
	$invoicerAddr = $info_result->addr;

	// 공급자 종목
	//$invoicerBizClass = $row_b['com_kind2'];
	$invoicerBizClass = $info_result->bizClass;

	// 공급자 업태
	//$invoicerBizType = $row_b['com_kind1'];
	$invoicerBizType = $info_result->bizType;

	// 공급자 담당자 성명
	//$invoicerContactName = $row_b['com_oder'];
	$invoicerContactName = $info_result->ceoname;

	// 공급자 담당자 메일주소
	$invoicerEmail = $row_b['email'];

	// 공급자 담당자 연락처
	$invoicerTEL = $row_b['tel'];

	// 공급자 휴대폰 번호
	$invoicerHP = $row_b['tel'];

	// 정발행시 공급받는자 담당자에게 알림문자 전송여부
	// - 안내문자 전송시 포인트가 차감되며 전송실패시 환불처리 됩니다.
	$invoicerSMSSendYN = "false";




	/************************************************************
	*                      공급받는자 정보
	************************************************************/

	// [필수] 공급받는자 구분, '사업자', '개인', '외국인' 중 기재
	$invoiceeType = '사업자';

	// [필수] 공급받는자 사업자번호
	$invoiceeCorpNum = $row_m['com_num'];
	echo "invoiceeCorpNum : " . $invoiceeCorpNum . "<br/>";
	$invoiceeCorpNum = str_replace("-","",$invoiceeCorpNum);
	echo "invoiceeCorpNum : " . $invoiceeCorpNum . "<br/>";

	// 공급받는자 종사업장 식별번호, 4자리 숫자 문자열
	$invoiceeTaxRegID = '';

	// [필수] 공급자 상호
	$invoiceeCorpName = $row_m['com_name'];

	// [역발행시 필수] 공급받는자 문서관리번호, 최대 24자리 숫자, 영문, '-', '_' 조합으로 사업자별로 중복되지 않도록 구성
	$invoiceeMgtKey = '';

	// [필수] 공급받는자 대표자성명
	$invoiceeCEOName = $row_m['user_name'];

	// 공급받는자 주소
	//$invoiceeAddr = $row_b['addr'];
	$invoiceeAddr = $row_m['addr'] . " " . $row_m['addr2'];

	// 공급받는자 업태
	$invoiceeBizType = $row_m['com_kind'];

	// 공급받는자 종목
	$invoiceeBizClass = $row_m['com_kind2'];

	// 공급받는자 담당자 성명
	$invoiceeContactName1 = $row_m['user_name'];

	// 공급받는자 담당자 메일주소
	$invoiceeEmail1 = $row_m['email'];
	if($_in_invoiceeEmail1){
		$invoiceeEmail1 = $_in_invoiceeEmail1;
	}

	// 공급받는자 담당자 연락처
	$invoiceeTEL1 = $row_m['mobile'];

	// 공급받는자 담당자 휴대폰 번호
	$invoiceeHP1 = $row_m['mobile'];

	// 역발행요청시 공급자 담당자에게 알림문자 전송여부
	// - 문자전송지 포인트가 차감되며, 전송실패시 포인트 환불처리됩니다.
	$invoiceeSMSSendYN = "false";





	/************************************************************
	*                       세금계산서 기재정보
	************************************************************/

	// [필수] 공급가액 합계
	$supplyCostTotal = $row_cs_t['t_supply'];
	//echo "invoicerMgtKey : " . $invoicerMgtKey . "<br/>";

	// [필수] 세액 합계
	$taxTotal = $row_cs_t['t_tax'];

	// [필수] 합계금액, (공급가액 합계 + 세액 합계)
	$totalAmount = ($row_cs_t['t_supply']+$row_cs_t['t_tax']);

	// 기재상 '일련번호'항목
	$serialNum = $callnum;
	
	// 기재상 '현금'항목
	$cash = '';

	// 기재상 '수표'항목
	$chkBill = '';
	// 기재상 '어음'항목
	$note = '';

	// 기재상 '외상'항목
	$credit = '';

	// 기재상 '비고' 항목
	$remark1 = '';
	if($_in_remark1){
		$remark1 = $_in_remark1;
	}
	$remark2 = '';
	$remark3 = '';

	// 기재상 '권' 항목, 최대값 32767
	$kwon = '1';

	// 기재상 '호' 항목, 최대값 32767
	$ho = '1';

	// 사업자등록증 이미지파일 첨부여부
	$businessLicenseYN = false;

	// 통장사본 이미지파일 첨부여부
	$bankBookYN = false;


	/*
		id = 'admin'
		, pw = 'root'
		, bio = '테스트 계정입니다.'
	*/


	/* DB에 데이터를 넣어보자~~~ */
	$c_idx = $_SESSION[customer][idx];
	$u_idx = $chkId;

	if( get_bill_able() > 0 ){
		$send_type = "L";
	}else{
		$send_type = "P";
	}

	$sql_in = "INSERT tbl_billa SET
				 c_idx						  = '".$c_idx."'
				,u_idx						  = '".$u_idx."'
				,ordernum					  = '".$callnum."'
				,writeDate					  = '".$writeDate."'
				,issueType					  = '".$issueType."'
				,chargeDirection			  = '".$chargeDirection."'
				,purposeType				  = '".$purposeType."'
				,taxType					  = '".$taxType."'
				,issueTiming				  = '".$issueTiming."'
				,invoicerCorpNum			  = '".$invoicerCorpNum."'
				,invoicerTaxRegID			  = '".$invoicerTaxRegID."'
				,invoicerCorpName			  = '".$invoicerCorpName."'
				,invoicerMgtKey				  = '".$invoicerMgtKey."'
				,invoicerCEOName			  = '".$invoicerCEOName."'
				,invoicerAddr				  = '".$invoicerAddr."'
				,invoicerBizClass			  = '".$invoicerBizClass."'
				,invoicerBizType			  = '".$invoicerBizType."'
				,invoicerContactName		  = '".$invoicerContactName."'
				,invoicerEmail				  = '".$invoicerEmail."'
				,invoicerTEL				  = '".$invoicerTEL."'
				,invoicerHP					  = '".$invoicerHP."'
				,invoicerSMSSendYN			  = '".$invoicerSMSSendYN."'
				,invoiceeType				  = '".$invoiceeType."'
				,invoiceeCorpNum			  = '".$invoiceeCorpNum."'
				,invoiceeTaxRegID			  = '".$invoiceeTaxRegID."'
				,invoiceeCorpName			  = '".$invoiceeCorpName."'
				,invoiceeMgtKey				  = '".$invoiceeMgtKey."'
				,invoiceeCEOName			  = '".$invoiceeCEOName."'
				,invoiceeAddr				  = '".$invoiceeAddr."'
				,invoiceeBizType			  = '".$invoiceeBizType."'
				,invoiceeBizClass			  = '".$invoiceeBizClass."'
				,invoiceeContactName1		  = '".$invoiceeContactName1."'
				,invoiceeEmail1				  = '".$invoiceeEmail1."'
				,invoiceeTEL1				  = '".$invoiceeTEL1."'
				,invoiceeHP1				  = '".$invoiceeHP1."'
				,invoiceeSMSSendYN			  = '".$invoiceeSMSSendYN."'
				,supplyCostTotal			  = '".$supplyCostTotal."'
				,taxTotal					  = '".$taxTotal."'
				,totalAmount				  = '".$totalAmount."'
				,serialNum					  = '".$serialNum."'
				,cash						  = '".$cash."'
				,chkBill					  = '".$chkBill."'
				,note						  = '".$note."'
				,credit						  = '".$credit."'
				,remark1					  = '".$remark1."'
				,remark2					  = '".$remark2."'
				,remark3					  = '".$remark3."'
				,kwon						  = '".$kwon."'
				,ho							  = '".$ho."'
				,businessLicenseYN			  = '".$businessLicenseYN."'
				,bankBookYN					  = '".$bankBookYN."'
				,sss_month					  = '".$sss_month."'
				,sss_day					  = '".$sss_day."'
				,send_type					  = '".$send_type."'
				";


	




	/************************************
			실제 발행 관련
	************************************/
	
	$Taxinvoice = new Taxinvoice();

	$Taxinvoice->writeDate			= $writeDate;
	$Taxinvoice->issueType			= $issueType;
	$Taxinvoice->chargeDirection	= $chargeDirection;
	$Taxinvoice->purposeType		= $purposeType;
	$Taxinvoice->taxType			= $taxType;
	$Taxinvoice->issueTiming		= $issueTiming;
	$Taxinvoice->invoicerCorpNum	= $invoicerCorpNum;
	$Taxinvoice->invoicerTaxRegID	= $invoicerTaxRegID;
	$Taxinvoice->invoicerCorpName	= $invoicerCorpName;
	$Taxinvoice->invoicerMgtKey		= $invoicerMgtKey;
	$Taxinvoice->invoicerCEOName	= $invoicerCEOName;
	$Taxinvoice->invoicerAddr		= $invoicerAddr;
	$Taxinvoice->invoicerBizClass	= $invoicerBizClass;
	$Taxinvoice->invoicerBizType	= $invoicerBizType;
	$Taxinvoice->invoicerContactName = $invoicerContactName;
	$Taxinvoice->invoicerEmail		= $invoicerEmail;
	$Taxinvoice->invoicerTEL		= $invoicerTEL;
	$Taxinvoice->invoicerHP			= $invoicerHP;
	$Taxinvoice->invoicerSMSSendYN	= false;
	
	$Taxinvoice->invoiceeType = $invoiceeType;
	$Taxinvoice->invoiceeCorpNum = $invoiceeCorpNum;
	$Taxinvoice->invoiceeTaxRegID = $invoiceeTaxRegID;
	$Taxinvoice->invoiceeCorpName = $invoiceeCorpName;
	$Taxinvoice->invoiceeMgtKey = $invoiceeMgtKey;
	$Taxinvoice->invoiceeCEOName = $invoiceeCEOName;
	$Taxinvoice->invoiceeAddr = $invoiceeAddr;
	$Taxinvoice->invoiceeBizType = $invoiceeBizType;
	$Taxinvoice->invoiceeBizClass = $invoiceeBizClass;
	$Taxinvoice->invoiceeContactName1 = $invoiceeContactName1;
	$Taxinvoice->invoiceeEmail1 = $invoiceeEmail1;
	$Taxinvoice->invoiceeTEL1 = $invoiceeTEL1;
	$Taxinvoice->invoiceeHP1 = $invoiceeHP1;
	$Taxinvoice->invoiceeSMSSendYN = false;

	$Taxinvoice->supplyCostTotal = $supplyCostTotal;
	$Taxinvoice->taxTotal = $taxTotal;
	$Taxinvoice->totalAmount = $totalAmount;
	$Taxinvoice->serialNum = $serialNum;
	$Taxinvoice->cash = $cash;
	$Taxinvoice->chkBill = $chkBill;
	$Taxinvoice->note = $note;
	$Taxinvoice->credit = $credit;
	$Taxinvoice->remark1 = $remark1;
	$Taxinvoice->remark2 = $remark2;
	$Taxinvoice->remark3 = $remark3;
	$Taxinvoice->kwon = $kwon;
	$Taxinvoice->ho = $ho;
	$Taxinvoice->businessLicenseYN = false;
	$Taxinvoice->bankBookYN = false;


	$Taxinvoice->detailList = array();

	$Taxinvoice->detailList[] = new TaxinvoiceDetail();
	$Taxinvoice->detailList[0]->serialNum = 1;					// [상세항목 배열이 있는 경우 필수] 일련번호 1~99까지 순차기재,
	$Taxinvoice->detailList[0]->purchaseDT = $writeDate;		// 거래일자
	$Taxinvoice->detailList[0]->itemName = '';	  				// 품명
	$Taxinvoice->detailList[0]->spec = '';						// 규격
	$Taxinvoice->detailList[0]->qty = '';						// 수량
	$Taxinvoice->detailList[0]->unitCost = '';					// 단가
	$Taxinvoice->detailList[0]->supplyCost = $row_cs_t['t_supply'];	// 공급가액
	$Taxinvoice->detailList[0]->tax = $row_cs_t['t_tax'];			// 세액
	$Taxinvoice->detailList[0]->remark = $remark1;				// 비고



	/*
	$Taxinvoice->addContactList = array();

	$Taxinvoice->addContactList[] = new TaxinvoiceAddContact();
	$Taxinvoice->addContactList[0]->serialNum = 1;				        // 일련번호 1부터 순차기재
	
	// $Taxinvoice->addContactList[0]->email = $row_b['email'];			// 이메일주소		(추가 담당자 메일 삭제)
	$Taxinvoice->addContactList[0]->email = "";

	//$Taxinvoice->addContactList[0]->contactName	= $row_b['com_oder'];	// 담당자명
	$Taxinvoice->addContactList[0]->contactName	= $info_result->ceoname;	// 담당자명
	*/
	


	
	try {
		$result = $TaxinvoiceService->RegistIssue($testCorpNum, $Taxinvoice, $testUserID,
                  $writeSpecification, $forceIssue, $memo, $emailSubject, $dealInvoiceMgtKey);
		$code = $result->code;
		$message = $result->message;
	}
	catch(PopbillException $pe) {
		$code = $pe->getCode();
		$message = $pe->getMessage();
	}
	

	if($code==1){
		mysql_query($sql_in);	//나중에 주석해제
		use_bill(1,$_danga_price);
	}else{
		
	}

?>

<script type="text/javascript">
	var code = "<?=$code?>";
	var message = "<?=$message?>";
	
	if(code!=1){
		alert(code);
	}
	if(code==1){
		alert("발급되었습니다.");
		parent.location.reload();
	}else{
		alert(message);
		parent.location.reload();
	}
	
</script>
