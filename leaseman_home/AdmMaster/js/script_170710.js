$(document).ready(function(){
	//전체 체크박스 클릭시 해당 테이블 체크박스 체크 여부, 백그라운드
	$('.all_check').click(function(){
		if($('.all_check').prop('checked')) {
			//전체 체크박스 클릭
			$(this).parents('table').find('tbody tr td input[type=checkbox]').prop("checked",true).parents('tr').css('background','#e5f1ff');
		} else {
			//전체 체크박스 헤제
			$(this).parents('table').find('tbody tr td input[type=checkbox]').prop("checked",false).parents('tr').css('background','none');
		}
	});
	//체크박스 선택시 해당 체크박스 백그라운드
	$('.com_tb01 table tbody tr td input[type="checkbox"]').click(function(){
		if($(this).prop('checked')) {
			//체크되어있는 라인 배경색 변경
			$(this).parents('tr').css('background','#e5f1ff').addClass('aa');
		} else {
			//체크 해제시 원래대로
			$(this).parents('tr').css('background','none');
		}
	});
	//테이블의 목록 클릭시 백그라운드
	$('.click_tb table tbody tr').click(function(){
		$('.click_tb table tbody tr').css("background","none");
		$(this).css("background","#00BFFF");
	});

	//네비게이션 active
	var h_active = $('.com_hbox h2.com_h2').attr("data-title")
	var h_attr = $('.com_hbox h2.com_h2').attr("data-type");
	var nav_len = $(".nav_ul li").length;

	for( var i = 0; i<nav_len; i++ ){
		var nav_active = $(".nav_ul > li").eq(i).children("a").text();
		
		if( h_attr == nav_active ){
			$(".nav_ul > li").eq(i).addClass("active");
		}

		var nav_depth_len = $(".nav_ul > li.active").find(".nav_ul2 li").length;
		
		for( var j = 0; j<nav_depth_len; j++ ){
			var nav_depth_active = $(".nav_1dp.active .nav_ul2 li").eq(j).children("a").text();
			
			if( h_active == nav_depth_active ){
				$(".nav_1dp.active .nav_ul2 li").eq(j).addClass("active");
			}
		}

	}
	
	//탭메뉴
	$('.tab_cntbox').find('.tab_cnt').hide();
	$('.tab_cntbox').find('.tab_cnt:first-child').show();
	
	$('.tab_box ul li a').click(function(){
		$('.tab_box ul li').removeClass('active');
		$(this).parent().addClass('active');
		var tab_num = $(this).parent().index();
		$('.tab_cntbox').find('.tab_cnt').hide();
		$('.tab_cntbox').find('.tab_cnt').eq(tab_num).show();
	});

	//모든 팝업창 닫기
	$('.pops_close,.popbgClose').click(function(){
		//$('.pops_wrap, .pops_box').hide();
		$('.pops_wrap,.pops_box,.popup_iframe',parent.document).hide();
	});

	//모든 팝업창 닫기
	$('.pops_close_sub').click(function(){
		//$(this).closest(".pops_box").hide();
		//$('.pops_wrap, .pops_box',parent.document).hide();
		$('.pops_wrap,.pops_box,.popup_iframe',parent.document).hide();
	});

	//모든 팝업창 닫기
	$('.pops_close2').click(function(){
		$(this).closest(".pops_box").hide();
	});

	


	//제이쿼리 간단하게 짜봅시다. --나중에 --
	




	//문자메세지 보내기 모달창 모든 체크박스
	$('.all_ckbox .gray_box input[type=checkbox]').click(function(){
		if($('.all_ckbox .gray_box input[type=checkbox]').prop('checked')) {
			//전체 체크박스 클릭
			$(this).parents('.all_ckbox').next('.msg_cklist').find('ul li .ab_lt input[type=checkbox]').prop("checked",true);
		} else {
			//전체 체크박스 헤제
			$(this).parents('.all_ckbox').next('.msg_cklist').find('ul li .ab_lt input[type=checkbox]').prop("checked",false);
		}
	});
	
	
	
	//달력 input_text
	$.datepicker.regional['ko'] = { // Default regional settings
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
		'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월',
		'7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yy.mm.dd', // [mm/dd/yy], [yy-mm-dd], [d M, y], [DD, d MM]
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};



	$.datepicker.setDefaults($.datepicker.regional['ko']);
	
	
	//달력 시동어 input_text
	$( function() {

		var today = new Date();
		var yr = today.getFullYear(); 

		$( ".calendar" ).datepicker();

		$( ".calendar2" ).datepicker({
			closeText: '취소',
			prevText: '이전달',
			nextText: '다음달',
			currentText: '오늘',
			monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
			'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월',
			'7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			weekHeader: 'Wk',
			dateFormat: 'yy-mm-dd', // [mm/dd/yy], [yy-mm-dd], [d M, y], [DD, d MM]
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: true,
			showButtonPanel: true,
			showOn: 'button',
			buttonImageOnly: true, 
			buttonImage: '/img/main/calendar_ig.png',
			
			onClose: function () {
				if ($(window.event.srcElement).hasClass('ui-datepicker-close')) {
					$(this).val('');
				}
			},
			yearSuffix: '',
			yearRange: "1900:"+yr ,  
			changeMonth: true,
			changeYear: true
		
		});


		$( ".calendar2" ).keyup(function(e) {
			var tmp_val = $(this).val();

			//alert(e.which);
			if(e.which == 8){
				return false;
			}

						
			if( tmp_val.length == 4 || tmp_val.length == 7 ){
				tmp_val += "-";
			}

			if( tmp_val.length >10 ){
				tmp_val = tmp_val.substr(0,10);
			}

			$(this).val(tmp_val);
		});

		$(".calendar2").keyup(function(){$(this).val( $(this).val().replace(/[^0-9-]/g,"") );} );


	} );

	
});

