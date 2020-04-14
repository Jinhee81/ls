			<div class="video_view">	
					<table>
						<legend><?=getBoardName($code)?>_뷰</legend>
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
								<td colspan="2">	
									<? if (right($row[ufile1], 3) == "jpg" || right($row[ufile1], 3) == "png" || right($row[ufile1], 3) == "gif" ) { ?>
									<div style="text-align:center"><img src="/data/bbs/<?=$row[ufile1]?>"></div>
									<br>
									<? } ?>
									<div class="view_area"><?=nl2br(viewSQ($contents))?></div>
								</td>
							</tr>
						</tbody>	
					</table>
					<div class="notice_bar">
						<ul class="view_btn">
							<li><a href="board_list.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&pg=<?=$pg?>"><b class="on_btn">
								목록으로</a></b>
							</li>
						</ul>
					</div>
						
				</div>

<script type="text/javascript">
$(document).ready(function(){
	$(window).resize(function(){
		iframe_resize();
	});
});
function iframe_resize(){
	$("iframe").load(function(){ //iframe 컨텐츠가 로드 된 후에 호출됩니다.
		var frame = $(this).get(0);
		var doc = (frame.contentDocument) ? frame.contentDocument : frame.contentWindow.document;
		$(this).height(doc.body.scrollHeight);
		$(this).width(doc.body.scrollWidth);
	});
}
</script>
