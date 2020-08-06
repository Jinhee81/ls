<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
// include $_SERVER['DOCUMENT_ROOT']."/service/contract/building.php";
// print_r($_POST);
$sendArray = json_decode($_POST['smsReadyArray']);
// print_r($sendArray);
// print_r($_SESSION);
?>
<style>
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
        select .selectCall{background-color: #A9D0F5;}

        @media (max-width: 990px) {
        .mobile {
          display: none;
        }
        .green{
          color: #04B486;
        }

        .pink{
          color: #F7819F;
        }
        .appi{
          color:#F7819F;
        }
}
</style>
<section class="container">
  <div class="jumbotron pt-4 pb-3">
    <h1 class="display-4">문자보내기화면입니다!</h1>
    <p class="lead">

    </p>
  </div>
</section>

<section class="container" style="max-width:1000px;">
  <div class="row">
    <div class="col col-md-3">
      <textarea rows="8" cols="80" class="form-control" style="background-color: #FAFAFA;"></textarea>
      <div class="">
        <p class="text-right mb-0">
          <span id="getByte"></span>
          / 80 bytes</p>
        <p class="text-right" id="smsDiv"></p>
        <!-- <p>전송일시</p> -->
        <select class="form-conrol col" style="color:#848484;" id="smsTime">
          <option value="immediately">즉시전송</option>
          <option value="reservation">예약전송</option>
        </select>
        <div id="timeSet" class="mb-2">
        </div>
        <div class="row mb-2">
          <div class="col col-sm-4 pl-0 pr-0">
            <label class="col pr-0">발송번호</label>
          </div>
          <div class="col col-sm-8">
            <input type="text" class="form-control form-control-sm col" name="" value="<?=$_SESSION['cellphone']?>" disabled>
          </div>
        </div>
        <button type="button" name="button" class="btn btn-primary btn-block">전송하기</button>
      </div>

    </div>
    <div class="col col-md-9">
      <div class="text-center text-white" style="background-color:#2E9AFE;height:35px;"><h3 class="lead" style="padding-top:5px;">받는사람</h3></div>
      <div style="height:10px">

      </div>
      <table class="table table-sm text-center" style="color:#848484;" id="checkboxTestTbl">
        <tr>
          <td><input type='checkbox'></td>
          <td>순번</td>
          <td>그룹</td>
          <td>방번호</td>
          <td>세입자</td>
          <td>연락처</td>
        </tr>
        <?php
          $order = 1;
          for ($i=0; $i < count($sendArray); $i++) {
            echo "<tr><td><input type='checkbox' value=".$sendArray[$i][1]."></td><td>$order</td><td>".$sendArray[$i][2]."</td><td>".$sendArray[$i][3]."</td><td>".$sendArray[$i][4]."</td><td>".$sendArray[$i][5]."</td></tr>";
            $order += 1;
          }
         ?>
      </table>
    </div>
  </div>

</section>

<script src="/js/jquery-ui.min.js"></script>
<script src="/js/jquery-ui-timepicker-addon.js"></script>
<script>
var table = $("#checkboxTestTbl");

// 테이블 헤더에 있는 checkbox 클릭시
$(":checkbox:first", table).change(function(){
  if($(":checkbox:first", table).is(":checked")){
    $(":checkbox", table).prop('checked',true);
    $(":checkbox").parent().parent().addClass("selected");
  } else {
    $(":checkbox", table).prop('checked',false);
    $(":checkbox").parent().parent().removeClass("selected");
  }
})

// 헤더에 있는 체크박스외 다른 체크박스 클릭시
$(":checkbox:not(:first)", table).change(function(){
  var allCnt = $(":checkbox:not(:first)", table).length;
  var checkedCnt = $(":checkbox:not(:first)", table).filter(":checked").length;

  if($(this).prop("checked")==true){
    $(this).parent().parent().addClass("selected");
  } else {
    $(this).parent().parent().removeClass("selected");
  }

  if( allCnt==checkedCnt ){
    $(":checkbox:first", table).prop("checked", true);
  }
})

$(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('#smsDiv').html('<span class="badge badge-primary">sms</span>');

    $(":checkbox", table).prop('checked',true);
    $(":checkbox:not(:first)").parent().parent().addClass("selected");

})

$('textarea').on('keyup', function(){
  function byteLength(a){
    var l = 0;

    for (var idx=0; idx<a.length; idx++){
      var c = escape(a.charAt(idx));
      if(c.length==1) l++;
      else if(c.indexOf("%u")!==-1) l += 2;
      else if(c.indexOf("%")!==-1) l += c.length/3;
    }
    return l;
  }
  var textContent = $('textarea').val();
  var getByte = byteLength(textContent);
  // console.log(getByte);
  $("#getByte").html(getByte);

  if(getByte > 80){
    $('#smsDiv').html('<span class="badge badge-danger">mms</span>');
  } else {
    $('#smsDiv').html('<span class="badge badge-primary">sms</span>');
  }
})

$('#smsTime').on('change', function(){


  if($('#smsTime').val()==='reservation'){


    $('#timeSet').html('<input type="text" class="form-control form-control-sm timeType mb-2" name="startTime" value="" placeholder="">');
  } else {
    $('#timeSet').empty();
  }

  $('.timeType').datetimepicker({
    dateFormat:'yy-mm-dd',
    monthNamesShort:[ '1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월' ],
    dayNamesMin:[ '일', '월', '화', '수', '목', '금', '토' ],
    changeMonth:true,
    changeYear:true,
    showMonthAfterYear:true,

    timeFormat: 'HH:mm:ss',
    controlType: 'select',
    oneLine: true
  })

  // console.log('solmi');

})
// if($('#smsTime').val()==='reservation'){
//   // $('#timeSet').append('<input type="text" class="form-control form-control-sm timeType" name="startTime" value="" placeholder="">');
//   $('#timeSet').html('solmi');
// }





//=====================================================================//

var today = new Date();
var yyyy = today.getFullYear();
var mm = today.getMonth() + 1;
var dd = today.getDate();

if(mm<10){
  mm = '0'+mm;
}
if(dd<10){
  dd = '0'+dd;
}

today = yyyy + '-' + mm + '-' + dd;
//-------------------------------------------오늘날짜생성 끝 --------//


$('select[name="periodDiv"]').on('change', function(){

    var periodVal = $(this).val();
    // console.log(periodVal);
    if(periodVal === 'allDate'){
      $('input[name="fromDate"]').val("");
      $('input[name="toDate"]').val("");
    }
    if(periodVal === 'nowMonth'){
      var fromDate = yyyy + '-' + mm + '-01';
      var nowMonth = Number(mm);
      var nowMonthDate = new Date(yyyy,nowMonth,0).getDate();
      var toDate = yyyy + '-' + nowMonth + '-' + nowMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(toDate);
    }
    if(periodVal === 'pastMonth'){
      var pastMonth = Number(mm)-1;
      // console.log(pastMonth);
      var pastMonthDate = new Date(yyyy,pastMonth,0).getDate();
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-01';
      var toDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(toDate);
    }
    if(periodVal === '1pastMonth'){
      var pastMonth = Number(mm)-1;
      // console.log(pastMonth);
      var pastMonthDate = Number(dd);
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }
    if(periodVal === '3pastMonth'){
      var pastMonth = Number(mm)-3;
      // console.log(pastMonth);
      var pastMonthDate = Number(dd);
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }
    if(periodVal === 'nowYear'){
      var pastMonth = Number(1);
      // console.log(pastMonth);
      var pastMonthDate = Number(1);
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }

}) ////select periodDiv function closing


</script>
<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
