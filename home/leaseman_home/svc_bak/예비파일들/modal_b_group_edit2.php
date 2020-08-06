<!-- 이파일은 사용안하기로 함. 이유는 고민끝에 방 한개한개 지우는 기능은 삭제함(일부러 없앤것) -->

<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//그룹아이디?
settype($filtered_id, 'integer');
$sql = "SELECT group_in_building.id, group_in_building.created,
  group_in_building.updated, gName, count, building.name
  FROM group_in_building LEFT JOIN building
  ON group_in_building.building_id = building.id
  WHERE group_in_building.id={$filtered_id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// echo $sql;
// print_r($row);
// print_r($_SESSION);
?>
<style>
  .deleteTimesTd{
    padding-left: 0px;
  }
  .deleteTimesButton{
    padding-left: 0px;
    padding-top: 0px;
    border-top-width: 0px;
    border-left-width: 0px;
  }
  i {
    color:#FE9A2E;
  }
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4"> >> 그룹 및 관리번호 수정 화면입니다!</h1>
    <hr class="my-4">
    <p class="lead">관리번호 추가하기는 1개씩 가능합니다. 만약 다량으로 추가를 윈하는 경우는 그룹삭제 후 다시 그룹 생성해주세요.<br>
    <!-- (2) 관리개수에는 1~100사이 숫자를 입력해주세요.<br> -->
    <!-- (3) 관리번호가 만약 꽃잎반, 열매반 등 한글 이름인 경우(숫자 호수가 아닌경우) 시작번호 값을 비운채 생성하기 버튼을 눌러주세요.-->
    </p>
    <!-- <hr class="my-4">
    <small>(1) '명칭'은 평상시 부르는 이름으로 적어주세요. 예)도레미고시원, 성공빌딩 (2) '수금방법'은 임대료를 선불로 수납할 경우 선불 선택, 후불로 수납할경우 후불을 선택하세요.</small> -->
  </div>
