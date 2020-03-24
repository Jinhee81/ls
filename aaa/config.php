<?
//--------- 서비스 파트 ------------------


// 도메인 정보
if(isset($_SERVER["HTTPS"])) {  
	$_IT_TOP_PROTOCOL = "https://";
}else{
	$_IT_TOP_PROTOCOL = "http://";
}


//$_ssl_use = true;
$_ssl_use = false;



if($_ssl_use){	// SSL 사용 설정일 경우
	if(! isSecureDomain() ){
		$_return_url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		
		echo "<script type='text/javascript'>";
		echo "location.href='".$_return_url."';";
		echo "</script>";
	}	
}


// 세금계산서 관련
$_bill_good_type = "";
$_bill_good_ggu = "";


// 하 말도 안되는 번호 페이지 이동

$_error_page[111] = "/main/main.php";
$_error_page[112] = "/manage/mg_list.php";
$_error_page[113] = "/manage/mg_enroll.php";
$_error_page[114] = "";
$_error_page[115] = "";

$_error_page[121] = "/contract/ctr_list.php";
$_error_page[122] = "/contract/ctr_etc_list.php";
$_error_page[123] = "/contract/ctr_list02.php";
$_error_page[124] = "/contract/ctr_list03.php";
$_error_page[125] = "/contract/ctr_enroll.php";
$_error_page[126] = "/contract/ctr_enroll_etc.php";
$_error_page[127] = "";

$_error_page[131] = "/account/act_deposit.php";
$_error_page[132] = "/account/act_cost.php";
$_error_page[133] = "/account/act_fixed.php";
$_error_page[134] = "/account/act_surety.php";
$_error_page[135] = "/account/act_momthly.php";
$_error_page[136] = "/account/act_year.php";

$_error_page[141] = "/synthesis/syn_calendar.php";
$_error_page[142] = "/synthesis/syn_room.php";
$_error_page[143] = "/synthesis/syn_use.php";

$_error_page[151] = "/board_manage/bmg_notice.php";
$_error_page[152] = "/board_manage/bmg_faq.php";
$_error_page[153] = "/board_manage/bmg_que.php";
$_error_page[154] = "/board_manage/bmg_free.php";
$_error_page[155] = "/board_manage/bmg_reference.php";

$_error_page[161] = "/preference/prc_build.php";
$_error_page[162] = "/preference/prc_room.php";
$_error_page[163] = "/preference/prc_goods.php";
$_error_page[164] = "/preference/prc_fixed.php";
$_error_page[165] = "/preference/prc_sms.php";
$_error_page[166] = "/preference/payment.php";
$_error_page[167] = "/preference/payment_list.php";
$_error_page[168] = "";

//---------------------------


$_goods_types[0] = "임대계약";
$_goods_types[1] = "기타계약";

/*
$_sms_type[0] = "고객리스트";
$_sms_type[1] = "계약리스트";
$_sms_type[2] = "계약관리";
$_sms_type[3] = "입금예정리스트";
$_sms_type[4] = "계약종료리스트";
$_sms_type[5] = "입금리스트";
*/
$_sms_type[0] = "고객리스트";
$_sms_type[1] = "임대계약리스트";
$_sms_type[2] = "기타계약리스트";
$_sms_type[3] = "입금예정리스트";
$_sms_type[4] = "계약종료리스트";


$_pay_pm['p'] = "입금";
$_pay_pm['m'] = "출금";

$_pay_type[0] = "선불";
$_pay_type[1] = "후불";

// 부가세
$_add_tax[0] = "간이";
$_add_tax[1] = "일반";


//계약 상태
$_enroll_status[0] = "진행";
$_enroll_status[1] = "종료";


//입금구분
$_income_type[2] = "계좌";
$_income_type[1] = "카드";
$_income_type[0] = "현금";


//$_income_type[3] = "";

$_mobile[0] = "010";
$_mobile[1] = "011";
$_mobile[2] = "016";
$_mobile[3] = "017";
$_mobile[4] = "018";
$_mobile[5] = "019";

