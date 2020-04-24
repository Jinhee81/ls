			<div class="notice_view <?=$class_name?>">	
					<table>
						<legend><?=getBoardName($code)?>_뷰</legend>
						<colgroup>
							<col class="tit">
							<col>
							<col class="tit">
							<col>
						</colgroup>
						<thead>
							<tr>
								<th>제목</th>
								<td><?=$subject?>.</td>
								<th>작성일</th>
								<td><?=substr($wDate,0,10)?></td>	
							</tr>
						</thead>	
						<tbody>	
							
							<tr>
								<th>글쓴이</th>
								<td><?=$writer?></td>
								<th>조회수</th>
								<td><?=$hit?></td>
							</tr>
							<tr>
								<th>내용</th>
								<td colspan="3">	
									<? if (right($row[ufile1], 3) == "jpg" || right($row[ufile1], 3) == "png" || right($row[ufile1], 3) == "gif" ) { ?>
									<div style="text-align:center"><img src="/data/bbs/<?=$row[ufile1]?>"></div>
									<br>
									<? } ?>
									<?=nl2br(viewSQ($contents))?>
								</td>
							</tr>
							<?
								if ($code !="h_after" && $skin == "default2" ) { 
							?>

							<tr style="height:300px;">
								<th>답변</th>
								<td colspan="3">
									<?=viewSQ($reply)?>
								</td>
							</tr>


							<?
								}
							?>
							<? if ($skin == "gallery") { ?>
							<tr>
								<th>썸네일첨부</th>
								<td colspan="3">
										<? for ($i=6;$i<=6;$i++) { ?>
											
											<? if (${"ufile".$i} != "") { ?><br><a href="/include/dn.php?mode=bbs&ufile=<?=${"ufile".$i}?>&rfile=<?=${"rfile".$i}?>"><?=${"rfile".$i}?></a><? } ?>
										<? } ?>
								</td>
							</tr>
							<? } ?>
							
							<?if($file_check ==true){?>
							<tr <? if ($skin == "faq" || $skin == "gallery") {?>style="display:none"<?}?>>
								<th>파일첨부</th>
								<td colspan="3">
									<? for ($i=1;$i<=1;$i++) { ?>
									<div class="layerA " style="display:<? if (${"ufile".$i} == "") { ?>none<? } ?>">
									<? if (${"ufile".$i} != "") { ?><br><a href="/include/dn.php?mode=bbs&ufile=<?=${"ufile".$i}?>&rfile=<?=${"rfile".$i}?>"><?=${"rfile".$i}?></a><? } ?>
									</div>
									<? } ?>
									&nbsp;&nbsp;&nbsp; 
								</td>
							</tr>
							<?}?>
						</tbody>	
					</table>
					<div class="notice_bar">
						<ul class="view_btn">
								<?
									if($_SESSION['member']['id'] ==$row['user_id']){
								?>
							<li><button class="mod_btn over_txt"  attidx="<?=$row['bbs_idx']?>">수정</button></li>
							<?}?>
							<li>
								<a href="board_list.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&pg=<?=$pg?>">
								<button class="go_list">
								목록으로
								
								</button>
								</a>
							</li>
							<?if($_SESSION['member']['id'] ==$row['user_id']){
									if($isRight =="Y" && $row['b_level']==0){
							?>
							<li><button class="del_btn" attidx="<?=$row['bbs_idx']?>" onclick="del_chk('<?=$row['bbs_idx']?>')">삭제</button></li>
							<?
								}
							}
							?>
						</ul>
					
						
					</div>
				</div>
	<script>
	$(function(){
		$("#frm").ajaxForm({
			url: "bbs_proc.ajax.php",
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
						location.href="board_list.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&bbs_idx=<?=$bbs_idx?>&pg=<?=$pg?>";
					}, 1000);
					<?
					} else if ($_GET[bbs_idx] == "") { 
					?>
					alert_("정상적으로 등록되었습니다.");
					setTimeout(function() {
						location.href="board_list.php?code=<?=$code?>";
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
		<?
			if ($isCategory	== "Y") { 
		?>
			/*
		if (frm.category.value == "")
		{
			frm.category.focus();
			alert_("구분을 선택해주세요.");
			return;

		}
			*/
		<?	
			} 
		?>
		if (frm.subject.value == "")
		{
			frm.subject.focus();
			alert_("제목을 입력해주세요.");
			return;

		}
		if (frm.writer.value == "")
		{
			frm.writer.focus();
			alert_("작성자를 입력해주세요.");
			return;

		}

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

	function del_chk(bbs_idx)
	{
		if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false)
		{
			return;
		}
		$("#ajax_loader").removeClass("display-none");
        $.ajax({
			url: "bbs_del.ajax.php",
			type: "POST",
			data: "bbs_idx[]="+bbs_idx,
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				if (response == "OK")
				{
					alert("정상적으로 삭제되었습니다.");
					setTimeout(function() {
						location.href="board_list.php?code=<?=$code?>";
					}, 1000);
					return;
				} else {
					alert("오류가 발생하였습니다!!");
					return;
				}
			}
        });


	}
	$(function(){
		$(".mod_btn").click(function(){
			var bbs_idx =$(this).attr('attidx');
			location.href="./board_write.php?code=<?=$code?>&pg=<?=$pg?>&bbs_idx="+bbs_idx;
		});
	});
</script> 

<?	
	if ($is_comment == "Y" && $bbs_idx != "") {
//		include "./notice_comment.inc.php"; 
	}
?>