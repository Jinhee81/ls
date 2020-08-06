<?
@session_start();
@header("Content-Type: text/html; charset=utf-8");


@extract($_GET);

@extract($_POST);

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

 //-------------------------------------------------------------------------------------------------
// DB 설정 파일을 읽어서 DB 를 연결한다.
$mysql_host = "localhost";
$mysql_user = "leaseman";
$mysql_pass = "leaseman!!22";
$mysql_db   = "leaseman";

$connect = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_select_db($mysql_db, $connect);
mysql_query("set names utf8");

	
include $_SERVER[DOCUMENT_ROOT]."/include/config.php"; 


function isSecureDomain() {
    return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
}

function isDotDomain() {
    return
        (substr($_SERVER['HTTP_HOST'], 0, 4) !== 'www.');
}

	
FUNCTION imageWaterMaking($ARGimagePath, $ARGwaterMakeSourceImage, $ARGimageQuality = 100){ 
                #####----- 이미지 정보 가져오기 -----##### 
                $getSourceImageInfo = GETIMAGESIZE($ARGimagePath); 
                #####----- 원본 이미지 검사 -----##### 
                if(!$getSourceImageInfo[0]){ 
                                return ARRAY(0, "!!! 원본 이미지가 존재하지 않습니다. !!!"); 
                } 
                $getwaterMakeSourceImageInfo = GETIMAGESIZE($ARGwaterMakeSourceImage); 
                #####----- 워터마크 이미지 검사 -----##### 
                if(!$getwaterMakeSourceImageInfo[0]){ 
                                return ARRAY(0, "!!! 워터마크 이미지가 존재하지 않습니다. !!!"); 
                } 
                 
                #####----- 원본 이미지 생성(로드) -----##### 
                switch($getSourceImageInfo[2]){ 
                                case 1 :        #####----- GIF 포맷 형식 -----##### 
                                                        $sourceImage = IMAGECREATEFROMGIF($ARGimagePath); 
                                                        break; 
                                case 2 :        #####----- JPG 포맷 형식 -----##### 
                                                        $sourceImage = IMAGECREATEFROMJPEG($ARGimagePath); 
                                                        break; 
                                case 3 :        #####----- PNG 포맷 형식 -----##### 
                                                        $sourceImage = IMAGECREATEFROMPNG($ARGimagePath); 
                                                        break; 
                                default :        #####----- GIF, JPG, PNG 포맷방식이 아닐경우 오류 값을 리턴 후 종료 -----##### 
                                                        return array(0, "!!! 원본이미지가 GIF, JPG, PNG 포맷 방식이 아니어서 이미지 정보를 읽어올 수 없습니다. !!!"); 
                } 
                 
                #####----- 워터마크 이미지 생성(로드) -----##### 
                switch($getwaterMakeSourceImageInfo[2]){ 
                                case 1 :        #####----- GIF 포맷 형식 -----##### 
                                                        $waterMakeSourceImage = IMAGECREATEFROMGIF($ARGwaterMakeSourceImage); 
                                                        break; 
                                case 2 :        #####----- JPG 포맷 형식 -----##### 
                                                        $waterMakeSourceImage = IMAGECREATEFROMJPEG($ARGwaterMakeSourceImage); 
                                                        break; 
                                case 3 :        #####----- PNG 포맷 형식 -----##### 
                                                        $waterMakeSourceImage = IMAGECREATEFROMPNG($ARGwaterMakeSourceImage); 
                                                        break; 
                                default :        #####----- GIF, JPG, PNG 포맷방식이 아닐경우 오류 값을 리턴 후 종료 -----##### 
                                                        return array(0, "!!! 워터마크이미지가 GIF, JPG, PNG 포맷 방식이 아니어서 이미지 정보를 읽어올 수 없습니다. !!!"); 
                } 
                 
                 
                #####----- 워터마크 위치 구하기(중앙에 워터마크 삽입) -----##### 
                $waterMakePositionWidth = ($getSourceImageInfo[0] - $getwaterMakeSourceImageInfo[0]) / 2; 
                $waterMakePositionHeight = ($getSourceImageInfo[1] - $getwaterMakeSourceImageInfo[1]) / 2; 
                 
                #####----- 이미지 그리기 -----##### 
                /** 
                 *        $save_image=ImageCreate($save_path_width_size, $save_path_height_size) 부분에 원본이미지로 부터 복사본을 그린다. 
                 *        $arg1                :                ImageCreateTrueColor 리턴 인자(붙여넣기 할 이미지) 
                 *        $arg2                :                ImageCreateFromXXX 리턴 인자(복사할 이미지) 
                 *        $arg3                :                붙여넣기 할 이미지의 X 시작점 
                 *        $arg4                :                붙여넣기 할 이미지의 Y 시작점 
                 *        $arg5                :                복사할 이미지의 X 시작점 
                 *        $arg6                :                복사할 이미지의 Y 시작점 
                 *        $arg7                :                붙여넣기 할 이미지의 X 끝점 
                 *        $arg8                :                붙여넣기 할 이미지의 Y 끝점 
                 *        $arg9                :                복사할 이미지의 X 끝점 
                 *        $arg10                :                복사할 이미지의 Y 끝점 
                 */ 
                IMAGECOPYRESIZED($sourceImage, $waterMakeSourceImage, $waterMakePositionWidth, $waterMakePositionHeight, 0, 0, ImageSX($waterMakeSourceImage), ImageSY($waterMakeSourceImage), ImageSX($waterMakeSourceImage), ImageSY($waterMakeSourceImage)); 
                 
                #####----- 이미지 저장 -----##### 
                switch($getSourceImageInfo[2]){ 
                                case 1 :        #####----- GIF 포맷 형식 -----##### 
                                                        if(IMAGEGIF($sourceImage, $ARGimagePath, $ARGimageQuality)){ 
                                                                        return ARRAY(1, "GIF 형식 워터마크 이미지가 처리 되었습니다."); 
                                                        }else{ 
                                                                        return ARRAY(0, "GIF 형식 워터마크 이미지가 처리 도중 오류가 발생했습니다."); 
                                                        } 
                                                        break; 
                                case 2 :        #####----- JPG 포맷 형식 -----##### 
                                                        if(IMAGEJPEG($sourceImage, $ARGimagePath, $ARGimageQuality)){ 
                                                                        return ARRAY(1, "JPG 형식 워터마크 이미지가 처리 되었습니다."); 
                                                        }else{ 
                                                                        return ARRAY(0, "JPG 형식 워터마크 이미지가 처리 도중 오류가 발생했습니다."); 
                                                        } 
                                                        break; 
                                case 3 :        #####----- PNG 포맷 형식 -----##### 
                                                        if(IMAGEPNG($sourceImage, $ARGimagePath, $ARGimageQuality)){ 
                                                                        return ARRAY(1, "PNG 형식 워터마크 이미지가 처리 되었습니다."); 
                                                        }else{ 
                                                                        return ARRAY(0, "PNG 형식 워터마크 이미지가 처리 도중 오류가 발생했습니다."); 
                                                        } 
                                                        break; 
                                default :        #####----- GIF, JPG, PNG 포맷방식이 아닐경우 오류 값을 리턴 후 종료 -----##### 
                                                        return ARRAY(0, "!!! 원본마크이미지가 GIF, JPG, PNG 포맷 방식이 아니어서 이미지 정보를 읽어올 수 없습니다. !!!"); 
                } 
                 
                 
} 
	
	
	
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
// 시작할때 마이크로 타임 구함
//-------------------------------------------------------------------------------------------------
//$start_time=getmicrotime();

// 현재 일자, 시간 구함
$curdate = date("Y-m-d", time());
$curtime = date("H:i:s", time());
$now     = $curdate . " " . $curtime;


//사용함수
function alert_msg($msg, $url="") {
    global $HTTP_REFERER, $g_dir, $g_homepage_index;

    if ($url == "")
    {
        $url = "history.go(-1)";
    }
    elseif ($url == "close"){
     $url = "window.close()";
    }

    else{
        $url = "document.location.href = '$url'";
    }

    if ($msg != "")
        echo "<script language='javascript'>alert('$msg');$url;</script>";
    else
        echo "<script language='javascript'>$url;</script>";
    exit;
}


// 파일의 확장자 검사
// check_file_ext("파일명", "허용확장자리스트 ;로 구분");
function check_file_ext($filename, $allow_ext)
{
	$filename = strtolower($filename);
	if ($filename == "") return true;
	$ext = get_file_ext($filename);
	$allow_ext = explode(";", $allow_ext);
	$sw_allow_ext = false;
	for ($i=0; $i<count($allow_ext); $i++)
    	if ($ext == $allow_ext[$i]) // 허용하는 확장자라면
    	{
        	$sw_allow_ext = true;
        	break;
        }
    return $sw_allow_ext;
}
function no_file_ext($filename)
{

	 $ext = explode(".", strtolower($filename)); 
	$chk = "Y";
	 $cnt = count($ext)-1; 
	  if($ext[$cnt] === ""){ 
		 if(@ereg($ext[$cnt-1], "php|php3|php4|htm|inc|html|xls|exe")){ 
		$chk = "N";
		 } 
	  } else if(@ereg($ext[$cnt], "php|php3|php4|htm|inc|html|xls|exe")){ 
		$chk = "N";
	  } 
	  
	 return $chk;
  }
//-------------------------------------------------------------------------------------------------
function upload_file($srcfile, $destfile, $dir)
{
	if ($destfile == "") return false;
    // 업로드 한후 , 퍼미션을 변경함
	@move_uploaded_file($srcfile, "$dir/$destfile");
	@chmod("$dir/$destfile", 0666);
	return true;
}
//-------------------------------------------------------------------------------------------------
function get_file_ext($filename)
{
	if ($filename == "") return "";
	$type = explode(".", $filename);
	$ext = strtolower($type[count($type)-1]);
	return $ext;
}
//-------------------------------------------------------------------------------------------------
// HTML 특수문자 변환 htmlspecialchars
function htmlspecialchars2($str)
{
    $trans = array("\"" => "&#034;", "'" => "&#039;", "<"=>"&#060;", ">"=>"&#062;");
    $str = strtr($str, $trans);
    return $str;
}
//----------------------------------------------------------------------------------------------------------------------------

// mailer
function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $charset="utf-8", $cc="", $bcc="") {
	// type : text=0, html=1, text+html=2

    $fname   = "=?$charset?B?" . base64_encode($fname) . "?=";
    //$subject = "=?$charset?B?" . base64_encode($subject) . "?=";
//	$subject = iconv("euc-kr","utf-8",$subject);
	$subject = "=?UTF-8?B?".base64_encode($subject)."?="."\r\n"; 

    $charset = ($charset != "") ? "charset=$charset" : "";

    $header  = "Return-Path: <$fmail>\n";
    $header .= "From: $fname <$fmail>\n";
    $header .= "Reply-To: <$fmail>\n";
    if ($cc)  $header .= "Cc: $cc\n";
    if ($bcc) $header .= "Bcc: $bcc\n";
    $header .= "MIME-Version: 1.0\n";
    $header .= "X-Mailer: esir mailer 0.9 (".$_SERVER["HTTP_HOST"].")\n";

    if ($file != "") {
        $boundary = uniqid("http://".$_SERVER["HTTP_HOST"]."/");

        $header .= "Content-type: MULTIPART/MIXED; BOUNDARY=\"$boundary\"\n";
        $header .= "--$boundary\n";
    }

	$header .= "Content-Type: TEXT/HTML; $charset\n";
    $header .= "Content-Transfer-Encoding: BASE64\n\n";
    $header .= chunk_split(base64_encode($content)) . "\n";

    @mail($to, $subject, "", $header);
}
//-------------------------------------------------------------------------------------------------------------------
//글자 자르기.
 function cutstr($str, $size)
 {
  $substr = substr($str, 0, $size*2);
  $multi_size = preg_match_all('/[\x80-\xff]/', $substr, $multi_chars);

  if($multi_size >0)
   $size = $size + intval($multi_size/3)-1;

  if(strlen($str)>$size)
  {
   $str = substr($str, 0, $size);
   $str = preg_replace('/(([\x80-\xff]{3})*?)([\x80-\xff]{0,2})$/', '$1', $str);
   $str .= '...';
  }

  return $str;
 }



