<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
 ?>
<section class="container">
  <div class="jumbotron">
    <h3 class="display-4">내 정보를 확인 또는 수정합니다.</h3>
    <hr class="my-4">
    <!-- <p>It uses utility classes for typography and spacing to space content out within the larger container.</p> -->
    <a class="btn btn-primary btn-sm" href="#" role="button">사용량조회</a>
    <a class="btn btn-primary btn-sm" href="#" role="button">결제정보조회</a>
    <!-- <a class="btn btn-primary btn-sm" href="#" role="button">비밀번호변경</a> -->
 </div>
</section>

<div class="container" style="max-width:500px;">
  <form id="myinfo" method="post" action ="myinfo_edit_proccess.php" class="form-signin">
    <div class="form-group row">
      <label for="staticEmail" class="col-sm-4 col-form-label">이메일</label>
      <div class="col-sm-8">
        <input type="text" name="email" readonly class="form-control-plaintext" value="<?=$_SESSION['email']?>">
      </div>
    </div>

    <div class="form-group">

      <div class="form-row">
        <div class="form-group col-md-4">
          <label>회원구분</label>
          <select id="selectUserDiv" name="user_div" class="form-control">
            <option value='개인' <?php if($_SESSION['user_div']=="개인"){echo "selected";}?>> 개인</option>"
            <option value='개인사업자' <?php if($_SESSION['user_div']=="개인사업자"){echo "selected";}?>>개인사업자</option>"
            <option value='법인사업자' <?php if($_SESSION['user_div']=="법인사업자"){echo "selected";}?>>법인사업자</option>"
          </select>
        </div>


        <div class="form-group col-md-8">
          <label>회원명</label>
          <input type="text" name="user_name" class="form-control"      placeholder="회원명" required="" autofocus="" value="<?=$_SESSION['user_name']?>">
        </div>
      </div>
    </div>
    <div class="" id="y">

    </div>

    <div class="form-group">
      <div class="form-row">
        <div class="form-group col-md-4 mb-1">
          <label>담당자명</label>
          <input type="text" name="damdangga_name" class="form-control" value="<?=$_SESSION['damdangga_name']?>" onclick="x();">
        </div>
        <div class="form-group col-md-8 mb-1">
          <label>담당자 휴대폰번호</label>
          <input type="text" name="cellphone" class="form-control"      value="<?=$_SESSION['cellphone']?>" required="" autofocus="">
        </div>
      </div>
      <button type="submit" name="cellphone_auth" class="btn btn-sm btn-primary btn-block">휴대폰번호인증</button>
    </div>

    <div class="form-group">
      <label>임대유형</label>
      <select name="lease_type" class="form-control">
        <option value="공유오피스" <?php if($_SESSION['lease_type']=="공유오피스"){echo "selected";}?>>공유오피스</option>
        <option value="원룸" <?php if($_SESSION['lease_type']=="원룸"){echo "selected";}?>>원룸</option>
        <option value="빌딩" <?php if($_SESSION['lease_type']=="빌딩"){echo "selected";}?>>빌딩</option>
        <option value="고시원" <?php if($_SESSION['lease_type']=="고시원"){echo "selected";}?>>고시원</option>
        <option value="창고" <?php if($_SESSION['lease_type']=="창고"){echo "selected";}?>>창고</option>
        <option value="임대관리회사" <?php if($_SESSION['lease_type']=="임대관리회사"){echo "selected";}?>>임대관리회사</option>
        <option value="기타" <?php if($_SESSION['lease_type']=="기타"){echo "selected";}?>>기타</option>
      </select>
    </div>

    <div class="form-row mt-2">
      <div class="form-group col-md-6">
        <button type="submit" class="btn btn-sm btn-outline-info btn-block">수정하기</button>
      </div>
      <div class="form-group col-md-6">
        <a class="btn btn-sm btn-outline-success btn-block" href="#" role="button">비밀번호변경 바로가기</a>
      </div>
    </div>
  </form>

</div>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";
?>
