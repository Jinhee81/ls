<?
	include('../inc/head.inc.php');
	include('../inc/header.inc.php');
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
<style media="screen">
.ta_write{width:100%;border-top:2px solid #666666;color:#333;}
.ta_write .colw01{width:160px; }
.ta_write .colw02{width:35%; }
.ta_write th{background-color:#fafafa;border-top:1px solid #f1f1f1;border-bottom:1px solid #f1f1f1;height:50px;font-size:14px;color:#333;text-align:left;padding-left:15px;}
.ta_write td{border-bottom:1px solid #f1f1f1;border-top:1px solid #dcdcdc;padding:10px;font-size:14px;color:#666;}
.ta_write td input[type="email"],
.ta_write td input[type="text"],
.ta_write td input[type="password"],
.ta_write td input[type="number"]{padding:0 10px;box-sizing:border-box;height:30px;border:1px solid #d2d2d2;background-color:#fafafa;}
.ta_write td input.wr_wh01{width:50%;}
.ta_write td input.wr_wh02{width:380px;}
.ta_write td input.wr_wh03{width:100%;}
.ta_write td.ph input,
.ta_write td.ph select{width:30%;}
.ta_write td select{height:30px;}
.ta_write td textarea{width:100%;box-sizing:border-box;height:103px;background-color:#fafafa;}
.ta_write td .agree_content{border:1px solid #e6e6e6;background-color:#fafafa;padding:10px;height:200px;overflow:auto;margin-bottom:15px;}
.ta_write td .radio_list span{display:inline-block;font-size:14px;color:#333;margin-right:26px;}
.bo_write .btn_wrap{margin:30px 0;text-align:center;}
.bo_write .btn_wrap .btn_st03{margin-left:6px;}

.LE_tab{width:800px;margin:0 auto 60px auto;}
.LE_tab:after{content:"";display:block;clear:both;}
.LE_tab li{float:left;width:50%;text-align:center;box-sizing:border-box;j}
.LE_tab li a{display:block;line-height:50px;font-size:20px;color:#666;border:1px solid #d2d2d2;border-left:none;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.LE_tab li:first-child a{border-left:1px solid #d2d2d2;}
.LE_tab li.active a{background-color:#543e22;color:#fff;border-color:#543e22;}

.st_menu_mo{display:none;}


/*공통부분*/
input[type=text], input[type=password] {background:#fff; border:1px solid #c9c9c9; height:20px; line-height: 20px; padding:0 5px 0 5px;box-sizing:border-box;}
input[type=text]:hover, input[type=password]:hover, input[type=text]:focus, input[type=password]:focus {border:1px solid #909090;}
input[type=checkbox], input[type=radio] {margin-top:-1px; margin-bottom:1px;}
textarea{border:1px solid #c9c9c9; padding:5px;}
select{border:1px solid #c9c9c9; height:22px; padding:2px 2px 2px 6px; vertical-align:middle;}

/* 이용약관 */
.fc_wr{padding:20px 10px;margin-bottom:40px;overflow-y:auto}
.fc_wr .fc_se{border-bottom:1px solid #eaeaea;padding-bottom:45px;margin-bottom:30px;}
.fc_wr .fc_se p{line-height:24px;color:#585858;font-size:14px;    margin-bottom: 10px;}
.fc_wr .fc_se h2{font-size:18px; color:#40859f;margin-bottom:18px;font-weight:bold;}
.fc_wr .fc_se dl{line-height:22px;color:#585858;}
.fc_wr .fc_se dl dt{font-size:13px;color:#333;}
.fc_wr .fc_se dl dd{margin-left:14px;margin-bottom:10px;font-size:12px;}
.fc_wr .fc_se ol{    margin-bottom: 10px;}
.fc_wr .fc_se ol li{list-style: decimal;line-height:22px;color:#585858;list-style-position:inside;font-size:12px;}
.fc_wr .fc_se_cl{border:0;padding:0; margin:0}
</style>
		<section id="container">
			<div class="sub_visual">
				<ul>
					<li>
						<img src="../img/main/main_visual_img01.png" width ="100%">
					</li>
				</ul>
			</div>
			<div class="sub_visual one">
				<ul>
					<li>
						<img src="../img/mobile/main_visual_img01.png" width ="100%">
					</li>
				</ul>
			</div>
			<div class="wrap_1000 one">
				<div class="sub_tit">
					<h2>제휴문의</h2>
				</div>
				<div class="">
					<form action="qna_write_ok.php" method="post" name="frm" id="frm" onsubmit="return send_it(this);">
						<p class="txt01"><span class="star">*</span>표시는 필수입력항목입니다. 반드시 입력해 주세요.</p>
						<table class="ta_write">
							<colgroup>
								<col class="colw01">
								<col class="colw02">
								<col class="colw01">
								<col class="colw02">
							</colgroup>
							<tbody>

								<tr>
									<th><label for="user_tel">전화번호</th>
									<td class="ph">
										<select name="user_tel_1" id="user_tel_1">
											<option value="">번호선택</option>
											<option value="010">010</option>
											<option value="011">011</option>
											<option value="016">016</option>
											<option value="017">017</option>
											<option value="018">018</option>
											<option value="019">019</option>
											<option value="010">010</option>
											<option value="02">02</option>
											<option value="031">031</option>
											<option value="032">032</option>
											<option value="033">033</option>
											<option value="041">041</option>
											<option value="042">042</option>
											<option value="043">043</option>
											<option value="044">044</option>
											<option value="051">051</option>
											<option value="052">052</option>
											<option value="053">053</option>
											<option value="054">054</option>
											<option value="055">055</option>
											<option value="061">061</option>
											<option value="062">062</option>
											<option value="063">063</option>
											<option value="064">064</option>
										</select>
										-
										<input type="text" id="user_tel_2" name="user_tel_2" maxlength="4" numberonly="true">
										-
										<input type="text" id="user_tel_3" name="user_tel_3" maxlength="4" numberonly="true">
									</td>
									<th><label for="user_email">E-mail<span class="star">*</span></label></th>
									<td><input type="text" id="user_email" name="user_email" class="wr_wh03" value=""></td>
								</tr>
								<tr>
									<th><label for="user_name">업체명/담당자명<span class="star">*</span></label></th>
									<td><input type="text" id="user_name" name="user_name" class="wr_wh03" value=""></td>
									<th><label for="user_phone">휴대폰번호<span class="star">*</span></label></th>
									<td class="ph">
										<select name="user_phone_1" id="user_phone_1">
											<option value="">번호선택</option>
											<option value="010">010</option>
											<option value="011">011</option>
											<option value="016">016</option>
											<option value="017">017</option>
											<option value="018">018</option>
											<option value="019">019</option>
											<option value="010">010</option>
											<option value="02">02</option>
											<option value="031">031</option>
											<option value="032">032</option>
											<option value="033">033</option>
											<option value="041">041</option>
											<option value="042">042</option>
											<option value="043">043</option>
											<option value="044">044</option>
											<option value="051">051</option>
											<option value="052">052</option>
											<option value="053">053</option>
											<option value="054">054</option>
											<option value="055">055</option>
											<option value="061">061</option>
											<option value="062">062</option>
											<option value="063">063</option>
											<option value="064">064</option>
										</select>
										-
										<input type="text" id="user_phone_2" name="user_phone_2" maxlength="4" numberonly="true">
										-
										<input type="text" id="user_phone_3" name="user_phone_3" maxlength="4" numberonly="true">
									</td>
								</tr>

								<tr>
									<th><label for="contents">문의내용</label></th>
									<td colspan="3"><textarea name="contents" id="contents" cols="40" rows="20"></textarea></td>
								</tr>
								<tr>
									<th><label for="">개인정보 수집동의<span class="star">*</span></label></th>
									<td colspan="3">
										<div class="agree_content"><? include('./agree_inc01.php');?></div>
										<div class="radio_list">
											<span><input type="radio" id="gubun_1" name="gubun" value="01"/> <label for="gubun_1">동의</label></span>
											<span><input type="radio" id="gubun_2" name="gubun" value="02"/> <label for="gubun_2">동의안함</label></span>
										</div>
									</td>
								</tr>
								<tr>
									<th>자동등록방지</th>
									<td>
									<input name="captcha" type="text" style="width:35%">
									<img src="captcha.php" style="margin-top:2px;"/><br>
									</td>
								</tr>
							</tbody>
						</table>

					<div class="inline">
						<b class="ok_btn up_btn" ><a href="#!" class="write_btn">등록</a></b>
					</div>
					</form>
				</div>
			</div>
		</div>
	<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->

</body>
</html>
<script type="text/javascript">
$(".write_btn").click(function(){
	$("#frm").submit();
});
	function send_it(){
		if($("#user_name").val() ==""){
			alert("업체명/담당자명을 입력해주세요");
			$("#user_name").focus();
			return false;
		}
		if($("#user_phone_1").val() ==""){
			alert("휴대폰번호를 입력해주세요");
			$("#user_phone_1").focus();
			return false;
		}
		if($("#user_phone_2").val() ==""){
			alert("휴대폰번호를 입력해주세요");
			$("#user_phone_2").focus();
			return false;
		}
		if($("#user_phone_3").val() ==""){
			alert("휴대폰번호를 입력해주세요");
			$("#user_phone_3").focus();
			return false;
		}
		if($("#user_email").val() ==""){
			alert("E-mail을 입력해주세요");
			$("#user_email").focus();
			return false;
		}
		if($("input[name='gubun']:checked").val()!="01"){
			alert("개인정보 수집동의 선택해주세요.");
			return false;
		}
	}
	$(function(){
		$("#product_sec").change(function(){
			var product_name =$(this).val();
			$("#product_name").val(product_name);
		});
	});
</script>
