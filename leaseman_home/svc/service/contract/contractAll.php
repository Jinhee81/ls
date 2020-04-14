<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>일괄계약등록1</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include "building.php";
?>

<!-- <script src="csaddss.js?v=<%=System.currentTimeMillis() %>"></script> -->

<style>
  .inputWithIcon input[type=search]{
    padding-left: 40px;
  }
  .inputWithIcon {
    position: relative;
  }
  .inputWithIcon i{
    position: absolute;
    left: 4px;
    top: 4px;
    padding: 9px 8px;
    color: #aaa;
    transition: .3s;
  }
  .inputWithIcon input[type=search]:focus+i{
    color: dodgerBlue;
  }
  #customerList ul {
    background-color: #eee;
    cursor: pointer;
  }
  #customerList li {
    padding: 12px;
  }
</style>

<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">계약일괄등록(1) 화면입니다!</h1>
    <p class="lead">이 화면에서는 그룹별 방계약을 등록합니다.</p>
    <small>(1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다. (2)공실일 경우는 행삭제를 하여 없애주세요.</small>
    <hr class="my-4">
    <a class="btn btn-primary btn-sm" href="contractAll2.php" role="button">일괄계약등록(2)</a>
  </div>
</section>
<section class="container-fluid">
      <div class="container form-row justify-content-center">
          <div class="form-group col-md-2 text-center">
              <label for="">물건명</label>
          </div>
          <div class="form-group col-md-2">
              <select class="form-control form-control-sm" id="building">
              </select>
          </div>
          <div class="form-group col-md-2 text-center">
              <label for="">그룹명</label>
          </div>
          <div class="form-group col-md-2">
              <select class="form-control form-control-sm" id="group">
              </select>
          </div>
          <!-- <div class="form-group col-md-2">
              <button type="button" name="" class="btn btn-info btn-block btn-sm">생성하기
              </button>
          </div> -->
      </div>

      <div class="" id="">
        <table class='table table-bordered text-center' id="table1">

        </table>
      </div>

    <table id="centerSection" class='table table-bordered text-center'>
    </table>
    <div class="bolowButtons">
      <button type='button' class='btn btn-primary' id='saveBtn'>저장</button>
      <a href='contract.php'><button type='button' class='btn btn-secondary'>계약리스트화면으로</button></a>
    </div>
</section>

<script src="/admin/js/jquery-ui.min.js"></script>
<script src="/admin/js/datepicker-ko.js"></script>
<script>

var buildingoption, groupoption, buildingIdx, groupIdx;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
    buildingoption = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
    $('#building').append(buildingoption);
}
buildingIdx = $('#building').val();

for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
    groupoption = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#group').append(groupoption);
}
groupIdx = $('#group').val();

var tableTitle = "<tr><td>방번호</td><td><span id='star' style='color:#F7BE81;'>* </span>세입자</td><td>계약일자</td><td><span id='star' style='color:#F7BE81;'>* </span>공급가액/세액</td><td><span id='star' style='color:#F7BE81;'>* </span>기간</td><td><span id='star' style='color:#F7BE81;'>* </span>시작일(종료일)</td><td>보증금</td><td>보증금입금일</td></tr>";

$('#table1').append(tableTitle);

var tableCol2 ="<td><input type='search' name='customer' class='form-control form-control-sm text-center' required><div class='' name='customerList'></div></td>"; //고객정보

var tableCol3 ="<td><input type='text' name='contractDate' class='form-control form-control-sm text-center dateType yyyymmdd'  maxlength=10></td>"; //계약일자

var tableCol4 ="<td><input type='text' class='form-control form-control-sm text-right amountNumber numberComma' value='0' numberOnly><input type='text' class='form-control form-control-sm text-right amountNumber numberComma' value='0' numberOnly><input type='text' class='form-control form-control-sm text-right amountNumber numberComma' value='0' disabled></td>"; //공급가액/세액/합계

var tableCol5 ="<td><input type='number' class='form-control form-control-sm text-center' min='1' max='72' name='monthCount'></td>"; //기간

var tableCol6 ="<td><input type='text' class='form-control form-control-sm text-center dateType yyyymmdd' name='startDate'  maxlength=10><input type='text' class='form-control form-control-sm text-center dateType' name='endDate' disabled></td>"; //시작일(종료일)

var tableCol7 ="<td><input type='text' class='form-control form-control-sm text-center amountNumber numberComma' value='0' numberOnly></td>"; //보증금

var tableCol8 ="<td><input type='text' class='form-control form-control-sm text-center dateType yyyymmdd' maxlength=10 name='depositInDate'></td></tr>"; //보증금입금일자


for(var key in roomArray[groupIdx]){

    // customerSearch();

    var tableCol1 = "<tr><td><input type='hidden' value='"+key+"'><input type='text' class='form-control form-control-sm text-center' value='"+roomArray[groupIdx][key]+"' disabled><div class='badge badge-warning text-wrap' style='width: 3rem;' name='rowDeleteBtn'>행삭제</div></td>";

    var tableRow = tableCol1 + tableCol2 + tableCol3 + tableCol4 + tableCol5 + tableCol6 + tableCol7 + tableCol8;

    $('#table1').append(tableRow);//관리호수

}