function cutstr1($msg, $cut_size, $tail="") {
  if ($cut_size<=0) return $msg;

  // 계속이어쓰는 문자열을 자른다.
  $max_len = 70;
  if(strlen($msg) > $max_len)
    if(!eregi(" ", $msg))
      $msg = substr($msg,0,$max_len);

  for($i=0;$i<$cut_size;$i++)
    if(@ord($msg[$i])>127) $han++;
    else $eng++;

  $cut_size=$cut_size+(int)$han*0.6;

  //echo $cut_size; exit;
  $snow=1;
  for ($i=0;$i<strlen($msg);$i++) {
    if ($snow>$cut_size) { return $snowtmp.$tail;}
    if (ord($msg[$i])<=127) {
      $snowtmp.= $msg[$i];
      if ($snow%$cut_size==0) { return $snowtmp.$tail; }
    } else {
      if ($snow%$cut_size==0) { return $snowtmp.$tail; }
      $snowtmp.=$msg[$i].$msg[++$i];
      $snow++;
    }
    $snow++;
  }
  return $snowtmp;
}
//-------------------------------------------------------------------------------------------------
// 공란없이 이어지는 문자 자르기
function continue_cut_str($str, $len=80)
{
        $pattern = "[^ \n<>]{".$len."}";
    return eregi_replace($pattern, "\\0\n", $str);
}
//-------------------------------------------------------------------------------------------------
// 일자 시간 (mm-dd hh:ii) 표시
function fdatetime($dt) {
  $s = substr($dt,5,11);
  if($s=="00-00 00:00") $s = "&nbsp;";
  return $s;
}
//-------------------------------------------------------------------------------------------------

$mouseover = "class=mout onmouseout=this.className='mout' onmouseover=this.className='mover'";


//------------------------------------------------------------------------------------------------------------------------------
function gotourl($url) {
    echo "<meta http-equiv=\"refresh\" content=\"0;url=$url\">";
    exit;
}
//------------------------------------------------------------------------------------------------
function get_skin_dir($val)
{
    global $g_rel_dir;
    $result_array = array();

    $dirname = "$g_rel_dir/$val/";
    $handle = opendir($dirname);
    while ($file = readdir($handle)) {

        if($file == "."||$file == "..") {
            continue;
        }

        if (is_dir($dirname.$file)) {
            $result_array[] = $file;
        }
    }
    closedir($handle);
    sort($result_array);

    return $result_array;
}

		
			
function pagelisting($cur_page, $total_page, $n, $url) {
  $retValue = "<div id='btnpage'><ul>";
  if ($cur_page > 1) {
    $retValue .= "<li><a href='" . $url . "1'>&lt;&lt; 처음</a></li>";
    $retValue .= "<li> <a href='" . $url . ($cur_page-1) . "'>&lt; 이전</a></li>";
  } else {
    $retValue .= "<li><a href='" . $url . "1'>&lt;&lt; 처음</a></li>";
    $retValue .= "<li><a href='#'>&lt; 이전</a></li>";
  }
  $retValue .= "";
  $start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
  $end_page = $start_page + 9;
  if ($end_page >= $total_page) $end_page = $total_page;
  if ($total_page >= 1)
    for ($k=$start_page;$k<=$end_page;$k++)
      if ($cur_page != $k) $retValue .= " <li class='number'><a href='$url$k'>$k</a></li>";
      else $retValue .= " <li class='number'><a href='#' class='now'>$k</a></li>";
//  if ($total_page > $end_page) $retValue .= "<a href='" . $url . ($end_page+1) . "'>...</a> ";
  $retValue .= "";
  if ($cur_page < $total_page) {
    $retValue .= "<li><a href='$url" . ($cur_page+1) . "'>다음 &gt;</a></li>";
    $retValue .= "<li><a href='$url$total_page'>맨끝 &gt;&gt;</a></td>";
  } else {
    $retValue .= "<li><a href='#'>다음 &gt;</a></li>";
    $retValue .= "<li><a href='#'>맨끝 &gt;&gt;</a></li>";
  }
  $retValue .= "</ul></div>";
  return $retValue;
}
function apagelisting($cur_page, $total_page, $n, $url) {
  $retValue = "<div class='pagination' style='margin:0 auto;text-align:center'><ul>";
  if ($cur_page > 1) {
    $retValue .= "<li><a href='" . $url . "1'><<</a></li>";
    $retValue .= "<li><a href='" . $url . ($cur_page-1) . "'><</a></li>";
  } else {
    $retValue .= "<li><a href='" . $url . "1'><<</a></li>";
    $retValue .= "<li><a href='#'><</a></li>";
  }
  $retValue .= "";
  $start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
  //echo (int)(($cur_page - 1) / 10);
  $end_page = $start_page + 9;
  if ($end_page >= $total_page) $end_page = $total_page;
//  if ($start_page > 1) $retValue .= " <a href='" . $url . ($start_page-1) . "'>...</a> ";
  if ($total_page >= 1)
    for ($k=$start_page;$k<=$end_page;$k++)
      if ($cur_page != $k) $retValue .= " <li><a href='$url$k'>$k</a></li> ";
      else $retValue .= " <li class='active'><A href='#'>$k</a></li> ";
//  if ($total_page > $end_page) $retValue .= "<a href='" . $url . ($end_page+1) . "'>...</a> ";
  $retValue .= "";
  if ($cur_page < $total_page) {
    $retValue .= "<li><a href='$url" . ($cur_page+1) . "'>></a></li>";
    $retValue .= "<li><a href='$url$total_page'>>></a></li>";
  } else {
    $retValue .= "<li><a href='#'>></a></li>";
    $retValue .= "<li><a href='#'>>></a></li>";
  }
  $retValue .= "</ul></div>";
  return $retValue;
}


function ajaxlisting($cur_page, $total_page, $n, $url) {
	global $g_list_rows;
	$pbgn = $cur_page - (($cur_page-1) % $g_list_rows) ;
	$pend = $cur_page + 10 - (($cur_page-1) % 10) -1;

	$retValue = "<div class='paging'>";
	if ($pend > 10) {
	$intl=$pend-10;
		$retValue .= " <a href='javascript:javascript:product_page_it($intl)'><img src='/kor/images/common/btn_p_first.gif' alt='처음으로' /></a> ";
		$retValue .= " <a href='javascript:javascript:product_page_it(" . ($cur_page-1) . ")'><img src='/kor/images/common/btn_p_prev.gif' alt='이전으로' /></a> ";
		$retValue .= " <span>";
		$retValue .= " <a href='javascript:javascript:product_page_it(1)'>1</a>... ";
	} else {
		$retValue .= " <a href='#'><img src='/kor/images/common/btn_p_first.gif' alt='처음으로' /></a> ";
		if ($cur_page == 1) {
		$retValue .= " <a href='#'><img src='/kor/images/common/btn_p_prev.gif' alt='이전으로' /></a> ";
		} else {
		$retValue .= " <a href='javascript:product_page_it("  . ($cur_page-1).")'><img src='/kor/images/common/btn_p_prev.gif' alt='이전으로' /></a> ";
		}
		$retValue .= " <span>";
	}
	$start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
	$end_page = $start_page + 10-1;
	$intl=$pbgn;
	if ($end_page >= $total_page) $end_page = $total_page;
	if ($total_page >= 1)
	for ($k=$start_page;$k<=$end_page;$k++)
	if ($cur_page != $k) $retValue .= " <a href='javascript:product_page_it($k)'>$k</a> ";
	else $retValue .= " <strong>$k</strong> ";

	$intl = $pend+1;
	if ($intl < $total_page) {
		$retValue .= " ...<a href='javascript:product_page_it(".($total_page).")'>$total_page</a>";
		$retValue .= " </span>";
		$retValue .= " <a href='javascript:product_page_it("  . ($cur_page+1).")'><img src='/kor/images/common/btn_p_next.gif' alt='다음으로' /></a> ";
		$retValue .= " <a href='javascript:product_page_it("  . ($intl).")'><img src='/kor/images/common/btn_p_last.gif' alt='마지막으로' /></a> ";
	} else {
		$retValue .= "</span>";
		if ($cur_page == $total_page) {
		$retValue .= " <a href='#'><img src='/kor/images/common/btn_p_next.gif' alt='다음으로' /></a> ";
		} else {
		$retValue .= " <a href='javascript:product_page_it(".($cur_page+1).")'><img src='/kor/images/common/btn_p_next.gif' alt='다음으로' /></a> ";
		}
		$retValue .= " <a href='#'><img src='/kor/images/common/btn_p_last.gif' alt='마지막으로' /></a> ";
	}
	$retValue .= "</div>";
	return $retValue;
}




// 파일을 첨부함
function attach_file($filename, $file)
{
    $fp = fopen($file, "r");
    $tmpfile = array(
        "name" => $filename,
        "data" => fread($fp, filesize($file)));
    fclose($fp);
    return $tmpfile;
}


	function listNew($term, $reg_date1)
	{ 
		$sub_date=date("Y-m-d H:i:s",mktime(date('H')-$term,date('i'),date('s'),date('m'),date('d'),date('Y')));
	
//		if(date("Y-m-d H:i:s",$reg_date1 < $sub_date) 
		if($reg_date1 < $sub_date) 
		{
			$show=1;
		} else {
			$show=0;
		}
		
		return $show;
	}

function strcut_utf8($str, $len, $checkmb=false, $tail='...') { 
  // global $str,$len,$checkmb,$tail;
   preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match); 
   $m    = $match[0]; 
   $slen = strlen($str);  // length of source string 
   $tlen = strlen($tail); // length of tail string 
   $mlen = count($m);    // length of matched characters 
   if ($slen <= $len) 
	{return $str; }
   if (!$checkmb && $mlen <= $len) return $str; 
   
   $ret  = array(); 
   $count = 0; 
   
   for ($i=0; $i < $len; $i++) { 
  $count += ($checkmb && strlen($m[$i]) > 1)?2:1; 
  if ($count + $tlen > $len) break; 
  $ret[] = $m[$i]; 
   } 
   return join('', $ret).$tail; 
 } 

 


 

 function time2date($time) {
  $date=date("Y-m-d H:i:s", $time);
  return $date;
 } 
//2011-04-11 20:47:46 형태 의 날짜를 1302522466 형태의 timestamp 로 반환
function date2time($date) {
	$arg=explode(' ',$date); // 날짜 와 시간을 분리
	$ymd=explode('-',$arg[0]); // 날짜 부분
	$hms=explode(':',$arg[1]); // 시간 부분
	$time=mktime($hms[0],$hms[1],$hms[2],$ymd[1],$ymd[2],$ymd[0]);
	return $time;
}

