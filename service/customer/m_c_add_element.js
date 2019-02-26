var div1, div2;

var starEx = "<span id='star' style='color:#F7BE81;'>* </span>";

// var gubun1 = "<div class='container'><div class='form-row'><div class='form-group col-md-4'><label>구분</label></div><div class='form-group col-md-8 text-center'><select id='customer_div1' name='div1' class='form-control' onchange='div1Get();'><option value=''></option><option value='문의고객'>문의고객</option><option value='고객' selected>고객</option><option value='거래처'>거래처</option></select></div></div></div>";

var div3 = "<label>구분</label><br><select name='div3' class='form-control'><option value='주식회사'>주식회사</option><option value='유한회사'>유한회사</option><option value='합자회사'>합자회사</option><option value='기타'>기타</option></select>";

var div4 ="<label>업태</label><input type='text' name='div4' class='form-control' maxlength='9'>";

var div5 ="<label>업종</label><input type='text' name='div5' class='form-control' maxlength='14'>";

var gubun2 = "<div class='form-row' id='idDiv2Large'><div class='form-group col-md-4'><label>구분</label></div><div class='form-group col-md-8 text-center'><select id='idDiv2' name='div2' class='form-control' onchange='div2Get();'><option value=''></option><option value='개인'>개인</option><option value='개인사업자'>개인사업자</option><option value='법인사업자'>법인사업자</option></select></div></div>";

var quest_story = "<label>문의내용</label><input type='text' name='qStory' class='form-control' maxlength='14'>";

var quest_date = "<label>문의일자</label><input type='text' name='qDate' class='form-control' id='datepicker'>";

var contact ="<label>"+ starEx +"연락처</label><div class='form-row'><div class='form group col-md-4'><input type='number' name='contact1' id='contact1' class='form-control' maxlength='3' required oninput='maxlengthCheck(this);'></div><div class='form group col-md-4'><input type='number' name='contact2' id='contact2' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);'></div><div class='form group col-md-4'><input type='number' name='contact3' id='contact3' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);'></div></div>";

var name = "<label>" + starEx + "성명</label><input type='text' name='name' class='form-control' required>";

var gender = "<label>성별</label><br><div class='form-check form-check-inline'><input class='form-check-input' type='radio' name='gender' id='inlineRadio1' value='남'><label class='form-check-label'>남</label></div><div class='form-check form-check-inline'><input class='form-check-input' type='radio' name='gender' id='inlineRadio2' value='여'><label class='form-check-label'>여</label></div>";

var comName = "<label>사업자명</label><input type='text' name='companyname' class='form-control' maxlength='14'>";

var corComName = "<label>"+starEx+"법인사업자명</label><input type='text' name='companyname' class='form-control' maxlength='14'>";

var corBossName = "<label>대표자명</label><input type='text' name='name' class='form-control' maxlength='9'>";

var comNumber ="<label>사업자번호</label><br><div class='form-row'><div class='form group col-md-4'><input type='number' name='companynumber1' class='form-control' maxlength='3' oninput='maxlengthCheck(this);'></div><div class='form group col-md-3'><input type='number' name='companynumber2' class='form-control' maxlength='2' oninput='maxlengthCheck(this);'></div><div class='form group col-md-5'><input type='number' name='companynumber3' class='form-control' maxlength='5' oninput='maxlengthCheck(this);'></div></div>";

var emailSmall ="<label>이메일</label><input type='email' name='email' class='form-control' maxlength='40'>";

var email ="<div class='form-row'><div class='form-group col-md-4'><label>이메일</label></div><div class='form-group col-md-8'><input type='email' name='email' class='form-control' maxlength='40'></div></div>";

// var address ="<div class='form-row'><div class='form-group col-md-4'><label>주소</label></div><div class='form-group col-md-8'><input type='text' name='address' class='form-control'></div></div>";

var address = "<div class='form-group'><div class='form-row'><label>주소</label></div><div class='form-row'><div class='form-group col-md-3'><input type='text' id='sample2_postcode' name='zipcode' placeholder='우편번호' class='form-control' disabled></div><div class='form-group col-md-3'><input type='button' onclick='sample2_execDaumPostcode()' value='우편번호 찾기' class='btn btn-outline-secondary btn-sm'><br></div></div><div class='form-row'><div class='form-group col-md-6'><input type='text' id='sample2_address' placeholder='주소' name='add1' class='form-control'></div><div class='form-group col-md-6'><input type='text' id='sample2_detailAddress' name='add2' placeholder='상세주소' class='form-control'></div></div><div class='form-row'><div class='form-group col'><input type='text' id='sample2_extraAddress' name='add3' placeholder='참고항목' class='form-control'></div></div></div><div id='layer' style='display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;'><img src='//t1.daumcdn.net/postcode/resource/images/close.png' id='btnCloseLayer' style='cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1' onclick='closeDaumPostcode()' alt='닫기 버튼'></div>";

var etc ="<div class='form-group'><div class='form-row'><label>특이사항</label><input type='text' name='etc' class='form-control' maxlength='47'></div></div>";