$(document).ready(function(){
  $('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    // showOn: "button",
    buttonImage: "/img/calendar.svg",
    buttonImageOnly: false
  });

  $(".amountNumber").on('click keyup', function(){
    $(this).select();
  });

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
}) //document.ready function closing}




    $('#building').on('change', function(){
        console.log('solmi');
        buildingIdx = $('#building').val();
        $('#group').empty();
        for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
          groupoption = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
          // console.log(select3option);
          $('#group').append(groupoption);
        }
        groupIdx = $('#group').val();

        $('#table1').empty();
        $('#table1').append(tableTitle);
        for(var key in roomArray[groupIdx]){

            // customerSearch();

            var tableCol1 = "<tr><td><input type='hidden' value='"+key+"'><input type='text' class='form-control form-control-sm text-center' value='"+roomArray[groupIdx][key]+"' disabled><div class='badge badge-warning text-wrap' style='width: 3rem;' name='rowDeleteBtn'>행삭제</div></td>";

            var tableRow = tableCol1 + tableCol2 + tableCol3 + tableCol4 + tableCol5 + tableCol6 + tableCol7 + tableCol8;

            $('#table1').append(tableRow);//관리호수

        }
        $('div[name="rowDeleteBtn"]').on('click', function(){
          // console.log('삭제하기');
          var currow = $(this).closest('tr');
          currow.remove();
          // alert('삭제하였습니다');
        })


        $('.dateType').datepicker({
          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
          // showOn: "button",
          buttonImage: "/img/calendar.svg",
          buttonImageOnly: false
        });

        $(".amountNumber").click(function(){
          $(this).select();
        });

        $("input:text[numberOnly]").number(true);

        // $(".numberComma").number(true);
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

    })

    $('#group').on('change', function(event){
        groupIdx = $('#group').val();
        $('#table1').empty();
        $('#table1').append(tableTitle);
        for(var key in roomArray[groupIdx]){

            // customerSearch();

            var tableCol1 = "<tr><td><input type='hidden' value='"+key+"'><input type='text' class='form-control form-control-sm text-center' value='"+roomArray[groupIdx][key]+"' disabled><div class='badge badge-warning text-wrap' style='width: 3rem;' name='rowDeleteBtn'>행삭제</div></td>";

            var tableRow = tableCol1 + tableCol2 + tableCol3 + tableCol4 + tableCol5 + tableCol6 + tableCol7 + tableCol8;

            $('#table1').append(tableRow);//관리호수


        }

        $('div[name="rowDeleteBtn"]').on('click', function(){
          // console.log('삭제하기');
          var currow = $(this).closest('tr');
          currow.remove();
          // alert('삭제하였습니다');
        })



        $('.dateType').datepicker({
          changeMonth: true,
          changeYear: true,
          showButtonPanel: true,
          // showOn: "button",
          buttonImage: "/img/calendar.svg",
          buttonImageOnly: false
        });

        $(".amountNumber").click(function(){
          $(this).select();
        });

        $("input:text[numberOnly]").number(true);

        // $(".numberComma").number(true);

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
    })

    $('div[name="rowDeleteBtn"]').on('click', function(){
      // console.log('삭제하기');
      var currow = $(this).closest('tr');
      currow.remove();
      // alert('삭제하였습니다');
    })

    $('.table').on('keyup', 'input[type="search"]', function(){
      var currow = $(this).closest('tr');

      var query = $(this).val();
      // console.log(query);
      if(query != ''){
        $.ajax({
                url: 'p_customer_search.php',
                method: 'post',
                data: {query : query},
                success: function(data){
                  currow.find('div[name="customerList"]').fadeIn();
                  currow.find('div[name="customerList"]').html(data);
                  }
              })
      }
  })

  $(document).on('click', 'li', function(){
      var currow = $(this).closest('tr');

      currow.find('input[name="customer"]').val($(this).text());
      currow.find('div[name="customerList"]').fadeOut();
  })

$('.table').on('keyup', '.amountNumber:input[type="text"]', function(){
  // console.log('hello');
  var currow = $(this).closest('tr');

  var colmAmount = Number(currow.find('td:eq(3)').children('input:eq(0)').val());
  var colmvAmount = Number(currow.find('td:eq(3)').children('input:eq(1)').val());

  var colmtAmount = colmAmount + colmvAmount;
  currow.find('td:eq(3)').children('input:eq(2)').val(colmtAmount);
  // console.log(colmAmount);
})

