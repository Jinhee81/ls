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
    <h1 class="display-4">임대계약리스트 화면입니다!</h1>
    <p class="lead"></p>
  </div>

  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <div class="row justify-content-md-center">
      <table>
        <tr>
          <td class="mobile"><select class="form-control form-control-sm selectCall">
            <option value="">시작일자</option>
            <option value="">종료일자</option>
            <option value="">계약일자</option>
            <option value="">등록일자</option>
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
            <option value="">진행</option>
            <option value="">종료</option>
            <option value="">대기</option>
          </select>
          </td>
          <td class="mobile"><select class="form-control form-control-sm selectCall">
            <option value="등록일자">물건명</option>
          </select></td>
          <td class="mobile"><select class="form-control form-control-sm selectCall">
            <option value="등록일자">그룸명</option>
          </select></td>
          <td><select class="form-control form-control-sm selectCall">
            <option value="">고객명</option>
            <option value="">연락처</option>
            <option value="">계약번호</option>
            <option value="">관리번호</option>
          </select>
          </td>
          <td><input type="text" name="" value="" class="form-control form-control-sm text-center"></td>
          <td><button type="button" name="button" class="btn btn-info btn-sm">조회</button></td>
        </tr>
      </table>
    </div>
  </div>
  <?php
  if (isset($_REQUEST['submit'])) {
    $chk = $_REQUEST['chk'];
    $a = implode(',', $chk);
    if($a) {
      $sql_d = "DELETE from customer where id in ($a)";
      $result_d = mysqli_query($conn, $sql_d);
      if($result_d) {
        echo "<script>alert('삭제하였습니다');</script>";
      } else {
        echo "<script>alert('삭제 과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
        </script>";
        error_log(mysqli_error($conn));
      }
    } else {
      echo "<script>alert('한개이상을 선택해야 합니다.');</script>";
    }
  }
   ?>
  <form method="post">
    <div class="d-flex flex-row-reverse">
      <div class="float-right">
        <button type="submit" class="btn btn-secondary" name="submit" onsubmit="if(!confirm('정말 삭제하겠습니까?')){return false;}">삭제</button>
        <a href="contract_add2.php"><button type="button" class="btn btn-primary" name="button">등록</button></a>
      </div>
    </div>
    <div class="mt-3">
      <?php $sqlC = "select count(*) from realContract where user_id={$_SESSION['id']}";
      // echo $sqlC;
      $resultC = mysqli_query($conn, $sqlC);
      $rowC = mysqli_fetch_array($resultC);
      // echo $rowC[0];
      if((int)$rowC[0]===0){
        echo "계약 등록한것이 없네요. 바로 위 오른쪽 등록버튼을 눌러서 등록해주세요.";
      } else {
        include $_SERVER['DOCUMENT_ROOT']."/service/contract/contract_table.php";
      }
      ?>
    </div>
  </form>
<!-- <?php echo $sql; echo '3333', $a?> -->

</section>
<div class="" id="allVals">
<!-- isright 6666? -->
</div>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
