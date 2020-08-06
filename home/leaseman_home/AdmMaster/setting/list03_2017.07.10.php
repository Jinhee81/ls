<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2"  data-type="환경설정" data-title="푸쉬메시지관리">푸쉬메시지관리</h2>
				<ul class="right">
					<li class="mar_r"><a href="#!"><img src="/img/main/printer_i.png" alt="프린터 이미지"></a></li>
					<li><a href="#!"><img src="/img/main/excel_i.png" alt="엑셀 이미지"></a></li>
				</ul>
			</div>
			<div class="com_search_box">
				<form action="">
					<fieldset>
						<legend>검색 조회 양식</legend>
						<select name="" id="" class="mar_r10">
							<option value="">등록일시</option>
							<option value="">발송일시</option>
						</select>
						<input type="text" class="calendar" readonly>
						<p class="and_txt">~</p>
						<input type="text" class="calendar mar_r10" readonly>

						<select name="" id="" class="mar_r10">
							<option value="내용">제목</option>
							<option value="내용">내용</option>
						</select>
						<input type="text" class="wd_200 mar_r10">
						<button type="button" class="lookup_btn">검색</button>
					</fieldset>
				</form>
			</div>
			<div class="com_btn_box">				
				<div class="right">
					<button type="button" class="blue_btn" onClick="pops_04_1btn();">추가</button>				
				</div>
			</div>
			<div class="com_tb01">
				<table class="ta_list01">
					<caption>푸싱메시지관리 표</caption>
					<colgroup>
						<col  width="50px" />
					</colgroup>
					<thead>
						<tr>
							<th>순번</th>
							<th>사용여부</th>
							<th>등록자명</th>
							<th>제목</th>
							<th>내용</th>
							<th>수정자명</th>
							<th>수정일시</th>
							<th>등록일시</th>
							<th>발송일시</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>20</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>
						</tr>
						<tr>
							<td>19</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>				
						</tr>
						<tr>
							<td>18</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>
						</tr>
						<tr>
							<td>17</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>
						</tr>
						<tr>
							<td>16</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>				
						</tr>
						<tr>
							<td>15</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>			
						</tr>
						<tr>
							<td>14</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>
						</tr>
						<tr>
							<td>13</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>	
						</tr>
						<tr>
							<td>12</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>	
						</tr>
						<tr>
							<td>11</td>
							<td></td>
							<td>아무개</td>
							<td><a href="list03_mod.php" class="a_color01">장기회원할인</a></td>
							<td><a href="list03_mod.php" class="a_color01">장기계약하신 고객 ....</a></td>
							<td>아무개</td>
							<td>2017-03-26 17:00</td>
							
							<td>2017-03-26 17:00</td>
							<td>2017-03-26 17:00</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php include $_SERVER['DOCUMENT_ROOT']."/inc/pager_wrap_inc.php";?><!-- 페이저 -->
		</div>
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>
