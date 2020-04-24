<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_SESSION);
// print_r($_GET['id']);
$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//계약번호
settype($filtered_id, 'integer');

$sql_a = "select customer_id from realContract where id={$filtered_id}";
$result_a = mysqli_query($conn, $sql_a);
$row_a = mysqli_fetch_array($result_a);

$sql_c = "
          select
              id, name, div2, div3, companyname, contact1, contact2, contact3,
              cNumber1, cNumber2, cNumber3
            from customer
            where id={$row_a[0]}
    ";
// echo $sql_c;
$result_c = mysqli_query($conn, $sql_c);
$row_c = mysqli_fetch_array($result_c);

$clist['id'] = htmlspecialchars($row_c['id']);
$clist['div2'] = htmlspecialchars($row_c['div2']);
$clist['contact1'] = htmlspecialchars($row_c['contact1']);
$clist['contact2'] = htmlspecialchars($row_c['contact2']);
$clist['contact3'] = htmlspecialchars($row_c['contact3']);
$clist['name'] = htmlspecialchars($row_c['name']);
$clist['companyname'] = htmlspecialchars($row_c['companyname']);
$clist['cNumber1'] = htmlspecialchars($row_c['cNumber1']);
$clist['cNumber2'] = htmlspecialchars($row_c['cNumber2']);
$clist['cNumber3'] = htmlspecialchars($row_c['cNumber3']);

// print_r($clist);

$cNumber = $clist['cNumber1'].'-'.$clist['cNumber2'].'-'.$clist['cNumber3'];
$cContact = $clist['contact1'].'-'.$clist['contact2'].'-'.$clist['contact3'];

if($row_c['div3']==='주식회사'){
  $cDiv3 = '(주)';
} elseif($row_c['div3']==='유한회사'){
  $cDiv3 = '(유)';
} elseif($row_c['div3']==='합자회사'){
  $cDiv3 = '(합)';
} elseif($row_c['div3']==='기타'){
  $cDiv3 = '(기타)';
}

if($clist['div2']==='개인사업자'){
  $cName = $clist['name'].'('.$clist['companyname'].','.$cNumber.')';
} else if($clist['div2']==='법인사업자'){
  $cName = $cDiv3.$clist['companyname'].'('.$clist['name'].','.$cNumber.')';
} else if($clist['div2']==='개인'){
  $cName = $clist['name'];
}

$output = $cName.' | '.$cContact.' | '.$clist['id'];

$sql_main = "select * from realContract where id={$filtered_id}";
$result_main = mysqli_query($conn, $sql_main);
$row_main = mysqli_fetch_array($result_main);

// print_r($row_main);