</section>
<section class="container" style="max-width:600px;">
  <form action="p_room_edit.php" method="post">
    <input type="hidden" name="id" value="<?=$row['id']?>">
    <table class="table table-bordered text-center">
      <tr>
        <td scope="col col-md-4">물건명</td>
        <td scope="col col-md-8"><input class="form-control text-center" type="text" name="building_name" value="<?=$row['name']?>" disabled></td>
      </tr>
      <tr>
        <td scope="col col-md-4">그룹명</td>
        <td scope="col col-md-8"><input class="form-control text-center" type="text" name="gName" required="" value="<?=$row['gName']?>"></td>
      </tr>
      <tr>
        <td scope="col col-md-4">관리개수(숫자)</td>
        <td scope="col col-md-8"><input class="form-control text-center" type="text" min="1" max="100" name="count" disabled value="<?=$row['count']?>"></td> <!--disabled속성이 있으면 post로 데이터전송이 안된다-->
      </tr>
      <tr>
        <td colspan="2"><small class='form-text text-muted'>등록자명[<?=$_SESSION['damdangga_name']?>]등록일시[<?=$row['created']?>]수정자명[<?=$_SESSION['damdangga_name']?>]수정일시[<?=$row['updated']?>]</small></td>
      </tr>
    </table>
    <?php
    $sql7 = "select * from r_g_in_building where group_in_building_id = {$row['id']}";
    $editRooms = [];
    // echo $sql7;
    $result7 = mysqli_query($conn, $sql7);
    while($row7 = mysqli_fetch_array($result7)){
      array_push($editRooms, $row7['rName']);
    }
    // print_r($editRooms);
    $table2 = "<table class='table table-borderless table-sm text-center' id='roomList'";
    $trArray=[0,3,6,9,12,15,18,21,24,27,30,33,36,39,42,45,48, 51,54,57,60,63,66,69,72,75,78,81,84,87,90,93,96,99];
    $closeTrArray= [2,5,8,11,14,17,20,23,26,29,32,35,38,41,44,47,50, 53,56,59,62,65,68,71,74,77,80,83,86,89,92,95,98];
    // $rDeleteKeyFront = "<td class='deleteTimesTd'><button type='submit' class='deleteTimesButton btn btn-default' formaction='p_room_delete.php';'><input type='hidden' name='rName";
    // $rDeleteKeyMiddle = "' value='";
    // $rDeleteKeyEnd = "'></td><i class='fa fa-times-circle'></i></button></td>";

    for ($i=0; $i < sizeof($editRooms); $i++) {

      if(in_array($i, $trArray)){

        $table2 = $table2 ."<tr>
          <td style='padding-right:0px;'><input id='siwon' class='form-control text-center' required='' type='text' name='rName" . $i . "' value='" . $editRooms[$i] . "'></td><td style='padding-left:0px;'>
          <button type='button' name='roomRemove' value='".$editRooms[$i]."' class='goRoomDelete btn btn-default'
           style='padding-left: 0px;
           padding-top: 0px;
           border-top-width: 0px;
           border-left-width: 0px;'>
          <i class='fa fa-times-circle'></i></button></td>";
      } else if(in_array($i, $closeTrArray)){
        $table2 = $table2 . "
        <td style='padding-right:0px;'><input id='siwon' class='form-control text-center' required='' type='text' name='rName" . $i . "' value='" . $editRooms[$i] . "'></td><td style='padding-left:0px;'>
        <button type='button' name='roomRemove' value='".$editRooms[$i]."'class='goRoomDelete btn btn-default'
         style='padding-left: 0px;
         padding-top: 0px;
         border-top-width: 0px;
         border-left-width: 0px;'>
        <i class='fa fa-times-circle'></i></button></td></tr>";
      } else {
        $table2 = $table2 . "
        <td style='padding-right:0px;'><input id='siwon' class='form-control text-center' required='' type='text' name='rName" . $i . "' value='" . $editRooms[$i] . "'></td><td style='padding-left:0px;'>
        <button type='button'  name='roomRemove' value='".$editRooms[$i]."' class='goRoomDelete btn btn-default'
         style='padding-left: 0px;
         padding-top: 0px;
         border-top-width: 0px;
         border-left-width: 0px;'>
        <i class='fa fa-times-circle'></i></button></td>";
      }
    }

    $table2 = $table2."<td id='roomDiv'>
    <button type='button' class='btn btn-outline-warning btn-sm' onclick='goCategoryPage(aa2,bb2,cc2,dd2);'>관리번호 추가</button><td></table>";

    $table2 = $table2."<div class='mt-7'><a class='btn btn-secondary' href='building.php' role='button'>취소/돌아가기</a><a class='btn btn-warning ml-1' role='button' onclick='goCategoryPage(aa1,bb1,cc1,dd1);'>그룹 삭제하기</a><button type='submit' class='btn btn-primary ml-1'>수정하기</button></div>";
    ?>
    <div>
      <?php echo $table2;?>
    </div>
    <div class="solmi">

    </div>
    <div class="minsun">

    </div>





  </form>
</section>
<script>
$("button[name='roomRemove']").on('click', function(){
  // console.log('solmi');
  // console.log($(this).val());

  var aa3='roomDelete';
  var bb3='p_room_delete.php';
  var cc3='id';
  var dd3='<?=$filtered_id?>';
  var ee3='roomValue';
  var ff3=$(this).val();

  goRoomDeleteFn(aa3,bb3,cc3,dd3,ee3,ff3);

  function goRoomDeleteFn(a,b,c,d,e,f){
    if(confirm('정말 삭제하시겠습니까?')){
      var frm = formCreate(a, 'post', b,'')
      frm = formInput(frm, c, d);
      frm = formInput(frm, e, f);
      formSubmit(frm);
    } else {
      return false;
    }
  }
});

var aa1='groupDelete';
var bb1='p_modal_b_group_delete.php';
var cc1='id';
var dd1='<?=$filtered_id?>';

var aa2='roomAdd';
var bb2='p_room_add.php';
var cc2='id';
var dd2='<?=$filtered_id?>';


function goCategoryPage(a,b,c,d){
  if(a==='groupDelete'){
    if(confirm('정말 삭제하시겠습니까?')){
      var frm = formCreate(a, 'post', b,'')
      frm = formInput(frm, c, d);
      formSubmit(frm);
      // console.log(b);
    } else {
      return false;
    }
  } else {
    var frm = formCreate(a, 'post', b,'')
    frm = formInput(frm, c, d);
    formSubmit(frm);
  }
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
