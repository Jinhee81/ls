<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$sql = "
  select
      @num := @num + 1 as num,
      realContract.id,
      status,
      customer.id,
      customer.name,
      customer.companyname,
      customer.div2,
      customer.div3,
      customer.contact1,
      customer.contact2,
      customer.contact3,
      building.bName,
      group_in_building.gName,
      r_g_in_building.rName,
      startDate,
      endDate,
      mtAmount,
      depositInAmount
  from
      (select @num :=0)a,realContract
  left join customer
      on realContract.customer_id = customer.id
  left join building
      on realContract.building_id = building.id
  left join group_in_building
      on realContract.group_in_building_id = group_in_building.id
  left join r_g_in_building
      on realContract.r_g_in_building_id = r_g_in_building.id
  where realContract.user_id = {$_SESSION['id']}
  order by
      num desc";
// echo $sql;
$result = mysqli_query($conn, $sql);
?>

<table class="table table-hover text-center" id="checkboxTestTbl">
  <thead>
    <tr class="table-info">
      <th scope="col" class="mobile"><input type="checkbox"></th>
      <th scope="col">순번</th>
      <th scope="col">상태</th>
      <th scope="col">고객정보</th>
      <!-- <th scope="col">연락처</th> -->
      <!-- <th scope="col" class="mobile">물건명</th> -->
      <!-- <th scope="col" class="mobile">그룹명</th>-->
      <th scope="col">관리번호</th>
      <th scope="col" class="mobile">시작일</th>
      <th scope="col" class="mobile">종료일</th>
      <th scope="col">월이용료</th>
      <th scope="col" class="mobile">입금액</th>
      <th scope="col" class="mobile">미납액</th>
      <th scope="col" class="mobile">보증금</th>
    </tr>
  </thead>
  <tbody>
<?php
// echo $sql;
  while($row = mysqli_fetch_array($result)){
    $cContact = $row['contact1'].'-'.$row['contact2'].'-'.$row['contact3'];

    if($row['div3']==='주식회사'){
      $cDiv3 = '(주)';
    } elseif($row['div3']==='유한회사'){
      $cDiv3 = '(유)';
    } elseif($row['div3']==='합자회사'){
      $cDiv3 = '(합)';
    } elseif($row['div3']==='기타'){
      $cDiv3 = '(기타)';
    }

    if($row['div2']==='개인사업자'){
      $cName = $row['name'].'('.$row['companyname'].')';
    } else if($row['div2']==='법인사업자'){
      $cName = $cDiv3.$row['companyname'].'('.$row['name'].')';
    } else if($row['div2']==='개인'){
      $cName = $row['name'];
    }
    // print_r($row);
    ?>
  <tr>
    <td class="mobile"><input type="checkbox" name="chk[]" value="<?=$row[1]?>"></td>
    <td><?=$row['num']?></td>
    <td><?=$row['status']?></td>
    <td class='text-center'><a href="/service/customer/m_c_edit.php?id=<?=$row[3]?>">
      <?=$cName.', '.$cContact?></a></td>
    <!-- <td class='text-center'><?=$cContact?></td> -->
    <!-- <td><?=$row[4]?></td>
    <td class="mobile"><?=$row[5]?></td> -->
    <td><?=$row['rName']?></td>
    <td class="mobile"><?=$row['startDate']?></td>
    <td class="mobile"><?=$row['endDate']?></td>
    <td><a href="contractEdit3.php?id=<?=$row[1]?>"><?=$row['mtAmount']?></a></td>
    <td class="mobile"></td>
    <td class="mobile"></td>
    <td class="mobile"><?=$row['depositAmount']?></td>
  </tr>
<?php } ?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
