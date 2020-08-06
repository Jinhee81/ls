				<div class="listWrap_noline">
					<form name=frm id=frm action="bbs_proc.ajax.php" method=post enctype="multipart/form-data" >
					<input type=hidden name="bbs_idx" value='<?=$bbs_idx?>'> 
					<input type=hidden name="article_num" value='<?=$cnt?>'> 
					<input type=hidden name="search_mode" value='<?=$search_mode?>'> 
					<input type=hidden name="search_word" value='<?=$search_word?>'> 
					<input type=hidden name="scategory" value='<?=$scategory?>'> 
					<input type=hidden name="code" value='<?=$code?>'> 
					<input type=hidden name="b_step" value='<?=$b_step?>'> 
					<input type=hidden name="b_level" value='<?=$b_level?>'> 
					<input type=hidden name="b_ref" value='<?=$b_ref?>'> 
					<input type=hidden name="pg" value='<?=$pg?>'> 
					<input type=hidden name="mode" value='<?=$mode?>'> 
					<div class="listBottom">
						<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
						<caption></caption>
						<colgroup>
						<col width="150px" />
						<col width="*" />
						</colgroup>
	
						<tbody>
							<tr <? if ($skin == "faq" || $skin == "gallery" || $skin == "media" || $skin == "event" ) {?>style="display:none"<?}?>>
								<th>작성자</th>
								<td><input type="text" id="" name="writer" value='<?=$writer?>' class="input_txt placeHolder" rel="" style="width:150px" /></td>
							</tr>


							<? if ($isCategory == "Y") { ?>
							<tr style="height:40px">
								<th>구분</th>
								<td>
									<select name="category" class="input_select">
										<option value="">선택</option>
									<?
									$fsql    = " select * from tbl_bbs_category where code='$code' order by onum desc";
									$fresult = mysql_query($fsql) or die (mysql_error());
									while($frow=mysql_fetch_array($fresult)){
									?>
										<option value="<?=$frow["tbc_idx"]?>" <? if ($frow["tbc_idx"] == $category) {echo "selected"; } ?>><?=$frow["subject"]?></option>
									<?
									}
									?>
									</select>
									
								</td>
							</tr>
							<? } ?>

							
							<? if ($isNotice == "Y" || $isSecure == "Y") { ?>
							<tr <? if ($skin == "faq" || $skin == "gallery" || $skin == "media" || $skin == "event") {?>style="display:none"<?}?>>
								<th>구분</th>
								<td>
									<? if ($isNotice == "Y" ) { ?>
									<input type="checkbox" id="notice_yn" name="notice_yn" value="Y" class="input_check" <? if ($notice_yn=="Y") {echo "checked"; } ?>/> 공지글 &nbsp;&nbsp;&nbsp; 
									<? } ?>
									<? if ($isSecure == "Y") { ?>
									<input type="checkbox" id="secure_yn" name="secure_yn" value="Y" class="input_check" <? if ($secure_yn=="Y") {echo "checked"; } ?>/ >비밀글
									<? } ?>
								</td>
							</tr>
							<? } ?>
							<tr <? if ($skin == "faq" || $skin == "gallery" || $skin == "media" || $skin == "event") {?>style="display:none"<?}?>>
								<th>등록일</th>
								<td><input type="text" id="" name="wdate" value='<?=$wDate?>' class="input_txt placeHolder" rel="2015-06-22 12:15:59" style="width:150px" /></td>
							</tr>
							<tr <? if ($skin == "faq" || $skin == "gallery") {?>style="display:none"<?}?>>
								<th>조회</th>
								<td><input type="text" id="" name="hit" value='<?=$hit?>' class="input_txt placeHolder" rel="145" style="width:60px" numberOnly/></td>
							</tr>
							<tr>
								<th>제목</th>
								<td><input type="text" id="" name="subject" value='<?=$subject?>' class="input_txt placeHolder" rel="" style="width:98%" /></td>
							</tr>
							<? if ($skin == "event") { ?>
							<tr>
								<th>이벤트기간</th>
								<td>
									<input type="text" id="" name="s_date" value='<?=$s_date?>' class="input_txt placeHolder datepicker" rel="" style="width:100px" />
									~
									<input type="text" id="" name="e_date" value='<?=$e_date?>' class="input_txt placeHolder datepicker" rel="" style="width:100px" />
								
								</td>
							</tr>
							<tr>
								<th>간략설명</th>
								<td>
									<textarea name="simple" id="simple" style="width:100%; height:200px;"><?=$simple?></textarea>
								</td>
							</tr>
							<? } ?>
							 <?if($code =="h_movie"){?>
							<tr>
							  <th>유튜브소스</th>
							  <td>
								<textarea name="contents" id="contents_" rows="10" cols="100" class="input_txt" style="width:100%; height:80px;"><?=$contents?></textarea>
							  </td>
							</tr>
						  <?}else{?>
							<tr>
								<th>내용</th>
								<td>
									<textarea name="contents" id="contents_" rows="10" cols="100" class="input_txt" style="width:100%; height:412px; display:none;"><?=$contents?></textarea>
									<script type="text/javascript">
									var oEditors = [];

									// 추가 글꼴 목록
									//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

									nhn.husky.EZCreator.createInIFrame({
										oAppRef: oEditors,
										elPlaceHolder: "contents_",
										sSkinURI: "/smarteditor/SmartEditor2Skin.html",	
										htParams : {
											bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
											bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
											bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
											//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
											fOnBeforeUnload : function(){
												//alert("완료!");
											}
										}, //boolean
										fOnAppLoad : function(){
											//예제 코드
											//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
										},
										fCreator: "createSEditor2"
									});
									</script>
								</td>
							</tr>
							<?}?>

							<? if ($skin == "default2"  && $isComment =="Y") { ?>
							<tr>
								<th>답변</th>
								<td>
									<textarea name="reply" id="reply_" rows="10" cols="100" class="input_txt" style="width:100%; height:412px; display:none;"><?=$reply?></textarea>
									<script type="text/javascript">
									var oEditors2 = [];

									// 추가 글꼴 목록
									//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

									nhn.husky.EZCreator.createInIFrame({
										oAppRef: oEditors2,
										elPlaceHolder: "reply_",
										sSkinURI: "/smarteditor/SmartEditor2Skin.html",	
										htParams : {
											bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
											bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
											bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
											//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
											fOnBeforeUnload : function(){
												//alert("완료!");
											}
										}, //boolean
										fOnAppLoad : function(){
											//예제 코드
											//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
										},
										fCreator: "createSEditor2"
									});
									</script>
								</td>
							</tr>
							<?}?>


							<? if ($skin == "gallery" || $skin == "media" || $skin == "event") { ?>
							<tr>
								<th>썸네일첨부</th>
								<td colspan="3">
										<? for ($i=6;$i<=6;$i++) { ?>
											<input type="file" name="ufile<?=$i?>"  class="bbs_inputbox_pixel" style="width:500px;" /> 
											<? if (${"ufile".$i} != "") { ?><br>파일삭제:<input type=checkbox name="del_<?=$i?>" value='Y'><a href="/include/dn.php?mode=bbs&ufile=<?=${"ufile".$i}?>&rfile=<?=${"rfile".$i}?>"><?=${"rfile".$i}?></a><? } ?>
										<? } ?>
										<? if ($skin == "gallery") { ?>
										<!--갤러리 이미지 사이즈-->	
										<span class="img_size_noti">* 이미지 사이즈: 320px * 200px</span>
										<? } else if ($skin == "media") { ?>
										<!--미디어 이미지 사이즈-->
										<span class="img_size_noti">* 이미지 사이즈: 150px * 103px</span>
										<? } else if ($skin == "event") { ?>
										<!--이벤트 이미지 사이즈-->
										<span class="img_size_noti">* 이미지 사이즈: 413px * 207px</span>
										<? } ?>

								</td>
							</tr>
							<? } ?>
							<tr <? if ($skin == "faq" || $skin == "gallery" || $skin == "media" || $skin == "event" || $skin == "free") {?>style="display:none"<?}?>>
								<th>파일첨부</th>
								<td>
									<? for ($i=1;$i<=1;$i++) { ?>
									<div class="layerA " style="display:<? if (${"ufile".$i} == "") { ?>none<? } ?>">
									<input type="file" name="ufile<?=$i?>"  class="bbs_inputbox_pixel" style="width:500px;" /> 
									<? if (${"ufile".$i} != "") { ?><br>파일삭제:<input type=checkbox name="del_<?=$i?>" value='Y'><a href="/include/dn.php?mode=bbs&ufile=<?=${"ufile".$i}?>&rfile=<?=${"rfile".$i}?>"><?=${"rfile".$i}?></a><? } ?>
									</div>
									<? } ?>
									&nbsp;&nbsp;&nbsp; 
									</td>
							</tr>
							<? if ($skin == "gallery" && $code !="product" && $code !="event") {?>
							<!-- <tr>
								<th>유투브</th>
								<td><input type="text" id="url" name="url" value="<?=$url?>" class="input_txt placeHolder" rel="http://" style="width:98%" /><br>
								
								</td>
							</tr> -->
							<? } ?>
			
							
						</tbody>
						</table>
					</form>
				</div><!-- // listBottom -->
					