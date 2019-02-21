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
$(function(){
  $("#date1").datepicker({
    changeMonth : true,
    changeYear : true,
    yearRange: 'c-100:c',
    showButtonPannel: true,
    currentText: '오늘',
    closeText: '닫기',
    nextText: '다음달',
    prevText: '이전달'
  });
});
</script>
<script>
$(document).ready(function () {
   $(function () {

            $('#MOBILE_NO').keydown(function (event) {
             var key = event.charCode || event.keyCode || 0;
             $text = $(this);
             if (key !== 8 && key !== 9) {
                 if ($text.val().length === 3) {
                     $text.val($text.val() + '-');
                 }
                 if ($text.val().length === 7) {
                     $text.val($text.val() + '-');
                 }
                 if ($text.val().length === 8) {
                     $text.val($text.val() + '-');
                 }
             }

             return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
			 // Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
			 // 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
         })
   });

});
</script>
<section class="container">
  <div class="jumbotron">
    <h1 class="display-4">고객등록 화면입니다!</h1>
    <p class="lead">고객이란 입주한 세입자 및 문의하는 문의고객, 거래처 등을 포함합니다. 고객등록이 되어야 임대계약 등록이 가능합니다!</p>
  </div>
</section>
<section class="container" style="max-width:700px;">
  <form method="post" action =".php"> <!--문의고객 입력-->
    <div class="form-group">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>구분</label>
        </div>
        <div class="form-group col-md-8 text-center">
          <select id="customer_div1" name="c_div1" class="form-control" onchange="div1Get();">
            <option value="문의고객">문의고객</option>
            <option value="진행고객" selected>고객</option>
            <option value="거래처">거래처</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <label>연락처</label>
          <input type="text" name="c_contact" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label>문의내용</label>
          <input type="text" name="c_question" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label>문의일자</label>
          <div class="form-row">
            <div class="form-group col-md-9">
              <input type="text" name="c_q_date" class="form-control" id="date1">
            </div>
            <div class="form-group col-md-3">
              <span><img src="/img/calendar.svg" id="date1"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col">
          <label for="inputEmail5">특이사항</label>
          <input type="text" name="c_etc" class="form-control">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">저장</button>
    </div>
  </form>

  <form method="post" action =".php"> <!--고객, 개인 입력-->
    <div class="form-group">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>구분</label>
        </div>
        <div class="form-group col-md-8 text-center">
          <select name="c_div1" class="form-control">
            <option value="문의고객">문의고객</option>
            <option value="진행고객" selected>고객</option>
            <option value="거래처">거래처</option>
          </select>
        </div>
      </div>

    </div>
  </form>

  <form method="post" action =".php"> <!--고객, 개인사업자 입력-->
    <div class="form-group">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>구분</label>
        </div>
        <div class="form-group col-md-8 text-center">
          <select name="c_div1" class="form-control">
            <option value="문의고객">문의고객</option>
            <option value="진행고객" selected>고객</option>
            <option value="거래처">거래처</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>구분</label>
        </div>
        <div class="form-group col-md-8 text-center">
          <select name="c_div2" class="form-control">
            <option value="문의고객">개인</option>
            <option value="진행고객" selected>개인사업자</option>
            <option value="거래처">법인사업자</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputEmail4">성명</label>
          <input type="text" name="c_name" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label>사업자명</label>
          <input type="text" name="c_companyname" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label>사업자번호</label>
          <input type="text" name="c_companynumber" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>업태</label>
          <input type="text" name="c_div4" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label>업종</label>
          <input type="text" name="c_div5" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label>성별</label><br>
          <!-- <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name='gender' value='남' class="custom-control-input">
            <label class="custom-control-label">남</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name='gender' value='여' class="custom-control-input">
            <label class="custom-control-label">여</label>
          </div> -->
          <div class='form-check form-check-inline'>
            <input class='form-check-input' type='radio' name='gender' id='inlineRadio1' value='남'>
            <label class='form-check-label'>남</label>
          </div>
          <div class='form-check form-check-inline'>
            <input class='form-check-input' type='radio' name='gender' id='inlineRadio2' value='여'>
            <label class='form-check-label'>여</label>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-5">
          <label for="inputEmail5">연락처</label>
          <input type="text" name="c_contact" class="form-control" onkeyup="autoHypenPhone(this);">
        </div>
        <div class="form-group col-md-7">
          <label for="inputEmail5">이메일</label>
          <input type="email" name="c_email" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col">
          <label>주소</label>
          <input type="text" name="c_address" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col">
          <label for="inputEmail5">특이사항</label>
          <input type="text" name="c_etc" class="form-control">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">저장</button>
    </div>
  </form>

  <form method="post" action =".php"> <!--고객, 법인사업자 입력-->
    <div class="form-group">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>구분</label>
        </div>
        <div class="form-group col-md-8 text-center">
          <select name="c_div1" class="form-control">
            <option value="문의고객">문의고객</option>
            <option value="진행고객" selected>고객</option>
            <option value="거래처">거래처</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>구분</label>
        </div>
        <div class="form-group col-md-8 text-center">
          <select name="c_div2" class="form-control">
            <option value="문의고객">개인</option>
            <option value="진행고객">개인사업자</option>
            <option value="거래처" selected>법인사업자</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>구분</label><br>
          <select name="c_div3" class="form-control">
            <option value="문의고객" selected>주식회사</option>
            <option value="진행고객">유한회사</option>
            <option value="거래처">합자회사</option>
            <option value="거래처">기타</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label>사업자명</label>
          <input type="text" name="c_companyname" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label>대표자명</label>
          <input type="text" name="c_bossname" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>사업자번호</label>
          <input type="text" name="c_companynumber" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label>업태</label>
          <input type="text" name="c_div4" class="form-control">
        </div>
        <div class="form-group col-md-4">
          <label>업종</label>
          <input type="text" name="c_div5" class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputEmail5">연락처</label>
          <div class='form-row'>
            <div class='form group col-md-4'>
              <input type='text' name='c_contact1' class='form-control'>
            </div>
            <div class='form group col-md-4'>
              <input type='text' name='c_contact2' class='form-control'>
            </div>
            <div class='form group col-md-4'>
              <input type='text' name='c_contact3' class='form-control'>
            </div>
          </div>
          <!-- <input type="text" name="MOBILE_NO" id="MOBILE_NO"  maxlength="13" class="form-control"/> -->
          <!-- name="c_contact" class="form-control" onkeydown="autoHypenPhone(this);"> -->
        </div>
        <div class="form-group col-md-8">
          <label for="inputEmail5">이메일</label>
          <input type="email" name="c_email" class="form-control">
        </div>
      </div>

      <div class='form-group'>
        <div class='form-row'>
          <label>주소</label>
        </div>
        <div class='form-row'>
          <div class='form-group col-md-3'>
            <input type='text' id='sample2_postcode' placeholder='우편번호' class='form-control' disabled>
          </div>
          <div class='form-group col-md-3'>
            <input type='button' onclick='sample2_execDaumPostcode()' value='우편번호 찾기' class='btn btn-secondary'><br>
          </div>
        </div>
        <div class='form-row'>
          <div class='form-group col-md-6'>
            <input type='text' id='sample2_address' placeholder='주소' class='form-control'>
          </div>
          <div class='form-group col-md-6'>
            <input type='text' id='sample2_detailAddress' placeholder='상세주소' class='form-control'>
          </div>
        </div>
        <div class='form-row'>
          <div class='form-group col'>
            <input type='text' id='sample2_extraAddress' placeholder='참고항목' class='form-control'>
          </div>
        </div>
      </div>
      <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
      <div id='layer' style='display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;'>
      <img src='//t1.daumcdn.net/postcode/resource/images/close.png' id='btnCloseLayer' style='cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1' onclick='closeDaumPostcode()' alt='닫기 버튼'>
      </div>

      <!-- 다음주소 포맷 끝 -->


      <div class="form-row">
        <div class="form-group col">
          <label>특이사항</label>
          <input type="text" name="c_etc" class="form-control">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">저장</button>
    </div>
  </form>

</section>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script src="/js/daumAddressAPI.js"></script>
<!-- <script>
// 우편번호 찾기 화면을 넣을 element
    var element_layer = document.getElementById('layer');

    function closeDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_layer.style.display = 'none';
    }

    function sample2_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    document.getElementById("sample2_extraAddress").value = extraAddr;

                } else {
                    document.getElementById("sample2_extraAddress").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample2_postcode').value = data.zonecode;
                document.getElementById("sample2_address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("sample2_detailAddress").focus();

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_layer.style.display = 'none';
            },
            width : '100%',
            height : '100%',
            maxSuggestItems : 5
        }).embed(element_layer);

        // iframe을 넣은 element를 보이게 한다.
        element_layer.style.display = 'block';

        // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
        initLayerPosition();
    }

    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
    function initLayerPosition(){
        var width = 300; //우편번호서비스가 들어갈 element의 width
        var height = 400; //우편번호서비스가 들어갈 element의 height
        var borderWidth = 5; //샘플에서 사용하는 border의 두께

        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
    }//시원1111
</script> -->






<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
