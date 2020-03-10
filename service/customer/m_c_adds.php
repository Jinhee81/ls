<!-- 처음에 만들때는 구분2가 있었는데 그거 자체를 삭제하고 다시 만듬 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>

<script src="csaddss.js?<?=date('YmdHis')?>"></script>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">일괄등록 화면입니다!</h1>
    <p class="lead">이 화면에서는 한꺼번에 많은 세입자를 등록하기에 좋아요~</p>
    <small>(1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다. (2)개수는 입력하고자하는 명수를 입력하세요. 1~10 사이 숫자 입력 가능합니다. (3)'생성하기'버튼을 누르면 입력할 수 있는 칸이 생성됩니다. (4)'초기화'버튼을 누르면 생성된 칸이 모두 사라지므로 주의하세요!</small>
    <hr class="my-4">
    <a class="btn btn-primary btn-sm mobile" href="m_c_add_csv.php" role="button">csv등록</a>
  </div>
</section>
<section class="container" style="max-width:1200px;">
  <form method="post" action ="p_m_c_adds.php">
    <div class="row justify-content-md-center">
      <div class="col col-md-9">
        <table class="table table-borderless text-center">
          <tr>
            <td><label>구분(대)</label></td>
            <td>
              <select id="div1" name="div1" class="form-control" onchange="div1Get();">
                <option value="문의">문의</option>
                <option value="진행고객" selected>세입자</option>
                <option value="거래처">거래처</option>
                <option value="기타">기타</option>
              </select>
            </td>
            <td><label>개수</label></td>
            <td>
              <input type="number" id="ccount" name="count" class="form-control" min="1" max="10" onmouseout="getCount(this.value);">
            </td>
            <td><button type="button" name="button" class="btn btn-info btn-block" onclick="printOut();">생성하기</button></td>
            <td><button type="button" name="button" class="btn btn-outline-info btn-block" onclick="defaultCenterSection();">초기화</button></td>
          </tr>
        </table>
      </div>
    </div>

    <table id="centerSection" class='table table-bordered text-center'>
    </table>
    <div class="bolowButtons">

    </div>
  </form>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
