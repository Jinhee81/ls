<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>	
<style type="text/css">
.lock_layer{position:fixed;left:0;right:0;top:0;bottom:0;background:rgba(255,255,255,0.6);z-index:50;display:none;}
.lock_layer form{position:absolute;width:30%;left:80%;margin-left:-47%;top:50%;margin-top:-70px;border:2px solid #454545;text-align:center;padding:36px 0;background-color:#FFF;}
.lock_layer form .txt01{font-size:12px;color:#3b3b3b;margin-bottom:22px;}
.lock_layer form input[type="password"]{width:53%;height:30px;margin-right:3px;}
.lock_layer form .btnConfirm{width:80px;height:30px;background-color:#474747;font-size:12px;color:#fff;}
.lock_layer form .btn_layerClose{position:absolute;right:0;top:0;width:30px;height:30px;}
.lock_layer form .btn_layerClose img{width:15px;}
/* moblie */
@media screen and (max-width: 768px){
.lock_layer form{width:80%;left:50%;margin-left:-40%;}
	
}

</style>
	<section id="container" >	
		<? include('qna_inc.php');?>	
		<? 
			$search_word	= updateSQ($_GET['search_word']);
			$search_mode	= updateSQ($_GET['search_mode']);
			$g_list_rows	= 10;
			if ($search_word != "") {
				if ($search_mode != "") {
					$strSql = " and ".$search_mode." like '%".$search_word."%' ";
				} else {
					$strSql = " and (product_name like '%".$search_word."%' or contents like '%".$search_word."%') ";
				}
			}
			
			$total_sql = " select * from tbl_inquiry where 1=1 ".$strSql;
			
			$result = mysql_query($total_sql) or die (mysql_error());
			$nTotalCount = mysql_num_rows($result);
		?>
		<div class="wrap_1000">
			<div class="sub_tit">
				<h2>견적의뢰</h2>
			</div>
			<div class="board_list">
				
				<form method="GET" name="frm" class="search-box">
					<fieldset>
						<legend>게시판 검색</legend>
						<select name="search_mode" id="">
							<option value="product_name">제품명</option>
							<option value="contents">내용</option>
						</select>
						<input type="text" id="search_word" name="search_word" value="" class="search-txt" placeholder="검색어를 입력해주세요.">
						<button type="submit" class="btn-search"><img src="/img/sub/btn_search_icon.png" alt="검색"></button>
					</fieldset>
				</form>
				<table class="ta_list">
					<colgroup>
						<col class="num">
						<col class="category">
						<col class="subject">
						<col class="name">
						<col class="date">
						<col class="confirm">
					</colgroup>
					<thead>
					
						<tr>
							<th class="num">번호</th>
							<th class="category">분류</th>
							<th class="subject">제품명</th>
							<th class="name">작성자</th>
							<th class="date">날짜</th>
							<th class="confirm">확인여부</th>
						</tr>
					</thead>
					<tbody class="body_list">
					<?
							$nPage = ceil($nTotalCount / $g_list_rows);
							if ($pg == "") $pg = 1;
							$nFrom = ($pg - 1) * $g_list_rows;

							$sql    = $total_sql . " order by  idx desc  limit $nFrom, $g_list_rows ";

							$result = mysql_query($sql) or die (mysql_error());
							$num = $nTotalCount - $nFrom;
							while($row=mysql_fetch_array($result)){
								$row['secure_yn'] == "Y";
								if ($row['notice_yn'] == "Y") {
									$nClass="notice_bg";
									$nums = "<span>공지</span>";
								} else {
									$nClass="";
									$nums = $num;
								}
								$newStr = "";
								if (listNew(48, $row['r_date']) ==0) {
									$newStr = "<img src=\"/img_board/new.gif\" alt=\"new\">";
								}

								$secureStr = "&nbsp;<img src='/img/btn/icon_secret.gif'>&nbsp;&nbsp;";
								
						?>

						<tr>
							<td class="num"><?=$nums?></td>
							<td class="category"><strong>견적/구매문의</strong></td>
							<td class="subject">
								<a href="#!" class="over_txt" attidx="<?=$row['idx']?>"><?=$secureStr?><?=$row['product_name']?></a>
							</td>
							<td class="name">
							<?	$userName ="";
								$userName2 ="";
								$temp_name =$row['user_name'];
								$temp_array =explode("/",$temp_name);
								
								$userName =mb_substr($temp_array[0],0,1,"UTF-8");
								$userName .="*".mb_substr($temp_array[0],2,10,"UTF-8");
								$userName2 =mb_substr($temp_array[1],0,1,"UTF-8");
								$userName2 .="*".mb_substr($temp_array[1],2,10,"UTF-8");
								
								if($temp_array[1])
									$userName =$userName."/".$userName2;
								
								echo $userName;
							?>
							</td>
							<td class="date"><?=substr($row['r_date'],0,10)?></td>
							<td class="confirm"><span class="noconfirm"><?=$row['is_free']?"확인":"미확인";?></span></td>
						</tr>
						<? 
							$num = $num - 1;
						} ?>
						
					</tbody>
				</table>
				<div class="btn_wrap">
					<a href="qna_write.php" class="btn_write">견적/구매문의</a>
				</div>
				<div class="pager">
					<ul class="pagination">
						<?echo ipageListing2($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?scategory=$scategory&search_mode=".$search_mode."&search_word=".$search_word."&code=".$code."&pg=")?>
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
		<div class="lock_layer">
			<form action="qna_view.php" method="POST" name="link_frm" id="link_frm" onkeydown="return captureReturnKey(event)">
				<fieldset>
					<legend>패스워드입력</legend>
					<p class="txt01">이 게시물의 패스워드를 입력해주세요.</p>
					<div class="inputBtn">
						<input type="password" id="checkPw" name="checkPw" />
						<input type="hidden" id="link_idx" name="link_idx" />
						<input type="hidden" id="check_frm" name="check_frm" />
						<button type="button" class="btnConfirm" >확인</button>
					</div>
					<button type="button" class="btn_layerClose"><img src="../img/btn/btn_layerClose.png" alt="레이어닫기" /></button>
				</fieldset>
			</form>
		</div>
	</section>
<? include('../inc/footer.inc.php');?>	
<script type="text/javascript">
	$(function(){
		$(".over_txt").click(function(){
			$("#link_idx").val("");
			$("#checkPw").val("");
			var linkIdx =$(this).attr("attidx");
			$("#link_idx").val(linkIdx);
			btn_lock();
		});
	});
	//레이어 비밀번호확인
	$(".btnConfirm").click(function(){
		var checkPw =$("#checkPw").val();
		var check_idx =$("#link_idx").val();
		if(!checkPw){
			alert("비밀번호를 입력해주세요.");
			return false;
		}	
		$(".lock_layer").fadeOut(100);
		pass_check(checkPw,check_idx);
	});
	//비밀번호 레이어 열기
	function btn_lock(){
		$(".lock_layer").fadeIn(200);
	};
	//비밀번호 레이어 닫기
	$(function(){
		$(".btn_layerClose").on("click",function(){
			$(this).parents(".lock_layer").fadeOut(100);
		});
	});
	//password 확인
	function pass_check(userPw, idx){
		$.ajax({
			type: "POST", // GET, POST
			dataType: "text", // json, text
			url: "/ajax/password_check.php",
			data: "user_pw="+userPw+"&idx="+idx,
			success: function(data, textStatus){
				
				data = JSON.parse(data); // text -> json
				if(data.check =="Y"){
					$("#check_frm").val(data.check);
					$("#link_frm").submit();
				}else{
					alert(data.msg);
				}
				
			},
			error: function(xhr, textStatus, Thrown){ // ajax 오류
				console.log("error : "+textStatus+" -> "+Thrown);
			}
		});
	};

	//ENTER 안먹게 하는것 
	function captureReturnKey(e) { 
		if(e.keyCode==13 && e.srcElement.type != 'textarea') 
		return false; 
	}
</script>