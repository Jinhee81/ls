<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<div class="contents"  style="width:90%; margin:15px auto;"> 
<?
	$writer			= $_SESSION[member][name];
	$user_id		= $_SESSION[member][id];
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
		$passwd		= $_SESSION[member][passwd];
		$cnt		= 1;
	} elseif ($bbs_idx) {
		$btnStr = "수정";
		$total_sql	= " select * from tbl_bbs_list where bbs_idx='".$bbs_idx."'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);

		if ($_SESSION[member][level] != "1") {

				if ($row[passwd] != $pass) { 
		?>
				<script>	
					alert("패스워드가 일치하지 않습니다.");
					history.back();
				</script>
		<?
				}
		}

		$passwd	= $row[passwd];
		if ($passwd == "") {
			if ($_SESSION[member][level] == "1") {
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
		$writer		= $_SESSION[member][name];
		$passwd		= $_SESSION[member][passwd];
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
		if (frm.passwd.value == "")
		{
			frm.passwd.focus();
			alert("패스워드를 입력해주세요.");
			return;

		}
		if (frm.subject.value == "")
		{
			frm.subject.focus();
			alert("제목을 입력해주세요.");
			return;

		}
		if ($("textarea#edit").editable("getText").length < 1)
		{
			frm.contents.focus();
			alert("내용을 입력하셔야 합니다.");
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

				<div class="cusView mt20">
					<table cellpadding="0" cellspacing="0" summary="" class="viewTable2">
					<caption></caption>
					<colgroup>
					<col width="30%" />
					<col width="70%" />
					</colgroup>
					<tbody>
						<tr>
							<th>작성자</th>
							<td><input type="text" id="writer"  name="writer" value="<?=$writer?>"  class="input_txt" /></td>
						</tr>
						<tr>
							<th>제목</th>
							<td><input type="text" id="subject" name="subject" value="<?=$subject?>" class="input_txt" /></td>
						</tr>
						<? if ($is_secure == "Y") { ?>
						<tr>
							<th>비밀글</th>
							<td colspan="3"><input type=checkbox name='secure_yn' value="Y" <? if ($secure_yn == "Y") {echo "checked";}?>> 비밀글</td>
						</tr>
						<? } ?>
						<tr>
							<th>비밀번호</th>
							<td><input type="password" id="passwd"  name="passwd" value="<?=$passwd?>"  class="input_txt" /></td>
						</tr>
						<tr class="editor">
							<td colspan="2">
								<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
								<link href="/froala/css/froala_editor.min.css" rel="stylesheet" type="text/css">
								<link href="/froala/css/froala_style.min.css" rel="stylesheet" type="text/css">

								<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
								<script src="/froala/js/froala_editor.min.js"></script>
								<!--[if lt IE 9]>
								<script src="/froala/js/froala_editor_ie8.min.js"></script>
								<![endif]-->
								<script src="/froala/js/plugins/tables.min.js"></script>
								<script src="/froala/js/plugins/urls.min.js"></script>
								<script src="/froala/js/plugins/lists.min.js"></script>
								<script src="/froala/js/plugins/colors.min.js"></script>
								<script src="/froala/js/plugins/font_family.min.js"></script>
								<script src="/froala/js/plugins/font_size.min.js"></script>
								<script src="/froala/js/plugins/block_styles.min.js"></script>
								<script src="/froala/js/plugins/media_manager.min.js"></script>
								<script src="/froala/js/plugins/video.min.js"></script>
								<script src="/froala/js/plugins/char_counter.min.js"></script>
								<script src="/froala/js/plugins/entities.min.js"></script>

								  <script>
									  $(function(){
										$.Editable.DEFAULTS.key = 'Rg1Wb2KYd1Td1WIh1CVc2F==';
										$('#edit').editable({inlineMode: false
											, height: 200
											, fontList: ["나눔고딕","굴림","돋움","바탕","궁서","Arial","Comic Sans MS","Courier New","Georgia","Lucida Sans Unicode","Tahoma","Times New Roman","Trebuchet MS","Verdana"]

											, imageUploadURL: '/froala/upload_image.php'
											, imageUploadParams: {id: "my_editor"}
											, imageMove: true
											, imageResize: true
											, imageTitle: true


										})
									  });
								  </script>
								<textarea id="edit" name="contents" style="display:none"><?=$contents?></textarea>
							</td>
						</tr>
						<tr>
							<th>첨부</th>
							<td colspan="3">
								<a href="javascript:ShowArticleAdd('+')"><img src="/img_board/b_2.gif" style="width:20px"></a> 
								<a href="javascript:ShowArticleAdd('-')"><img src="/img_board/b_1.gif" style="width:20px"></a></p>
									<? for ($i=1;$i<=5;$i++) { ?>
										<input type="file" name="bfile<?=$i?>"  class="input_box"  style="width:96%; margin-top:7px; height:20px;display:<? if (${"ufile".$i} == "") { ?>none<? } ?>" id="layerA"   />
										<? if (${"ufile".$i} != "") { ?><br>파일삭제:<input type=checkbox name="del_<?=$i?>" value='Y'><a href="/include/dn.php?mode=bbs&ufile=<?=${"ufile".$i}?>&rfile=<?=${"rfile".$i}?>"><?=${"rfile".$i}?></a><? } ?>
									<? } ?>
									<p style="margin-top:10px; font-size:11px;"> * 첨부파일 전체 용량은 최대 20M입니다. 초과시 수정을 통해 추가 업로드 하시기 바랍니다. <br />* 이미지는 jpg 또는 gif의 이미지만 업로드 가능합니다. </p>
							</td>
						</tr>
					</tbody>
					</table>
				</div>

				<div class="btnGroup03">
					<ul class="">
						<li class="btnSubmit"><a href="javascript:send_it()">확인</a></li>
						<li class="btnList"><a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>">목록</a></li>
					</ul>
				</div>

				


			

	
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