/*================================================================================================*/
/*===================================== 파일 업로드 함수 ===========================================*/
function file_check($ok_filename,$ok_file,$path,$ftype){
	if($ok_filename=="" || $ok_file==""){
		return false;
	}else{
		//한글파일 파일명 대체

    $download=$path;
	$aa=date('YmdHms');
//	$check=explode(".",$ok_filename);

	$ext = substr(strrchr($ok_filename,"."),1);	 //확장자앞 .을 제거하기 위하여 substr()함수를 이용
	$ext = strtolower($ext);			 //확장자를 소문자로 변환

	$check1=$aa;
	$check2=strtolower($ext);

	$ok_filename=$check1.".".$check2;
	$attached=$ok_filename;
	if ($ftype == "I")
	{
		if($check2 !="gif" &&  $check2!="jpg" && $check2!="jpeg" && $check2 !="bmp"){
			echo"<script>alert('이미지 파일만 업로드할수있습니다.');
				  history.back(1);</script>";
				  exit;
		}
	} else 
	$attached=$ok_filename;
    $ok_filename=$download . $ok_filename;
        if (file_exists($ok_filename)) {    // 같은 파일 존재                
                $file_splited = split("\.", $attached, 2);  
                $i = 0;                                                          
                do {                                                             
                        $tmp_filename = $file_splited[0] . $i . "." . $file_splited[1];    
                        $tmp_filelocation = $download . $tmp_filename;           
                        $i++;                                                    
                } while (file_exists($tmp_filelocation));                        
                $ok_filename = $tmp_filelocation;                            
                $attached = $tmp_filename;                                       
        }             
	copy($ok_file, $ok_filename);
	unlink($ok_file);
	//GD2_make_thumb(20000,20000,str_replace("img_","thumb_",$path.$attached),$path.$attached);

	return $attached;
	}
}      //함수의 끝

function file_check_1($ok_filename,$ok_file,$path,$ftype, $addname = "", $addtitle = ""){
	if($ok_filename=="" || $ok_file==""){
		return false;
	}else{
		//한글파일 파일명 대체

    $download=$path;
	$aa=date('YmdHms');
//	$check=explode(".",$ok_filename);

	$ext = substr(strrchr($ok_filename,"."),1);	 //확장자앞 .을 제거하기 위하여 substr()함수를 이용
	$ext = strtolower($ext);			 //확장자를 소문자로 변환

	$check1=$aa;
	$check2=strtolower($ext);

	if ($addtitle) {
		$ok_filename=$addtitle.$addname. ".".$check2;
	} else {
		$ok_filename=$check1.$addname. ".".$check2;
	}
	$attached=$ok_filename;
	if ($ftype == "I")
	{
		if($check2 !="gif" &&  $check2!="jpg" && $check2!="jpeg" && $check2 !="bmp"){
			echo"<script>alert('이미지 파일만 업로드할수있습니다.');
				  history.back(1);</script>";
				  exit;
		}
	} else 
	$attached=$ok_filename;
    $ok_filename=$download . $ok_filename;
		if ($addtitle == "") {
			if (file_exists($ok_filename)) {    // 같은 파일 존재                
					$file_splited = split("\.", $attached, 2);  
					$i = 0;                                                          
					do {                                                             
							$tmp_filename = $file_splited[0] . $i . "." . $file_splited[1];    
							$tmp_filelocation = $download . $tmp_filename;           
							$i++;                                                    
					} while (file_exists($tmp_filelocation));                        
					$ok_filename = $tmp_filelocation;                            
					$attached = $tmp_filename;                                       
			}             
		}
	copy($ok_file, $ok_filename);
	unlink($ok_file);
	GD2_make_thumb(2000,2000,str_replace("img_","thumb_",$path.$attached),$path.$attached);

	return $attached;
	}
}      //함수의 끝
/*================================================================================================*/
/*===================================== 파일 업로드 함수 ===========================================*/
function file_check2($ok_filename,$ok_file,$path,$ftype){
	if($ok_filename=="" || $ok_file==""){
		return false;
	}else{
		//한글파일 파일명 대체

    $download=$path;
//	$aa=date('YmdHms');
	$check=explode(".",$ok_filename);
	
//	$check[0]="thumb_".$aa;
	$check[1]=strtolower($check[1]);

	$ok_filename=$check[0]."_l.".$check[1];
	$ok_filename2=$check[0]."_S.".$check[1];
	$attached=$ok_filename;
	if ($ftype == "I")
	{
		if($check[1] !="gif" &&  $check[1]!="jpg" && $check[1]!="jpeg" && $check[1] !="bmp"){
			echo"<script>alert('이미지 파일만 업로드할수있습니다.');
				  history.back(1);</script>";
				  exit;
		}
	} else 
	$attached=$ok_filename;
    $ok_filename=$download . $ok_filename;
        if (file_exists($ok_filename)) {    // 같은 파일 존재                
                $file_splited = split("\.", $attached, 2);  
                $i = 0;                                                          
                do {                                                             
                        $tmp_filename = $file_splited[0] . $i . "." . $file_splited[1];    
                        $tmp_filelocation = $download . $tmp_filename;           
                        $i++;                                                    
                } while (file_exists($tmp_filelocation));                        
                $ok_filename = $tmp_filelocation;                            
                $attached = $tmp_filename;                                       
        }             
	copy($ok_file, $ok_filename);
	unlink($ok_file);
	$ext = substr(strrchr($attached,"."),1);	//확장자앞 .을 제거하기 위하여 substr()함수를 이용
	$ext = strtolower($ext);					//확장자를 소문자로 변환
	$attached2 = substr(basename($attached, $ext),0,strlen(basename($attached, $ext))-1)."_s.".$ext;

	GD2_make_thumb(130,130,$path.$attached2,$path.$attached);
	return $attached."|||".$attached2;
	}
}      //함수의 끝
/*===================================== 파일 업로드 함수 ===========================================*/
/*================================================================================================*/
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function setBanner($title, $num)
	{	
		$sql = " select * from tbl_banner where idx='".$num."' ";
		$result = mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_array($result);
	?>
					<form name='frm<?=$row[idx]?>' action='/AdmMaster/ajax/front_banner_ok.php' target="hiddenFrame" method=post enctype="multipart/form-data" >
					<input type=hidden name='idx' value='<?=$row[idx]?>'>
					<tbody>
						<tr>
							<td><?=$title?></td>
							<td><? if ($row[bfile1] != "") { ?><a href="/data/banner/<?=$row[bfile1]?>" class="imgpop"><img src="/data/banner/<?=$row[bfile1]?>" style="max-height:100px;max-width:300px"></a><? } else { ?>&nbsp;<? } ?></td>
							<td class="tal">
								제 목 : <input type="text"  name="subject" value="<?=viewSQ($row[subject])?>"  class="bbs_inputbox_pixel" style="width:90%;" /><br>
								사 진 : <input type="file" name="bfile1" class="bbs_inputbox_pixel" style="width:410px;  margin-bottom:3px;  margin-top:3px; " />
								<span class="bbs_guide">* 이미지 등록, gif 또는 jpg</span><br>
								링 크 : <input type="text" name="link" value='<?=$row[link]?>' class="bbs_inputbox_pixel" style="width:410px; margin-bottom:3px;"/>
								<span class="bbs_guide">* 링크 URL</span> &nbsp;&nbsp;&nbsp;
								<input name="starget" type="radio" value="A" <? if ($row[starget] == "A") {echo "checked";} ?> />
								본창열기 &nbsp;&nbsp;&nbsp;
								<input name="starget" type="radio" value="B" <? if ($row[starget] == "B") {echo "checked";} ?> />
								새창열기 &nbsp;&nbsp;&nbsp;
								<input name="starget" type="radio" value="C" <? if ($row[starget] == "C") {echo "checked";} ?> />
								링크없음 
							</td>
							<td>
								<select id="" name="status" class="input_select">
									<option value="Y"  <? if ($row[status] == "Y") {echo "selected";} ?>>사용</option>
									<option value="N"  <? if ($row[status] == "N") {echo "selected";} ?>>미사용</option>
								</select>
							</td>
							<td><a href="javascript:document.frm<?=$row[idx]?>.submit()" class="btn btn-default">수정</a></td>
						</tr>
					</tbody>
					</form>


	<?
}
function getBanner($num)
{	
	global $strxhk;
	$strxhk = "N";
	$fsql = " select * from tbl_banner where idx='$num' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	if ($frow[status] == "Y") { ?>
	<img src="/data/banner/<?=$frow[bfile1]?>"  alt="<?=$frow[subject]?>" <? if ($frow[link] && $frow[starget] != "C") { ?> style="cursor:pointer;" onclick="javascript:<? if ($frow[starget] == "B") { ?>window.open('<?=$frow[link]?>')<? } else { ?>location.href='<?=$frow[link]?>'<? } ?>" <? } ?>/>

<?
	$strxhk = "Y";
	} 
}

function getBannerChk($num)
{	
	global $strxhk;
	$strxhk = "N";
	$fsql = " select * from TB_BANNER where idx='$num' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	if ($frow[status] == "Y") { 
		$chk = "Y";
	}  else {
		$chk = "N";
	}
	return $chk;
}
function getCountryName($code)
{	
	$fsql = " select country_kr from tbl_country_code where country_code='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[country_kr];
}


function getBoardName($code)
{	
	$fsql = " select board_name from tbl_bbs_config where board_code='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	if ($frow[board_name] == "") {
		alert_msg("정상적으로 이용바랍니다.");
		exit();
	}
	return $frow[board_name];
}

function getVacationCnt($userId)
{	
	$fsql = " select ifnull(sum(break_cnt),0) as cnt from tbl_vacation where status = 'S03' and substr(s_date,1,4) = '".date("Y",time())."' and user_id = '".$userId."' and kind in ('A01','A02','A05')";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);

	return $frow[cnt];
}

function isBoardCategory($code)
{	
	$fsql = " select is_category from tbl_bbs_config where board_code='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	if ($frow[is_category] == "") {
		alert_msg("정상적으로 이용바랍니다.");
		exit();
	}
	return $frow[is_category];
}
function skinname($code)
{	
	$fsql = " select skin from tbl_bbs_config where board_code='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	if ($frow[skin] == "") {
		alert_msg("정상적으로 이용바랍니다.");
		exit();
	}
	return $frow[skin];
}
function getFront($code)
{	
	$fsql = " select contents from tbl_info where idx='$code' ";

	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return viewSQ($frow[contents]);
}

function galleryTitle($code)
{	
	$fsql = " select title from tbl_gallery_config where code='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[title];
}

function isBoardReply($code)
{	
	$fsql = " select is_reply from tbl_bbs_config where board_code='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[is_reply];
}

function isSecure($code)
{	
	$fsql = " select is_secure from tbl_bbs_config where board_code='$code' ";

	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[is_secure];
}

function isNotice($code)
{	
	$fsql = " select is_notice from tbl_bbs_config where board_code='$code' ";

	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[is_notice];
}



 function strcut2($str, $size)
 {
  $substr = substr($str, 0, $size*2);
  $multi_size = preg_match_all('/[\x80-\xff]/', $substr, $multi_chars);

  if($multi_size >0)
   $size = $size + intval($multi_size/3)-1;

  if(strlen($str)>$size)
  {
   $str = substr($str, 0, $size);
   $str = preg_replace('/(([\x80-\xff]{3})*?)([\x80-\xff]{0,2})$/', '$1', $str);
   $str .= '...';
  }

  return $str;
 }
