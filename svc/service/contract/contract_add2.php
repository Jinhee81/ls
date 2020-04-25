<!-- 계약리스트화면에서 등록버튼누르면 나오는 거 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include "building.php";
// print_r($_SESSION);

?>
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">임대계약을 등록하세요.(#204)</h2>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[입주자자정보]</b>에는 입주자만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) <b>[입주자정보]</b>의 제일우측 숫자는 고객번호로써 시스템데이터임을 참고하여주세요. (3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small>
    <hr class="my-4">
    <a class="btn btn-primary btn-sm" href="contractAll.php" role="button">일괄계약등록(1)</a>
    <a class="btn btn-primary btn-sm" href="contractAll2.php" role="button">일괄계약등록(2)</a>
    <!-- <a class="btn btn-primary btn-sm" href="contractCustomer.php" role="button">그룹별세입자등록</a>-->
    <a class="btn btn-primary btn-sm" href="contractCsv.php" role="button">계약csv등록</a>
    <a class="btn btn-primary btn-sm" href="/svc/service/customer/m_c_add.php" role="button">입주자등록</a>
  </div>
</section>
<section class="container">
  <form method="post" action="p_realContract_add.php">
    <div class="form-row">
        <div class="form-group col-md-2">
              <label><b>[입주자정보]</b></label>
        </div>
        <div class="form-group col-md-10 inputWithIcon">
              <input type="search" class="form-control" name="customer" id="customer" value="" required>
              <i class="fas fa-search fa-lg fa-fw" aria-hidden="true"></i>
              <div class="" id="customerList">
              </div>
              <input type="hidden" name="customerId" id="customerId" value=""> <!--원래는 ajax로 별도로 고객번호를 가져오고싶었는데 방법을 몰라서 못한거고 별도로 가져올때 다시 수정할거2-->
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2">
            <label><b>[물건정보]</b></label>
        </div>
        <div class="form-group col-md-10" id="mulgunInfo">
              <div class="form-row">
                <!-- <div class="form-group col-md-2">
                    <label>공실구분</label>
                    <select id="select1" name="" class="form-control" onchange="">
                      <option value="">전체</option>
                      <option value="" selected>공실</option>
                      <option value="">만실</option>
                    </select>
                </div> -->
                <div class="form-group col-md-2"><!--물건목록-->
                    <label>물건명</label>
                    <select name="building" class="form-control">
                      <option value="<?=$row_c['bid']?>"><?=$row_c['bName']?></option>
                    </select>
                </div>
                <div class="form-group col-md-2"><!--그룹목록-->
                    <label>그룹명</label>
                    <select name="group" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-2"><!--관리번호목록-->
                    <label>관리번호</label>
                    <select name="room" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>최초 계약일자</label>
                    <input type="text" id="contractDate" class="form-control dateType yyyymmdd" name="contractDate" placeholder="">
                </div>
              </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2 mb-0">
            <label><b>[임대료정보]</b></label>
        </div>
        <div class="form-group col-md-10 mb-0">
          <div class="form-row">
              <div class="form-group col-md-2 mb-0">
                    <label><span id='star' style='color:#F7BE81;'>* </span>공급가액</label>
                    <input type="text" class="form-control text-right amountNumber" name="mAmount" value="0" numberOnly required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label>세액</label>
                    <input type="text" class="form-control text-right amountNumber" name="mvAmount" value="0" numberOnly required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label>합계</label>
                    <input type="text" class="form-control text-right amountNumber" name="mtAmount" placeholder="0" numberOnly readonly>
              </div>
              <div class="form-group col-md-1 mb-0"><!--선불,후불체크-->
                    <label>수납</label>
                    <select name="payOrder" class="form-control">
                    </select>
              </div>
              <div class="form-group col-md-1 mb-0">
                    <label><span id='star' style='color:#F7BE81;'>* </span>기간</label>
                    <input type="number" class="form-control" name="monthCount" value="12" min="1" max="72" required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label><span id='star' style='color:#F7BE81;'>* </span>시작일자</label>
                    <input type="text" id="startDate" class="form-control dateType yyyymmdd" name="startDate" value="" placeholder="" required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label>종료일자</label>
                    <input type="text" id="endDate" class="form-control" name="endDate" placeholder="" readonly>
              </div>
        </div>
      </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
        </div>
        <div class="form-group col-md-10">
            <small class="form-text text-muted">매월 받아야하는 임대료(월세)를 입력합니다.</small>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2 mb-0">
          <label><b>[보증금정보]</b></label>
        </div>
        <div class="form-group col-md-10 mb-0">
            <div class="form-row">
                <div class="form-group col-md-3 mb-0">
                    <label>금액</label>
                    <input type="text" class="form-control text-right amountNumber" name="depositInAmount" value="0" placeholder="0" numberOnly>
                </div>
                <div class="form-group col-md-3 mb-0">
                    <label>입금일자</label>
                    <input type="text" class="form-control dateType yyyymmdd" name="depositInDate" id="depositInDate" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
        </div>
        <div class="form-group col-md-10">
            <small class="form-text text-muted">보증금을 받았다면, 보증금과 날짜를 입력하세요.</small>
        </div>
    </div>
    <div class="">
      <button type='submit' class='btn btn-primary'>저장</button>
      <a href='contract.php'><button type='button' class='btn btn-secondary'><i class="fas fa-angle-double-right"></i> 계약목록</button></a>
    </div>
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

