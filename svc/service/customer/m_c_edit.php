<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>세입자등록</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/service/contract/building.php";

// print_r($buildingArray);
?>


<?php
// print_r($_GET['id']);
$filtered_id = mysqli_real_escape_string($conn, $_GET['id']);//고객아이디
settype($filtered_id, 'integer');

$sql = "select
          customer.id, div1, qDate, div2, name, contact1, contact2, contact3,
          gender, customer.email, div3, div4, div5, companyname,
          cNumber1, cNumber2, cNumber3,
          zipcode, add1, add2, add3, etc, created, updated, building_id
      from customer
      where customer.id = {$filtered_id}";

// echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

// print_r($row);
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
$clist['zipcode'] = htmlspecialchars($row['zipcode']);
$clist['add1'] = htmlspecialchars($row['add1']);
$clist['add2'] = htmlspecialchars($row['add2']);
$clist['add3'] = htmlspecialchars($row['add3']);

 ?>
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h2 class="">입주자 수정 화면이에요.</h2>
    <!-- <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p>
    <hr class="my-4">-->
    <!-- <small>(1) * 표시는 필수입력값입니다. (2) 구분(대)의 값이 '고객'이어야 임대계약 등록이 가능합니다. (3) '고객'이란 단어는 세입자 또는 입주자를 의미합니다.</small> isright 9999 -->
  </div>
