<!-- 원래 정기결제를 염두해두고만들었는데 정기결제가 없어지면서 파일내용을 바꿈, 10만원이 넘으면 현대카드에서 안되고 20만원 넘으면 농협카드/kb카드/bc카드가 안된다고해서 요금체계를 조금 바꿈 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>리스맨결제하기</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_SESSION);

$sql = "select count(*)
        from realcontract
        where user_id={$_SESSION['id']} and
              getstatus(startdate, enddate2) = 'present'
        ";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);

$pay1 = "
        &nbsp;<span class='badge badge-info monthonly'>바로가기</span>";
$pay2 = "
        &nbsp;<span class='badge badge-info threemonthonly'>바로가기</span>";
$pay3 = "
        &nbsp;<span class='badge badge-info yearonly'>바로가기</span>";

$payAmount = [
              [1, 20, 0, 0, 0],
              [2, 30, 19900, 13900, 9900],
              [3, 50, 29900, 20900, 19900],
              [4, 130, 59900, 41900, 29900],
              [5, 200, 79900, 55900, 39900],
              [6, 300, 99900, 69900, 49900]
             ];

$currentDate = date('Y-m-d');

$currentDateDate = new DateTime($currentDate);
$startDateDate = new DateTime($_SESSION['created']);

$fordays = date_diff($currentDateDate, $startDateDate);

$fordays2 = $fordays->days;

$month1later = date('Y-m-d', strtotime($currentDate.'+1 month -1 days'));
$month3later = date('Y-m-d', strtotime($currentDate.'+3 month -1 days'));
$year1later = date('Y-m-d', strtotime($currentDate.'+1 year -1 days'));

// echo 666;
?>

<style media="screen">
  /* .fas {
    color:yellow;
  } */
</style>

<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">이용요금입니다</h1>
    <p class="lead">
    (1)계약건수에 따라 등급을 선택하세요 (계약건수는 통상적으로 방 개수를 말합니다.)<br>
    (2)<?=$_SESSION['email']?>님의 현재계약건수는 <?=$row[0]?>건 이며, 회원가입한지 <?=$fordays2?>일 되었습니다. (회원가입후 30일 및 계약건수 20건 이하는 영구 무료이용)
    <hr class="my-4">
  </div>
</section>

<section class="container">
  <table class="table table-bordered text-center">
    <tr>
      <th rowspan="2">등급</th>
      <th rowspan="2">건수</th>
      <th colspan="3">이용요금</th>
    </tr>
    <tr>
      <th>1개월 구매하기</th>
      <th>3개월 구매하기(월요금)</th>
      <th>12개월 구매하기(월요금)</th>
    </tr>
    <tr>
      <td><i class="fas fa-star"></i>(스타)1</td>
      <td><?=$payAmount[0][1]?>건</td>
      <td><?=$payAmount[0][2]?>원</td>
      <td><?=$payAmount[0][3]?>원</td>
      <td><?=$payAmount[0][4]?>원</td>
    </tr>
    <tr>
      <td><i class="fas fa-star"></i>(스타)2
        <input type="hidden" name="gradename" value="star2">
        <input type="hidden" name="1monthAmount" value="<?=$payAmount[1][2]?>">
        <input type="hidden" name="monthlyAmount" value="<?=$payAmount[1][3]?>">
        <input type="hidden" name="1yearAmount" value="<?=$payAmount[1][4]?>">
      </td>
      <td><?=$payAmount[1][1]?>건</td>
      <td><?=number_format($payAmount[1][2])?>원
        <?php
        if((int)$row[0]<=30){
          echo $pay1;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[1][3])?>원
        <?php
        if((int)$row[0]<=30){
          echo $pay2;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[1][4])?>원
        <?php
        if((int)$row[0]<=30){
          echo $pay3;
        }
         ?>
      </td>
    </tr>
    <tr>
      <td><i class="fas fa-star"></i>(스타)3
        <input type="hidden" name="gradename" value="star3">
        <input type="hidden" name="1monthAmount" value="<?=$payAmount[2][2]?>">
        <input type="hidden" name="monthlyAmount" value="<?=$payAmount[2][3]?>">
        <input type="hidden" name="1yearAmount" value="<?=$payAmount[2][4]?>">
      </td>
      <td><?=$payAmount[2][1]?>건</td>
      <td><?=number_format($payAmount[2][2])?>원
        <?php
        if((int)$row[0]<=50){
          echo $pay1;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[2][3])?>원
        <?php
        if((int)$row[0]<=50){
          echo $pay2;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[2][4])?>원
        <?php
        if((int)$row[0]<=50){
          echo $pay3;
        }
         ?>
      </td>
    </tr>
    <tr>
      <td><i class="fas fa-star"></i>(스타)4
        <input type="hidden" name="gradename" value="star4">
        <input type="hidden" name="1monthAmount" value="<?=$payAmount[3][2]?>">
        <input type="hidden" name="monthlyAmount" value="<?=$payAmount[3][3]?>">
        <input type="hidden" name="1yearAmount" value="<?=$payAmount[3][4]?>">
      </td>
      <td><?=$payAmount[3][1]?>건</td>
      <td><?=number_format($payAmount[3][2])?>원
        <?php
        if((int)$row[0]<=130){
          echo $pay1;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[3][3])?>원
        <?php
        if((int)$row[0]<=130){
          echo $pay2;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[3][4])?>원
        <?php
        if((int)$row[0]<=130){
          echo $pay3;
        }
         ?>
      </td>
    </tr>
    <tr>
      <td><i class="fas fa-star"></i>(스타)5
        <input type="hidden" name="gradename" value="star5">
        <input type="hidden" name="1monthAmount" value="<?=$payAmount[4][2]?>">
        <input type="hidden" name="monthlyAmount" value="<?=$payAmount[4][3]?>">
        <input type="hidden" name="1yearAmount" value="<?=$payAmount[4][4]?>">
      </td>
      <td><?=$payAmount[4][1]?>건</td>
      <td><?=number_format($payAmount[4][2])?>원
        <?php
        if((int)$row[0]<=200){
          echo $pay1;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[4][3])?>원
        <?php
        if((int)$row[0]<=200){
          echo $pay2;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[4][4])?>원
        <?php
        if((int)$row[0]<=200){
          echo $pay3;
        }
         ?>
      </td>
    </tr>
    <tr>
      <td><i class="fas fa-star"></i>(스타)6
        <input type="hidden" name="gradename" value="star6">
        <input type="hidden" name="1monthAmount" value="<?=$payAmount[5][2]?>">
        <input type="hidden" name="monthlyAmount" value="<?=$payAmount[5][3]?>">
        <input type="hidden" name="1yearAmount" value="<?=$payAmount[5][4]?>">
      </td>
      <td><?=$payAmount[5][1]?>건</td>
      <td><?=number_format($payAmount[5][2])?>원
        <?php
        if((int)$row[0]<=300){
          echo $pay1;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[5][3])?>원
        <?php
        if((int)$row[0]<=300){
          echo $pay2;
        }
         ?>
      </td>
      <td><?=number_format($payAmount[5][4])?>원
        <?php
        if((int)$row[0]<=300){
          echo $pay3;
        }
         ?>
      </td>
    </tr>
  </table>
  <div class="">
    <p class="lead">
    카드결제가 불가할 경우 계좌입금처리 가능합니다. 계좌는 국민 272701-04-336217 유진희(리스맨소프트)로 해당금액을 입금해주세요.
  </div>
