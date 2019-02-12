<?php require('view/conn.php');?>
<?php require('view/admin_header.php');?>
<section class="container mt-3">
  <div class="text-center">
    <h1>회원리스트</h1>
    <table class="table mt-5">
      <tbody>
        <tr>
          <th>순번</th>
          <th>회원번호</th>
          <th>이메일</th>
          <th>구분</th>
          <th>회원명</th>
          <th>휴대폰번호</th>
          <th>유형</th>
          <th>가입경로</th>
          <th>가입일시</th>
          <th>수정일시</th>
          <th>건물수</th>
        </tr>
        <?php
        $sql = "SELECT
          @num := @num + 1 as num,
          user.id,
          email,
          user_div,
          user_name,
          cellphone,
          lease_type,
          regist_channel,
          created,
          updated,
          (select count(*) from building where user.id = building.user_id) as building_count
         from
          (select @num :=0)a,
          user left join building on user.id = building.user_id
         order by
          num desc";
        $result = mysqli_query($conn, $sql);
        // print_r($result);
        while($row = mysqli_fetch_array($result)){
          $filtered = array(
          'id'=>htmlspecialchars($row['id']),
          'email'=>htmlspecialchars($row['email']),
          'user_div'=>htmlspecialchars($row['user_div']),
          'user_name'=>htmlspecialchars($row['user_name']),
          'cellphone'=>htmlspecialchars($row['cellphone']),
          'lease_type'=>htmlspecialchars($row['lease_type']),
          'regist_channel'=>htmlspecialchars($row['regist_channel']),
          'created'=>htmlspecialchars($row['created']),
          'updated'=>htmlspecialchars($row['updated']),
          'building_count'=>htmlspecialchars($row['building_count'])
        )
          ?>
        <tr>
          <td><?=$row['num']?></td>
          <td><?=$filtered['id']?></td>
          <td><?=$filtered['email']?></td>
          <td><?=$filtered['user_div']?></td>
          <td><?=$filtered['user_name']?></td>
          <td><?=$filtered['cellphone']?></td>
          <td><?=$filtered['lease_type']?></td>
          <td><?=$filtered['regist_channel']?></td>
          <td><?=$filtered['created']?></td>
          <td><?=$filtered['updated']?></td>
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
