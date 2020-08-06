<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";
?>

<? //include "../_include/_header.php"; ?>
<?
	include $_SERVER[DOCUMENT_ROOT]."/AdmMaster/include/bbs_info.inc.php"; 
	$scategory		= updateSQ($_GET[scategory]);
	$search_word	= updateSQ($_GET[search_word]);
	$search_mode	= updateSQ($_GET[search_mode]);
	$is_category	= isBoardCategory($code);
	$g_list_rows = 10;
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
	$strSql = $strSql." and code = '$code'";
	$total_sql = " select *, (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as category, (select count(*) from tbl_bbs_comment where tbl_bbs_comment.bbs_idx=tbl_bbs_list.bbs_idx) as comment_cnt  from tbl_bbs_list where 1=1 ".$strSql;
	$result = mysql_query($total_sql) or die (mysql_error());
	$nTotalCount = mysql_num_rows($result);
?>
		<div id="container">
		<span id="print_this"><!-- 인쇄영역 시작 //-->

			<header id="headerContainer">
				
				<div class="inner">
					<h2><?=getBoardName($code)?></h2>
					<div class="menus">
						<ul class="first">
							<li><a href="javascript:CheckAll(document.getElementsByName('bbs_idx[]'), true)" class="btn btn-success">전체선택</a></li>
							<li><a href="javascript:CheckAll(document.getElementsByName('bbs_idx[]'), false)" class="btn btn-success">선택해체</a></li>
							<li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
						</ul>
						<ul class="last">							
							<li><a href="board_write.php?code=<?=$code?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a></li>
						</ul>
						
					</div>

				</div><!-- // inner -->

			</header><!-- // headerContainer -->

			<div id="contents">
				
				<FORM NAME="frmSearch" Method="GET"  >
				<INPUT TYPE="hidden" NAME="code" VALUE="<?=$code?>">
				<INPUT TYPE="hidden" NAME="scategory" VALUE="<?=$scategory?>">
				<header id="headerContents">
					<p>
						<input type="radio" name="search_mode" value="" <? if ($search_mode == "") {echo "checked";} ?>> 전체  &nbsp; &nbsp; 
						<input type="radio" name="search_mode" value="subject" <? if ($search_mode == "subject") {echo "checked";} ?>> 제목  &nbsp; &nbsp; 
						<input type="radio" name="search_mode" value="contents" <? if ($search_mode == "contents") {echo "checked";} ?>> 내용  &nbsp; &nbsp; 
						<input type="radio" name="search_mode" value="writer" <? if ($search_mode == "writer") {echo "checked";} ?>> 작성자 &nbsp; &nbsp; 
						<input type="text" id=""  name="search_word" value='<?=$search_word?>'  class="input_txt placeHolder" rel="검색어 입력" style="width:240px" />
						<a href="javascript:document.frmSearch.submit();" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> <span class="txt">조회하기</span></a>
					</p>
				</header><!-- // headerContents -->
				</form>
				<script>
					function search_it()
					{
						var frm = document.frmSearch;
						if (frm.search_word.value == "검색어 입력")
						{
							frm.search_word.value = "";
						}
						frm.submit();
					}
				</script>


				<div class="listWrap">


					<div class="listTop">
						<div class="left">
							<p class="schTxt">■ 총 <?=$nTotalCount?>개의 목록이 있습니다.</p>
						</div>


					</div><!-- // listTop -->



					


				<? 
				if ($skin == "gallery" || $skin == "media" || $skin == "event" )
				{
					include "./photo.inc.php"; 
				} else {
					include "./list.inc.php"; 
				}
				?>
					


					
					<?echo ipageListing($pg, $nPage, $g_list_rows, $_SERVER[PHP_SELF]."?scategory=$scategory&search_mode=".$search_mode."&search_word=".$search_word."&code=".$code."&pg=")?></td>

					<div id="headerContainer">
						
						<div class="inner">
							<h2><?=getBoardName($code)?></h2>
							<div class="menus">
								<ul class="first">
									<li><a href="javascript:CheckAll(document.getElementsByName('bbs_idx[]'), true)" class="btn btn-success">전체선택</a></li>
									<li><a href="javascript:CheckAll(document.getElementsByName('bbs_idx[]'), false)" class="btn btn-success">선택해체</a></li>
									<li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
								</ul>
								<ul class="last">							
									<li><a href="board_write.php?code=<?=$code?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a></li>
								</ul>
								
							</div>

						</div><!-- // inner -->

					</div><!-- // headerContainer -->


				</div><!-- // listWrap -->

			</div><!-- // contents -->





		</span><!-- 인쇄 영역 끝 //-->
		</div><!-- // container -->


<script>
 function CheckAll(checkBoxes,checked){
    var i;
    if(checkBoxes.length){
        for(i=0;i<checkBoxes.length;i++){
            checkBoxes[i].checked=checked;
        }
    }else{
        checkBoxes.checked=checked;
   }

}

function SELECT_DELETE() {
		if ($(".bbs_idx").is(":checked") == false)
		{
			alert_("삭제할 게시물을 선택하셔야 합니다.");
			return;
		}
		if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false)
		{
			return;
		}
		$("#ajax_loader").removeClass("display-none");
        $.ajax({
			url: "bbs_del.ajax.php",
			type: "POST",
			data: $("#lfrm").serialize(),
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
//				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				if (response == "OK")
				{
					alert_("정상적으로 삭제되었습니다.");
					setTimeout(function() {
						location.reload();
					}, 1000);
					return;
				} else {
					alert(response);
					alert_("오류가 발생하였습니다!!");
					return;
				}
			}
        });
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
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
//				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				if (response == "OK")
				{
					alert_("정상적으로 삭제되었습니다.");
					setTimeout(function() {
						location.reload();
					}, 1000);
					return;
				} else {
					alert(response);
					alert_("오류가 발생하였습니다!!");
					return;
				}
			}
        });


	}
</script>



<? include "../_include/_footer.php"; ?>