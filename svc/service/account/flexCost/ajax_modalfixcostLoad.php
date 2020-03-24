<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// echo $_POST;
print_r($_POST);

$sql = "
        select
          @num := @num + 1 as num,
          fixcost.id,
          building_id,
          bName,
          title,
          amount1, amount2, amount3,
          vat
        from
          (select @num:=0)a,
          fixcost
        join building
          on fixcost.building_id = building.id
        where fixcost.user_id={$_SESSION['id']}
              and building_id = {$_POST['buildingIdx']}
       ";
// echo $sql;

$result = mysqli_query($conn, $sql);
$allRows = array();

while($row = mysqli_fetch_array($result)){
  $allRows[]=$row;
}

// print_r($allRows);

if(count($allRows)===0){
  echo "조회값이 없습니다.";
} else {?>
  <table class="table table-hover text-center mt-2 table-sm" id="modalTable">
    <thead>
      <tr class="table-info">
        <th scope="col"><input type="checkbox"></th>
        <th scope="col">순번</th>
        <th scope="col">관리물건</th>
        <th scope="col">내역</th>
        <th scope="col">금액</th>
        <th scope="col">공급가액</th>
        <th scope="col">세액</th>
      </tr>
    </thead>
    <tbody>
      <?php
       for($i=0; $i < count($allRows); $i++){?>
         <tr>
           <td>
             <input type="checkbox" value="<?=$allRows[$i]['id']?>">
           </td>
           <td>
             <?=$allRows[$i]['num']?>
           </td>
           <td><?=$allRows[$i]['bName']?></td>
           <td><?=$allRows[$i]['title']?></td>
           <td><?=$allRows[$i]['amount1']?></td>
           <td><?=$allRows[$i]['amount2']?></td>
           <td><?=$allRows[$i]['amount3']?></td>
         </tr>
       <?php } ?> <!--이거가 for문닫는 대괄호-->
     </tbody>
   </table>

 <?php } //이거가 else 닫는 대괄호

?>


<script>

var table1 = $("#modalTable");

// 테이블 헤더에 있는 checkbox 클릭시
$("thead :checkbox", table1).change(function(){

  if($(this).is(":checked")){
    $("input:checkbox", table1).attr('checked',true);
    $("tbody tr", table1).addClass("selected");
    // console.log('1');
  } else {
    $("input:checkbox", table1).attr('checked',false);
    $("tbody tr", table1).removeClass("selected");
    // console.log('2');
  }
})

// 헤더에 있는 체크박스외 다른 체크박스 클릭시
$("tbody :checkbox", table1).change(function(){
  var allCnt = $("tbody :checkbox", table1).length;
  var checkedCnt = $("tbody :checkbox", table1).filter(":checked").length;

  if($(this).prop("checked")==true){
    $(this).attr('checked',true);
    $(this).parent().parent().addClass("selected");
  } else {
    $(this).attr('checked',false);
    $(this).parent().parent().removeClass("selected");
  }

  if(allCnt==checkedCnt){
    $("thead :checkbox", table1).attr("checked", true);
  }
  console.log(allCnt, checkedCnt);
})


</script>
