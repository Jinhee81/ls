$(document).ready(function(){
	$(".layer_slide").slick({
		arrows: true,
		dots: true,
		infinite: true,
		speed: 200
	});
	$(".desigh_slide .btn_layer").click(function(e){
		//var idx = $(".desigh_slide .btn_layer").index(this) -1;
		//var cot = $(".desigh_slide_layer .dsl_box").eq(idx);
		$(".desigh_slide_layer .dsl_box .layer_slide").show();
		$(".layer_bg").fadeIn(200);
		$(".layer_slide_close").fadeIn(200);
		$('.dsl_box .layer_slide').get(0).slick.setPosition();
		e.preventDefault();
		$(".layer_bg,.layer_slide_close").click(function(){
			$(".layer_slide_close").fadeOut(50);
			$(".layer_slide").fadeOut(50);
			$(".layer_bg").fadeOut(50);
		});
	});
	$(".dg_list01 .btn_layer").click(function(e){
		var idx = $(".dg_list01 .btn_layer").index(this)-1;
		var cot = $(".furniture_slide_layer .fsl_box").eq(idx);
		cot.find(".layer_slide").show();
		$(".layer_bg").fadeIn(200);
		$(".layer_slide_close").fadeIn(200);
		$('.fsl_box .layer_slide').get(idx).slick.setPosition();
		e.preventDefault();
		$(".layer_bg,.layer_slide_close").click(function(){
			$(".layer_slide_close").fadeOut(50);
			$(".layer_slide").fadeOut(50);
			$(".layer_bg").fadeOut(50);
		});
	});
	$(".dg_list02 .btn_layer").click(function(e){
		var idx = $(".dg_list02 .btn_layer").index(this)-1;
		var cot = $(".car_slide_layer .csl_box").eq(idx);
		cot.find(".layer_slide").show();
		$(".layer_bg").fadeIn(200);
		$(".layer_slide_close").fadeIn(200);
		$('.csl_box .layer_slide').get(idx).slick.setPosition();
		e.preventDefault();
		$(".layer_bg,.layer_slide_close").click(function(){
			$(".layer_slide_close").fadeOut(50);
			$(".layer_slide").fadeOut(50);
			$(".layer_bg").fadeOut(50);
		});
	});
});