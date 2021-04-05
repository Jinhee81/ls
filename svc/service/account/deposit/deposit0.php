<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/contract/building.php";
?>

<!-- 제목 -->
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h3 class="">보증금목록이에요.(#605)</h3>
    <p class="lead">
      <!-- (1) 상태(진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다.<br>
      (2) 월이용료를 클릭하면 해당 계약의 상세페이지가 나옵니다.<br>
      (3) 단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다. -->
    </p>
  </div>
</section>

<!-- 조회조건 -->
<section class="container">
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <!-- <div class="row justify-content-md-center"> -->
      <form>
        <div class="form-group row justify-content-md-center">
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="dateDiv" name="dateDiv">
              <option value="startDate">시작일자</option>
              <option value="endDate">종료일자</option>
              <option value="contractDate">계약일자</option>
              <option value="registerDate">등록일자</option>
            </select><!--codi1-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="periodDiv" name="periodDiv">
              <option value="allDate">--</option>
              <option value="nowMonth">당월</option>
              <option value="pastMonth">전월</option>
              <option value="1pastMonth">1개월</option>
              <option value="3pastMonth">3개월</option>
            </select><!--codi2-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType"><!--codi3-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType"><!--codi4-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" name="progress">
              <option value="pAll">전체</option>
              <option value="pIng" selected>현재</option>
              <option value="pEnd">종료</option>
              <option value="pWaiting">대기</option>
            </select><!--codi5-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" name="building">
            </select><!--codi6-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" name="group">
            </select><!--codi7-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" name="etcCondi">
              <option value="customer">성명/사업자명</option>
              <option value="contact">연락처</option>
              <option value="contractId">계약번호</option>
              <option value="roomId">방번호</option>
            </select><!--codi8-->
          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!--codi9-->
          </div>
        </div>
      </form>

    <!-- </div> -->

</div>
</section>

<!-- 금액요약 -->
<section class="container">
  <div class="row justify-content-end mr-0">
    <div class="d-flex-reverse flex-row">
        <div class="float-right">
          <!-- <button type="button" class="btn btn-secondary" name="rowDeleteBtn" data-toggle="tooltip" data-placement="top" title="단계가 clear인 것들만 삭제가 가능합니다">삭제</button>
          <a href="contract_add2.php"><button type="button" class="btn btn-primary" name="button">등록</button></a> -->
          <label>잔액 TOTAL : <span id="depositTotal"></span>원</label>
          <label style="color:#007bff;font-style:italic;"> 체크 : <span id="depositSelectCount" class="numberComma">0</span>건, <span id="depositSelectAmount" class="numberComma">0</span>원</label>
        </div>
    </div>
  </div>
</section>

<!-- 표내용 -->
<section class="container">
  <div class="mainTable">
    <table class="table table-hover table-bordered table-sm text-center" id="checkboxTestTbl">
      <thead>
        <tr class="table-secondary">
          <th class="mobile fixedHeader">
            <input type="checkbox" id="allselect">
          </th>
          <th class="fixedHeader">순번</th>
          <th class="fixedHeader">상태</th>
          <th class="fixedHeader">입주자</th>
          <th class="fixedHeader">연락처</th>
          <th class="mobile fixedHeader">그룹명</th>
          <th class="fixedHeader">방번호</th>
          <th class="mobile fixedHeader">입금일</th>
          <th class="mobile fixedHeader">입금액</th>
          <th class="mobile fixedHeader">출금일</th>
          <th class="fixedHeader">출금액</th>
          <th class="fixedHeader">잔액</th>
        </tr>
      </thead>
      <tbody id="allVals">

      </tbody>
    </table>
  </div>
</section>

<!-- 페이지 -->
<section class="container mt-2" id="page">

</section>

<!-- <section class="container" id="sql">

</section> -->

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>


<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/jquery.number.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js"></script>
<script src="/svc/inc/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/checkboxtable.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript">
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
  var roomArray = <?php echo json_encode($roomArray); ?>;
  console.log(buildingArray);
  console.log(groupBuildingArray);
  console.log(roomArray);
</script>

<script src="/svc/inc/js/etc/building.js?<?=date('YmdHis')?>"></script>

<script>

function maketable(x,y){
  var form = $('form').serialize();

  var mtable = $.ajax({
    url: 'ajax_depositLoad0.php',
    method: 'post',
    data: {'form' : form,
           'pagerow' : x,
           'getPage' : y
          },
    success: function(data){
      data = JSON.parse(data);
      datacount = data.length;

      var returns = '';
      var countall;

      // console.log(typeof(x), x);
      // console.log(typeof(y), y);

      if(datacount===0){
        returns ="<tr><td colspan='12'>조회조건에 맞는 값이 없습니다.</td></tr>";
        countall = 0;
      } else {
        $.each(data, function(key, value){
          countall = value.count;
          var ordered = Number(value.num) - ((y-1)*x);
          returns += '<tr>';
          returns += '<td class="mobile"><input type="checkbox" name="rid" value="'+value.rid+'" class="tbodycheckbox"></td>';
          returns += '<td class="" data-toggle="tooltip" data-placement="top" title="'+value.rid+'">'+ordered+'</td>';

          if(value.status2==='present'){
            returns += '<td class=""><div class="badge badge-info text-wrap" style="width: 3rem;">현재</div></td>';
          } if(value.status2==='waiting'){
            returns += '<td class=""><div class="badge badge-warning text-wrap" style="width: 3rem;">대기</div></td>';
          } if(value.status2==='the_end'){
            returns += '<td class=""><div class="badge badge-danger text-wrap" style="width: 3rem;">종료</div></td>';
          }

          returns += '<td class=""><a href="/svc/service/customer/m_c_edit.php?id='+value.cid+'" data-toggle="tooltip" data-placement="top" title="'+value.ccnn+'">'+value.cname+'</a>';

          returns += '<input type="hidden" name="customername" value="'+value.cname+'">';
          returns += '<input type="hidden" name="customercompanyname" value="'+value.ccomname+'">';
          returns += '<input type="hidden" name="email" value="'+value.email+'">';
          returns += '<input type="hidden" name="customerId" value="'+value.cid+'"></td>';

          returns += '<td class=""><a href="tel:'+value.contact+'">'+value.contact+'</a></td>';
          returns += '<td class="mobile">'+value.gName+'</td>';
          returns += '<td class="">'+value.rName+'</td>';
          returns += '<td class="mobile">'+value.inDate+'</td>';
          returns += '<td class="mobile">'+value.inMoney+'</td>';
          if(value.outDate===null){
            returns += '<td class="mobile"></td>';
          } else {
            returns += '<td class="mobile">'+value.outDate+'</td>';
          }

          if(value.outMoney===null || value.outMoney==='0'){
            returns += '<td class="mobile"></td>';
          } else {
            returns += '<td class="">'+value.outMoney;
          }



          if(value.step==='clear'){
            returns += '<div class="badge badge-warning text-light" style="width: 1rem;">c</div></td>';
          } else {
            returns += '</td>';
          }

          returns += '<td class="mobile"><a href="../../contract/contractEdit.php?page=deposit&id='+value.rid+'" class="green">'+value.remainMoney+'</a></td>';

          returns += '</tr>';

        })
      }
      $('#allVals').html(returns);
      $('#countall').text(countall);
      var totalpage = Math.ceil(Number(countall)/Number(x));

      var totalpageArray = [];

      for (var i = 1; i <= totalpage; i++) {
        totalpageArray.push(i);
      }

      var paging = '<nav aria-label="..."><ul class="pagination pagination-sm justify-content-center">';

      for (var i = 1; i <= totalpageArray.length; i++) {
        paging += '<li class="page-item"><a class="page-link">'+i+'</a></li>';
      }

      paging += '</ul></nav>';

      $('#page').html(paging);
    }
  })

  return mtable;
}

$(document).ready(function(){
  var periodDiv = $('select[name=periodDiv]').val();
  dateinput2(periodDiv);

  var pagerow = 50;
  var getPage = 1;

  maketable(pagerow, getPage);
})

//===========document.ready function end and the other load start!


$('select[name=dateDiv]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=periodDiv]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  var periodDiv = $('select[name=periodDiv]').val();
  // console.log(periodDiv);
  dateinput2(periodDiv);
  maketable(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('input[name=fromDate]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('input[name=toDate]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=progress]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=building]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=group]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  // sql(pagerow, getPage);
})

$('select[name=etcCondi]').on('change', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  // sql(pagerow, getPage);
})


$('input[name=cText]').on('keyup', function(){
  var pagerow = 50;
  var getPage = 1;
  maketable(pagerow, getPage);
  // sql(pagerow, getPage);
})
//---------조회버튼클릭평션 end and contractArray 펑션 시작--------------//

</script>

</body>
</html>
