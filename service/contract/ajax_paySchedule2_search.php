<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);
?>

<script>
  $(document).ready(function(){
    $("input:text[numberOnly]").number(true);

    $(".amountNumber").click(function(){
      $(this).select();
    });

    $('.dateType').datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      // showOn: "button",
      buttonImage: "/img/calendar.svg",
      buttonImageOnly: false
    });
  })
</script>

<?php
if(isset($_POST['payNumber'])){
  $output = '';
  $sql = "
    select * from paySchedule2 where idpaySchedule2={$_POST['payNumber']}";

  // echo $sql;

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $output .= '<div class="container">';
  $output .= '<div class="form-row">
      <div class="form-group col-md-4 mb-0">
        <p class="text-left">예정금액</p>
      </div>
      <div class="form-group col-md-6 mb-0">
        <input type="text" class="form-control form-control-sm" value="'.$row['ptAmount'].'" numberOnly disabled>
      </div>
      <div class="form-group col-md-2 mb-0">
        <p class="text-left">원</p>
      </div>
  </div>';
  $output .= '<div class="form-row">
      <div class="form-group col-md-4 mb-0">
        <p class="text-left">예정일</p>
      </div>
      <div class="form-group col-md-8 mb-0">
        <input type="text" class="form-control form-control-sm" value="'.$row['pExpectedDate'].'" disabled>
      </div>
  </div>';

  $output .= '<div class="form-row">
       <div class="form-group col-md-4 mb-0">
         <p class="text-left">입금구분</p>
       </div>
       <div class="form-group col-md-8 mb-0">';

  if($row['executiveDate']){
    $output .= '<select class="form-control form-control-sm" id="paykind" disabled><option value="'.$row['payKind'].'">'.$row['payKind'].'</option></select></div></div>';

  } else {
    if($row['payKind']==='계좌'){
      $output .= '<select class="form-control form-control-sm" id="paykind"><option value="계좌" selected>계좌</option>
                  <option value="현금">현금</option>
                  <option value="카드">카드</option></select></div></div>';
    } elseif($row['payKind']==='현금'){
      $output .= '<select class="form-control form-control-sm" id="paykind"><option value="계좌">계좌</option>
                  <option value="현금" selected>현금</option>
                  <option value="카드">카드</option></select></div></div>';
    } elseif($row['payKind']==='카드'){
      $output .= '<select class="form-control form-control-sm" id="paykind"><option value="계좌">계좌</option>
                  <option value="현금">현금</option>
                  <option value="카드" selected>카드</option></select></div></div>';
    }
  }



  $output .='<div class="form-row">
      <div class="form-group col-md-4 mb-0">
        <p class="text-left">입금일</p>
      </div>';
  if($row['executiveDate']){
    $output .= '<div class="form-group col-md-8 mb-0">
      <input type="text" class="form-control form-control-sm dateType" style="color:#F7819F;" value="'.$row['executiveDate'].'" disabled required>
    </div></div>';
  } else {
    $output .= '<div class="form-group col-md-8 mb-0">
      <input type="text" class="form-control form-control-sm dateType" style="color:#F7819F;" value="'.$row['pExpectedDate'].'" required>
    </div>
  </div>';
  }

  $output .='<div class="form-row">
      <div class="form-group col-md-4 mb-0">
        <p class="text-left">입금액</p>
      </div>';

  if($row['executiveDate']){
    $output .= '<div class="form-group col-md-6 mb-0">
      <input type="text" class="form-control form-control-sm amountNumber" style="color:#F7819F;" value="'.$row['getAmount'].'" numberOnly disabled required>
    </div>';
  } else {
    $output .= '<div class="form-group col-md-6 mb-0">
      <input type="text" class="form-control form-control-sm amountNumber" style="color:#F7819F;" value="'.$row['ptAmount'].'" numberOnly required>
    </div>';
  }

  $output .= '<div class="form-group col-md-2 mb-0">
    <p class="text-left">원</p>
  </div>
</div>';

  echo $output;
}
 ?>
