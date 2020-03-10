<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);
?>
<?php
if(isset($_POST['payNumber'])){
  $sql = "
    select * from paySchedule2 where idpaySchedule2={$_POST['payNumber']}";

  // echo $sql;

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  if($row['executiveDate']){
    $output2 = "<button type='button' class='btn btn-secondary btn-sm mr-0' data-dismiss='modal'>닫기</button>
    <button type='button' class='btn btn-warning btn-sm mr-0 getExecuteBack2'>입금취소</button>";
  } else {
    $output2 = "<button type='button' class='btn btn-secondary btn-sm mr-0' data-dismiss='modal'>닫기</button>
    <button type='button' class='btn btn-warning btn-sm mr-0 getExecuteBack'>청구취소</button>
    <button type='button' class='btn btn-primary btn-sm getExecute'>입금완료</button>";
  }

  echo $output2;
}
 ?>

<script>
$('.getExecute').on('click', function(){ //입금완료버튼(모달안버튼) 클릭

  var aa1 = 'payScheduleInput';
  var bb1 = 'p_payScheduleGetAmountInput.php';
  var contractId = '<?=$_POST['filtered_id']?>';

  var pid = $(this).parent().parent().children(':eq(0)').children(':eq(0)').children(':eq(0)').text(); //청구번호

  var ppayKind = $(this).parent().prev().children().children(':eq(2)').children(':eq(1)').children().val(); //입금구분

  var pgetDate = $(this).parent().prev().children().children(':eq(3)').children(':eq(1)').children().val(); //입금일

  var pgetAmount = $(this).parent().prev().children().children(':eq(4)').children(':eq(1)').children().val(); //입금액

  var pExpectedAmount = $(this).parent().prev().children().children(':eq(0)').children(':eq(1)').children().val(); //예정금액

  // console.log(pExpectedAmount);

  if(pgetAmount != pExpectedAmount){
    alert('입금액과 예정금액은 같아야 합니다.');
    return false;
  }

  goCategoryPage(aa1, bb1, pid, ppayKind, pgetDate, pgetAmount, contractId);

  function goCategoryPage(a, b, c, d, e, f, g){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, 'realContract_id', g);
    frm = formInput(frm, 'payid', c);
    frm = formInput(frm, 'paykind', d);
    frm = formInput(frm, 'pgetdate', e);
    frm = formInput(frm, 'pgetAmount', f);
    formSubmit(frm);
  }
})

$('.getExecuteBack').on('click', function(){ //청구취소(삭제)버튼(모달안버튼) 클릭
  var aa1 = 'payScheduleDrop';
  var bb1 = 'p_payScheduleDrop.php';
  var contractId = '<?=$_POST['filtered_id']?>'

  var pid = $(this).parent().parent().children(':eq(0)').children(':eq(0)').children(':eq(0)').text(); //청구번호

  // console.log(pid, contractId);

  goCategoryPage(aa1, bb1, contractId, pid);

  function goCategoryPage(a, b, c, d){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, 'realContract_id', c);
    frm = formInput(frm, 'payid', d);
    formSubmit(frm);
  }

})

$('.getExecuteBack2').on('click', function(){ //입금취소버튼(모달안버튼) 클릭
  var aa1 = 'payScheduleGetAmountCansel';
  var bb1 = 'p_payScheduleGetAmountCansel.php';
  var contractId = '<?=$_POST['filtered_id']?>';

  var pid = $(this).parent().parent().children(':eq(0)').children(':eq(0)').children(':eq(0)').text(); //청구번호

  // console.log(pid, contractId);

  goCategoryPage(aa1, bb1, contractId, pid);

  function goCategoryPage(a, b, c, d){
    var frm = formCreate(a, 'post', b,'');
    frm = formInput(frm, 'realContract_id', c);
    frm = formInput(frm, 'payid', d);
    formSubmit(frm);
  }

})
</script>
