<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>		
	<section id="container" >	
		<? include('qna_inc.php');?>	
		<?
		if($_POST['check_frm'] !="Y"){
			alert_msg("잘못된 접근입니다.");
			exit;
		}
		
		$idx			= $_POST['link_idx'];
		
		$total_sql		= " select * from tbl_inquiry where idx='$idx'";
		$result			= mysql_query($total_sql) or die (mysql_error());
		$row			= mysql_fetch_array($result);
		
		$p_subject		= $row['product_name'];

		
		?>
		<div class="wrap_1000">
			<div class="sub_tit">
				<h2>견적의뢰</h2>
			</div>
			<div class="wrap_in">
				<div class="sc_top">
					<p class="sc_txt">
						<?//=$row['product_name']?>
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
								<th>제품명</th>
								<td><?=viewSQ($row["product_name"])?></td>
								<th>작성일</th>
								<td><?=str_replace("-",".",substr($row['r_date'],0,10))?></td>
							</tr>
							<tr>
								<th>업체명/담당자</th>
								<td><?=$row["user_name"]?></td>
								<th>확인여부</th>
								<td><?=$row["is_free"]?"확인":"미확인";?></td>
							</tr>
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
								<div style="padding:10px"><?=nl2br($row['contents'])?></div>
							</td>
						</tr>
						<?if($row['comment']){?>
						<tr>
							<th style="background:#fafafa">답변</th>
							<td colspan="3" class="view_content">
								<div style="padding:10px"><?=nl2br($row['comment'])?></div>
							</td>
						</tr>
						<?}?>
						</tbody>
						<!-- <tfoot>
							<tr class="prevpage">
								<th>이전글</th>
								<td colspan="3"><a href="#">이전글이 없습니다.</a></td>
							</tr>
							<tr class="nextpage">
								<th>다음글</th>
								<td colspan="3"><a href="#">현대백화점</a></td>
							</tr>
						</tfoot> -->
					</table>
					<div class="btn_wrap">
						<a href="qna.php?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&pg=<?=$pg?>" class="go_list">목록으로</a>
					</div>
				</div>
			</div>
		</div>
	</section>
<? include('../inc/footer.inc.php');?>	