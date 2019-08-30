<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>
<style>
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
    <h1 class="display-4">세입자리스트 화면입니다!</h1>
    <p class="lead">
      <!-- (1) 정확한 표현은 이해관계자리스트라고 보아도 무방합니다. 세입자(고객) 뿐만 아니라, 문의하는 사람 및 자주 거래하는 거래처도 저장할 수 있어요.<br> -->
    (1) 방계약이 발생하면 숫자가 표시됩니다.
    </p>
  </div>

  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <div class="row justify-content-md-center">
      <table>
        <tr>
          <td class="mobile"><select class="form-control form-control-sm selectCall">
            <option value="등록일자">등록일자</option>
            <option value="수정일자">수정일자</option>
          </select></td>
          <td class="mobile"><select class="form-control form-control-sm selectCall">
            <option value="등록일자">당월</option>
            <option value="수정일자">전월</option>
            <option value="등록일자">1개월</option>
            <option value="수정일자">3개월</option>
            <option value="등록일자">기타</option>
            <option value="수정일자">없음</option>
          </select></td>
          <td class="mobile"><input type="text" name="" value="" class="form-control form-control-sm text-center" id="datepicker"></td>
          <td class="mobile">~</td>
          <td class="mobile"><input type="text" name="" value="" class="form-control form-control-sm text-center" id="datepicker"></td>
          <td class="mobile"><select class="form-control form-control-sm selectCall">
            <option value="등록일자">구분</option>
            <option value="수정일자">문의</option>
            <option value="등록일자">진행고객</option>
            <option value="수정일자">거래처</option>
          </select>
          </td>
          <td><select class="form-control form-control-sm selectCall">
            <option value="등록일자">고객명</option>
            <option value="수정일자">연락처</option>
            <option value="등록일자">이메일</option>
            <option value="수정일자">특이사항</option>
          </select></td>
          <td><input type="text" name="" value="" class="form-control form-control-sm text-center"></td>
          <td><button type="button" name="button" class="btn btn-info btn-sm">조회</button></td>
        </tr>
      </table>
    </div>
  </div>

  <!-- <form method="post"> -->
    <div class="d-flex flex-row-reverse">
      <div class="float-right">
        <button type="button" class="btn btn-secondary" name="rowDeleteBtn">삭제</button>
        <a href="m_c_add.php"><button type="button" class="btn btn-primary" name="button">등록</button></a>
      </div>
    </div>
    <div class="mt-3">
      <?php $sqlC = "select count(*) from customer where user_id={$_SESSION['id']}";
      // echo $sqlC;
      $resultC = mysqli_query($conn, $sqlC);
      $rowC = mysqli_fetch_array($resultC);
      // echo $rowC[0];
      if((int)$rowC[0]===0){
        echo "고객등록한것이 없네요. 바로 위 오른쪽 등록버튼을 눌러서 등록해주세요.";
      } else {
        include $_SERVER['DOCUMENT_ROOT']."/service/customer/customer_table.php";
      }
      ?>
    </div>
  <!-- </form> -->

</section>
<!-- <div class="" id="allVals">
isright 6666?
</div> -->

<script>
$(document).ready(function(){
      $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      })
})

var table = $("#checkboxTestTbl");

var customerArray = [];

$(":checkbox:first", table).click(function(){

    var allCnt = $(":checkbox:not(:first)", table).length;
    customerArray = [];

    if($(":checkbox:first", table).is(":checked")){
      for (var i = 1; i <= allCnt; i++) {
        var customerArrayEle = [];
        var colOrder = table.find("tr:eq("+i+")").find("td:eq(1)").text();
        var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();
        var colStep = table.find("tr:eq("+i+")").find("td:eq(3)").children('span').text();
        customerArrayEle.push(colOrder, colid, colStep);
        customerArray.push(customerArrayEle);
      }
    } else {
      customerArray = [];
    }
    // console.log(customerArray);
})

$(":checkbox:not(:first)",table).click(function(){
  var customerArrayEle = [];

  if($(this).is(":checked")){
    var currow = $(this).closest('tr');
    var colOrder = Number(currow.find('td:eq(1)').text());
    var colid = currow.find('td:eq(0)').children('input').val();
    var colStep = currow.find('td:eq(3)').children('span').text();
    customerArrayEle.push(colOrder, colid, colStep);
    customerArray.push(customerArrayEle);
  } else {
    var currow = $(this).closest('tr');
    var colOrder = Number(currow.find('td:eq(1)').text());
    var colid = currow.find('td:eq(0)').children('input').val();
    var colStep = currow.find('td:eq(3)').children('span').text();
    var dropReady = customerArrayEle.push(colOrder, colid, colStep);
    var index = customerArray.indexOf(dropReady);
    customerArray.splice(index, 1);
  }
  // console.log(customerArray);
})

$('button[name="rowDeleteBtn"]').on('click', function(){
  console.log(customerArray);
  for (var i = 0; i < customerArray.length; i++) {
    if(Number(customerArray[i][2])>0){
      alert('계약등록된 고객이 포함될 경우 삭제 불가능합니다.');
      return false;
    }
  }

  var aa = 'customerDelete';
  var bb = 'p_m_c_delete_for.php';

  goCategoryPage(aa, bb, customerArray);

  function goCategoryPage(a, b, c){
    var frm = formCreate(a, 'post', b,'customerArray');
    frm = formInput(frm, 'customerArray', c);
    formSubmit(frm);
  }

})
</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
