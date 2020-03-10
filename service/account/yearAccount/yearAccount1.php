<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>연도별회계조회</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contract/building.php";
include $_SERVER['DOCUMENT_ROOT']."/service/account/flexCost/yearMonth.php";
// include $_SERVER['DOCUMENT_ROOT']."/service/account/yearAccount/monthlyValue.php";
?>
<style>
        #modalTable tr.selected{background-color: #A9D0F5;}
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
        select .selectCall{background-color: #A9D0F5;}

        @media (max-width: 990px) {
        .mobile {
          display: none;
        }
}
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">연도별 회계조회 화면입니다!</h1>
    <p class="lead">
      <!-- (1) 상태(진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다.<br>
      (2) 월이용료를 클릭하면 해당 계약의 상세페이지가 나옵니다.<br>
      (3) 단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다. -->
    </p>
  </div>
</section>


<section class="container"><!--조회조건 섹<-->
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
      <form name="building">
        <div class="form-group row justify-content-md-center">
            <div class="col-sm-2 pl-0 pr-1">
              <select class="form-control form-control-sm selectCall" name="building">
              </select><!---->
            </div>
            <div class="col-sm-2 pl-0 pr-1">
              <select class="form-control form-control-sm selectCall" name="year">
                <option value="<?=$yearArray[0]?>">
                  <?=$yearArray[0].'년'?>
                </option>
                <option value="<?=$yearArray[1]?>">
                  <?=$yearArray[1].'년'?>
                </option>
                <option value="<?=$yearArray[2]?>" selected>
                  <?=$yearArray[2].'년'?>
                </option>
                <option value="<?=$yearArray[3]?>">
                  <?=$yearArray[3].'년'?>
                </option>
              </select><!---->
            </div>
        </div>
      </form>
  </div>
</section><!--조회조건 섹션 end-->

<section class="container"><!--히든 섹션 시작-->
  <div id="monthlyValue">

  </div>
</section><!--차트 섹션 끝-->

<section class="container"><!--차트 섹션 시작-->
  <div class="">
    <canvas id="barChart"></canvas>
  </div>
</section><!--차트 섹션 끝-->


<script src="/js/mdb.min.js"></script><!--차트만들때 필요함-->
<script>
var select1option;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  select1option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('select[name=building]').append(select1option);//문서위건물목록
}
//---- ^ 건물출력 ^------//


//---- ^ buildingIdx 전역변수 선언 ^------//



Array.prototype.barChartFn = function(){//bar function start
  var ctxB = document.getElementById("barChart").getContext('2d');
  var myBarChart = new Chart(ctxB, {
    type: 'bar',
    data: {
        labels: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        datasets: [
          {
            label: '매출',
            data: [plusAmountArray[0], plusAmountArray[1], plusAmountArray[2], plusAmountArray[3], plusAmountArray[4], plusAmountArray[5], plusAmountArray[6], plusAmountArray[7], plusAmountArray[8], plusAmountArray[9], plusAmountArray[10], plusAmountArray[11]],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }, {
              label: '매입',
              data: [minusAmountArray[0], minusAmountArray[1], minusAmountArray[2], minusAmountArray[3], minusAmountArray[4], minusAmountArray[5], minusAmountArray[6], minusAmountArray[7], minusAmountArray[8], minusAmountArray[9], minusAmountArray[10], minusAmountArray[11]],
              backgroundColor: 'rgba(255, 99, 132, 0.2)',
              borderColor: 'rgba(255,99,132,1)',
              borderWidth: 1

          }],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
  });
}//bar function end



$(document).ready(function(){
  var buildingIdx = $('select[name=building]').val();
  var year = $('select[name=year]').val();

  $.ajax({
    url: 'ajax_monthlyValue.php',
    method: 'post',
    data: {buildingIdx:buildingIdx, year:year},
    success: function(data){
      $('#monthlyValue').html(data);
    }
  })

  // console.log('change buildingIdx');

  plusAmountArray.barChartFn();
  minusAmountArray.barChartFn();

})




// $('select[name=year]').on('change', function(){
//   var buildingIdx = $('select[name=building]').val();
//   var year = $('select[name=year]').val();
//
//
//
//
//   $.ajax({
//     url: 'ajax_monthlyValue1.php',
//     method: 'get',
//     data: {buildingIdx:buildingIdx, year:year},
//     success: function(data){
//       $('#monthlyValue').html(data);
//     }
//   })
//
//   var plusAmountArray1 = $('input[name=plusAmountArray1]').val();
//   var minusAmountArray1 = $('input[name=minusAmountArray1]').val();
//   console.log(plusAmountArray1);
//
//
//   console.log('change year9');
//   plusAmountArray1.barChartFn();
//   minusAmountArray1.barChartFn();
//
// })




</script>


<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