function mpagelisting($cur_page, $total_page, $n, $url) {
  $retValue = "<div class='list_paging'><ul>";
  if ($cur_page > 1) {
    $retValue .= "<li> <a href='" . $url . ($cur_page-1) . "'>◀</a></li>";
  } else {
    $retValue .= "<li><a href='#'>◀</a></li>";
  }
  $retValue .= "";
  $start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
  $end_page = $start_page + 9;
  if ($end_page >= $total_page) $end_page = $total_page;
  if ($total_page >= 1)
    for ($k=$start_page;$k<=$end_page;$k++)
      if ($cur_page != $k) $retValue .= " <li><a href='$url$k'>$k</a></li>";
      else $retValue .= " <li class='on'><a href='#'>$k</a></li>";
//  if ($total_page > $end_page) $retValue .= "<a href='" . $url . ($end_page+1) . "'>...</a> ";
  $retValue .= "";
  if ($cur_page < $total_page) {
    $retValue .= "<li><a href='$url" . ($cur_page+1) . "'>▶</a></li>";
  } else {
    $retValue .= "<li><a href='#'>▶</a></li>";
  }
  $retValue .= "</ul></div>";
  return $retValue;
}


 	function GD2_make_thumb($max_x,$max_y,$dst_name,$src_file) {
        $img_info=@getimagesize($src_file);
        $sx = $img_info[0];
        $sy = $img_info[1];
        //썸네일 보다 큰가?
        if ($sx>=$max_x || $sy>=$max_y) {
                if ($sx>$sy) {
                                $thumb_y=ceil(($sy*$max_x)/$sx);
                                $thumb_x=$max_x;
                } else {
                                $thumb_x=ceil(($sx*$max_y)/$sy);
                                $thumb_y=$max_y;
                }
        } else {
                $thumb_y=$sy;
                $thumb_x=$sx;
        }
        // JPG 파일인가?
        if ($img_info[2]=="1") {
                $_dq_tempFile=basename($src_file);                                //파일명 추출
                $_dq_tempDir=str_replace($_dq_tempFile,"",$src_file);        //경로 추출
                $_dq_tempFile=$dst_name;        //경로 + 새 파일명 생성

                $_create_thumb_file = true;
                if (file_exists($_dq_tempFile)) { //섬네일 파일이 이미 존제한다면 이미지의 사이즈 비교
                        $old_img=@getimagesize($_dq_tempFile);
                        if($old_img[0] != $thumb_x) $_create_thumb_file = true; else $_create_thumb_file = false;
                        if($old_img[1] != $thumb_y) $_create_thumb_file = true; else $_create_thumb_file = false;
                }
                if ($_create_thumb_file) {
                        // 복제
                        $src_img=imagecreatefromgif($src_file);
                        $dst_img=ImageCreateTrueColor($thumb_x, $thumb_y);
                        ImageCopyResampled($dst_img,$src_img,0,0,0,0,$thumb_x,$thumb_y,$sx,$sy);
                        Imagejpeg($dst_img,$_dq_tempFile,100);
                        // 메모리 초기화
                        ImageDestroy($dst_img);
                        ImageDestroy($src_img);
                }
        }
        if ($img_info[2]=="2") {
                $_dq_tempFile=basename($src_file);                                //파일명 추출
                $_dq_tempDir=str_replace($_dq_tempFile,"",$src_file);        //경로 추출
                $_dq_tempFile=$dst_name;        //경로 + 새 파일명 생성

                $_create_thumb_file = true;
                if (file_exists($_dq_tempFile)) { //섬네일 파일이 이미 존제한다면 이미지의 사이즈 비교
                        $old_img=@getimagesize($_dq_tempFile);
                        if($old_img[0] != $thumb_x) $_create_thumb_file = true; else $_create_thumb_file = false;
                        if($old_img[1] != $thumb_y) $_create_thumb_file = true; else $_create_thumb_file = false;
                }
                if ($_create_thumb_file) {
                        // 복제
                        $src_img=ImageCreateFromjpeg($src_file);
                        $dst_img=ImageCreateTrueColor($thumb_x, $thumb_y);
                        ImageCopyResampled($dst_img,$src_img,0,0,0,0,$thumb_x,$thumb_y,$sx,$sy);
                        Imagejpeg($dst_img,$_dq_tempFile,100);
                        // 메모리 초기화
                        ImageDestroy($dst_img);
                        ImageDestroy($src_img);
                }
        }
        if ($img_info[2]=="3") {
                $_dq_tempFile=basename($src_file);                                //파일명 추출
                $_dq_tempDir=str_replace($_dq_tempFile,"",$src_file);        //경로 추출
                $_dq_tempFile=$dst_name;        //경로 + 새 파일명 생성

                $_create_thumb_file = true;
                if (file_exists($_dq_tempFile)) { //섬네일 파일이 이미 존제한다면 이미지의 사이즈 비교
                        $old_img=@getimagesize($_dq_tempFile);
                        if($old_img[0] != $thumb_x) $_create_thumb_file = true; else $_create_thumb_file = false;
                        if($old_img[1] != $thumb_y) $_create_thumb_file = true; else $_create_thumb_file = false;
                }
                if ($_create_thumb_file) {
                        // 복제
                        $src_img=imagecreatefrompng($src_file);
                        $dst_img=ImageCreateTrueColor($thumb_x, $thumb_y);
                        ImageCopyResampled($dst_img,$src_img,0,0,0,0,$thumb_x,$thumb_y,$sx,$sy);
                        Imagejpeg($dst_img,$_dq_tempFile,100);
                        // 메모리 초기화
                        ImageDestroy($dst_img);
                        ImageDestroy($src_img);
                }
        }
}
function viewSQ($textToFilter)
{
		$textToFilter = str_replace('&amp;',"&",$textToFilter);
		$textToFilter = str_replace('&#59',";",$textToFilter);
		$textToFilter = str_replace('&gt;',">",$textToFilter);
		$textToFilter = str_replace('&lt;',"<",$textToFilter);
		$textToFilter = str_replace("&#39","'",$textToFilter);
		$textToFilter = str_replace('&#34',"\"",$textToFilter);
		$textToFilter = str_replace('&amp;',"&",$textToFilter);
		return $textToFilter;
}

function updateSQ($textToFilter)
{
	//a = &#97;
    //e = &#101;
    //i = &#105;
    //o = &#111;
    //u  = &#117;

    //A = &#65;
    //E = &#69;
    //I = &#73;
    //O = &#79;
    //U = &#85;
    if ($textToFilter != null)
	{
		$textToFilter = str_replace('insert','ins&#101rt',$textToFilter);
		$textToFilter = str_replace('select','s&#101lect',$textToFilter);
		$textToFilter = str_replace('values','valu&#101s',$textToFilter);
		$textToFilter = str_replace('where','wher&#101',$textToFilter);
		$textToFilter = str_replace('order','ord&#101r',$textToFilter);
		$textToFilter = str_replace('into','int&#111',$textToFilter);
		$textToFilter = str_replace('drop','dr&#111p',$textToFilter);
		$textToFilter = str_replace('delete','delet&#101',$textToFilter);
		$textToFilter = str_replace('update','updat&#101',$textToFilter);
		$textToFilter = str_replace('set','s&#101t',$textToFilter);
		$textToFilter = str_replace('flush','fl&#117sh',$textToFilter);
		$textToFilter = str_replace("'","&#39",$textToFilter);
		$textToFilter = str_replace('"',"&#34",$textToFilter);
		$textToFilter = str_replace('>',"&gt;",$textToFilter);
		$textToFilter = str_replace('<',"&lt;",$textToFilter);
		$textToFilter = str_replace('script','scr&#105pt',$textToFilter);
	//	$textToFilter = nl2br($textToFilter);
		$filterInputOutput = $textToFilter;
		return trim($filterInputOutput);  
	}

}

// 현재페이지,총페이지수,한페이지에 보여줄 목록수,URL
function wpagelisting($cur_page, $total_page, $n, $url) {
	$retValue = "<div class='paginate'>";
	if ($cur_page > 1) {
		$retValue .= "<a href='" . $url . "1' class='ctrl first' title='Go to next page'></a>";
		$retValue .= "<a href='" . $url . ($cur_page-1) . "' class='ctrl prev' title='Go to first page'></a>";
	} else {	
		$retValue .= "<a href='javascript:;' class='ctrl first' title='Go to next page'></a>";
		$retValue .= "<a href='javascript:;' class='ctrl prev' title='Go to first page'></a>";
	}
	$retValue .= "";
	$start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
	$end_page = $start_page + 9;
	if ($end_page >= $total_page) $end_page = $total_page;
	if ($total_page == 0)
	{
		$retValue .= "<a href='javascript:;' class='active' title='Go to 0 page'>1</a>";
	} elseif ($total_page >= 1)
	{
		for ($k=$start_page;$k<=$end_page;$k++)
		{
			if ($cur_page != $k) 
			{
				$retValue .= "<a href='$url$k' title='Go to page $k'>$k</a>";
			} else { 
				$retValue .= "<a href='javascript:;' title='Go to $k page' class='active'>$k</a>";
			}
		}
	}
	$retValue .= "";
	if ($cur_page < $total_page) {
		$retValue .= "<a href='$url" . ($cur_page+1) . "'  class='ctrl next' title='Go to next page'></a>";
		$retValue .= "<a href='$url$total_page' class='ctrl last' title='Go to last page'></a>";
	} else {
		$retValue .= "<a href='javascript:;'  class='ctrl next' title='Go to next page'></a>";
		$retValue .= "<a href='javascript:;'  class='ctrl last' title='Go to last page'></a>";
	}
	$retValue .= "</div>";
	return $retValue;
}
/*
function wmpagelisting($cur_page, $total_page, $n, $url) {
	if ($total_page > 0) 
	{
		$retValue = "<div class=\"pager_wrap\"><ul>";
		if ($cur_page > 1) {
			$retValue .= "<li class='ic ic_ll'><a href='" . $url . "1' title='Go to first page'>게시판 첫페이지로 이동</a></li>";
			$retValue .= "<li class='ic ic_l'><a href='" . $url . ($cur_page-1) . "' class='pagerDB-prev active' title='Go to previous page'>게시판 이전페이지로 이동</a></li>";
		} else {
			$retValue .= "<li class='ic ic_ll'><a href='javascript:;' title='Go to first page'>게시판 첫페이지로 이동</a></li>";
			$retValue .= "<li class='ic ic_l'><a href='javascript:;' title='Go to previous page'>게시판 이전페이지로 이동</a></li> ";
		}
		$retValue .= "";
		$start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
		$end_page = $start_page + 9;
		if ($end_page >= $total_page) $end_page = $total_page;
		if ($total_page >= 1)
		for ($k=$start_page;$k<=$end_page;$k++)
		if ($cur_page != $k) $retValue .= "<li class='num'><a href='$url$k' title='Go to page $k'>$k</a></li>";
		else $retValue .= "<li class='active num'><a href='javascript:;'>$k</a></li>";
		$retValue .= "";
		if ($cur_page < $total_page) {
			$retValue .= "<li class=\"ic ic_r\"><a href='$url" . ($cur_page+1) . "' title='Go to next page'>게시판 다음 페이지로 이동</a></li>";
			$retValue .= "<li class=\"ic ic_rr\"><a href='$url$total_page' title='Go to last page'>게시판 마지막 페이지로 이동</a></li>";
		} else {
			$retValue .= "<li class=\"ic ic_r\"><a href='#' title='Go to next page'>게시판 다음 페이지로 이동</a></li>";
			$retValue .= "<li class=\"ic ic_rr\"><a href='#' title='Go to last page'>게시판 마지막 페이지로 이동</a></li>";
		}
		$retValue .= "</ul></div>";
	}
	return $retValue;
}
*/

