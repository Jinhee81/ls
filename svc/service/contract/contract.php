<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>임대계약</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include "building.php";
?>

<!-- 제목 -->
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">계약목록이에요.(#201)</h2>
    <p class="lead">
      (1) 상태(<span class="badge badge-info text-wrap" style="width: 3rem;">현재</span>, <span class="badge badge-warning text-wrap" style="width: 3rem;">대기</span>, <span class="badge badge-danger text-wrap" style="width: 3rem;">종료</span>)로 계약을 구분해요.<br>
      (2) 임대료를 클릭하면 해당 계약의 상세페이지를 볼 수 있어요.<br>
      <!-- (3) 임대료 옆에 <span class='badge badge-warning text-light' style='width: 1rem;'>c</span>표시된 것은 삭제 가능합니다. -->
    </p>
  </div>
</section>


<!-- 조회조건 -->
<section class="container">
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <form>
      <div class="row justify-content-md-center">
        <table>
          <tr>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="dateDiv">
                <option value="startDate">시작일자</option>
                <option value="endDate">종료일자</option>
                <option value="contractDate">계약일자</option>
                <option value="registerDate">등록일자</option>
              </select><!--codi1-->
            </td>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="periodDiv">
                <option value="allDate">--</option>
                <option value="nowMonth">당월</option>
                <option value="pastMonth">전월</option>
                <option value="nextMonth">익월</option>
                <option value="1pastMonth">1개월전</option>
                <option value="nowYear">당년</option>
              </select><!--codi2-->
            </td>
            <td width="8%">
              <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType"><!--codi3-->
            </td>
            <td width="1%">~</td>
            <td width="8%">
              <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType"><!--codi4-->
            </td>
            <td width="5%">
              <select class="form-control form-control-sm selectCall" name="progress">
                <option value="pAll">전체</option>
                <option value="pIng" selected>현재</option>
                <option value="pEnd">종료</option>
                <option value="pWaiting">대기</option>
              </select><!--codi5-->
            </td>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="building">
              </select><!--building-->
            </td>
            <td width="6%">
              <select class="form-control form-control-sm selectCall" name="group">
                <option value="groupAll">그룹전체</option>
              </select><!--group-->
            </td>
            <td width="8%">
              <select class="form-control form-control-sm selectCall" name="etcCondi">
                <option value="customer">성명/사업자명</option>
                <option value="contact">연락처</option>
                <option value="contractId">계약번호</option>
                <option value="roomId">방번호</option>
              </select><!--codi8-->
            </td>
            <td width="12%">
              <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!--codi9-->
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</section>

<!-- 삭제,등록,엑셀저장부분 -->
<section class="container mb-2">
  <div class="row justify-content-end mr-0">
    <a href="contract_add2.php" role="button" class="btn btn-sm btn-primary mr-1">신규등록</a>
    <button type="button" class="btn btn-sm btn-danger mr-1" name="rowDeleteBtn" data-toggle="tooltip" data-placement="top" title="'c'표시된것만 삭제 가능합니다">선택삭제</button>
    <button type="button" class="btn btn-info btn-sm" name="button" data-toggle="tooltip" data-placement="top" title="작업준비중입니다."><i class="far fa-file-excel"></i>엑셀저장</button>
  </div>
</section>


<!-- 표내용 -->
<section class="container">
  <table class="table table-hover table-bordered table-sm text-center" id="checkboxTestTbl">
    <thead>
      <tr class="table-secondary">
        <th scope="col" class="mobile"><input type="checkbox" id="allselect"></th>
        <th scope="col">순번</th>
        <th scope="col">상태</th>
        <th scope="col">입주자</th>
        <th scope="col">연락처</th>
        <th scope="col" class="mobile">그룹명</th>
        <th scope="col">방번호<i class="fas fa-sort"></i></th>
        <th scope="col" class="mobile">시작일<i class="fas fa-sort"></i></th>
        <th scope="col" class="mobile">종료일<i class="fas fa-sort"></i></th>
        <th scope="col" class="mobile">기간<i class="fas fa-sort"></i></th>
        <th scope="col">임대료<i class="fas fa-sort"></i></th>
        <!-- <th scope="col" class="mobile">단계<i class="fas fa-sort"></i></th> -->
        <th scope="col" class="mobile">
          <span class="badge badge-light">파일</span>
          <span class="badge badge-dark">메모</span>
        </th>
      </tr>
    </thead>
    <tbody id="allVals">

    </tbody>
  </table>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>


