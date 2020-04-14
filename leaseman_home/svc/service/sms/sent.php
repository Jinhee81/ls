<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>보낸문자리스트</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/contract/building.php"; //이거빼면큰일남, 조회안됨
 ?>

<style>
         #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
         #thead2 tr.selected{background-color: #A9D0F5;}
         #tbody2 tr.selected{background-color: #A9D0F5;}
         select .selectCall{background-color: #A9D0F5;}

         .green{
           color: #04B486;
         }

         @media (max-width: 990px) {
         .mobile {
           display: none;
         }
 }
</style>
<section class="container">
   <div class="jumbotron">
     <h1 class="display-4"><span id="screenName">보낸문자리스트화면</span>입니다!(#601)</h1>
     <p class="lead">

     </p>
   </div>
</section>

<section class="container">
   <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
     <!-- <div class="row justify-content-md-center"> -->
       <form>
         <div class="form-group row justify-content-md-center mb-2">
           <div class="col-sm-1 pl-0 pr-0">
             <select class="form-control form-control-sm selectCall" id="dateDiv" name="dateDiv">
               <option value="sendtime">전송일자</option>
             </select><!---->
           </div>
           <div class="col-sm-1 pl-0 pr-0">
             <select class="form-control form-control-sm selectCall" id="periodDiv" name="periodDiv">
               <option value="allDate">--</option>
               <option value="nowMonth" selected>당월</option>
               <option value="pastMonth">전월</option>
               <option value="1pastMonth">1개월</option>
               <option value="3pastMonth">3개월</option>
               <option value="nowYear">당년</option>
             </select><!---->
           </div>
           <div class="col-sm-1 pl-0 pr-0">
             <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType" id=""><!--fromDate-->
           </div>
           <div class="col-sm-1 pl-0 pr-0">
             <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType" id=""><!--toDate-->
           </div>
           <div class="col-sm-1 pl-0 pr-0">
             <select class="form-control form-control-sm selectCall" id="type" name="type">
               <option value="typeAll">유형</option>
               <option value="sms">단문(sms)</option>
               <option value="mms">장문(mms)</option>
             </select><!--유형-->
           </div>
           <div class="col-sm-1 pl-0 pr-0">
             <select class="form-control form-control-sm selectCall" id="result" name="result">
               <option value="resultall">결과</option>
               <option value="success">전송성공</option>
               <option value="fail">전송실패</option>
             </select><!--결과-->
           </div>

           <div class="col-sm-1 pl-0 pr-0">
             <select class="form-control form-control-sm selectCall" id="etcCondi" name="etcCondi">
               <option value="customer">세입자명</option>
               <option value="contact">연락처</option>
             </select><!---->
           </div>
           <div class="col-sm-1 pl-0 pr-0">
             <input type="text" name="cText" value="" class="form-control form-control-sm text-center"><!---->
           </div>
           <div class="col-sm-1 pl-0 pr-0">
             <button type="button" name="btnLoad" class="btn btn-info btn-sm btn-block">조회</button>
           </div>
         </div>
       </form>

     <!-- </div> -->

  </div>
</section>

<section class="container">
  <div id="allVals">

  </div>
</section>

<script src="/admin/js/jquery-ui.min.js"></script>
<script src="/admin/js/datepicker-ko.js"></script>
<script src="/admin/js/etc/newdate8.js"></script>
<script>
$(document).ready(function(){

    $('input[name="fromDate"]').val(todayMonthFirst);
    $('input[name="toDate"]').val(todayMonthLast);


    $.ajax({
      url: 'ajax_sentsmsLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

    $('.dateType').datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      // showOn: "button",
      buttonImage: "/img/calendar.svg",
      buttonImageOnly: false
    })

    $('#smsDiv').html('<span class="badge badge-primary">sms</span>');


})

//---------document.ready end and 조회버튼클릭 펑션 시작--------------//


$('button[name="btnLoad"]').on('click', function(){
    $.ajax({
      url: 'ajax_sentsmsLoad.php',
      method: 'post',
      data: $('form').serialize(),
      success: function(data){
        $('#allVals').html(data);
      }
    })

})
//---------조회버튼클릭평션 end and 증빙일자 펑션 시작--------------//
</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>
