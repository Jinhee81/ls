<?php
session_start();
if(!isset($_SESSION['ais_login'])){
  header('Location: /admin/main/alogin.php');
}
require('view/aconn.php');
require('view/admin_header.php');
?>

<section class="col col-md-11">
  <div class="text-center">
    <h1>회원리스트</h1>
    <table class="table mt-5">
      <tbody>
        <tr>
          <th><input type="checkbox" id="allselect"></th>
          <th>순번</th>
          <th>회원번호</th>
          <th>이메일</th>
          <th>유형(회원명,담당자명)</th>
          <th>연락처</th>
          <th>가입경로</th>
          <th>가입일시</th>
          <th>등급</th>
          <th>건물수</th>
        </tr>
        <?php
        $sql_c = "select count(*) from user";
        $result_c = mysqli_query($conn, $sql_c);
        $row_c = mysqli_fetch_array($result_c);

        $count = $row_c[0] + 1;

        $sql = "SELECT
          @num := @num - 1 as num,
          user.id,
          email,
          user_div,
          user_name,
          manager_name,
          cellphone,
          lease_type,
          regist_channel,
          user.created,
          user.updated,
          (select count(*) from building where user.id = building.user_id) as building_count,
          gradename
         from
          (select @num :={$count})a,
          user
         order by
          user.created desc";

        // echo $sql;
        $result = mysqli_query($conn, $sql);
        // print_r($result);
        while($row = mysqli_fetch_array($result)){
          $filtered = array(
          'id'=>htmlspecialchars($row['id']),
          'email'=>htmlspecialchars($row['email']),
          'user_div'=>htmlspecialchars($row['user_div']),
          'user_name'=>htmlspecialchars($row['user_name']),
          'manager_name'=>htmlspecialchars($row['manager_name']),
          'cellphone'=>htmlspecialchars($row['cellphone']),
          'lease_type'=>htmlspecialchars($row['lease_type']),
          'regist_channel'=>htmlspecialchars($row['regist_channel']),
          'created'=>htmlspecialchars($row['created']),
          'updated'=>htmlspecialchars($row['updated']),
          'building_count'=>htmlspecialchars($row['building_count']),
          'gradename'=>htmlspecialchars($row['gradename'])
        );
          ?>
        <tr>
          <td><input type="checkbox" class="tbodycheckbox" value="<?=$filtered['id']?>"></td>
          <td><?=$row['num']?></td>
          <td>
            <a href="user_detail.php?id=<?=$filtered['id']?>"><?=$filtered['id']?></a>
          </td>
          <td><?=$filtered['email']?></td>
          <td><?=$filtered['lease_type'].'('.$filtered['user_name'].','.$filtered['manager_name'].')'?></td>
          <td>
            <?php
$phone2 = substr($filtered['cellphone'],0,3).'-'.substr($filtered['cellphone'],3,4).'-'.substr($filtered['cellphone'],7,4)
             ?>
            <?=$phone2?>
          </td>

          <td><?=$filtered['regist_channel']?></td>
          <td><?=$filtered['created']?></td>
          <td>
            <?php if($filtered['gradename']==='feefree'){
              echo "무료";
            } else {
              echo $filtered['gradename'];
            } ?>
          </td>
          <td><?=$filtered['building_count']?></td>
        </tr>
      <?php
      }
       ?>
     </tbody>
    </table>
    <?php
    // echo $sql;
    if($result === false){
        echo mysqli_error($conn);
    } else {
      echo "저장되었습니다.<a href='admin_index.php'>돌아가기</a>";
    }
     ?>
  </div>
</section>


<?php require('view/footer.php');?>
