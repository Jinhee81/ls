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
        <?php
        $sql1 = "SELECT
          @num := @num + 1 as num,
          user_name,
          user.id as userid,
          building.id as buildingid,
          lease_type,
          bName,
          pay,
          building.created,
          building.updated
         from
          (select @num :=0)a,
          building left join user on building.user_id = user.id
         order by
          num asc"; //세션아이디로 건물정보 호출하는거
        $result1 = mysqli_query($conn, $sql1);
        // print_r($result);
        while($row1 = mysqli_fetch_array($result1)){
          $escaped1 = array(
            'num' => htmlspecialchars($row1['num']),
            'userid' => htmlspecialchars($row1['userid']),
            'buildingid' => htmlspecialchars($row1['buildingid']),
            'lease_type' => htmlspecialchars($row1['lease_type']),
            'name' => htmlspecialchars($row1['name']),
            'pay' => htmlspecialchars($row1['pay']),
            'user_name' => htmlspecialchars($row1['user_name']),
            'created' => htmlspecialchars($row1['created']),
            'updated' => htmlspecialchars($row1['updated'])
          );
          ?>
        <tr>
          <!-- <td><?php print_r($row1); ?></td> -->
          <td><?=$escaped1['num']?></td>
          <td><?=$escaped1['user_name'],"(",$escaped1['userid'],")"?></td>
          <td><?=$escaped1['buildingid']?></td>
          <td><?=$escaped1['lease_type']?></td>
          <td>
            <!-- <a href="#"></a> -->
            <a href="#edit<?=$escaped1['buildingid']?>" data-toggle="modal"><?=$escaped1['name']?></a>
            <?php
    include $_SERVER['DOCUMENT_ROOT']."/service/setting/modal_building_edit.php";
             ?>
          </td><!--비즈피스구로,장암명칭 수정모달 호출 버튼-->
          <td><?=$escaped1['pay']?></td>
          <td>
            <?php
            $sql2 =
              "select * from group_in_building where building_id={$escaped1['buildingid']}";//건물아이디로 전체정보 호출
            $result2 = mysqli_query($conn, $sql2);
            // echo $sql2;
            // print_r($result2);
            while($row2 = mysqli_fetch_array($result2)){?>
              <?php $sql_count="select count(*) from r_g_in_building where group_in_building_id={$row2['id']}";
              $result_count=mysqli_query($conn, $sql_count);
              $row_count=mysqli_fetch_array($result_count);
              ?>
              <button data-toggle="modal" data-target="#modal_group_edit<?=$row2['id']?>"
                class='badge badge-info'><!--row2['id']는 그룹아이디-->
                <?="(",$row2['id'],")",$row2['gName'],"(",$row_count[0],")"?>
              </button><!--건물내 그룹(상주,비상주) 뱃지-->
            <?php } ?>
         </td><!--상주/비상주추가 모달 호출 버튼-->
         <td>
           <?php $sql3 = "select * from good_in_building where building_id = {$escaped1['buildingid']}";
            // echo $sql;
            $result3 = mysqli_query($conn, $sql3);
            while($row3 = mysqli_fetch_array($result3)){?>
              <button data-toggle="modal" data-target="#modal_good_edit<?=$row3['id']?>"
                class='badge badge-info'>
                <?=$row3['id'],"(",$row3['name'],")"?>
              </button><?php
    include $_SERVER['DOCUMENT_ROOT']."/service/setting/modal_b_good_edit.php";
            }?>
         </td><!--기타계약상품 모달 호출버튼 -->
         <td><?=$escaped1['created']?></td>
         <td><?=$escaped1['updated']?></td>
        </tr>
        <?php
         } ?>
      </tbody>
    </table>
    <?php echo $sql1;
     ?>
  </div>
</section>

<?php require('view/footer.php');?>
