<!-- customer 최초의 파일. 곧 지울 예정임 -->
<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>
<script>
  $(document).ready(function(){
      var tbl = $("#checkboxTestTbl");

      // 테이블 헤더에 있는 checkbox 클릭시
      $(":checkbox:first", tbl).click(function(){
          // 클릭한 체크박스가 체크상태인지 체크해제상태인지 판단
          if( $(this).is(":checked") ){
              $(":checkbox", tbl).attr("checked", "checked");
          } else{
              $(":checkbox", tbl).removeAttr("checked");
          }

          // 모든 체크박스에 change 이벤트 발생시키기
          $(":checkbox", tbl).trigger("change");
      });

      // 헤더에 있는 체크박스외 다른 체크박스 클릭시
      $(":checkbox:not(:first)", tbl).click(function(){
          var allCnt = $(":checkbox:not(:first)", tbl).length;
          var checkedCnt = $(":checkbox:not(:first)", tbl).filter(":checked").length;

          // 전체 체크박스 갯수와 현재 체크된 체크박스 갯수를 비교해서 헤더에 있는 체크박스 체크할지 말지 판단
          if( allCnt==checkedCnt ){
              $(":checkbox:first", tbl).attr("checked", "checked");
          } else{
              $(":checkbox:first", tbl).removeAttr("checked");
          }
      }).change(function(){
          if( $(this).is(":checked") ){
              // 체크박스의 부모 > 부모 니까 tr 이 되고 tr 에 selected 라는 class 를 추가한다.
              $(this).parent().parent().addClass("selected");
          } else{
              $(this).parent().parent().removeClass("selected");
          }
      });
  });
</script>
<style>
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
</style>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">고객리스트 화면입니다!</h1>
    <p class="lead">고객이란 입주한 세입자 및 문의하는 예비고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p>
  </div>

  <div class="p-3 mb-2 bg-light text-dark border border-info rounded">
    <div class="row">
    <div class="col-sm">
      <div class="d-flex flex-row">
        <label>등록일자</label>
      </div>
      <div class="d-flex flex-row">
        <div class="float-left">
          <button type="button" class="btn btn-sm btn-info" name="button">전월</button>
          <button type="button" class="btn btn-sm btn-info" name="button">당월</button>
          <button type="button" class="btn btn-sm btn-info" name="button">익월</button>
        </div>
      </div>

    </div>
    <div class="col-sm">
      One of three columns
    </div>
    <div class="col-sm">
      One of three columns
    </div>
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

  $sql = "select
    @num := @num + 1 as num,
    id, div1, div2, name, div3, companyname, cNumber1, cNumber2, cNumber3, contact1, contact2, contact3, email, etc
   from (select @num :=0)a, customer
   where user_id={$_SESSION['id']}
   order by num desc";
  $result = mysqli_query($conn, $sql);
   ?>
  <form method="post">
  <div class="d-flex flex-row-reverse">
    <div class="float-right">
      <button type="submit" class="btn btn-secondary" name="submit">삭제</button>
      <a href="m_c_add.php"><button type="button" class="btn btn-primary" name="button">등록</button></a>
    </div>
  </div>
  <div class="mt-3">

    <table class="table table-hover text-center" id="checkboxTestTbl">
      <thead>
        <tr class="table-info">
          <th scope="col"><input type="checkbox"></th>
          <th scope="col">순번</th>
          <th scope="col">구분</th>
          <th scope="col">고객명</th>
          <th scope="col">연락처</th>
          <th scope="col">이메일</th>
          <th scope="col">특이사항</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
<?php
// echo $sql;
  while($row = mysqli_fetch_array($result)){
    $clist['id'] = htmlspecialchars($row['id']);
    $clist['num'] = htmlspecialchars($row['num']);
    $clist['div1'] = htmlspecialchars($row['div1']);
    $clist['div2'] = htmlspecialchars($row['div2']);
    $clist['contact'] = htmlspecialchars($row['contact']);
    $clist['email'] = htmlspecialchars($row['email']);
    $clist['etc'] = htmlspecialchars($row['etc']);
    $clist['name'] = htmlspecialchars($row['name']);
    $clist['companyname'] = htmlspecialchars($row['companyname']);
    $clist['companynumber'] = htmlspecialchars($row['companynumber']);

    if($clist['div2']==='개인사업자'){
      $cName = $clist['name'].'('.$clist['companyname'].','.$clist['companynumber'].')';
    } else if($clist['div2']==='법인사업자'){
      $cName = $clist['div3'].' '.$clist['companyname'].'('.$clist['name'].','.$clist['companynumber'].')';
    } else if($clist['div2']==='개인'){
      $cName = $clist['name'];
    }

    if($clist['div1']==='문의고객'){
      $cName = 'ㅇㅇㅇ';
    }

    ?>
        <tr>
          <td><input type="checkbox" name="chk[]" value="<?=$clist['id']?>"></td>
          <td><?=$clist['num']?></td>
          <td><?=$clist['div1']?></td>
          <td class='text-left pl-10'><a href="m_c_edit.php?id=<?=$clist['id']?>">
            <?=$cName?></a></td>
          <td><?=$clist['contact']?></td>
          <td><?=$clist['email']?></td>
          <td><?=$clist['etc']?></td>
          <td></td>
        </tr>
  <?php } ?>
        </tbody>
      </table>
    </div>
  </form>
<!-- <?php echo $sql; echo '3333', $a?> -->

</section>
<div class="" id="allVals">
<!-- isright 6666? -->
</div>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
