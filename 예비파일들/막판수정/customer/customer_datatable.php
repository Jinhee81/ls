<!-- 데이터테이블로 사용하는거는 그냥 버리기로 함 ㅠㅠ -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>입주자리스트</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
?>

<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <div class="row">
      <h2 class="">입주자리스트입니다.</h2>
    </div>
    <p class="lead">
      <!-- (1) 정확한 표현은 이해관계자리스트라고 보아도 무방합니다. 세입자(고객) 뿐만 아니라, 문의하는 사람 및 자주 거래하는 거래처도 저장할 수 있어요.<br> -->
    (1) 방계약이 발생하면 숫자가 표시됩니다. (2)'기타' 분류는 방계약 외의 일회성매출에 대한 고객을 분류할 수 있습니다.
    </p>

    <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
      <form>
        <div class="row justify-content-md-center">
          <table>
            <tr>
              <td width="10%">
                <select class="form-control form-control-sm selectCall" name="dateDiv">
                  <option value="registerDate">등록일</option>
                  <option value="updateDate">수정일</option>
                </select>
              </td>
              <td width="10%">
                <select class="form-control form-control-sm selectCall" name="periodDiv">
                  <option value="allDate">--</option>
                  <option value="nowMonth">당월</option>
                  <option value="pastMonth">전월</option>
                  <option value="1pastMonth">1개월전</option>
                  <option value="nowYear">당년</option>
                  <option value="today" selected>오늘</option>
                </select>
              </td>
              <td width="12%">
                <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType">
              </td>
              <td width="1%">
                ~
              </td>
              <td width="12%">
                <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType">
              </td>
              <td width="8%">
                <a href="m_c_add.php"><button type="button" class="btn btn-primary btn-sm btn-block" name="button">신규등록</button></a>
              </td>
              <td width="8%">
                <button type="button" class="btn btn-danger btn-sm btn-block" name="rowDeleteBtn">선택삭제</button>
              </td>
              <td width="8%">
                <a href="#"><button type="button" class="btn btn-info btn-sm btn-block" name="button"><i class="far fa-file-excel"></i>엑셀저장</button></a>
              </td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>



  <div class="mt-3">
   <table class="table checkboxtable table-sm table-hover table-bordered" id="mydatatable" style="width:100%;">
     <thead>
       <tr>
         <th><input type="checkbox" id="allselect"></th>
         <th>순번</th>
         <th>구분</th>
         <th>성명</th>
         <th>연락처</th>
         <th>이메일</th>
         <th>특이사항</th>
         <th>등록일</th>
         <th>수정일</th>
         <th>바로가기</th>
       </tr>
     </thead>
     <!-- <tfoot>
       <tr>
         <th><input type="checkbox"></th>
         <th>구분</th>
         <th>성명</th>
         <th>연락처</th>
         <th>이메일</th>
         <th>특이사항</th>
         <th>바로가기</th>
       </tr>
     </tfoot> -->
   </table>
  </div>
  <div id="allVals">

  </div>

</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer_script.php"; ?>

<script>


var table = $('#mydatatable').DataTable({
  ajax: {
      url : "ajax_customerLoad.php",
      method: 'post',
      data: $('form').serialize(),
      dataSrc : ""
    },
  columns: [
    {"data" : "id",
     "render" : function(data,type, row){
      return "<input type='checkbox' class='tbodycheckbox' value='"+data+"'>";},
     "orderable" : false
    },
    {"data": "num"},
    {"data" : "div1",
     "orderable" : false
    },
    {"data" : "cName",
      "render" : function(data, type, row){
        if(row.contractCount >= 1){
          data = '<a href="m_c_edit.php?id='+row.id+'" data-toggle="tooltip" data-placement="top" title="'+data+'">'+row.cNamemb+'</a><span class="badge badge-pill badge-warning">'+row.contractCount+'</span>';
        } else {
          data = '<a href="m_c_edit.php?id='+row.id+'" data-toggle="tooltip" data-placement="top" title="'+data+'">'+row.cNamemb+'</a>';
        }
        return data;
      }
    },
    {"data" : "cContact"},
    {"data" : "email"},
    {"data" : "etc"},
    {"data" : "created"},
    {"data" : "updated"},
    {"data" : "gothere",
      "render" : function(data, type, row){
        if(data=='임대계약'){
          data = "<a class='btn btn-info btn-sm' href='/svc/service/contract/contract_add1.php?id="+row.id+"' role='button'>계약</a>";
        } else if(data=='기타계약'){
          data = "<a class='btn btn-info btn-sm' href='/svc/service/contractetc/contractetc_add1.php?id="+row.id+"' role='button'>계약</a>";
        } else {
          data = "";
        }
        return data;
      },
      "orderable" : false
    }
  ],
  language: {
    "emptyTable": "데이터가 없어요.",
    "lengthMenu": "페이지당 _MENU_ 개씩 보기",
    "info": "현재 _START_ - _END_ / _TOTAL_건",
    "infoEmpty": "데이터 없음",
    "infoFiltered": "( _MAX_건의 데이터에서 필터링됨 )",
    "search": "검색: ",
    "zeroRecords": "일치하는 데이터가 없어요.",
    "loadingRecords": "로딩중...",
    "processing":     "잠시만 기다려 주세요...",
    "paginate": {
        "next": "다음",
        "previous": "이전",
        "first": "처음",
        "last": "끝"
    }
  },
  responsive:true,
  scrollX: true,
  scrollY: 400,
  scrollCollaps: true,
  // paging:false
  pagingType: "full_numbers",
  lengthMenu:[30,50,100],
  destroy : true
})


