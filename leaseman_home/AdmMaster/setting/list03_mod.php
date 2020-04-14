<?php
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/head_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/header_inc.php";

	$idx		= updateSQ($_GET[idx]);

	$sql	= "select * from tbl_push where idx = '".$idx."'  ";
	$result = mysql_query($sql) or die (mysql_error());
	$row	= mysql_fetch_array($result);

	$sql_ma = "select user_name from tbl_admin where user_id = '".$row['reg_id']."' ";
	$result_ma = mysql_query($sql_ma);
	$row_ma = mysql_fetch_array($result_ma);

?>

	<section id="container">		
		<div class="layout_wrap">
			<div class="com_hbox">
				<h2 class="com_h2" data-type="환경설정" data-title="푸쉬메시지관리">푸쉬메시지 수정</h2>
			</div>
			<form action="/AdmMaster/setting/push_mod_ok.php" name="frm" method="post" >
				<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />
				<fieldset>
					<div class="com_btn_box">
						<div class="right">
							<button type="button" class="blue_btn " onclick="fn_submit();">저장</button>
						</div>
					</div>
					<div class="com_tb01">
						<table class="ta_write01">
							<caption>푸싱메시지</caption>
							<colgroup>
							</colgroup>
							<tbody>

								<tr>
									<th>등록자명</th>
									<td><?=$row_ma['user_name']?></td>
								</tr>
								<tr>
									<th>등록일시</th>
									<td class="date_list"><?=$row['reg_date']?></td>
								</tr>
								<tr>
									<th>발송일시</th>
									<td class="date_list">
										<input type="text" name="send_date" class="calendar2" placeholder="2017-01-01" value="<?=$row['send_date']?>" > 
										<input type="text" name="send_time" placeholder="시간입력 예)15:00" value="<?=$row['send_time']?>" >
									</td>
								</tr>
								<tr>
									<th>제목</th>
									<td><input type="text" id="title" name="title" class="wd_full" value="<?=$row['title']?>" /></td>
								</tr>
								<tr>
									<th>내용</th>
									<td>
										<textarea name="content" id="content" cols="40" rows="20" class="wd_full" ><?=$row['content']?></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="com_btn_box">
						<div class="center">
							<a href="list03.php" class="gray_btn">리스트 이동</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		
	
	</section><!-- //container End -->


<?php include $_SERVER['DOCUMENT_ROOT']."/AdmMaster/inc/footer_inc.php";?>


<script type="text/javascript">

function fn_submit(){
	var frm = document.frm;

	if(frm.title.value == ""){
		alert("제목을 등록해주세요.");
		frm.title.focus();
		return false;
	}

	if(frm.content.value == ""){
		alert("내용을 등록해주세요.");
		frm.content.focus();
		return false;
	}

	frm.submit();
}


</script>