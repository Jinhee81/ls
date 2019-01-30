<!--임대물건의 그룹에 대한 추가 모달 시작-->
<!-- <script type="text/javascript">
window.onload = function() {
    if (!window.location.hash) {
        window.location = window.location + '#loaded';
        self.window.location.reload();
    }
}
</script> -->
<div class="modal fade bd-example-modal-lg" id="modal_group_add<?=$escaped['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="p_room_make.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title">그룹 및 관리번호 생성</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
          <h6>location</h6>
          <script>
            document.write(location.href);
          </script>
        </div>
        <table class="table table-bordered text-center">
        <thead>
          <tr>
            <td scope="col">물건명</td>
            <td scope="col">그룹명</td>
            <td scope="col">관리개수<br>(숫자)</td>
            <td scope="col">시작번호<br>(숫자)</td>
            <td scope="col"></td>
          </tr>
        </thead>
        <tbody>
         <tr>
            <input type="hidden" name="id" value="<?=$escaped['id']?>">
            <td scope="col"><input class="form-control text-center" type="text" name="building_name" value="<?=$escaped['name']?>" disabled></td><!--명칭-->

            <td scope="col"><input class="form-control text-center" type="text" name="gName" required=""></td><!--그룹명-->

            <td scope="col"><input class="form-control text-center" type="number" min="1" max="100" name="count"  onmouseout="button_value_count(this.value);" required=""></td><!--방/좌석수-->

            <td scope="col"><input class="form-control text-center" type="number" name="room_start_number" onmouseout="button_value_startNumber(this.value);"></td><!--방/좌석시작번호-->

            <td scope="col"><button class="btn btn-outline-success" type="button" onclick="button_room_make();">생성</button></td><!--생성버튼-->
          </tr>
        </tbody>
        </table>
        <small id="comment">
          <i class="fas fa-exclamation"></i>&nbsp;방/좌석수는 1~100사이 숫자만 입력 가능합니다.<br>
          <i class="fas fa-exclamation"></i>&nbsp;꽃잎반, 열매반 등 한글이름인 경우 방/좌석시작번호 값을 비운채로 생성하기 버튼을 누릅니다.<br>
        </small>
        <div class="container" id="below_rooms">
        </div><!--생성하기버튼 누르면 여기에 방번호가 쫙 나온다-->
    </div> <!--modal body close div-->

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closePopup();">취소</button>
      <button type="submit" class="btn btn-primary">저장</button>
    </div>
  </form>
  </div> <!--modal content close div-->
</div> <!--modal-dialog modal-lg close div-->
</div> <!--그룹추가 모달 끝-->

<script>

var count;
var startNumber;
var rooms = [];
function button_value_count(c){ //방갯수 가져오는 함수
  // count = document.getElementsByName('room_count')[0].value;
  count = c;
  // alert(count);
  return count;
}
function button_value_startNumber(s){ //방시작번호 가져오는 함수
  // startNumber = document.getElementsByName('room_start_number')[0].value;
  startNumber = s;
  return startNumber;
}

function button_room_make(){ //방들을 만드는 함수, 생성하기버튼 누르면 실행되는거

  var iCount = Number(count);
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
  $tweet.append("<h5>관리번호 목록</h5>");
  $tweet.appendTo($('#table_rooms'));
  var table = "<table class='table table-bordered table-sm text-center'>";
  var trArray=[0,7,14,21,28,35,42,49,56,63,70,77,84,91,98];
  var closeTrArray= [6,13,20,27,34,41,48,55,62,69,76,83,90,97];
  for(var i=0; i<rooms.length; i++) {
   var stringI = i.toString();
   if(trArray.includes(i)){
     table = table + "<tr><td>"+ "<input type='text' name='rName" + i + "' class='form-control text-center' value ='"+ rooms[i] +"'></td>";

   } else if (closeTrArray.includes(i)){
     table = table + "<td>"+ "<input type='text' name='rName" + i + "' class='form-control text-center' value ='" + rooms[i] + "'></td></tr>";

   } else {
     table = table + "<td>"+ "<input type='text' name='rName" + i + "' class='form-control text-center' value ='" + rooms[i] + "'></td>";
   }
  }
  table = table + "</table>";
  $tweet.append(table);

  $('#below_rooms').html($tweet);
  $('#comment').empty();
}
function closePopup(){
  // window.opener.location.reload();
  // window.close();
  var iCount = null;
  var iStartNumber = null;
  var rooms = null;
 }

</script>
