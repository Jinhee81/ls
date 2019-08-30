<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$sql = "select
  @num := @num + 1 as num,
  id, div1, div2, name, div3, companyname, cNumber1, cNumber2, cNumber3, contact1, contact2, contact3, email, etc
 from (select @num :=0)a, customer
 where user_id={$_SESSION['id']}
 order by num desc";
$result = mysqli_query($conn, $sql);
?>

<table class="table table-hover text-center" id="checkboxTestTbl">
  <thead>
    <tr class="table-info">
      <th scope="col" class="mobile"><input type="checkbox"></th>
      <th scope="col">순번</th>
      <th scope="col" class="mobile">구분</th>
      <th scope="col">세입자</th>
      <th scope="col">연락처</th>
      <th scope="col" class="mobile">이메일</th>
      <th scope="col" class="mobile">특이사항</th>
      <th scope="col" class="mobile">바로가기</th>
    </tr>
  </thead>
  <tbody>
<?php
// echo $sql;
  while($row = mysqli_fetch_array($result)){
    $clist['id'] = htmlspecialchars($row['id']);
    $clist['num'] = htmlspecialchars($row['num']);
    $clist['div1'] = htmlspecialchars($row['div1']);
    $clist['div2'] = htmlspecialchars($row['div2']);
    $clist['contact1'] = htmlspecialchars($row['contact1']);
    $clist['contact2'] = htmlspecialchars($row['contact2']);
    $clist['contact3'] = htmlspecialchars($row['contact3']);
    $clist['email'] = htmlspecialchars($row['email']);
    $clist['etc'] = htmlspecialchars($row['etc']);
    $clist['name'] = htmlspecialchars($row['name']);
    $clist['companyname'] = htmlspecialchars($row['companyname']);
    $clist['cNumber1'] = htmlspecialchars($row['cNumber1']);
    $clist['cNumber2'] = htmlspecialchars($row['cNumber2']);
    $clist['cNumber3'] = htmlspecialchars($row['cNumber3']);

    $cNumber = $clist['cNumber1'].'-'.$clist['cNumber2'].'-'.$clist['cNumber3'];
    $cContact = $clist['contact1'].'-'.$clist['contact2'].'-'.$clist['contact3'];

    if($row['div3']==='주식회사'){
      $cDiv3 = '(주)';
    } elseif($row['div3']==='유한회사'){
      $cDiv3 = '(유)';
    } elseif($row['div3']==='합자회사'){
      $cDiv3 = '(합)';
    } elseif($row['div3']==='기타'){
      $cDiv3 = '(기타)';
    }

    if($clist['div2']==='개인사업자'){
      $cName = $clist['name'].'('.$clist['companyname'].','.$cNumber.')';
    } else if($clist['div2']==='법인사업자'){
      $cName = $cDiv3.$clist['companyname'].'('.$clist['name'].','.$cNumber.')';
    } else if($clist['div2']==='개인'){
      $cName = $clist['name'];
    }

    if($clist['div1']==='문의'){
      $cName = 'ㅇㅇㅇ';
    }
    ?>
  <tr>
    <td class="mobile"><input type="checkbox" value="<?=$clist['id']?>"></td>
    <td><?=$clist['num']?></td>
    <td class="mobile"><?=$clist['div1']?></td>
    <td class='text-center'><a href="m_c_edit.php?id=<?=$clist['id']?>">
      <?=$cName?></a>
<?php
$sql2 = "select count(*) from realContract where customer_id={$clist['id']}";
// echo $sql2;
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);

if((int)$row2[0]>0){
  echo "<span class='badge badge-pill badge-warning'>".$row2[0]."</span>";
}
 ?>
    </td>
    <td><?=$cContact?></td>
    <td class="mobile"><?=$clist['email']?></td>
    <td class="mobile"><?=$clist['etc']?></td>
    <td class="mobile">
      <?php
          if($clist['div1']==='진행고객'){
            echo "<a class='btn btn-info btn-sm' href='/service/contract/contract_add1.php?id=".$clist['id']."' role='button'>방계약</a>";
          }
       ?>
    </td>
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
