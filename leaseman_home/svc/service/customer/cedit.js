var div1, div2;

var starEx = "<span id='star' style='color:#F7BE81;'>* </span>";

var div3 = "<label>구분</label><br><select name='div3' class='form-control'><option value='주식회사'>주식회사</option><option value='유한회사'>유한회사</option><option value='합자회사'>합자회사</option><option value='기타'>기타</option></select>";

var div4 ="<label>업태</label><input type='text' name='div4' class='form-control' maxlength='9'>";

var div5 ="<label>업종</label><input type='text' name='div5' class='form-control' maxlength='14'>";

var gubun2 = "<div class='form-row' id='idDiv2Large'><div class='form-group col-md-4'><label>구분</label></div><div class='form-group col-md-8 text-center'><select id='idDiv2' name='div2' class='form-control' onchange='div2Get();'><option value=''></option><option value='개인'>개인</option><option value='개인사업자'>개인사업자</option><option value='법인사업자'>법인사업자</option></select></div></div>";

var quest_date = "<label>문의일자</label><input type='text' name='qDate' class='form-control' id='datepicker'>";

var contact ="<label>"+ starEx +"연락처</label><div class='form-row'><div class='form group col-md-4'><input type='number' name='contact1' id='contact1' class='form-control' maxlength='3' required oninput='maxlengthCheck(this);'></div><div class='form group col-md-4'><input type='number' name='contact2' id='contact2' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);'></div><div class='form group col-md-4'><input type='number' name='contact3' id='contact3' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);'></div></div>";

var name = "<label>" + starEx + "성명</label><input type='text' name='name' class='form-control' required maxlength='9' onmouseout='addCheck(this.value);'>";

var gender = "<label>성별</label><br><div class='form-check form-check-inline'><input class='form-check-input' type='radio' name='gender' id='inlineRadio1' value='남'><label class='form-check-label'>남</label></div><div class='form-check form-check-inline'><input class='form-check-input' type='radio' name='gender' id='inlineRadio2' value='여'><label class='form-check-label'>여</label></div>";

var comName = "<label>사업자명</label><input type='text' name='companyname' class='form-control' maxlength='14'>";

var corComName = "<label>"+starEx+"법인사업자명</label><input type='text' name='companyname' class='form-control' maxlength='14'>";

var corBossName = "<label>대표자명</label><input type='text' name='name' class='form-control' maxlength='9'>";

var comNumber ="<label>사업자번호</label><br><div class='form-row'><div class='form group col-md-4'><input type='number' name='cNumber1' class='form-control' maxlength='3' oninput='maxlengthCheck(this);'></div><div class='form group col-md-3'><input type='number' name='cNumber2' class='form-control' maxlength='2' oninput='maxlengthCheck(this);'></div><div class='form group col-md-5'><input type='number' name='cNumber3' class='form-control' maxlength='5' oninput='maxlengthCheck(this);'></div></div>";

var emailSmall ="<label>이메일</label><input type='email' name='email' class='form-control' maxlength='40'>";

var email ="<div class='form-row'><div class='form-group col-md-4'><label>이메일</label></div><div class='form-group col-md-8'><input type='email' name='email' class='form-control' maxlength='40'></div></div>";

// var address ="<div class='form-row'><div class='form-group col-md-4'><label>주소</label></div><div class='form-group col-md-8'><input type='text' name='address' class='form-control'></div></div>";

var address = "<div class='form-group'><div class='form-row'><label>주소</label></div><div class='form-row'><div class='form-group col-md-3'><input type='text' id='sample2_postcode' name='zipcode' placeholder='우편번호' class='form-control' disabled></div><div class='form-group col-md-3'><input type='button' onclick='sample2_execDaumPostcode()' value='우편번호 찾기' class='btn btn-outline-secondary btn-sm'><br></div></div><div class='form-row'><div class='form-group col-md-6'><input type='text' id='sample2_address' placeholder='주소' name='add1' class='form-control'></div><div class='form-group col-md-6'><input type='text' id='sample2_detailAddress' name='add2' placeholder='상세주소' class='form-control'></div></div><div class='form-row'><div class='form-group col'><input type='text' id='sample2_extraAddress' name='add3' placeholder='참고항목' class='form-control'></div></div></div><div id='layer' style='display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;'><img src='//t1.daumcdn.net/postcode/resource/images/close.png' id='btnCloseLayer' style='cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1' onclick='closeDaumPostcode()' alt='닫기 버튼'></div>";

