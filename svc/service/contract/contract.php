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

$sql_sms = "select
          screen, title, description
        from sms
        where
          user_id={$_SESSION['id']} and
          screen='임대계약화면'";
// echo $sql_sms;

$result_sms = mysqli_query($conn, $sql_sms);
$rowsms = array();
while($row_sms = mysqli_fetch_array($result_sms)){
  $rowsms[] = $row_sms;
}
?>

<!-- 제목 -->
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">계약목록이에요.(#201)</h2>
    <p class="lead">
      (1) 상태(<span class="badge badge-info text-wrap" style="width: 3rem;">현재</span>, <span class="badge badge-warning text-wrap" style="width: 3rem;">대기</span>, <span class="badge badge-danger text-wrap" style="width: 3rem;">종료</span>)로 계약을 구분해요.<br>
      (2) 임대료를 클릭하면 해당 계약의 상세페이지를 볼 수 있어요.<br>
      (3) 계약만 등록된 상태 (clear)는 따로 조회 가능합니다 (현재, 종료, 대기 뒤 clear 선택함)
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
            <td width="6%" class="mobile">
              <select class="form-control form-control-sm selectCall" name="dateDiv">
                <option value="startDate">시작일자</option>
                <option value="endDate">종료일자</option>
                <option value="contractDate">계약일자</option>
                <option value="registerDate">등록일자</option>
              </select><!--codi1-->
            </td>
            <td width="6%" class="mobile">
              <select class="form-control form-control-sm selectCall" name="periodDiv">
                <option value="allDate">--</option>
                <option value="nowMonth">당월</option>
                <option value="pastMonth">전월</option>
                <option value="nextMonth">익월</option>
                <option value="1pastMonth">1개월전</option>
                <option value="nowYear">당년</option>
              </select><!--codi2-->
            </td>
            <td width="8%" class="mobile">
              <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType yyyymmdd"><!--codi3-->
            </td>
            <td width="1%" class="mobile">~</td>
            <td width="8%" class="mobile">
              <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType yyyymmdd"><!--codi4-->
            </td>
            <td width="5%" class="mobile">
              <select class="form-control form-control-sm selectCall" name="progress">
                <option value="pAll">전체</option>
                <option value="pIng" selected>현재</option>
                <option value="pEnd">종료</option>
                <option value="pWaiting">대기</option>
                <option value="clear">clear</option>
              </select><!--codi5-->
            </td>
            <td width="6%" class="">
              <select class="form-control form-control-sm selectCall" name="building">
              </select><!--building-->
            </td>
            <td width="6%" class="mobile">
              <select class="form-control form-control-sm selectCall" name="group">
                <option value="groupAll">그룹전체</option>
              </select><!--group-->
            </td>
            <td width="8%" class="">
              <select class="form-control form-control-sm selectCall" name="etcCondi">
                <option value="customer">성명/사업자명</option>
                <option value="contact">연락처</option>
                <option value="contractId">계약번호</option>
                <option value="roomId">방번호</option>
              </select><!--codi8-->
            </td>
            <td width="12%" class="">
              <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!--codi9-->
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</section>

