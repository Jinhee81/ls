<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>나의정보</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$sql = "select
          email, user_div, user_name,
          cellphone, lease_type, created, updated, gradename, coin
        from user
        where id={$_SESSION['id']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

 ?>
<section class="container">
  <div class="jumbotron">
    <h3 class="display-4">내 정보를 확인 또는 수정합니다.</h3>
    <hr class="my-4">
    <p class="lead"><?=$_SESSION['email']?>님은 현재 <?=$row['gradename']?>등급이며 <?=number_format($row['coin'])?>코인 보유중입니다.</p>
    <a class="btn btn-primary btn-sm" href="usecount.php" role="button">사용량/결제정보조회</a>
    <a class="btn btn-primary btn-sm" href="password_change.php" role="button">비밀번호변경</a>
    <a class="btn btn-warning btn-sm" href="/main/payment.php" role="button">요금구매</a>
    <a class="btn btn-warning btn-sm" href="/main/coinpay.php" role="button">코인구매</a>
 </div>
</section>

<div class="container" style="max-width:500px;">
  <form class="" action="myinfo_edit_proccess.php" method="post">
    <div class="form-group row">
      <label for="" class="col-sm-3 col-form-label"><b>회원번호</b></label>
      <label for="" class="col-sm-9 col-form-label"><?=$_SESSION['id']?></label>
    </div>
    <div class="form-group row">
      <label for="" class="col-sm-3 col-form-label"><b>이메일</b></label>
      <label for="" class="col-sm-9 col-form-label"><?=$row['email']?></label>
    </div>
    <div class="form-group row">
      <label for="" class="col-sm-3 col-form-label"><b>회원구분</b></label>
      <div class="col-sm-9">
        <select name="user_div" class="form-control">
          <option value='개인' <?php if($row['user_div']==="개인"){echo "selected";}?>>개인</option>
          <option value='사업자' <?php if($row['user_div']==="사업자"){echo "selected";}?>>사업자</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="" class="col-sm-3 col-form-label"><b>회원명</b></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="user_name" value="<?=$row['user_name']?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="" class="col-sm-3 col-form-label"><b>연락처</b></label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="cellphone" value="<?=$row['cellphone']?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="" class="col-sm-3 col-form-label"><b>임대유형</b></label>
      <div class="col-sm-9">
        <select name="lease_type" class="form-control">
          <option value="공유오피스" <?php if($row['lease_type']=="공유오피스"){echo "selected";}?>>공유오피스</option>
          <option value="원룸" <?php if($row['lease_type']=="원룸"){echo "selected";}?>>원룸</option>
          <option value="빌딩" <?php if($row['lease_type']=="빌딩"){echo "selected";}?>>빌딩</option>
          <option value="고시원" <?php if($row['lease_type']=="고시원"){echo "selected";}?>>고시원</option>
          <option value="창고" <?php if($row['lease_type']=="창고"){echo "selected";}?>>창고</option>
          <option value="임대관리회사" <?php if($row['lease_type']=="임대관리회사"){echo "selected";}?>>임대관리회사</option>
          <option value="기타" <?php if($row['lease_type']=="기타"){echo "selected";}?>>기타</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="" class="col-sm-3 col-form-label"><b>가입일시</b></label>
      <label for="" class="col-sm-9 col-form-label"><?=$row['created']?></label>
    </div>
    <div class="form-group row">
      <label for="" class="col-sm-3 col-form-label"><b>수정일시</b></label>
      <label for="" class="col-sm-9 col-form-label"><?=$row['updated']?></label>
    </div>
    <button type="submit" class="btn btn-sm btn-outline-info btn-block">수정하기</button>
  </form>
</div>


<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";
?>