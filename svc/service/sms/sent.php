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

<!-- 제목섹션 -->
<section class="container">
   <div class="jumbotron pt-3 pb-3">
     <h2 class="">보낸문자 목록이에요.(#602)</h2>
     <p class="lead">

     </p>
   </div>
</section>

<!-- 조회조건섹션 -->
<section class="container">
   <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
     <div class="row justify-content-md-center">
       <form>
         <table>
           <tr>
             <td width="6%" class="">
               <select class="form-control form-control-sm selectCall" name="dateDiv">
                 <option value="sendtime">전송일자</option>
               </select>
             </td>
             <td width="6%" class="">
               <select class="form-control form-control-sm selectCall"name="periodDiv">
                 <option value="allDate">--</option>
                 <option value="nowMonth" selected>당월</option>
                 <option value="pastMonth">전월</option>
                 <option value="1pastMonth">1개월</option>
                 <option value="3pastMonth">3개월</option>
                 <option value="nowYear">당년</option>
               </select>
             </td>
             <td width="6%" class="">
               <input type="text" name="fromDate" value="" class="form-control form-control-sm text-center dateType">
             </td>
             <td width="1%" class="">~</td>
             <td width="6%" class="">
               <input type="text" name="toDate" value="" class="form-control form-control-sm text-center dateType">
             </td>
             <td width="6%" class="">
               <select class="form-control form-control-sm selectCall" id="type" name="type">
                 <option value="typeAll">유형</option>
                 <option value="sms">단문(sms)</option>
                 <option value="mms">장문(mms)</option>
               </select><!--유형-->
             </td>
             <td width="6%" class="">
               <select class="form-control form-control-sm selectCall" id="result" name="result">
                 <option value="resultall">결과</option>
                 <option value="success">전송성공</option>
                 <option value="fail">전송실패</option>
               </select>
             </td>
             <td width="6%" class="">
               <select class="form-control form-control-sm selectCall" id="etcCondi" name="etcCondi">
                 <option value="customer">받는사람</option>
                 <option value="contact">연락처</option>
               </select>
             </td>
             <td width="6%" class="">
               <input type="text" name="cText" class="form-control form-control-sm text-center">
             </td>
           </tr>
         </table>
       </form>
     </div>
  </div>
</section>

<!-- 표 섹션 -->
<section class="container">
  <table class="table table-hover table-bordered table-sm text-center" id="checkboxTestTbl">
    <thead>
      <tr class="table-secondary">
        <th class="">순번</th>
        <th class="">유형</th>
        <th class="">전송시간</th>
        <th class="">받는사람</th>
        <th class="">연락처</th>
        <th class="">방번호</th>
        <th class="">문자내용</th>
        <th class="">전송결과</th>
      </tr>
    </thead>
    <tbody id="allVals">

    </tbody>
  </table>
</section>

<section id="allVals2">

</section>

<?php include "modal_description.php"; ?>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>

<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js"></script>
<script src="/svc/inc/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>

<script>

function maketable(){

  // $(function () {
  //     $('[data-toggle="tooltip"]').tooltip()
  // })

  var mtable = $.ajax({
    url: 'ajax_sentsms_value.php',
    method: 'post',
    data: $('form').serialize(),
    success: function(data){
      data = JSON.parse(data);
      datacount = data.length;

      var returns = '';
      //
      if(datacount===0){
        returns ="<tr><td colspan='9'>조회값이 없어요.</td></tr>";
      } else {
        $.each(data, function(key, value){
          returns += '<tr>';
          returns += '<td class="">'+datacount+'</td>';

          if(value.type === 'sms'){
            returns += '<td class=""><div class="badge badge-primary text-wrap" style="width: 3rem;">단문</div></td>';
          } else if(value.type === 'mms'){
            returns += '<td class=""><div class="badge badge-danger text-wrap" style="width: 3rem;">장문</div></td>';
          } else {
            returns += '<td class=""></td>';
          }

          returns += '<td class="">'+value.sendtime+'<input type="hidden" name="byte" value="'+value.byte+'"></td>';
          returns += '<td class=""><label data-toggle="tooltip" data-placement="top" title="'+value.customer+'">'+value.customermb+'</label></td>';
          returns += '<td class="">'+value.phonenumber+'<input type="hidden" name="sentnumber" value="'+value.sentnumber+'"></td>';
          returns += '<td class="">'+value.roomnumber+'</td>';
          returns += '<td class=""><p class="modalDescription" data-toggle="modal" data-target="#smsDescription">'+value.descriptionmb+'</p><input type="hidden" name="description" value="'+value.description+'"></td>';
          returns += '<td class="">'+value.result+'</td>';

          returns += '</tr>';

          datacount -= 1;
        })
      }
      $('#allVals').html(returns);
    }
  })

  return mtable;
}

function msql(){
  var msqlajax = $.ajax({
    url: 'ajax_sentsms_sql2.php',
    method: 'post',
    data: $('form').serialize(),
    success: function(data){
      $('#allVals2').html(data);
    }
  });

  return msqlajax;
}


$(document).ready(function(){

  var periodDiv = $('select[name=periodDiv]').val();
  dateinput2(periodDiv);

  maketable();
  msql();


  $('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    currentText: '오늘',
    closeText: '닫기'
  })


  $(document).on('click', '.modalDescription', function(){
    // console.log($(this).text());

    var currow2 = $(this).closest('tr');

    var description = currow2.find('td:eq(6)').children('input:eq(0)').val();

    var customer = currow2.find('td:eq(3)').children('label').text();
    var recievenumber = currow2.find('td:eq(4)').text();
    var sentnumber = currow2.find('td:eq(4)').children('input').val();
    var byte = currow2.find('td:eq(2)').children('input').val();

    // console.log(description, customer, recievenumber, sentnumber);

    $('#modaltextarea').text(description);
    $('#mcustomer').val(customer);
    $('#recievenumber').val(recievenumber);
    $('#sentnumber').val(sentnumber);
    $('#mbyte').val(byte);

  })


})//---------document.ready end and 조회버튼클릭 펑션 시작--------------//

$('select[name=dateDiv]').on('change', function(){
    maketable();
    msql();
})

$('select[name=periodDiv]').on('change', function(){
    var periodDiv = $('select[name=periodDiv]').val();
    // console.log(periodDiv);
    dateinput2(periodDiv);
    maketable();
    msql();
})

$('input[name=fromDate]').on('change', function(){
    maketable();
    msql();
})

$('input[name=toDate]').on('change', function(){
    maketable();
    msql();
})

$('select[name=type]').on('change', function(){
    maketable();
    msql();
})

$('select[name=result]').on('change', function(){
    maketable();
    msql();
})

$('select[name=etcCondi]').on('change', function(){
    maketable();
    msql();
})

$('input[name=cText]').on('keyup', function(){
    maketable();
    msql();
})
//---------조회버튼클릭평션 end and contractArray 펑션 시작--------------//

</script>

</body>
</html>
