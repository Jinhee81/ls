//곧지울예정
var div1, div2, cc, case1, case2, case3, case4;

$(document).ready(function(){
  div1 = $('#div1').val();
  // console.log(div1);
});

function div1Get(){
  div1 = $('#div1').val();
  if(div1==='문의'){
    $('#div2').attr('disabled','').val('');
  } else {
    $('#div2').removeAttr('disabled');
  }
  return div1;
} //구분1의 값이 바뀔때 바뀐 값을 가져옴

function div2Get(){
  div2 = $('#div2').val();
  return div2;
}

function getCount(obj){
  cc = Number(obj);
  // console.log(cc);
  return calcu(cc);

  function calcu(cc){
    var tHead, tBody;//문의고객 변수

    var starEx = "<span id='star' style='color:#F7BE81;'>* </span>";

    tHead = "<table class='table table-bordered text-center'><tr><td style='width:6%'>순번</td><td style='width:37%'>"+starEx+"연락처</td><td style='width:37%'>"+starEx+"문의사항</td><td style='width:20%'>문의일자</td></tr>";//문의고객제목

    for (var i = 1; i <= cc; i++) {
      // i=i; 11이 되면 바로 빠져나가게하고싶은데 어떻게 할까??
      tBody += "<tr><td style='padding-top: 18px;'>"+i+"</td>";//순번
      tBody += "<td><div class='form-row'><div class='form-group col mb-0'><input type='number' maxlength='3' name='contact1"+i+"' class='form-control text-center' oninput='maxlengthCheck(this);' required></div><div class='form-group col mb-0'><input type='number' maxlength='4' name='contact2"+i+"' class='form-control text-center' oninput='maxlengthCheck(this);' required></div><div class='form-group col mb-0'><input type='number' maxlength='4' name='contact3"+i+"' class='form-control text-center' oninput='maxlengthCheck(this);' required></div></div></td>";//연락처
      tBody += "<td><input type='text' name='etc"+i+"' class='form-control text-center' required></td>";//문의사항
      tBody += "<td><input type='number' name='qDate"+i+"' class='form-control text-center' id='datepicker'></td></tr>";//날짜
    }//문의고객내용

    case1 = tHead + tBody; //문의 케이스

    // ========================================================================
    var indiHead, indiBody; //개인 변수

    indiHead = "<tr><td style='width:6%'>순번</td><td style='width:20%'>"+starEx+"성명</td><td style='width:30%'>"+starEx+"연락처</td><td style='width:22%'>이메일</td><td style='width:22%'>특이사항</td></tr>";

    for (var i = 1; i <= cc; i++){
      indiBody += "<tr><td style='padding-top: 18px;'>"+i+"</td>";
      indiBody += "<td><input type='text' name='name"+i+"' class='form-control text-center' maxlength='9' required></td>";//성명
      indiBody += "<td><div class='form-row'><div class='form-group col mb-0'><input type='number' name='contact1"+i+"' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);' required></div><div class='form-group col mb-0'><input type='number' name='contact2"+i+"' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);' required></div><div class='form-group col mb-0'><input type='number' name='contact3"+i+"' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);' required></div></div></td>";//연락처
      indiBody += "<td><input type='email' name='email"+i+"' class='form-control text-center' maxlength='40'></td>";//이메일
      indiBody += "<td><input type='text' name='etc"+i+"' class='form-control text-center' maxlength='40'></td></tr>";//특이사항
    }

    case2 = indiHead + indiBody; //개인케이스
    //
    //  ========================================================================
    //
    var indiComHead, indiComBody; //개인사업자 변수

    indiComHead=
      "<tr><td style='width:5%'>순번</td><td style='width:15%'>"+starEx+"성명</td><td style='width:15%'>개인사업자명</td><td style='width:25%'>"+starEx+"연락처</td><td style='width:25%'>사업자번호</td><td style='width:20%'>이메일</td></tr>";

    for (var i = 1; i <= cc; i++){
      indiComBody +=
        "<tr><td style='padding-top: 18px;'>"+i+"</td>";
      indiComBody +=
        "<td><input type='text' name='name"+i+"' class='form-control text-center' maxlength='9' required></td>";
      indiComBody +=
        "<td><input type='text' name='companyname"+i+"' class='form-control text-center' maxlength='14'></td>";//개인사업자명
      indiComBody +=
        "<td><div class='form-row'><div class='form-group col mb-0'><input type='number' name='contact1"+i+"' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);' required></div><div class='form-group col mb-0'><input type='number' name='contact2"+i+"' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);' required></div><div class='form-group col mb-0'><input type='number' name='contact3"+i+"' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);' required></div></div></td>";//연락처
      indiComBody +=
        "<td><div class='form-row'><div class='form-group col-md-4 mb-0'><input type='number' name='cNumber1"+i+"' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);'></div><div class='form-group col-md-3 mb-0'><input type='number' name='cNumber2"+i+"' class='form-control text-center' maxlength='2' oninput='maxlengthCheck(this);'></div><div class='form-group col-md-5 mb-0'><input type='number' name='cNumber3"+i+"' class='form-control text-center' maxlength='5' oninput='maxlengthCheck(this);'></div></div></td>";//사업자번호
      indiComBody +=
        "<td><input type='email' name='email"+i+"' class='form-control text-center' maxlength='40'></td></tr>";
    }

    case3 = indiComHead + indiComBody; //개인사업자 케이스

    // // ========================================================================
    //
    var corHead, corBody; //법인 변수

    corHead="<tr><td style='width:5%'>순번</td><td style='width:8%'>구분</td><td style='width:20%'>"+starEx+"법인사업자명</td><td style='width:28%'>"+starEx+"연락처</td><td style='width:12%'>대표자명</td><td style='width:27%'>사업자번호</td></tr>";

    for (var i = 1; i <= cc; i++){
      corBody += "<tr><td style='padding-top: 18px;'>"+i+"</td>";
      corBody += "<td><select name='div3"+i+"' class='form-control' onchange='div1Get();'><option value='주식회사' selected>(주)</option><option value='유한회사'>(유)</option><option value='합자회사'>(합)</option><option value='기타'>(기)</option></select></td>";//구분
      corBody += "<td><input type='text' name='companyname"+i+"' class='form-control text-center' maxlength='14' required></td>";//법인사업자명
      corBody += "<td><div class='form-row'><div class='form-group col mb-0'><input type='number' name='contact1"+i+"' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);' required></div><div class='form-group col mb-0'><input type='number' name='contact2"+i+"' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);' required></div><div class='form-group col mb-0'><input type='number' name='contact3"+i+"' class='form-control text-center' maxlength='4' oninput='maxlengthCheck(this);' required></div></div></td>";//연락처
      corBody += "<td><input type='text' name='name"+i+"' class='form-control text-center' maxlength='9'></td>";//대표자명
      corBody += "<td><div class='form-row'><div class='form-group col-md-4 mb-0'><input type='number' name='cNumber1"+i+"' class='form-control text-center' maxlength='3' oninput='maxlengthCheck(this);'></div><div class='form-group col-md-3 mb-0'><input type='number' name='cNumber2"+i+"' class='form-control text-center' maxlength='2' oninput='maxlengthCheck(this);'></div><div class='form-group col-md-5 mb-0'><input type='number' name='cNumber3"+i+"' class='form-control text-center' maxlength='5' oninput='maxlengthCheck(this);'></div></div></td></tr>";//사업자번호
    }

    case4 = corHead + corBody; //법인 케이스

    // ========================================================================
  }
}


