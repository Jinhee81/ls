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

  $output2 = "<button type='button' class='btn btn-secondary btn-sm mr-0' data-dismiss='modal'>닫기</button>
  <button type='button' class='btn btn-primary btn-sm getExecute'>입금완료</button>";

  echo $output2;
}
 ?>

<script>
$('.getExecute').on('click', function(){ //입금완료버튼(모달안버튼) 클릭

  var aa1 = 'payScheduleInput';
  var bb1 = 'p_payScheduleGetAmountInput2.php';
  var contractId = '<?=$_POST['filtered_id']?>';

  var pid = $(this).parent().parent().children(':eq(0)').children(':eq(0)').children(':eq(0)').text(); //청구번호

  var ppayKind = $(this).parent().prev().children().children(':eq(2)').children(':eq(1)').children().val(); //입금구분

  var pgetDate = $(this).parent().prev().children().children(':eq(3)').children(':eq(1)').children().val(); //입금일

  var pgetAmount = $(this).parent().prev().children().children(':eq(4)').children(':eq(1)').children().val(); //입금액

  // console.log(pid, ppayKind, pgetDate, pgetAmount);



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

</script>
