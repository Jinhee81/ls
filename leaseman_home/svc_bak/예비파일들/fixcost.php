<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>고정비조회</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/service/contract/building.php";
?>
<style>
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
        select .selectCall{background-color: #A9D0F5;}

        @media (max-width: 990px) {
        .mobile {
          display: none;
        }

        .wrap{
          width:1000px;
          overflow-x: scroll;
          white-space: nowrap;
        }
}
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">지출등록 화면입니다!</h1>
    <p class="lead">
      <!-- (1) 상태(진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다.<br>
      (2) 월이용료를 클릭하면 해당 계약의 상세페이지가 나옵니다.<br>
      (3) 단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다. -->
    </p>
  </div>
</section>
<section class="container">
  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <!-- <div class="row justify-content-md-center"> -->
      <form>
        <div class="form-group row justify-content-md-center">



          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="select1" name="select1">
            </select><!--관리물건조2019-->
          </div>

          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="etcCondi" name="etcCondi">
              <option value="customer">2019년</option>

            </select><!--codi8-->


          </div>
          <div class="col-sm-1 pl-0 pr-0">
            <select class="form-control form-control-sm selectCall" id="etcCondi" name="etcCondi">
              <option value="customer">상반기</option>
              <option value="customer">하반기</option>

            </select><!--codi8-->
          </div>

        </div>
      </form>

    <!-- </div> -->

</div>
</section>

<section class="container">
    <div class="d-flex-reverse flex-row">
        <div class="float-right">
          <button type="button" class="btn btn-secondary" name="btnAdd">고정비추가</button>

        </div>
    </div>

    <div class="wrap" id="allVals">
    <table class="table">
      <thead>
        <tr>
          <td>순번</td>
          <td>내역</td>
          <td>1월</td>
          <td>2월</td>
          <td>3월</td>
          <td>4월</td>
          <td>5월</td>
          <td>6월</td>
          <td>7월</td>
          <td>8월</td>
          <td>9월</td>
          <td>10월</td>
          <td>11월</td>
          <td>12월</td>
          <td>합계</td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td><input type="text" class="form-control form-control-sm"></td><!--내역-->
          <td><input type="text" class="form-control form-control-sm"></td><!--1월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--2월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--3월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--4월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--5월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--6월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--7월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--8월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--9월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--10월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--11월-->
          <td><input type="text" class="form-control form-control-sm"></td><!--12월-->
          <td>
            <button type="submit" name="edit" class="btn btn-default grey">
              <i class='far fa-edit'></i>
            </button>
            <button type="submit" name="delete" class="btn btn-default grey">
              <i class='far fa-trash-alt'></i>
            </button>
          </td>
        </tr>
        <tr>
          <td colspan="15">
            <button type="button" class="btn btn-primary" id="addstring">추가하기</button>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
</section>

<script src="/js/etc/date.js"></script>

<script>

var select1option, select2option, buildingIdx, groupIdx;

for(var key in buildingArray){ //건물목록출력(비즈피스장암,비즈피스구로)
  select1option = "<option value='"+key+"'>"+buildingArray[key][0]+"</option>";
  $('#select1').append(select1option);
}
buildingIdx = $('#select1').val();



</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
