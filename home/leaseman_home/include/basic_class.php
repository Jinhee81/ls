<?
class dbConnect {
	var $db_host, $db_name, $db_user, $db_pwd, $db_conn;

	function dbConnect ( $db_host, $db_name, $db_user, $db_pwd) {
		$this->db_host		= $db_host;
		$this->db_name		= $db_name;
		$this->db_user		= $db_user;
		$this->db_pwd		= $db_pwd;

		$this->db_conn = @mysql_connect( $this->db_host, $this->db_user, $this->db_pwd) or die("데이타 베이스에 접속이 불가능합니다.");
		@mysql_select_db( $this->db_name, $this->db_conn);
	}
	
	function dbout(){
		mysql_close($this->db_conn);
	}

	function result ( $sql ) {
		$sql				= trim( $sql );
		$result			= @mysql_query( $sql, $this->db_conn ) or die($sql);
		return $result;
	}

	function select ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		//echo $sql;
		$result			= $this->result( $sql );
		return $result;
	}

	function select_ ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		echo $sql;
		$result			= $this->result( $sql );
		return $result;
	}

	function select_recommend ( $table, $where, $field = "*" ) {
		$sql				= "Select $field , (select count(idx) from TBL_recommend where data_idx = A.idx) as recommend_cnt, (select corp_name from cs_member where userid = A.category) as corp_name, (select count(idx) from cs_bbs_coment where link = A.idx) as coment_cnt from $table A $where";
		$result			= $this->result( $sql );
		return $result;
	}

    function selectSub ( $table, $sub, $where, $field = "A.*" ) {
		$sql				= "Select $field ,$sub from $table A $where";
		$result			= $this->result( $sql );
		return $result;
	}

    function selectJoin ( $table, $sub, $where, $field = "A.*" ) {
        $sql				= "Select $field ,$sub from $table A $where";
		$result			= $this->result( $sql );
		return $result;
    }

    function coupon_select ( $table, $where, $field = "*, issue_date+INTERVAL 1 MONTH AS max_day " ) {
		$sql				= "Select $field from $table $where";
		$result			= $this->result( $sql );
		return $result;
	}

	function myquestion_select ( $table, $where, $field = "*, (select count(idx)-1 FROM `cs_bbs_data` where ref=A.ref) as re_cnt " ) {
		$sql				= "Select $field from $table A $where";
		$result			= $this->result( $sql );
		return $result;
	}

	function object ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		$result			= $this->result( $sql );
		$row			= @mysql_fetch_object($result);
		return $row;
	}

	function row ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		$result			= $this->result( $sql );
		$row			= @mysql_fetch_row($result);
		return $row;
	}

	function sum ( $table, $where, $field = "*" ) {
		$sql				= "Select sum($field) from $table $where";
		$result			= $this->result( $sql );
		$row			=  @mysql_fetch_row($result);
		if( $row[0] ) { return $row[0]; } else { return 0;}
	}

	function cnt ( $table, $where, $field = "idx") {
		$sql				= "Select count($field) from $table $where";
		$result			= $this->result( $sql );
		$row			=  @mysql_fetch_row($result);
		if( $row[0] ) { return $row[0]; } else { return 0;}
	}

    function cnt2 ( $table, $where) {
		$sql				= "Select count(idx_C) from $table $where";
		$result			= $this->result( $sql );
		$row			=  @mysql_fetch_row($result);
		if( $row[0] ) { return $row[0]; } else { return 0;}
	}

    function cnt3 ( $table, $where) {
		$sql				= "Select count(A.idx) from $table $where";
        $result			= $this->result( $sql );
		$row			=  @mysql_fetch_row($result);
		if( $row[0] ) { return $row[0]; } else { return 0;}
	}

	function cnt4 ( $table, $where) {
		$sql				= "Select count(a.idx) from $table $where";
        $result			= $this->result( $sql );
		$row			=  @mysql_fetch_row($result);
		if( $row[0] ) { return $row[0]; } else { return 0;}
	}

	function insert ( $table, $data ) {
		$sql				= "insert into $table set $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function update ( $table, $data ) {
		$sql				= "update $table set $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}
	
	function delete ( $table, $data ) {
		$sql				= "delete from $table $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}
	
	function dropTable ( $data ) {
		$sql				= "drop table $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function createTable ( $data ) {
		$sql				= "create table $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function stripSlash ( $str ) {
		$str				= trim( $str );
		$str				= stripslashes( $str );
		return $str;
	}

	function addSlash ( $str ) {
		$str				= trim( $str );
		$str				= addslashes( $str );
		if(empty( $str )) {
			$str			= "NULL";
		}
		return $str;
	}
}

class tools {

	// 엔코드
	function encode($data) {
		$data = str_replace("&","&_&",$data); //서버의 safe mode 시 링크오류해결
		return base64_encode($data)."||";
	}
	function check_bytes($num)
	{
		$btail	= "bytes";
		$ktail	= "K";
		if($num>=1024&&$num<1048576)
		{
			$this_num = $num/1024;
			$namuji   = $num%1024;
		}
		else if($num>=1024&&$num>=1048576)
		{
			$this_num = $num/1048576;
			$namuji   = $num%1048576;
			if($namuji>=1024)
			{
				$namuji = $namuji/1024;
				$btail  = "K";
			}
			$ktail="M";
		}
		else $this_num=$num;
		echo $this->Nformat($this_num,0)."&nbsp;".$ktail."&nbsp;&nbsp;";
		if($namuji>0) echo $this->Nformat($namuji,0)." ".$btail;
	}
	function Nformat($value,$sort)
	{
		echo number_format($value,$sort);
		return;
	}
	// 디코드
	function decode($data){
		$vars=explode("&",base64_decode(str_replace("||","",$data)));
		$vars_num=count($vars);
		for($i=0;$i<$vars_num;$i++) {
			$elements=explode("=",$vars[$i]);
			if($elements[0]=='search_order') $var[$elements[0]]=urldecode($elements[1]);
			else $var[$elements[0]]=$elements[1];
		}
		return $var;
	}
	
	// 문자열 자르는 부분
	function strCut($str, $len, $checkmb=false, $tail='..') { 
		/** 
		* UTF-8 Format 
		* 0xxxxxxx = ASCII, 110xxxxx 10xxxxxx or 1110xxxx 10xxxxxx 10xxxxxx 
		* latin, greek, cyrillic, coptic, armenian, hebrew, arab characters consist of 2bytes 
		* BMP(Basic Mulitilingual Plane) including Hangul, Japanese consist of 3bytes 
		**/
		preg_match_all('/[\xE0-\xFF][\x80-\xFF]{2}|./', $str, $match); // target for BMP 
		$m = $match[0]; 
		$slen = strlen($str); // length of source string 
		$tlen = strlen($tail); // length of tail string 
		$mlen = count($m); // length of matched characters 
		if ($slen <= $len) return $str; 
		if (!$checkmb && $mlen <= $len) return $str; 
		$ret = array(); 
		$count = 0; 
		for ($i=0; $i < $len; $i++) { 
			$count += ($checkmb && strlen($m[$i]) > 1)?2:1; 
			if ($count + $tlen > $len) break; 
			$ret[] = $m[$i]; 
		} 
		return join('', $ret).$tail; 
	}


	
	// HTML 출력
	function strHtml($str) {
		$str = trim($str);
		$str = stripslashes($str);
		return $str;
	}

	// 문자열 HTML BR 형태 출력
	function strHtmlBr($str) {
		$str = trim($str);
		$str = stripslashes($str);
		$str = str_replace("\n","<br>", $str);
		return $str;
	}

	// 문자열 TEXT 형태 출력
	function strHtmlNo($str) {
		$str = trim($str);
		$str = htmlspecialchars($str);
		$str = stripslashes($str);
		$str = str_replace("\n","<br>", $str);
		return $str;
	}
	
	// 문자열 TEXT 형태 출력
	function strHtmlNoBr($str) {
		$str = trim($str);
		$str = htmlspecialchars($str);
		$str = stripslashes($str);
		return $str;
	}

	// 날자출력 형태 
	function strDateCut($str, $chk = 1) {
		if( $chk==1 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$str	=	$year."/".$mon."/".$day;
		} else if( $chk==2 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$time	=	substr($str,11,2);
			$minu	=	substr($str,14,2);
			$str	=	$year."/".$mon."/".$day." ".$time.":".$minu;
		} else if( $chk==3 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$str	=	$year."-".$mon."-".$day;
		} else if( $chk==4 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$time	=	substr($str,11,2);
			$minu	=	substr($str,14,2);
			$str	=	$year."-".$mon."-".$day." ".$time.":".$minu;
		} else if( $chk==5 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$str	=	$year."년 ".$mon."월 ".$day."일";
		} else if( $chk==6) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$time	=	substr($str,11,2);
			$minu	=	substr($str,14,2);
			$str	=	$year."년 ".$mon."월 ".$day."일 ".$time."시 ".$minu."분";
		}
		return $str;
	}
	// 날자출력 형태 2
	function strDateCut2($str, $chk = 1) {
		if( $chk==1 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$str	=	$year.".".$mon.".".$day;
		} else if( $chk==2 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$time	=	substr($str,11,2);
			$minu	=	substr($str,14,2);
			$str	=	$year."/".$mon."/".$day." ".$time.":".$minu;
		} else if( $chk==3 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$str	=	$year."-".$mon."-".$day;
		} else if( $chk==4 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$time	=	substr($str,11,2);
			$minu	=	substr($str,14,2);
			$str	=	$year."-".$mon."-".$day." ".$time.":".$minu;
		} else if( $chk==5 ) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$str	=	$year."년 ".$mon."월 ".$day."일";
		} else if( $chk==6) {
			$year	=	substr($str,0,4);
			$mon	=	substr($str,5,2);
			$day	=	substr($str,8,2);
			$time	=	substr($str,11,2);
			$minu	=	substr($str,14,2);
			$str	=	$year."년 ".$mon."월 ".$day."일 ".$time."시 ".$minu."분";
		}
		return $str;
	}
	
	// 숫자로 된 값을 요일로 변환한다. (0:월요일, 1:화요일, 6:일요일)
	function strDateWeek($chk) {
		if( $chk==0 ) {
			$str="월요일";
		} else if( $chk==1 ) {
			$str="화요일";
		} else if( $chk==2 ) {
			$str="수요일";
		} else if( $chk==3 ) {
			$str="목요일";
		} else if( $chk==4 ) {
			$str="금요일";
		} else if( $chk==5 ) {
			$str="토요일";
		} else if( $chk==6) {
			$str="일요일";
		}
		return $str;
	}
	
	# E-MAIL 주소가 정확한 것인지 검사하는 함수
	#
	# eregi - 정규 표현식을 이용한 검사 (대소문자 무시)
	#         http://www.php.net/manual/function.eregi.php
	# gethostbynamel - 호스트 이름으로 ip 를 얻어옴
	#          http://www.php.net/manual/function.gethostbynamel.php
	# checkdnsrr - 인터넷 호스트 네임이나 IP 어드레스에 대응되는 DNS 레코드를 체크함
	#          http://www.php.net/manual/function.checkdnsrr.php
	function chkMail($email,$hchk=0) {
		$url = trim($email);
		if($hchk) {
			$host = explode("@",$url);
			if(eregi("^[\xA1-\xFEa-z0-9_-]+@[\xA1-\xFEa-z0-9_-]+\.[a-z0-9._-]+$", $url)) {
				if(checkdnsrr($host[1],"MX") || gethostbynamel($host[1])) return $url;  else return false;
			}
		} else {
			if(eregi("^[\xA1-\xFEa-z0-9_-]+@[\xA1-\xFEa-z0-9_-]+\.[a-z0-9._-]+$", $url)) return $url;  else return false;
		}
	}
	// 주민등록번호진위여부 확인 함수
	function chkJumin($resno1,$resno2) { 
		$resno = $resno1.$resno2;
		$len = strlen($resno); 
		if ($len <> 13) return false;
		if (!ereg('^[[:digit:]]{6}[1-4][[:digit:]]{6}$', $resno)) return false; 
		$birthYear = ('2' >= $resno[6]) ? '19' : '20'; 
		$birthYear += substr($resno, 0, 2); 
		$birthMonth = substr($resno, 2, 2); 
		$birthDate = substr($resno, 4, 2); 
		if (!checkdate($birthMonth, $birthDate, $birthYear)) return false; 
		for ($i = 0; $i < 13; $i++) $buf[$i] = (int) $resno[$i]; 
		$multipliers = array(2,3,4,5,6,7,8,9,2,3,4,5); 
		for ($i = $sum = 0; $i < 12; $i++) $sum += ($buf[$i] *= $multipliers[$i]); 
		if ((11 - ($sum % 11)) % 10 != $buf[12]) return false; 
		return true; 
	} 

	// 사업자등록번호 체크 함수
	function chkCompany($reginum) { 
		$weight = '137137135';
		$len = strlen($reginum); 
		$sum = 0; 
		if ($len <> 10) return false;
		for ($i = 0; $i < 9; $i++) $sum = $sum + (substr($reginum,$i,1)*substr($weight,$i,1)); 
		$sum = $sum + ((substr($reginum,8,1)*5)/10); 
		$rst = $sum%10; 
		if ($rst == 0) $result = 0;
		else $result = 10 - $rst;
		$saub = substr($reginum,9,1); 
		if ($result <> $saub) return false;
		return true; 
	} 

	# 문자열에 한글이 포함되어 있는지 검사하는 함수
	function chkHan($str) {
		# 특정 문자가 한글의 범위내(0xA1A1 - 0xFEFE)에 있는지 검사
		$strCnt=0;
		while( strlen($str) >= $strCnt) {
			$char = ord($str[$strCnt]);
			if($char >= 0xa1 && $char <= 0xfe) return true;
			$strCnt++;
		}
	}

	// 문자열 체크(숫자)
	function chkDigit($str) {
		if(ereg("^[1-9]+[0-9]*$",$str))  return true;
		else return false;
	}

	// 문자열 체크(알파)
	function chkAlpha($str) {
		if(ereg("^[a-zA-Z]+[a-zA-Z]*$",$str))  return true;
		else return false;
	}

	// 문자열 체크(알파+숫자)		
	function chkAlnum($str) {
		if(ereg("^[1-9a-zA-Z]+[0-9a-zA-Z]*$",$str))  return true;
		else return false;
	}

	// 문자열 체크(알파+숫자+특수문자)		
	function chkAlnumAll($str) {
		if(ereg("^[1-9a-zA-Z_-]+[0-9a-zA-Z_-]*$",$str))  return true;
		else return false;
	}

	// 메세지 출력
	function msg($msg) {
		echo "<script language='javascript'> alert('$msg'); </script>";
	}

	// 메세지 출력후 BACK
	function errMsg($msg) {
		echo "<script language='javascript'> alert('$msg'); history.back(); </script>";
		exit();
	}

	// 메세지 출력후 이동하는 자바스크립트
	function alertJavaGo($msg,$url) {
		echo "<script language='javascript'> alert('$msg'); location.replace('$url'); </script>";
		exit();
	}

	// 메세지 출력후 이동하는 메타테그
	function alertMetaGo($msg,$url) {
		echo "<script language='javascript'> alert('$msg'); </script>"; 
		echo "<meta http-equiv='refresh' content='0;url=$url'>";
		exit();
	}
	
	// 메타태그로 바로 가기
	function metaGo($url) {
		echo "<meta http-equiv='refresh' content='0;url=$url'>";
		exit();
	}

	// 자바스크립트로 바로 가기
	function javaGo($url) {
		echo "<script language='javascript'> location.href='$url'; </script>";
		exit();
	}
	
	// 창을 닫기
	function winClose() { 
		echo "<script language='javascript'> window.close(); </script>";
		exit();
	}

	// 메세지 출력후 창을 닫기
	function msgClose($msg) { 
		echo "<script language='javascript'> alert('$msg'); window.close(); </script>";
		exit();
	}


	// 창을 닫고 가는 함수
	function javaGoClose($url) { 
		echo "<script language='javascript'> opener.location.replace('$url'); self.close(); </script>";
		exit();
	}
	
	// 프레임으로 된 경우 상위 프레임으로 가는 함수
	function javaGoTop($url) { 
		echo "<script language='javascript'> parent.frames.top.location.replace('$url'); </script>";
		exit();
	}

	// 토큰 => query 변환
	function toQuery( $str ) {
		$str_array = explode( "|", $str );
		$return = "";
		
		if( sizeof($str_array)>0 ) {
			for( $i=0; $i<sizeof($str_array); $i++ ) {
				if($str_array[$i]!="") {
					if( $i!=0 ) $return .= ",";
					$return .= sprintf("'%s'", $str_array[$i]);
				}
			}
		}
		return $return;
	}

	// 관리자 메뉴 체크
	function adminAccess( $memu, $admin_idx ) {
		global $db;
		$admin = $db->object("admin_member", "where idx='".$admin_idx."'", "idx, menu_auth");
		if( $admin->idx ) {
			$menu_auth = $admin->menu_auth;
			$menu_auth_array = explode( "|", $menu_auth );

			// 전체 선택시
			if( in_array(strval("000"), $menu_auth_array) ) {
				return true;
			}

			if( in_array(strval($memu), $menu_auth_array) ) {
				return true;
			}
			return false;
		}
	}

	// 체크박스 체크
	function fnSelected( $val1, $val2) {
		if( $val1==$val2 ) {
			return "selected";
		} else {
			return "";
		}
	}

	// 라디오 버튼 체크
	function fnChecked( $val1, $val2) {
		if( $val1==$val2 ) {
			return "checked";
		} else {
			return "";
		}
	}

}