function wmpagelisting($cur_page, $total_page, $n, $url) {
	if ($total_page > 0) 
	{
		$retValue = "<div class='pager_wrap'><ul>";
		if ($cur_page > 1) {
			$retValue .= "<li class='arrow mar_r5'><a href='" . $url . "1' title='Go to first page'><img src='/img/sub/pager_ll.png' alt='처음 페이지로'></a></li>";
			$retValue .= "<li class='arrow mar_r9'><a href='" . $url . ($cur_page-1) . "' class='pagerDB-prev active' title='Go to previous page'><img src='/img/sub/pager_l.png' alt='이전 페이지로'></a></li>";
		} else {
			$retValue .= "<li class='arrow mar_r5'><a href='javascript:;' title='Go to first page'><img src='/img/sub/pager_ll.png' alt='처음 페이지로'></a></li>";
			$retValue .= "<li class='arrow mar_r9'><a href='javascript:;' title='Go to previous page'><img src='/img/sub/pager_l.png' alt='이전 페이지로'></a></li> ";
		}
		$retValue .= "";
		$start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
		$end_page = $start_page + 9;
		if ($end_page >= $total_page) $end_page = $total_page;
		if ($total_page >= 1)
		for ($k=$start_page;$k<=$end_page;$k++)
		if ($cur_page != $k) $retValue .= "<li class='num'><a href='$url$k' title='Go to page $k'>$k</a></li>";
		else $retValue .= "<li class='num active'><a href='javascript:;'>$k</a></li>";
		$retValue .= "";
		if ($cur_page < $total_page) {
			$retValue .= "<li class='arrow mar_l9'><a href='$url" . ($cur_page+1) . "' title='Go to next page'><img src='/img/sub/pager_r.png' alt='다음 페이지로'></a></li>";
			$retValue .= "<li class='arrow mar_l5'><a href='$url$total_page' title='Go to last page'><img src='/img/sub/pager_rr.png' alt='마지막 페이지로'></a></li>";
		} else {
			$retValue .= "<li class='arrow mar_l9'><a href='#' title='Go to next page'><img src='/img/sub/pager_r.png' alt='다음 페이지로'></a></li>";
			$retValue .= "<li class='arrow mar_l5'><a href='#' title='Go to last page'><img src='/img/sub/pager_rr.png' alt='마지막 페이지로'></a></li>";
		}
		$retValue .= "</ul></div>";
	}
	return $retValue;
}

	function wpagelisting_ajax($cur_page, $total_page, $n, $code) {

		$retValue = "<div id='pageing_$code' class=\"paging\"><ul>";
		if ($cur_page > 1) {
			$retValue .= "<li class='first'><a href='javascript:get_list(1, $code)' ><img src='/img_board/btn_page_prev.png' /></a></li>";
		} else {
			$retValue .= "<li class='first'><a href='javascript:get_list(".($cur_page-1).", $code)' ><img src='/img_board/btn_page_prev.png' /></a></li>";
		}

		$start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;

		$end_page = $start_page + 9;
		if ($end_page >= $total_page) $end_page = $total_page;

		if ($cur_page > 1){ 
			$retValue .= "<li class='prev'><a href='javascript:get_list(".($cur_page-1).", $code)'>&lt;</a></li>";
		} else {
			$retValue .= "<li class='prev'><a href='javascript:;'>&lt;</a></li>";
		}

		if ($total_page > 1)
			for ($k=$start_page;$k<=$end_page;$k++)
			{
				if ($cur_page != $k) $retValue .= "<li><a href='javascript:get_list($k, $code)' >$k</a></li>";
				else $retValue .= "<li class='active'><a href='javascript:;'><b>$k</b></a></li>";
			}

		if ($total_page > $cur_page){
			$retValue .= "<li class='next'><a href='javascript:get_list(".($cur_page+1).", $code)' >&gt;</a></li>";
		} else {
			$retValue .= "<li class='next'><a href='javascript:;'>&gt;</a></li>";
		}



		if ($cur_page < $total_page) {
			$retValue .= "<li class='last'><a href='javascript:get_list(".($total_page).", $code)' ><img src='/img_board/btn_page_next.png' /></a></li>";
		} else {
			$retValue .= "<li class='last'><a href='javascript:;'><img src='/img_board/btn_page_next.png' /></a></li>";
		}
		$retValue .= "</ul></div>";
		return $retValue;
	}// 현재페이지,총페이지수,한페이지에 보여줄 목록수,URL
function ipagelisting($cur_page, $total_page, $n, $url) {

	$retValue = "<div class='paging mt30'><ul>";
	if ($cur_page > 1) {
		$retValue .= "<li class='first'><a href='" . $url . "1' title='Go to next page'>&lt;&lt;  처음</a></li>";
		$retValue .= "<li class='prev'><a href='" . $url . ($cur_page-1) . "' title='Go to first page'>&lt; 이전</a></li>";
	} else {	
		$retValue .= "<li class='first'><a href='javascript:;' title='Go to next page'>&lt;&lt; 처음</a></li>";
		$retValue .= "<li class='prev'><a href='javascript:;' title='Go to first page'>&lt; 이전</a></li>";
	}
	$retValue .= "";
	$start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
	$end_page = $start_page + 9;
	if ($end_page >= $total_page) $end_page = $total_page;
	if ($total_page == 0)
	{
		$retValue .= "<li class='active'><a href='javascript:;' title='Go to 0 page'><strong>1</strong></a></li>";
	} elseif ($total_page >= 1)
	{
		for ($k=$start_page;$k<=$end_page;$k++)
		{
			if ($cur_page != $k) 
			{
				$retValue .= "<li><a href='$url$k' title='Go to page $k'>$k</a></li>";
			} else { 
				$retValue .= "<li class='active'><a href='javascript:;' title='Go to $k page'><strong>$k</strong></a></li>";
			}
		}
	}
	$retValue .= "";
	if ($cur_page < $total_page) {
		$retValue .= "<li class='next'><a href='$url" . ($cur_page+1) . "' title='Go to next page'>다음 &gt;</a></li>";
		$retValue .= "<li class='last'><a href='$url$total_page' title='Go to last page'>맨끝 &gt;&gt;</a></li>";
	} else {
		$retValue .= "<li class='next'><a href='javascript:;' title='Go to next page'>다음 &gt;</a></li>";
		$retValue .= "<li class='last'><a href='javascript:;' title='Go to last page'>맨끝 &gt;&gt;</a></li>";
	}
	$retValue .= "</ul></div>";
	return $retValue;
}