var municom = "<div class='form-row'><div class='form-group col-md-4'>"+contact+"</div><div class='form-group col-md-4'>"+quest_story+"</div><div class='form-group col-md-4'>"+quest_date+"</div></div>";

var gaein = "<div class='form-row'><div class='form-group col-md-4'>"+name+"</div><div class='form-group col-md-5'>"+contact+"</div><div class='form-group col-md-3'>"+gender+"</div></div>";

var gaein_company1 = "<div class='form-row'><div class='form-group col-md-3'>"+name+"</div><div class='form-group col-md-4'>"+comName+"</div><div class='form-group col-md-5'>"+contact+"</div></div>";//개인사업자 첫번째라인, 성명/사업자명/연락처

var gaein_company2 = "<div class='form-row'><div class='form-group col-md-5'>"+comNumber+"</div><div class='form-group col-md-3'>"+div4+"</div><div class='form-group col-md-4'>"+div5+"</div></div>";//개인사업자 두번째라인, 사업자번호/업태/업종

var gaein_company3 = "<div class='form-row'><div class='form-group col-md-4'>"+gender+"</div><div class='form-group col-md-8'>"+emailSmall+"</div></div>";//개인사업자 세번째라인, 성별/이메일

var corporate_company1 = "<div class='form-row'><div class='form-group col-md-4'>"+div3+"</div><div class='form-group col-md-4'>"+corComName+"</div><div class='form-group col-md-4'>"+corBossName+"</div></div>";//법인사업자 첫번째라인, 구분/사업자명/대표자명

var corporate_company2 = "<div class='form-row'><div class='form-group col-md-6'>"+comNumber+"</div><div class='form-group col-md-3'>"+div4+"</div><div class='form-group col-md-3'>"+div5+"</div></div>";//법인사업자 두번째라인, 사업자번호/업태/업종

var corporate_company3 = "<div class='form-row'><div class='form-group col-md-6'>"+contact+"</div><div class='form-group col-md-6'>"+emailSmall+"</div></div>";//법인사업자 세번째라인, 연락처/이메일

var case1 = gaein + email + address + etc; // (디폴트 값) 고객, 개인

var case2 = municom + etc; //문의고객

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

//주소 api 시작
// 우편번호 찾기 화면을 넣을 element
// var element_layer = document.getElementById('layer');

// function closeDaumPostcode() {
//     // iframe을 넣은 element를 안보이게 한다.
//     element_layer.style.display = 'none';
// }

// function sample2_execDaumPostcode() {
//     new daum.Postcode({
//         oncomplete: function(data) {
//             // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
//
//             // 각 주소의 노출 규칙에 따라 주소를 조합한다.
//             // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
//             var addr = ''; // 주소 변수
//             var extraAddr = ''; // 참고항목 변수
//
//             //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
//             if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
//                 addr = data.roadAddress;
//             } else { // 사용자가 지번 주소를 선택했을 경우(J)
//                 addr = data.jibunAddress;
//             }
//
//             // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
//             if(data.userSelectedType === 'R'){
//                 // 법정동명이 있을 경우 추가한다. (법정리는 제외)
//                 // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
//                 if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
//                     extraAddr += data.bname;
//                 }
//                 // 건물명이 있고, 공동주택일 경우 추가한다.
//                 if(data.buildingName !== '' && data.apartment === 'Y'){
//                     extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
//                 }
//                 // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
//                 if(extraAddr !== ''){
//                     extraAddr = ' (' + extraAddr + ')';
//                 }
//                 // 조합된 참고항목을 해당 필드에 넣는다.
//                 document.getElementById("sample2_extraAddress").value = extraAddr;
//
//             } else {
//                 document.getElementById("sample2_extraAddress").value = '';
//             }
//
//             // 우편번호와 주소 정보를 해당 필드에 넣는다.
//             document.getElementById('sample2_postcode').value = data.zonecode;
//             document.getElementById("sample2_address").value = addr;
//             // 커서를 상세주소 필드로 이동한다.
//             document.getElementById("sample2_detailAddress").focus();
//
//             // iframe을 넣은 element를 안보이게 한다.
//             // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
//             element_layer.style.display = 'none';
//         },
//         width : '100%',
//         height : '100%',
//         maxSuggestItems : 5
//     }).embed(element_layer);
//
//     // iframe을 넣은 element를 보이게 한다.
//     element_layer.style.display = 'block';
//
//     // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
//     initLayerPosition();
// }

    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
// function initLayerPosition(){
//     var width = 300; //우편번호서비스가 들어갈 element의 width
//     var height = 400; //우편번호서비스가 들어갈 element의 height
//     var borderWidth = 5; //샘플에서 사용하는 border의 두께
//
//     // 위에서 선언한 값들을 실제 element에 넣는다.
//     element_layer.style.width = width + 'px';
//     element_layer.style.height = height + 'px';
//     element_layer.style.border = borderWidth + 'px solid';
//     // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
//     element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
//     element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
// }
//주소 api 끝.

// <input type="text" name="MOBILE_NO" id="MOBILE_NO"  maxlength="13" />