$( function() {
    $( ".pops_wrap .pops_box" ).draggable({ handle: ".pops_h" });
  } );

function pops_07btn(type){
	//삭제
	if(type){
		$('.pops_wrap, .pops_07',parent.document).show();
	}else{
		$('.pops_wrap, .pops_07').show();
	}
	
};
function pops_01btn(){
	//문자보내기
	//$('.pops_wrap, .pops_01').show();

	var tmps = "<iframe name='ifm_pops_01' id='ifm_pops_01' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	var idx = $(this).prop("rel");
	$("#ifm_pops_01").attr("src","/AdmMaster/inc/viewsms.php");
	$('#ifm_pops_01').show();
	$('.pops_wrap, .pops_01').show();


};
function pops_01_1btn(){
	//문자보내기
	

	var tmps = "<iframe name='ifm_pops_01_1' id='ifm_pops_01_1' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	var idx = $(this).prop("rel");
	$("#ifm_pops_01_1").attr("src","/AdmMaster/inc/sendsms.php");
	$('#ifm_pops_01_1').show();
	$('.pops_wrap, .pops_01_1').show();



};
function pops_02btn(){
	//공지사항 추가
	$('.pops_wrap, .pops_02').show();
};
function pops_02_1btn(){
	//FAQ 추가
	$('.pops_wrap, .pops_02_1').show();
};
function pops_02_2btn(){
	//자료 추가
	$('.pops_wrap, .pops_02_2').show();
};
function pops_03btn(){
	//사업자정보

	var tmps = "<iframe name='ifm_pops_03' id='ifm_pops_03' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	var idx = $(this).prop("rel");
	$("#ifm_pops_03").attr("src","/AdmMaster/inc/view_cus_pop.php?idx=");
	$('#ifm_pops_03').show();
	$('.pops_wrap, .pops_03').show();
};

