<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php"; ?>
<table class="table mt-5 text-center"> <!--건물리스트 출력 테이블시작-->
  <tbody>
    <tr>
      <th>순번</th>
      <th>관리번호</th>
      <th>유형</th>
      <th>물건명</th>
      <th>수납방법</th>
      <th>그룹/관리호수</th>
      <th></th>
    </tr>
    <?php
    $sql = "SELECT
      @num := @num + 1 as num,
      building.id,
      lease_type,
      name,
      pay
     from
      (select @num :=0)a,
      building left join user on building.user_id = user.id
     where building.user_id = {$_SESSION['id']}
     order by
      num asc";
    $result = mysqli_query($conn, $sql);
    // print_r($result);
    while($row = mysqli_fetch_array($result)){
      $escaped = array(
        'num', 'id', 'lease_type', 'name', 'pay'
      );
      $escaped['num'] = htmlspecialchars($row['num']);
      $escaped['id'] = htmlspecialchars($row['id']);
      $escaped['lease_type'] = htmlspecialchars($row['lease_type']);
      $escaped['name'] = htmlspecialchars($row['name']);
      $escaped['pay'] = htmlspecialchars($row['pay']);
      ?>
    <tr>
      <td><?=$escaped['num']?></td>
      <td><?=$escaped['id']?></td>
      <td><?=$escaped['lease_type']?></td>
      <td>
        <!-- <a href="#"></a> -->
        <a href="#edit<?=$escaped['id']?>" data-toggle="modal"><?=$escaped['name']?></a>
        <?php
include $_SERVER['DOCUMENT_ROOT']."/service/setting/modal_building_edit.php";
         ?>
      </td><!--임대물건수정 모달 호출 버튼-->
      <td><?=$escaped['pay']?></td>
      <td><a href="#" class="badge badge-info">그룹명
      </a>
        <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal_group_add<?=$escaped['id']?>">추가하기</button>
      <?php
include $_SERVER['DOCUMENT_ROOT']."/service/setting/modal_b_group_add.php";
       ?>
      </td><!--그룹추가 모달 호출 버튼-->
      <td>
        <form class="" action="building_process_delete.php" method="post" onsubmit="alert('정말 삭제하겠습니까?');">
          <input type="hidden" name="id" value="<?=$escaped['id']?>">
          <button type="submit" class="btn btn-default">
            <i class='far fa-trash-alt'></i>
          </button>
        </form>
      </td>
    </tr>
  <?php
   } ?>
  </tbody>
</table>
<small class="form-text text-muted">
  . 그룹이란? 관리해야할 방 개수가 여러개일때, 편리하게 관리하도록 그룹으로 설정합니다. 예) 1층그룹 101호~120호, 2층그룹 201호~220호
</small> <!--건물리스트 출력 테이블 끝-->
