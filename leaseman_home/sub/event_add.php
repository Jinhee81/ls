<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";

		$bbs_idx	= updateSQ($_POST['bbs_idx']);
		$m_idx =$_SESSION['member']['idx'];
		$return =array();
		$sql = " select * from tbl_inquiry where product_name='".$bbs_idx."' and m_idx ='".$m_idx."'";
		$result = mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_array($result);
		if($row){ //신청이벤트 체크
			$return['msg'] ="신청하신 이벤트입니다.";
			$return['stat'] =1;
			echo json_encode($return);
			exit();
		}
		//헌혈인증샷 등록여부 체크

		$sql = " select * from tbl_bbs_list where code='photo' and m_idx='".$m_idx."'";
		$result = mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_array($result);
		if(!$row){
			$return['msg'] ="인증샷이 등록되지 않았습니다. 인증샷 등록후 신청해주세요.";
			$return['stat'] =1;
			echo json_encode($return);
			exit();
		}


		$sql = " select * from tbl_bbs_list where bbs_idx='".$bbs_idx."'";
		$result = mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_array($result);
		$total_count =$row['option_type'];
		//카운트 가져오기
		$sql_num ="select count(idx)as num  from tbl_inquiry where product_name ='".$bbs_idx."' ";

		$count_result =mysql_query($sql_num);
		$count_row =mysql_fetch_array($count_result);
		$num_count =$total_count -$count_row['num'];
		if($num_count <1){
			$return['msg'] ="마감된 이벤트입니다.";
			$return['stat'] =1;
			echo json_encode($return);
			exit();
		}

		//신청 이벤트 등록
		$user_id	=$_SESSION['member']['id'];
		$sql ="select * from tbl_member where m_idx ='".$m_idx."'";
		$result = mysql_query($sql) or die(mysql_error());
		$member =mysql_fetch_array($result);

		$column_name = array();
		$r = mysql_query( "DESC tbl_member" );
		while ( $d = mysql_fetch_array( $r ) ) {
			//echo $d[0]."<br>";
			${$d[0]} = viewSQ($member[$d[0]]);
		}
		$_SESSION['member']['id']	= $member['user_id'];
		$_SESSION['member']['idx']	= $member['m_idx'];
		$_SESSION['member']['name'] = $member['user_name'];
		$_SESSION['member']['email'] = $member['user_email'];
		$_SESSION['member']['level'] = $member['user_level'];

		$sql ="
			insert into tbl_inquiry
			set user_name ='".$user_name."',
			user_phone ='".$mobile."',
			user_email ='".$user_email."',
			is_free ='1',
			r_date =now(),
			product_name ='".$bbs_idx."',
			m_idx ='".$m_idx."'
		";

		mysql_query($sql);
		$return['msg'] ="이벤트 등록이 완료되었습니다.";
		$return['stat'] =2;


		echo json_encode($return);
		exit();
?>
