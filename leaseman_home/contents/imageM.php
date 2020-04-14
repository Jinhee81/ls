<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>		
	<section id="container" >	
		<? include('contents_inc.php');?>		
		<div class="wrap_1000">	
			<div class="sub_tit">
				<h2>이미지 제작</h2>
			</div>
			<div class="section_box">
				<div class="sb_top">
					<h3>제품설명</h3>
					<p class="top_txt">원하는 템플릿에 문구와 사진 수정으로 저렴한 비용으로 이미지를 제작할 수 있습니다. <br />
					업종에 적합하게, 매장내 인테리어와 분위기에 적합하게, 트렌드에 떨어지지 않는 세련된 감각으로 원하는 이미지를 디자인 해 드립니다.</p>
				</div>
				<figure class="cont_img"><img src="../img/sub/contents03_img01.png" alt="이미지 주문제작 제품사용군: 전 제품" /></figure>
				<article class="process_list">
					<h4>제작 프로세스</h4>
					<ul class="cols-06 web">
						<li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img01.png" alt="상담 및 견적" /></span>
							<strong class="pl_txt">상담 및 견적</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img02.png" alt="분석" /></span>
							<strong class="pl_txt">분석</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img03.png" alt="기획 및 디자인<br />시안 결정" /></span>
							<strong class="pl_txt">기획 및 디자인<br />시안 결정</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img04.png" alt="제작" /></span>
							<strong class="pl_txt">제작</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img05.png" alt="수정 및 보완" /></span>
							<strong class="pl_txt">수정 및 보완</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img06.png" alt="최종 작업 완료" /></span>
							<strong class="pl_txt">최종 작업 완료</strong>
						</li>
					</ul>
					<ul class="cols-06 mo">
						<li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img01.png" alt="상담 및 견적" /></span>
							<strong class="pl_txt">상담 및 견적</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img02.png" alt="분석" /></span>
							<strong class="pl_txt">분석</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img03.png" alt="기획 및 디자인<br />시안 결정" /></span>
							<strong class="pl_txt">기획 및 디자인<br />시안 결정</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img06.png" alt="최종 작업 완료" /></span>
							<strong class="pl_txt">최종 작업 완료</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img05.png" alt="수정 및 보완" /></span>
							<strong class="pl_txt">수정 및 보완</strong>
						</li><li>
							<span class="pl_icon"><img src="../img/sub/contents02_list_img04.png" alt="제작" /></span>
							<strong class="pl_txt">제작</strong>
						</li>
					</ul>
				</article>
				<div class="installation_case">
					<b>디자인 사례</b>
					<ul class="product_list_tab">
						<?
						$code2			= "product";
						//$is_category	= isBoardCategory($code);
						
						$g_list_rows	= 8;
						
						//카테고리 검색쿼리
						$strSql="";	
						$strSql = $strSql." and code = '$code2' and cate1 ='콘텐츠제작' ";
						$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt from tbl_bbs_list where 1=1 ".$strSql;
						$result = mysql_query($total_sql) or die (mysql_error());
						$nTotalCount = mysql_num_rows($result);
						$nPage = ceil($nTotalCount / $g_list_rows);
						if ($pg == "") $pg = 1;
						$nFrom = ($pg - 1) * $g_list_rows;
						
						$sql    = $total_sql . " order by $orderStr notice_yn desc,  b_ref desc, b_step asc limit $nFrom, $g_list_rows ";
						
						$result = mysql_query($sql) or die (mysql_error());
						$num = $nTotalCount - $nFrom;
						
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
									$img = get_img($row["ufile1"], "/data/bbs/", 235, 235);
								}
							} else {
								$img = getConImg(str_replace("","",viewSQ($row["contents"])));
							}
						?>
							<li><a href="/installation_examples/view.php?bbs_idx=<?=$row['bbs_idx']?>"><img src="<?=$img?>" alt="설치 사례 이미지"><span><?=$row['subject']?></span></a></li>
						<?}?>
						<!-- <li><a href="#"><img src="../img/sub/installation_case_img02.png" alt="설치 사례 이미지"><span>넥센타이어 스텐드 46”</span></a></li>
						<li><a href="#"><img src="../img/sub/installation_case_img03.png" alt="설치 사례 이미지"><span>넥센타이어 스텐드 46”</span></a></li>
						<li><a href="#"><img src="../img/sub/installation_case_img04.png" alt="설치 사례 이미지"><span>넥센타이어 스텐드 46”</span></a></li>
						<li><a href="#"><img src="../img/sub/installation_case_img05.png" alt="설치 사례 이미지"><span>넥센타이어 스텐드 46”</span></a></li>
						<li><a href="#"><img src="../img/sub/installation_case_img06.png" alt="설치 사례 이미지"><span>넥센타이어 스텐드 46”</span></a></li>
						<li><a href="#"><img src="../img/sub/installation_case_img07.png" alt="설치 사례 이미지"><span>넥센타이어 스텐드 46”</span></a></li>
						<li><a href="#"><img src="../img/sub/installation_case_img08.png" alt="설치 사례 이미지"><span>넥센타이어 스텐드 46”</span></a></li> -->
					</ul>
				</div>
				<div class="more_btn">
					<!-- <input type="text" id="add_page" name="add_page"> -->
					<a href="/installation_examples/list.php">더보기</a>
				</div>
			</div>
		</div>
	</section>
<? include('../inc/footer.inc.php');?>	