<!-- 문자 및 세금계산서발행 섹션 -->
<section class="container mb-2">
    <div class="row">
        <div class="col col-md-7">
          <div class="row ml-0">
            <table>
              <tr>
                <td>
                  <select class="form-control form-control-sm" id="smsTitle" name="">
                    <option value="상용구없음">상용구없음</option>
                    <?php for ($i=0; $i < count($rowsms); $i++) {
                      echo "<option value='".$rowsms[$i]['title']."'>".$rowsms[$i]['title']."</option>";
                    } ?>
                  </select>
                </td>
                <td>
                  <button class="btn btn-sm btn-block btn-outline-primary" id="smsBtn" data-toggle="modal" data-target="#smsModal1"><i class="far fa-envelope"></i> 보내기</button>
                </td>
                <td>
                  <a href="/svc/service/sms/smsSetting.php">
                  <button class="btn btn-sm btn-block btn-dark mobile" id="smsSettingBtn"><i class="fas fa-angle-double-right"></i> 상용구설정</button></a>
                </td>
                <td>
                  <a href="/svc/service/sms/sent.php">
                  <button class="btn btn-sm btn-block btn-dark" id="smsSettingBtn"><i class="fas fa-angle-double-right"></i> 보낸문자목록</button></a>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="col col-md-5 mobile">
          <div class="row justify-content-end mr-0">
            <a href="contract_add2.php" role="button" class="btn btn-sm btn-primary mr-1">신규등록</a>
            <button type="button" class="btn btn-sm btn-danger mr-1" name="rowDeleteBtn" data-toggle="tooltip" data-placement="top" title="임대료 숫자 뒤 'c'표시된것만 삭제 가능합니다">선택삭제</button>
            <button type="button" class="btn btn-info btn-sm" name="button" data-toggle="tooltip" data-placement="top" title="작업준비중입니다."><i class="far fa-file-excel"></i>엑셀저장</button>


          </div>
        </div>
    </div>
</section>


<!-- 표내용 -->
<section class="container">
  <table class="table table-hover table-bordered table-sm text-center" id="checkboxTestTbl">
    <thead>
      <tr class="table-secondary">
        <th class="mobile">
          <input type="checkbox" id="allselect">
        </th>
        <th class="">순번</th>
        <th class="">상태</th>
        <th class="">입주자</th>
        <th class="">연락처</th>
        <th class="mobile">그룹명</th>
        <th class="">방번호</th>
        <th class="mobile">시작일</th>
        <th class="mobile">종료일</th>
        <th class="mobile">기간</th>
        <th class="">임대료</th>
        <!-- <th scope="col" class="mobile">단계<i class="fas fa-sort"></i></th> -->
        <th class="mobile">
          <span class="badge badge-light">파일</span>
          <span class="badge badge-dark">메모</span>
        </th>
      </tr>
    </thead>
    <tbody id="allVals">

    </tbody>
  </table>
</section>

<section class="container" id="sql">

</section>

<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/service/sms/modal_sms1.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/sms/modal_sms2.php";
 ?>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>


<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js"></script>
<script src="/svc/inc/js/jquery-ui-timepicker-addon.js"></script>
<script src="/svc/inc/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/checkboxtable.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/sms_noneparase3.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/etc/sms_existparase10.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript">
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
  var roomArray = <?php echo json_encode($roomArray); ?>;
  var smsSettingArray = <?php echo json_encode($rowsms); ?>;
  console.log(buildingArray);
  console.log(groupBuildingArray);
  console.log(roomArray);
</script>

<script src="/svc/inc/js/etc/building.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript" src="js_sms_array_rcontract.js?<?=date('YmdHis')?>"></script>


<script>

function sql(){
  var sql = $.ajax({
    url: 'ajax_realContractSql2.php',
    method: 'post',
    data: $('form').serialize(),
    success: function(data){
      $('#sql').html(data);
    }
  })
  return sql;
}

