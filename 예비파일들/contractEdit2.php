<!-- 계약등록 버전2, 모달없는거 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_SESSION);
// print_r($_GET['id']);

$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//계약아이디
settype($filtered_id, 'integer');

$sql = "
      select
          realContract.id,
          status,
          customer.id,
          customer.name,
          customer.companyname,
          customer.div2,
          customer.div3,
          customer.contact1,
          customer.contact2,
          customer.contact3,
          customer.etc,
          building.bName,
          group_in_building.gName,
          r_g_in_building.rName,
          monthCount,
          startDate,
          endDate,
          contractDate,
          mAmount,
          mvAmount,
          mtAmount,
          depositAmount,
          depositInDate
      from
          realContract
      left join customer
          on realContract.customer_id = customer.id
      left join building
          on realContract.building_id = building.id
      left join group_in_building
          on realContract.group_in_building_id = group_in_building.id
      left join r_g_in_building
          on realContract.r_g_in_building_id = r_g_in_building.id
      where realContract.id = {$filtered_id}
";
// echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

// print_r($row);

$cContact = $row['contact1'].'-'.$row['contact2'].'-'.$row['contact3'];

if($row['div3']==='주식회사'){
  $cDiv3 = '(주)';
} elseif($row['div3']==='유한회사'){
  $cDiv3 = '(유)';
} elseif($row['div3']==='합자회사'){
  $cDiv3 = '(합)';
} elseif($row['div3']==='기타'){
  $cDiv3 = '(기타)';
}

if($row['div2']==='개인사업자'){
  $cName = $row['name'].'('.$row['companyname'].')';
} else if($row['div2']==='법인사업자'){
  $cName = $cDiv3.$row['companyname'].'('.$row['name'].')';
} else if($row['div2']==='개인'){
  $cName = $row['name'];
}

$sql1 = "select * from building where user_id = {$_SESSION['id']}";
// echo $sql;
$result1 = mysqli_query($conn, $sql1);
while($row1 = mysqli_fetch_array($result1)){
  $buildingArray[$row1['id']] = [$row1['bName'],$row1['pay']];
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
  .head{
    /* border: solid; */
    background-color: #e9ecef;
    border-radius:.3rem;
  }
</style>

<section class="container">
  <div class="head pt-3 pb-3 pl-3 mb-5">
    <h1 class="display-4">임대계약 보기 화면입니다!</h1>
  </div>


  <!-- <div class="jumbotron">
    <h1 class="display-4">임대계약 보기 화면입니다!</h1> -->
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <!-- <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[고객정보]</b>에는 진행고객만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) (3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small>
    <hr class="my-4">
  </div> -->
</section>
<section class="container">
  <form method="post" action="">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label><b>고객정보</b></label>
      </div>
      <div class="form-group col-md-6">
        <label><b>고객특이사항</b></label>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label><?=$cName.', '.$cContact?></label>
      </div>
      <div class="form-group col-md-6">
        <label><?=$row['etc']?></label>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label><b>[물건정보]</b></label>
      </div>
      <div class="form-group col-md-10" id="mulgunInfo">
        <div class="form-row">
          <div class="form-group col-md-3">
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
          <div class="form-group col-md-3"><!--선불,후불체크-->
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
            <input type="number" class="form-control" name="monthCount" placeholder="" min="1" max="72" value="<?=$row['monthCount']?>">
          </div>
          <div class="form-group col-md-3">
            <label><span id='star' style='color:#F7BE81;'>* </span>시작일자</label>
            <input type="text" id="startDate" class="form-control dateType" name="startDate" value="<?=$row['startDate']?>" placeholder="" required>
          </div>
          <div class="form-group col-md-3">
            <label>종료일자</label>
            <input type="text" id="endDate" class="form-control" name="endDate" value="<?=$row['endDate']?>">
          </div>
          <div class="form-group col-md-3">
            <label>계약일자</label>
            <input type="text" id="contractDate" class="form-control dateType" name="contractDate" value="<?=$row['contractDate']?>">
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
            <input type="text" class="form-control text-right amountNumber" name="mAmount" value="<?=$row['mAmount']?>">
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>세액</label>
            <input type="text" class="form-control text-right amountNumber" name="mvAmount" value="<?=$row['mvAmount']?>">
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>합계</label>
            <input type="text" class="form-control text-right amountNumber" name="mtAmount" value="<?=$row['mtAmount']?>">
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
        <label>(2)보증금</label>
      </div>
      <div class="form-group col-md-10 mb-0">
        <div class="form-row">
          <div class="form-group col-md-4 mb-0">
            <label>금액</label>
            <input type="text" class="form-control text-right amountNumber" name="depositAmount" value="<?=$row['depositAmount']?>">
          </div>
          <div class="form-group col-md-4 mb-0">
            <label>입금일자</label>
            <input type="text" class="form-control dateType" name="depositInDate" id="depositInDate" value="<?=$row['depositInDate']?>">
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
</script>
