<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>

<div class="jumbotron">
  <h1 class="display-4">임대관리의 필요사항을 설정하세요!</h1>
  <p class="lead">예) '도레미고시원' 또는 '두드림센터' 등 평상시 관리하는 명칭을 적어주세요.</p>
  <hr class="my-4">
  <p></p>
  <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal">관리물건 등록</button>
</div>

<?php include $_SERVER['DOCUMENT_ROOT']."/service/setting/modal_building_add.php";?> <!--관리물건등록 모달-->

<section>
  <div class="container">
    <?php
    $sql = "select count(*) from building where user_id={$_SESSION['id']}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $b_count = (int)$row['count(*)'];
    // 건물($b_count)이 한개라도 있으면 건물테이블 보여지는거
    if($b_count < 1) {
      echo "";
    } else {
      include $_SERVER['DOCUMENT_ROOT']."/service/setting/table_building.php";
    }?>

  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
