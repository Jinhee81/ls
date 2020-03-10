<?php
session_start();
print_r($_SESSION);
if(!isset($_SESSION['ais_login'])){
  header('Location: /admin/main/alogin.php');
}
require('view/aconn.php');
require('view/admin_header.php');
?>

<section class="container mt-3">
  <div class="text-center">
    <h1>관리물건리스트</h1>
    <table class="table mt-5 text-center"> <!--건물리스트 출력 테이블시작-->
      <tbody>
        <tr>
          <th>순번</th>
          <th>회원명(번호)</th>
          <th>관리번호</th>
          <th>유형</th>
          <th>물건명</th>
          <th>수납방법</th>
          <th>그룹/관리번호</th>
          <th>기타상품</th>
          <th>생성일자</th>
          <th>수정일자</th>
        </tr>
      </tbody>
    </table>

  </div>
</section>


<?php require('view/footer.php');?>