$('.table').on('change', 'input[name="contractDate"]', function(){
  // console.log('hellostartdate');
    var currow = $(this).closest('tr');

    getStartDate();
    getDepositInDate();

    function getStartDate(){
        var contractDate = currow.find('td:eq(2)').children('input:eq(0)').val();
        // console.log(contractDate);

        var arr1 = contractDate.split('-');
        var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);

        currow.find('td:eq(5)').children('input:eq(0)').val(dateFormat());

        function dateFormat(){
            var yyyy = sDate.getFullYear().toString();
            var mm = (sDate.getMonth()+1).toString();
            var dd = sDate.getDate().toString();
            var startDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
            return startDate;
        }
    }

    function getDepositInDate(){
        var contractDate = currow.find('td:eq(2)').children('input:eq(0)').val();
        // console.log(contractDate);

        var arr1 = contractDate.split('-');
        var dDate = new Date(arr1[0], arr1[1]-1, arr1[2]);

        currow.find('td:eq(7)').children('input:eq(0)').val(dateFormat());

        function dateFormat(){
            var yyyy = dDate.getFullYear().toString();
            var mm = (dDate.getMonth()+1).toString();
            var dd = dDate.getDate().toString();
            var depositInDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
            return depositInDate;
        }
    }
})

function getEndDate(tr){
  var monthCount = Number(tr.find('td:eq(4)').children('input').val());
  var startDate = tr.find('td:eq(5)').children('input:eq(0)').val();
  console.log(monthCount, startDate);

  var arr1 = startDate.split('-');
  var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);
  var eDate = new Date(sDate.getFullYear(), sDate.getMonth() + monthCount, sDate.getDate()-1);
  // console.log(eDate);

  tr.find('td:eq(5)').children('input:eq(1)').val(dateFormat());

  function dateFormat(){
    var yyyy = eDate.getFullYear().toString();
    var mm = (eDate.getMonth()+1).toString();
    var dd = eDate.getDate().toString();

    var endDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
    return endDate;
  }

}

$('.table').on('change', 'input[name="startDate"]', function(){
  // console.log('hellostartdate');
  var currow = $(this).closest('tr');
  getEndDate(currow);
})

$('.table').on('change', 'input[name="monthCount"]', function(){
  // console.log('hellostartdate');
  var currow = $(this).closest('tr');
  getEndDate(currow);
})

$('#saveBtn').on('click', function(){
  var allCnt = Number($('#table1 input[type="search"]').length);
  console.log(allCnt);
  var allArray = [];

  for (var i = 1; i <= allCnt; i++) {
    var currow = $('tr').eq(i);
    var curArray = [];
    var col1 = currow.find('td:eq(0)').children('input:eq(1)').val();//관리호수
    var col11 = currow.find('td:eq(0)').children('input:eq(0)').val();//관리호수 idx
    var col2 = currow.find('td:eq(1)').children('input').val();//고객정보
    if(!col2){
      alert('세입자는 필수값입니다.');
      return false;
    }

    var col3 = currow.find('td:eq(2)').children('input').val();//계약일자
    var col41 = currow.find('td:eq(3)').children('input:eq(0)').val();//공급가액
    if(Number(col41) < 0){
      alert('공급가액은 반드시 0보다 커야 합니다.');
      return false;
    }
    if(Number(col41) === 0) {
      alert('공급가액은 반드시 0보다 커야 합니다.');
      return false;
    }

    var col42 = currow.find('td:eq(3)').children('input:eq(1)').val();//세액
    if(Number(col42) < 0){
      alert('세액은 반드시 0보다 커야 합니다.');
      return false;
    }

    var col43 = currow.find('td:eq(3)').children('input:eq(2)').val();//합계
    var col5 = currow.find('td:eq(4)').children('input').val();//기간
    if(!col5){
      alert('기간은 필수값입니다.개월수이므로 숫자로 입력해야 합니다.');
      return false;
    }
    if(col5>72){
      alert('계약기간은 72 이하여야 합니다.(72개월 즉 6년까지의 계약만 가능함)');
      return false;
    }

    var col61 = currow.find('td:eq(5)').children('input:eq(0)').val();//시작일
    if(!col61){
      alert('시작일은 필수값입니다.');
      return false;
    }

    var col62 = currow.find('td:eq(5)').children('input:eq(1)').val();//종료일
    var col7 = currow.find('td:eq(6)').children('input').val();//보증금
    if(Number(col7) < 0){
      alert('보증금은 반드시 0보다 커야 합니다.');
      return false;
    }

    var col8 = currow.find('td:eq(7)').children('input').val();//보증금입금일
    curArray.push(col1, col11, col2, col3, col41, col42, col43, col5, col61, col62, col7, col8);
    allArray.push(curArray);
  }

  // console.log(allArray);
  // console.log(typeof(col41), col42, col43);

  var aa = 'p_realContract_add_for';
  var bb = 'p_realContract_add_for.php';
  var cc = 'allArray';

  goCategoryPage(aa, bb, cc, allArray, buildingIdx, groupIdx);

  function goCategoryPage(a, b, c, d, e, f){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, 'buildingId', e);
    frm = formInput(frm, 'groupId', f)
    frm = formInput(frm, c, d);
    formSubmit(frm);
  }


})

</script>
<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>
