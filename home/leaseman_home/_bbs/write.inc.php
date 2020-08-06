      <div class="inquiry">
			<form name='frm' id='frm' action="bbs_proc.ajax.php" method=post enctype="multipart/form-data" >
				<input type=hidden name="bbs_idx" value='<?=$bbs_idx?>'>
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
				<table>
					<legend><?=getBoardName($code)?></legend>
					<thead>
						<tr>
							<th>글쓴이</th>
							<td>
								<input type="text" name="writer" id="writer" value="<?=$writer?>">
							</td>
						</tr>
						<tr>
							<th>제목</th>
							<td>
								<input type="text" class="title_input" name="subject" id="subject" value="<?=$subject?>">
							</td>
						</tr>
						<tr>
							<th>내용</th>
							<td>
								<textarea cols="40"  rows="40" name="contents" id="contents"><?=$contents?></textarea>
							</td>
						</tr>
					</thead>
				</table>
			</form>
			<div class="btn_box">	
				<b class="on_btn">
				<?if($bbs_idx){?>
				<a href="#!" class="btn_submit">수정하기</a>
				</b>
				<b class="on_btn">
					<a href="./board_list.php?code=<?=$code?>&pg=<?=$pg?>" class="btn_submit">리스트</a>
					<?}else{?>
						<a href="#!" class="btn_submit">저장하기</a>
					<?}?>
				</b>
			</div>
		</div>
	  
<script type="text/javascript">
  $(function(){
    $(".btn_submit").click(function(){
      send_it();
    });
  });
</script>
