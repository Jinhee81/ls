<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contract/building.php";
?>

<!-- <script src="csaddss.js?v=<%=System.currentTimeMillis() %>"></script> -->

<style>
  .inputWithIcon input[type=search]{
    padding-left: 40px;
  }
  .inputWithIcon {
    position: relative;
  }
  .inputWithIcon i{
    position: absolute;
    left: 4px;
    top: 4px;
    padding: 9px 8px;
    color: #aaa;
    transition: .3s;
  }
  .inputWithIcon input[type=search]:focus+i{
    color: dodgerBlue;
  }
  #customerList ul {
    background-color: #eee;
    cursor: pointer;
  }
  #customerList li {
    padding: 12px;
  }
</style>

<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">계약등록 csv화면입니다</h1>
    <!-- <p class="lead">이 화면에서는 각 방의 세입자를 등록합니다.</p> -->
    <small>
      <!-- (1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다.  -->
      (1)공실일 경우는 행삭제를 하여 없애주세요.</small>
    <hr class="my-4">
  </div>
</section>
<section class="container-fluid">
      <div class="container form-row justify-content-center">
          <div class="form-group col-md-2 text-center">
              <label for="">물건명</label>
          </div>
          <div class="form-group col-md-2">
              <select class="form-control form-control-sm" id="select1">
              </select>
          </div>
      </div>

      <div class="" id="allVals" >

      </div>
    <div class="d-flex justify-content-center">
      <button type='button' class='btn btn-primary mr-1' id='saveBtn'>저장</button>
      <a href='contract.php'><button type='button' class='btn btn-secondary'>계약리스트화면으로</button></a>
    </div>
</section>

<script>

var select1option, buildingIdx ;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
    select1option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
    $('#select1').append(select1option);
}
buildingIdx = $('#select1').val();
// console.log(buildingIdx);

$(document).ready(function(){

    $.ajax({
      url: 'ajax_realContractCsvLoad.php',
      method: 'post',
      data: { buildingIdx : buildingIdx },
      success: function(data){
        $('#allVals').html(data);
      }
    })
})



</script>
<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
