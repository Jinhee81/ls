<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<script src="/js/jquery.form.js"></script>
<?
	if($code =="h_after" && $_SESSION['member']['id'] ==""){
		alert_msg("로그인후 이용가능합니다.","/membership/login.php");
	}
	include $_SERVER[DOCUMENT_ROOT]."/include/bbs_info.inc.php";
	$writer			= $_SESSION[member][name];
	$search_mode	= updateSQ($_GET[search_mode]);
	$search_word	= updateSQ($_GET[search_word]);
	$pg				= updateSQ($_GET[pg]);
	$bbs_idx		= updateSQ($_GET[bbs_idx]);
	$wDate			= date("Y-m-d H:i:s", time());
	$hit			= 0;
	//echo $_SERVER[DOCUMENT_ROOT].'/data/editor/';

	$mode			= updateSQ($_GET[mode]);

	$titleStr = "등록";
	$cnt = 0;
	if ($mode == "reply"){
		$total_sql	= " select * from tbl_bbs_list where bbs_idx='".$bbs_idx."'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);
		$subject	= "[re]".$row[subject];
		$contents	= "-------------------- 원본글 -------------------- <br>".$row[contents];
		$b_step		= $row[b_step];
		$b_level	= $row[b_level];
		$b_ref		= $row[b_ref];
		$secure_yn	= $row[secure_yn];
		$mode		= "reply";
	} elseif ($bbs_idx) {
		$total_sql	= " select * from tbl_bbs_list where bbs_idx='".$bbs_idx."'";
		$result		= mysql_query($total_sql) or die (mysql_error());
		$row		= mysql_fetch_array($result);
		$writer		= $row[writer];
		$hit		= $row[hit];
		$subject	= $row[subject];
		$simple		= $row[simple];
		$s_date		= $row[s_date];
		$e_date		= $row[e_date];
		$notice_yn	= $row[notice_yn];
		$secure_yn	= $row[secure_yn];
		$recomm_yn	= $row[recomm_yn];
		$contents	= $row[contents];
		$category	= $row[category];
		$country_code	= $row[country_code];
		$class_type	= $row[class_type];
		$url		= $row[url];
		$user_hp	= $row[user_hp];
		$user_email	= $row[user_email];
		$cnt		= 0;
		$ufile1		= $row[ufile1];
		$rfile1		= $row[rfile1];

		$ufile2		= $row[ufile2];
		$rfile2		= $row[rfile2];

		$ufile3		= $row[ufile3];
		$rfile3		= $row[rfile3];

		$ufile4		= $row[ufile4];
		$rfile4		= $row[rfile4];

		$ufile5		= $row[ufile5];
		$rfile5		= $row[rfile5];

		$ufile6		= $row[ufile6];
		$rfile6		= $row[rfile6];
		$wDate		= $row[r_date];


		if ($ufile1 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($ufile2 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($ufile3 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($ufile4 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($ufile5 != "")
		{
		$cnt		= $cnt + 1;
		}
		if ($cnt < 1) {
		$cnt		= 1;
		}
	} else {
		$cnt		= 1;
	}

?>
<style type="css/text">
	.hidden_class{display:none}
	</style>
		<section id="container">
			<? include_once $_SERVER[DOCUMENT_ROOT].$nav;?>
			<div class="wrap_1000">
				<div class="sub_visual <?=$visual_class?>">
					<h2><?=getBoardName($code)?></h2>
					<b><?=$info_txt1?></b>
					<p><?=$info_txt2?>
					<br /><?=$info_txt3?></b>
				</div>
		
		<?
		if($code =="h_qna" || $code =="count3")
			include_once("./write2.inc.php");
		else
			include_once("./write.inc.php");
		?>


	</div>
	<? include "../inc/footer_inc.php"; ?>
	</section>
<script>

		function ShowArticleAdd(str) {
			var cnt = document.frm.article_num.value;
			if (str == "+")
			{

				if (cnt < 5)
				{
					var row_num=parseInt(cnt)+1;
					document.frm.article_num.value=row_num;
					for(i=0; i < row_num; i++)
					{
						$(".layerA:eq("+i+")").show();
					}
				}
			} else if (str == "-") {
				if (cnt != 0)
				{
					$(".layerA:eq("+cnt+")").hide();
					var row_num=parseInt(cnt)-1;
					document.frm.article_num.value=row_num;
				}
			}
		}
		for(i=0; i < document.frm.article_num.value; i++)
		{
				//$(".layerA:eq("+i+")").show();
			$(".layerA:eq("+i+")").show();
			//document.all.layerA[i].style.display="";
		}

	$(function(){
		$("#frm").ajaxForm({
			url: "bbs_proc.ajax.php",
			type: "POST",
			data: $("#frm").serialize(),
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				//alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
				//$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				if (response == "OK") {
					<?
					if ($mode == "reply")
					{
					?>
					alert("정상적으로 등록되었습니다.");
					setTimeout(function() {
						location.href="board_list.php?scategory=<?=$scategory?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>&code=<?=$code?>&bbs_idx=<?=$bbs_idx?>&pg=<?=$pg?>";
					}, 1000);
					<?
					} else if ($_GET[bbs_idx] == "") {
					?>
						<?if($code =="h_qna"){?>
							alert("정상적으로 등록되었습니다.");
							location.reload();
						<?}else{?>
							alert("정상적으로 등록되었습니다.");
							setTimeout(function() {
								location.href="board_list.php?code=<?=$code?>";
							}, 1000);
						<?}?>
					<? } else { ?>
					alert("정상적으로 수정되었습니다.");
					setTimeout(function() {
						location.reload();
					}, 1000);
					<? } ?>
					return;
				} else if (response == "NF") {
					alert("업로드 금지 파일입니다.");
					return;
				} else {
					alert(response);
					//alert("오류가 발생하였습니다!!");
					return;
				}
			}
		});
	});

	function send_it()
	{
		var frm = document.frm;
		var code ='<?=$code?>';
		if(code =="h_qna"){
			if(frm.category.value ==""){
				alert("상담유형을 선택해주세요");
				return;
			}
		}
		if(code !="h_after"){
			if (frm.writer.value == "")
			{
				frm.writer.focus();
				alert("작성자를 입력해주세요.");
				return;
			}
			if (frm.hp1.value == "")
			{
				frm.hp1.focus();
				alert("휴대폰번호를 입력해주세요.");
				return;
			}
			if (frm.hp2.value == "")
			{
				frm.hp2.focus();
				alert("휴대폰번호를 입력해주세요.");
				return;
			}
			if (frm.hp3.value == "")
			{
				frm.hp3.focus();
				alert("휴대폰번호를 입력해주세요.");
				return;
			}
			if (frm.user_email.value == "")
			{
				frm.user_email.focus();
				alert("E-mail 입력해주세요.");
				return;
			}
		}
		if (frm.subject.value == "")
		{
			frm.subject.focus();
			alert("제목을 입력해주세요.");
			return;

		}
		if (frm.contents.length < 2 ||frm.contents.value=="")
		{
			frm.contents.focus();
			alert("내용을 입력하셔야 합니다.");
			return;
		}
		if(code =="h_qna"){
			$("#user_hp").val(frm.hp1.value+"-"+frm.hp2.value+"-"+frm.hp3.value);
		}
		/*
		if (frm.passwd.value == "")
		{
			frm.passwd.focus();
			alert("비밀번호를 입력해주세요.");
			return;
		}
		*/
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
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				if (response == "OK")
				{
					alert_("정상적으로 삭제되었습니다.");
					setTimeout(function() {
						location.href="board_list.php?code=<?=$code?>";
					}, 1000);
					return;
				} else {
					alert_("오류가 발생하였습니다!!");
					return;
				}
			}
        });


	}
</script>

<?
	if ($is_comment == "Y" && $bbs_idx != "") {
//		include "./notice_comment.inc.php";
	}
?>