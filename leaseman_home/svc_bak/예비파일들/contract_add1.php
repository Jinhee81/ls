<!-- 계약등록 버전1, 모달있는거, 이거 사용안함-->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_SESSION);

$sql = "select * from building where user_id = {$_SESSION['id']}";
// echo $sql;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
  $buildingArray[$row['id']] = [$row['name'],$row['pay']];
}

foreach ($buildingArray as $key => $value) { //key는 건물아이디, value는 건물이름
  $sql2 = "select * from group_in_building where building_id={$key}"; //건물아이디로 그룹조회
  // echo $sql2;
  $result2 = mysqli_query($conn, $sql2);
  $groupBuildingArray[$key] = array();
  while($row2 = mysqli_fetch_array($result2)){
    $groupBuildingArray[$key][$row2['id']]=$row2['gName'];//그룹아이디
  }
}

foreach ($groupBuildingArray as $key => $value) {
  $sql3 = "select id from group_in_building where building_id={$key}"; //건물아이디로 그룹조회 (건물아이디가 키값)
  // echo $sql3;
  $result3 = mysqli_query($conn, $sql3);
  while($row3 = mysqli_fetch_array($result3)){
    $sql4 = "select ordered, rName from r_g_in_building where group_in_building_id={$row3['id']}";
    // echo $sql4;다시 그룹아이디로 방번호조회
    $result4 = mysqli_query($conn, $sql4);
    while($row4 = mysqli_fetch_array($result4)){
      $roomArray[$row3['id']][$row4['ordered']]=$row4['rName'];
    }
  }
}

// echo "building Array : "; print_r($buildingArray);
// echo "group Array : "; print_r($groupBuildingArray);
// echo "room Array : "; print_r($roomArray);
?>
<script type="text/javascript">
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
  var roomArray = <?php echo json_encode($roomArray); ?>;
  console.log(buildingArray);
  console.log(groupBuildingArray);
  console.log(roomArray);
</script>

<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">임대계약 등록 화면입니다!</h1>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. </small>
    <hr class="my-4">
    <a class="btn btn-primary btn-sm" href="" role="button">일괄등록</a>
  </div>
</section>
<section class="container" style="max-width:700px;">
  <!-- <form method="post" action ="p_m_c_add.php"> -->
    <div class="form-row">
      <div class="form-group col-md-2">
        <label><b>[고객정보]</b></label>
      </div>
      <div class="form-group col-md-4">
        <!-- Button trigger modal -->
        <input type="button" class="form-control" data-toggle="modal" data-target="#exampleModal" name="" value="">
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="" value="">
      </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">고객찾기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <form class="" action="index.html" method="post"> -->
          <div class="form-row text-center">
            <div class="form-group col-md-4">
              <label>성명</label>
              <input type="text" class="form-control text-center" name="" id="name1" value="">
            </div>
            <div class="form-group col-md-4">
              <label>사업자명</label>
              <input type="text" class="form-control text-center" name="" value="">
            </div>
            <div class="form-group col-md-4">
              <label>연락처</label>
              <input type="text" class="form-control text-center" name="" value="">
            </div>
          </div>
        <!-- </form>   -->
      </div>

      <div class="">

      </div>
      <script>
        $('#name1').keydown(function(key){
          if(key.keyCode==13){
            console.log($(this).val());
            var a1='searchCustomer';
            var b1='p_customer_search.php'
            var c1 = 'value';
            var d1=$(this).val();

            goCategoryPage(a1,b1,c1,d1);

            function goCategoryPage(a,b,c,d){
              var frm = formCreate(a, 'post', b,'')
              frm = formInput(frm, c, d);
              formSubmit(frm);
            }
        }});
      </script>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary">적용</button>
      </div>
    </div>
  </div>