$(document).ready(function(){



  $(function () {
      $('[data-toggle="tooltip"]').tooltip();
  })

  $.datepicker.setDefaults({
        dateFormat: 'yymmdd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년'
    });

  $('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true, // 캘린더 하단에 버튼 패널을 표시한다.
    currentText: '오늘' , // 오늘 날짜로 이동하는 버튼 패널
    closeText: '닫기',  // 닫기 버튼 패널
    dateFormat: "yy-mm-dd" // 텍스트 필드에 입력되는 날짜 형식.
  })



  $(document).on('change', '#allselect', function(){
    if($(this).is(":checked")){
      $('.tbodycheckbox').prop('checked',true);
      $('.tbodycheckbox').parent().parent().addClass("selected");
      // console.log('맨위체크박스 체크함');
    } else {
      $('.tbodycheckbox').prop('checked',false);
      $('.tbodycheckbox').parent().parent().removeClass("selected");
      // console.log('맨위체크박스 체크취소');
    }
  })

  $(document).on('change', '.tbodycheckbox', function(){

    var allCnt = $(".tbodycheckbox").length;
    var checkedCnt = $(".tbodycheckbox").filter(":checked").length;

    // console.log(allCnt, checkedCnt);

    if($(this).is(":checked")){
      $(this).prop('checked',true);
      $(this).parent().parent().addClass("selected");
      // console.log('맨위체크박스 체크함');
    } else {
      $(this).prop('checked',false);
      $(this).parent().parent().removeClass("selected");
      // console.log('맨위체크박스 체크취소');
    }

    if( allCnt==checkedCnt ){
      $("#allselect").prop("checked", true);
    }
  })


  //////////////// customer array start\\\\\\\\\\\\\\\
  var customerArray = [];

  $(document).on('change', '#allselect', function(){
    var table = $('#mydatatable');
    var allCnt = $(".tbodycheckbox").length;
    customerArray = [];

    if($(this).is(":checked")){
      for (var i = 1; i <= allCnt; i++) {
        var customerArrayEle = [];
        var colOrder = table.find("tr:eq("+i+")").find("td:eq(1)").text();
        var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();
        var colStep = table.find("tr:eq("+i+")").find("td:eq(3)").children('span').text();
        customerArrayEle.push(colOrder, colid, colStep);
        customerArray.push(customerArrayEle);
      }
    } else {
      customerArray = [];
    }
    console.log(customerArray);
  })

  $(document).on('change', '.tbodycheckbox', function(){
    var table = $('#mydatatable');
    var customerArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = currow.find('td:eq(0)').children('input').val();
      var colStep = currow.find('td:eq(3)').children('span').text();
      customerArrayEle.push(colOrder, colid, colStep);
      customerArray.push(customerArrayEle);
    } else {
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = currow.find('td:eq(0)').children('input').val();
      var colStep = currow.find('td:eq(3)').children('span').text();
      var dropReady = customerArrayEle.push(colOrder, colid, colStep);
      var index = customerArray.indexOf(dropReady);
      customerArray.splice(index, 1);
    }
    console.log(customerArray);
  })


  $('button[name="rowDeleteBtn"]').on('click', function(){
    console.log(customerArray);
    for (var i = 0; i < customerArray.length; i++) {
      if(Number(customerArray[i][2])>0){
        alert('계약등록된 고객이 포함될 경우 삭제 불가능합니다.');
        return false;
      }
    }

    var aa = 'customerDelete';
    var bb = 'p_m_c_delete_for.php';

    goCategoryPage(aa, bb, customerArray);

    function goCategoryPage(a, b, c){
      var frm = formCreate(a, 'post', b,'');
      frm = formInput(frm, 'customerArray', c);
      formSubmit(frm);
    }

  })

  var periodVal = $('select[name=periodDiv]').val();
  dateinput2(periodVal);

  $('input[name="fromDate"]').on('change', function(){

    console.log('datechange');

    // table.ajax.reload(yes, false);
    table.init();
    $('#mydatatable').DataTable().ajax.reload();

    // var refreshedDataFromTheServer = getDataFromServer();

// var myTable = $('#tableId').DataTable();
// table.clear().rows.add(refreshedDataFromTheServer).draw();

    $.ajax({
        url: 'ajax_customerLoad0.php',
        method: 'post',
        data: $('form').serialize(),
        success: function(data){
          $('#allVals').html(data);
        }
      })

  }) ////select periodDiv function closing



})//document.ready closing}

$('select[name="periodDiv"]').on('change', function(){
    var periodVal = $(this).val();
    // console.log(periodVal);
    dateinput2(periodVal);



    table = $('#mydatatable').DataTable({
    retrieve: true,
    paging: false
    });


}) ////select periodDiv function closing






// $(document).ready(function(){
//   $.ajax({
//     url: 'ajax_customerLoad0.php',
//     method: 'post',
//     data: $('form').serialize(),
//     success: function(data){
//       $('#allVals').html(data);
//     }
//   })
// }) //예비 document.ready closing}


</script>
</body>
</html>
