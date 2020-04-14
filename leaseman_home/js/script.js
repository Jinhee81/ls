function responsive(){

   var $wh = $(window).width();

   
   if ($wh <= 768)
   {   
	  $("body").removeClass("web");
      $("body").addClass("mobile");
   }else{
      $("body").removeClass("mobile");
	  $("body").addClass("web");
   }   
}
$(function(){
   $( window ).load(function() {
      responsive();
   });
   $( window ).resize(function() {
      responsive();
   });
});
/*
$(function(){
   $(".btn_gnbmenu").click(function(e){#wrap
      if($("body").hasClass("responsive")){
         $(this).toggleClass("on");
         $("#gnb").slideToggle("fast");
      }else{
         $(this).removeClass("on");
         $("#gnb").show();
      }
      e.preventDefault();
   });
});
*/
//fullpage_js
$(document).ready(function() {
	$('#container.main').fullpage({
		anchors: ['section_one', 'section_two', 'section_thr', 'section_fou', 'section_fiv','section_six','section_eig','section_nin','section_foo'],
		verticalCentered: true,
		menu: '.dot_page',
		css3:false,
		resize:true,
		responsiveWidth:1200,
		scrollingSpeed: 400
	});
});
//gnb
$(document).ready(function(){
	
	$("#gnb > ul > li").mouseenter(function(){
		 if($("body").hasClass("web")){
			$("#header").stop().animate({'height':150},1000,'easeOutExpo');
			$("#header").removeClass("active");
		 }		
	});
});

$(document).ready(function(){
	$("#gnb > ul > li").mouseenter(function(){
		$("#gnb ul li .depth02_list").slideUp("fast");
		$(this).find(".depth02_list").stop().slideDown("fast");
		$("#gnb ul li").removeClass("active");
		$(this).addClass("active");
	});
}); 


