<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);

if($_POST['customerDiv']==='queryCustomer'){
  $customerDiv = '문의';
}
if($_POST['customerDiv']==='ingCustomer'){
  $customerDiv = '세입자';
}
// if($_POST['customerDiv']==='endCustomer'){
//   $customerDiv = '종료세입자';
// }
if($_POST['customerDiv']==='etcCustomer'){
  $customerDiv = '거래처';
}

if($_POST['customerDiv']==='etcCustomer2'){
  $customerDiv = '기타';
}

$etcCondi = "";
if($_POST['cText']){
  if($_POST['etcCondi']==='customer'){
    $etcCondi = " and (name like '%".$_POST['cText']."%' or companyname like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='contact'){
    $etcCondi = " and (contact1 like '%".$_POST['cText']."%' or contact2 like '%".$_POST['cText']."%' or contact3 like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='email'){
    $etcCondi = " and (email like '%".$_POST['cText']."%')";
  } elseif($_POST['etcCondi']==='etc'){
    $etcCondi = " and (etc like '%".$_POST['cText']."%')";
  }
}

if($_POST['dateDiv']==='registerDate'){
  $dateDiv = 'created';
} elseif($_POST['dateDiv']==='updateDate'){
  $dateDiv = 'updated';
}
$etcDate = "";
$toDate1 = strtotime($_POST['toDate']);
$toDate2 = date('Y-m-d', $toDate1);
$toDate3 = date('Y-m-d', strtotime($toDate2.'+1 days'));
// echo $toDate3.'1111';

// $toDate2 = strtotime($toDate1.'+1 days');
if($_POST['fromDate'] && $_POST['toDate']){
  $etcDate = " and ($dateDiv >= '{$_POST['fromDate']}' and $dateDiv <= '{$toDate3}')";
} elseif($_POST['fromDate']){
  $etcDate = " and ($dateDiv >= '{$_POST['fromDate']}')";
} elseif($_POST['toDate']){
  $etcDate = " and ($dateDiv <= '{$toDate3}')";
}

$sql = "select
          @num := @num + 1 as num,
          id, div1, div2, name, div3, companyname, cNumber1, cNumber2, cNumber3, contact1, contact2, contact3, email, etc
        from (select @num :=0)a, customer
        where user_id={$_SESSION['id']} and
              div1 = '{$customerDiv}'
              $etcCondi $etcDate
        order by num desc";
// echo $sql;
$result = mysqli_query($conn, $sql);
$total_rows = mysqli_num_rows($result);
if($total_rows===0){
  echo '조회된 값이 없습니다.';
} else {?>
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
          <?=mb_substr($cName,0,20)?></a>
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
        <td class="mobile"><?=mb_substr($clist['email'],0,15)?></td>
        <td class="mobile"><?=mb_substr($clist['etc'],0,10)?></td>
        <td class="mobile">
          <?php
              if($clist['div1']==='세입자'){
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
<?php }
?>



<script>
var table = $("#checkboxTestTbl");

// 테이블 헤더에 있는 checkbox 클릭시
$(":checkbox:first", table).change(function(){
  if($(":checkbox:first", table).is(":checked")){
    $(":checkbox", table).prop('checked',true);
    $(":checkbox").parent().parent().addClass("selected");
  } else {
    $(":checkbox", table).prop('checked',false);
    $(":checkbox").parent().parent().removeClass("selected");
  }
})

// 헤더에 있는 체크박스외 다른 체크박스 클릭시
$(":checkbox:not(:first)", table).change(function(){
  var allCnt = $(":checkbox:not(:first)", table).length;
  var checkedCnt = $(":checkbox:not(:first)", table).filter(":checked").length;

  if($(this).prop("checked")==true){
    $(this).parent().parent().addClass("selected");
  } else {
    $(this).parent().parent().removeClass("selected");
  }

  if( allCnt==checkedCnt ){
    $(":checkbox:first", table).prop("checked", true);
  }
})

var customerArray = [];

$(":checkbox:first", table).click(function(){

    var allCnt = $(":checkbox:not(:first)", table).length;
    customerArray = [];

    if($(":checkbox:first", table).is(":checked")){
      for (var i = 1; i <= allCnt; i++) {
        var customerArrayEle = [];
        var colOrder = table.find("tr:eq("+i+")").find("td:eq(1)").text();
        var colid = table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val();
        var colStep = table.find("tr:eq("+i+")").find("td:eq(3)").children('span').text();
        customerArrayEle.push(colOrder, colid, colStep);
        customerArray.push(customerArrayEle);
      }
    } else {
      customerArray = [];
    }
    // console.log(customerArray);
})

$(":checkbox:not(:first)",table).click(function(){
  var customerArrayEle = [];

  if($(this).is(":checked")){
    var currow = $(this).closest('tr');
    var colOrder = Number(currow.find('td:eq(1)').text());
    var colid = currow.find('td:eq(0)').children('input').val();
    var colStep = currow.find('td:eq(3)').children('span').text();
    customerArrayEle.push(colOrder, colid, colStep);
    customerArray.push(customerArrayEle);
  } else {
    var currow = $(this).closest('tr');
    var colOrder = Number(currow.find('td:eq(1)').text());
    var colid = currow.find('td:eq(0)').children('input').val();
    var colStep = currow.find('td:eq(3)').children('span').text();
    var dropReady = customerArrayEle.push(colOrder, colid, colStep);
    var index = customerArray.indexOf(dropReady);
    customerArray.splice(index, 1);
  }
  console.log(customerArray);
})
</script>
