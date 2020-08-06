<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 
	if ($_SESSION[member][id] == "") {
		header('Location:/AdmMaster/');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<meta name="format-detection" content="telephone=no, address=no, email=no" />
	<link href="../css/common.css" rel="stylesheet" type="text/css"/>
	<link href="../css/main.css" rel="stylesheet" type="text/css"/>
	<link href="../css/sub.css" rel="stylesheet" type="text/css"/>
	<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<link href="../img/favicon.ico" rel="icon" type="image/x-icon">
	<script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="../js/jquery.bxslider.js"></script>
	<script src="../js/placeholders.js"></script>
	<script src="../js/script.js" type="text/javascript"></script>
	<script src="../js/calender.js" type="text/javascript"></script>
    <script src="/js/jquery-ui.min.js"></script>


	<!-- <link rel="stylesheet" href="/js/jquery-ui-1.11.2.custom/jquery-ui.css"> -->
	<script type="text/javascript" src="/js/jquery.number.js"></script>
	<script src="/js/jquery-ui-1.11.2.custom/jquery-ui.js"></script>
	<script src="/js/notifIt.js" type="text/javascript"></script>
	<link href="/js/notifIt.css" type="text/css" rel="stylesheet">

	<link rel="stylesheet" href="/js/colorbox-master/example4/colorbox.css" />
	<script src="/js/colorbox-master/jquery.colorbox.js"></script>


		
	<!--notice 스크립트끝-->
	<script src="/js/common.js"></script>
	<script src="/js/jquery.form.js"></script>
	<style type="text/css" >
	.wrap-loading { /*화면 전체를 어둡게 합니다.*/
		position: fixed;
		left:0;
		right:0;
		top:0;
		bottom:0;
		z-index:999;
		background: rgba(0, 0, 0, 0.2); /*not in ie */
	 filter: progid:DXImageTransform.Microsoft.Gradient(startColorstr='#20000000', endColorstr='#20000000');    /* ie */
	}
	.wrap-loading div { /*로딩 이미지*/
		position: fixed;
		top:50%;
		left:50%;
		margin-left: -21px;
		margin-top: -21px;
	}
	.display-none { /*감추기*/
		display:none;
	}
	</style>



	

	<link rel="stylesheet" href="/AdmMaster/_common/css/pop.css" type="text/css" />
	<link rel="stylesheet" href="/AdmMaster/_common/css/import.css" type="text/css" />
	<script>
	//화면의 중앙으로 팝업창 띄우기
	 function PopUp(url, wName, width, height) {//화면의 중앙
	  var LeftPosition = (screen.width/2) - (width/2);
	  var TopPosition = (screen.height/2) - (height/2);
	  var win = window.open(url, wName, "left="+LeftPosition+",top="+TopPosition+",width="+width+",height="+height);
	  if(win == null){
	   alert("팝업차단을 해제해주세요!");
	  } else{
	   win.focus();
	  }
	 }

	//화면의 중앙으로 팝업창 띄우기..(스크롤포함)
	 function PopUpWithScroll(url, wName, width, height) {//화면의 중앙
	  var LeftPosition = (screen.width/2) - (width/2);
	  var TopPosition = (screen.height/2) - (height/2);
	  var win = window.open(url, wName, "left="+LeftPosition+",top="+TopPosition+",width="+width+",height="+height+",scrollbars=yes");
	  if(win == null){
	   alert("팝업차단을 해제해주세요!");
	  } else{
	   win.focus();
	  }
	 }
	</script>



	<script language="JavaScript">
	<!--
	var printpp

	function bp() {
	  printpp = document.body.innerHTML;
	  document.body.innerHTML = print_this.innerHTML;
	}

	function ap() {
	  document.body.innerHTML = printpp;
	}

	function pp() {
	  window.print();
	}


	window.onbeforeprint = bp;
	window.onafterprint = ap;
	//-->
	</script>



	<!--[if lt IE 9]>
		<script src="../js/html5shiv.js"></script>
		<script src="../js/html5shiv-printshiv.js"></script>
	<![endif]-->
	<title>리스맨</title>
</head>