$(document).ready(function(){
	$(".gnb_wrap > ul > li").mouseenter(function(){
		$(".gnb_wrap ul li .depth02_list").slideUp("fast");
		$(this).find(".depth02_list").stop().slideDown("fast");
		$(".gnb_wrap ul li").removeClass("active");
		$(this).addClass("active");
	});
}); 
//주 메뉴 스크립트
$(document).ready(function(){
	$(".gnb_wrap > li > a").click(function(e){
		if($(".gnb_wrap > li ").addClass("active")){
			var $con = $(this).next(".depth02_list");
			if($con.is(":visible")) {
				$con.slideUp();
				$(".gnb_wrap > li > a").removeClass("active");
			} else {			
				$(".gnb_wrap > li .depth02_list:visible").slideUp();
				$(".gnb_wrap > li > a").removeClass("active");
				$(this).addClass("active");
				$con.slideDown();
			}
				e.preventDefault();
		}
	});
	var toggle=0;
	$(".gnb_menu").click(function(e){
		if($("#gnb_mo").addClass("on")){
			if(toggle == 0){
				$("#wrap").addClass("on");
				$(".layer_bg").show();
				$(this).addClass("on");
				e.preventDefault();
				return toggle=1;
			}else if(toggle == 1){
				$("#gnb_mo").removeClass("on");
				$(".gnb_menu").removeClass("on");
				$(".layer_bg").hide();	
				return toggle=0;
			}			
		}
	});	
	$(".gnb_bg").click(function(){
		if(toggle==1){
			$("#wrap").removeClass("on");
			$(".gnb_menu").removeClass("on");
			$(".gnb_bg").hide();	
			return toggle=0;
		}
	});
	
})
//서브상단 메뉴 및 active효과
$(document).ready(function(){
	$(".loc_nav > li > a").click(function(e){
		$(this).next(".dep02").slideToggle();
		$(this).toggleClass("on");
		$(".m_layer_bg").toggleClass("on");
		e.preventDefault();
	});
	/*var slider = $('.main_visual_slide').bxSlider({
			mode:"fade",				
			auto:true,
			pause: 5000,
			speed: 800,
			controls:false
		});

	$('.main_visual_slide').slick({
		arrows: true,
		dots: false,
		fade: true,
		infinite: true,
		speed: 1200,
		autoplay:true,
		autoplaySpeed:6000
	});
*/
	//모바일 서브 탭메뉴 슬라이드
	$(".st_menu_mo .stm_tit").click(function(){
		$(this).toggleClass("active");
		$(this).next("ul").slideToggle(200);
	});
	//서브위치active스크립트
	var $smenu=$('.w_gnb_wrap .depth02_list li');
	var $stmenu=$('.gnb_list > li ');
	var $locTxt=$('.sub_visual h2').text();	
	var $slocTxt=$('.stm_active').text();	
	for (var i=0; i<$smenu.length; i++){
		var menutxt=$.trim($smenu.eq(i).find('>a').text());
		var loctxt=$.trim($locTxt);
		if (menutxt == loctxt){
			$smenu.eq(i).addClass('on');
			$stmenu.eq(i).addClass('active');
		}
	}
	for (var i=0; i<$stmenu.length; i++){
		var menutxt=$.trim($stmenu.eq(i).find('>a').text());
		var loctxt=$.trim($slocTxt);
		if (menutxt == loctxt){
			$stmenu.eq(i).addClass('active');
		}
	}
	$(".sub_loc_active").text($locTxt);
	$(".stm_tit").text($locTxt);
	
});
//유튜브 영상 팝업
$(document).ready(function(){
	var $v_link = $('.youtube_layer iframe')
	var videoURL = $v_link.prop('src');
		videoURL += "&autoplay=1";
	$(".btn_video").click(function(e){
		$v_link.prop('src',videoURL);
		$(".layer_bg").stop().fadeIn("fast");
		$(".youtube_layer").stop().fadeIn("fast");		
		e.preventDefault();
		$(".youtube_layer .btn_close,.layer_bg").click(function(e){
			videoURL = videoURL.replace("&autoplay=1", "");
			$v_link.prop('src','');
			$v_link.prop('src',videoURL);
			$(".layer_bg").stop().hide();
			$(".youtube_layer").stop().hide();
			e.preventDefault();
		});
	});

	$('a[href^="#wrap"],a[href^="#content01"]').on('click',function (e) {
		e.preventDefault();
		var target = this.hash,
		$target = $(target);
		var ta = $target.offset().top;
		$('html, body').stop().animate({
			'scrollTop': ta 
		}, 500, 'easeInOutExpo', function () {
			//window.location.hash = target;
		});
	});

	$('.main_visual_silde').bxSlider({
	  mode:'horizontal', //default : 'horizontal', options: 'horizontal', 'vertical', 'fade'
	  speed:1000, //default:500 이미지변환 속도
	  pause:5000,
	  auto: true, //default:false 자동 시작
	  captions: false, // 이미지의 title 속성이 노출된다.
	  autoControls: false, //default:false 정지,시작 콘트롤 노출, css 수정이 필요
	});

});

//모바일 테이블 화살표 
$(function(){
	$(".ta_overwrap").scroll(function(){
		var sl = $(this).scrollLeft();
		if(sl > 5){
			$(this).find(".more_arrow").fadeOut("fast");
		}else{
			$(this).find(".more_arrow").fadeIn("fast");
		}
	});

	
});



$(function(){
	$(".system_configuration > b").on("click",function(){
		$(this).toggleClass("active");
		$(this).next(".box_in").slideToggle(200);
	});
});

$(function(){
	$(".system_configuration2 > b").on("click",function(){
		$(this).toggleClass("active");
		$(this).next(".box_in").slideToggle(200);
	});
});
//푸터 화살표 누를시 부드럽게 올라가기 	
	$(document).ready(function(){
		$('a[href^="#wrap"],a[href^="#content01"]').on('click',function (e) {
				e.preventDefault();
				var target = this.hash,
				$target = $(target);
				var ta = $target.offset().top;
				$(' body').stop().animate({
					'scrollTop': ta 
				}, 500, 'easeInOutExpo', function () {
					//window.location.hash = target;
			});
		});
	});

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
console.log(frm_zip);
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


$(function(){
	//숫자만
$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );


//영문만
 $(".onlyeng").css("ime-mode","disabled");
 $(".onlyeng").keyup(function(){$(this).val( $(this).val().replace(/[^\!-z]/g,"") );} );


//한글 금지
 $(".nothangul").keyup(function(){$(this).val( $(this).val().replace(/[^a-z0-9_]/g,"") );} );
});