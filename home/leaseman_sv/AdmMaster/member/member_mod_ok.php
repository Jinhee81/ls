<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");

////////////////////////////////////////////////////////////
// register_globals = Off
////////////////////////////////////////////////////////////
	if($_GET) @extract($_GET);
	if($_POST) @extract($_POST);
	if($_COOKIE) @extract($_COOKIE);

	$c_idx		= $_POST[c_idx];
	$reco_id	= updateSQ($_POST[reco_id]);
	$pay_yn		= updateSQ($_POST[pay_yn]);
	$user_name	= updateSQ($_POST[user_name]);
	$user_pw	= updateSQ($_POST[user_pw]);	// 비밀번호가 있을 때만 수정함
	$level		= updateSQ($_POST[level]);
	$l_sdate	= updateSQ($_POST[l_sdate]);
	$l_edate	= updateSQ($_POST[l_edate]);
	$tel1		= updateSQ($_POST[tel1]);
	$tel2		= updateSQ($_POST[tel2]);
	$tel3		= updateSQ($_POST[tel3]);
	$mobile1	= updateSQ($_POST[mobile1]);
	$mobile2	= updateSQ($_POST[mobile2]);
	$mobile3	= updateSQ($_POST[mobile3]);
	$pay_type	= updateSQ($_POST[pay_type]);
	$zipcode	= updateSQ($_POST[zipcode]);
	$addr		= updateSQ($_POST[addr]);
	$addr2		= updateSQ($_POST[addr2]);
	$email1		= updateSQ($_POST[email1]);
	$email2		= updateSQ($_POST[email2]);
	$e_date		= updateSQ($_POST[e_date]);
	$pop_id		= updateSQ($_POST[pop_id]);
	$com_num	= updateSQ($_POST[com_num]);

	$email = $email1."@".$email2;
	$tel = $tel1."-".$tel2."-".$tel3;
	$mobile = $mobile1."-".$mobile2."-".$mobile3;


	$_tmp_row1 = get_last_payment_user_idx($c_idx);
	$old_level = $_tmp_row1['g_levels'];


	$sql_detail = "";


	if($e_date!=""){
		$sql_detail .= " ,status = 1 ";
	}

	if($user_pw!=""){
		$sql_detail .= " ,user_pw = old_password('".$user_pw."') ";
	}
	
	$sql = "";
	$sql = $sql . "UPDATE  tbl_customer "						;
	$sql = $sql .   " SET    pay_yn='[%pay_yn%]'"				;
	$sql = $sql .         " ,level = '[%level%]' "				;
	$sql = $sql .         " ,l_sdate = '[%l_sdate%]' "			;
	$sql = $sql .         " ,l_edate = '[%l_edate%]' "			;
	$sql = $sql .         " ,tel = '[%tel%]' "					;
	$sql = $sql .         " ,mobile = '[%mobile%]' "			;
	$sql = $sql .         " ,pay_type = '[%pay_type%]' "		;
	$sql = $sql .         " ,zipcode = '[%zipcode%]' "			;
	$sql = $sql .         " ,addr = '[%addr%]' "				;
	$sql = $sql .         " ,addr2 = '[%addr2%]' "				;
	$sql = $sql .         " ,user_email = '[%user_email%]' "	;
	$sql = $sql .         " ,e_date = '[%e_date%]' "			;
	$sql = $sql .         " ,pop_id = '[%pop_id%]' "			;
	$sql = $sql .         " ,com_num = '[%com_num%]' "			;
	$sql = $sql .         " ,user_name = '[%user_name%]' "		;
	$sql = $sql . $sql_detail;
	$sql = $sql . " WHERE    c_idx = '[%c_idx%]' "				;

	$sql = str_replace("[%reco_id%]",				$reco_id,			    $sql);
	$sql = str_replace("[%pay_yn%]",				$pay_yn,			    $sql);
	$sql = str_replace("[%level%]",					$level,					$sql);
	$sql = str_replace("[%l_sdate%]",				$l_sdate,			    $sql);
	$sql = str_replace("[%l_edate%]",				$l_edate,			    $sql);
	$sql = str_replace("[%tel%]",					$tel,					$sql);
	$sql = str_replace("[%mobile%]",				$mobile,			    $sql);
	$sql = str_replace("[%pay_type%]",				$pay_type,				$sql);
	$sql = str_replace("[%zipcode%]",				$zipcode,			    $sql);
	$sql = str_replace("[%addr%]",					$addr,					$sql);
	$sql = str_replace("[%addr2%]",					$addr2,					$sql);
	$sql = str_replace("[%user_email%]",			$email,					$sql);
	$sql = str_replace("[%e_date%]",				$e_date,				$sql);
	$sql = str_replace("[%pop_id%]",				$pop_id,				$sql);
	$sql = str_replace("[%com_num%]",				$com_num,				$sql);
	$sql = str_replace("[%user_name%]",				$user_name,				$sql);
	$sql = str_replace("[%c_idx%]",					$c_idx,					$sql);
	

	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());


	if($old_level != $level && $level != 0){


		$goods_price = "0";
		$now_date = date("Y-m-d");
		$edate = fn_edate($now_date, 1);	// 1달 단위
		$goods_type = "g_level";
		$oid = "MASTER";


		// 기존 빌링은 정보를 날린다.
		$sql_er2 = "update tbl_payment set bill_able='N', bill_key = '' , next_bill = '' where c_idx = '".$c_idx."' ";
		mysql_query($sql_er2);

		$sql = "";
		$sql = $sql . "INSERT INTO	  tbl_payment "					;
		$sql = $sql .			   " (c_idx "     					;
		$sql = $sql .			   " ,price "						;
		$sql = $sql .			   " ,edate "						;
		$sql = $sql .			   " ,goods_type "					;
		$sql = $sql .			   " ,use_sms "						;
		$sql = $sql .			   " ,use_bill "					;
		$sql = $sql .			   " ,oid "							;
		$sql = $sql .			   " ,g_levels "					;
		$sql = $sql .			   " ,status "						;
		$sql = $sql .			   " ,return_msg "					;
		$sql = $sql .			   " ,pay_regdate "					;
		$sql = $sql .			   " ,regdate) "					;
		$sql = $sql .	   "VALUES "						        ;
		$sql = $sql .			   " ('[%c_idx%]' "					;
		$sql = $sql .			   " ,'[%price%]' "					;
		$sql = $sql .			   " ,'[%edate%]' "					;
		$sql = $sql .			   " ,'[%goods_type%]' "			;
		$sql = $sql .			   " ,'[%use_sms%]' "				;
		$sql = $sql .			   " ,'[%use_bill%]' "				;
		$sql = $sql .			   " ,'[%oid%]' "					;
		$sql = $sql .			   " ,'[%g_levels%]' "				;
		$sql = $sql .			   " ,'Y' "							;
		$sql = $sql .			   " ,'관리자 수정' "				;
		$sql = $sql .			   " , now() "						;
		$sql = $sql .			   " , now() ) "    				;

		
		$sql = str_replace("[%c_idx%]",   			$c_idx,							$sql);
		$sql = str_replace("[%price%]",				$goods_price,					$sql);
		$sql = str_replace("[%edate%]",				$edate,							$sql);
		$sql = str_replace("[%goods_type%]",		$goods_type,					$sql);
		$sql = str_replace("[%use_sms%]",			$_pay_sms[$level],				$sql);
		$sql = str_replace("[%use_bill%]",			$_pay_contract[$level],			$sql);
		$sql = str_replace("[%oid%]",				$oid,							$sql);
		$sql = str_replace("[%g_levels%]",			$level,							$sql);


		mysql_query("set names utf8" );
		mysql_query($sql) or die(mysql_error());

	}

?>

<script type="text/javascript">
	alert("수정되었습니다.");
	parent.location.reload();
</script>