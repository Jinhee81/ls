<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>입주자리스트</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta0.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
?>
<link rel="stylesheet" href="/svc/inc/css/custom2.css">
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">입주자리스트입니다.</h2>
    <p class="lead">
      <!-- (1) 정확한 표현은 이해관계자리스트라고 보아도 무방합니다. 세입자(고객) 뿐만 아니라, 문의하는 사람 및 자주 거래하는 거래처도 저장할 수 있어요.<br> -->
    (1) 방계약이 발생하면 숫자가 표시됩니다. (2)'기타' 분류는 방계약 외의 일회성매출에 대한 고객을 분류할 수 있습니다.
    </p>
  </div>


  <div class="d-flex flex-row-reverse">
    <div class="float-right">
      <button type="button" class="btn btn-secondary" name="rowDeleteBtn">삭제</button>
      <a href="m_c_add.php"><button type="button" class="btn btn-primary" name="button">등록</button></a>
    </div>
  </div>


  <div class="mt-3">
   <table class="table table-sm table-hover table-bordered mydatatable" style="width:100%">
     <thead>
       <tr>
         <th><input type="checkbox"></th>
         <th>구분</th>
         <th>성명</th>
         <th>연락처</th>
         <th>이메일</th>
         <th>특이사항</th>
         <th>바로가기</th>
       </tr>
     </thead>
   </table>
  </div>
  <div id="allVals">

  </div>

</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer0.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer0_script0.php"; ?>

<script>

$(document).ready(function(){
    $('.mydatatable').DataTable({
      pagingType: "full_numbers",
      ordering: false,
      lengthMenu:[30,50,100,'all'],
      ajax: {
        "url" : "ajax_customerLoad0.php",
        "dataSrc" : ""
      },
      columns: [
        {"data" : "id",
          "render" : function(data, type, row){
            data = '<input type="checkbox" value="'+data+'">';
            return data;
          }
        },
        {"data" : "div1"},
        {"data" : "cName",
          "render" : function(data, type, row){
            data = '<a href="m_c_edit.php?id='+row.id+'" data-toggle="tooltip" data-placement="top" title="'+data+'">'+row.cNamemb+'</a>';
            return data;
          }
        },
        {"data" : "cContact"},
        {"data" : "email"},
        {"data" : "etc"},
        {"data" : "gothere",
          "render" : function(data, type, row){
            if(data=='임대계약'){
              data = "<a class='btn btn-info btn-sm' href='/svc/service/contract/contract_add1.php?id="+row.id+"' role='button'>임대계약</a>";
            } else if(data=='기타계약'){
              data = "<a class='btn btn-info btn-sm' href='/svc/service/contractetc/contractetc_add1.php?id="+row.id+"' role='button'>기타계약</a>";
            } else {
              data = "";
            }
            return data;
          }
        }
      ],
      language: {
        "emptyTable": "데이터가 없어요.",
        "lengthMenu": "페이지당 _MENU_ 개씩 보기",
        "info": "현재 _START_ - _END_ / _TOTAL_건",
        "infoEmpty": "데이터 없음",
        "infoFiltered": "( _MAX_건의 데이터에서 필터링됨 )",
        "search": "검색: ",
        "zeroRecords": "일치하는 데이터가 없어요.",
        "loadingRecords": "로딩중...",
        "processing":     "잠시만 기다려 주세요...",
        "paginate": {
            "next": "다음",
            "previous": "이전"
        }
    }
  })//datatable closing }

  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })


})//document.ready closing}

// $(document).ready(function(){
//   $.ajax({
//     url: 'ajax_customerLoad0.php',
//     method: 'post',
//     data: $('form').serialize(),
//     success: function(data){
//       $('#allVals').html(data);
//     }
//   })
// })


</script>
</body>
</html>