$sql = "select * from building where user_id = {$row_main['user_id']}";
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
  var buildingValue = <?php echo json_encode($row_main['building_id']); ?>;
  var groupValue = <?php echo json_encode($row_main['group_in_building_id']); ?>;
  var roomValue = <?php echo json_encode($row_main['r_g_in_building_id']); ?>;

  // console.log(buildingArray);
  // console.log(groupBuildingArray);
  // console.log(roomArray);
  // console.log(buildingValue);
  // console.log(groupValue);
  // console.log(roomValue);
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
    <h1 class="display-4">방계약 수정 화면입니다!</h1>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[세입자정보]</b>에는 세입자만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) <b>[세입자정보]</b>의 제일우측 숫자는 세입자번호로써 시스템데이터임을 참고하여주세요.(3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small>
    <hr class="my-4">
  </div>
</section>
<section class="container">
  <form method="post" action="p_realContract_edit.php">
    <div class="form-row">
        <div class="form-group col-md-2">
              <label><b>[세입자정보]</b></label>
        </div>
        <div class="form-group col-md-10 inputWithIcon">
              <input type="text" class="form-control" name="customer" id="customer" value="<?=$output?>" disabled>
              <input type="hidden" name="customer2" value="<?=$clist['id']?>">
              <input type="hidden" name="contract" value="<?=$filtered_id?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label><b>[물건정보]</b></label>
        </div>
        <div class="form-group col-md-10" id="mulgunInfo">
              <div class="form-row">
                <div class="form-group col-md-2"><!--물건목록-->
                    <label>물건명</label>
                    <select id="select2" name="building_id" class="form-control">
<?php
$sql_building = "select id, bName from building where user_id={$row_main['user_id']}";
$result_building = mysqli_query($conn, $sql_building);
while($row_building = mysqli_fetch_array($result_building)){?>
  <option value="<?=$row_building['id']?>"
    <?php if ($row_building['id']===$row_main['building_id']) {
      echo "selected";
    }?>
    ><?=$row_building['bName']?>
  </option>
<?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-2"><!--그룹목록-->
                    <label>그룹명</label>
                    <select id="select3" name="group_id" class="form-control">
<?php
$sql_group = "select id, gName from group_in_building where building_id={$row_main['building_id']}";
$result_group = mysqli_query($conn, $sql_group);
while($row_group = mysqli_fetch_array($result_group)){?>
  <option value="<?=$row_group['id']?>"
    <?php if ($row_group['id']===$row_main['group_in_building_id']) {
      echo "selected";
    }?>
    ><?=$row_group['gName']?>
  </option>
<?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-2"><!--관리번호목록-->
                    <label>관리호수</label>
                    <select id="select4" name="room_id" class="form-control" onchange="">
<?php
$sql_room = "select id, rName from r_g_in_building where group_in_building_id={$row_main['group_in_building_id']}";
$result_room = mysqli_query($conn, $sql_room);
while($row_room = mysqli_fetch_array($result_room)){?>
  <option value="<?=$row_room['id']?>"
    <?php if ($row_room['id']===$row_main['r_g_in_building_id']) {
      echo "selected";
    }?>
    ><?=$row_room['rName']?>
  </option>
<?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>최초 계약일자</label>
                    <input type="text" id="contractDate" class="form-control dateType" name="contractDate" value="<?=$row_main['contractDate']?>">
                </div>
              </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2 mb-0">
            <label><b>[월세정보]</b></label>
        </div>
        <div class="form-group col-md-10 mb-0">
          <div class="form-row">
              <div class="form-group col-md-2 mb-0">
                    <label><span id='star' style='color:#F7BE81;'>* </span>공급가액</label>
                    <input type="text" class="form-control text-right amountNumber" name="mAmount" value="<?=$row_main['mAmount']?>" numberOnly required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label>세액</label>
                    <input type="text" class="form-control text-right amountNumber" name="mvAmount" value="<?=$row_main['mvAmount']?>" numberOnly required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label>합계</label>
                    <input type="text" class="form-control text-right amountNumber numberComma" name="mtAmount" value="<?=$row_main['mtAmount']?>" readonly>
              </div>
              <div class="form-group col-md-1 mb-0"><!--선불,후불체크-->
                    <label>수납</label>
                    <select id="select5" name="payOrder" class="form-control">
                        <option value="선불"
<?php if($row_main['payOrder']==='선불') {
  echo "selected";
}?>>선불</option>
                        <option value="후불"
<?php if($row_main['payOrder']==='후불') {
  echo "selected";
}?>>후불</option>
                    </select>
              </div>
              <div class="form-group col-md-1 mb-0">
                    <label><span id='star' style='color:#F7BE81;'>* </span>기간</label>
                    <input type="number" class="form-control" name="monthCount" value="<?=$row_main['monthCount']?>" min="1" max="72" required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label><span id='star' style='color:#F7BE81;'>* </span>시작일자</label>
                    <input type="text" id="startDate" class="form-control dateType" name="startDate" value="<?=$row_main['startDate']?>" placeholder="" required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label>종료일자</label>
                    <input type="text" id="endDate" class="form-control" name="endDate" value="<?=$row_main['endDate']?>" disabled>
                    <input type="hidden" id="endDate1" class="form-control" name="endDate1" value="<?=$row_main['endDate']?>">
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

    <div class="">
      <button type='submit' id="submitbtn" class='btn btn-primary'>수정</button>
      <a href='contract.php'><button type='button' class='btn btn-secondary'>방계약리스트화면으로</button></a>
    </div>
  </form>
</section>

<script src="/admin/js/jquery-ui.min.js"></script>
<script src="/admin/js/datepicker-ko.js"></script>
<script>

$('#contractDate').on('change', function(){
  var readyStartDate = $('#contractDate').val();

  getStartDate();

  function getStartDate(){
    var arr1 = readyStartDate.split('-');
    var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);

    dateFormat();
    $('#startDate').attr('value', dateFormat());

    function dateFormat(){
      var yyyy = sDate.getFullYear().toString();
      var mm = (sDate.getMonth()+1).toString();
      var dd = sDate.getDate().toString();

      var startDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
      return startDate;
    }
  }
}) //contractDate on change closing괄호, 최초계약일자=시작일자

$('#contractDate').on('change', function(){
  var readyStartDate = $('#contractDate').val();

  getDepositInDate();

  function getDepositInDate(){
    var arr1 = readyStartDate.split('-');
    var gDate = new Date(arr1[0], arr1[1]-1, arr1[2]);

    dateFormat();
    $('#depositInDate').attr('value', dateFormat());

    function dateFormat(){
      var yyyy = gDate.getFullYear().toString();
      var mm = (gDate.getMonth()+1).toString();
      var dd = gDate.getDate().toString();

      var depositInDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
      return depositInDate;
    }
  }
}) //contractDate on change closing괄호, 최초계약일자=보증금입금일자

var select2option, select3option, select4option, select5option, buildingIdx, groupIdx;
var pay = ["선불", "후불"];



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
  var b = $('#startDate').val();
  // console.log(b);
  var arr1 = b.split('-');
  var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);
  // console.log(sDate);
  // var eDate = new Date(arr1[0], arr1[1]-1+a, arr1[2]-1);
  var eDate = new Date(sDate.getFullYear(), sDate.getMonth() + a, sDate.getDate()-1);
  // console.log(eDate);
  // console.log(a);

  $('#endDate').attr('value', dateFormat());
  $('#endDate1').attr('value', dateFormat());

  function dateFormat(){
    var yyyy = eDate.getFullYear().toString();
    var mm = (eDate.getMonth()+1).toString();
    var dd = eDate.getDate().toString();

    var endDate = yyyy+'-'+(mm[1] ? mm : '0'+mm[0])+'-'+(dd[1]?dd:'0'+dd[0]);
    return endDate;
  }

}

$('#startDate').on('change', function(event){
  getEndDate();
})

$('input[name="monthCount"]').on('change', function(event){
  getEndDate();
})

$("input[name='mAmount']").on('keyup', function(){
  var amount1 = Number($(this).val());
  var amount2 = Number($("input[name='mvAmount']").val());
  var amount12 = amount1 + amount2;
  $("input[name='mtAmount']").val(amount12);
})

$("input[name='mvAmount']").on('keyup', function(){
  var amount1 = Number($("input[name='mAmount']").val());
  var amount2 = Number($(this).val());
  var amount12 = amount1 + amount2;
  $("input[name='mtAmount']").val(amount12);
})

$('#submitbtn').on('click', function(){

})

$('.dateType').datepicker({
  changeMonth: true,
  changeYear: true,
  showButtonPanel: true,
  // showOn: "button",
  buttonImage: "/img/calendar.svg",
  buttonImageOnly: false
})

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>