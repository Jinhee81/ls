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

            <td><input name="count" class="form-control text-center" value="<?=$row3['count']?>" disabled=""></td><!--방/좌석수-->
          </tr>
        </tbody>
        </table>
        <!-- 아래는 그룹내방번호보여주는테이블시작 -->
        <?php
        $editRooms = [];
        $editDelete = "";
        $sql7 = "select * from r_g_in_building where group_in_building_id = {$row3['id']}";
        $result7 = mysqli_query($conn, $sql7);
        while($row7 = mysqli_fetch_array($result7)){
          array_push($editRooms, $row7['rName']);
        }
        $table2 = "<table class='table table-borderless table-sm text-center'";
        $trArray=[0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95];
        $closeTrArray= [4,9,14,19,24,29,34,39,44,49,54,59,64,69,74,79,84,89,94,99];

        for ($i=0; $i < sizeof($editRooms); $i++) {
          if(in_array($i, $trArray)){
            $table2 = $table2 . "<tr>
              <td style='padding-right:0px;'><input class='form-control text-center' type='text' name='rName" . $i . "' value='" . $editRooms[$i] . "'></td>
              <td style='padding-left:0px;'>
              <form action='p_room_delete.php' method='post'>
              <input type='hidden' name='group' value='".$row3['id']."'>
              <input type='hidden' name='rNumber' value='".$editRooms[$i]."'>
              <button type='submit' class='btn btn-default' id='rDelete'
               style='padding-left: 0px;
               padding-top: 0px;
               border-top-width: 0px;
               border-left-width: 0px;'>
              <i class='fa fa-times-circle' style='color:#FE9A2E;'></i></button>
              </form>
              </td>";
          } else if(in_array($i, $closeTrArray)){
            $table2 = $table2 . "
            <td style='padding-right:0px;'><input class='form-control text-center' type='text' name='rName" . $i . "' value='" . $editRooms[$i] . "'></td>
            <td style='padding-left:0px;'>
            <form action='p_room_delete.php' method='post'>
            <input type='hidden' name='group' value='".$row3['id']."'>
            <input type='hidden' name='rNumber' value='".$editRooms[$i]."'>
            <button type='submit' class='btn btn-default' id='rDelete'
             style='padding-left: 0px;
             padding-top: 0px;
             border-top-width: 0px;
             border-left-width: 0px;'>
            <i class='fa fa-times-circle' style='color:#FE9A2E;'></i></button>
            </form>
            </td></tr>";
          } else {
            $table2 = $table2 . "
            <td style='padding-right:0px;'><input class='form-control text-center' type='text' name='rName" . $i . "' value='" . $editRooms[$i] . "'></td>
            <td style='padding-left:0px;'>
            <form action='p_room_delete.php' method='post'>
            <input type='hidden' name='group' value='".$row3['id']."'>
            <input type='hidden' name='rNumber' value='".$editRooms[$i]."'>
            <button type='submit' class='btn btn-default' id='rDelete'
             style='padding-left: 0px;
             padding-top: 0px;
             border-top-width: 0px;
             border-left-width: 0px;'>
            <i class='fa fa-times-circle' style='color:#FE9A2E;'></i></button>
            </form>
            </td>";
          }
        }
        $table2 = $table2."<td><button class='btn btn-outline-warning btn-sm'>관리번호 추가</button><td>";
        $table2 = $table2."</table>";
        ?>
        <div>
          <?php echo $table2; ?>
        </div>
    </div> <!--modal body close div-->

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
      <form class="" action="p_modal_b_group_delete.php" method="post" onsubmit="if(!confirm('정말 삭제하겠습니까?')){return false;}">
        <input type="hidden" name="id" value="<?=$row2['id']?>">
        <button type="submit" class="btn btn-secondary">그룹삭제</button>
      </form>
      <button type="submit" class="btn btn-primary">수정</button>
    </div>
    <?php } ?>
  </div> <!--modal content close div-->
</div> <!--modal-dialog modal-lg close div-->
</div> <!--그룹수정 모달 끝-->
<script>
$("#clear").click(function(){
    $(".resultingarticles").empty();
    $("#searchbox").val("");
  });
</script>