function printOut(){
  if(div1 ==='문의'){
    $('#centerSection').html(case1);
    $('.bolowButtons').html(bbs);
    console.log('문의');
  } else {
    if(div2 === '개인'){
      $('#centerSection').html(case2);
      $('.bolowButtons').html(bbs);
    } else if(div2==='개인사업자') {
      $('#centerSection').html(case3);
      $('.bolowButtons').html(bbs);
    } else if(div2==='법인사업자'){
      $('#centerSection').html(case4);
      $('.bolowButtons').html(bbs);
    }
  }
  // console.log(div1, div2, cc);
}


var bbs ="<div><button type='submit' class='btn btn-primary mr-1'>저장</button><a href='customer.php'><button type='button' class='btn btn-secondary'>세입자리스트화면으로</button></a></div>";




//
// $(document).ready(function print_default(){
//   $("#centerSection").html(case1);
// });//고객등록페이지로딩되면 자동으로 고객/개인 입력창이 실행됨
//
function maxlengthCheck(object){
  if(object.value.length > object.maxLength){
    object.value = object.value.slice(0, object.maxLength);
  }
}//숫자 입력개수 제한하는 함수, 연락처1,2,3/사업자번호에 사용됨

function pick(){
  console.log('hello');
  datepicker({
          "setDate": new Date(),
          "autoclose": true
  });
}

function defaultCenterSection(){
  console.log('default');
}

// $('#datepicker').datepicker({
//         "setDate": new Date(),
//         "autoclose": true
// });

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
