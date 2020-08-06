<?php
include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
?>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<section class="pops_wrap">	
	<div class="pops_box pops_04_2">
		<div class="pops_h">
			<h2>팝업 추가</h2>
			<a href="#!" class="pops_close"><img src="/img/main/pops_close.png" alt="닫기버튼"></a>
		</div>
		<div class="pops_con">
			<div class="com_tb01">
				<form name="frm1" id="frm" method="post" action="/AdmMaster/setting/list04_ok.php">
					<input name="P_CATE" type="hidden" value="L"  />
					<input name="reg_id" type="hidden" value="<?=$_SESSION[member][id]?>"  />

					<fieldset>
						<legend>팝업 추가</legend>
						<table class="ta_write01">
							<caption>팝업 추가</caption>
							<colgroup>
							</colgroup>
							<tbody>


								<tr>
									<th>등록자명</th>
									<td><?=$_SESSION[member][name]?></td>
								</tr>
								<tr>
									<th>팝업창 제목</th>
									<td><input type="text" id=""  name="P_SUBJECT" value='<?=$P_SUBJECT?>'  class="input_txt placeHolder" rel="" style="width:98%" /></td>
								</tr>
								<tr>
									<th>팝업노출 기간</th>
									<td>
										<input type="text" id="" name="P_STARTDAY"  value='<?=$P_STARTDAY?>' class="calendar2 input_txt placeHolder" rel=""  />
										<input type="text" id="" name="P_START_HH"  value='<?=$P_START_HH?>'  class="input_txt placeHolder" rel="" style="width:40px" maxlength=2 numberOnly=true/> 
										: 
										<input type="text" id="" name="P_START_MM"  value='<?=$P_START_MM?>'  class="input_txt placeHolder" rel="" style="width:40px" maxlength=2 numberOnly=true/>   부터 &nbsp; &nbsp; 
										
										<input type="text" id="" name="P_ENDDAY"  value='<?=$P_ENDDAY?>' class="calendar2 input_txt placeHolder" rel="" />
										<input type="text" id="" name="P_END_HH"  value='<?=$P_END_HH?>'  class="input_txt placeHolder" rel="" style="width:40px" maxlength=2 numberOnly=true/> 
										: 
										<input type="text" id="" name="P_END_MM"  value='<?=$P_END_MM?>'  class="input_txt placeHolder" rel="" style="width:40px" maxlength=2 numberOnly=true/> 
										까지</td>
								</tr>
								<tr>
									<th>노출여부</th>
									<td>
										<input type="radio" name="status" value="A" checked > 일정별 자동노출  &nbsp; &nbsp; 
										<input type="radio" name="status" value="B" > 강제노출  &nbsp; &nbsp; 
										<input type="radio" name="status" value="C" > 강제 비노출 </td>
								</tr>
								
								
								<tr>
									<th>팝업 사이즈</th>
									<td>
										<input type="text" id="" name="P_WIN_WIDTH" value='<?=$P_WIN_WIDTH?>' class="input_txt placeHolder" rel="" style="width:50px" maxlength=4 numberOnly=true/> X 
										<input type="text" id="" name="P_WIN_HEIGHT"  value='<?=$P_WIN_HEIGHT?>' class="input_txt placeHolder" rel="" style="width:50px" maxlength=4 numberOnly=true/> <span class="bbs_guide">* 가로 X 세로, 픽셀기준</span></td>
								</tr>
								<tr>
									<th>팝업창 노출 위치</th>
									<td>
										<input type="text" id="" name="P_WIN_LEFT" value='<?=$P_WIN_LEFT?>' class="input_txt placeHolder" rel="" style="width:50px" maxlength=4 numberOnly=true/> X 
										<input type="text" id="" name="P_WIN_TOP"  value='<?=$P_WIN_TOP?>' class="input_txt placeHolder" rel="" style="width:50px" maxlength=4 numberOnly=true/> 								
										<span class="bbs_guide">* 가로 X 세로, 픽셀기준, 화면 좌상단 기준</span></td>
								</tr>
								
								<tr>
									<th>내용</th>
									<td>
										<textarea name="P_CONTENT" id="P_CONTENT" rows="10" cols="100" style="width:100%; height:412px; display:none;"><? echo $P_CONTENT;?></textarea>
										<script type="text/javascript">
										var oEditors = [];

										// 추가 글꼴 목록
										//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

										nhn.husky.EZCreator.createInIFrame({
											oAppRef: oEditors,
											elPlaceHolder: "P_CONTENT",
											sSkinURI: "/smarteditor/SmartEditor2Skin.html",	
											htParams : {
												bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
												bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
												bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
												//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
												fOnBeforeUnload : function(){
													//alert("완료!");
												}
											}, //boolean
											fOnAppLoad : function(){
												//예제 코드
												//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
											},
											fCreator: "createSEditor2"
										});
										</script>										
									</td>
								</tr>

							</tbody>
						</table>
						<div class="buttom_btnbox">
							<button type="button" class="blue mar_r" onclick="send_it();">저장</button>
							<button type="button" class="gray pops_close_sub">취소</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">


function send_it(){

	var frm = document.frm1;
	oEditors.getById["P_CONTENT"].exec("UPDATE_CONTENTS_FIELD", []);
	if (frm.P_SUBJECT.value == "")
	{
		frm.P_SUBJECT.focus();
		alert("제목을 입력해주세요.");
		return;

	}
	if (frm.P_STARTDAY.value == "")
	{
		frm.P_STARTDAY.focus();
		alert("시작일을 선택해주세요.");
		return;
	}
	if (frm.P_START_HH.value == "")
	{
		frm.P_START_HH.focus();
		alert("시작 시간을 입력해주세요.");
		return;
	}
	if (frm.P_START_MM.value == "")
	{
		frm.P_START_MM.focus();
		alert("시작 분을 입력해주세요.");
		return;
	}
	if (frm.P_ENDDAY.value == "")
	{
		frm.P_ENDDAY.focus();
		alert("종료일을 선택해주세요.");
		return;
	}
	if (frm.P_END_HH.value == "")
	{
		frm.P_END_HH.focus();
		alert("종료 시간을 입력해주세요.");
		return;
	}
	if (frm.P_END_MM.value == "")
	{
		frm.P_END_MM.focus();
		alert("종료 분을 입력해주세요.");
		return;
	}
	if (frm.status[0].checked == false && frm.status[1].checked == false && frm.status[2].checked == false )
	{
		alert("노출여부를 선택해주셔야 합니다.");
		return;
	}

	
	
	$("#frm").submit();










}

</script>