</div>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label><b>[물건정보]</b></label>
      </div>
      <div class="form-group col-md-10" id="mulgunInfo">
        <div class="form-row">
          <div class="form-group col-md-2">
            <select id="select1" name="" class="form-control" onchange="">
              <option value="">전체</option>
              <option value="" selected>공실</option>
              <option value="">만실</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <select id="select2" name="" class="form-control"><!--물건목록-->
            </select>
          </div>
          <div class="form-group col-md-3"><!--그룹목록-->
            <select id="select3" name="" class="form-control">
            </select>
          </div>
          <div class="form-group col-md-3"><!--관리번호목록-->
            <select id="select4" name="" class="form-control" onchange="div2Get();">
            </select>
          </div>
          <div class="form-group col-md-2"><!--선불,후불체크-->
            <select id="select5" name="" class="form-control">
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label><b>[기간정보]</b></label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-3">
            <label><span id='star' style='color:#F7BE81;'>* </span>기간(개월수)</label>
            <input type="number" class="form-control" name="monthCount" placeholder="" min="1" max="60">
          </div>
          <div class="form-group col-md-3">
            <label><span id='star' style='color:#F7BE81;'>* </span>시작일자</label>
            <input type="text" id="startDate" class="form-control dateType" name="startDate" value="" placeholder="" onmouseout="getEndDate();">
          </div>
          <div class="form-group col-md-3">
            <label>종료일자</label>
            <input type="text" id="endDate" class="form-control" name="endDate" placeholder="" disabled>
          </div>
          <div class="form-group col-md-3">
            <label>계약일자</label>
            <input type="text" id="contractDate" class="form-control dateType" name="contractDate" placeholder="">
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <label><b>[금액정보]</b></label>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label>(1)월이용료</label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-4 mb-0">
            <label><span id='star' style='color:#F7BE81;'>* </span>공급가액</label>
            <input type="text" class="form-control text-right amountNumber" name="amount1" placeholder="0" numberOnly>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>세액</label>
            <input type="text" class="form-control text-right amountNumber" name="amount2" placeholder="0" numberOnly>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>합계</label>
            <input type="text" class="form-control text-right amountNumber" id="amount12" name="amount12" placeholder="0" numberOnly>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-10">
        <small class="form-text text-muted">매월 받아야하는 임대료(월세)를 입력합니다.</small>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label>(2)기타금액</label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-4 mb-0">
            <label>공급가액</label>
            <input type="text" class="form-control text-right amountNumber" name="amount3" placeholder="0" numberOnly>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>세액</label>
            <input type="text" class="form-control text-right amountNumber" name="amount4" placeholder="0" numberOnly>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>합계</label>
            <input type="text" class="form-control text-right amountNumber" name="amount34" id="amount34" placeholder="0" numberOnly>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-10">
        <small class="form-text text-muted">매월 받아야하는 관리비 등의 비용을 입력합니다.</small>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label>(3)보증금</label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-4 mb-0">
            <label>금액</label>
            <input type="text" class="form-control text-right amountNumber" name="" value="" placeholder="0" numberOnly>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>입금일자</label>
            <input type="text" class="form-control dateType" name="depositDate" id="depositDate" value="" placeholder="">
          </div>
          <div class="form-group col-md-4 mb-0">

          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-10">
        <small class="form-text text-muted">보증금을 받았다면, 보증금과 날짜를 입력하세요.</small>
      </div>
    </div>
    <div class="">
      <button type='submit' class='btn btn-primary'>저장</button>
      <a href='contract.php'><button type='button' class='btn btn-secondary'>계약리스트화면으로</button></a>
    </div>
  // </form>
</section>
<script>

var endDate = "";
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
  var b = $("input[name='startDate']").val();
  var arr1 = b.split('-');
  var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);
  console.log(sDate);
  // var eDate = new Date(arr1[0], arr1[1]-1+a, arr1[2]-1);
  var eDate = new Date(sDate.getFullYear(), sDate.getMonth() + a, sDate.getDate()-1);
  console.log(eDate);
  // console.log(a);
  function dateFormat(){
    var yyyy = eDate.getFullYear().toString();
    var mm = (eDate.getMonth()+1).toString();
    var dd = eDate.getDate().toString();

    endDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
    return endDate;
  }
  dateFormat();
  $('#endDate').attr('value', dateFormat());
}

var amount1 = 0, amount2 = 0, amount12 = 0; //월이용료 공급가액,세액,합계
var amount3 = 0, amount4 = 0, amount34 = 0; //기타금액 공급가액,세약,합계

$("input[name='amount1']").keyup(function(){
  amount1 = Number($(this).val());
  amount12 = amount1 + amount2;
  $('#amount12').val(amount12);
}).keyup();

$("input[name='amount2']").keyup(function(){
  amount2 = Number($(this).val());
  amount12 = amount1 + amount2;
  $('#amount12').val(amount12);
}).keyup();

$("input[name='amount3']").keyup(function(){
  amount3 = Number($(this).val());
  amount34 = amount3 + amount4;
  $('#amount34').val(amount34);
}).keyup();

$("input[name='amount4']").keyup(function(){
  amount4 = Number($(this).val());
  // console.log(amount4);
  amount34 = amount3 + amount4;
  $('#amount34').val(amount34);
}).keyup();

// $('#amount12').val('solmi');
</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