function maketable(){

  // $(function () {
  //     $('[data-toggle="tooltip"]').tooltip()
  // })

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
          returns += '<td class="mobile"><input type="checkbox" name="rid" value="'+value.rid+'" class="tbodycheckbox"></td>';
          returns += '<td class="" data-toggle="tooltip" data-placement="top" title="'+value.rid+'">'+datacount+'</td>';

          if(value.status2==='present'){
            returns += '<td class=""><div class="badge badge-info text-wrap" style="width: 3rem;">현재</div></td>';
          } if(value.status2==='waiting'){
            returns += '<td class=""><div class="badge badge-warning text-wrap" style="width: 3rem;">대기</div></td>';
          } if(value.status2==='the_end'){
            returns += '<td class=""><div class="badge badge-danger text-wrap" style="width: 3rem;">종료</div></td>';
          }

          returns += '<td class=""><a href="/svc/service/customer/m_c_edit.php?id='+value.cid+'" data-toggle="tooltip" data-placement="top" title="'+value.ccnn+'">'+value.ccnnmb+'</a>';

          returns += '<input type="hidden" name="customername" value="'+value.cname+'">';
          returns += '<input type="hidden" name="customercompanyname" value="'+value.ccomname+'">';
          returns += '<input type="hidden" name="email" value="'+value.email+'">';
          returns += '<input type="hidden" name="customerId" value="'+value.cid+'"></td>';

          returns += '<td class=""><a href="tel:'+value.contact+'">'+value.contact+'</a></td>';
          returns += '<td class="mobile">'+value.gName+'</td>';
          returns += '<td class="">'+value.rName+'</td>';
          returns += '<td class="mobile">'+value.startDate+'</td>';
          returns += '<td class="mobile">'+value.endDate2+'</td>';
          returns += '<td class="mobile">'+value.count2+'</td>';
          returns += '<td class=""><a href="contractEdit.php?id='+value.rid+'" >'+value.mtAmount+'</a>';

          returns += '<input type="hidden" name="mAmount" value="'+value.mAmount+'">';
          returns += '<input type="hidden" name="mvAmount" value="'+value.mvAmount+'">';

          if(value.step==='clear'){
            returns += '<div class="badge badge-warning text-light" style="width: 1rem;">c</div></td>';
          } else {
            returns += '</td>';
          }

          returns += '<td class="mobile">';

          if(value.filecount > 0){
            returns += '<a href="contractEdit.php?id='+value.rid+'" class="badge badge-light">'+value.filecount+'</a>';
          }

          if(value.memocount > 0){
            returns += '<a href="contractEdit.php?id='+value.rid+'" class="badge badge-dark">'+value.memocount+'</a>';
          }

          // returns += value.stepped + '</td>';
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
    // sql();

    $('#href_smsSetting').on('click', function(){
      var moveCheck = confirm('문자상용구설정 화면으로 이동합니다. 이동하시겠습니까?');
      if(moveCheck){
        location.href='/svc/service/sms/smsSetting.php';
      }
    })


    $('.dateType').datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      currentText: '오늘',
      closeText: '닫기'
    })

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
//===========document.ready function end and the other load start!


$('select[name=dateDiv]').on('change', function(){
    maketable();
    // sql();
})

$('select[name=periodDiv]').on('change', function(){
    var periodDiv = $('select[name=periodDiv]').val();
    // console.log(periodDiv);
    dateinput2(periodDiv);
    maketable();
    // sql();
})

$('input[name=fromDate]').on('change', function(){
    maketable();
    // sql();
})

$('input[name=toDate]').on('change', function(){
    maketable();
    // sql();
})

$('select[name=progress]').on('change', function(){
    maketable();
    // sql();
})

$('select[name=building]').on('change', function(){
    maketable();
    // sql();
})

$('select[name=group]').on('change', function(){
    maketable();
    // sql();
})

$('select[name=etcCondi]').on('change', function(){
    maketable();
    // sql();
})


$('input[name=cText]').on('keyup', function(){
    maketable();
    // sql();
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

      for (var i = 0; i < contractArray.length; i++) {
        if(contractArray[i][0]===colOrder){
          var index = i;
          break;
        }
      }
      contractArray.splice(index, 1);
    }
    console.log(contractArray);
    // console.log(typeof(contractArray[3]));
})



//---------contractArray펑션 end 삭제버튼펑션 시작--------------//
$('button[name="rowDeleteBtn"]').on('click', function(){
// console.log(contractArray);

if(contractArray.length === 0){
  alert('1개 이상을 선택하여 주세요.');
  return false;
}

for (var i = 0; i < contractArray.length; i++) {
  if(!(contractArray[i][2] === 'c')){
    alert("'c'표시된것만 삭제 가능합니다."+contractArray[i][0]+"행 확인하세요");
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

<script type="text/javascript" src="/svc/service/get/js_sms_tax.js?<?=date('YmdHis')?>">
</script>

</body>
</html>
