// 전화번호 입력하면 자동으로 하이픈이 표시되도록 하는 파일

function OnCheckCompanyNumber(oTa) {
    var oForm = oTa.form ;
    var sMsg = oTa.value ;
    var onlynum = "" ;
    var imsi=0;
    onlynum = RemoveDash2(sMsg);  //하이픈 입력시 자동으로 삭제함
    onlynum =  checkDigit(onlynum);  // 숫자만 입력받게 함
    var retValue = "";

    if(event.keyCode != 12 ) {
      if (GetMsgLen(onlynum) <= 2) oTa.value = onlynum ;
      if (GetMsgLen(onlynum) == 3) oTa.value = onlynum + "-";
      if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(4,1) ;
      if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(4,2) + "-" ;
      if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(4,2) + "-" + onlynum.substring(5,1) ;
      if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(4,2) + "-" + onlynum.substring(5,2) ;
      if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(4,2) + "-" + onlynum.substring(5,3) ;
      if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(4,2) + "-" + onlynum.substring(5,4) ;
      if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(4,2) + "-" + onlynum.substring(5,5) ;
    }
}

function RemoveDash2(sNo) {
var reNo = "";
for(var i=0; i<sNo.length; i++) {
    if ( sNo.charAt(i) != "-" ) {
    reNo += sNo.charAt(i);
    }
}
return reNo;
}

function GetMsgLen(sMsg) { // 0-127 1byte, 128~ 2byte
var count = 0;
    for(var i=0; i<sMsg.length; i++) {
        if ( sMsg.charCodeAt(i) > 127 ) {
            count += 2;
        }
        else {
            count++;
        }
    }
return count;
}

function checkDigit(num) {
    var Digit = "1234567890";
    var string = num;
    var len = string.length;
    var retVal = "";

    for (i = 0; i < len; i++)
    {
        if (Digit.indexOf(string.substring(i, i+1)) >= 0)
        {
            retVal = retVal + string.substring(i, i+1);
        }
    }
    return retVal;
}
