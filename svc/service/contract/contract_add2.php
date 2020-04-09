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
    <h2 class="">임대계약을 등록하세요.</h2>
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
  <form method="post" action="p_realContract_add2.php">
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

    <?php include "contract_add_format.php"; ?>

    <div class="allvals">

    </div>

  </form>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="/svc/inc/js/jquery.number.min.js"></script><
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js"></script>

<script>
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
        $('#customerList').fadeIn();
        $('#customerList').html(data);
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
    // showOn: "button",
    buttonImage: "/img/calendar.svg",
    buttonImageOnly: false
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




var select2option, select3option, select4option, select5option, buildingIdx, groupIdx;
var pay = ["선불", "후불"];

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  select2option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('#select2').append(select2option);
}
buildingIdx = $('#select2').val();

// console.log(buildingArray[buildingIdx][1]);
select5option = "<option value='"+buildingArray[buildingIdx][1]+"'>"+buildingArray[buildingIdx][1]+"</option>";
$('#select5').append(select5option);

for (var i in pay){
  if(pay[i] != buildingArray[buildingIdx][1]){
    select5option = "<option value='"+pay[i]+"'>"+pay[i]+"</option>";
    $('#select5').append(select5option);
  }
}

for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
  select3option = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
  // console.log(select3option);
  $('#select3').append(select3option);
}
groupIdx = $('#select3').val();

for(var key3 in roomArray[groupIdx]){
  select4option = "<option value='"+key3+"'>"+roomArray[groupIdx][key3]+"</option>";
  $('#select4').append(select4option);
}
roomIdx = $('#select4').val();

$('#select2').on('change', function(event){
  buildingIdx = $('#select2').val();
  $('#select3').empty();
  for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
    select3option = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#select3').append(select3option);
  }
  groupIdx = $('#select3').val();

  $('#select4').empty();
  for(var key3 in roomArray[groupIdx]){
    select4option = "<option value='"+key3+"'>"+roomArray[groupIdx][key3]+"</option>";
    $('#select4').append(select4option);
  }

  $('#select5').empty();
  select5option = "<option value='"+buildingArray[buildingIdx][1]+"'>"+buildingArray[buildingIdx][1]+"</option>";
  $('#select5').append(select5option);

  for (var i in pay){
    if(pay[i] != buildingArray[buildingIdx][1]){
      select5option = "<option value='"+pay[i]+"'>"+pay[i]+"</option>";
      $('#select5').append(select5option);
    }
  }
})

$('#select3').on('change', function(event){
  groupIdx = $('#select3').val();
  $('#select4').empty();
  for(var key3 in roomArray[groupIdx]){
    select4option = "<option value='"+key3+"'>"+roomArray[groupIdx][key3]+"</option>";
    $('#select4').append(select4option);
  }
})

// console.log(buildingIdx, groupIdx, roomIdx);

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
