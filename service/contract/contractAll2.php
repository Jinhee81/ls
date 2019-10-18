<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contract/building.php";
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
    <h1 class="display-4">계약일괄등록(2) 화면입니다!</h1>
    <p class="lead">이 화면에서는 방별로 방계약을 등록합니다.</p>
    <small>(1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다. (2)공실일 경우는 행삭제를 하여 없애주세요.</small>
    <hr class="my-4">
    <a class="btn btn-primary btn-sm" href="contractAll.php" role="button">일괄계약등록(1)</a>
  </div>
</section>
<section class="container-fluid">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col col-lg-10">
            <table class="table table-bordered text-center">
              <tr>
                <td width="20%">물건명</td>
                <td width="20%">그룹명</td>
                <td width="20%">방번호</td>
                <td width="20%">개수</td>
                <td width="10%"></td>
              </tr>
              <tr>
                <td>
                  <select class="form-control form-control-sm" id="select1">
                  </select>
                </td>
                <td>
                  <select class="form-control form-control-sm" id="select2">
                  </select>
                </td>
                <td>
                  <select class="form-control form-control-sm" id="select3">
                  </select>
                </td>
                <td>
                  <input type='number' name='count' class='form-control form-control-sm text-center' min='1' max='10' numberOnly required>
                </td>
                <td>
                  <button type='button' class='btn btn-info btn-sm' id='createBtn'>생성하기</button>
                </td>
              </tr>
            </table>
          </div>
        </div>



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

<script>

var select1option, select2option, select3option, buildingIdx, groupIdx, roomIdx;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
    select1option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
    $('#select1').append(select1option);
}
buildingIdx = $('#select1').val();

for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
    select2option = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#select2').append(select2option);
}
groupIdx = $('#select2').val();

for(var key3 in roomArray[groupIdx]){ //목록출력(201호,202호)
    select3option = "<option value='"+key3+"'>"+roomArray[groupIdx][key3]+"</option>";
    // console.log(select3option);
    $('#select3').append(select3option);
}
roomIdx = $('#select3').val();

$('#select1').on('change', function(event){
    buildingIdx = $('#select1').val();
    $('#select2').empty();
    for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
      select2option = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
      // console.log(select3option);
      $('#select2').append(select2option);
    }
    groupIdx = $('#select2').val();

    $('#select3').empty();
    for(var key3 in roomArray[groupIdx]){ //그룹목록출력(상주,비상주)
      select3option = "<option value='"+key3+"'>"+roomArray[groupIdx][key3]+"</option>";
      // console.log(select3option);
      $('#select3').append(select3option);
    }
    roomIdx = $('#select3').val();
})

$('#select2').on('change', function(event){
  groupIdx = $('#select2').val();

  $('#select3').empty();
  for(var key3 in roomArray[groupIdx]){ //그룹목록출력(상주,비상주)
    select3option = "<option value='"+key3+"'>"+roomArray[groupIdx][key3]+"</option>";
    // console.log(select3option);
    $('#select3').append(select3option);
  }
  roomIdx = $('#select3').val();
})

var tableTitle = "<tr><td>순번</td><td><span id='star' style='color:#F7BE81;'>* </span>세입자</td><td>계약일자</td><td><span id='star' style='color:#F7BE81;'>* </span>공급가액/세액</td><td><span id='star' style='color:#F7BE81;'>* </span>기간</td><td><span id='star' style='color:#F7BE81;'>* </span>시작일(종료일)</td><td>보증금</td><td>보증금입금일</td></tr>";
// $('#table1').append(tableTitle);

var tableCol2 ="<td><input type='search' name='customer' class='form-control form-control-sm text-center' required><div class='' name='customerList'></div></td>"; //고객정보

var tableCol3 ="<td><input type='text' name='contractDate' class='form-control form-control-sm text-center dateType'></td>"; //계약일자

var tableCol4 ="<td><input type='text' class='form-control form-control-sm text-right amountNumber numberComma' value='0'><input type='text' class='form-control form-control-sm text-right amountNumber numberComma' value='0'><input type='text' class='form-control form-control-sm text-right amountNumber numberComma' value='0' disabled></td>"; //공급가액/세액

var tableCol5 ="<td><input type='number' class='form-control form-control-sm text-center' min='1' max='72' name='monthCount'></td>"; //기간

var tableCol6 ="<td><input type='text' class='form-control form-control-sm text-center dateType' name='startDate'><input type='text' class='form-control form-control-sm text-center dateType' name='endDate' disabled></td>"; //시작일(종료일)

var tableCol7 ="<td><input type='text' class='form-control form-control-sm text-center amountNumber numberComma' value='0'></td>"; //보증금

var tableCol8 ="<td><input type='text' class='form-control form-control-sm text-center dateType' name='depositInDate'></td></tr>"; //입금일자

$('#createBtn').on('click', function(){
  // var count = Number($('#count').val());
  var ccount = Number($('input[name="count"]').val());
  // console.log(ccount);
  if(!ccount) {
    alert('개수가 없습니다. 계약개수를 넣어주세요');
    return false;
  }

  if((ccount === 0) || (ccount > 10)){
    alert('1~10 사이 숫자를 입력해야 합니다!')
    return false;
  }

  $('#table1').append(tableTitle);//테이블제목

  for (var i = 1; i <= ccount; i++) {
    var tableCol1 = "<tr><td><input type='text' class='form-control form-control-sm text-center' value='"+i+"' disabled><div class='badge badge-warning text-wrap' style='width: 3rem;' name='rowDeleteBtn'>행삭제</div></td>";

    var tableRow = tableCol1 + tableCol2 + tableCol3 + tableCol4 + tableCol5 + tableCol6 + tableCol7 + tableCol8;

    $('#table1').append(tableRow);//관리호수
  }

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

  $(".numberComma").number(true);

})

$('.table').on('click', 'div[name="rowDeleteBtn"]', function(){
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
  // console.log(monthCount, startDate);

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
  // console.log(allCnt);
  var allArray = [];

  for (var i = 1; i <= allCnt; i++) {
    var currow = $('#table1 tr').eq(i);
    var curArray = [];
    var col1 = currow.find('td:eq(0)').children('input:eq(0)').val();//순번
    var col2 = currow.find('td:eq(1)').children('input:eq(0)').val();//고객정보
    console.log(col1);
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
      alert('기간은 필수값입니다.');
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
    curArray.push(col1, col2, col3, col41, col42, col43, col5, col61, col62, col7, col8);
    allArray.push(curArray);
  }

  // console.log(allArray);
  // console.log(typeof(col41), col42, col43);

  var aa = 'p_realContract_add_for2';
  var bb = 'p_realContract_add_for2.php';
  var cc = 'allArray';

  goCategoryPage(aa, bb, cc, allArray, buildingIdx, groupIdx, roomIdx);

  function goCategoryPage(a, b, c, d, e, f, g){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, 'buildingId', e);
    frm = formInput(frm, 'groupId', f)
    frm = formInput(frm, 'roomId', g)
    frm = formInput(frm, c, d);
    formSubmit(frm);
  }


})

</script>
<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>