function pops_04btn(){
	//관리자 추가
	//$('.pops_wrap, .pops_04').show();

	var tmps = "<iframe name='ifm_pops_04' id='ifm_pops_04' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	$("#ifm_pops_04").attr("src","/AdmMaster/inc/ad_man.php");
	$('#ifm_pops_04').show();
	$('.pops_wrap, .pops_04').show();

};
function pops_04_1btn(){
	//푸싱메시지 추가
	//$('.pops_wrap, .pops_04_1').show();

	var tmps = "<iframe name='ifm_pops_04_1' id='ifm_pops_04_1' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	$("#ifm_pops_04_1").attr("src","/AdmMaster/inc/ad_pu.php");
	$('#ifm_pops_04_1').show();
	$('.pops_wrap, .pops_04_1').show();

};
function pops_04_2btn(){
	//푸싱메시지 추가
	//$('.pops_wrap, .pops_04_2').show();
	
	var tmps = "<iframe name='ifm_pops_04_2' id='ifm_pops_04_2' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	$("#ifm_pops_04_2").attr("src","/AdmMaster/inc/ad_poo.php");
	$('#ifm_pops_04_2').show();
	$('.pops_wrap, .pops_04_2').show();

};
function pops_05btn(){
	//회원추가 추가

	var tmps = "<iframe name='ifm_pops_05' id='ifm_pops_05' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	var idx = $(this).prop("rel");
	$("#ifm_pops_05").attr("src","/AdmMaster/inc/pops_add_user.php");
	$('#ifm_pops_05').show();
	$('.pops_wrap, .pops_05').show();


};
function pops_05_1btn(c_idx){
	//회원정보

	var tmps = "<iframe name='ifm_pops_05_1' id='ifm_pops_05_1' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	var idx = $(this).prop("rel");
	$("#ifm_pops_05_1").attr("src","/AdmMaster/inc/pops_mod_user.php?c_idx="+c_idx);
	$('#ifm_pops_05_1').show();
	$('.pops_wrap, .pops_05_1').show();

};
function pops_05_4btn(){
	//회원수정
	$('.pops_wrap, .pops_05_4').show();
};
function pops_05_2btn(){
	//건물관리
	//$('.pops_wrap, .pops_05_2').show();

	var tmps = "<iframe name='ifm_pops_05_2' id='ifm_pops_05_2' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	var idx = $(this).prop("rel");
	$("#ifm_pops_05_2").attr("src","/AdmMaster/inc/build_k2s.php?idx=");
	$('#ifm_pops_05_2').show();
	$('.pops_wrap, .pops_05_2').show();
};
function pops_05_3btn(){
	//사용건수
	//$('.pops_wrap, .pops_05_3').show();

	var tmps = "<iframe name='ifm_pops_05_3' id='ifm_pops_05_3' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("#wrap").append(tmps);

	var idx = $(this).prop("rel");
	$("#ifm_pops_05_3").attr("src","/AdmMaster/inc/jincntkkk.php?idx=");
	$('#ifm_pops_05_3').show();
	$('.pops_wrap, .pops_05_3').show();



};


/**
 * 우편번호 창
 **/
