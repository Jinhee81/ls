<script language="JavaScript"> 
<!-- 
// 이부분부터  수정할 필요 없습니다. 
function getCookie(name) { 
var Found = false 
var start, end 
var i = 0 
 
while(i <= document.cookie.length) { 
start = i 
end = start + name.length 
 
if(document.cookie.substring(start, end) == name) { 
Found = true 
break 
} 
i++ 
} 
 
if(Found == true) { 
start = end + 1
end = document.cookie.indexOf(";", start) 
if(end < start) 
end = document.cookie.length 
return document.cookie.substring(start, end) 
} 
return "" 
} 

function setCookie( name, value, expiredays ) {  
    var todayDate = new Date();  
        todayDate.setDate( todayDate.getDate() + expiredays );  
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"  
    }  
 
function closeWin(Divpop) {
        document.getElementById('apDiv'+Divpop).style.visibility = "hidden";   
       if(document.getElementById('Pnotice'+Divpop).checked){
       		setCookie("maindivapDiv"+Divpop,"done",1);
       	}
   
}
 
function closeWin2() {
	
    if (document.getElementById("popchk").checked ){  
        setCookie( "popclose", "done" , 1 );  
    }  
	$('.layerBg').fadeOut('300');
	$(".layerPop").hide();
}
 
function openPopup(){
	cookiedata = document.cookie;
	<?
	$sql    = " Select * from tbl_popup2 where status = 'B' or (concat(P_STARTDAY, ' ', P_START_HH, ':', P_START_MM ) <= '".date("Y-m-d H:i")."' and concat(P_ENDDAY, ' ', P_END_HH, ':', P_END_MM ) >= '".date("Y-m-d H:i")."' and status = 'A' )  order by idx desc ";
	$result = mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_array($result)){
	?>
	if ( cookiedata.indexOf("maindivapDiv<?=$row[idx]?>=done") < 0 ){
		<? if ($row[P_CATE] == "L") { ?>
	    document.getElementById('apDiv<?=$row[idx]?>').style.visibility = "visible"; 
		<? } else { ?>
		if (getCookie("maindivapDiv<?=$row[idx]?>") != "no")
		{
			window.open('/include/popup.php?idx=<?=$row[idx]?>','pop<?=$row[idx]?>','width=<?=$row[P_WIN_WIDTH]?>,height=<?=$row[P_WIN_HEIGHT]+24?>,top=<?=$row[P_WIN_TOP]?>,left=<?=$row[P_WIN_LEFT]?>'); 
		}
		<?	} ?>
	}else { 
	    document.getElementById('apDiv<?=$row[idx]?>').style.visibility = "hidden";  
	}
	<?
	}
	?>
}

//-->   
</script>

<?
$sql    = " Select * from tbl_popup2 where status = 'B' or (concat(P_STARTDAY, ' ', P_START_HH, ':', P_START_MM ) <= '".date("Y-m-d H:i")."' and concat(P_ENDDAY, ' ', P_END_HH, ':', P_END_MM ) >= '".date("Y-m-d H:i")."' and status = 'A' )  order by idx desc ";
$result = mysql_query($sql) or die (mysql_error());
while($row=mysql_fetch_array($result)){
?>
<div class="apDiv" id="apDiv<?=$row[idx]?>" style="position:absolute; left:<?=$row[P_WIN_LEFT]?>px; top:<?=$row[P_WIN_TOP]?>px; width:<?=$row[P_WIN_WIDTH]?>px; height:<?=$row[P_WIN_HEIGHT]?>px; z-index:999999; visibility: hidden;">
	<table border="0" cellspacing="0" cellpadding="0"  bgcolor=ffffff>
		<tr <? if ($row[P_MOVEURL]) { ?> onclick="javascript:<? if ($row[P_STYLE] == "N") { ?>window.open('<?=$row[P_MOVEURL]?>')<? } else { ?>location.href='<?=$row[P_MOVEURL]?>'<? } ?>" style="cursor:pointer;" <? } ?>>
			<td><?=viewSQ($row[P_CONTENT])?></td>
		</tr>
		<form name="frm" id="frm<?=$row[idx]?>" style="margin:0px">
			<tr bgcolor=333333 height=25 align=center>
				<td><input type="checkbox" name="Pnotice<?=$row[idx]?>" id="Pnotice<?=$row[idx]?>" onClick="closeWin('<?=$row[idx]?>');" />
					<span class="style1" style="color: #FFFFFF">오늘 하루동안 창 열지 않기<a onClick="javascript:closeWin('<?=$row[idx]?>')" href="#"><font color=ffffff>[Close]</font></a></td>
			</tr>
		</form>
	</table>
</div>
<?
}

?>
<script> 
openPopup();
if ($(window).width() <= 750){
	$('.apDiv').hide();
}
$(window).resize(function(){
	if ($(window).width() <= 750){
		$('.apDiv').hide();
	}
});
</script>
