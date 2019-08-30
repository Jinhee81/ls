<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>

<!-- <script src="m_c_add_element.js"></script> -->
<?php
// print_r($_GET['id']);
$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//고객아이디
settype($filtered_id, 'integer');

$sql = "select
          customer.id, div1, qDate, div2, name, contact1, contact2, contact3,
          gender, customer.email, div3, div4, div5, companyname,
          cNumber1, cNumber2, cNumber3,
          zipcode, add1, add2, add3, etc,
          customer.created, customer.updated, createPerson,
          (select damdangga_name from user where id=createPerson),
          updatePerson,
          (select damdangga_name from user where id=updatePerson)
      from customer
        left join user
      on customer.createPerson = user.id
        where customer.id = {$filtered_id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// echo $sql;
print_r($row);
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
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">세입자 수정 화면입니다!</h1>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p>
    <hr class="my-4">-->
    <button type='button' class='btn btn-secondary' data-toggle="modal" data-target="#div2Transfer">구분(소)변경</button>
      <!-- 모달시작================================================================ -->
      <div class="modal fade" id="div2Transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">구분(소) 변경하기</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row justify-content-md-center">
                  <label><?=$cName?></label>
                </div>
                <div class="row justify-content-md-center">
                  <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='radio' name='radiodiv2' value='개인'<?php if($row['div2']==='개인'){echo "disabled";}?>>
                    <label class='form-check-label'>개인</label>
                  </div>
                  <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='radio' name='radiodiv2' value='개인사업자'<?php if($row['div2']==='개인사업자'){echo "disabled";}?>>
                    <label class='form-check-label'>개인사업자</label>
                  </div>
                  <div class='form-check form-check-inline'>
                    <input class='form-check-input' type='radio' name='radiodiv2' value='법인사업자'<?php if($row['div2']==='법인사업자'){echo "disabled";}?>>
                    <label class='form-check-label'>법인사업자</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
              <button type="button" class="btn btn-primary" onclick="div2TransferFn(aa2,bb2,cc1,dd1);">변경하기</button>
            </div>
          </div>
        </div>
      </div>
      <!-- 모달끝================================================================== -->
    <!-- <small>(1) * 표시는 필수입력값입니다. (2) 구분(대)의 값이 '고객'이어야 임대계약 등록이 가능합니다. (3) '고객'이란 단어는 세입자 또는 입주자를 의미합니다.</small> isright 9999 -->
  </div>
</section>
<section class="container" style="max-width:700px;">
  <form method="post" action ="p_m_c_edit.php">
  <input type="hidden" name="id" value="<?=$filtered_id?>">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label>구분(대)</label>
        <select id="div1" name="div1" class="form-control" onchange="div1Get();" disabled>
          <option value="문의" <?php if($row['div1']==='문의'){echo "selected";}?>>문의</option>
          <option value="진행고객" <?php if($row['div1']==='진행고객'){echo "selected";}?>>고객</option>
          <option value="거래처" <?php if($row['div1']==='거래처'){echo "selected";}?>>거래처</option>
        </select>
      </div>
      <div class="form-group col-md-4" id="idDiv2Large">
        <label>구분(소)</label>
        <select id="div2" name="div2" class="form-control" disabled>
          <option value="개인" <?php if($row['div2']==='개인'){echo "selected";}?>>개인</option>
          <option value="개인사업자" <?php if($row['div2']==='개인사업자'){echo "selected";}?>>개인사업자</option>
          <option value="법인사업자" <?php if($row['div2']==='법인사업자'){echo "selected";}?>>법인사업자</option>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label>고객번호</label>
        <input type="text" class="form-control" name="" value="<?=$clist['id']?>" disabled>
      </div>
    </div>
    <div id="centerSection">
      <?php
if($row['div1']==='문의'){
  include $_SERVER['DOCUMENT_ROOT']."/service/customer/m_c_edit_1_query.php";
} else {
  if ($row['div2']==='개인'){
    include $_SERVER['DOCUMENT_ROOT']."/service/customer/m_c_edit_2_indi.php";
  } else if($row['div2']==='개인사업자'){
    include $_SERVER['DOCUMENT_ROOT']."/service/customer/m_c_edit_3_indiCom.php";
  } else if($row['div2']==='법인사업자'){
    include $_SERVER['DOCUMENT_ROOT']."/service/customer/m_c_edit_4_Com.php";
  }
}
?>
    </div>
    <div class="mt-3">
      <button type='submit' class='btn btn-primary' id="editbtn">수정</button>
      <a class='btn btn-warning' role='button' onclick='goCategoryPage(aa1,bb1,cc1,dd1);'>삭제</a>

      <button id="historyBack" type='button' class='btn btn-secondary'>돌아가기</button>
      <a role='button' class='btn btn-secondary' href='customer.php'>고객리스트로</a>
    </div>


  </form>
</section>
<script>
var aa1='customerDelete';
var bb1='p_m_c_delete.php';
var cc1='id';
var dd1='<?=$filtered_id?>';

var aa2 = 'div2Transfer';
var bb2 = 'p_m_c_edit_div2.php'


function goCategoryPage(a,b,c,d){
  if(confirm('정말 삭제하시겠습니까?')){
    var frm = formCreate(a, 'post', b,'')
    frm = formInput(frm, c, d);
    formSubmit(frm);
    // console.log(b);
  } else {
    return false;
  }
}
$('#popButton').click(function(){
  // $('div.modal').modal();
  console.log('hello');
})

function div2TransferFn(a,b,c,d){
  var ee  = 'div2';
  var ff  = $('input[name="radiodiv2"]:checked').val();
  var frm = formCreate(a, 'post', b,'')
  frm = formInput(frm, c, d);
  frm = formInput(frm, ee, ff);
  formSubmit(frm);
}

// $('#editbtn').on('click', function(){
//
// })

$('#historyBack').on('click', function(){
  console.log('minsun');
  history.back();
})
</script>
<!-- isright 4444? -->
<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
