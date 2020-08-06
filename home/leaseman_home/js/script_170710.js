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