<!-- <script src="/svc/inc/js/etc/buildingoption.js?<?=date('YmdHis')?>"></script> -->

<script>
var customerId, buildingId, buidlingName;

function customersearch(){
  var query = $('#customer').val();
  // console.log(query);
  var customerlist;

  if(query != ''){
    customerlist = $.ajax({
      url: 'ajax_customer_search.php',
      method: 'post',
      data: {query : query},
      success: function(data){
        data = JSON.parse(data);
        datacount = data.length;

        var returns = '';
        var buildingoption = '';
        //
        if(datacount===0){
          returns ="<ul><li>조회값이 없어요. 조회조건을 다시 확인하거나 서둘러 입력해주세요.</li></ul>";
        } else {
          returns += '<ul class="list-unstyled">';
          $.each(data, function(key, value){
            returns += '<li>'+value.ccnn;
            returns += '<input type="hidden" name="customerId" value="'+value.cid+'">';
            returns += '<input type="hidden" name="buildingId" value="'+value.bid+'">';
            returns += '<input type="hidden" name="buildingName" value="'+value.bName+'">';
            returns += '<input type="hidden" name="buildingPay" value="'+value.pay+'"></li>';
          })
          returns += '</ul>';
        }

        $('#customerList').fadeIn();
        $('#customerList').html(returns);
      }
    })
  }
  return customerlist;
}


$(document).ready(function(){

  $('#customer').keyup(function(){
    customersearch();

    // var query = $(this).val();
    // $.ajax({
    //       url: 'ajax_customer_search.php',
    //       method: 'post',
    //       data: {'query' : query},
    //       success: function(data){
    //         $('.allvals').html(data);
    //       }
    //     })
  })

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

$(document).on('click', 'li', function(){
  $('#customer').val($(this).text());
  $('#customerList').fadeOut();
  // var customerId = $(this).attr('customerId');
  var a = $(this);
  var customerId = a.children('input[name=customerId]').val();
  var buildingIdx = a.children('input[name=buildingId]').val();
  var buildingName = a.children('input[name=buildingName]').val();
  var buildingPay = a.children('input[name=buildingPay]').val();

  console.log(a);
  console.log(customerId, buildingIdx, buildingName, buildingPay);

  $('#customerId').val(customerId);
  $('select[name=building]').html('<option value="'+buildingIdx+'">'+buildingName+'</option>');
  $('select[name=payOrder]').html('<option value="'+buildingPay+'">'+buildingPay+'</option>');

  for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
    groupoption = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(groupoption);
    $('select[name=group]').append(groupoption);
  }
  groupIdx = $('select[name=group]').val();

  for(var key3 in roomArray[groupIdx]){
    roomoption = "<option value='"+key3+"'>"+roomArray[groupIdx][key3]+"</option>";
    $('select[name=room]').append(roomoption);
  }

})//ul click }

$('select[name=group]').on('change', function(){
  $('select[name=room]').empty();
  groupIdx = $('select[name=group]').val();

  for(var key3 in roomArray[groupIdx]){
    roomoption = "<option value='"+key3+"'>"+roomArray[groupIdx][key3]+"</option>";
    $('select[name=room]').append(roomoption);
  }
})

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


$('#saveBtn').on('click', function(){
  var amount1 = Number($("input[name='mAmount']").val());
  if(amount1 === 0){
    alert('공급가액은 0보다 커야 저장됩니다.');
    return false;
  }
})

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>
