<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>		
<?
	$code			= "product";
	$scategory		= updateSQ($_GET['scategory']);
	$search_word	= updateSQ($_GET['search_word']);
	$search_mode	= updateSQ($_GET['search_mode']);
	$is_category	= isBoardCategory($code);
	
	$g_list_rows	= 12;
	
	$cate1_arry =$_GET['cate1'];
	$cate2_arry =$_GET['cate2'];
	$search_cate1 ="";
	$search_cate1_1 ="";
	
	$cate1 ="";
	$cate1_key ="&cate1[]=";
	if(is_array($cate1_arry)){
		foreach($cate1_arry as $key=>$value){
			if($search_cate1 ==""){
				$search_cate1 .="'".$value."'";
				$search_cate1_1 .=$value;
			}
			else{
				$search_cate1 .=",'".$value."'";
				$search_cate1_1 .=",".$value;
			}
			$cate1 .=$cate1_key.$value;
		}
	}else{
		if($cate1_arry){
			$search_cate1 .="'".$cate1_arry."'";
			$search_cate1_1 .=$cate1_arry;
		}
	}


	$search_cate2 ="";
	$search_cate2_1 ="";
	$cate2 ="";
	$cate2_key ="&cate2[]=";

	if(is_array($cate2_arry)){
		foreach($cate2_arry as $key=>$value){
			if($search_cate2 ==""){
				$search_cate2 .="'".$value."'";
				$search_cate2_1 .=$value;
			}
			else{
				$search_cate2 .=",'".$value."'";
				$search_cate2_1 .=",".$value;
			}
			$cate2 .=$cate2_key.$value;
		}
	}else{
		//$search_cate2 .="'".$cate2_arry."'";
		//$search_cate2_1 .=$cate2_arry;
	}
	
	if ($search_word != "") {
		if ($search_mode != "") {
			$strSql = " and $search_mode like '%$search_word%' ";
		} else {
			$strSql = " and (subject like '%$search_word%' or contents like '%$search_word%') ";
		}
	}
	if ($scategory != "") {
		$strSql = $strSql." and category = '$scategory'";
	}
	//카테고리 검색쿼리
	$cate_sql ="";
	if($search_cate1)
		$cate_sql .=" and cate1 in(".$search_cate1.") ";
	
	if($search_cate2)
		$cate_sql .=" and cate2 in(".$search_cate2.") ";
	
	
	$strSql = $strSql." and code = '$code'";
	$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt from tbl_bbs_list where 1=1 ".$strSql. $cate_sql;
	
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);
?>
						
	<section id="container" >	
		<? include('installation_examples_inc.php');?>	
		<div class="wrap_1000">
			<div class="sub_tit">
				<h2>설치사례</h2>
			</div>
			<div class="ga_list wrap_in">
				<form method="GET" name="frm" id="frm" class="ga_search_box">
					<fieldset>
						<legend></legend>
						<table>
							<tbody>
								<tr>
									<th>제목별</th>
									<td>
										<input type="text" id="search_word" name="search_word" />
									</td>
								</tr>
								<tr>
									<th>설치유형</th>
									<td class="checkbox_list">
										<label><input type="checkbox" id="" name="cate1[]" value="비디오월(홍보형)" class=""><span></span>비디오월(홍보형)</label>
										<label><input type="checkbox" id="" name="cate1[]" value="비디오월(관제형)" class=""><span></span>비디오월(관제형)</label>
										<label><input type="checkbox" id="" name="cate1[]" value="키오스크" class=""><span></span>키오스크</label>
										<label><input type="checkbox" id="" name="cate1[]" value="메뉴보드" class=""><span></span>메뉴보드</label>
										<label><input type="checkbox" id="" name="cate1[]" value="주문제작형" class=""><span></span>주문제작형</label>
										<label><input type="checkbox" id="" name="cate1[]" value="콘텐츠제작" class=""><span></span>콘텐츠제작</label>
										<label><input type="checkbox" id="" name="cate1[]" value="기타" class=""><span></span>기타</label>
									</td>
								</tr>
								<tr>
									<th>업종별</th>
									<td class="checkbox_list">
										<label><input type="checkbox" id="" name="cate2[]" value="관공서" class=""><span></span>관공서</label>
										<!-- <label><input type="checkbox" id="" name="cate2[]" value="개인" class=""><span></span>개인</label>
										<label><input type="checkbox" id="" name="cate2[]" value="금융기간" class=""><span></span>금융기간</label> -->
										<label><input type="checkbox" id="" name="cate2[]" value="백화점/매장" class=""><span></span>백화점/매장</label>
										<label><input type="checkbox" id="" name="cate2[]" value="기업/전시장" class=""><span></span>기업/전시장</label>
										<label><input type="checkbox" id="" name="cate2[]" value="병원/의료" class=""><span></span>병원/의료</label>
										<label><input type="checkbox" id="" name="cate2[]" value="기타" class=""><span></span>기타</label>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="btn_wrap">
							<a href="?" class="btn_st03 bcolr02">검색입력 초기화</a>
							<a href="#" class="btn_st03 bcolr01">조건검색</a>
						</div>
					</fieldset>
				</form>
				
				<?
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;
						
						$sql    = $total_sql . " order by $orderStr notice_yn desc,  b_ref desc, b_step asc limit $nFrom, $g_list_rows ";
						
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						
						?>
				<p class="total_txt">총  <strong><?=$nTotalCount?></strong>개의 설치사례가 있습니다.</p>
				<ul class="gallery_list" id="gallery_tab">
				<?
					while($row=mysql_fetch_array($result)){

						if ($row[notice_yn] == "Y") {
							$nums = "Notice";
						} else {
							$nums = $num;
						}
						$newStr = "";
						if (listNew(24, $row[r_date]) ==0) {
							$newStr = "<img src=\"/img_board/new.gif\" style=\"margin:1px 3px 0 5px;\" alt=\"신규게시물\" />";
						}

						$recStr = "";
						if ($row[recomm_yn] == "Y") {
							$recStr = "<font color=red>[추천]</font>";
						}
						$file_chk = "N";
						for ($i=1;$i<=5;$i++) {
							if ($row["rfile".$i]) {
								$file_chk = "Y";
							}
						}
					$img = "";
					$url = "";
					$youtubes		= explode("https://youtu.be/",$row[url]);
					$youtube_codes	= explode("?",$youtubes[1]);
					$youtube_code	= $youtube_codes[0];
					if ($row["ufile6"]) {
						if (substr(strtolower($row["ufile6"]),-3) == "jpg" || substr(strtolower($row["ufile6"]),-3) == "png" || substr(strtolower($row["ufile6"]),-3) == "gif" ) {
							$img = get_img($row["ufile6"], "/data/bbs/", 235, 235);
						}
					} elseif ($row["ufile1"]) {
						if (substr(strtolower($row["ufile1"]),-3) == "jpg" || substr(strtolower($row["ufile1"]),-3) == "png" || substr(strtolower($row["ufile1"]),-3) == "gif" ) {
							$img = get_img($row["ufile1"], "/data/bbs/", 390, 220);
						}
					} else {
						$img = getConImg(str_replace("","",viewSQ($row["contents"])));
					}
					
				?>
					<li><a href="view.php?bbs_idx=<?=$row['bbs_idx'].$cate1.$cate2?>"><img src="<?=$img?>" alt="설치 사례 이미지"><strong><?=$row['subject']?></strong></a></li>
				<?}?>
					<!-- <li><a href="view.php"><img src="../img/sub/installation_case_img02.png" alt="설치 사례 이미지"><strong>넥센타이어 스텐드 46”</strong></a></li>
					<li><a href="view.php"><img src="../img/sub/installation_case_img03.png" alt="설치 사례 이미지"><strong>넥센타이어 스텐드 46”</strong></a></li>
					<li><a href="view.php"><img src="../img/sub/installation_case_img04.png" alt="설치 사례 이미지"><strong>넥센타이어 스텐드 46”</strong></a></li>
					<li><a href="view.php"><img src="../img/sub/installation_case_img05.png" alt="설치 사례 이미지"><strong>넥센타이어 스텐드 46”</strong></a></li>
					<li><a href="view.php"><img src="../img/sub/installation_case_img06.png" alt="설치 사례 이미지"><strong>넥센타이어 스텐드 46”</strong></a></li>
					<li><a href="view.php"><img src="../img/sub/installation_case_img07.png" alt="설치 사례 이미지"><strong>넥센타이어 스텐드 46”</strong></a></li>
					<li><a href="view.php"><img src="../img/sub/installation_case_img08.png" alt="설치 사례 이미지"><strong>넥센타이어 스텐드 46”</strong></a></li> -->
				</ul>
				
				<!-- <div class="more_btn">
					<a href="#">더보기</a>
				</div> -->
				<div class="pager">
					<ul class="pagination">
						<?echo ipageListing2($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?scategory=$scategory&search_mode=".$search_mode.$cate1.$cate2."&search_word=".$search_word."&code=".$code."&pg=")?>
						<!-- <li><a href="javascript: go_page(1);"><img src="/img/btn/pagerLL.png" alt=""></a></li>
						<li><a href="javascript: go_page(1);"><img src="/img/btn/pagerL.png" alt=""></a></li>
								<li class="num active"><a href="javascript: go_page(1);">1</a></li>
								<li class="num "><a href="javascript: go_page(2);">2</a></li>
								<li class="num "><a href="javascript: go_page(3);">3</a></li>
								<li class="num "><a href="javascript: go_page(4);">4</a></li>
								<li class="num "><a href="javascript: go_page(5);">5</a></li>
								<li class="num "><a href="javascript: go_page(6);">6</a></li>
								<li class="num "><a href="javascript: go_page(7);">7</a></li>
								<li class="num "><a href="javascript: go_page(8);">8</a></li>
								<li class="num "><a href="javascript: go_page(9);">9</a></li>
								<li class="num "><a href="javascript: go_page(10);">10</a></li>
								<li><a href="javascript: go_page(11);"><img src="/img/btn/pagerR.png" alt=""></a></li>
						<li><a href="javascript: go_page(24);"><img src="/img/btn/pagerRR.png" alt=""></a></li> -->
					</ul>
				</div>
									
			</div>
		</div>
	</section>
<? include('../inc/footer.inc.php');?>	
<script type="text/javascript">
	$(function(){
		$(".bcolr01").click(function(){
			$("#frm").submit();
		});
		temp ="<?=$search_cate1_1?>";
		temp2 ="<?=$search_cate2_1?>";
		cate1 =temp.split(",");
		cate2 =temp2.split(",");
		
		$(".checkbox_list input").each(function(){
			for(i=0;i<cate1.length;i++){
				if($(this).val() == cate1[i]){
					$(this).prop("checked", true);
				}
			}
			for(j=0;j<cate2.length;j++){
				if($(this).val() == cate2[j]){
					$(this).prop("checked", true);
				}
			}
		});
		pg ='<?=$_GET['pg']?>';
		if(pg !=""){
			var offset = $("#gallery_tab").offset();
			console.log(offset);
			$('html, body').animate({scrollTop : offset.top},40);
		}
	});
</script>