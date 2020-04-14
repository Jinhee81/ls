<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//빌딩아이디
settype($filtered_id, 'integer');
$sql = "select * from building where id={$filtered_id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// print_r($row);
?>

<section class="container">
  <div class="jumbotron">
    <h1 class="display-4"> >> 그룹 및 관리번호 생성 화면입니다!</h1>
    <hr class="my-4">
    <p class="lead">(1) 그룹명에는 '1층', '2층' 등의 명칭을 적어주세요. 만약 그룹명이 생각나지 않으면 '기본'이라고 적어주세요. 추후 언제든 수정가능합니다.<br>
    (2) 관리개수에는 1~100사이 숫자를 입력해주세요.<br>
    (3) 관리번호가 만약 꽃잎반, 열매반 등 한글 이름인 경우(숫자 호수가 아닌경우) 시작번호 값을 비운채 생성하기 버튼을 눌러주세요.<br>
    (4) 관리번호는 통상적으로 '101호', '102호' 등의 식별번호를 입력합니다.
    </p>
    <!-- <hr class="my-4">
    <small>(1) '명칭'은 평상시 부르는 이름으로 적어주세요. 예)도레미고시원, 성공빌딩 (2) '수금방법'은 임대료를 선불로 수납할 경우 선불 선택, 후불로 수납할경우 후불을 선택하세요.</small> -->
  </div>
</section>
<section class="container" style="max-width:600px;">
  <form action="p_group_room_add.php" method="post">
    <input type="hidden" name="id" value="<?=$row['id']?>">
    <table class="table table-bordered text-center">
      <tr>
        <td scope="col col-md-4">물건명</td>
        <td scope="col col-md-8"><input class="form-control text-center" type="text" name="building_name" value="<?=$row['bName'].'('.$filtered_id.')'?>" disabled></td>
      </tr>
      <tr>
        <td scope="col col-md-4">그룹명</td>
        <td scope="col col-md-8"><input class="form-control text-center" type="text" name="gName" required=""></td>
      </tr>
      <tr>
        <td scope="col col-md-4">관리개수(숫자)</td>
        <td scope="col col-md-8"><input class="form-control text-center" type="number" min="1" max="100" name="count"  onmouseout="button_value_count(this.value);" required=""></td>
      </tr>
      <tr>
        <td scope="col col-md-4">시작번호(숫자)</td>
        <td scope="col col-md-8">
          <div class="form-row">
            <div class="form-group col-md-6">
              <input class="form-control text-center" type="number" name="room_start_number" onmouseout="button_value_startNumber(this.value);">
            </div>
            <div class="form-group col-md-3">
              <button class="btn btn-outline-success btn-block" type="button" onclick="button_room_make();">생성</button>
            </div>
            <div class="form-group col-md-3">
              <button class="btn btn-outline-success btn-block" type="button" onclick="button_room_cansel();">취소</button>
            </div>
          </div>
          </td>
      </tr>
    </table>
    <div class="container" id="below_rooms">
    </div><!--생성하기버튼 누르면 여기에 방번호가 쫙 나온다-->

  </form>
</section>

<script>
var count;
var startNumber;
var rooms = [];
function button_value_count(c){ //방갯수 가져오는 함수
  count = c;
  return count;
}
function button_value_startNumber(s){ //방시작번호 가져오는 함수
  startNumber = s;
  return startNumber;
}

function button_room_make(){ //방들을 만드는 함수, 생성하기버튼 누르면 실행되는거
  var iCount = Number(count);
  console.log(iCount, typeof(iCount));
  if((iCount === 0) || (iCount > 100)){
    alert('관리개수 항목에 1~100 사이 숫자를 입력해야 합니다!')
    return false;
  }
  if(!startNumber){
    for (var i=0; i < iCount; i++){
      rooms.push("");
    }
  } else {
    var iStartNumber = Number(startNumber);
    for(var i = iStartNumber; i < (iStartNumber+iCount); i++){
      rooms.push(i);
    }
  }

  alert(rooms);

  var $tweet = $('<div></div>');
  $tweet.append("<h5 class='text-center'>관리번호 목록</h5>");
  // $tweet.appendTo($('#table_rooms'));
  var table = "<table class='table table-bordered table-sm text-center'>";
  var trArray=[0,3,6,9,12,15,18,21,24,27,30,33,36,39,42,45,48, 51,54,57,60,63,66,69,72,75,78,81,84,87,90,93,96,99];
  var closeTrArray= [2,5,8,11,14,17,20,23,26,29,32,35,38,41,44,47,50, 53,56,59,62,65,68,71,74,77,80,83,86,89,92,95,98];
  for(var i=0; i<rooms.length; i++) {
   var stringI = i.toString();
   if(trArray.includes(i)){
     table = table + "<tr><td>"+ "<input type='text' name='rName" + i + "' class='form-control text-center' value ='"+ rooms[i] +"' required></td>";

   } else if (closeTrArray.includes(i)){
     table = table + "<td>"+ "<input type='text' name='rName" + i + "' class='form-control text-center' value ='" + rooms[i] + "' required></td></tr>";

   } else {
     table = table + "<td>"+ "<input type='text' name='rName" + i + "' class='form-control text-center' value ='" + rooms[i] + "' required></td>";
   }
  }
  table = table + "</table><div class='mt-7'><button type='submit' class='btn btn-primary mr-1'>저장</button><a class='btn btn-secondary' href='building.php' role='button'>취소/돌아가기</a></div>";

  $tweet.append(table);

  $('#below_rooms').html($tweet);
}

function button_room_cansel(){
  rooms = [];
  $('#below_rooms').empty();
}

function closePopup(){
  // window.opener.location.reload();
  // window.close();
  var iCount = null;
  var iStartNumber = null;
  var rooms = null;
 }

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
