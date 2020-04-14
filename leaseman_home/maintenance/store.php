<? include('../inc/head.inc.php');?>

<? include('../inc/header.inc.php');?>		
	<section id="container" >	
		<? include('maintenance_inc.php');?>		
		<div class="wrap_1000">	
			<div class="sub_tit">
				<h2>지역별 서비스 센터</h2>
			</div>
			<form action="" method="" name="" class="store_search">
				<fieldset>
					<legend>지도 검색</legend>
					<div class="store_search_box">
						<div class="ss_left_box">
							<div class="korea-map">
								<? include('map.php');?>	
							</div>
						</div>
						<form name="frm" action="" method="get">
						<div class="ss_right_box">
							<div class="box_section">
								<h3>매장명으로 검색하기</h3>
								<input type="text" id="search_name" name="search_name" value="<?=$search_name?>" placeholder="매장명 검색" />
								<button type="submit" class="btn_st03 bcolr01">검색</button>
							</div>
							<div class="box_section">
								<h3>지역으로 검색하기</h3>
								<select name="sido" id="sido" class="sel01" onchange="javascript:change_it(this.value);">
									<option value="">시/도 선택</option>	
									<?
									$sql    = " select distinct sido from tbl_area order by sido asc";
									$result = mysql_query($sql) or die (mysql_error());
									while($row=mysql_fetch_array($result)){
									?>
									<option value="<?=$row["sido"]?>" <? if ($sido == $row["sido"]) {echo "selected"; } ?>><?=$row["sido"]?></option>	
									<?
									}
									?>
								</select>
								<select name="gugun" id="gugun" class="sel02">
									<option value="">시/군/구 선택</option>	
								</select>
								<button type="submit" class="btn_st03 bcolr01">검색</button>
							</div>
							<p class="txt01">&gt; 지도를 클릭하면 해당 지역의 매장 정보를 보실 수 있습니다.   </p>
						</div>
						</form>
					</div>
					<div class="board_list">
						<table class="ta_list">
							<colgroup>
								<col class="store">
								<col class="subject">
								<col class="phone">
								<col class="icons">
								<col class="view_more">
							</colgroup>
							<thead>
								<tr>
									<th class="store">매장명</th>
									<th class="subject">주소</th>
									<th class="phone">전화번호</th>
									<th class="view_more">상세보기</th>
								</tr>
							</thead>
							<?
							$g_list_rows = 10;
							
							//카테고리 강제설정
							$search_category ="agency_name";
							if ($search_name)
							{
								//$strSql = $strSql." and replace(".$search_category.",'-','') like '%".str_replace("-","",$search_name)."%' ";
								$strSql = $strSql." and ".$search_category." like '%".str_replace("-","",$search_name)."%' ";
							}
							
							if ($sido)
							{
								$strSql = $strSql." and sido = '".$sido."' ";
							}
							if ($gugun)
							{
								$strSql = $strSql." and gugun = '".$gugun."' ";
							}
							$total_sql = " select * from tbl_agency where 1=1 $strSql ";
							$result = mysql_query($total_sql) or die (mysql_error());
							$nTotalCount = mysql_num_rows($result);

							$nPage = ceil($nTotalCount / $g_list_rows);
							if ($pg == "") $pg = 1;
							$nFrom = ($pg - 1) * $g_list_rows;

							$sql    = $total_sql . " order by a_idx desc limit $nFrom, $g_list_rows ";
							$result = mysql_query($sql) or die (mysql_error());
							$num = $nTotalCount - $nFrom;
							if ($nTotalCount == 0) {
							?>
							<tr>
								<td colspan=5 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
							</tr>
							<?
							}
							?>
							<tbody class="body_list">
								<?
								while($row=mysql_fetch_array($result)){
								?>
								<tr>
									<td class="store"><?=$row["agency_name"]?></td>
									<td class="subject"><a href="store_view.php?a_idx=<?=$row["a_idx"]?>&search_name=<?=$search_name?>&sido=<?=$sido?>&gugun=<?=$gugun?>"><?=$row["addr1"]." ".$row["addr2"]?></a></td>
									<td  class="phone">
										<a href="tel:<?=$row["phone"]?>"><?=$row["phone"]?></a>
									</td>
									<td class="view_more"><a href="store_view.php?a_idx=<?=$row["a_idx"]?>&search_name=<?=$search_name?>&sido=<?=$sido?>&gugun=<?=$gugun?>" class="btn_more">상세정보</a></td>
								</tr>
								<? } ?>
							</tbody>
						</table>
						<? if ($nPage > 1) { ?>
						<div class="btn_wrap">
							<a href="javascript:get_list()" class="more">더보기</a>
						</div>
						<? } ?>
					</div>
				</fieldset>	
			</form>
		</div>
	</section>
	<div class="tooltip-box"></div>
	<script type="text/javascript">
	$(function(){
		$(".korea-map g").click(function(){
			var mode =$(this).attr("id");
			
		});
		$(function() {
			$('svg > g').mouseenter(function(e){
				var loc_name = $(this).attr('id');
				var poi_x = e.pageX;
				var poi_y = e.pageY;
				$('.tooltip-box').html(loc_name);
				$('.tooltip-box').css({top:poi_y,left:poi_x + 30});
				$('.tooltip-box').show();
			});
			$('svg g').mouseleave(function(){
				$('.tooltip-box').hide();	
			});
		});
	});
	var pg = 1;
	function get_list()
	{
		pg = pg + 1;
        $.ajax({
			url: "get_store.php",
			type: "GET",
			data: "search_name=<?=$search_name?>&sido=<?=$sido?>&gugun=<?=$gugun?>&pg="+pg,
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				//alert(response);
				$(".body_list").append(response);

			}
        });
	}
	function change_it(str)
	{
        $.ajax({
			url: "get_sido.php",
			type: "GET",
			data: "sido="+encodeURI(str),
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
				$("#ajax_loader").addClass("display-none");
			}
			, success : function(response, status, request) {
				$("#gugun").html(response);
			}
        });
	}
	</script>
<? include('../inc/footer.inc.php');?>	