$_tel1[0] = "02";
$_tel1[1] = "031";
$_tel1[2] = "032";
$_tel1[3] = "033";
$_tel1[4] = "041";
$_tel1[5] = "042";
$_tel1[6] = "043";
$_tel1[7] = "044";
$_tel1[8] = "051";
$_tel1[9] = "052";
$_tel1[10] = "053";
$_tel1[11] = "054";
$_tel1[12] = "055";
$_tel1[13] = "061";
$_tel1[14] = "062";
$_tel1[15] = "063";
$_tel1[16] = "064";
$_tel1[17] = "070";
$_tel1[18] = "080";


$_com_type[0] = "개인";
$_com_type[1] = "개인사업자";
$_com_type[2] = "법인사업자";


$_security[0] = "KT텔레캅";
$_security[1] = "세콤";
$_security[2] = "캡스";
$_security[3] = "기타";
$_security[4] = "없음";


// 포인트로 구입하는 단가
$_danga_price[0] = "30";	// 단문
$_danga_price[1] = "90";	// 장문
$_danga_price[2] = "200";	// 세금계산서



//--------- 관리자 파트 ------------------

// 결제 관련 구분

function ini_payMethod($types){
	$out_type = "";

	if($types == "VCard" || $types == "Card"){
		$out_type = "신용카드";
	}

	if($types == "DirectBank" || $types == "iDirectBank"){
		$out_type = "계좌이체";
	}

	if($types == "VBank"){
		$out_type = "무통장입금";
	}

	if($types == "HPP"){
		$out_type = "휴대폰";
	}

	return $out_type;
}


// 레벨, 계약건수, 문자수, 세금계산서 수, 아이디수?, 가격

// 무료=일반
$_pay_level[0] = "일반(무료회원)";
$_pay_contract[0] = 10;
$_pay_sms[0] = 10;
$_pay_bill[0] = 0;
$_pay_id[0] = 1;
$_pay_price[0] = 0;
$_pay_real_price[0] = 0;

// 화이트

$_pay_level[3] = "화이트";
$_pay_contract[3] = 20;
$_pay_sms[3] = 50;
$_pay_bill[3] = 10;
$_pay_id[3] = 1;
$_pay_price[3] = 9900;
//$_pay_price[3] = 1000;


// 실버
$_pay_level[4] = "실버";
$_pay_contract[4] = 50;
$_pay_sms[4] = 100;
$_pay_bill[4] = 25;
$_pay_id[4] = 1;
$_pay_price[4] = 19900;

// 골드
$_pay_level[5] = "골드";
$_pay_contract[5] = 100;
$_pay_sms[5] = 200;
$_pay_bill[5] = 50;
$_pay_id[5] = 1;
$_pay_price[5] = 29900;

// VIP

$_pay_level[6] = "VIP";
$_pay_contract[6] = 150;
$_pay_sms[6] = 300;
$_pay_bill[6] = 100;
$_pay_id[6] = 1;
$_pay_price[6] = 39900;


// VVIP

$_pay_level[7] = "VVIP";
$_pay_contract[7] = 200;
$_pay_sms[7] = 400;
$_pay_bill[7] = 150;
$_pay_id[7] = 1;
$_pay_price[7] = 49900;


$_pay_level[99] = "탈퇴";

//$_pay_coin_price[0] = 5000;
$_pay_coin_price[0] = 5000;
$_pay_coin_price[1] = 10000;
$_pay_coin_price[2] = 20000;
$_pay_coin_price[3] = 30000;
$_pay_coin_price[4] = 50000;

//---------------------------------

// 우왕 서브 관리자 권한 내역이닷
$_master_nol[10] = "회원관리";
$_master_nol[11] = "회원리스트";
$_master_nol[12] = "탈퇴회원리스트";
$_master_nol[13] = "이벤트조회";
$_master_nol[14] = " 보낸문자리스트";

$_master_nol[20] = "데이터관리";
$_master_nol[21] = "건물리스트";

$_master_nol[30] = "게시판관리";
$_master_nol[31] = "공지사항";
$_master_nol[32] = "FAQ";
$_master_nol[33] = "1:1질문관리";
$_master_nol[34] = "자유게시판";
$_master_nol[35] = "자료실관리";