function num2kor($num)

 {

  $ret = "";

  if(!is_numeric($num))

  {

   return 0;

  }

  

  $arr_number = strrev($num);

  for($i =strlen($arr_number)-1; $i>=0; $i--)

  {

   /////////////////////////////////////////////////

   // 현재 자리를 구함

   $digit = substr($arr_number, $i, 1);




   ///////////////////////////////////////////////////////////

   // 각 자리 명칭

   switch($digit)

   {

    case '-' : $ret .= "(-) ";

        break;

    case '0' : $ret .= "";

        break;

    case '1' : $ret .= "일";

        break;     

    case '2' : $ret .= "이";

        break;     

    case '3' : $ret .= "삼";

        break;     

    case '4' : $ret .= "사";

        break;     

    case '5' : $ret .= "오";

        break;     

    case '6' : $ret .= "육";

        break;     

    case '7' : $ret .= "칠";

        break;     

    case '8' : $ret .= "팔";

        break;     

    case '9' : $ret .= "구";

        break;     

   }




    if($digit=="-") continue;




    ///////////////////////////////////////////////////////////

    // 4자리 표기법 공통부분

    if($digit != 0)

    {

     if($i % 4 == 1)$ret .= "십";

     else if($i % 4 == 2)$ret .= "백";

     else if($i % 4 == 3)$ret .= "천";

    }

    

    ///////////////////////////////////////////////////////////

    // 4자리 한자 표기법 단위

    if($i % 4 == 0)

    {

     if( floor($i/ 4) ==0)$ret .= "";

     else if(floor($i / 4)==1)$ret .= "<b>만</b> ";

     else if(floor($i / 4)==2)$ret .= "<b>억</b> ";

     else if(floor($i / 4)==3)$ret .= "<b>조</b> ";

     else if(floor($i / 4)==4)$ret .= "<b>경</b> ";

     else if(floor($i / 4)==5)$ret .= "<b>해</b> ";

     else if(floor($i / 4)==6)$ret .= "<b>자</b> ";

     else if(floor($i / 4)==7)$ret .= "<b>양</b> ";

     else if(floor($i / 4)==8)$ret .= "<b>구</b> ";

     else if(floor($i / 4)==9)$ret .= "<b>간</b> ";

     else if(floor($i / 4)==10)$ret .= "<b>정</b> ";

     else if(floor($i / 4)==11)$ret .= "<b>재</b> ";

     else if(floor($i / 4)==12)$ret .= "<b>극</b> ";

     else if(floor($i / 4)==13)$ret .= "<b>항하사</b> ";

     else if(floor($i / 4)==14)$ret .= "<b>아승기</b> ";

     else if(floor($i / 4)==15)$ret .= "<b>나유타</b> ";

     else if(floor($i / 4)==16)$ret .= "<b>불가사의</b> ";

     else if(floor($i / 4)==16)$ret .= "<b>무량대수</b> ";    }

  }




  return $ret;

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

function get_position($code)
{
	if ($code == "01") {
		$lcode = "사무국";
	} elseif ($code == "02") {
		$lcode = "이사";
	} elseif ($code == "03") {
		$lcode = "고문";
	} elseif ($code == "04") {
		$lcode = "감사";
	} elseif ($code == "05") {
		$lcode = "자문위원";
	} elseif ($code == "06") {
		$lcode = "홍보대사";
	}
	return $lcode;
}

		function getStudioCate($strdata, $strtype)
		{
			$atitle = explode("|",$strdata);
			$strTitle = "";
			for ($i = 0 ; $i < count($atitle)-1 ;$i++)
			{
				$sql1		= "select title from tbl_code where code='".$atitle[$i]."' and cate='".$strtype."' order by onum asc ";
				$result1	= mysql_query($sql1) or die (mysql_error());
				$row1		= mysql_fetch_array($result1);
				$strTitle	= $row1["title"].", ".$strTitle;
			}
			return substr($strTitle,0,strlen($strTitle)-2);
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


function isBoardRecomm($code)
{	
	$fsql = " select is_recomm from tbl_bbs_config where board_code='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[is_recomm];
}

function getProductName($code)
{	
	$fsql = " select P_NAME from J_PRODUCT_NEW where P_CODE1='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[P_NAME];
}

function getProductImg($code)
{	
	$fsql = " select P_IMAGE_S from J_PRODUCT_NEW where P_CODE1='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[P_IMAGE_S];
}

function getProductImgE($code)
{	
	$fsql = " select P_IMAGE_S from J_PRODUCT_ENG where P_CODE1='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[P_IMAGE_S];
}

function getProductImgL($code)
{	
	$fsql = " select P_IMAGE_L from J_PRODUCT_NEW where P_CODE1='$code' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[P_IMAGE_L];
}
function getCalCnt($code)
{	
	$fsql = "select ifnull(count(*),0) as cnt from tbl_schedule_list where sc_date = '".$code."' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[cnt];
}

if($_SESSION[member][g_on_uid] == ""){
	$_SESSION[member][g_on_uid]=get_rand(12);

}

 function img_ext() 
 { 
    return array( 
        'gif','jpe','jpg','jpeg','bmp','png','art','ani','bnr','cal',
        'fax','hdp','mac','pbm','pcd','pct','pcx','pgm','png','ppm',
        'psd','ras','tga','tif','tiff','wmf','cdr','cgm','cmk','cut',
        'dcx','dib','drw','dxf','emf','eps','flc','fli','iff',
        'lbm','wpg' 
    ); 
 } 

 function link_image_all($str) 
 { 
    if(!empty($sttr)) 
    { 
        return preg_replace("/&lt;.*?img.*?src=\s*?['\"]http:\/\/([0-9a-z-.\/~_]+\.(" . implode("|", img_ext()) . "))['\"].*?&gt;/i", "<img src=\"http://\\1\" />", $str); 
    } 
    return false; 
 } 


function getimage($con,$idx,$hh="") {
	$cnt = preg_match_all('@<img\s[^>]*src\s*=\s*(["\'])?([^\s>]+?)\1@i',stripslashes($con),$output); 
		$j = 0;
		for($i = 0; $i < $cnt; $i ++) {
		$cols[$j][] = str_replace('""', '"', ($output[2][$i] != '') ? $output[2][$i] : $output[4][$i]);

		if($output[6][$i] != '')
		$j ++;

			$img = $cols[0][$i];
			echo "<a href='$img' id='".$hh."gallery_".$idx."_".$i."' rel=\"prettyPhoto[".$hh."gallery_$idx]\"></a>";
		}
//	return $img;
}

function getConImg($con) {
	$cnt = preg_match_all('@<img\s[^>]*src\s*=\s*(["\'])?([^\s>]+?)\1@i',stripslashes($con),$output); 
		$j = 0;
		for($i = 0; $i < $cnt; $i ++) {
		$cols[$j][] = str_replace('""', '"', ($output[2][$i] != '') ? $output[2][$i] : $output[4][$i]);

		if($output[6][$i] != '')
		$j ++;

			$img = $cols[0][$i];
		}
	return $img;
}


function get_cate($code)
{
	$fsql = " select * from tbl_category where ca_idx ='$code'";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow = mysql_fetch_array($fresult);
	return $frow[ca_name];
} 

function get_code_radio($gubun, $val = "")
{
	$fsql = " select * from tbl_code where code_gubun ='$gubun' order by onum desc, code_no asc";
	$fresult = mysql_query($fsql) or die (mysql_error());
	while ($frow = mysql_fetch_array($fresult)) {
	?>
	<li><input type="radio" title="<?=$frow[code_name]?>" class="code_<?=$frow[code_gubun]?>" id="<?=$frow[code_gubun]?>_<?=$frow[code_no]?>" name="<?=$gubun?>" value="<?=$frow[code_no]?>" <? if(strpos($val, $frow[code_no]) !== false) { echo "checked"; } ?>/> <label for="<?=$frow[code_gubun]?>_<?=$frow[code_no]?>"><?=$frow[code_name]?></label></li>
	<? } ?>
<? } 

function get_code_select($gubun,$val = "")
{
	?>
	<select name="<?=$gubun?>" id="<?=$gubun?>" class="code_<?=$gubun?>" style="width: 154px;height: 34px;">
	<option value="">선택하세요</option>
	<?
	$fsql = " select * from tbl_code where code_gubun ='$gubun' order by onum desc, code_no asc";
	$fresult = mysql_query($fsql) or die (mysql_error());
	while ($frow = mysql_fetch_array($fresult)) {
	?>
		<option value="<?=$frow[code_no]?>" <? if(strpos($val, $frow[code_no]) !== false) { echo "selected"; } ?>><?=$frow[code_name]?></option>
	
	<? } ?>
	</select>
<? } 
function get_img($img, $path, $width, $height, $water = "")
{

	$file_dir = "";
	$thumb_img_path = $_SERVER[DOCUMENT_ROOT].$path."/thum_".$width."_$height/";
	if(!is_dir($thumb_img_path)){
		@mkdir($thumb_img_path, 0777);
	}
	$thumb_img = $thumb_img_path.$img;
	if(!file_exists($thumb_img))
	{
		@GD2_make_thumb($width,$height,$thumb_img,$_SERVER[DOCUMENT_ROOT]."/".$path."/".$img);
	}
	chmod($_SERVER[DOCUMENT_ROOT].$path."/thum_".$width."_".$height."/".$img,0777); 
//	echo $path."/thum_".$width."_".$height."/".$img;
	return $path."/thum_".$width."_".$height."/".$img;
}

function get_bbs_img($img, $path, $width, $height, $code)
{

	$file_dir = "";
	$thumb_img_path = $_SERVER[DOCUMENT_ROOT].$path."/thum_".$width."_$height/";
	if(!is_dir($thumb_img_path)){
		@mkdir($thumb_img_path, 0777);
	}
	$thumb_img = $thumb_img_path.$img;
	if(!file_exists($thumb_img))
	{
		@GD2_make_thumb($width,$height,$thumb_img,$_SERVER[DOCUMENT_ROOT]."/".$path."/".$img);
		$wimg = "std_2000.png";
//		if ($water == "Y") {
		if ($width > 300) {
			imageWaterMaking($thumb_img_path.$img, $_SERVER[DOCUMENT_ROOT]."/_images/common/".$wimg, 100);
		}
	}
	chmod($_SERVER[DOCUMENT_ROOT]."/data/thum_".$width."_".$height."/".$img,0777); 
//	echo $path."/thum_".$width."_".$height."/".$img;
	return $path."/thum_".$width."_".$height."/".$img;
}

$write_sample_img = "/resource/img/sub/pic_info_img.png";



function DateAdd($interval, $number, $date) {

    //getdate()함수를 통해 얻은 배열값을 각각의 변수에 지정합니다.

	$date_time_array = getdate($date);
	$hours = $date_time_array["hours"];
	$minutes = $date_time_array["minutes"];
	$seconds = $date_time_array["seconds"];
	$month = $date_time_array["mon"];
	$day = $date_time_array["mday"];
	$year = $date_time_array["year"];


     //switch()구문을 사용해서 interval에 따라 적용합니다.

     switch ($interval) {
          case "yyyy": 
              $year +=$number; 
              break; 

          case "q":
              $year +=($number*3);
              break;

          case "m":
              $month +=$number;
              break;

          case "y":
          case "d":
          case "w":
              $day+=$number;
              break;

          case "ww":
              $day+=($number*7);
              break;

          case "h":
              $hours+=$number;
              break;

          case "n":
              $minutes+=$number;
              break;

          case "s":
              $seconds+=$number;
              break;

     }


    $timestamp = date("Y-m-d",mktime($hours ,$minutes, $seconds, $month, $day, $year));
	return $timestamp;
}


function room_view($room_idx)
{
	$fsql = " update tbl_room_mst set hit = hit + 1  where room_idx ='$room_idx' ";
	$fresult = mysql_query($fsql) or die (mysql_error());

	$fsql = "select cnt+1 as cnt from tbl_room_view_log where room_idx = '$room_idx' and ip_address	= '".$_SERVER['REMOTE_ADDR']."' ";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	if ($frow[cnt] == "") {
		$fsql = " insert into tbl_room_view_log set 
			ip_address	= '".$_SERVER['REMOTE_ADDR']."'
			, cnt		= '1'
			, room_idx	= '$room_idx'
			, r_date	= now()
		";
		$fresult = mysql_query($fsql) or die (mysql_error());
	} else {
		$fsql = " update tbl_room_view_log set 
			 room_idx	= '$room_idx'
			, cnt		= '".$frow[cnt]."'
			, r_date	= now()
			where ip_address	= '".$_SERVER['REMOTE_ADDR']."'
		";
		$fresult = mysql_query($fsql) or die (mysql_error());

	}
}

function ipaddress_to_uint32($ip) {
    list($v4,$v3,$v2,$v1) = explode(".", $ip);
    return ($v4*256 *256*256) + ($v3*256*256) + ($v2*256) + ($v1);
}

function ipaddress_to_country_code($ip) {

    $i = ipaddress_to_uint32($ip);

    $query   = "select * from tbl_geoip where ip32_start<= $i and $i <=ip32_end;";
    $result = mysql_query($query) or die (mysql_error());
    $row = mysql_fetch_array($result);
    
    return $row['country_code'];
}

	
function getYoil($strdate)
{
	$yoil = array("일","월","화","수","목","금","토");
	$date= $strdate;

echo $yoil[date('w',strtotime($date))];

}
function get_rand($size)
{
	$feed = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
	for ($i=0; $i < $size; $i++)                          
	{
	    $rand_str .= substr($feed, rand(0, strlen($feed)-1), 1); 
	}
	return $rand_str;
}

function get_home_setting($ths_idx)
{
	$fsql    = "select * from tbl_homepage_setting where ths_idx = $ths_idx";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow	= mysql_fetch_array($fresult);
	return $frow[contents];
}


function getEventNo($program_no)
{
	$fsql    = "select tel_idx from ".TBL_EVENT_LIST." where program_no = '$program_no'";
	$fresult = mysql_query($fsql) or die (mysql_error());
	$frow=mysql_fetch_array($fresult);
	return $frow[tel_idx];
}

function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";
 
    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) { $platform = 'linux'; }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) { $platform = 'mac'; }
    elseif (preg_match('/windows|win32/i', $u_agent)) { $platform = 'windows'; }
     
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { $bname = 'Internet Explorer'; $ub = "MSIE"; } 
    elseif(preg_match('/Firefox/i',$u_agent)) { $bname = 'Mozilla Firefox'; $ub = "Firefox"; } 
    elseif(preg_match('/Chrome/i',$u_agent)) { $bname = 'Google Chrome'; $ub = "Chrome"; } 
    elseif(preg_match('/Safari/i',$u_agent)) { $bname = 'Apple Safari'; $ub = "Safari"; } 
    elseif(preg_match('/Opera/i',$u_agent)) { $bname = 'Opera'; $ub = "Opera"; } 
    elseif(preg_match('/Netscape/i',$u_agent)) { $bname = 'Netscape'; $ub = "Netscape"; } 
     
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
     
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){ $version= $matches['version'][0]; }
        else { $version= $matches['version'][1]; }
    }
    else { $version= $matches['version'][0]; }
     
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    return array('userAgent'=>$u_agent, 'name'=>$bname, 'version'=>$version, 'platform'=>$platform, 'pattern'=>$pattern);
}
$admin_email = "master@imagestd.com.co.kr";
$new_num = 14;

