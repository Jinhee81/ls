<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>연도별회계조회</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/main/condition.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/contract/building.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/account/flexCost/yearMonth.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/account/yearAccount/monthlyValue.php";
?>

<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">연도별 회계조회 화면입니다!</h2>
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
</section>

<!--히든 섹션 시작-->
<section class="container">
  <div id="plus_part">

  </div>
  <div id="minus_part">

  </div>
</section>

<!--차트 섹션 시작-->
<section class="container">
  <div class="">
    <canvas id="barChart"></canvas>
  </div>
</section><!--차트 섹션 끝-->

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php"; ?>

<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js"></script>
<script src="/svc/inc/js/mdb.min.js"></script><!--차트만들때 필요함-->

<script type="text/javascript">
  var buildingArray = <?php echo json_encode($buildingArray); ?>;
  var groupBuildingArray = <?php echo json_encode($groupBuildingArray); ?>;
  var roomArray = <?php echo json_encode($roomArray); ?>;
  // console.log(buildingArray);
  // console.log(groupBuildingArray);
  // console.log(roomArray);
</script>

<script src="/svc/inc/js/etc/building.js?<?=date('YmdHis')?>"></script>

<script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>

<script>

var buildingIdx = $('select[name=building]').val();
var year = $('select[name=year]').val();

// function maketable(){
//   var monthlyData = $.ajax({
//     url: 'ajax_monthlyValue.php',
//     method: 'post',
//     data: {buildingIdx:buildingIdx, year:year},
//     success: function(data){
//       data = JSON.parse(data);
//       $('#plus_part').html(data[0]);
//       $('#minus_part').html(data[1]);
//       console.log(data);
//     }
//   })
//
//   return monthlyData;
// }

// function barChartFn(){//bar function start
//   var ctxB = document.getElementById("barChart").getContext('2d');
//   var myBarChart = new Chart(ctxB, {
//     type: 'bar',
//     data: {
//         labels: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
//         datasets: [
//           {
//             label: '매출',
//             data: [plusAmountArray[0], plusAmountArray[1], plusAmountArray[2], plusAmountArray[3], plusAmountArray[4], plusAmountArray[5], plusAmountArray[6], plusAmountArray[7], plusAmountArray[8], plusAmountArray[9], plusAmountArray[10], plusAmountArray[11]],
//             backgroundColor: 'rgba(54, 162, 235, 0.2)',
//             borderColor: 'rgba(54, 162, 235, 1)',
//             borderWidth: 1
//           }, {
//               label: '매입',
//               data: [data[1][0], data[1][1], data[1][2], data[1][3], data[1][4], data[1][5], data[1][6], data[1][7], data[1][8], data[1][9], data[1][10], data[1][11]],
//               backgroundColor: 'rgba(255, 99, 132, 0.2)',
//               borderColor: 'rgba(255,99,132,1)',
//               borderWidth: 1
//
//           }],
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero:true
//                 }
//             }]
//         }
//     }
//   });
//
//   return myBarChart;
// }//bar function end

function maketable(){
  var monthlyData = $.ajax({
    url: 'ajax_monthlyValue.php',
    method: 'post',
    data: {buildingIdx:buildingIdx, year:year},
    success: function(data){
      data = JSON.parse(data);
      $('#plus_part').html(data[0]);
      $('#minus_part').html(data[1]);

      console.log(data);

      function barChartFn(){//bar function start
        var ctxB = document.getElementById("barChart").getContext('2d');
        var myBarChart = new Chart(ctxB, {
          type: 'bar',
          data: {
              labels: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
              datasets: [
                {
                  label: '매출',
                  data: [data[0][0], data[0][1], data[0][2], data[0][3], data[0][4], data[0][5], data[0][6], data[0][7], data[0][8], data[0][9], data[0][10], data[0][11]],
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
                }, {
                    label: '매입',
                    data: [data[1][0], data[1][1], data[1][2], data[1][3], data[1][4], data[1][5], data[1][6], data[1][7], data[1][8], data[1][9], data[1][10], data[1][11]],
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

        return myBarChart;
      }//bar function end
    }
  })

  return monthlyData;
}




$(document).ready(function(){
  maketable();

})



$('select[name=building]').on('change', function(){
  var buildingIdx = $('select[name=building]').val();

  maketable();


})

$('select[name=year]').on('change', function(){
  var year = $('select[name=year]').val();

  maketable();


})




</script>


</body>
</html>
