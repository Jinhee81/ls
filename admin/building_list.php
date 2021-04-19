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
        <table class="table mt-5 text-center">
            <thead>
                <tr>
                    <th>순번</th>
                    <th>회원명(번호)</th>
                    <th>관리번호</th>
                    <th>유형</th>
                    <th>물건명</th>
                    <th>수납방법</th>
                    <th width=30%>그룹id/그룹명/관리번호개수</th>
                    <th>기타상품</th>
                    <th>생성일자</th>
                    <th>수정일자</th>
                </tr>
            </thead>
            <tbody id="buildinglist">
            </tbody>
        </table>

    </div>
</section>


<?php require('view/footer.php');?>

<script src="/admin/inc/js/jquery-3.3.1.min.js"></script>

<script>
$.ajax({
    url: 'ajax/ajax_buildinglist.php',
    success: function(data) {
        data = JSON.parse(data);
        console.log(data);
        let returns = '';

        $.each(data, function(key, value) {

            if (!value.userid) {
                return true;
            }

            let group = JSON.stringify(value.groupArray);
            group = JSON.parse(group);
            let groupReturns = '';
            $.each(group, function(key, value) {
                groupReturns += `<a href=screen/b_group_room_edit.php?id=${value.id}
              class='badge badge-info'>
              ${value.id}, ${value.gName}(${value.roomCount})
            </a>`;
            });

            let good = JSON.stringify(value.goodArray);
            good = JSON.parse(good);
            let goodReturns = '';
            $.each(good, function(key, value) {
                goodReturns += `<a href=screen/b_good_edit.php?id=${value.id}
              class='badge badge-info'>
              ${value.name}</a>`;
            });
            returns += `<tr>
              <td>${value.num}</td>
              <td>${value.user_name}(${Number(value.userid)})</td>
              <td>${Number(value.buildingid)}</td>
              <td>${value.lease_type}</td>
              <td>${value.bName}</td>
              <td>${value.pay}</td>
              <td>${groupReturns}</td>
              <td>${goodReturns}</td>
              <td>${value.created}</td>
              <td>${value.updated}</td>
              </tr>`;
        })
        $('#buildinglist').html(returns);

    }
})
</script>

</body>

</html>