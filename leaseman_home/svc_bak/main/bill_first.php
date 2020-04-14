<?
include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php"; 
header("Content-Type: text/html; charset=utf-8");
?>
<script src="../../js/jquery-2.1.4.min.js" type="text/javascript"></script>
<?

$oid = $_GET['oid'];

if($oid==""){
?>
	<script type="text/javascript">
		alert("잘못 된 접근입니다.");
		location.href="/";
	</script>
<?
}

$sql_pa = "select * from tbl_payment where oid = '".$oid."' ";
$result_pa = mysql_query($sql_pa);
$row_pa = mysql_fetch_array($result_pa);


$sql_ma = "select * from tbl_customer where c_idx = '".$row_pa['c_idx']."' ";
$result_ma = mysql_query($sql_ma);
$row_ma = mysql_fetch_array($result_ma);




if($row_pa['oid']==""){
?>
	<script type="text/javascript">
		alert("잘못 된 접근입니다.");
		location.href="/";
	</script>
<?
}


?>


        <script language="javascript">

            var openwin;

            function repay()
            {
                // 더블클릭으로 인한 중복승인을 방지하려면 반드시 confirm()을
                // 사용하십시오.
				/*
                if (confirm("빌링 하시겠습니까?"))
                {
                    disable_click();
                    openwin = window.open("childwin.html", "childwin", "width=299,height=149");
                    return true;
                }
                else
                {
                    return false;
                }
				*/

				disable_click();
			    openwin = window.open("childwin.html", "childwin", "width=299,height=149");
			    return true;


            }

            function enable_click()
            {
                document.ini.clickcontrol.value = "enable"
            }

            function disable_click()
            {
                document.ini.clickcontrol.value = "disable"
            }

            function focus_control()
            {
                if (document.ini.clickcontrol.value == "disable")
                    openwin.focus();
            }
        </script>

    </head>

    <body onload="javascript:enable_click()" onFocus="javascript:focus_control()">
        <form name="ini" method="post" action="INIreqrealbill_first.php" onSubmit="return repay()">                                         
			<input type="hidden" name="billkey" value="<?=$row_pa['bill_key']?>">			<!-- BillKey -->
			<input type="hidden" name="goodname" value="">								    <!-- 상품명 -->
			<input type="hidden" name="price" value="">				                        <!-- 가격 -->
			<input type="hidden" name="buyername" value="<?=$row_ma['user_name']?>">		<!-- 성명 -->
			<input type="hidden" name="oid" value="<?php echo $orderNumber ?>">								<!-- 주문번호 -->
			<input type="hidden" name="regnumber"  value="">								<!-- 생년월일 -->
			<input type="hidden" name="cardpass" value="">									<!-- 비밀번호 앞2자리 -->
			<input type="hidden" name="buyeremail" value="">								<!-- 전자우편 -->
			<!-- < ?=$_SESSION[customer][email]? > -->
			<input type="hidden" name="buyertel" value="<?=$row_ma['mobile']?>">			<!-- 이동전화 -->
			
			<input type="hidden" name="cardquota" value="00">								<!-- 할부기간 00 : 일시불, 02 2개월 ~ 24 -->
			
			<input type="hidden" name="currency" value="WON">								<!-- 화폐단위 WON, USD -->
			<input type="hidden" name="quotainterest" value="0">							<!-- 무이자할부여부 0:일반할부 1:무이자할부 -->
			<input type="hidden" name="authentification" value="01">						<!-- 본인인증유무 00:본인인증함 01:본인인증안함 -->
			<input type="hidden" name="MerchantReserved1">									<!-- Tax/TaxFree 설정 -->
									
			
                                                                       

            <!-- 
            상점아이디.
            테스트를 마친 후, 발급받은 아이디로 바꾸어 주십시오.
            -->
            <input type="hidden" name="mid" value="leaseman12">

            <!--
            지불수단
            실시간 빌링은 신용카드 전용으로 "Card"로 고정
            -->
            <input type="hidden" name="paymethod" value="Card">
            <input type="hidden" name="clickcontrol" value="">
			<!--
			<input type="submit" value=" 확 인 ">
			-->
        </form>

		

<script type="text/javascript">
	$(document).ready(function(){
		document.ini.submit();
	
	});
</script>