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
<style>
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
        select .selectCall{background-color: #A9D0F5;}

        @media (max-width: 990px) {
        .mobile {
          display: none;
        }
}
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">방계약리스트 화면입니다!</h1>
    <p class="lead">
      (1) 상태(진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다.<br>
      (2) 월이용료를 클릭하면 해당 계약의 상세페이지가 나옵니다.<br>
      (3) 단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다.
    </p>
  </div>

  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <div class="row justify-content-md-center">
      <table>
        <tr>
          <td class="mobile">
            <select class="form-control form-control-sm selectCall" name="dateDiv">
              <option value="">시작일자</option>
              <option value="">종료일자</option>
              <option value="">계약일자</option>
              <option value="">등록일자</option>
            </select>
          </td>
          <td class="mobile">
            <select class="form-control form-control-sm selectCall" name="periodDiv">
              <option value="allDate">--</option>
              <option value="nowMonth">당월</option>
              <option value="pastMonth">전월</option>
              <option value="1pastMonth">1개월</option>
              <option value="3pastMonth">3개월</option>
            </select>
          </td>
          <td class="mobile">
            <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType" id="">
          </td><!--from date-->
          <td class="mobile">~</td>
          <td class="mobile">
            <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType" id="">
          </td><!--to date-->
          <td class="mobile"><select class="form-control form-control-sm selectCall">
            <option value="">전체</option>
            <option value="">진행</option>
            <option value="">종료</option>
            <option value="">대기</option>
          </select>
          </td>
          <td><select class="form-control form-control-sm selectCall" id="select1">
            <!-- <option value="등록일자">물건명</option> -->
          </select></td>
          <td><select class="form-control form-control-sm selectCall" id="select2">
            <!-- <option value="등록일자">그룹명</option> -->
          </select></td>
          <td class="mobile"><select class="form-control form-control-sm selectCall">
            <option value="">세입자</option>
            <option value="">연락처</option>
            <option value="">계약번호</option>
            <option value="">방번호</option>
          </select>
          </td>
          <td><input type="text" name="" value="" class="form-control form-control-sm text-center"></td>
          <td><button type="button" name="button" class="btn btn-info btn-sm">조회</button></td>
        </tr>
      </table>
    </div>
  </div>
  <?php
  if (isset($_REQUEST['submit'])) {
    $chk = $_REQUEST['chk'];
    $a = implode(',', $chk);
    if($a) {
      $sql_d = "DELETE from customer where id in ($a)";
      $result_d = mysqli_query($conn, $sql_d);
      if($result_d) {
        echo "<script>alert('삭제하였습니다');</script>";
      } else {
        echo "<script>alert('삭제 과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
        </script>";
        error_log(mysqli_error($conn));
      }
    } else {
      echo "<script>alert('한개이상을 선택해야 합니다.');</script>";
    }
  }
   ?>
  <form method="post">
    <div class="d-flex flex-row-reverse">
      <div class="float-right">
        <button type="button" class="btn btn-secondary" name="rowDeleteBtn" data-toggle="tooltip" data-placement="top" title="단계가 clear인 것들만 삭제가 가능합니다">삭제</button>
        <a href="contract_add2.php"><button type="button" class="btn btn-primary" name="button">등록</button></a>
      </div>
    </div>
    <div class="mt-3">
      <?php $sqlC = "select count(*) from realContract where user_id={$_SESSION['id']}";
      // echo $sqlC;
      $resultC = mysqli_query($conn, $sqlC);
      $rowC = mysqli_fetch_array($resultC);
      // echo $rowC[0];
      if((int)$rowC[0]===0){
        echo "계약 등록한것이 없네요. 바로 위 오른쪽 등록버튼을 눌러서 등록해주세요.";
      } else {
        include $_SERVER['DOCUMENT_ROOT']."/service/contract/contract_table.php";
      }
      ?>
    </div>
  </form>
<!-- <?php echo $sql; echo '3333', $a?> -->

</section>
<div class="" id="allVals">
<!-- isright 6666? -->
</div>

<script>

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

var select1option, select2option, buildingIdx, groupIdx;

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

$('#select1').on('change', function(event){
  buildingIdx = $('#select1').val();
  $('#select2').empty();
  for(var key2 in groupBuildingArray[buildingIdx]){ //그룹목록출력(상주,비상주)
    select2option = "<option value='"+key2+"'>"+groupBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#select2').append(select2option);
  }
  groupIdx = $('#select2').val();
})
//------------------------------------------------건물,그룹출력 끝------//

$(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
})

var table = $("#checkboxTestTbl");

var contractArray = [];

$(":checkbox:first", table).click(function(){

  var allCnt = $(":checkbox:not(:first)", table).length;
  contractArray = [];

  if($(":checkbox:first", table).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var contractArrayEle = [];
      var colOrder = table.find("tr:eq("+i+")").find("td:eq(1)").text();
      var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();
      var colStep = table.find("tr:eq("+i+")").find("td:eq(8)").children('div').text();
      var colFile = table.find("tr:eq("+i+")").find("td:eq(9)").children('a:eq(0)').text();
      var colMemo = table.find("tr:eq("+i+")").find("td:eq(9)").children('a:eq(1)').text();
      contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
      contractArray.push(contractArrayEle);
    }
  } else {
    contractArray = [];
  }
  console.log(contractArray);
})

$(":checkbox:not(:first)",table).click(function(){
var contractArrayEle = [];

if($(this).is(":checked")){
  var currow = $(this).closest('tr');
  var colOrder = Number(currow.find('td:eq(1)').text());
  var colid = currow.find('td:eq(0)').children('input').val();
  var colStep = currow.find('td:eq(8)').children('div').text();
  var colFile = currow.find("td:eq(9)").children('a:eq(0)').text();
  var colMemo = currow.find("td:eq(9)").children('a:eq(1)').text();
  contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
  contractArray.push(contractArrayEle);
} else {
  var currow = $(this).closest('tr');
  var colOrder = Number(currow.find('td:eq(1)').text());
  var colid = currow.find('td:eq(0)').children('input').val();
  var colStep = currow.find('td:eq(8)').children('div').text();
  var colFile = currow.find("td:eq(9)").children('a:eq(0)').text();
  var colMemo = currow.find("td:eq(9)").children('a:eq(1)').text();
  var dropReady = contractArrayEle.push(colOrder, colid, $.trim(colStep), colFile, colMemo);
  var index = contractArray.indexOf(dropReady);
  contractArray.splice(index, 1);
}
console.log(contractArray);
console.log(typeof(contractArray[3]));
})

$('button[name="rowDeleteBtn"]').on('click', function(){
console.log(contractArray);
for (var i = 0; i < contractArray.length; i++) {
  if(contractArray[i][2] === '청구' || contractArray[i][2] === '입금'){
    alert('단계가 clear 이어야만 삭제 가능합니다.');
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

goCategoryPage(aa, bb, contractArray);

function goCategoryPage(a, b, c){
  var frm = formCreate(a, 'post', b,'contractArray');
  frm = formInput(frm, 'contractArray', c);
  formSubmit(frm);
}

}) //rowDeleteBtn function closing

$('select[name="periodDiv"]').on('change', function(){

var periodVal = $(this).val();
// console.log(periodVal);
if(periodVal === 'allDate'){
  $('input[name="fromDate"]').val("");
  $('input[name="toDate"]').val("");
}
if(periodVal === 'nowMonth'){
  var fromDate = yyyy + '-' + mm + '-01';
  $('input[name="fromDate"]').val(fromDate);
  $('input[name="toDate"]').val(today);
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

})


</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
