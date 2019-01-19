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
          <th>회원구분</th>
          <th>회원명</th>
          <th>휴대폰번호</th>
          <th>임대유형</th>
          <th>가입경로</th>
          <th>가입일시</th>
          <th>수정일시</th>
        </tr>
        <?php
        $sql = "SELECT
          @num := @num + 1 as num,
          id,
          email,
          user_div,
          user_name,
          cellphone,
          lease_type,
          regist_channel,
          created,
          updated
         from
          (select @num :=0)a,
          user
         order by
          num desc";
        $result = mysqli_query($conn, $sql);
        // print_r($result);
        while($row = mysqli_fetch_array($result)){
          ?>
        <tr>
          <td><?=$row['num']?></td>
          <td><?=$row['id']?></td>
          <td><?=$row['email']?></td>
          <td><?=$row['user_div']?></td>
          <td><?=$row['user_name']?></td>
          <td><?=$row['cellphone']?></td>
          <td><?=$row['lease_type']?></td>
          <td><?=$row['regist_channel']?></td>
          <td><?=$row['created']?></td>
          <td><?=$row['updated']?></td>
        </tr>
      <?php
      }
       ?>
      </tbody>
    </table>
    <?php
    if($result === false){
        echo mysqli_error($conn);
    } else {
      echo "저장되었습니다.<a href='admin_index.php'>돌아가기</a>";
    }
     ?>
  </div>
</section>


<?php require('view/footer.php');?>
