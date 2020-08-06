<? include "../_include/_header.php"; ?>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<?
	

		$total_sql	= " select * from tbl_open where idx='1'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);
		
?>

		<div id="container">
		<span id="print_this"><!-- 인쇄영역 시작 //-->

			<header id="headerContainer">
				
				<div class="inner">
					<h2>창업이야기</h2>
					<div class="menus">
						<ul class="last">							
							
							<li><a href="javascript:send_it();" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
							
						</ul>
						
					</div>

				</div><!-- // inner -->

			</header><!-- // headerContainer -->

			<div id="contents">
				

		<div class="listWrap_noline">

					


					<form name=frm id=frm action="bbs_proc.ajax_open.php" method=post enctype="multipart/form-data" >
					
					<div class="listBottom">
						<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
						<caption></caption>
						<colgroup>
						<col width="150px" />
						<col width="*" />
						</colgroup>
	
						<tbody>
							
							<tr>
								<th>내용</th>
								<td>
									<textarea name="contents" id="contents_" rows="10" cols="100" class="input_txt" style="width:100%; height:412px; display:none;"><?=$row[contents]?></textarea>
									<script type="text/javascript">
									var oEditors = [];

									// 추가 글꼴 목록
									//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

									nhn.husky.EZCreator.createInIFrame({
										oAppRef: oEditors,
										elPlaceHolder: "contents_",
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
					</div><!-- // listBottom -->
					</form>

					
				</div><!-- // listWrap -->

			</div><!-- // contents -->





		</span><!-- 인쇄 영역 끝 //-->
		</div><!-- // container -->





<script>

	$(function(){
		$("#frm").ajaxForm({
			url: "bbs_proc.ajax_open.php",
			type: "POST",
			data: $("#frm").serialize(),
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				if (response == "OK") {
					<? 
					if ($mode == "reply") 
					{
					?>
					alert_("정상적으로 등록되었습니다.");
					setTimeout(function() {
						location.href="p1.php";
					}, 1000);
					<?
					} else if ($_GET[bbs_idx] == "") { 
					?>
					alert_("정상적으로 등록되었습니다.");
					setTimeout(function() {
						location.href="p1.php";
					}, 1000);
					<? } else { ?>
					alert_("정상적으로 수정되었습니다.");
					setTimeout(function() {
						location.reload();
					}, 1000);
					<? } ?>
					return;
				} else if (response == "NF") {
					alert_("업로드 금지 파일입니다.");
					return;
				} else {
					alert(response);
					alert_("오류가 발생하였습니다!!");
					return;
				}
			}
		});
	});

	

	function send_it()
	{
		var frm = document.frm;
		

		oEditors.getById["contents_"].exec("UPDATE_CONTENTS_FIELD", []);
		if (frm.contents.length < 2)
		{
			frm.contents.focus();
			alert_("내용을 입력하셔야 합니다.");
			return;
		}
		$("#ajax_loader").removeClass("display-none");
		$("#frm").submit();
	}

	
</script> 


<? include "../_include/_footer.php"; ?>