</section>
<section class="container" style="max-width:700px;">
  <form method="post" action ="p_m_c_edit.php">
    <div class="form-row">
      <div class="form-group col-md-3">
        <p class="mb-1"><span id='star' style='color:#F7BE81;'>* </span>구분1</p>
        <select name="div1" class="form-control">
          <option value="입주자" <?php if($clist['div1']==='입주자'){echo "selected";}?>>입주자</option>
          <option value="거래처" <?php if($clist['div1']==='거래처'){echo "selected";}?>>거래처</option>
          <option value="기타" <?php if($clist['div1']==='기타'){echo "selected";}?>>기타</option>
        </select>
      </div>
      <div class="form-group col-md-3">
        <p class="mb-1"><span id='star' style='color:#F7BE81;'>* </span>구분2</p>
        <select name="div2" class="form-control">
          <option value="개인" <?php if($clist['div2']==='개인'){echo "selected";}?>>개인</option>
          <option value="개인사업자" <?php if($clist['div2']==='개인사업자'){echo "selected";}?>>개인사업자</option>
          <option value="법인사업자" <?php if($clist['div2']==='법인사업자'){echo "selected";}?>>법인사업자</option>
        </select>
      </div>
      <div class="form-group col-md-3">
        <p class="mb-1"><span id='star' style='color:#F7BE81;'>* </span>물건</p>
        <select name="building" class="form-control">
        <?php

        foreach ($buildingArray as $key => $value) {
          if($row['building_id']==$key){
            echo "<option value='$key' selected>".$buildingArray[$key][0]."</option>";
          } else {
            echo "<option value='$key'>".$buildingArray[$key][0]."</option>";
          }
        }
         ?>
        </select>
      </div>
    </div>
    <div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <p class="mb-1"><span id='star' style='color:#F7BE81;'>* </span>성명</p>
          <input type='text' name='name' class='form-control' required maxlength='9' value="<?=$clist['name']?>">
          <input type='hidden' name='id' value="<?=$_GET['id']?>">
        </div>
        <div class="form-group col-md-5">
          <p class="mb-1"><span id='star' style='color:#F7BE81;'>* </span>연락처</p>
          <div class='form-row'>
            <div class='form group col-md-4'>
              <input type='number' name='contact1' id='contact1' class='form-control' maxlength='3' value="<?=$clist['contact1']?>" required>
            </div>
            <div class='form group col-md-4'>
              <input type='number' name='contact2' id='contact2' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);' value="<?=$clist['contact2']?>">
            </div>
            <div class='form group col-md-4'>
              <input type='number' name='contact3' id='contact3' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);' value="<?=$clist['contact3']?>">
            </div>
          </div>
        </div>
        <div class="form-group col-md-3">
          <p class="mb-1">성별</p>
          <div class='form-check form-check-inline'>
            <input class='form-check-input' type='radio' name='gender' id='inlineRadio1' value='남'<?php if($row['gender']==='남'){echo "checked";}?>>
            <label class='form-check-label'>남</label>
          </div>
          <div class='form-check form-check-inline'>
            <input class='form-check-input' type='radio' name='gender' id='inlineRadio2' value='여'<?php if($row['gender']==='남'){echo "checked";}?>>
            <label class='form-check-label'>여</label>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <p class="mb-1">사업자구분</p>
          <select name="div3" class="form-control">
            <option value=""<?php if($clist['div2']=='개인'||$clist['div2']=='개인사업자'){
              echo "selected";
            } ?>></option>
            <option value="주식회사"<?php if($clist['div2']=='법인사업자'&&$clist['div3']=='주식회사'){
              echo "selected";
            } ?>>주식회사</option>
            <option value="유한회사"<?php if($clist['div2']=='법인사업자'&&$clist['div3']=='유한회사'){
              echo "selected";
            } ?>>유한회사</option>
            <option value="합자회사"<?php if($clist['div2']=='법인사업자'&&$clist['div3']=='합자회사'){
              echo "selected";
            } ?>>합자회사</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <p class="mb-1">사업자명</p>
          <input type='text' name='companyname' class='form-control' maxlength='14' value="<?=$clist['companyname']?>">
        </div>
        <div class="form-group col-md-5">
          <p class="mb-1">사업자번호</p>
          <div class='form-row'>
            <div class='form group col-md-4'>
              <input type='number' name='cNumber1' class='form-control' maxlength='3' oninput='maxlengthCheck(this);' value="<?=$clist['cNumber1']?>">
            </div>
            <div class='form group col-md-3'>
              <input type='number' name='cNumber2' class='form-control' maxlength='2' oninput='maxlengthCheck(this);' value="<?=$clist['cNumber2']?>">
            </div>
            <div class='form group col-md-5'>
              <input type='number' name='cNumber3' class='form-control' maxlength='5' oninput='maxlengthCheck(this);' value="<?=$clist['cNumber3']?>">
            </div>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <p class="mb-1">업태</p>
          <input type='text' name='div4' class='form-control' maxlength='9' value="<?=$clist['div4']?>">
        </div>
        <div class="form-group col-md-3">
          <p class="mb-1">종목</p>
          <input type='text' name='div5' class='form-control' maxlength='9' value="<?=$clist['div5']?>">
        </div>
        <div class="form-group col-md-6">
          <p class="mb-1">이메일</p>
          <input type='email' name='email' class='form-control' maxlength='40' value="<?=$clist['email']?>">
        </div>
      </div>
      <div class='form-group'>
        <div class='form-row'>
          <p class="mb-1">주소</p>
        </div>
        <div class='form-row'>
          <div class='form-group col-md-3'>
            <input type='text' id='sample2_postcode' name='zipcode' placeholder='우편번호' class='form-control' disabled value="<?=$clist['zipcode']?>">
          </div>
          <div class='form-group col-md-3'>
            <input type='button' onclick='sample2_execDaumPostcode()' value='우편번호 찾기' class='btn btn-outline-secondary btn-sm'><br>
          </div>
        </div>
        <div class='form-row'>
          <div class='form-group col-md-6'>
            <input type='text' id='sample2_address' name='add1' class='form-control' value="<?=$clist['add1']?>">
          </div>
          <div class='form-group col-md-6'>
            <input type='text' id='sample2_detailAddress' name='add2' class='form-control' value="<?=$clist['add2']?>">
          </div>
        </div>
        <div class='form-row'>
          <div class='form-group col'>
            <input type='text' id='sample2_extraAddress' name='add3' class='form-control' value="<?=$clist['add3']?>">
          </div>
        </div>
      </div>
      <div id='layer' style='display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;'>
        <img src='//t1.daumcdn.net/postcode/resource/images/close.png' id='btnCloseLayer' style='cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1' onclick='closeDaumPostcode()' alt='닫기 버튼'>
      </div>
      <div class='form-group'>
        <div class='form-row'>
          <p class="mb-1">특이사항</p>
          <input type='text' name='etc' class='form-control' maxlength='47' value="<?=$clist['etc']?>">
        </div>
      </div>
    </div>


    <div class="row justify-content-md-center">
      <button type='button' class='btn btn-danger mr-1' name='btnDelete'>삭제하기</button>
      <button type='submit' class='btn btn-primary mr-1'>수정하기</button>
      <a href='customer.php'><button type='button' class='btn btn-secondary mr-1'><i class="fas fa-angle-double-right"></i> 입주자목록</button></a>
      <a href="/svc/service/contract/contract_add1.php?id=<?=$filtered_id?>"><button type='button' class='btn btn-secondary mr-1'><i class="fas fa-angle-double-right"></i> 신규계약</button></a>
    </div>
  </form>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>


<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/jquery-ui.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>
<script src="/svc/inc/js/datepicker-ko.js"></script>
<script src="/svc/inc/js/jquery.number.min.js"></script>
<script src="/svc/inc/js/etc/form.js?<?=date('YmdHis')?>"></script>


<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script src="/svc/inc/js/daumAddressAPI3.js?<?=date('YmdHis')?>"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })

    $('button[name=btnDelete]').on('click', function(){
      var cid = <?=$filtered_id?>;

      goCategoryPage('customerDelete', 'p_m_c_delete.php', cid);

      function goCategoryPage(a, b, c){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'cid', c);
        formSubmit(frm);
      }

    })
  })
</script>
</body>
</html>