function sql_password($value)
{
	$sql = " select old_password('$value') as pass ";
	$result = mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_array($result);

    return $row['pass'];
}

 function alink($data) { 
  
 // http  
 $data = preg_replace("/http:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"http://\\1\" target='_blank'>http://\\1</a>", $data); 

 // ftp  
 $data = preg_replace("/ftp:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"ftp://\\1\" target='_blank'>ftp://\\1</a>", $data); 

 // email 
 $data = preg_replace("/([_0-9a-z-]+(\.[_0-9a-z-]+)*)@([0-9a-z-]+(\.[0-9a-z-]+)*)/i", "<a href=\"mailto:\\1@\\3\">\\1@\\3</a>", $data); 

 return $data; 

 } 

function right($value, $count){
   $value = substr($value, (strlen($value) - $count), strlen($value));
   return $value;
 }

 function left($string, $count){
   return substr($string, 0, $count);
 }

 function get_school($code)
 {
	 $strs = "";
	if ($code == "01")
	{
		$strs = "초대줄";
	} elseif ($code == "02") {
		$strs = "대줄";
	} elseif ($code == "03") {
		$strs = "학사";
	} elseif ($code == "04") {
		$strs = "석,박사 이상 ";
	}
	return $strs;
}

function get_ex_no()
{
	$fsql		= "select em_no from tbl_exam_member order by r_date desc limit 0, 1";
	$fresult	= mysql_query($fsql) or die (mysql_error());
	$frow		= mysql_fetch_array($fresult);
	if ($frow[em_no] == "")
	{
		$em_number = "1";
	} else {
		$arr_em_number = explode("_",$frow[em_no]);
		$em_number	= $arr_em_number[1];
	}
	return date("Ymd")."_".str_pad((int)$em_number+1, 5, "0", STR_PAD_LEFT);
}

$head_title = "리스맨";

function get_device() {
    // 모바일 기종(배열 순서 중요, 대소문자 구분 안함)
    $ary_m = array("iPhone","iPod","IPad","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini","Windows CE","Nokia","Sony","Samsung","LGTelecom","SKT","Mobile","Phone");
	$str = "P";
    for($i=0; $i<count($ary_m); $i++){
        if(preg_match("/$ary_m[$i]/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            //return $ary_m[$i];
			$str = "M";
            break;
        }
    }
    return $str;
}


function fn_edate($s_date, $month){
	$out_date = "";

	$tmp_array = explode("-",$s_date);
	$tmp_year	= $tmp_array[0];
	$tmp_month	= $tmp_array[1];
	$tmp_date	= $tmp_array[2];

	$tmp_year = $tmp_year * 1;
	$tmp_month = $tmp_month * 1;
	$tmp_date = $tmp_date * 1;

	
	// 계산
	$tmp_month = $tmp_month + $month;
	$tmp_date--;

	if($tmp_month>12){
		
		$tmp_year = $tmp_year + (floor($tmp_month/12));
		$tmp_month = $tmp_month%12;
		if($tmp_month==0){
			$tmp_month = 12;
			$tmp_year--;
		}
	}

	if($tmp_date>0){
		$tmp_last = date("t",strtotime($tmp_year."-".$tmp_month."-01"));

		if($tmp_last < $tmp_date){
			$tmp_date = $tmp_last;
		}

	}else{
		$tmp_month--;
		if($tmp_month==0){
			$tmp_month = 12;
			$tmp_year--;
		}
		//$tmp_date = date("t",strtotime($s_date));
		$tmp_date = date("t",strtotime($tmp_year."-".$tmp_month."-01"));
	}
	

	
	$tmp_month = $tmp_month*1;
	$tmp_date = $tmp_date*1;

	if($tmp_month<10){
		$tmp_month  = "0".$tmp_month;
	}

	if($tmp_date<10){
		$tmp_date  = "0".$tmp_date;
	}

	//$out_date = $tmp_year . "-" . str_pad($tmp_month,2,"0",str_pad_left) . "-" . str_pad($tmp_date,2,"0",str_pad_left);
	$out_date = $tmp_year . "-" . $tmp_month . "-" . $tmp_date;

	return $out_date;

}

function fn_edate_same($s_date, $month){
	$out_date = "";

	$tmp_array = explode("-",$s_date);
	$tmp_year	= $tmp_array[0];
	$tmp_month	= $tmp_array[1];
	$tmp_date	= $tmp_array[2];

	$tmp_year = $tmp_year * 1;
	$tmp_month = $tmp_month * 1;
	$tmp_date = $tmp_date * 1;

	
	// 계산
	$tmp_month = $tmp_month + $month;
	//$tmp_date--;

	if($tmp_month>12){
		
		$tmp_year = $tmp_year + (floor($tmp_month/12));
		$tmp_month = $tmp_month%12;
		if($tmp_month==0){
			$tmp_month = 12;
			$tmp_year--;
		}
	}

	if($tmp_date>0){
		$tmp_last = date("t",strtotime($tmp_year."-".$tmp_month."-01"));

		if($tmp_last < $tmp_date){
			$tmp_date = $tmp_last;
		}

	}else{
		$tmp_month--;
		if($tmp_month==0){
			$tmp_month = 12;
			$tmp_year--;
		}
		//$tmp_date = date("t",strtotime($s_date));
		$tmp_date = date("t",strtotime($tmp_year."-".$tmp_month."-01"));
	}
	

	
	$tmp_month = $tmp_month*1;
	$tmp_date = $tmp_date*1;

	if($tmp_month<10){
		$tmp_month  = "0".$tmp_month;
	}

	if($tmp_date<10){
		$tmp_date  = "0".$tmp_date;
	}

	//$out_date = $tmp_year . "-" . str_pad($tmp_month,2,"0",str_pad_left) . "-" . str_pad($tmp_date,2,"0",str_pad_left);
	$out_date = $tmp_year . "-" . $tmp_month . "-" . $tmp_date;

	return $out_date;

}


function fn_month_term($s_date, $month){
	$out_date = "";

	$tmp_array = explode("-",$s_date);
	$tmp_year	= $tmp_array[0];
	$tmp_month	= $tmp_array[1];
	

	$tmp_year = $tmp_year * 1;
	$tmp_month = $tmp_month * 1;
	

	
	// 계산
	$tmp_month = $tmp_month + $month;
	

	
		

	if($tmp_month>12){
		
		$tmp_year = $tmp_year + (floor($tmp_month/12));
		$tmp_month = $tmp_month%12;
	}


	$tmp_month = $tmp_month*1;
	

	if($tmp_month<10){
		$tmp_month  = "0".$tmp_month;
	}

	
	$out_date = $tmp_year . "-" . $tmp_month;

	return $out_date;

}


function fn_addDays($day2,$d) {    
    $day2 = strtotime(date($day2)); 
    $day = $day2 + $d*86400;

    $day = date('Y-m-d',$day);

                    
    return $day;
}



function fn_chg_sms($in_msg, $text1="", $text2="", $text3="", $text4="", $text5="", $text6="", $text7="", $text8="", $text9="", $text10="", $text11="", $text12="", $text13="" ){
	/*
	$text1  = {고객명}
	$text2  = {사업자명}
	$text3  = {이메일}
	$text4  = {예정일}
	$text5  = {예정금액}
	$text6  = {계약일}
	$text7  = {시작일}
	$text8  = {종료일}
	$text9  = {개월}
	$text10 = {연체일수}
	$text11 = {연체이자}
	$text12 = {입금일}
	$text13 = {세금계산서발행일}
	*/

	$in_msg = str_replace("{고객명}",	$text1 ,$in_msg);
	$in_msg = str_replace("{사업자명}",	$text2 ,$in_msg);
	$in_msg = str_replace("{이메일}",	$text3 ,$in_msg);
	$in_msg = str_replace("{예정일}",	$text4 ,$in_msg);
	$in_msg = str_replace("{예정금액}",	$text5 ,$in_msg);
	$in_msg = str_replace("{계약일}",	$text6 ,$in_msg);
	$in_msg = str_replace("{시작일}",	$text7 ,$in_msg);
	$in_msg = str_replace("{종료일}",	$text8 ,$in_msg);
	$in_msg = str_replace("{개월}",		$text9 ,$in_msg);
	$in_msg = str_replace("{연체일수}",	$text10,$in_msg);
	$in_msg = str_replace("{연체이자}",	$text11,$in_msg);
	$in_msg = str_replace("{입금일}",	$text12,$in_msg);
	$in_msg = str_replace("{세금계산서 발행일}",$text13,$in_msg);

	

	return $in_msg;
}


function get_cnt_tbl_contract($types = ''){
	/*
	 고객 계약 누적 수 확인
	 i:진행 중
	 e:종료
	*/

	$sub_tail = "";

	if($types){

		if($types=="i"){
			$sub_tail .= "	and (status = 0	and e_date >= curdate())	";
		}else if($types=="e"){
			$sub_tail .= "	and (status = 1	or e_date < curdate())	";
		}
	}


	$sql_con_fun1		= "select count(*) as cnts from tbl_contract where con_type = 'c' and c_idx = '".$_SESSION[customer][idx]."' " . $sub_tail;
	$result_con_fun1	= mysql_query($sql_con_fun1) or die (mysql_error());
	$row_con_fun1		= mysql_fetch_array($result_con_fun1);

	return $row_con_fun1['cnts'];
}

function get_cnt_tbl_contract_date($date, $types = ''){
	/*
	 고객 계약 누적 수 확인
	 i:진행 중
	 e:종료
	*/

	$sub_tail = "";

	if($types){

		if($types=="i"){
			$sub_tail .= "	and (status = 0	and e_date >= curdate())	";
		}else if($types=="e"){
			$sub_tail .= "	and (status = 1	or e_date < curdate())	";
		}
	}


	$sql_con_fun1		= "select count(*) as cnts from tbl_contract where left(r_date,7) = '".$date."' and con_type = 'c' and c_idx = '".$_SESSION[customer][idx]."' " . $sub_tail;
	$result_con_fun1	= mysql_query($sql_con_fun1) or die (mysql_error());
	$row_con_fun1		= mysql_fetch_array($result_con_fun1);

	return $row_con_fun1['cnts'];
}

function get_cnt_tbl_contract_date_cus($c_idx, $date, $types = ''){	// 회원 idx 값 넘겨받아서 처리
	/*
	 고객 계약 누적 수 확인
	 i:진행 중
	 e:종료
	*/

	$sub_tail = "";

	if($types){

		if($types=="i"){
			$sub_tail .= "	and (status = 0	and e_date >= curdate())	";
		}else if($types=="e"){
			$sub_tail .= "	and (status = 1	or e_date < curdate())	";
		}
	}


	$sql_con_fun1		= "select count(*) as cnts from tbl_contract where left(r_date,7) = '".$date."' and con_type = 'c' and c_idx = '".$c_idx."' " . $sub_tail;
	$result_con_fun1	= mysql_query($sql_con_fun1) or die (mysql_error());
	$row_con_fun1		= mysql_fetch_array($result_con_fun1);

	return $row_con_fun1['cnts'];
}

function get_cnt_tbl_contract_etc_date($date){

	$sql_con_fun1		= "select count(*) as cnts from tbl_contract where left(r_date,7) = '".$date."' and con_type = 'e' and c_idx = '".$_SESSION[customer][idx]."' ";
	$result_con_fun1	= mysql_query($sql_con_fun1) or die (mysql_error());
	$row_con_fun1		= mysql_fetch_array($result_con_fun1);

	return $row_con_fun1['cnts'];
}

function get_cnt_tbl_contract_etc_date_cus($c_idx, $date){

	$sql_con_fun1		= "select count(*) as cnts from tbl_contract where left(r_date,7) = '".$date."' and con_type = 'e' and c_idx = '".$c_idx."' ";
	$result_con_fun1	= mysql_query($sql_con_fun1) or die (mysql_error());
	$row_con_fun1		= mysql_fetch_array($result_con_fun1);

	return $row_con_fun1['cnts'];
}


function get_last_payment($goods_type = '' ){
	/*
	 고객의 마지막 결제 내역 확인

	 goods_type - 옵션 확인
	 l:레벨 구입
	 c:코인 구입
	*/

	$sub_tail = "";

	if($goods_type){

		if($goods_type=="l"){
			$sub_tail .= "	and goods_type = 'g_level'	";
		}else if($goods_type=="c"){
			$sub_tail .= "	and goods_type = 'g_coin'	";
		}
	}

	$sql_con_fun2		= "select * from tbl_payment where c_idx = '".$_SESSION[customer][idx]."' and status='Y' " . $sub_tail . " order by idx desc limit 0,1 ";
	$result_con_fun2	= mysql_query($sql_con_fun2) or die (mysql_error());
	$row_con_fun2		= mysql_fetch_array($result_con_fun2);

	return $row_con_fun2;
	
}

function get_last_payment_user_idx($r_idx){
	/*
	 고객의 마지막 결제 내역 확인

	 goods_type - 옵션 확인
	 l:레벨 구입
	 c:코인 구입
	*/

	$sub_tail = "";
	$sub_tail .= "	and goods_type = 'g_level'	";
		

	$sql_con_fun2		= "select * from tbl_payment where c_idx = '".$r_idx."' and status='Y' " . $sub_tail . " order by idx desc limit 0,1 ";
	$result_con_fun2	= mysql_query($sql_con_fun2) or die (mysql_error());
	$row_con_fun2		= mysql_fetch_array($result_con_fun2);

	return $row_con_fun2;
	
}

function get_user_info($cols){
	$sql_user		= "select * from tbl_customer where c_idx = '".$_SESSION[customer][idx]."' ";
	$result_user	= mysql_query($sql_user) or die (mysql_error());
	$row_user		= mysql_fetch_array($result_user);

	return $row_user[$cols];
}


function get_user_point($userid = ''){
	if($userid==''){
		$userid = $_SESSION[customer][id];
	}


	$sql_poi_fun3		= "select coin from tbl_customer where c_idx = '".$_SESSION[customer][idx]."' " . $sub_tail . "";
	$result_poi_fun3	= mysql_query($sql_poi_fun3) or die (mysql_error());
	$row_poi_fun3		= mysql_fetch_array($result_poi_fun3);

	return $row_poi_fun3['coin'];
}



function get_contract_able($_pay_contract){
	
	//$userid = $_SESSION[customer][id];
	
	$tmp_level = get_user_info('level');

	return $_pay_contract[$tmp_level];
}


function get_sms_able(){
	
	//$userid = $_SESSION[customer][id];
	
	// 마지막 결제건에서 쓸 수 있는 문자 수
	$pay_row = get_last_payment('l');

	

	return $pay_row['use_sms'];
}


function get_bill_able(){
	
	//$userid = $_SESSION[customer][id];
	
	// 마지막 결제건에서 쓸 수 있는 문자 수
	$pay_row = get_last_payment('l');

	

	return $pay_row['use_bill'];
}


function get_sms_coin_able($_danga_price){
	
	$userid = $_SESSION[customer][idx];
	/*
	$sql_sms_fun5		= "select sum(cnts) as t_cnt from tbl_paycoin where goods_type = 'sms' and c_idx = '".$_SESSION[customer][idx]."' " . $sub_tail . "";
	$result_sms_fun5	= mysql_query($sql_sms_fun5) or die (mysql_error());
	$row_sms_fun5		= mysql_fetch_array($result_sms_fun5);

	return $row_sms_fun5['t_cnt'];
	*/
	return floor(get_user_point() / $_danga_price[0]);

	
}

function get_mms_coin_able($_danga_price){

	return floor(get_user_point() / $_danga_price[1]);
}


function get_bill_coin_able($_danga_price){
	/*
	$userid = $_SESSION[customer][idx];
	
	$sql_sms_fun5		= "select sum(cnts) as t_cnt from tbl_paycoin where goods_type = 'bill' and c_idx = '".$_SESSION[customer][idx]."' " . $sub_tail . "";
	$result_sms_fun5	= mysql_query($sql_sms_fun5) or die (mysql_error());
	$row_sms_fun5		= mysql_fetch_array($result_sms_fun5);

	return $row_sms_fun5['t_cnt'];
	*/
	return floor(get_user_point() / $_danga_price[2]);
}

function get_user_status($useridx = ''){
	if($useridx==''){
		return false;
	}


	$sql_con_fun6		= " select count(*) as cnts from tbl_contract where c_idx = '".$_SESSION[customer][idx]."' and con_type='c' and e_date >= curdate() and status = 0 and u_idx = '".$useridx."' ";
	$result_con_fun6	= mysql_query($sql_con_fun6) or die (mysql_error());
	$row_con_fun6		= mysql_fetch_array($result_con_fun6);

	if($row_con_fun6['cnts']>0){
		$out_put = 0;
	}else{
		$out_put = 1;
	}

	return $out_put;
}




function sms_able($sms_cnt, $mms_cnt,$_danga_price){	// 문자 보낼 수 있니? sms,mms 개수를 넣어서 확인

	$sms_chk1	= "N";
	$sms_chk2	= "N";
	$sms_chk = "N";

	// 정기권부터 
	if(get_sms_able() >= ($sms_cnt + $mms_cnt*3)  ){	// 보낼 수 있는 문자 수가 더 많다면...
		$sms_chk1 = "Y";
	}

	// 포인트 가능 여부
	if(get_user_point() >= ($sms_cnt*$_danga_price[0] + $mms_cnt*$_danga_price[1])  ){	// 보낼 수 있는 문자 수가 더 많다면...
		$sms_chk2 = "Y";
	}


	if($sms_chk1=="Y" || $sms_chk2=="Y"){
		$sms_chk = "Y";
	}

	return $sms_chk;
}

// 문자 사용 정보 세팅 DB
function use_sms($sms_type, $sms_cnt,$_danga_price){

	$tmp_cnt = $sms_cnt;
	$able_sms = get_sms_able();
	$pay_row = get_last_payment('l');
	$s_idx = $pay_row['idx'];

	if($sms_type == "S"){

		if($able_sms<$tmp_cnt){
			$use1 = $able_sms;
		}else{
			$use1 = $sms_cnt;
		}

		
		if($tmp_cnt>0){
			
			$sql_u = "";
			$sql_u = $sql_u . " update tbl_payment set use_sms = use_sms-'[%use1%]' where idx = '[%idx%]' " ;

			$sql_u = str_replace("[%idx%]",   				$s_idx,				$sql_u);
			$sql_u = str_replace("[%use1%]",				$use1,				$sql_u);	

			mysql_query("set names utf8" );
			mysql_query($sql_u) or die(mysql_error());

		}

		
		$tmp_cnt = $tmp_cnt - $use1;
		

		if($tmp_cnt>0){

			$use_point = $tmp_cnt*$_danga_price[0];

			$sql_u = "";
			$sql_u = $sql_u . " update tbl_customer set coin = coin-'[%coin%]' where c_idx = '".$_SESSION[customer][idx]."' " ;

			$sql_u = str_replace("[%coin%]",				$use_point,			$sql_u);	

			mysql_query("set names utf8" );
			mysql_query($sql_u) or die(mysql_error());


			$sql = "";
			$sql = $sql . "INSERT INTO	  tbl_coin "					;
			$sql = $sql .			   " (c_idx "     					;
			$sql = $sql .			   " ,coin "						;
			$sql = $sql .			   " ,memo "						;
			$sql = $sql .			   " ,regdate) "					;
			$sql = $sql .	   "VALUES "						        ;
			$sql = $sql .			   " ('[%c_idx%]' "					;
			$sql = $sql .			   " ,'-[%coin%]' "					;
			$sql = $sql .			   " ,'문자' "						;
			$sql = $sql .			   " , now() ) "    				;

			
			$sql = str_replace("[%c_idx%]",   			$_SESSION[customer][idx],	$sql);
			$sql = str_replace("[%coin%]",				$use_point,					$sql);	

			mysql_query("set names utf8" );
			mysql_query($sql) or die(mysql_error());

		}

	}else if($sms_type == "M"){

		$tmp_cnt = $sms_cnt*3;
		$able_sms = get_sms_able();
		$able_sms = $able_sms - ($able_sms % 3);

		if($able_sms<$tmp_cnt){
			$use1 = $able_sms;
		}else{
			$use1 = $sms_cnt*3;
		}

		
		if($tmp_cnt>0){
			
			$sql_u = "";
			$sql_u = $sql_u . " update tbl_payment set use_sms = use_sms-'[%use1%]' where idx = '[%idx%]' " ;

			$sql_u = str_replace("[%idx%]",   				$s_idx,				$sql_u);
			$sql_u = str_replace("[%use1%]",				$use1,				$sql_u);	

			mysql_query("set names utf8" );
			mysql_query($sql_u) or die(mysql_error());

		}

		
		$tmp_cnt = $tmp_cnt - $use1;
		

		if($tmp_cnt>0){

			$use_point = $tmp_cnt/3*$_danga_price[1];

			$sql_u = "";
			$sql_u = $sql_u . " update tbl_customer set coin = coin-'[%coin%]' where c_idx = '".$_SESSION[customer][idx]."' " ;

			$sql_u = str_replace("[%coin%]",				$use_point,			$sql_u);	

			mysql_query("set names utf8" );
			mysql_query($sql_u) or die(mysql_error());


			$sql = "";
			$sql = $sql . "INSERT INTO	  tbl_coin "					;
			$sql = $sql .			   " (c_idx "     					;
			$sql = $sql .			   " ,coin "						;
			$sql = $sql .			   " ,memo "						;
			$sql = $sql .			   " ,regdate) "					;
			$sql = $sql .	   "VALUES "						        ;
			$sql = $sql .			   " ('[%c_idx%]' "					;
			$sql = $sql .			   " ,'-[%coin%]' "					;
			$sql = $sql .			   " ,'문자' "						;
			$sql = $sql .			   " , now() ) "    				;

			
			$sql = str_replace("[%c_idx%]",   			$_SESSION[customer][idx],	$sql);
			$sql = str_replace("[%coin%]",				$use_point,					$sql);	

			mysql_query("set names utf8" );
			mysql_query($sql) or die(mysql_error());

		}

	}

}


function bill_able($bill_cnt, $_danga_price){	// 세금계산서 보낼 수 있니?

	$bill_chk1	= "N";
	$bill_chk2	= "N";
	$bill_chk = "N";

	// 정기권부터 
	if(get_bill_able() >= $bill_cnt  ){	// 보낼 수 있는 문자 수가 더 많다면...
		$bill_chk1 = "Y";
	}

	// 포인트 가능 여부
	if(get_bill_coin_able($_danga_price) >= $bill_cnt  ){	// 보낼 수 있는 문자 수가 더 많다면...
		$bill_chk2 = "Y";
	}


	if($bill_chk1=="Y" || $bill_chk2=="Y"){
		$bill_chk = "Y";
	}

	return $bill_chk   ;
	//return $bill_chk1 . " / " . $bill_chk2 . " / " . get_bill_able() . " / " . get_bill_coin_able($_danga_price);
}



// 문자 사용 정보 세팅 DB
function use_bill($bill_cnt,$_danga_price){

	$tmp_cnt = $bill_cnt;
	$able_bill = get_bill_able();
	$pay_row = get_last_payment('l');
	$s_idx = $pay_row['idx'];

	



	if($able_bill < $tmp_cnt){
		$use1 = $able_bill;
	}else{
		$use1 = $bill_cnt;
	}

	
	if($tmp_cnt>0){
		
		$sql_u = "";
		$sql_u = $sql_u . " update tbl_payment set use_bill = use_bill-'[%use1%]' where idx = '[%idx%]' " ;

		$sql_u = str_replace("[%idx%]",   				$s_idx,				$sql_u);
		$sql_u = str_replace("[%use1%]",				$use1,				$sql_u);	

		mysql_query("set names utf8" );
		mysql_query($sql_u) or die(mysql_error());

	}

	
	$tmp_cnt = $tmp_cnt - $use1;
	

	if($tmp_cnt>0){

		$use_point = $tmp_cnt*$_danga_price[2];

		$sql_u = "";
		$sql_u = $sql_u . " update tbl_customer set coin = coin-'[%coin%]' where c_idx = '".$_SESSION[customer][idx]."' " ;

		$sql_u = str_replace("[%coin%]",				$use_point,			$sql_u);	

		mysql_query("set names utf8" );
		mysql_query($sql_u) or die(mysql_error());


		$sql = "";
		$sql = $sql . "INSERT INTO	  tbl_coin "					;
		$sql = $sql .			   " (c_idx "     					;
		$sql = $sql .			   " ,coin "						;
		$sql = $sql .			   " ,memo "						;
		$sql = $sql .			   " ,regdate) "					;
		$sql = $sql .	   "VALUES "						        ;
		$sql = $sql .			   " ('[%c_idx%]' "					;
		$sql = $sql .			   " ,'-[%coin%]' "					;
		$sql = $sql .			   " ,'세금계산서' "				;
		$sql = $sql .			   " , now() ) "    				;

		
		$sql = str_replace("[%c_idx%]",   			$_SESSION[customer][idx],	$sql);
		$sql = str_replace("[%coin%]",				$use_point,					$sql);	

		mysql_query("set names utf8" );
		mysql_query($sql) or die(mysql_error());

	}


}

// 토큰 업데이트
function customer_tokken($user_id, $user_tokken){


	$sql_u = "";
	$sql_u = $sql_u . " update tbl_customer set tokken = '[%user_tokken%]' where user_id = '".$user_id."' " ;

	$sql_u = str_replace("[%user_tokken%]",				$user_tokken,			$sql_u);	

	mysql_query("set names utf8" );
	mysql_query($sql_u) or die(mysql_error());


}
//아래에 쓸데 없이 공백이 생기면 에러 남?>