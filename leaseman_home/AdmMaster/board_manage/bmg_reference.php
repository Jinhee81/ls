<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="게시판관리" data-title="자료실관리">자료실관리</h2>
			</div>
				
			<div class="com_btn_box">
				<div class="right">
					<button type="button" class="blue_btn " onClick="pops_02_2btn();">자료 추가</button>
					<button type="button" class="gray_btn">삭제</button>
				</div>
			</div>

			<div class="com_tb01">
				<table class="ta_list01">
					<caption>자료실관리</caption>
					<colgroup>
						<col width="50px">
						<col width="50px">
					</colgroup>
					<thead>
						<tr>
							<th><input type="checkbox" id="board_check00" class="all_check"><label for="board_check00"></label></th>
							<th>순번</th>
							<th>분류</th>
							<th>제목</th>
							<th>첨부파일</th>
							<th>등록일시</th>
							<th>등록자명</th>
							<th>수정일시</th>
							<th>수정자명</th>
							<th>옵션</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="checkbox" id="board_check01"><label for="board_check01"></label></td>
							<td>10</td>
							<td>가이드</td>
							<td>가이드4</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
						<tr>
							<td><input type="checkbox" id="board_check02"><label for="board_check02"></label></td>
							<td>9</td>
							<td>기타</td>
							<td>기타5</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
						<tr>
							<td><input type="checkbox" id="board_check03"><label for="board_check03"></label></td>
							<td>8</td>
							<td>가이드</td>
							<td>가이드1</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
						<tr>
							<td><input type="checkbox" id="board_check04"><label for="board_check04"></label></td>
							<td>7</td>
							<td>가이드</td>
							<td>가이드2</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
						<tr>
							<td><input type="checkbox" id="board_check05"><label for="board_check05"></label></td>
							<td>6</td>
							<td>가이드</td>
							<td>가이드3</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
						<tr>
							<td><input type="checkbox" id="board_check06"><label for="board_check06"></label></td>
							<td>5</td>
							<td>기타</td>
							<td>기타1</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
						<tr>
							<td><input type="checkbox" id="board_check07"><label for="board_check07"></label></td>
							<td>4</td>
							<td>기타</td>
							<td>기타2</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
						<tr>
							<td><input type="checkbox" id="board_check08"><label for="board_check08"></label></td>
							<td>3</td>
							<td>기타</td>
							<td>기타3</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
						<tr>
							<td><input type="checkbox" id="board_check09"><label for="board_check09"></label></td>
							<td>2</td>
							<td>기타</td>
							<td>기타4</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
						<tr>
							<td><input type="checkbox" id="board_check10"><label for="board_check10"></label></td>
							<td>1</td>
							<td>기타</td>
							<td>기타5</td>
							<td></td>
							<td>2017-03-21 17:00</td>
							<td>아무개</td>
							<td>2017-03-22 18:00</td>
							<td>아무개</td>
							<td><a href="bmg_reference_mod.php">수정</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>