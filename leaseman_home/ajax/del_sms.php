<?
	//=====================================================
	//	데이터베이스 접속 정보
	//=====================================================
	$DB_HOST="localhost";
	$DB_USER="lguplus";
	$DB_PWD="jnkmw1459";
	$DB_NAME="lguplus";	

	$connect = mysql_connect($DB_HOST, $DB_USER, $DB_PWD);
	mysql_query("set names utf8",$connect);
	mysql_select_db($DB_NAME, $connect);

	include($_SERVER[DOCUMENT_ROOT].'/lib/basic_class.php');
	$db = new dbConnect($DB_HOST, $DB_NAME, $DB_USER, $DB_PWD);
	$tools = new tools();



	$idx = $_GET['idx'];
	$tb = $_GET['tb'];
	
	if($idx==""){
		echo "error";
		exit;

	}

	if($tb==""){
		echo "error";
		exit;

	}

	if(substr($tb,0,3)=="MMS"){
		$sql = "delete from $tb where MSGKEY = '$idx' ";
	}else{
		$sql = "delete from $tb where TR_NUM = '$idx' ";
	}
	
	mysql_query("set names utf8" );
	mysql_query($sql) or die(mysql_error());

	echo "ok";
	exit;
		
?>