$_master_nol[40] = "정산관리";
$_master_nol[41] = "입금리스트";
$_master_nol[42] = "서비스사용내용";


$_master_nol[50] = "환경설정";
$_master_nol[51] = "관리자관리";
$_master_nol[52] = "푸쉬메시지관리";
$_master_nol[53] = "팝업관리";


// 서브 관리자 권한 관련 url

$_m_grant_url[11] = "/AdmMaster/member/list01.php";
$_m_grant_url[12] = "/AdmMaster/member/list03.php";
$_m_grant_url[13] = "/AdmMaster/member/list02.php";
$_m_grant_url[14] = "/AdmMaster/sms/list.php";

$_m_grant_url[21] = "/AdmMaster/datalooup/list02.php";



$_m_grant_url[41] = "/AdmMaster/calculate/list01.php";
$_m_grant_url[42] = "/AdmMaster/calculate/list02.php";

$_m_grant_url[51] = "/AdmMaster/setting/list02.php";
$_m_grant_url[52] = "/AdmMaster/setting/list03.php";
$_m_grant_url[53] = "/AdmMaster/setting/list04.php";

//---------------------------------



// 사업자 회원 구분
$_admin_com_type[0] = "법인사업자";
$_admin_com_type[1] = "개인사업자";



// 무료/유료 구분
$_admin_pay_yn['n'] = "무료";
$_admin_pay_yn['y'] = "유료";



// 집형태 // tbl_house_type

$sql_options = "select * from tbl_house_type order by r_idx asc";
$result_options = mysql_query($sql_options);

while($row_options = mysql_fetch_array($result_options)){
	$_admin_house_type[$row_options['r_idx']] = $row_options['r_name'];
}

// 회원레벨 // tbl_level

$sql_options = "select * from tbl_level order by r_idx asc";
$result_options = mysql_query($sql_options);

while($row_options = mysql_fetch_array($result_options)){
	$_admin_level[$row_options['r_idx']] = $row_options['r_name'];
}


// 수납방법
$_admin_pay_type[0] = "카드결제";
$_admin_pay_type[1] = "휴대폰결제";
$_admin_pay_type[2] = "프랜차이즈";
$_admin_pay_type[3] = "테스트";

$_email_list[0] = "naver.com";
$_email_list[1] = "daum.net";
$_email_list[2] = "gmail.com";
$_email_list[3] = "nate.com";


//----------  function 기능 추가 ----------------



function HexToDe($str, $hexNum){
	return array_search($str,$hexNum);	
}


function DeToHex($str, $hexNum){
	return $hexNum[$str];	
}


