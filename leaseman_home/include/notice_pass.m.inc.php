 <? if ($_GET[mode] == "delete") {$saction = "action='/include/bbs_del.php'"; } ?>
<style>
	div.page_box {clear:both; width:1000px; min-height:250px; margin-top:15px;  font-size:12px;}
	div.page_box:after{content:"";display:block;clear:both;} 

</style>
<div class="page_box clearfix" style= "width:300px;margin:50px auto;">
	<div class="contents" style="text-align:center; width:300px; margin:0 auto; border-top:1px solid #d4d4d4; padding-top:30px; ">  
		<FORM NAME="k1" METHOD="get" <?=$saction?>>
		<input type=hidden name="bbs_idx<? if ($_GET[mode] == "delete") {echo "[]"; } ?>" value="<?=$bbs_idx?>">
		<input type=hidden name=search_mode	value="<?=$search_mode?>">
		<input type=hidden name=search_word	value="<?=$search_word?>">
		<input type=hidden name=pg value="<?=$pg?>">
		<input type=hidden name=mode value="<?=$mode?>">			
		<input type=hidden name="gourl" value='<?=$_SERVER[PHP_SELF]?>'> 

		
		
		<!--<div class="con_tit_noline">본인확인</div>//-->



	
								<strong>본인확인</strong> &nbsp; 
								<input type="password" name="pass" class="input_box" style="width:150px; height:26px;" placeholder="비밀번호 입력"  value='' />  &nbsp;<br /><br />
								<div class="btnGroup">
									<ul>
										<li class="btnRed"><a href="javascript:document.k1.submit();">확인</a></li>
										<li class="btnGray"><a href="?">취소하기</a></li>
									</ul>
								</div>
		
				


		<table width="100%" align="center" style="margin-top:30px; border-top:1px solid #d4d4d4;line-height:1.6  ">
			<tr>
				<td style="font-size:11px; padding-top:20px;">- 본인 글 확인을 위해 게시물 작성시 <br />등록한 비밀번호를 입력하여 주세요.</td>
			</tr>
			<tr>
				<td style="font-size:11px;"> - 비밀번호 분실시 관리자에게 문의하여 주시기 바랍니다.</td>
			</tr>
		</table>


		<br />
		</form>		  
		<script>
			<?		
			if ($_SESSION[member][level] == "1") {
			?>
			document.k1.submit();
			$("body").html("");
			<? } ?>
		</script>
	</div>
</div>