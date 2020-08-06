<? include('../inc/head.inc.php');?>
<? include('../inc/header.inc.php');?>
<?if(!$is_member && !$is_amdin){?>
  <script type="text/javascript">
     window.history.back();
  </script>
<?}?>
<?
	if (get_device() == "P") {
		include $_SERVER['DOCUMENT_ROOT']."/include/popup.inc.php";
	}
?>
		<section id="container">
			<div class="sub_visual">
				<ul>
					<li>
						<img src="../img/main/main_visual_img01.png" width ="100%">
					</li>
				</ul>
			</div>
			<div class="sub_visual one">
				<ul>
					<li>
						<img src="../img/mobile/main_visual_img01.png" width ="100%">
					</li>
				</ul>
			</div>
			<div class="wrap_1000 one">
				<div class="sub_tit">
					<h2>인증샷 올리기</h1>
					<span>아빠 엄마 이벤트 안내입니다.</span>
				</div>
				<div class="shot_table">
          <form name="frm" id="frm" class="" action="./write_ok.php" method="post" enctype="multipart/form-data" >
            <table>
  						<colgroup>
  							<col class="colw01">
  							<col class="colw02">
  						</colgroup>
  						<thead>
  								<input type ="hidden" name="write" value="<?=$_SESSION['member']['name']?>" class="shot_input">
                  <input type ="hidden" name="m_idx" value="<?=$_SESSION['member']['idx']?>" class="shot_input">
                  <input type ="hidden" name="email" value="<?=$_SESSION['member']['email']?>" class="shot_input">
                  <input type ="hidden" name="user_id" value="<?=$_SESSION['member']['user_id']?>" class="shot_input">
                  <input type ="hidden" name="code" value="photo" class="shot_input">
  							<tr>
  								<th>제목</th>
  								<td><input type ="text" name="subject" id="subject" class="shot_input2"></td>
  							</tr>
  							<!-- <tr>
  								<th>내용</th>
  								<td><textarea class="text_area" style="resize: none;"></textarea></td>
  							</tr> -->
  							<tr>
  								<th>파일첨부</th>
  								<td><input type ="file" name="ufile1" id="ufile1" class="file_up"></td>
  							</tr>
  						</thead>
  					</table>
          </form>
					<div class="inline">
						<b class="ok_btn"><a href="#!">등록</a></b>
					</div>

				</div>
			</div>
		</div>
	<? include('../inc/footer.common.inc.php');?>
		</section><!-- //container End -->
	</div><!--wrap_end-->

</body>
</html>
<script type="text/javascript">
  $(function(){
    $(".ok_btn").click(function(){
      if($("#subject").val() ==""){
        alert("제목을 입력해주세요");
        $("#subject").focus();
        return false;
      }
      if($("#ufile1").val() ==""){
        alert("이미지를 입력해주세요");
        $("#ufile1").focus();
        return false;
      }
      $("#frm").submit();
    });

  });
</script>
