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
						 <?
							if($isCategory =="Y"){
								$sql_cate ="select * from tbl_bbs_category where code ='".$code."' and onum =0";
								$result_cate =mysql_query($sql_cate);
						  ?>
						<tr>
							<th>상담유형</th>
							<td>
								<select name="category" id="category">
									
									<option value="">선택해주세요</option>
						<?
								$check_select ="";
								$check_select2 ="";
								while ($row_cate =mysql_fetch_assoc($result_cate)) {
									if($category)
										if($category ==$row_cate['tbc_idx'])
											$check_select ="selected";
										else $check_select ="";
									echo "<option value='".$row_cate['tbc_idx']."' ".$check_select .">".$row_cate['subject']."</option>";
								  }
								  ?>
								</select>
							</td>
						</tr>
						<?}?>
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
								<textarea cols="40" span="20" name="contents" id="contents"><?=$contents?></textarea>
							</td>
						</tr>
						<tr>
							<th>이메일</th>
							<td>
								<input type="email" placeholder="crazy830727@naver.com" name="user_email" id="user_email" value="<?=$user_email?>">
							</td>
						</tr>
						<tr>
							<input type="hidden" class="qna_writer" name="user_hp" id="user_hp"value="<?=$user_hp?>">
							<th>휴대폰</th>
							<td>
								<input type="tel" name="hp1" maxlength="4">
								 <span> -  </span>
								<input type="tel" name="hp2" maxlength="4">
								 <span> -  </span>
								<input type="tel" name="hp3" maxlength="4">
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
						<a href="#!" class="btn_submit">문의하기</a>
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
