<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
// print_r($_FILES);

if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] !== ""){
  $file = $_FILES['upfile'];
  $max_file_size = 5242880;

  if($file['size'] >= $max_file_size){
    echo "<script>alert('5MB 까지만 업로드 가능합니다.');</script>";
  }

  $handle = fopen($file['tmp_name'], 'r');?>
  <style>
  .fixed-table-body{
    /* width: 100%;
    height: 100%; */
    overflow-x: auto;
  }
  </style>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1 class="display-4">업로드한 파일 내용입니다.</h1>
      <!-- <p class="lead">이 화면에서는 한꺼번에 많은 방계약들을 등록합니다.</p> -->
      <small>(1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다. (2)잘못 입력된 내용은 글자색이 빨간색이니 주의하세요.</small>
      <hr class="my-4">
      <small>
        (1) <div class="badge badge-primary text-wrap" style="width: 3rem;">구분1</div> : '세입자','거래처' 중 1개의 값만 넣으세요. 오타/띄어쓰기 오류 등등 안됍니다.(필수값)<br>
        (2) <div class="badge badge-primary text-wrap" style="width: 3rem;">구분2</div> : '개인','개인사업자','법인사업자' 중 1개의 값만 넣으세요. 오타/띄어쓰기 오류 등등 안됍니다.(필수값)<br>
        (3) <div class="badge badge-primary text-wrap" style="width: 3rem;">성명</div> : 자유롭게 적어주는데 보통 사람이름을 적어주세요. 글자수는 9글자로 제한됩니다.<br>
        (4) <div class="badge badge-primary text-wrap" style="width: 3rem;">연락처</div> : '010-1234-1234' 형식으로 넣어주세요. 만약 유선번호일경우 반드시 지역번호 포함하여 '02-111-1234'로 '-'가 2개이며, 숫자만 입력되어야 합니다.<br>
        (5) <div class="badge badge-primary text-wrap" style="width: 3rem;">성별</div> : '남','여' 중 1개의 값만 넣으세요. 오타/띄어쓰기 안됍니다.<br>
        (6) <div class="badge badge-primary text-wrap" style="width: 3rem;">이메일</div> : @를 포함한 이메일형식으로 넣어주세요. 글자수 40글자로 제한됩니다.<br>
        (7) <div class="badge badge-primary text-wrap" style="width: 6rem;">법인사업자구분</div> : '구분2'의 값이 '법인사업자'인 경우, '주식회사','합자회사','유한회사','기타'중 1개의 값만 넣으세요. 오타/띄어쓰기 오류 등등 안됩니다.<br>
        (8) <div class="badge badge-primary text-wrap" style="width: 3rem;">업태</div> : '구분2'의 값이 '개인사업자' 또는 '법인사업자'인 경우, 자유롭게 적어주세요. 글자수는 9글자로 제한됩니다.<br>
        (9) <div class="badge badge-primary text-wrap" style="width: 3rem;">업종</div> : '구분2'의 값이 '개인사업자' 또는 '법인사업자'인 경우, 자유롭게 적어주세요. 글자수는 14글자로 제한됩니다.<br>
        (10) <div class="badge badge-primary text-wrap" style="width: 4rem;">사업자명</div> : '구분2'의 값이 '개인사업자' 또는 '법인사업자'인 경우, 자유롭게 적어주세요. 글자수는 14글자로 제한됩니다.<br>
        (11) <div class="badge badge-primary text-wrap" style="width: 4rem;">사업자번호</div> : '구분2'의 값이 '개인사업자' 또는 '법인사업자'인 경우, 123-12-12345 형식으로 넣어주세요. 이 형식이 아닐경우 오류발생합니다.<br>
        (12) <div class="badge badge-primary text-wrap" style="width: 4rem;">특이사항</div> : 자유롭게 적어주세요. 글자수는 47글자로 제한됩니다.
      </small>
    </div>
    <form method="post" action="p_cfile_upload_csv.php">
    <div class="fixed-table-container">
      <div class="fixed-table-body">
        <table class="table table-bordered text-center" fixed-header id="customerTable">
          <tr>
            <td width="5%"><span id='star' style='color:#F7BE81;'>* </span>구분1</td>
            <td width="5%"><span id='star' style='color:#F7BE81;'>* </span>구분2</td>
            <td width="6%"><span id='star' style='color:#F7BE81;'>* </span>성명</td>
            <td width="10%"><span id='star' style='color:#F7BE81;'>* </span>연락처</td>
            <td width="5%">성별</td>
            <td width="14%">이메일</td>
            <td width="8%">법인사업자<br>구분</td>
            <td width="6%">업태</td>
            <td width="6%">업종</td>
            <td width="10%">사업자명</td>
            <td width="10%">사업자번호</td>
            <td width="10%">특이사항</td>
            <td width="5%"></td>
          </tr>
          <?php
            $i = 1;
            while($data = fgetcsv($handle)){
              ?>
            <tr>
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div1" name="<?=$i?>div1" value="<?=$data[0]?>" required></td><!--구분1-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div2" name="<?=$i?>div2" value="<?=$data[1]?>" required></td><!--구분2-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center name" name="<?=$i?>name" value="<?=$data[2]?>" required maxLength="9"></td><!--성명-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center contact" name="<?=$i?>contact" value="<?=$data[3]?>" required></td><!--연락처-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center gender" name="<?=$i?>gender" value="<?=$data[4]?>"></td><!--성별-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="email" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center email" name="<?=$i?>email" value="<?=$data[5]?>" maxLength="40"></td><!--이메일-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div3" name="<?=$i?>div3" value="<?=$data[6]?>"></td><!--법인사업자구분-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div4" name="<?=$i?>div4" value="<?=$data[7]?>" maxLength="9"></td><!--업태-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center div5" name="<?=$i?>div5" value="<?=$data[8]?>" maxLength="14"></td><!--업종-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center companyname" name="<?=$i?>companyname" value="<?=$data[9]?>" maxLength="14"></td><!--사업자명-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center companyNumber" name="<?=$i?>companyNumber" value="<?=$data[10]?>"></td><!--사업자번호-->
              <td class="pl-1 pr-1 pt-1 pb-1"><input type="text" class="form-control form-control-sm pl-1 pr-1 pt-1 pb-1 text-center etc" name="<?=$i?>etc" value="<?=$data[11]?>" maxLength="47"></td><!--특이사항-->
              <td class="pl-1 pr-1 pt-2 pb-1">
                <img src="/img/svg/minus.svg" width="20" name="minus">
              </td><!--행추가/삭제-->
            </tr>
          <?php
          $i = $i + 1;
        }
          ?>
        </table>
      </div>
      <div class="d-flex justify-content-center">
        <!-- <button type="button" name="chkBtn" class="btn btn-warning mr-1">중복체크</button> -->
        <button type="button" name="saveBtn" class="btn btn-primary mr-1">세입자등록</button>
        <a href="m_c_add_csv1.php"><button type="button" name="button" class="btn btn-secondary mr-1">csv파일등록</button></a>
      </div>
    </div>
  </form>

  </div>
<?php
}
?>
<script>
var customerTable = $('#customerTable');
var div1 = ['세입자', '거래처'];
var div2 = ['개인', '개인사업자', '법인사업자'];
var gender = ['남', '여'];
var div3 = ['', '주식회사', '유한회사', '합자회사', '기타'];
var conclude = 0; //0이 정상, 1이 오류.
var errorVal; //여기에 에러값을 넣음

$(document).ready(function(){
    $(".div1:input", customerTable).each(function(){
      var div11 = $(this).val();
      if(div1.indexOf(div11) === -1){
        $(this).css('color', 'red');
        conclude = 1;
        errorVal = div11;
      }
    })

    $(".div2:input", customerTable).each(function(){
      var div21 = $(this).val();
      if(div2.indexOf(div21) === -1){
        $(this).css('color', 'red');
        conclude = 1;
        errorVal = div21;
      }
    })

    $(".gender:input", customerTable).each(function(){
      var gender1 = $(this).val();
      if(gender.indexOf(gender1) === -1){
        $(this).css('color', 'red');
        conclude = 1;
        errorVal = gender1;
      }
    })

    $(".div3:input", customerTable).each(function(){
      var div31 = $(this).val();
      if(div3.indexOf(div31) === -1){
        $(this).css('color', 'red');
        conclude = 1;
        errorVal = div31;
      }
    })

    $(".contact:input", customerTable).each(function(){
      var contact1 = $(this).val();
      var contact2 = contact1.split('-');
      // console.log(contact2);
      if((Number(contact2[0]) && contact2[0].length<4) &&
         (Number(contact2[1]) && contact2[1].length<=4) &&
         (Number(contact2[2]) && contact2[2].length<=4))
      {

      } else {
        $(this).css('color', 'red');
        conclude = 1;
        errorVal = contact1;
      }
    })

    $(".companyNumber:input", customerTable).each(function(){
      var companyNumber1 = $(this).val();
      var companyNumber2 = companyNumber1.split('-');
      // console.log(contact2);
      if((Number(companyNumber2[0]) && companyNumber2[0].length===3) &&
         (Number(companyNumber2[1]) && companyNumber2[1].length===2) &&
         (Number(companyNumber2[2]) && companyNumber2[2].length===5))
      {

      } else {
        $(this).css('color', 'red');
        conclude = 1;
        errorVal = companyNumber1;
      }
    })
})//document.ready function closing}

$(".div1:input", customerTable).on('change', function(){
  var div11 = $(this).val();
  if(div1.indexOf(div11) === -1){
    $(this).css('color', 'red');
    conclude = 1;
    // errorVal = div11;
  } else {
    $(this).css('color', '#495057');
    conclude = 0;
  }
})
$(".div2:input", customerTable).on('change', function(){
  var div21 = $(this).val();
  if(div2.indexOf(div21) === -1){
    $(this).css('color', 'red');
    conclude = 1;
    // errorVal = div21;
  } else {
    $(this).css('color', '#495057');
    conclude = 0;
  }
})
$(".div3:input", customerTable).on('change', function(){
  var div31 = $(this).val();
  if(div3.indexOf(div31) === -1){
    $(this).css('color', 'red');
    conclude = 1;
    // errorVal = div31;
  } else {
    $(this).css('color', '#495057');
    conclude = 0;
  }
})
$(".gender:input", customerTable).on('change', function(){
  var gender1 = $(this).val();
  if(gender.indexOf(gender1) === -1){
    $(this).css('color', 'red');
    conclude = 1;
    // errorVal = gender1;
  } else {
    $(this).css('color', '#495057');
    conclude = 0;
  }
})
$(".contact:input", customerTable).on('change', function(){
  var contact1 = $(this).val();
  var contact2 = contact1.split('-');
  // console.log(contact2);
  if((Number(contact2[0]) && contact2[0].length<4) &&
     (Number(contact2[1]) && contact2[1].length<=4) &&
     (Number(contact2[2]) && contact2[2].length<=4))
  {
    $(this).css('color', '#495057');
    conclude = 0;
  } else {
    $(this).css('color', 'red');
    conclude = 1;
    // errorVal = contact1;
  }
})
$(".companyNumber:input", customerTable).on('change', function(){
  var companyNumber1 = $(this).val();
  var companyNumber2 = companyNumber1.split('-');
  // console.log(contact2);
  if((Number(companyNumber2[0]) && companyNumber2[0].length===3) &&
     (Number(companyNumber2[1]) && companyNumber2[1].length===2) &&
     (Number(companyNumber2[2]) && companyNumber2[2].length===5))
  {
    $(this).css('color', '#495057');
    conclude = 0;
  } else {
    $(this).css('color', 'red');
    conclude = 1;
    // errorVal = companyNumber1;
  }
})

$('img[name="minus"]').on('click', function(){
  // console.log('삭제하기');
  var deleteCheck = confirm('정말 삭제하겠습니까?');
  if(deleteCheck){
    var currow = $(this).closest('tr');
    conclude = 0;
    currow.remove();
    alert('삭제하였습니다');
  }
})

$('button[name="saveBtn"]').on('click', function(){
  if(conclude===1){
    alert(errorVal + '잘못된값이 포함되어 세입자등록을 할 수 없습니다.');
  } else {
    $('form').submit();
  }
})

</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>
