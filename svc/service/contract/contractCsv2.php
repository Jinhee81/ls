<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
?>

<!-- <script src="csaddss.js?v=<%=System.currentTimeMillis() %>"></script> -->
<style media="screen">
  .italic{
    font-style: italic;
    color: blue;
  }
</style>


<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h3 class="">업로드한 파일 내용입니다.</h3>
    <p class="lead">이 화면에서는 엑셀업로드 형식으로 임대계약을 등록합니다.</p>
    <small>
      (1)(1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다. (2)잘못 입력된 내용은 글자색이 빨간색이니 주의하세요.
    </small>

    <hr class="my-4">

  </div>
</section>

<?php
if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] !== ""){
  $file = $_FILES['upfile'];
  $max_file_size = 5242880;

  if($file['size'] >= $max_file_size){
    echo "<script>alert('5MB 까지만 업로드 가능합니다.');</script>";
  }

  $handle = fopen($file['tmp_name'], 'r');?>

<section class="container">
  <form method="post" action="p_cfile_upload_csv.php">
    <table class="table table-bordered text-center">
      <tr>
        <td><span id='star' style='color:#F7BE81;'>* </span>물건명</td>
        <td><span id='star' style='color:#F7BE81;'>* </span>그룹명</td>
        <td><span id='star' style='color:#F7BE81;'>* </span>관리번호</td>
        <td><span id='star' style='color:#F7BE81;'>* </span>성명</td>
        <td>계약일자</td>
        <td>공급가액</td>
        <td>세액</td>
        <td>개월수</td>
        <td>시작일</td>
        <td>보증금</td>
        <td>보증금입금일</td>
      </tr>
      <?php
        $i = 1;
        while($data = fgetcsv($handle)){
          ?>
        <tr>
          <td><?=$i?></td>
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div1" name="<?=$i?>div1" value="<?=$data[0]?>" required></td><!--구분1-->
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div2" name="<?=$i?>div2" value="<?=$data[1]?>" required></td><!--구분2-->
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center name" name="<?=$i?>name" value="<?=$data[2]?>" required maxLength="9"></td><!--성명-->
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center contact" name="<?=$i?>contact" value="<?=$data[3]?>" required></td><!--연락처-->
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center gender" name="<?=$i?>gender" value="<?=$data[4]?>"></td><!--성별-->
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="email" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center email" name="<?=$i?>email" value="<?=$data[5]?>" maxLength="40"></td><!--이메일-->
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div3" name="<?=$i?>div3" value="<?=$data[6]?>"></td><!--법인사업자구분-->

          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center companyname" name="<?=$i?>companyname" value="<?=$data[7]?>" maxLength="14"></td><!--사업자명-->
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center companyNumber" name="<?=$i?>companyNumber" value="<?=$data[8]?>"></td><!--사업자번호-->
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div4" name="<?=$i?>div4" value="<?=$data[9]?>" maxLength="9"></td><!--업태-->
          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div5" name="<?=$i?>div5" value="<?=$data[10]?>" maxLength="14"></td><!--업종-->

          <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center etc" name="<?=$i?>etc" value="<?=$data[11]?>" maxLength="47"></td><!--특이사항-->
          <td class="pl-1 pr-1 pt-2 pb-1">
            <img src="/svc/inc/img/svg/minus.svg" width="20" name="minus">
          </td><!--행추가/삭제-->
        </tr>
      <?php
      $i = $i + 1;
    }
      ?>
    </table>
    <div class="d-flex justify-content-center">

      <table width="350px;">
        <tr>
          <td width="35%"><select name="building" class="form-control">
          </select></td>
          <td width="20%"><button type="button" name="saveBtn" class="btn btn-primary btn-block">등록</button></td>
          <td width="40%"><a href="m_c_add_csv1.php"><button type="button" name="button" class="btn btn-secondary mr-1">이전화면 <i class="fas fa-angle-double-right"></i></button></a></td>
        </tr>
      </table>

    </div>
  </form>
</section>
<?php
}
?>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>

<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){


})//docu.ready }


</script>
</body>
</html>
