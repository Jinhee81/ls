//=========================문자보내기버튼 클릭 js=====================

$('#smsBtn').on('click', function(){

    if(smsReadyArray.length===0){
      alert('1개 이상을 선택해야 문자메시지 보내기가 가능합니다.');
      return false;
    }

    var smsTitle = $('#smsTitle :selected').val();
    if(smsTitle==='상용구없음'){
      $(this).attr('data-target','#smsModal1');
    } else {
      $(this).attr('data-target','#smsModal2');
    }

    // console.log(smsReadyArray);

    if(smsTitle==='상용구없음'){
      sms_noneparase();
    } else { //if(smsTitle==='상용구없음') end, else start
      sms_existparase();
    } //if(smsTitle==='상용구없음') else end}

}) //smsBtn function closing
