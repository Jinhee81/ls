<!-- 처음에 만들때는 구분2가 있었는데 그거 자체를 삭제하고 다시 만듬 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>세입자일괄등록</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>

<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">일괄등록 화면입니다!</h1>
    <p class="lead">이 화면에서는 한꺼번에 많은 세입자를 등록합니다.</p>
    <small>(1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다. (2)연락처는 010으로 시작하는 핸드폰번호 기준입니다.(지역번호 02로 시작하는 번호 또는 031로 시작하는 번호는 고객상세화면에서 수정하세요)</small>
    <hr class="my-4">
    <a class="btn btn-primary btn-sm mobile" href="m_c_add_csv.php" role="button">csv등록</a>
  </div>
</section>
<section class="container" style="max-width:1200px;">
  <form method="post" action ="p_m_c_adds.php">
    <div class="form-group row justify-content-md-center">
      <div class="col-sm-1 pl-0 pr-0" style="">
        <label>구분(대)</label>
      </div>
      <div class="col-sm-1 pl-0 pr-0" style="">
        <select name="div1" class="form-control">
          <option value="세입자">세입자</option>
          <option value="거래처">거래처</option>
          <option value="기타">기타</option>
        </select>
      </div>
    </div>

    <table id="centerSection" class='table table-bordered text-center'>
    </table>
    <table class='table table-bordered text-center table-sm'>
      <tr>
        <td width="5%">순번</td>
        <td width="10%"><span id='star' style='color:#F7BE81;'>* </span>성명</td>
        <td width="10%"><span id='star' style='color:#F7BE81;'>* </span>연락처</td>
        <td width="5%">구분</td>
        <td width="10%">사업자명</td>
        <td width="10%">사업자번호</td>
        <td width="10%">이메일</td>
        <td width="10%">특이사항</td>
        <td width="5%"></td>
      </tr>
      <?php  for ($i=1; $i < 11 ; $i++) { ?>
        <tr>
          <td>
            <label class="mt-1"><?=$i?></label>
          </td><!--순번-->
          <td><input type='text' class='form-control form-control-sm text-center' name='name<?=$i?>' required></td><!--성명-->

          <td><input type=text name='num<?=$i?>' class='form-control form-control-sm phonenumber' maxlength="13" value="010-" required></td>
          <!--연락처-->
          <td>
            <select class="form-control form-control-sm" name="div3<?=$i?>">
              <option value=""></option>
              <option value="주식회사">주식회사</option>
              <option value="유한회사">유한회사</option>
              <option value="합자회사">합자회사</option>
              <option value="기타">기타</option>
            </select>
          </td><!--구분-->
          <td><input type='text' class='form-control form-control-sm text-center' name='companyname<?=$i?>'></td><!--사업자명-->
          <!-- <td><input type='text' class='form-control form-control-sm numberonly' name='cNumber<?=$i?>'></td> -->
          <td><input type=text name='cNumber<?=$i?>' class='form-control form-control-sm companynumber text-center' maxlength=12></td>
          <!--사업자번호-->
          <td><input type='email' class='form-control form-control-sm text-center' name='email<?=$i?>'></td><!--이메일-->
          <td><input type='text' class='form-control form-control-sm text-center' name='etc<?=$i?>'></td><!--특이사항-->
          <td class="pt-2">
            <div class='badge badge-warning text-wrap' style='width: 3rem;' name='rowDeleteBtn'>행삭제</div>
          </td><!--행삭제-->
        </tr>
      <?php } ?>

    </table>
    <div class="row justify-content-center">
      <button type='submit' class='btn btn-primary mr-1'>저장</button>
      <a href='customer.php'><button type='button' class='btn btn-secondary'>세입자리스트화면으로</button></a>
    </div>
  </form>
</section>

<script type="text/javascript">
$(document).ready(function () {
   $(function () {

            $('.companynumber').keydown(function (event) {
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

         $('.phonenumber').keydown(function (event) {
          var key = event.charCode || event.keyCode || 0;
          $text = $(this);
          if (key !== 8 && key !== 9) {
              if ($text.val().length === 3) {
                  $text.val($text.val() + '-');
              }
              if ($text.val().length === 8) {
                  $text.val($text.val() + '-');
              }
          }

          return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    // Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
    // 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
      })
   });

});

$('div[name="rowDeleteBtn"]').on('click', function(){
  // console.log('삭제하기');
  var currow = $(this).closest('tr');
  currow.remove();
  // alert('삭제하였습니다');
})

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
