<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>

<?
	$writer			= $_SESSION[customer][name];
	$user_id		= $_SESSION[customer][idx];
	$search_mode	= updateSQ($search_mode);
	$search_word	= updateSQ($search_word);
	$pg				= updateSQ($pg);
	$bbs_idx			= updateSQ($bbs_idx);
	$cnt = 0;
	$btnStr = "등록";


	if ($mode == "reply"){
		$total_sql	= " select * from tbl_bbs_list where bbs_idx='".$bbs_idx."'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);
		$subject	= "[re]".$row[subject];
		$contents	= "-------------------- 원본글 -------------------- <br>".$row[contents];
		$b_step		= $row[b_step];
		$b_level	= $row[b_level];
		$b_ref		= $row[b_ref];
		$secure_yn	= $row[secure_yn];
		$mode		= "reply";
		$passwd		= $_SESSION[customer][passwd];
		$cnt		= 1;
	} elseif ($bbs_idx) {
		$btnStr = "수정";
		$total_sql	= " select * from tbl_bbs_list where bbs_idx='".$bbs_idx."'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);

		if ($_SESSION[customer][level] != "1") {

				if (trim($row[user_id]) != trim($_SESSION[customer][id]) && trim($row2[user_id]) != trim($_SESSION[customer][id])) { 
		?>
				<script>	
					$("body").html("");
					alert("본인의 글이 아닙니다.");
					history.back();
				</script>
		<?
				}
			}

		$passwd	= $row[passwd];
		if ($passwd == "") {
			if ($_SESSION[customer][level] == "1") {
				$passwd = "1111";
			}
		}
		$subject	= $row[subject];
		$notice_yn	= $row[notice_yn];
		$contents	= $row[contents];
		$category	= $row[category];
		$secure_yn	= $row[secure_yn];
		$writer		= $row[writer];
		$user_id	= $row[user_id];	
		$simple		= $row[simple];	
		$url		= $row[url];
		$cnt		= 0;
		$ufile1		= $row[ufile1];
		$rfile1		= $row[rfile1];

		$ufile2		= $row[ufile2];
		$rfile2		= $row[rfile2];

		$ufile3		= $row[ufile3];
		$rfile3		= $row[rfile3];

		$ufile4		= $row[ufile4];
		$rfile4		= $row[rfile4];

		$ufile5		= $row[ufile5];
		$rfile5		= $row[rfile5];

		$ufile6		= $row[ufile6];
		$rfile6		= $row[rfile6];

		$wDate		= $row[r_date];
		$wYY			= substr($wDate,0,4);
		$wMM			= substr($wDate,5,2);
		$wDD			= substr($wDate,8,2);
		$wHH			= substr($wDate,11,2);
		$wII			= substr($wDate,14,2);
		$wSS			= substr($wDate,17,2);

		if ($ufile1 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($ufile2 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($ufile3 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($ufile4 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($ufile5 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($cnt < 1) {
		$cnt		= 1;
		}
	} else {
		$cnt		= 1;
		$writer		= $_SESSION[customer][name];
		if ($_SESSION[customer][level] == "1") {
			$passwd = "1111";
		}
		if ($code == "qna") {
		$secure_yn	= "Y";
		}

	}?>
<script type="text/javascript">
function checkForNumber(str) {
	var key = event.keyCode;
	var frm = document.frm1;
	if(!(key==8||key==9||key==13||key==46||key==144||
	(key>=48&&key<=57)||(key>=96&&key<=105)||key==110||key==190)) {
		event.returnValue = false;
	}
}
	function send_it()
	{
		var frm = document.frm;
		if (frm.writer.value == "")
		{
			frm.writer.focus();
			alert("작성자를 입력해주세요.");
			return;

		}
		if (frm.subject.value == "")
		{
			frm.subject.focus();
			alert("제목을 입력해주세요.");
			return;

		}
		oEditors.getById["contents"].exec("UPDATE_CONTENTS_FIELD", []);
		if (frm.contents.length < 2)
		{
			frm.contents.focus();
			alert_("내용을 입력하셔야 합니다.");
			return;
		}
		frm.submit();
	}
</script>
<!-- 실콘텐츠 시작 //-->





				<form name=frm action="/include/notice_write_ok.php" method=post enctype="multipart/form-data" >
				<input type=hidden name="bbs_idx" value='<?=$bbs_idx?>'> 
				<input type=hidden name="gourl" value='<?=$_SERVER[PHP_SELF]?>'> 
				<input type=hidden name="article_num" value='<?=$cnt?>'> 
				<input type=hidden name="search_mode" value='<?=$search_mode?>'> 
				<input type=hidden name="search_word" value='<?=$search_word?>'> 
				<input type=hidden name="scategory" value='<?=$scategory?>'> 
				<input type=hidden name="code" value='<?=$code?>'> 
				<input type=hidden name="b_step" value='<?=$b_step?>'> 
				<input type=hidden name="b_level" value='<?=$b_level?>'> 
				<input type=hidden name="b_ref" value='<?=$b_ref?>'> 
				<input type=hidden name="pg" value='<?=$pg?>'> 
				<input type=hidden name="mode" value='<?=$mode?>'> 
				<input type="hidden" id="passwd"  name="passwd" value="<?=$passwd?>"  />



				<br />
				<div>
					<table class="ta_write01">
						<caption>자유게시판</caption>
						<colgroup>
						</colgroup>
						<tbody>
							<tr>
								<th>글쓴이</th>
								<td><input type="text" class="wi30 mwi78" id="writer"  name="writer" value="<?=$writer?>" ></td>
							</tr>
							<tr>
								<th>제목</th>
								<td><input type="text" id="subject"  name="subject" value="<?=$subject?>"  class="wi80 mwi185" style="width:80%;"></td>
							</tr>
							<tr>
								<th>내용</th>
								<td>

									<textarea name="contents" id="contents" style="width:100%; height:412px; display:none;"><?=$contents?></textarea>
									<script type="text/javascript">
									var oEditors = [];

									// 추가 글꼴 목록
									//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

									nhn.husky.EZCreator.createInIFrame({
										oAppRef: oEditors,
										elPlaceHolder: "contents",
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
				</div>

				<div class="com_btn_box">
					<div class="center">
						<input type="button" value="확인" class="btn_st01" onclick="javascript:send_it()" />
						<a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="btn_st01">취소</a>
					</div>
				</div>



						<!--input_file 스크립트-->
						<script>
						$(document).ready(function(){
						  var fileTarget = $('.filebox .upload-hidden');

							fileTarget.on('change', function(){
								if(window.FileReader){
									var filename = $(this)[0].files[0].name;
								} else {
									var filename = $(this).val().split('/').pop().split('\\').pop();
								}

								$(this).siblings('.upload-name').val(filename);
							});
						}); 
						</script>


	
	<!-- 실콘텐츠 끝 //--> 
	
</form>
<script>
		function ShowArticleAdd(str) {
			var cnt = document.frm.article_num.value;
			if (str == "+")
			{
				
				if (cnt < 5)
				{
					var row_num=parseInt(cnt)+1;
					document.frm.article_num.value=row_num;
					for(i=0; i < row_num; i++)
					{	
						document.all.layerA[i].style.display="";
					}
				} 
			} else if (str == "-") {
				if (cnt != 0)
				{
					document.all.layerA[cnt].style.display="none";
					var row_num=parseInt(cnt)-1;
					document.frm.article_num.value=row_num;
				}
			}
		}
		for(i=0; i < document.frm.article_num.value; i++)
		{	
			document.all.layerA[i].style.display="";
		}
</script> 
<iframe width="300" height="300" name="sch_frame" src="" style="display:none"></iframe>