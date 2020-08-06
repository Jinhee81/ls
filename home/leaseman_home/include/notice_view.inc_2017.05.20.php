<?
	$code	= updateSQ($code);
?>
<script src="/js/jquery.form.js"></script>
<?
	$search_mode	= updateSQ($search_mode);
	$search_word	= updateSQ($search_word);
	$pg				= updateSQ($pg);
	$bbs_idx			= updateSQ($bbs_idx);

	$total_sql		= " select * from tbl_bbs_list where code='$code' and bbs_idx > '".$bbs_idx."' order by bbs_idx asc limit 0, 1";
	$result			= mysql_query($total_sql) or die (mysql_error());
	$row			= mysql_fetch_array($result);
	$p_bbs_idx		= $row[bbs_idx];
	$p_subject		= $row[subject];

	$total_sql		= " select * from tbl_bbs_list where code='$code' and bbs_idx < '".$bbs_idx."' order by bbs_idx desc limit 0, 1";
	$result			= mysql_query($total_sql) or die (mysql_error());
	$row			= mysql_fetch_array($result);
	$n_bbs_idx		= $row[bbs_idx];
	$n_subject		= $row[subject];

	
	$total_sql = " select * from tbl_bbs_list where code='$code' and bbs_idx='".$bbs_idx."'";
	$result = mysql_query($total_sql) or die (mysql_error());
	$row=mysql_fetch_array($result);
	$reply = $row[reply];
	for ($i=1;$i<=5;$i++) {
		${"ufile".$i} = $row["ufile".$i];
		${"rfile".$i} = $row["rfile".$i];
		if ($row["ufile".$i]) {
			$file_chk = "Y";
		}
	}

	if ($_SESSION[member][level] != "1") {
		if ($row[secure_yn] == "Y") {
			$sql2 = " select * from tbl_bbs_list where b_ref='".$row[b_ref]."' and b_step='0'";
			$result2 = mysql_query($sql2) or die (mysql_error());
			$row2=mysql_fetch_array($result2);

				if (trim($row[user_id]) != trim($_SESSION[member][id]) && trim($row2[user_id]) != trim($_SESSION[member][id])) { 
		?>
				<script>	
					$("body").html("");
					alert("본인의 글이 아닙니다.");
					history.back();
				</script>
		<?
				}
		}
	}

	if ($row[secure_yn] == "Y") {
		$secureStr = "<img src='/img_board/icon_key.gif'>";
		if ($_SESSION[member][level] == "0") {
			$secureLink = "";
		} else {
			$secureLink = "secure";
		}
	} else {
		$secureLink = "";
	}