<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
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
function maketable(){

  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })

  var mtable = $.ajax({
    url: 'ajax_realContractLoad.php',
    method: 'post',
    data: $('form').serialize(),
    success: function(data){
      data = JSON.parse(data);
      datacount = data.length;

      var returns = '';
      //
      if(datacount===0){
        returns ="<tr><td colspan='12'>조회값이 없어요. 조회조건을 다시 확인하거나 서둘러 입력해주세요!</td></tr>";
      } else {
        $.each(data, function(key, value){
          returns += '<tr>';
          returns += '<td><input type="checkbox" value="'+value.rid+'" class="tbodycheckbox"></td>';
          returns += '<td>'+datacount+'</td>';

          if(value.status2==='present'){
            returns += '<td><div class="badge badge-info text-wrap" style="width: 3rem;">현재</div></td>';
          } if(value.status2==='waiting'){
            returns += '<td><div class="badge badge-warning text-wrap" style="width: 3rem;">대기</div></td>';
          } if(value.status2==='the_end'){
            returns += '<td><div class="badge badge-danger text-wrap" style="width: 3rem;">종료</div></td>';
          }

          returns += '<td><a href="/svc/service/customer/m_c_edit.php?id='+value.cid+'" data-toggle="tooltip" data-placement="top" title="'+value.ccnn+'">'+value.ccnn+'</a></td>';

          returns += '<td>'+value.contact+'</td>';
          returns += '<td>'+value.gName+'</td>';
          returns += '<td>'+value.rName+'</td>';
          returns += '<td>'+value.startDate+'</td>';
          returns += '<td>'+value.endDate2+'</td>';
          returns += '<td>'+value.count2+'</td>';
          returns += '<td><a href="contractEdit.php?id='+value.rid+'" >'+value.mtAmount+'</a>';

          if(value.step==='clear'){
            returns += '<div class="badge badge-warning text-light" style="width: 1rem;">c</div></td>';
          } else {
            returns += '</td>';
          }

          returns += '<td>';

          if(value.filecount > 0){
            returns += '<a href="contractEdit.php?id='+value.rid+'" class="badge badge-light">'+value.filecount+'</a>';
          }

          if(value.memocount > 0){
            returns += '<a href="contractEdit.php?id='+value.rid+'" class="badge badge-dark">'+value.memocount+'</a>';
          }

          returns += '</td>';
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
        $('[data-toggle="tooltip"]').tooltip()
    })

    var periodDiv = $('select[name=periodDiv]').val();
    dateinput2(periodDiv);

    maketable();


    $('.dateType').datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      currentText: '오늘',
      closeText: '닫기'
    })


})
//===========document.ready function end and the other load start!


$('select[name=dateDiv]').on('change', function(){
    maketable();
})

$('select[name=periodDiv]').on('change', function(){
    var periodDiv = $('select[name=periodDiv]').val();
    // console.log(periodDiv);
    dateinput2(periodDiv);
    maketable();
})

$('input[name=fromDate]').on('change', function(){
    maketable();
})

$('input[name=toDate]').on('change', function(){
    maketable();
})

$('select[name=progress]').on('change', function(){
    maketable();
})

$('select[name=building]').on('change', function(){
    maketable();
})

$('select[name=group]').on('change', function(){
    maketable();
})


$('input[name=cText]').on('keyup', function(){
    maketable();
})
//---------조회버튼클릭평션 end and contractArray 펑션 시작--------------//

var contractArray = [];