//injection, XSS 방지
function fn_Injection($strParam){
	if($strParam == ""){
		return "";
	}
	else{
		$strParam = str_replace("'", "''", $strParam);
		/*
		$strParam = str_replace("<", "&lt", $strParam);
		$strParam = str_replace(">", "&gt", $strParam);
		*/
		
		return $strParam;
	}
}

function fn_Rejection($strParam){
	if($strParam == ""){
		return "";
	}
	else{
		$strParam = str_replace('"', '&quot;', $strParam);
		$strParam = str_replace("'", "&#039;", $strParam);
		/*
		$strParam = str_replace("<", "&lt", $strParam);
		$strParam = str_replace(">", "&gt", $strParam);
		*/
		
		return $strParam;
	}
}

function fn_content($strParam){
	if($strParam == ""){
		return "";
	}
	else{
		$strParam = str_replace("'", "\'", $strParam);
		/*
		$strParam = str_replace("<", "&lt", $strParam);
		$strParam = str_replace(">", "&gt", $strParam);
		*/
		
		return $strParam;
	}
}

//post,get
function fn_GetParam($ParamName){
	$PName = $_POST[$ParamName];
	if($PName == ""){
		$PName = $_GET[$ParamName];
	}
	
	return fn_Injection($PName);
}

						function get_img78($file_name, $width, $height, $contents, $filepath) {

							if ($height > 0) 
							{
							$hstr = " height='".$height."' ";
							}
							if ($width > 0) 
							{
							$wstr = " width='".$width."' ";
							}

							if ($file_name) {
								$imgs = "<img src='".$filepath."/".$file_name."' style='height:78px;' >";
							} else {
								
								$cnt = preg_match_all("/<(?i)IMG[^>]*src=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/", $contents, $output);

								if ($cnt > 0) {
									
									$imgs = "<img src='".$output[1][0]."' style='height:78px;' >";
									
								}
							}
							return $imgs;
						}

						function get_img182($file_name, $width, $height, $contents, $filepath) {

							if ($height > 0) 
							{
							$hstr = " height='".$height."' ";
							}
							if ($width > 0) 
							{
							$wstr = " width='".$width."' ";
							}

							if ($file_name) {

								//$imgs = "<img src='".$filepath."/thumb182_".$file_name."' $wstr $hstr>";
								
								if(file_exists($_SERVER['DOCUMENT_ROOT'].$filepath."/thumb182_".$file_name) ){
									$imgs = "<img src='".$filepath."/thumb182_".$file_name."' $wstr $hstr>";
								}else{
									$imgs="<img src='../img/main/atnnewslogo.jpg' width='".$width."' height='".$height."'>";
								}
								

							} else {
								
								$cnt = preg_match_all("/<(?i)IMG[^>]*src=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/", $contents, $output);

								if ($cnt > 0) {
									
									$imgs = "<img src='".$output[1][0]."'  $wstr $hstr >";
									
								}


								if($output[1][0]==""){
									$imgs="<img src='../img/main/atnnewslogo.jpg' width='".$width."' height='".$height."'>";
								}
							}
							return $imgs;
						}

						function get_img250($file_name, $width, $height, $contents, $filepath) {

							if ($height > 0) 
							{
							$hstr = " height='".$height."' ";
							}
							if ($width > 0) 
							{
							$wstr = " width='".$width."' ";
							}

							if ($file_name) {
								$imgs = "<img src='".$filepath."/thumb250_".$file_name."' $wstr $hstr>";
							} else {
								
								$cnt = preg_match_all("/<(?i)IMG[^>]*src=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/", $contents, $output);

								if ($cnt > 0) {
									
									$imgs = "<img src='".$output[1][0]."'  $wstr $hstr >";
									
								}
							}
							return $imgs;
						}


						function get_img($file_name, $width, $height, $contents, $filepath) {

							if ($height > 0) 
							{
							$hstr = " height='".$height."' ";
							}
							if ($width > 0) 
							{
							$wstr = " width='".$width."' ";
							}

							if ($file_name) {
								$imgs = "<img src='".$filepath."/".$file_name."' $wstr $hstr>";
							} else {
								
								$cnt = preg_match_all("/<(?i)IMG[^>]*src=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/", $contents, $output);

								if ($cnt > 0) {
									
									$imgs = "<img src='".$output[1][0]."'  $wstr $hstr >";
									
								}
							}
							return $imgs;
						}

						function get_img_xml($file_name, $width, $height, $contents, $filepath) {

							if ($height > 0) 
							{
							$hstr = " height='".$height."' ";
							}
							if ($width > 0) 
							{
							$wstr = " width='".$width."' ";
							}

							if ($file_name) {
								$imgs = "http://dynews1.com/".$filepath."/".$file_name;
							} else {

								$cnt = preg_match_all('@<img\s[^>]*src\s*=\s*(["\'])?([^\s>]+?)\1@i',$contents,$output); 

								//$cnt = preg_match_all('/<img src=\"(.+?)\"/i',$contents,$output); 
								if ($cnt > 0) {
									$j = 0;
									for($i = 0; $i < 1; $i ++) {
									$cols[$j][] = str_replace('""', '"', ($output[2][$i] != '') ? $output[2][$i] : $output[4][$i]);

									if($output[6][$i] != '')
									$j ++;
										$imgs = $cols[0][$i];
										if(substr($imgs, 0, 4) != "http")
											$imgs = "http://dynews1.com/".str_replace("%2F", "/", str_replace("+", "%20", $imgs));
										else
											$imgs = "http://dynews1.com/".str_replace("%2F", "/", str_replace("+", "%20", substr($imgs, 23, strlen($imgs))));
									}
								}
							}
							return $imgs;
						}

						function get_img2($file_name, $width, $height, $contents, $filepath) {

							if ($height > 0) 
							{
							$hstr = " height='".$height."' ";
							}
							if ($width > 0) 
							{
							$wstr = " width='".$width."' ";
							}
							
							if ($file_name) {
								$imgs = "<img src='".$filepath."/".$file_name."' $wstr $hstr>";
							} else {
								//echo $contents;
								$cnt = preg_match('@<img\s[^>]*src\s*=\s*(["\'])?([^\s>]+?)\1@i',$contents,$output); 

								echo $cnt;

								//$cnt = preg_match_all('/<img src=\"(.+?)\"/i',$contents,$output); 
								if ($cnt > 0) {
									$j = 0;
									for($i = 0; $i < 1; $i ++) {
									$cols[$j][] = str_replace('""', '"', ($output[2][$i] != '') ? $output[2][$i] : $output[4][$i]);

									if($output[6][$i] != '')
									$j ++;
										$imgs = "<img src='".$cols[0][$i]."'  $wstr $hstr >";
									}
								}
							}
							return $imgs;
						}

						function get_img_test($file_name, $width, $height, $contents, $filepath) {

							if ($height > 0) 
							{
							$hstr = " height='".$height."' ";
							}
							if ($width > 0) 
							{
							$wstr = " width='".$width."' ";
							}
					
							if ($file_name) {
								$imgs = "<img src='".$filepath."/".$file_name."' $wstr $hstr>";
							} else {

								
								//$contents = mb_convert_encoding($contents, "EUC-KR", "UTF-8");
								$cnt = preg_match_all('@<img\s[^>]*src\s*=\s*(["\'])?([^\s>]+?)\1@i',$contents,$output); 

								

								if ($cnt > 0) {
									$j = 0;
									for($i = 0; $i < 1; $i ++) {
									$cols[$j][] = str_replace('""', '"', ($output[2][$i] != '') ? $output[2][$i] : $output[4][$i]);

									if($output[6][$i] != '')
									$j ++;
										$imgs = "<img src='".$cols[0][$i]."'  $wstr $hstr >";
									}
								}
							}
							return $imgs;
						}

						function get_img3($file_name, $width, $height, $contents, $filepath) {

							if ($height > 0) 
							{
							$hstr = " height='".$height."' ";
							}
							if ($width > 0) 
							{
							$wstr = " width='".$width."' ";
							}

							if ($file_name) {
								$imgs = "<img src='".$filepath."/".$file_name."' $wstr $hstr>";
							} else {

								$cnt = preg_match_all('@<img\s[^>]*src\s*=\s*(["\'])([^\s>]+?)\1@i',$contents,$output); 

								echo $cnt;

								//$cnt = preg_match_all('/<img src=\"(.+?)\"/i',$contents,$output); 
								if ($cnt > 0) {
									$j = 0;
									for($i = 0; $i < 1; $i ++) {
									$cols[$j][] = str_replace('""', '"', ($output[2][$i] != '') ? $output[2][$i] : $output[4][$i]);

									if($output[6][$i] != '')
									$j ++;
										$imgs = "<img src='".$cols[0][$i]."'  $wstr $hstr >".$cols[0][$i];
									}
								}
							}
							return $imgs;
						}


    function cut_str($string,$cut_size=0,$tail = '...') {
        if($cut_size<1 || !$string) return $string;

        $chars = Array(12, 4, 3, 5, 7, 7, 11, 8, 4, 5, 5, 6, 6, 4, 6, 4, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 4, 4, 8, 6, 8, 6, 10, 8, 8, 9, 8, 8, 7, 9, 8, 3, 6, 7, 7, 11, 8, 9, 8, 9, 8, 8, 7, 8, 8, 10, 8, 8, 8, 6, 11, 6, 6, 6, 4, 7, 7, 7, 7, 7, 3, 7, 7, 3, 3, 6, 3, 9, 7, 7, 7, 7, 4, 7, 3, 7, 6, 10, 6, 6, 7, 6, 6, 6, 9);
        $max_width = $cut_size*$chars[0]/2;
        $char_width = 0;

        $string_length = strlen($string);
        $char_count = 0;

        $idx = 0;
        while($idx < $string_length && $char_count < $cut_size && $char_width <= $max_width) {
            $c = ord(substr($string, $idx,1));
            $char_count++;
            if($c<128) {
                $char_width += (int)$chars[$c-32];
                $idx++;
            }
            else if (191<$c && $c < 224) {
			          $char_width += $chars[4];
			          $idx += 2;
		        }
            else {
                $char_width += $chars[0];
                $idx += 3;
            }
        }
        $output = substr($string,0,$idx);
        if(strlen($output)<$string_length) $output .= $tail;
        return $output;
    }



	function fetch_url($theurl) {
		$url_parsed = parse_url($theurl);
		$host = $url_parsed["host"];
		$port = $url_parsed["port"];
		if($port==0) $port = 80;
		$the_path = $url_parsed["path"];

		if(empty($the_path)) $the_path = "/";
		if(empty($host)) return false;

		if($url_parsed["query"] != "") $the_path .= "?".$url_parsed["query"];
		$out = "GET ".$the_path." HTTP/1.0\r\nHost: ".$host."\r\n\r\nUser-Agent: Mozilla/4.0 \r\n";
		$fp = fsockopen($host, $port, $errno, $errstr, 30);
		usleep(50);
		if($fp) {
		socket_set_timeout($fp, 30);
		fwrite($fp, $out);
		$body = false;
		while(!feof($fp)) {
		$buffer = fgets($fp, 128);
		if($body) $content .= $buffer;
		if($buffer=="\r\n") $body = true;
		}
		fclose($fp);
		}else {
		return false;
		}
		return $content;
	}

	function send_htmlmail($fromEmail, $fromName, $toEmail, $toName, $subject, $message){
	  $charset='utf-8'; // 문자셋 : UTF-8
	  $body = iconv('utf-8', 'euc-kr', $message);  //본문 내용 UTF-8화
	  $encoded_subject="=?".$charset."?B?".base64_encode($subject)."?=\n"; // 인코딩된 제목
	  $to= "\"=?".$charset."?B?".base64_encode($toName)."?=\" <".$toEmail.">" ; // 인코딩된 받는이
	  $from= "\"=?".$charset."?B?".base64_encode($fromName)."?=\" <".$fromEmail.">" ; // 인코딩된 보내는이

	  $headers="MIME-Version: 1.0\n".
	  "Content-Type: text/html; charset=euc-kr; format=flowed\n".
	//  "To: ". $to ."\n".
	  "From: ".$from."\n".
	  "Return-Path: ".$from."\n".
	  "urn:content-classes:message\n".
	  "Content-Transfer-Encoding: 8bit\n"; // 헤더 설정
	  //send the email
	  mail( $to, $encoded_subject, $body, $headers );
	  //if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
	}



?>
