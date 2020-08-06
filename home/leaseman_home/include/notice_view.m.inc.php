<?
	$code	= updateSQ($code);
?>
<script src="/js/jquery.form.js"></script>
<?
	$search_mode	= updateSQ($search_mode);
	$search_word	= updateSQ($search_word);
	$pg				= updateSQ($pg);
	$bbs_idx			= updateSQ($bbs_idx);

	$total_sql = " select * from tbl_bbs_list where code='$code' and bbs_idx='".$bbs_idx."'";
//	echo $total_sql;
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

				if ($row[passwd] != $pass && $row2[passwd] != $pass ) { 
		?>
				<script>	
					$("body").html("");
					alert("패스워드가 일치하지 않습니다.");
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
<!-- 실콘텐츠 시작 //-->
				<div class="viewBox mt20">
					<table  width="100%" cellpadding="0" cellspacing="0" summary="" class="viewTable">
					<caption></caption>
					<colgroup>
					<col width="100%" />
					</colgroup>
					<thead>
						<tr>
							<th>
							<? if ($row[notice_yn] == "Y") { ?>
							<img src="/img_board/icon_tit.gif" alt="공지" > 
							<? } ?>
							<?=$row[subject]?>
							</th>							
						</tr>
						<tr>
							<td><?=substr($row[r_date],0,10)?> <span class="pl5">조회수:<?=$row[hit]?></span></td>
						</tr>
					</thead>	
					<tbody>
						<tr>
							<td>
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
					<? if (strlen($row[url]) > 10) {?>
					<div id="bbs_view_link"><img src="/img_board/icon_link.gif"> <a href="http://<?=str_replace("http://","",$row[url])?>" target=_blank><?=str_replace("http://","",$row[url])?></a></div>
					<? } ?>
					<? if ($file_chk == "Y") { ?>
					<div id="bbs_view_file">
								<? for ($i=1;$i<=5;$i++) { ?>
									<? if (${"ufile".$i} != "") { ?><img alt="파일" src="/img_board/icon_file.gif" align="absmiddle" style="width:14px;height:17px"> <a href="/include/dn.php?mode=bbs&ufile=<?=${"ufile".$i}?>&rfile=<?=${"rfile".$i}?>"><?=${"rfile".$i}?></a><br><? } ?>
								<? } ?>
					</div>
					<? } ?>
							</td>
						</tr>
					</tbody>
					</table>
				</div>

				<form name=frm action="<?=$_SERVER[PHP_SELF]?>" method=post>
				<input type=hidden name="bbs_idx" value='<?=$bbs_idx?>'> 
				<input type=hidden name="mode" value='modify'> 
				<input type=hidden name="smode" value='secure'> 
				<input type=hidden name="cidx" value=''> 
				<input type=hidden name="search_mode" value='<?=$search_mode?>'> 
				<input type=hidden name="scategory" value='<?=$scategory?>'> 
				<input type=hidden name="search_word" value='<?=$search_word?>'> 
				<input type=hidden name="code" value='<?=$code?>'> 
				<input type=hidden name="pg" value='<?=$pg?>'> 
				<?
						$sql    = " select bbs_idx from tbl_bbs_list where code='$code' ".$strSql." and bbs_idx > $bbs_idx order by  notice_yn asc,  b_ref desc, b_step asc  limit 0, 1";
						$result = mysql_query($sql) or die (mysql_error());
						$row=mysql_fetch_array($result);
						$nidx = $row[bbs_idx];

						$sql    = " select bbs_idx from tbl_bbs_list where code='$code' ".$strSql." and bbs_idx < $bbs_idx order by  notice_yn desc,  b_ref desc, b_step asc  limit 0, 1";
						$result = mysql_query($sql) or die (mysql_error());
						$row=mysql_fetch_array($result);
						$pidx = $row[bbs_idx];
				?>
				<div class="btnGroup02">
					<ul class="">
						<? if ($code != "qna") { ?>
						<li class="btnPrev"><? if ($pidx) { ?><a href="<?=$_SERVER[PHP_SELF]?>?mode=view&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>&bbs_idx=<?=$pidx?>"><? } else { ?><a href="javascript:alert('더 이상 글이 없습니다.');"><? } ?>이전</a></li>
						<li class="btnCenter"><a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>">목록</a></li>
						<li class="btnNext"><? if ($nidx) { ?><a href="<?=$_SERVER[PHP_SELF]?>?mode=view&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>&bbs_idx=<?=$nidx?>"><? } else { ?><a href="javascript:alert('더 이상 글이 없습니다.');"><? } ?>다음</a></li>
						<li class="fr"><p class="btnList"><a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>">목록</a><span class="active"></span></p></li>
						<? } else { ?>
						<li class="btnCenter" style="width:100%;padding-bottom:10px"><a href="<?=$_SERVER[PHP_SELF]?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>">목록</a></li>
						<? } ?>

					</ul>
				</div>
				<div class="btnGroup02 type02" style="clear:both">
					<ul class="">

						<? if ($is_reply == "Y") { ?>
						<li class="btnPrev"><a href="javascript:reply_it();">답변</a></li>
						<? } ?>
						<? if ($is_right == "Y" || $_SESSION[member][level] == "1") { ?>
						<li class="btnCenter"><a href="javascript:mod_it();">수정</a></li>
						<li class="btnNext"><a href="javascript:del_it();">삭제</a></li>
						<? } ?>
					</ul>
				</div>


						</form>


				

<script>
		function mod_it() {
			document.frm.method = "get";
			document.frm.submit();
		}
		function reply_it() {
			document.frm.mode.value = "reply"
			document.frm.submit();
		}
		function del_it() {
			document.frm.mode.value	= "delete";
			document.frm.method = "get";
			document.frm.submit();
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