$(document).on('change', '#allselect', function(){

    var allCnt = $(".tbodycheckbox", table).length;
    contractArray = [];

    if($("#allselect").is(":checked")){
      for (var i = 1; i <= allCnt; i++) {
        var contractArrayEle = [];
        var colOrder = table.find("tr:eq("+i+")").find("td:eq(1)").text().trim();
        var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();
        var colStep = table.find("tr:eq("+i+")").find("td:eq(10)").children('div').text();
        var colFile = table.find("tr:eq("+i+")").find("td:eq(11)").children('a:eq(0)').text();
        var colMemo = table.find("tr:eq("+i+")").find("td:eq(11)").children('a:eq(1)').text();
        contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
        contractArray.push(contractArrayEle);
      }
    } else {
      contractArray = [];
    }
  console.log(contractArray);
})

$(document).on('change', '.tbodycheckbox', function(){
    var contractArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = currow.find('td:eq(0)').children('input').val();
      var colStep = currow.find('td:eq(10)').children('div').text();
      var colFile = currow.find("td:eq(11)").children('a:eq(0)').text();
      var colMemo = currow.find("td:eq(11)").children('a:eq(1)').text();
      contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
      contractArray.push(contractArrayEle);
    } else {
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = currow.find('td:eq(0)').children('input').val();
      var colStep = currow.find('td:eq(10)').children('div').text();
      var colFile = currow.find("td:eq(11)").children('a:eq(0)').text();
      var colMemo = currow.find("td:eq(11)").children('a:eq(1)').text();
      var dropReady = contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
      var index = contractArray.indexOf(dropReady);
      contractArray.splice(index, 1);
    }
    console.log(contractArray);
    // console.log(typeof(contractArray[3]));
})



//---------contractArray펑션 end 삭제버튼펑션 시작--------------//
$('button[name="rowDeleteBtn"]').on('click', function(){
// console.log(contractArray);
for (var i = 0; i < contractArray.length; i++) {
  if(!(contractArray[i][2] === 'c')){
    alert("'c'표시된것만 삭제 가능합니다.");
    return false;
  }
  if(!(contractArray[i][3]==="")){
    alert('메모 또는 파일이 존재하면 삭제 불가합니다.');
    return false;
  }
  if(!(contractArray[i][4]==="")){
    alert('메모 또는 파일이 존재하면 삭제 불가합니다.');
    return false;
  }
}

var aa = 'realContractDelete';
var bb = 'p_realContract_delete_for.php';
var cc = JSON.stringify(contractArray);

goCategoryPage(aa, bb, cc);

function goCategoryPage(a, b, c){
  var frm = formCreate(a, 'post', b,'');
  frm = formInput(frm, 'contractArray', c);
  formSubmit(frm);
}

}) //rowDeleteBtn function closing



$('#button6').click(function(){ //n개월추가 버튼, 모달클릭으로 바뀜
    var allCnt = $(":checkbox:not(:first)", table).length;
    var addMonth = Number($("input[name='addMonth']").val());
    var changeAmount1 = $("input[name='modalAmount1']").val()
    var changeAmount2 = $("input[name='modalAmount2']").val()
    var changeAmount3 = $("input[name='modalAmount3']").val()


    if(Number(addMonth) > 12){
        alert('최대계약기간은 12개월(1년)입니다. 더이상 기간연장은 불가합니다.');
        return false;
    }

    var aa = 'contractScheduleAppendM';
    var bb = 'p_contractScheduleAppendM.php';
    var contractId = '<?=$filtered_id?>';

    goCategoryPage(aa,bb,contractId,addMonth,changeAmount1,changeAmount2,changeAmount3);

    function goCategoryPage(a,b,c,d,e,f,g){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'contractId', c);
        frm = formInput(frm, 'addMonth', d);
        frm = formInput(frm, 'changeAmount1', e);
        frm = formInput(frm, 'changeAmount2', f);
        frm = formInput(frm, 'changeAmount3', g);
        formSubmit(frm);
    }
}); //n개월추가

</script>
</body>
</html>
