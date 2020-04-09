<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
settype($filtered_id, 'integer');
$sql = "select * from building where id={$filtered_id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// print_r($row);
// print_r($_SESSION);

?>

<section class="container">
  <div class="jumbotron">
    <h1 class="display-4"> >> 관리물건 수정 화면입니다!</h1>
    <p class="lead">
      (1) '명칭'은 평상시 부르는 이름으로 적어주세요. 예)도레미고시원, 성공빌딩<br>
      (2) '수금방법'은 임대료를 선불로 수납할 경우 선불 선택, 후불로 수납할경우 후불을 선택하세요.<br>
      (3) '형태' 변경을 원하는 경우 상단 <a href="/user/myinfo.php"><i class="fas fa-user"></i>&nbsp;나의정보</a>에서 임대유형을 수정하세요.<br>
      (4) <a href="https://www.popbill.com/Member/Form/Link" target="_blank">팝빌사이트</a>에 가입하고 사업자번호를 입력하면 전자세금계산서 연동 발행이 가능합니다.
    </p>
    <!-- <hr class="my-4"> -->
    <!-- <small>(1) '명칭'은 평상시 부르는 이름으로 적어주세요. 예)도레미고시원, 성공빌딩 (2) '수금방법'은 임대료를 선불로 수납할 경우 선불 선택, 후불로 수납할경우 후불을 선택하세요.</small> -->
  </div>
</section>
<section class="container" style="max-width:500px;">
  <form action="p_building_edit.php" method="post">
    <input type="hidden" name="id" value="<?=$row['id']?>">
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-3 col-form-label">형태(IDX)</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="name" value="<?=$_SESSION['lease_type'].'('.$row['id'].')'?>" disabled>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">명칭</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="name" value="<?=$row['bName']?>" required="">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">수금방법</label>
      <div class="col-sm-9">
        <select name="pay" class="form-control">
          <option value="선불"<?php if($row['pay']=="선불"){echo "selected";}?>>선불</option>
          <option value="후불"<?php if($row['pay']=="후불"){echo "selected";}?>>후불</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">팝빌가입</label>
      <div class="col-sm-9">
        <select class="form-control" name="popbill">
          <option value="popbillyes"
            <?php if($row['popbill']==='popbillyes'){echo "selected";}?>>가입</option>
          <option value="popbillno"<?php if($row['popbill']==='popbillno'){echo "selected";}?>>미가입</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">사업자번호</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="companynumber" value="<?=$row['companynumber']?>">
      </div>
    </div>
    <div class="">
      <p class="text-center text-muted">
        <small>등록일시[<?=$row['created']?>] 수정일시[<?=$row['updated']?>]</small>
      </p>
    </div>
    <div class="mt-7">
      <a class="btn btn-secondary" href="building.php" role="button">취소/돌아가기</a>
      <button type="submit" class="btn btn-primary">수정</button>
    </div>
  </form>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>
<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer_script.php"; ?>

<script type="text/javascript">
$(document).ready(function(){
  $('input[name=companynumber]').keydown(function (event) {
   var key = event.charCode || event.keyCode || 0;
   $text = $(this);
   if (key !== 8 && key !== 9) {
       if ($text.val().length === 3) {
           $text.val($text.val() + '-');
       }
       if ($text.val().length === 6) {
           $text.val($text.val() + '-');
       }
   }

   return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
// Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
// 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
})
})
</script>

</body>
</html>
