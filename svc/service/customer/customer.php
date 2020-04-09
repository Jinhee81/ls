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
    (1) 임대계약이 발생하면 숫자가 표시됩니다. (2)'기타' 분류는 임대계약 외의 일회성매출에 대한 고객을 분류할 수 있습니다.
    </p>

    <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
      <form>
        <div class="row justify-content-md-center">
          <table>
            <tr>
              <td width="8%">
                <select class="form-control form-control-sm selectCall" name="dateDiv">
                  <option value="registerDate">등록일자</option>
                  <option value="updateDate">수정일자</option>
                </select>
              </td>
              <td width="8%">
                <select class="form-control form-control-sm selectCall" name="periodDiv">
                  <option value="allDate">--</option>
                  <option value="nowMonth">당월</option>
                  <option value="pastMonth">전월</option>
                  <option value="1pastMonth">1개월전</option>
                  <option value="nowYear" selected>당년</option>
                </select>
              </td>
              <td width="10%">
                <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType">
              </td>
              <td width="1%">~</td>
              <td width="10%">
                <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType">
              </td>
              <td width="8%">
                <select name="customerDiv" class="form-control form-control-sm selectCall">
                  <option value="customerAll">구분전체</option>
                  <option value="입주자">입주자</option>
                  <option value="문의">문의</option>
                  <option value="거래처">거래처</option>
                  <option value="기타">기타</option>
                </select>
              </td>
              <td width="8%">
                <select class="form-control form-control-sm selectCall" name="etcCondi">
                  <option value="customer">성명/사업자명</option>
                  <option value="contact">연락처</option>
                  <option value="email">이메일</option>
                  <option value="etc">특이사항</option>
                </select>
              </td>
              <td width="15%">
                <input type="text" name="cText" value="" class="form-control form-control-sm text-center">
              </td>
              <td width="7%">
                <a href="m_c_add.php"><button type="button" class="btn btn-primary btn-sm btn-block" name="button">신규등록</button></a>
              </td>
              <td width="7%">
                <button type="button" class="btn btn-danger btn-sm btn-block" name="rowDeleteBtn">선택삭제</button>
              </td>
              <td width="7%">
                <a href="#"><button type="button" class="btn btn-info btn-sm btn-block" name="button"><i class="far fa-file-excel"></i>엑셀저장</button></a>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>

</section>


<!-- 표내용 -->
<section class="container">
  <table class="table table-hover table-bordered table-sm text-center" id="checkboxTestTbl">
    <thead>
      <tr class="table-secondary">
        <th scope="col" class="mobile"><input type="checkbox" id="allselect"></th>
        <th scope="col">순번</th>
        <th scope="col" class="mobile">구분</th>
        <th scope="col">성명</th>
        <th scope="col">연락처</th>
        <th scope="col" class="mobile">이메일</th>
        <th scope="col" class="mobile">특이사항</th>
        <th scope="col" class="mobile">등록일</th>
        <th scope="col" class="mobile">수정일</th>
        <th scope="col" class="mobile">바로가기</th>
      </tr>
    </thead>
    <tbody id="allVals">

    </tbody>
  </table>
</section>
<section id="allVals2">

</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script><!-- datepicker에 필요한 js file -->
<script src="/svc/inc/js/popper.min.js"></script><!--툴팁함수호출에필요함-->
<script src="/svc/inc/js/bootstrap.min.js"></script><!--툴팁함수호출하면 예쁘게부트스트랩표시가 됨-->
<script src="/svc/inc/js/datepicker-ko.js"></script>
<script src="/svc/inc/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/checkboxtable.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>


<script>

function maketable(){
  var mtable = $.ajax({
    url: 'ajax_customerLoad.php',
    method: 'post',
    data: $('form').serialize(),
    success: function(data){
      data = JSON.parse(data);
      datacount = data.length;

      var returns = '';

      if(datacount===0){
        returns ="<tr><td colspan='10'>조회값이 없어요. 조회조건을 다시 확인하거나 서둘러 입력해주세요!</td></tr>";
      } else {
        $.each(data, function(key, value){
          returns += '<tr>';
          returns += '<td><input type="checkbox" value="'+value.id+'" class="tbodycheckbox"></td>';
          returns += '<td>'+datacount+'</td>';
          returns += '<td>'+value.div1+'</td>';

          if(value.contractCount >= 1){
            returns += '<td><a href="m_c_edit?id='+value.id+'" data-toggle="tooltip" data-placement="top" title="'+value.cName+'">'+value.cNamemb+'</a><span class="badge badge-pill badge-warning">'+value.contractCount+'</span></td>';
          } else {
            returns += '<td><a href="m_c_edit?id='+value.id+'" data-toggle="tooltip" data-placement="top" title="'+value.cName+'">'+value.cNamemb+'</a></td>';
          }

          returns += '<td>'+value.cContact+'</td>';
          returns += '<td>'+value.email+'</td>';
          returns += '<td>'+value.etc+'</td>';
          returns += '<td>'+value.created+'</td>';
          returns += '<td>'+value.updated+'</td>';
          if(value.gothere==='임대계약'){
            returns += '<td><a href="/svc/service/contract/contract_add1.php?id='+value.id+'" class="badge badge-secondary">계약</a></td>';
          } else if(value.gothere==='기타계약'){
            returns += '<td><a href="/svc/service/contractetc/contractetc_add1.php?id='+value.id+'" class="badge badge-secondary">계약</a></td>';
          } else {
            returns += '<td></td>';
          }

          returns += '</tr>';

          datacount -= 1;
        })
      }

      $('#allVals').html(returns);
    }
  })

  return mtable;
}

$(document).ready(function(){

  $(function () {
      $('[data-toggle="tooltip"]').tooltip();
  })

  var periodDiv = $('select[name=periodDiv]').val();
  dateinput2(periodDiv);

  maketable();

  $('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    currentText: '오늘', // 오늘 날짜로 이동하는 버튼 패널
    closeText: '닫기'  // 닫기 버튼 패널
  })

  $(document).on('change', '.tbodycheckbox', function(){
    var allCnt = $(".tbodycheckbox").length;
    var checkedCnt = $(".tbodycheckbox").filter(":checked").length;

    // console.log(allCnt, checkedCnt);

    if($(this).is(":checked")){
      $(this).prop('checked',true);
      $(this).parent().parent().addClass("selected");
    } else {
      $(this).prop('checked',false);
      $(this).parent().parent().removeClass("selected");
    }

    if( allCnt==checkedCnt ){
      $("#allselect").prop("checked", true);
    }
  });


  $('select[name=dateDiv]').on('change', function(){
      maketable();
  })

  $('select[name=periodDiv]').on('change', function(){
      var periodDiv = $('select[name=periodDiv]').val();
      console.log(periodDiv);
      dateinput2(periodDiv);
      maketable();
  })

  $('input[name=fromDate]').on('change', function(){
      maketable();
  })

  $('input[name=toDate]').on('change', function(){
      maketable();
  })

  $('select[name=customerDiv]').on('change', function(){
      maketable();
  })

  $('select[name=etcCondi]').on('change', function(){
      maketable();
  })

  $('input[name=cText]').on('keyup', function(){
      maketable();
  })

  //=================== customerArray start ==============//
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
  //=================== customerArray end ==============//



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



})//document.ready end



</script>
</body>
</html>
