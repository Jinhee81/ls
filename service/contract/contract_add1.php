<!-- 고객등록하고나서 계약등록버튼누르면 계약등록하는거 -->
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
$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//고객아이디
settype($filtered_id, 'integer');

$sql_c = "
          select
              id, name, div2, div3, companyname, contact1, contact2, contact3,
              cNumber1, cNumber2, cNumber3
            from customer
            where id={$filtered_id}
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
  // console.log(buildingArray);
  // console.log(groupBuildingArray);
  // console.log(roomArray);
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
    <h1 class="display-4">방계약 등록 화면입니다!</h1>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[세입자정보]</b>에는 세입자만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) <b>[세입자정보]</b>의 제일우측 숫자는 세입자번호로써 시스템데이터임을 참고하여주세요.(3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small>
    <hr class="my-4">
  </div>
</section>
<section class="container">
  <form method="post" action="p_realContract_add1.php">
    <div class="form-row">
        <div class="form-group col-md-2">
              <label><b>[세입자정보]</b></label>
        </div>
        <div class="form-group col-md-10 inputWithIcon">
              <input type="text" class="form-control" name="customer" id="customer" value="<?=$output?>" disabled>
              <input type="hidden" name="customer" value="<?=$clist['id']?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label><b>[물건정보]</b></label>
        </div>
        <div class="form-group col-md-10" id="mulgunInfo">
              <div class="form-row">
                <div class="form-group col-md-2">
                    <label>공실구분</label>
                    <select id="select1" name="" class="form-control" onchange="">
                      <option value="">전체</option>
                      <option value="" selected>공실</option>
                      <option value="">만실</option>
                    </select>
                </div>
                <div class="form-group col-md-2"><!--물건목록-->
                    <label>물건명</label>
                    <select id="select2" name="building_id" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-2"><!--그룹목록-->
                    <label>그룹명</label>
                    <select id="select3" name="group_id" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-2"><!--관리번호목록-->
                    <label>방번호</label>
                    <select id="select4" name="room_id" class="form-control" onchange="">
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>최초 계약일자</label>
                    <input type="text" id="contractDate" class="form-control dateType" name="contractDate" placeholder="">
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
                    <input type="text" class="form-control text-right amountNumber" name="mAmount" value="0" numberOnly required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label>세액</label>
                    <input type="text" class="form-control text-right amountNumber" name="mvAmount" value="0" numberOnly required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label>합계</label>
                    <input type="text" class="form-control text-right amountNumber" name="mtAmount" placeholder="0" numberOnly readonly>
              </div>
              <div class="form-group col-md-1 mb-0"><!--선불,후불체크-->
                    <label>수납</label>
                    <select id="select5" name="payOrder" class="form-control">
                    </select>
              </div>
              <div class="form-group col-md-1 mb-0">
                    <label><span id='star' style='color:#F7BE81;'>* </span>기간</label>
                    <input type="number" class="form-control" name="monthCount" placeholder="" min="1" max="72" required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label><span id='star' style='color:#F7BE81;'>* </span>시작일자</label>
                    <input type="text" id="startDate" class="form-control dateType" name="startDate" value="" placeholder="" required>
              </div>
              <div class="form-group col-md-2 mb-0">
                    <label>종료일자</label>
                    <input type="text" id="endDate" class="form-control" name="endDate" placeholder="" readonly>
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
          <label><b>[보증금정보]</b></label>
        </div>
        <div class="form-group col-md-10 mb-0">
            <div class="form-row">
                <div class="form-group col-md-3 mb-0">
                    <label>금액</label>
                    <input type="text" class="form-control text-right amountNumber" name="depositInAmount" value="0" placeholder="0" numberOnly>
                </div>
                <div class="form-group col-md-3 mb-0">
                    <label>입금일자</label>
                    <input type="text" class="form-control dateType" name="depositInDate" id="depositInDate" value="">
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
      <a href='contract.php'><button type='button' class='btn btn-secondary'>방계약리스트화면으로</button></a>
    </div>
  </form>
</section>
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
  var b = $('#startDate').val();
  // console.log(b);
  var arr1 = b.split('-');
  var sDate = new Date(arr1[0], arr1[1]-1, arr1[2]);
  // console.log(sDate);
  // var eDate = new Date(arr1[0], arr1[1]-1+a, arr1[2]-1);
  var eDate = new Date(sDate.getFullYear(), sDate.getMonth() + a, sDate.getDate()-1);
  // console.log(eDate);
  // console.log(a);

  dateFormat();
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


</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