</section>

<script>

//숫자에 콤마 넣음
Number.prototype.format = function(){
    if(this==0) return 0;

    var reg = /(^[+-]?\d+)(\d{3})/;
    var n = (this + '');

    while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');

    return n;
};

//문자를 숫자형태로 바꿔서 콤마 넣음
String.prototype.format = function(){
    var num = parseFloat(this);
    if( isNaN(num) ) return "0";

    return num.format();
};

var today = <?=json_encode($currentDate)?>;
var month1later = <?=json_encode($month1later)?>;
var month3later = <?=json_encode($month3later)?>;
var year1later = <?=json_encode($year1later)?>;

function goCategoryPage(a, b, c, d, e, f, g){
  var frm = formCreate('gradeAdd', 'post', 'p_gradeAdd.php','');
  frm = formInput(frm, 'paydiv', a);
  frm = formInput(frm, 'today', b);
  frm = formInput(frm, 'month1later', c);
  frm = formInput(frm, 'month3later', d);
  frm = formInput(frm, 'year1later', e);
  frm = formInput(frm, 'amount', f);
  frm = formInput(frm, 'gradename', g);
  formSubmit(frm);
}


$('.monthonly').on('click', function(){
  var curTr = $(this).closest('tr');
  var amount = curTr.children('td:eq(0)').children('input[name=1monthAmount]').val();
  var gradename = curTr.children('td:eq(0)').children('input[name=gradename]').val();
  var paydiv = 'monthonly';
  var pay = confirm(month1later + '까지 1개월 이용 가능합니다. 결제 진행하시겠습니까?');

  if(pay){
    goCategoryPage(paydiv, today, month1later, month3later, year1later, amount, gradename);
  }

})

$('.threemonthonly').on('click', function(){
  var curTr = $(this).closest('tr');
  var amount = curTr.children('td:eq(0)').children('input[name=monthlyAmount]').val();
  var threemonthamount = Number(amount)*3;
  var paydiv = 'threemonthonly'
  // console.log(monthAmount);
  var gradename = curTr.children('td:eq(0)').children('input[name=gradename]').val();

  var pay = confirm(month3later + '까지 리스맨 이용 가능합니다. 결제 금액은 3개월치 '+threemonthamount.format()+'원입니다. 결제 진행하시겠습니까?');

  if(pay){
    goCategoryPage(paydiv, today, month1later, month3later, year1later, threemonthamount, gradename);
  }
})


$('.yearonly').on('click', function(){
  var curTr = $(this).closest('tr');
  var amount = curTr.children('td:eq(0)').children('input[name=1yearAmount]').val();
  var yearAmount2 = Number(amount)*12;
  var paydiv = 'yearonly';
  var gradename = curTr.children('td:eq(0)').children('input[name=gradename]').val();

  var pay = confirm(year1later + '까지 리스맨 이용 가능합니다. 결제 금액은 12개월치 '+yearAmount2.format()+'원입니다. 결제 진행하시겠습니까?');

  if(pay){
    goCategoryPage(paydiv, today, month1later, year1later, yearAmount2, gradename);
  }
})

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
