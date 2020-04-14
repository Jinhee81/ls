<!-- 고객등록하고나서 계약등록버튼누르면 계약등록하는거 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>임대계약 등록</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include "building.php";
// print_r($_SESSION);
// print_r($_GET['id']);
$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//고객아이디
settype($filtered_id, 'integer');

$sql_c = "
          select
              id, name, div2, div3, companyname, contact1, contact2, contact3,
              cNumber1, cNumber2, cNumber3
            from customer
            where id={$filtered_id}
    ";
// echo $sql_c;
$result_c = mysqli_query($conn, $sql_c);
$row_c = mysqli_fetch_array($result_c);

$clist['id'] = htmlspecialchars($row_c['id']);
$clist['div2'] = htmlspecialchars($row_c['div2']);
$clist['contact1'] = htmlspecialchars($row_c['contact1']);
$clist['contact2'] = htmlspecialchars($row_c['contact2']);
$clist['contact3'] = htmlspecialchars($row_c['contact3']);
$clist['name'] = htmlspecialchars($row_c['name']);
$clist['companyname'] = htmlspecialchars($row_c['companyname']);
$clist['cNumber1'] = htmlspecialchars($row_c['cNumber1']);
$clist['cNumber2'] = htmlspecialchars($row_c['cNumber2']);
$clist['cNumber3'] = htmlspecialchars($row_c['cNumber3']);

// print_r($clist);

$cNumber = $clist['cNumber1'].'-'.$clist['cNumber2'].'-'.$clist['cNumber3'];
$cContact = $clist['contact1'].'-'.$clist['contact2'].'-'.$clist['contact3'];

if($row_c['div3']==='주식회사'){
  $cDiv3 = '(주)';
} elseif($row_c['div3']==='유한회사'){
  $cDiv3 = '(유)';
} elseif($row_c['div3']==='합자회사'){
  $cDiv3 = '(합)';
} elseif($row_c['div3']==='기타'){
  $cDiv3 = '(기타)';
}

if($clist['div2']==='개인사업자'){
  $cName = $clist['name'].'('.$clist['companyname'].','.$cNumber.')';
} else if($clist['div2']==='법인사업자'){
  $cName = $cDiv3.$clist['companyname'].'('.$clist['name'].','.$cNumber.')';
} else if($clist['div2']==='개인'){
  $cName = $clist['name'];
}

$output = $cName.' | '.$cContact.' | '.$clist['id'];

?>

<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">임대계약을 등록하세요.(#203)</h2>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[입주자자정보]</b>에는 입주자만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) <b>[입주자정보]</b>의 제일우측 숫자는 고객번호로써 시스템데이터임을 참고하여주세요. (3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small>
  </div>
</section>
<section class="container">
  <form method="post" action="p_realContract_add1.php">
    <div class="form-row">
        <div class="form-group col-md-2">
              <label><b>[입주자정보]</b></label>
        </div>
        <div class="form-group col-md-10 inputWithIcon">
              <input type="text" class="form-control" name="customer" id="customer" value="<?=$output?>" disabled>
              <input type="hidden" name="customer" value="<?=$clist['id']?>">
        </div>
    </div>

    <?php include "contract_add_format.php"; ?>


  </form>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>

<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery.number.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js"></script>

<script type="text/javascript">
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
  var roomArray = <?php echo json_encode($roomArray); ?>;
  console.log(buildingArray);
  console.log(groupBuildingArray);
  console.log(roomArray);
</script>

<script src="/svc/inc/js/etc/buildingoption.js?<?=date('YmdHis')?>"></script>

<script>
$(document).ready(function(){
  $('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    currentText: '오늘',
    closeText: '닫기'
  })

  $('.amountNumber').on('click keyup', function(){
    $(this).select();
  })

  $("input:text[numberOnly]").number(true);

  $('.yyyymmdd').keydown(function (event) {
   var key = event.charCode || event.keyCode || 0;
   $text = $(this);
   if (key !== 8 && key !== 9) {
       if ($text.val().length === 4) {
           $text.val($text.val() + '-');
       }
       if ($text.val().length === 7) {
           $text.val($text.val() + '-');
       }
   }

   return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
  // Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
  // 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
  })

})//document.ready function closing}

$('#contractDate').on('change', function(){
  var readyStartDate = $('#contractDate').val();

  getStartDate();

  function getStartDate(){
    var arr1 = readyStartDate.split('-');
    var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);

    dateFormat();
    $('#startDate').attr('value', dateFormat());

    function dateFormat(){
      var yyyy = sDate.getFullYear().toString();
      var mm = (sDate.getMonth()+1).toString();
      var dd = sDate.getDate().toString();

      var startDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
      return startDate;
    }
  }
}) //contractDate on change closing괄호, 최초계약일자=시작일자

$('#contractDate').on('change', function(){
  var readyStartDate = $('#contractDate').val();

  getDepositInDate();

  function getDepositInDate(){
    var arr1 = readyStartDate.split('-');
    var gDate = new Date(arr1[0], arr1[1]-1, arr1[2]);

    dateFormat();
    $('#depositInDate').attr('value', dateFormat());

    function dateFormat(){
      var yyyy = gDate.getFullYear().toString();
      var mm = (gDate.getMonth()+1).toString();
      var dd = gDate.getDate().toString();

      var depositInDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
      return depositInDate;
    }
  }
}) //contractDate on change closing괄호, 최초계약일자=보증금입금일자



function getEndDate(){
  var a = Number($("input[name='monthCount']").val());
  var b = $('#startDate').val();
  // console.log(b);
  var arr1 = b.split('-');
  var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);
  // console.log(sDate);
  // var eDate = new Date(arr1[0], arr1[1]-1+a, arr1[2]-1);
  var eDate = new Date(sDate.getFullYear(), sDate.getMonth() + a, sDate.getDate()-1);
  // console.log(eDate);
  // console.log(a);

  dateFormat();
  $('#endDate').attr('value', dateFormat());
  $('#endDate1').attr('value', dateFormat());

  function dateFormat(){
    var yyyy = eDate.getFullYear().toString();
    var mm = (eDate.getMonth()+1).toString();
    var dd = eDate.getDate().toString();

    var endDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
    return endDate;
  }

}

$('#startDate').on('change', function(event){
  getEndDate();
})

$('input[name="monthCount"]').on('change', function(event){
  getEndDate();
})


$("input[name='mAmount']").on('keyup', function(){
  var amount1 = Number($(this).val());
  var amount2 = Number($("input[name='mvAmount']").val());
  var amount12 = amount1 + amount2;
  $("input[name='mtAmount']").val(amount12);
})

$("input[name='mvAmount']").on('keyup', function(){
  var amount1 = Number($("input[name='mAmount']").val());
  var amount2 = Number($(this).val());
  var amount12 = amount1 + amount2;
  $("input[name='mtAmount']").val(amount12);
})


</script>

</body>
</html>