function create_customer_code(){

	$hexNum = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j",
        "k", "l", "m", "n", "o", "p", "q", "r", "s", "t",
        "u", "v", "w", "x", "y", "z");


	// 테스트 테이블 tbl_test
	/*
	-- 회원코드 규칙
	총 8자리
	1 + 0~z + 000000 -> 시작은 1 두번째 자리수만 0에서 z 까지 올 수 있음. 세번째 자리 부터 끝까지는 숫자만 옴
	*/
	
	/*
	$sql_c = "select user_code from tbl_customer order by c_idx desc  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['user_code'];
	*/

	$sql_c = "select code from tbl_last_code where part = 'customer'  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['code'];

	
	if($last_code == ""){
		return "10000000";
	}

	if($last_code == "1z999999"){
		return false;
	}

	$code1 = substr($last_code,0,1); //  회원이기 때문에 코드는 무조건 1이다.
	$code2 = substr($last_code,1,1);
	$code3 = substr($last_code,2,6);
	$full_code = "";

	if($code3=="999999"){
		$tmp = HexToDe($code2, $hexNum);
		$tmp++;
		$code2 = DeToHex($tmp, $hexNum);
		$code3 = "000000";
		$code3 = str_pad($code3,6,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}else{
		$code3++;
		$code3 = str_pad($code3,6,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}


	$sql_c = "update tbl_last_code set code = '$full_code' where part = 'customer'  ";
	$result_c = mysql_query($sql_c);

	return $full_code;
}



function create_user_code(){

	$hexNum = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j",
        "k", "l", "m", "n", "o", "p", "q", "r", "s", "t",
        "u", "v", "w", "x", "y", "z");


	// 테스트 테이블 tbl_test
	/*
	-- 고객코드 규칙
	총 9자리
	2 + 0~z + 0000000 -> 시작은 2 두번째 자리수만 0에서 z 까지 올 수 있음. 세번째 자리 부터 끝까지는 숫자만 옴
	*/
	/*
	$sql_c = "select user_code from tbl_user order by r_idx desc  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['user_code'];
	*/
	$sql_c = "select code from tbl_last_code where part = 'user'  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['code'];

	if($last_code == ""){
		return "200000000";
	}

	if($last_code == "2z9999999"){
		return false;
	}

	$code1 = substr($last_code,0,1); //  고객이기 때문에 코드는 무조건 2이다.
	$code2 = substr($last_code,1,1);
	$code3 = substr($last_code,2,7);
	$full_code = "";

	if($code3=="9999999"){
		$tmp = HexToDe($code2, $hexNum);
		$tmp++;
		$code2 = DeToHex($tmp, $hexNum);
		$code3 = "0000000";
		$code3 = str_pad($code3,7,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}else{
		$code3++;
		$code3 = str_pad($code3,7,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}

	$sql_c = "update tbl_last_code set code = '$full_code' where part = 'user'  ";
	$result_c = mysql_query($sql_c);

	return $full_code;
}



function create_contract_code(){

	$hexNum = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j",
        "k", "l", "m", "n", "o", "p", "q", "r", "s", "t",
        "u", "v", "w", "x", "y", "z");


	// 테스트 테이블 tbl_test
	/*
	-- 계약코드 규칙
	총 10자리
	3 + 0~z + 00000000 -> 시작은 3 두번째 자리수만 0에서 z 까지 올 수 있음. 세번째 자리 부터 끝까지는 숫자만 옴
	*/
	/*
	$sql_c = "select ordernum from tbl_contract order by idx desc  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['ordernum'];
	*/
	$sql_c = "select code from tbl_last_code where part = 'contract'  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['code'];

	if($last_code == ""){
		return "3000000000";
	}

	if($last_code == "3z99999999"){
		return false;
	}

	$code1 = substr($last_code,0,1); //  계약이기 때문에 코드는 무조건 3이다.
	$code2 = substr($last_code,1,1);
	$code3 = substr($last_code,2,8);
	$full_code = "";

	if($code3=="99999999"){
		$tmp = HexToDe($code2, $hexNum);
		$tmp++;
		$code2 = DeToHex($tmp, $hexNum);
		$code3 = "00000000";
		$code3 = str_pad($code3,8,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}else{
		$code3++;
		$code3 = str_pad($code3,8,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}

	$sql_c = "update tbl_last_code set code = '$full_code' where part = 'contract'  ";
	$result_c = mysql_query($sql_c);

	return $full_code;
}




function create_contract_etc_code(){

	$hexNum = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j",
        "k", "l", "m", "n", "o", "p", "q", "r", "s", "t",
        "u", "v", "w", "x", "y", "z");


	// 테스트 테이블 tbl_test
	/*
	-- 계약코드 규칙
	총 10자리
	4 + 0~z + 00000000 -> 시작은 4 두번째 자리수만 0에서 z 까지 올 수 있음. 세번째 자리 부터 끝까지는 숫자만 옴
	*/
	/*
	$sql_c = "select ordernum from tbl_contract order by idx desc  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['ordernum'];
	*/
	$sql_c = "select code from tbl_last_code where part = 'contract_etc'  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['code'];

	if($last_code == ""){
		return "4000000000";
	}

	if($last_code == "4z99999999"){
		return false;
	}

	$code1 = substr($last_code,0,1); //  계약이기 때문에 코드는 무조건 3이다.
	$code2 = substr($last_code,1,1);
	$code3 = substr($last_code,2,8);
	$full_code = "";

	if($code3=="99999999"){
		$tmp = HexToDe($code2, $hexNum);
		$tmp++;
		$code2 = DeToHex($tmp, $hexNum);
		$code3 = "00000000";
		$code3 = str_pad($code3,8,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}else{
		$code3++;
		$code3 = str_pad($code3,8,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}

	$sql_c = "update tbl_last_code set code = '$full_code' where part = 'contract_etc'  ";
	$result_c = mysql_query($sql_c);

	return $full_code;
}



function create_contract_sub_code(){

	$hexNum = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j",
        "k", "l", "m", "n", "o", "p", "q", "r", "s", "t",
        "u", "v", "w", "x", "y", "z");


	// 테스트 테이블 tbl_test
	/*
	-- 청구코드 규칙
	총 10자리
	5 + 0~z + 00000000 -> 시작은 5 두번째 자리수만 0에서 z 까지 올 수 있음. 세번째 자리 부터 끝까지는 숫자만 옴
	*/
	/*
	$sql_c = "select callnum from tbl_contract_sub order by callnum desc  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['callnum'];
	*/
	$sql_c = "select code from tbl_last_code where part = 'contract_sub'  ";
	$result_c = mysql_query($sql_c);
	$row_c = mysql_fetch_array($result_c);
	$last_code = $row_c['code'];

	if($last_code == ""){
		return "5000000000";
	}

	if($last_code == "5z99999999"){
		return false;
	}

	$code1 = substr($last_code,0,1); //  청구이기 때문에 코드는 무조건 5이다.
	$code2 = substr($last_code,1,1);
	$code3 = substr($last_code,2,8);
	$full_code = "";

	if($code3=="99999999"){
		$tmp = HexToDe($code2, $hexNum);
		$tmp++;
		$code2 = DeToHex($tmp, $hexNum);
		$code3 = "00000000";
		$code3 = str_pad($code3,8,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}else{
		$code3++;
		$code3 = str_pad($code3,8,'0',STR_PAD_LEFT);
		$full_code = $code1 . $code2 . $code3;
	}
	
	$sql_c = "update tbl_last_code set code = '$full_code' where part = 'contract_sub'  ";
	$result_c = mysql_query($sql_c);

	return $full_code;
}







//------------ 설정 값 -------------

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {   //https 통신일때 daum 주소 js
    define('G5_POSTCODE_JS', '<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>');
} else {  //http 통신일때 daum 주소 js
    define('G5_POSTCODE_JS', '<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>');
}


?>
<?
	// 아이피 차단
	$block_chk = false;

	$sql_ips = "select * from tbl_block_ip ";
	$result_ips = mysql_query($sql_ips);
	while($row_ips = mysql_fetch_array($result_ips)){
		$block_ip[$row_ips['idx']] = $row_ips['ips'];
	}
	

	foreach($block_ip as $keys=>$values){

		$tmp_size = strlen($values);


		if(substr($_SERVER["REMOTE_ADDR"],0,$tmp_size) == $values){
			if($_SERVER['PHP_SELF'] == "/main/logout.php" || $_SERVER['PHP_SELF'] == "/main/login.php"){
				$block_chk = false;
			}else{
				$block_chk = true;
			}
		}
	}

	if($block_chk==true){
?>
<script type="text/javascript">
	var block_ip = "<?=$block_chk?>";
	if(block_ip==1){
		alert("차단된 IP입니다.\n관리자에게 문의해주세요.");
		location.href="/main/logout.php";
	}
</script>
<?
	}
?>
<?
	// 회원의 신분 검사를 합시다!

	$_no_pay_page[] = array();
	$_no_pay_page[] = "/main/login.php";
	$_no_pay_page[] = "/preference/payment.php";
	$_no_pay_page[] = "/main/logout.php";
	$_no_pay_page[] = "/main/login_check.php";
	$_no_pay_page[] = "/AdmMaster/main/login.php";
	$_no_pay_page[] = "/AdmMaster/main/login_check.php";
	$_no_pay_page[] = "/preference/payment_tmp.php";
	$_no_pay_page[] = "/preference/payment_list.php";
	$_no_pay_page[] = "/stdpay/INIStdPaySample/INIStdPayReturn.php";
	$_no_pay_page[] = "/stdpay/INIStdPaySample/close.php";
	$_no_pay_page[] = "/stdpay/INIStdPaySample/popup.php";
	
	
	
	//마지막 결제 정보와 회원 가입 일을 가지고 옵니다.
	$usr_last_pay_row = get_last_payment('l');
	$user_last_edate = $usr_last_pay_row['edate'];
	$user_last_edate = substr($user_last_edate,0,10);

	$user_regdate = get_user_info('r_date');
	$user_regdate = substr($user_regdate,0,10);
	$user_regdate = fn_edate($user_regdate, 1);

	$now_date = date('Y-m-d');
	/*
	echo "유료 서비스 기간 : " . $user_last_edate . "<br/>";
	echo "무료 서비스 기간 : " . $user_regdate . "<br/>";
	echo "오늘 날짜 : " . $now_date . "<br/>";
	*/
	
	
	$login_chk = false;
	$login_chk1 = false;
	$login_chk2 = false;



	// 무료기간이 있는지 확인

	if($user_regdate>=$now_date){
		//echo "무료기간이 남았듬<br/>";
		$login_chk1 = false;
	}else{
		//echo "무료기간이 끝났듬<br/>";
		$login_chk1 = true;

		
	}
	
	

	if($user_last_edate>=$now_date){
		//echo "유료기간이 남았듬<br/>";
		$login_chk2 = false;
	}else{
		//echo "유료기간이 끝났듬<br/>";
		$login_chk2 = true;	
	}

	if($login_chk1==true && $login_chk2==true){
		$login_chk = true;

		foreach($_no_pay_page as $keys => $values){
			if($_SERVER['PHP_SELF'] == $values){
				$login_chk = false;
			}
		}

	}else{
		$login_chk = false;
	}

	if($_SESSION[member][id]!=""){	// 관리자는 결제 대상이 아닙따!
		$login_chk = false;
	}
	//echo $_SESSION[member][id];
	//echo "login_chk : ".$login_chk;
	/*
	if($login_chk==true){
?>
	<script type="text/javascript">
		
		var block_id = "<?=$login_chk?>";
		if(block_id=="1"){
			alert("결제가 필요합니다.");
			location.href="/preference/payment.php";
		}else{

		}
		
	</script>
<?
	}
	*/


	if($_SESSION[member][idx]!=""){	// 관리자일 경우에는 권한을 체크해볼까?

		// 현재 페이지가 권한이 필요한 페이지인지 확인해보자!
		$_tmp_now_url = $_SERVER['PHP_SELF'];
		//echo "tmp_now_url : " . $_tmp_now_url . "<br/>";
		
		$_tmp_chk_bool = false;
		$_tmp_chk_bool_num = "";

		foreach($_m_grant_url as $key => $value){
			if($_tmp_now_url == $value){
				$_tmp_chk_bool_num = $key;
			}

		}

		

		//echo $_tmp_chk_bool_num ."<br/>";

		if($_tmp_chk_bool_num){		// 해당 페이지가 권한이 필요한 페이지일 경우에...

			$_tmp_chk_bool = true;	// 일단 권한이 필요하니 막고 보자
	
			$_tmp_sesseion_g_chmod = $_SESSION[member][chmods];
			$_tmp_sesseion_g_chmod = substr($_tmp_sesseion_g_chmod,1,sizeof($_tmp_sesseion_g_chmod)-2);
			$_tmp_ses_arr_chmod = explode("||",$_tmp_sesseion_g_chmod);
			foreach($_tmp_ses_arr_chmod as $key => $value){

				if($_tmp_chk_bool_num == $value){	// 권한이 있을 때는 체크할 필요가 없음
					$_tmp_chk_bool = false;
				}

			}

			if($_tmp_chk_bool){	// 권한이 없으면 팅기게 하자!!!
			?>
				<script type="text/javascript">					
					alert("권한이 없습니다.");
					history.go(-1);
				</script>
			<?
			}

		}
	
	}
// SMTP
// lib/mailer.lib.php 에서 사용
define('G5_SMTP', '127.0.0.1');
?>