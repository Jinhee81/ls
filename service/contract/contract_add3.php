<!-- 곧 지울예정임, 계약등록이 처음에 세로로좀 길었다가 세로를 짧게 변경하려고 함 -->
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
  $buildingArray[$row['id']] = [$row['bName'],$row['pay']];
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
    $sql4 = "select id, rName from r_g_in_building where group_in_building_id={$row3['id']}";
    // echo $sql4;다시 그룹아이디로 방번호조회
    $result4 = mysqli_query($conn, $sql4);
    while($row4 = mysqli_fetch_array($result4)){
      $roomArray[$row3['id']][$row4['id']]=$row4['rName'];
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
    <h1 class="display-4">임대계약 등록 화면입니다!</h1>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[고객정보]</b>에는 진행고객만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) (3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small>
    <hr class="my-4">
    <a class="btn btn-primary btn-sm" href="" role="button">일괄등록</a>
    <a class="btn btn-primary btn-sm" href="/service/customer/m_c_add.php" role="button">고객등록</a>
  </div>
</section>
<section class="container" style="max-width:700px;">
  <form method="post" action="p_realContract_add.php">
    <div class="form-row">
      <div class="form-group col-md-2">
        <label><b>[고객정보]</b></label>
      </div>
      <div class="form-group col-md-10 inputWithIcon">
        <input type="search" class="form-control" name="customer" id="customer" value="" required>
        <i class="fas fa-search fa-lg fa-fw" aria-hidden="true"></i>
        <div class="" id="customerList">
        </div>
        <input type="hidden" name="customerId" id="customerId" value="">
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
            <select id="select2" name="building_id" class="form-control"><!--물건목록-->
            </select>
          </div>
          <div class="form-group col-md-3"><!--그룹목록-->
            <select id="select3" name="group_id" class="form-control">
            </select>
          </div>
          <div class="form-group col-md-3"><!--관리번호목록-->
            <select id="select4" name="room_id" class="form-control" onchange="">
            </select>
          </div>
          <div class="form-group col-md-2"><!--선불,후불체크-->
            <select id="select5" name="payOrder" class="form-control">
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
            <input type="number" class="form-control" name="monthCount" placeholder="" min="1" max="72" required>
          </div>
          <div class="form-group col-md-3">
            <label><span id='star' style='color:#F7BE81;'>* </span>시작일자</label>
            <input type="text" id="startDate" class="form-control dateType" name="startDate" value="" placeholder="" required>
          </div>
          <div class="form-group col-md-3">
            <label>종료일자</label>
            <input type="text" id="endDate" class="form-control" name="endDate" placeholder="">
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
            <input type="text" class="form-control text-right amountNumber" name="mAmount" placeholder="0" numberOnly required>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>세액</label>
            <input type="text" class="form-control text-right amountNumber" name="mvAmount" placeholder="0" numberOnly>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>합계</label>
            <input type="text" class="form-control text-right amountNumber" name="mtAmount" placeholder="0" numberOnly>
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
    <!-- <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label>(2)기타금액</label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-4 mb-0">
            <label>공급가액</label>
            <input type="text" class="form-control text-right amountNumber" name="eAmount" placeholder="0" numberOnly>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>세액</label>
            <input type="text" class="form-control text-right amountNumber" name="evAmount" placeholder="0" numberOnly>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>합계</label>
            <input type="text" class="form-control text-right amountNumber" name="etAmount" id="etAmount" placeholder="0" numberOnly>
          </div>
        </div>
      </div>
    </div> 고민하다가 기타금액은 넣지 않기로 -->
    <!-- <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-10">
        <small class="form-text text-muted">매월 받아야하는 관리비 등의 비용을 입력합니다.</small>
      </div>
    </div> 고민하다가 기타금액은 넣지 않기로 함-->
    <div class="form-row">
      <div class="form-group col-md-2 mb-0">
        <label>(2)보증금</label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-4 mb-0">
            <label>금액</label>
            <input type="text" class="form-control text-right amountNumber" name="depositAmount" value="" placeholder="0" numberOnly>
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>입금일자</label>
            <input type="text" class="form-control dateType" name="depositInDate" id="depositInDate" value="" placeholder="">
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
  </form>
</section>
<script>
$(document).ready(function(){
  $('#customer').keyup(function(){
    var query = $(this).val();
    // console.log(query);
    if(query != ''){
      $.ajax({
        url: 'p_customer_search.php',
        method: 'post',
        data: {query : query},
        success: function(data){
          $('#customerList').fadeIn();
          $('#customerList').html(data);
        }
      })
    }
  })
})

$(document).on('click', 'li', function(){
  $('#customer').val($(this).text());
  $('#customerList').fadeOut();
})


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

$('#startDate').on('blur', function(event){
  getEndDate();

  function getEndDate(){
    var a = Number($("input[name='monthCount']").val());
    var b = $('#startDate').val();
    console.log(b);
    var arr1 = b.split('-');
    var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);
    // console.log(sDate);
    // var eDate = new Date(arr1[0], arr1[1]-1+a, arr1[2]-1);
    var eDate = new Date(sDate.getFullYear(), sDate.getMonth() + a, sDate.getDate()-1);
    // console.log(eDate);
    // console.log(a);

    dateFormat();
    $('#endDate').attr('value', dateFormat());

    function dateFormat(){
      var yyyy = eDate.getFullYear().toString();
      var mm = (eDate.getMonth()+1).toString();
      var dd = eDate.getDate().toString();

      endDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
      return endDate;
    }

  }
})


var amount1 = 0, amount2 = 0, amount12 = 0; //월이용료 공급가액,세액,합계
var amount3 = 0, amount4 = 0, amount34 = 0; //기타금액 공급가액,세약,합계

$("input[name='mAmount']").keyup(function(){
  amount1 = Number($(this).val());
  amount12 = amount1 + amount2;
  $("input[name='mtAmount']").val(amount12);
}).keyup();

$("input[name='mvAmount']").keyup(function(){
  amount2 = Number($(this).val());
  amount12 = amount1 + amount2;
  $("input[name='mtAmount']").val(amount12);
}).keyup();

$("input[name='eAmount']").keyup(function(){
  amount3 = Number($(this).val());
  amount34 = amount3 + amount4;
  $('#etAmount').val(amount34);
}).keyup();

$("input[name='evAmount']").keyup(function(){
  amount4 = Number($(this).val());
  // console.log(amount4);
  amount34 = amount3 + amount4;
  $('#etAmount').val(amount34);
}).keyup();

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
