<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>	
<?
	$code	= "news";
?>
<script src="/js/jquery.form.js"></script>
<?
	$sql	= " update tbl_bbs_list set hit = hit + 1 where code='$code' and bbs_idx='".$bbs_idx."'";
	$result = mysql_query($sql) or die (mysql_error());
	$search_mode	= updateSQ($search_mode);
	$search_word	= updateSQ($search_word);
	$pg				= updateSQ($pg);
	$bbs_idx			= updateSQ($bbs_idx);

	$total_sql		= " select * from tbl_bbs_list where code='$code' and bbs_idx > '".$bbs_idx."' order by bbs_idx asc limit 0, 1";
	$result			= mysql_query($total_sql) or die (mysql_error());
	$row			= mysql_fetch_array($result);
	$p_bbs_idx		= $row['bbs_idx'];
	$p_subject		= $row['subject'];

	$total_sql		= " select * from tbl_bbs_list where code='$code' and bbs_idx < '".$bbs_idx."' order by bbs_idx desc limit 0, 1";
	$result			= mysql_query($total_sql) or die (mysql_error());
	$row			= mysql_fetch_array($result);
	$n_bbs_idx		= $row['bbs_idx'];
	$n_subject		= $row['subject'];

	
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

	// 이전글을 얻음
	$prev_subject;
	$sql = " select bbs_idx, subject from tbl_bbs_list where code='".$code."' and bbs_idx < ".$bbs_idx." order by bbs_idx desc  limit 1 ";
	$prev_result = mysql_query($sql) or die (mysql_error());
	$prev =mysql_fetch_array($prev_result);
	$prev_url = "?bbs_idx=".$prev['bbs_idx'];
	if(!$prev['bbs_idx'])
		$prev_url ="#!";
	$prev_subject = $prev['subject'];
	if(!$prev_subject)
		$prev_subject ="이전글이 없습니다.";
	

    // 아래글을 얻음
	$next_subject ="";
    $sql = " select bbs_idx, subject from tbl_bbs_list where code='".$code."' and bbs_idx > ".$bbs_idx." order by bbs_idx desc limit 1 ";
	$next_result = mysql_query($sql) or die (mysql_error()); 
	$next =mysql_fetch_array($next_result);
	$next_url = "?bbs_idx=".$next['bbs_idx'];
	if(!$next['bbs_idx'])
		$next_url ="#!";
	$next_subject = $next['subject'];
	if(!$next_subject)
		$next_subject ="다음글이 없습니다.";
    

	if ($_SESSION['member']['level'] != "1") {
		if ($row['secure_yn'] == "Y") {
			$sql2 = " select * from tbl_bbs_list where b_ref='".$row['b_ref']."' and b_step='0'";
			$result2 = mysql_query($sql2) or die (mysql_error());
			$row2=mysql_fetch_array($result2);

				if (trim($row['user_id']) != trim($_SESSION['member']['id']) && trim($row2['user_id']) != trim($_SESSION['member']['id'])) { 
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

	if ($row['secure_yn'] == "Y") {
		$secureStr = "<img src='/img_board/icon_key.gif'>";
		if ($_SESSION['member']['level'] == "0") {
			$secureLink = "";
		} else {
			$secureLink = "secure";
		}
	} else {
		$secureLink = "";
	}

?>
	<section id="container" >	
		<? include('cs_inc.php');?>		
		<div class="wrap_1000">
			<div class="sub_tit">
				<h2><span class="stm_active">뉴스</span></h2>
			</div>
			<div class="wrap_in">
				<div class="sc_top">
					
					<p class="sc_txt">
							<? if ($row['notice_yn'] == "Y") { ?>
							[공지]
							<? } ?>
							
					</p>
				</div>
				<div class="board_view">
					<table class="ta_view">
						<colgroup>
							<col class="colw01">
							<col class="colw02">
							<col class="colw01">
							<col class="colw02">
						</colgroup>
						<thead>
							<tr>
								<th>제목</th>
								<td><?=viewSQ($row['subject'])?></td>
								<th>작성일</th>
								<td><?=str_replace("-",".",substr($row['r_date'],0,10))?></td>
							</tr>
							<tr>
								<th>작성자</th>
								<td><?=$row["writer"]?></td>
								<th>조회수</th>
								<td><?=$row["hit"]?></td>
							</tr>
							<?if($file_chk){?>
							<tr>
								<th>파일첨부</th>
								<td colspan="3">
									<img src="../img/ico/icon_file.png" alt="파일" />
									<? for ($i=1;$i<=5;$i++) { ?>
									<? if (${"ufile".$i} != "") { ?><a href="/include/dn.php?mode=bbs&ufile=<?=${"ufile".$i}?>&rfile=<?=${"rfile".$i}?>" class="file"><?=${"rfile".$i}?><br><? } ?>
									<? } ?>
								</td>
							</tr>
							<?}?>
						</thead>
						<tbody>
						<tr>
							<td colspan="4" class="view_content">
							<? for ($i=1;$i<=5;$i++) { ?>
								<? 
								if (${"ufile".$i}) {
									if (check_file_ext(${"ufile".$i}, "jpg;gif;png") == true) {
									?>
										<img src="/data/bbs/<?=${"ufile".$i}?>"><br><br><br>
									<? } ?>
								<? } ?>
							<? } ?>
							<? if (strlen($row['url']) > 10 && $code == "gallery") {?>
									
							
				
								
							<? } ?>
								<div style="padding:10px"><?=viewSQ($row['contents'])?></div>
							</td>
						</tr>
						</tbody>
						<tfoot>
							<tr class="prevpage">
								<th>이전글</th>
								<td colspan="3"><a href="<?=$prev_url?>"><?=$prev_subject?></a></td>
							</tr>
							<tr class="nextpage">
								<th>다음글</th>
								<td colspan="3"><a href="<?=$next_url?>"><?=$next_subject?></a></td>
							</tr>
						</tfoot>
					</table>
					<div class="btn_wrap">
						<a href="news.php?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="go_list">목록으로</a>
					</div>
				</div>
			</div>
		</div>
	</section>
<? include('../inc/footer.inc.php');?>	