var win_zip_item = function(frm_name, frm_zip, frm_addr1, frm_addr2  , frm_addr3, frm_jibeon, sido, sigungu, dong) {

    if(typeof daum === 'undefined'){
        alert("다음 우편번호 postcode.v2.js 파일이 로드되지 않았습니다.");
        return false;
    }

    var zip_case = 0;   //0이면 레이어, 1이면 페이지에 끼워 넣기, 2이면 새창

    var complete_fn = function(data){
        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

        // 각 주소의 노출 규칙에 따라 주소를 조합한다.
        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
        var fullAddr = ''; // 최종 주소 변수
        var extraAddr = ''; // 조합형 주소 변수

		fullAddr = data.roadAddress;
		extraAddr = data.jibunAddress;

        // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
            fullAddr = data.roadAddress;

        } else { // 사용자가 지번 주소를 선택했을 경우(J)
            fullAddr = data.jibunAddress;
        }

        // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
        if(data.userSelectedType === 'R'){
            //법정동명이 있을 경우 추가한다.
            if(data.bname !== ''){
                extraAddr += data.bname;
            }
            // 건물명이 있을 경우 추가한다.
            if(data.buildingName !== ''){
                extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
            }
            // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
            extraAddr = (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
        }

        // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
        var of = document[frm_name];

        of[frm_zip].value = data.zonecode;

        of[frm_addr1].value = fullAddr;
       

        of[frm_addr2].focus();
    };

    switch(zip_case) {
        case 1 :    //iframe을 이용하여 페이지에 끼워 넣기
            var daum_pape_id = 'daum_juso_page'+frm_zip,
                element_wrap = document.getElementById(daum_pape_id),
                currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
            if (element_wrap == null) {
                element_wrap = document.createElement("div");
                element_wrap.setAttribute("id", daum_pape_id);
                element_wrap.style.cssText = 'display:none;border:1px solid;left:0;width:100%;height:300px;margin:5px 0;position:relative;-webkit-overflow-scrolling:touch;';
                element_wrap.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-21px;z-index:1" class="close_daum_juso" alt="접기 버튼">';
                jQuery('form[name="'+frm_name+'"]').find('input[name="'+frm_addr1+'"]').before(element_wrap);
                jQuery("#"+daum_pape_id).off("click", ".close_daum_juso").on("click", ".close_daum_juso", function(e){
                    e.preventDefault();
                    jQuery(this).parent().hide();
                });
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                    // iframe을 넣은 element를 안보이게 한다.
                    element_wrap.style.display = 'none';
                    // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                    document.body.scrollTop = currentScroll;
                },
                // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분.
                // iframe을 넣은 element의 높이값을 조정한다.
                onresize : function(size) {
                    element_wrap.style.height = size.height + "px";
                },
                width : '100%',
                height : '100%'
            }).embed(element_wrap);

            // iframe을 넣은 element를 보이게 한다.
            element_wrap.style.display = 'block';
            break;
        case 2 :    //새창으로 띄우기
            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                }
            }).open();
            break;
        default :   //iframe을 이용하여 레이어 띄우기
            var rayer_id = 'daum_juso_rayer'+frm_zip,
                element_layer = document.getElementById(rayer_id);
            if (element_layer == null) {
                element_layer = document.createElement("div");
                element_layer.setAttribute("id", rayer_id);
                element_layer.style.cssText = 'display:none;border:5px solid;position:fixed;width:300px;height:460px;left:50%;margin-left:-155px;top:50%;margin-top:-235px;overflow:hidden;-webkit-overflow-scrolling:touch;z-index:10000';
                element_layer.innerHTML = '<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" class="close_daum_juso" alt="닫기 버튼">';
                document.body.appendChild(element_layer);
                jQuery("#"+rayer_id).off("click", ".close_daum_juso").on("click", ".close_daum_juso", function(e){
                    e.preventDefault();
                    jQuery(this).parent().hide();
                });
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    complete_fn(data);
                    // iframe을 넣은 element를 안보이게 한다.
                    element_layer.style.display = 'none';

                },
                width : '100%',
                height : '100%'
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';
    }
}




$(document).ready(function(){

//숫자만
$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


//영문만
 $(".onlyeng").css("ime-mode","disabled");
 $(".onlyeng").keyup(function(){$(this).val( $(this).val().replace(/[^\!-z]/g,"") );} );


//한글 금지
 $(".nothangul").keyup(function(){$(this).val( $(this).val().replace(/[^a-z0-9_]/g,"") );} );


//공백 제거
//$("#r_name").keyup(function(){ $(this).val( $(this).val().replace(/(^[\s]*)|([\s]*$)/g,''));  });


});

