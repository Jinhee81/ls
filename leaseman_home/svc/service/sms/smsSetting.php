<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>문자상용구설정</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

$sql = "select
          screen, title, description
        from sms
        where user_id={$_SESSION['id']}";

$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
    $allRows[] = $row;
}

// print_r($allRows);
?>

<style media="screen">
.grey{
  color: #848484;
}
</style>

<section class="container">
  <div class="jumbotron pt-4 pb-3">
    <h1 class="display-4">문자상용구설정화면입니다!</h1>
    <p class="lead">

    </p>
  </div>
</section>

<section class="container" style="width:1000px;">
  <div class="row justify-content-md-center mb-2">
      <div class="col col-sm-3">
        <select class="form-control" id="screenName">
            <option value="all">전체</option>
            <option value="세입자화면">세입자화면</option>
            <option value="방계약화면">방계약화면</option>
            <option value="입금예정화면">입금예정화면</option>
            <option value="입금완료화면">입금완료화면</option>
        </select>
      </div>
  </div>
  <div class="container" style="width:1000px;" id="allVals">

  </div>
</section>

<script>

  var screenName = $('#screenName').val();
  $.ajax({
    url: 'ajax_smsAddLoad.php',
    method: 'post',
    data: {screenName : screenName},
    success: function(data){
      $('#allVals').html(data);
    }
  })

  $('#screenName').on('change', function(){
      var screenName = $('#screenName').val();
      $.ajax({
        url: 'ajax_smsAddLoad.php',
        method: 'post',
        data: {screenName : screenName},
        success: function(data){
          $('#allVals').html(data);
        }
      })
  })



</script>



<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>
