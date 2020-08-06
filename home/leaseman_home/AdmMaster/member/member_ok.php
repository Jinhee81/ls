<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	$id_chk	= $_POST[id_chk];

	$user_id	= updateSQ($_POST[user_id]);
	$email1		= updateSQ($_POST[email1]);
	$email2		= updateSQ($_POST[email2]);
	$user_pw	= updateSQ($_POST[user_pw]);
	$user_name	= updateSQ($_POST[user_name]);
	$reco_id	= updateSQ($_POST[reco_id]);
	$birthday	= updateSQ($_POST[birthday]);
	$pay_yn		= updateSQ($_POST[pay_yn]);
	$tel1		= updateSQ($_POST[tel1]);
	$tel2		= updateSQ($_POST[tel2]);
	$tel3		= updateSQ($_POST[tel3]);
	$level		= updateSQ($_POST[level]);
	$mobile1	= updateSQ($_POST[mobile1]);
	$mobile2	= updateSQ($_POST[mobile2]);
	$mobile3	= updateSQ($_POST[mobile3]);
	$l_sdate	= updateSQ($_POST[l_sdate]);
	$l_edate	= updateSQ($_POST[l_edate]);
	$zipcode	= updateSQ($_POST[zipcode]);
	$addr		= updateSQ($_POST[addr]);
	$addr2		= updateSQ($_POST[addr2]);
	$pay_type	= updateSQ($_POST[pay_type]);
	$pop_id		= updateSQ($_POST[pop_id]);
	$com_num	= updateSQ($_POST[com_num]);

	
	$email = $email1."@".$email2;
	$tel = $tel1."-".$tel2."-".$tel3;
	$mobile = $mobile1."-".$mobile2."-".$mobile3;

	$status = 0;

	// 알 수 없는 값들
	$com_type = 0; // 일단 법인으로 해봄


	$user_code = create_customer_code();
	//echo $user_code;

	$coin = $_pay_sms[0] * $_danga_price[0];

	$sql = "";
	$sql = $sql . "INSERT INTO	  tbl_customer "	            ;
	$sql = $sql .			   " (user_code "     				;
	$sql = $sql .			   " ,user_id "						;
    $sql = $sql .			   " ,user_pw "					    ;
    $sql = $sql .			   " ,com_type "					;
    $sql = $sql .			   " ,birthday "					;
    $sql = $sql .			   " ,user_name "					;
    $sql = $sql .			   " ,tel "							;
    $sql = $sql .			   " ,mobile "					    ;
	$sql = $sql .			   " ,pay_yn "						;
	$sql = $sql .			   " ,level "						;
	$sql = $sql .			   " ,pay_type "					;
	$sql = $sql .			   " ,user_email "					;
	$sql = $sql .			   " ,reco_id "						;
	$sql = $sql .			   " ,zipcode "				        ;
	$sql = $sql .			   " ,addr "				        ;
	$sql = $sql .			   " ,addr2 "				        ;
	$sql = $sql .			   " ,r_date "				        ;
	$sql = $sql .			   " ,status "				        ;
	$sql = $sql .			   " ,coin "				        ;
	$sql = $sql .			   " ,pop_id "				        ;
	$sql = $sql .			   " ,com_num "				        ;
	$sql = $sql .			   " ,l_sdate "				        ;
	$sql = $sql .			   " ,l_edate) "					;
	$sql = $sql .	   "VALUES "						        ;
	$sql = $sql .			   " ('[%user_code%]' "			    ;
	$sql = $sql .			   " ,'[%user_id%]' "				;
	$sql = $sql .			   " ,password('[%user_pw%]') "		;
	$sql = $sql .			   " ,'[%com_type%]' "				;
	$sql = $sql .			   " ,'[%birthday%]' "				;
	$sql = $sql .			   " ,'[%user_name%]' "				;
	$sql = $sql .			   " ,'[%tel%]' "					;
	$sql = $sql .			   " ,'[%mobile%]' "				;
	$sql = $sql .			   " ,'[%pay_yn%]' "				;
	$sql = $sql .			   " ,'[%level%]' "					;
	$sql = $sql .			   " ,'[%pay_type%]' "				;
	$sql = $sql .			   " ,'[%user_email%]' "			;
	$sql = $sql .			   " ,'[%reco_id%]' "				;
	$sql = $sql .			   " ,'[%zipcode%]' "				;
	$sql = $sql .			   " ,'[%addr%]' "					;
	$sql = $sql .			   " ,'[%addr2%]' "					;
	$sql = $sql .			   " , now() "						;
	$sql = $sql .			   " ,'[%status%]' "				;
	$sql = $sql .			   " ,'[%coin%]' "					;
	$sql = $sql .			   " ,'[%pop_id%]' "				;
	$sql = $sql .			   " ,'[%com_num%]' "				;
	$sql = $sql .			   " ,'[%l_sdate%]' "				;
    $sql = $sql .			   " ,'[%l_edate%]' ) "    			;

	$sql = str_replace("[%user_code%]",   			$user_code,			    $sql);
	$sql = str_replace("[%user_id%]",				$user_id,				$sql);
	$sql = str_replace("[%user_pw%]",				$user_pw,			    $sql);
    $sql = str_replace("[%com_type%]",				$com_type,			    $sql);
    $sql = str_replace("[%birthday%]",				$birthday,			    $sql);
    $sql = str_replace("[%user_name%]",				$user_name,			    $sql);
    $sql = str_replace("[%tel%]",					$tel,					$sql);
    $sql = str_replace("[%mobile%]",				$mobile,			    $sql);
    $sql = str_replace("[%pay_yn%]",				$pay_yn,			    $sql);
    $sql = str_replace("[%level%]",					$level,					$sql);
    $sql = str_replace("[%pay_type%]",				$pay_type,				$sql);
    $sql = str_replace("[%user_email%]",			$email,					$sql);
    $sql = str_replace("[%reco_id%]",				$reco_id,			    $sql);
	$sql = str_replace("[%zipcode%]",				$zipcode,			    $sql);
	$sql = str_replace("[%addr%]",					$addr,					$sql);
	$sql = str_replace("[%addr2%]",					$addr2,					$sql);
	$sql = str_replace("[%status%]",				$status,			    $sql);
	$sql = str_replace("[%coin%]",					$coin,					$sql);
	$sql = str_replace("[%pop_id%]",				$pop_id,				$sql);
	$sql = str_replace("[%com_num%]",				$com_num,				$sql);
	$sql = str_replace("[%l_sdate%]",				$l_sdate,			    $sql);
	$sql = str_replace("[%l_edate%]",				$l_edate,			    $sql);
	

	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());


	$sql_s = "select c_idx from tbl_customer where user_id = '".$user_id."' order by c_idx limit 1 ";
	$result_s = mysql_query($sql_s);
	$row_s = mysql_fetch_array($result_s);

	$c_idx = $row_s['c_idx'];


	$sql = "";
	$sql = $sql . "INSERT INTO	  tbl_coin "					;
	$sql = $sql .			   " (c_idx "     					;
	$sql = $sql .			   " ,coin "						;
	$sql = $sql .			   " ,memo "						;
	$sql = $sql .			   " ,regdate) "					;
	$sql = $sql .	   "VALUES "						        ;
	$sql = $sql .			   " ('[%c_idx%]' "					;
	$sql = $sql .			   " ,'[%coin%]' "					;
	$sql = $sql .			   " ,'회원가입' "					;
	$sql = $sql .			   " , now() ) "    				;

	
	$sql = str_replace("[%c_idx%]",   			$c_idx,			$sql);
	$sql = str_replace("[%coin%]",				$coin,			$sql);	

	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());

?>

<script type="text/javascript">
	alert("등록되었습니다.");
	parent.parent.location.reload();
</script>