<!--그룹수정모달(예, 상주/비상주) 시작-->
<div class="modal fade bd-example-modal-lg" id="modal_group_edit<?=$row2['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <?php
      $sql3 = "select * from group_in_building
         where id = {$row2['id']}";
         // echo $sql;
      $result3 = mysqli_query($conn, $sql3);
      while($row3 = mysqli_fetch_array($result3)){
        // var_dump($row);
       ?>
      <div class="modal-header">
        <h5 class="modal-title">그룹 및 관리번호 수정</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
          <h6>location</h6>
          <script>
            document.write(location.href);
          </script>
        </div>
        <table class="table table-bordered text-center">
        <thead>
          <tr>
            <th scope="col col-sm-4">물건명</th>
            <th scope="col col-sm-4">그룹명</th>
            <th scope="col col-sm-4">관리개수</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input class="form-control text-center" type="text" name="building_name" value="<?=$escaped['name']?>" disabled></td><!--물건명, 예)비즈피스 구로-->

            <td><input class="form-control text-center" type="text" name="name" required="" value="<?=$row3['gName']?>"></td><!--그룹명, 예)상주, 비상주-->

            <td><input name="count" class="form-control text-center" value="<?=$row3['count']?>"></td><!--방/좌석수-->
          </tr>
        </tbody>
        </table>
        <!-- 아래는 그룹내방번호보여주는테이블시작 -->
        <table class="table table-bordered text-center">
          <?php
          $sql4 = "select * from r_g_in_building where group_in_building_id = {$row3['id']}";
          $result4 = mysqli_query($conn, $sql4);
          ?>
          <tr>
            <td><?=$sql4?></td>
          </tr>
          <tr>
            <td><?php var_dump($result4); ?></td>
          </tr>
          <tr>
            <?php while($row4 = mysqli_fetch_array($result4)) {?>
            <td><input class="form-control text-center" type="text" value="<?php print_r($row4);?>"></td>
          <?php } ?>
          </tr>
        </table>
    </div> <!--modal body close div-->

    <div class="modal-footer">
      <form class="" action="p_modal_b_group_delete.php" method="post" onsubmit="if(!confirm('정말 삭제하겠습니까?')){return false;}">
        <input type="hidden" name="id" value="<?=$row2['id']?>">
        <button type="submit" class="btn btn-secondary">삭제</button>
      </form>
      <button type="submit" class="btn btn-primary">수정</button>
    </div>
    <?php } ?>
  </div> <!--modal content close div-->
</div> <!--modal-dialog modal-lg close div-->
</div> <!--그룹수정 모달 끝-->