var etc ="<div class='form-group'><div class='form-row'><label>특이사항</label><input type='text' name='etc' class='form-control' maxlength='47'></div></div>";

var etcq ="<div class='form-group'><div class='form-row'><label>문의내용</label><input type='text' name='etc' class='form-control' maxlength='47'></div></div>";

var municom = "<div class='form-row'><div class='form-group col-md-8'>"+contact+"</div><div class='form-group col-md-4'>"+quest_date+"</div></div>";

var gaein = "<div class='form-row'><div class='form-group col-md-4'>"+name+"</div><div class='form-group col-md-5'>"+contact+"</div><div class='form-group col-md-3'>"+gender+"</div></div>";

var gaein_company1 = "<div class='form-row'><div class='form-group col-md-3'>"+name+"</div><div class='form-group col-md-4'>"+comName+"</div><div class='form-group col-md-5'>"+contact+"</div></div>";//개인사업자 첫번째라인, 성명/사업자명/연락처

var gaein_company2 = "<div class='form-row'><div class='form-group col-md-5'>"+comNumber+"</div><div class='form-group col-md-3'>"+div4+"</div><div class='form-group col-md-4'>"+div5+"</div></div>";//개인사업자 두번째라인, 사업자번호/업태/업종

var gaein_company3 = "<div class='form-row'><div class='form-group col-md-4'>"+gender+"</div><div class='form-group col-md-8'>"+emailSmall+"</div></div>";//개인사업자 세번째라인, 성별/이메일

var corporate_company1 = "<div class='form-row'><div class='form-group col-md-4'>"+div3+"</div><div class='form-group col-md-4'>"+corComName+"</div><div class='form-group col-md-4'>"+corBossName+"</div></div>";//법인사업자 첫번째라인, 구분/사업자명/대표자명

var corporate_company2 = "<div class='form-row'><div class='form-group col-md-6'>"+comNumber+"</div><div class='form-group col-md-3'>"+div4+"</div><div class='form-group col-md-3'>"+div5+"</div></div>";//법인사업자 두번째라인, 사업자번호/업태/업종

var corporate_company3 = "<div class='form-row'><div class='form-group col-md-6'>"+contact+"</div><div class='form-group col-md-6'>"+emailSmall+"</div></div>";//법인사업자 세번째라인, 연락처/이메일

var case1 = gaein + email + address + etc; // (디폴트 값) 고객, 개인

var case2 = municom + etcq; //문의고객

var case3 = gaein_company1 + gaein_company2 + gaein_company3 + address + etc; //고객, 개인사업자

var case4 = corporate_company1 + corporate_company2 + corporate_company3 + address + etc; //고객, 법인사업자

function div1Get(){
  div1 = $('#customer_div1').val();
  return case_all(div1);

  function case_all(x){
    if(x === '문의고객'){
      $("#idDiv2Large").empty();
      $('#centerSection').empty();
      $('#centerSection').html(case2);
    } else {
      $("#idDiv2Large").empty();
      $("#gubun2Id").html(gubun2);
      $('#centerSection').empty();
    }
  }
} //구분1의 값이 바뀔때 바뀐 값을 가져옴

function div2Get(){
  div2 = $('#idDiv2').val();
  return case_all(div2);

  function case_all(x){
    if(x === '개인'){
      $('#centerSection').empty();
      $('#centerSection').html(case1);
    } else if(x==='개인사업자') {
      $('#centerSection').empty();
      $('#centerSection').html(case3);
    } else if(x==='법인사업자'){
      $('#centerSection').empty();
      $('#centerSection').html(case4);
    }
  }
}

$(document).ready(function print_default(){
  $("#centerSection").html(case1);
});//고객등록페이지로딩되면 자동으로 고객/개인 입력창이 실행됨

function maxlengthCheck(object){
  if(object.value.length > object.maxLength){
    object.value = object.value.slice(0, object.maxLength);
  }
}//숫자 입력개수 제한하는 함수, 연락처1,2,3/사업자번호에 사용됨
