<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";
?>

<script>
function fnUpload(){
  var extArray = new Array('csv');
  var path = $('#upfile').val();
  console.log(path);

  if(path===""){
    alert('파일을 선택해주세요.');
    return false;
  }

  var pos = path.lastIndexOf(".");
  if(pos < 0){
    alert('확장자가 없는 파일입니다.');
    return false;
  }

  var ext = path.slice(path.lastIndexOf(".")+1).toLowerCase();
  var checkExt = false;
  for (var i = 0; i < extArray.length; i++) {
    if(ext === extArray[i]){
      checkExt = true;
      break;
    }
  }
  // console.log(ext, checkExt);

  if(checkExt === false){
    alert('csv확장자만 업로드 가능합니다.');
    return false;
  }

  var f = $('#uploadForm');
  f.submit();

}  //uploadBtn function closing}
</script>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">CSV파일등록 화면입니다!</h1>
    <p class="lead">이 화면에서는 엑셀업로드형식으로 세입자를 등록합니다. </p>
    <small>(1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다. (2)한번에 등록가능한 세입자는 80명입니다.</small>
    <hr class="my-4">
    <!-- <div class="input-group mb-3">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile02">
        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
      </div>
      <div class="input-group-append">
        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
      </div>
    </div> -->
    <form name="uploadForm" id="uploadForm" method="post" action="m_c_add_csv2.php" enctype="multipart/form-data">
      <label for="">첨부파일</label>
      <input type="file" name="upfile" id="upfile">
      <input type="button" name="uploadBtn" value="업로드" onclick="fnUpload()">
    </form>
  </div>
</section>
<section class="container">
  <div class="example">
    <table class="table table-bordered text-center">
      <tr>
        <td><span id='star' style='color:#F7BE81;'>* </span>구분1</td>
        <td><span id='star' style='color:#F7BE81;'>* </span>구분2</td>
        <td><span id='star' style='color:#F7BE81;'>* </span>성명</td>
        <td><span id='star' style='color:#F7BE81;'>* </span>연락처</td>
        <td>성별</td>
        <td>이메일</td>
        <td>법인사업자구분</td>
        <td>업태</td>
        <td>업종</td>
        <td>사업자명</td>
        <td>사업자번호</td>
        <td>특이사항</td>
      </tr>
      <tr>
        <td>세입자,거래처</td><!--구분1-->
        <td>개인,개인사업자,법인사업자</td><!--구분2-->
        <td></td><!--성명-->
        <td>010-111-1111형식</td><!--연락처-->
        <td>남,여</td><!--성별-->
        <td>@포함해야</td><!--이메일-->
        <td>주식회사,합자회사,유한회사,기타</td><!--법인사업자구분-->
        <td></td><!--업태-->
        <td></td><!--업종-->
        <td></td><!--사업자명-->
        <td>123-12-12345형식</td><!--사업자번호-->
        <td></td><!--특이사항-->
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="12" class="text-left font-weight-light">
          (1) <div class="badge badge-primary text-wrap" style="width: 3rem;">구분1</div> : '세입자','거래처' 중 1개의 값만 넣으세요. 오타/띄어쓰기 오류 등등 안됍니다.(필수값)<br>
          (2) <div class="badge badge-primary text-wrap" style="width: 3rem;">구분2</div> : '개인','개인사업자','법인사업자' 중 1개의 값만 넣으세요. 오타/띄어쓰기 오류 등등 안됍니다.(필수값)<br>
          (3) <div class="badge badge-primary text-wrap" style="width: 3rem;">성명</div> : 자유롭게 적어주는데 보통 사람이름을 적어주세요. 글자수는 20글자로 제한됩니다.<br>
          (4) <div class="badge badge-primary text-wrap" style="width: 3rem;">연락처</div> : '010-1234-1234' 형식으로 넣어주세요. 만약 유선번호일경우 반드시 지역번호 포함하여 '02-111-1234'로 '-'가 2개이며, 숫자만 입력되어야 합니다.<br>
          (5) <div class="badge badge-primary text-wrap" style="width: 3rem;">성별</div> : '남','여' 중 1개의 값만 넣으세요. 오타/띄어쓰기 안됍니다.<br>
          (6) <div class="badge badge-primary text-wrap" style="width: 3rem;">이메일</div> : @를 포함한 이메일형식으로 넣어주세요. 글자수 40글자로 제한됩니다.<br>
          (7) <div class="badge badge-primary text-wrap" style="width: 6rem;">법인사업자구분</div> : '구분2'의 값이 '법인사업자'인 경우, '주식회사','합자회사','유한회사','기타'중 1개의 값만 넣으세요. 오타/띄어쓰기 오류 등등 안됩니다.<br>
          (8) <div class="badge badge-primary text-wrap" style="width: 3rem;">업태</div> : '구분2'의 값이 '개인사업자' 또는 '법인사업자'인 경우, 자유롭게 적어주세요. 글자수는 9글자로 제한됩니다.<br>
          (9) <div class="badge badge-primary text-wrap" style="width: 3rem;">업종</div> : '구분2'의 값이 '개인사업자' 또는 '법인사업자'인 경우, 자유롭게 적어주세요. 글자수는 14글자로 제한됩니다.<br>
          (10) <div class="badge badge-primary text-wrap" style="width: 4rem;">사업자명</div> : '구분2'의 값이 '개인사업자' 또는 '법인사업자'인 경우, 자유롭게 적어주세요. 글자수는 14글자로 제한됩니다.<br>
          (11) <div class="badge badge-primary text-wrap" style="width: 4rem;">사업자번호</div> : '구분2'의 값이 '개인사업자' 또는 '법인사업자'인 경우, 123-12-12345 형식으로 넣어주세요. 이 형식이 아닐경우 오류발생합니다.<br>
          (12) <div class="badge badge-primary text-wrap" style="width: 4rem;">특이사항</div> : 자유롭게 적어주세요. 글자수는 47글자로 제한됩니다.
        </td>
      </tr>
    </table>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