?>

				<div class="notice_view">
					<div class="notice_hbox">
						<h3>
							<? if ($row[notice_yn] == "Y") { ?>
							[공지]
							<? } ?>
							<?=$row[subject]?>
						</h3>
						<p>등록일: <?=str_replace("-",".",substr($row[r_date],0,10))?></p>
					</div>
					<div class="notice_content">
						<div>
							<span class="input_tit">이벤트기간 : <?=str_replace("-",".",$row[s_date])?> ~ <?=str_replace("-",".",$row[e_date])?> </span>
							
						</div>

							<? if (strlen($row[url]) > 10 && $code == "gallery") {?>
									
								<?
									$youtube		= explode("watch?v=",$row[url]);
									$youtube_code	= $youtube[1];
								?>

								<? if ($youtube_code) { ?>
								<div style="text-align:center">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$youtube_code?>" frameborder="0" allowfullscreen></iframe><br>
								</div>
								<? } ?>
							<? } ?>

							<? for ($i=1;$i<=5;$i++) { ?>
								<? 
								if (${"ufile".$i}) {
									if (check_file_ext(${"ufile".$i}, "jpg;gif;png") == true) {
									?>
										<img src="/data/bbs/<?=${"ufile".$i}?>"><br><br><br>
									<? } ?>
								<? } ?>
							<? } ?>

						<div style="padding:10px"><?=viewSQ($row[contents])?></div>
						<? if ($file_chk == "Y" && $skin == "default") { ?>
						<div>
							<span class="input_tit">첨부파일</span>
							<? for ($i=1;$i<=5;$i++) { ?>
							<? if (${"ufile".$i} != "") { if (check_file_ext(${"ufile".$i}, "jpg;gif;png") == false) {?><span><a href="/include/dn.php?mode=bbs&ufile=<?=${"ufile".$i}?>&rfile=<?=${"rfile".$i}?>" class="file"><?=${"rfile".$i}?></a></span><br><? }} ?>
							<? } ?>
						</div>
						<? } ?>
								
					</div>
					<? if ($p_bbs_idx != "" && $n_bbs_idx != "") { ?>
					<div class="notice_list">
						<ul>
							<? if ($p_bbs_idx != "") { ?>
							<li>
								<p class="left">다음</p>
								<a href="<?=$_SERVER[PHP_SELF]?>?mode=view&bbs_idx=<?=$p_bbs_idx?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="right"><?=$p_subject?></a>
							</li>
							<? } ?>
							<? if ($n_bbs_idx != "") { ?>
							<li>
								<p class="left">이전</p>
								<a href="<?=$_SERVER[PHP_SELF]?>?mode=view&bbs_idx=<?=$n_bbs_idx?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="right"><?=$n_subject?></a>
							</li>
							<? } ?>
						</ul>
					</div>
					<? } ?>
					<ul class="btn_wrap2">
						<li><a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>">목록으로</a></li>
					</ul>
				</div>



				<form name=frm action="<?=$_SERVER[PHP_SELF]?>" method=post>
				<input type=hidden name="bbs_idx" value='<?=$bbs_idx?>'> 
				<input type=hidden name="mode" value='modify'> 
				<input type=hidden name="smode" value=''> 
				<input type=hidden name="cidx" value=''> 
				<input type=hidden name="search_mode" value='<?=$search_mode?>'> 
				<input type=hidden name="scategory" value='<?=$scategory?>'> 
				<input type=hidden name="search_word" value='<?=$search_word?>'> 
				<input type=hidden name="code" value='<?=$code?>'> 
				<input type=hidden name="pg" value='<?=$pg?>'> 

				</form>

		


				

<script>
		function mod_it() {

			<? if ($_SESSION[member][level] == "1" || trim($row[user_id]) == trim($_SESSION[member][id]) ) { ?>
			document.frm.method = "get";
			document.frm.submit();
			<? } else { ?>
				alert("본인의 글만 수정이 가능합니다.");
			<? } ?>
		}
		function reply_it() {
			document.frm.mode.value = "reply"
			document.frm.submit();
		}
		function del_it() {
			<? if ($_SESSION[member][level] == "1" ||  trim($row[user_id]) == trim($_SESSION[member][id])) { ?>
			document.frm.mode.value	= "delete";
			document.frm.method = "get";
			document.frm.submit();
			<?} else {?>
				alert("본인의 글만 삭제가 가능합니다.");
			<?}?>
		}

</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">

$(document).ready(function() {
    $('.boardViewTable img').each(function() {
    var maxWidth = 1020; // Max width for the image
    var maxHeight = 10000;    // Max height for the image
    var ratio = 0;  // Used for aspect ratio
    var width = $(this).width();    // Current image width
    var height = $(this).height();  // Current image height

    // Check if the current width is larger than the max
    if(width > maxWidth){
        ratio = maxWidth / width;   // get ratio for scaling image
        $(this).css("width", maxWidth); // Set new width
        $(this).css("height", height * ratio);  // Scale height based on ratio
        height = height * ratio;    // Reset height to match scaled image
    }

    var width = $(this).width();    // Current image width
    var height = $(this).height();  // Current image height

    // Check if current height is larger than max
    if(height > maxHeight){
        ratio = maxHeight / height; // get ratio for scaling image
        $(this).css("height", maxHeight);   // Set new height
        $(this).css("width", width * ratio);    // Scale width based on ratio
        width = width * ratio;    // Reset width to match scaled image
    }
	});
});
</SCRIPT>

<!-- 댓글 달기 부분 끝 //--> 

<iframe width="300" height="300" name="sch_frame" src="" style="display:none"></iframe>
<!-- 실콘텐츠 끝 //-->
<?
	$sql	= " update tbl_bbs_list set hit = hit + 1 where code='$code' and bbs_idx='".$bbs_idx."'";
	$result = mysql_query($sql) or die (mysql_error());
?>

