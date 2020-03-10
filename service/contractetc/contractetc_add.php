<!-- 계약리스트화면에서 등록버튼누르면 나오는 거 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contractetc/good.php";

?>
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
    <h1 class="display-4">기타계약 등록 화면입니다!</h1>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p> -->
    <!-- <small>(1)<span id='star' style='color:#F7BE81;'> * </span>표시는 필수 입력값입니다. (2)<b>[세입자정보]</b>에는 세입자만 등록 가능합니다. (거래처 및 문의고객은 검색결과가 없다고 표시되니 주의하세요!) <b>[세입자정보]</b>의 제일우측 숫자는 고객번호로써 시스템데이터임을 참고하여주세요. (3)<b>[기간정보]</b>의 기간(개월수)에는 최대 72개월(6년)까지 등록 가능합니다.</small> -->
    <hr class="my-4">
    <a class="btn btn-primary btn-sm" href="/service/customer/m_c_add.php" role="button">성명등록</a>
    <a class="btn btn-primary btn-sm" href="/service/setting/building.php" role="button">상품추가</a>
  </div>
</section>
<section class="container">
  <form method="post" action="p_etcContract_add.php">
    <div class="form-row">
        <div class="form-group col-md-2">
              <label><b>[성명]</b></label>
        </div>
        <div class="form-group col-md-10 inputWithIcon">
              <input type="search" class="form-control" name="customer" id="customer" value="" required>
              <i class="fas fa-search fa-lg fa-fw" aria-hidden="true"></i>
              <div class="" id="customerList">
              </div>
              <!-- <input type="hidden" name="customerId" id="customerId" value=""> 원래는 ajax로 별도로 고객번호를 가져오고싶었는데 방법을 몰라서 못한거고 별도로 가져올때 다시 수정할거2-->
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label><b>[물건,금액]</b></label>
        </div>
        <div class="form-group col-md-10" id="mulgunInfo">
              <div class="form-row">
                <div class="form-group col-md-2"><!--물건목록-->
                    <label>물건명</label>
                    <select id="select2" name="building_id" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-2"><!--그룹목록-->
                    <label>상품명</label>
                    <select id="select3" name="good_in_building_id" class="form-control">
                    </select>
                </div>
                <div class="form-group col-md-2 mb-0">
                      <label><span id='star' style='color:#F7BE81;'>* </span>공급가액</label>
                      <input type="text" class="form-control text-right amountNumber" name="pAmount" value="0" numberOnly required>
                </div>
                <div class="form-group col-md-2 mb-0">
                      <label>세액</label>
                      <input type="text" class="form-control text-right amountNumber" name="pvAmount" value="0" numberOnly required>
                </div>
                <div class="form-group col-md-2 mb-0">
                      <label>합계</label>
                      <input type="text" class="form-control text-right amountNumber" name="ptAmount" value="0" numberOnly readonly>
                </div>
              </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2 mb-0">
            <label><b>[날짜]</b></label>
        </div>
        <div class="form-group col-md-10 mb-0">
          <div class="form-row">
              <div class="form-group col-md-2 mb-10">
                    <label><span id='star' style='color:#F7BE81;'>* </span>입금일자</label>
                    <input type="text" class="form-control dateType" name="executiveDate" value="" placeholder="" required>
              </div>
              <div class="form-group col-md-2 mb-10">
                    <label>입금구분</label>
                    <select class="form-control" name="payKind">
                      <option value="계좌">계좌</option>
                      <option value="현금">현금</option>
                      <option value="카드">카드</option>
                    </select>
              </div>
              <div class="form-group col-md-4 mb-0">
                    <label>시작일시</label>
                    <input type="text" class="form-control timeType" name="startTime" value="" placeholder="">
              </div>
              <div class="form-group col-md-4 mb-0">
                    <label>종료일시</label>
                    <input type="text" class="form-control timeType" name="endTime">
              </div>
        </div>
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2 mb-0">
            <label><b>[특이사항]</b></label>
        </div>
        <div class="form-group col-md-10 mb-0">
          <input type="text" id="" class="form-control" name="etc">
      </div>
    </div>


    <div class="mt-3">
      <button type='submit' class='btn btn-primary' id='saveBtn'>저장</button>
      <a href='contractetc.php'><button type='button' class='btn btn-secondary'>취소</button></a>
    </div>
  </form>
</section>

<script src="/js/jquery-ui.min.js"></script>
<script src="/js/datepicker-ko.js"></script>
<script src="/js/jquery-ui-timepicker-addon.js"></script>
<script>
$(document).ready(function(){
  $('#customer').keyup(function(){
    var query = $(this).val();
    // console.log(query);
    if(query != ''){
      $.ajax({
        url: 'p_customer_search2.php',
        method: 'post',
        data: {query : query},
        success: function(data){
          $('#customerList').fadeIn();
          $('#customerList').html(data);
        }
      })
    }
  })

  $('.timeType').datetimepicker({
    dateFormat:'yy-mm-dd',
    monthNamesShort:[ '1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월' ],
    dayNamesMin:[ '일', '월', '화', '수', '목', '금', '토' ],
    changeMonth:true,
    changeYear:true,
    showMonthAfterYear:true,

    timeFormat: 'HH:mm:ss',
    controlType: 'select',
    oneLine: true
  })

  $('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    // showOn: "button",
    buttonImage: "/img/calendar.svg",
    buttonImageOnly: false
  })

  $(".amountNumber").click(function(){
    $(this).select();
  });

  $("input:text[numberOnly]").number(true);
})

$(document).on('click', 'li', function(){
  $('#customer').val($(this).text());
  $('#customerList').fadeOut();
})


var select2option, select3option, buildingIdx, goodIdx;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  select2option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('#select2').append(select2option);
}
buildingIdx = $('#select2').val();


for(var key2 in goodBuildingArray[buildingIdx]){ //상품목록출력(빔,회의실)
  select3option = "<option value='"+key2+"'>"+goodBuildingArray[buildingIdx][key2]+"</option>";
  // console.log(select3option);
  $('#select3').append(select3option);
}
goodIdx = $('#select3').val();


$('#select2').on('change', function(event){
  buildingIdx = $('#select2').val();
  $('#select3').empty();
  for(var key2 in goodBuildingArray[buildingIdx]){ //상품목록출력(빔,회의실)
    select3option = "<option value='"+key2+"'>"+goodBuildingArray[buildingIdx][key2]+"</option>";
    // console.log(select3option);
    $('#select3').append(select3option);
  }
  goodIdx = $('#select3').val();
})

// console.log(buildingIdx, goodIdx);


$("input[name='pAmount']").on('keyup', function(){
  var amount1 = Number($(this).val());
  var amount2 = Number($("input[name='pvAmount']").val());
  var amount12 = amount1 + amount2;
  $("input[name='ptAmount']").val(amount12);
})

$("input[name='pvAmount']").on('keyup', function(){
  var amount1 = Number($("input[name='pAmount']").val());
  var amount2 = Number($(this).val());
  var amount12 = amount1 + amount2;
  $("input[name='ptAmount']").val(amount12);
})

$('#saveBtn').on('click', function(){
  var amount1 = Number($("input[name='pAmount']").val());
  if(amount1 === 0){
    alert('공급가액은 0보다 커야 저장됩니다.');
    return false;
  }
})

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
