function sms_existparase(){
  var smsTitle = $('#smsTitle').val();
  $('#modalsmstitle').text(smsTitle);

  for (var i = 0; i < smsSettingArray.length; i++) {
      if(smsSettingArray[i]['title']===smsTitle){
        var smsDescription = smsSettingArray[i]['description'];
        break;
      }
  }
  // console.log(smsDescription);

  var trAccu;
  for (var i = 0; i < smsReadyArray.length; i++) {
      // smsDescription.replace(/{세입자}/gi,smsReadyArray[i][4]['세입자']);
      var result = smsDescription.replace(/{세입자}|{이메일}|{입금일}|{발행일}|{공급가액}|{세액}|{합계}|{예정일}|{시작일}|{종료일}|{개월수}|{연체일수}|{연체이자}/g, function(v){
        switch (v) {
          case "{세입자}":return smsReadyArray[i][4]['세입자'];
          case "{이메일}":return smsReadyArray[i][6]['이메일'];
          case "{입금일}":return smsReadyArray[i][7]['입금일'];
          case "{발행일}":return smsReadyArray[i][8]['발행일'];
          case "{공급가액}":return smsReadyArray[i][9]['공급가액'];
          case "{세액}":return smsReadyArray[i][10]['세액'];
          case "{합계}":return smsReadyArray[i][11]['합계'];
          case "{예정일}":return smsReadyArray[i][13]['예정일'];
          case "{시작일}":return smsReadyArray[i][14]['시작일'];
          case "{종료일}":return smsReadyArray[i][15]['종료일'];
          case "{개월수}":return smsReadyArray[i][16]['개월수'];
          case "{연체일수}":return smsReadyArray[i][17]['연체일수'];
          case "{연체이자}":return smsReadyArray[i][18]['연체이자'];
        }
      });
      // console.log(result);


      var tr = "<tr><td><input type='checkbox' name='chk' value='"+smsReadyArray[i][12]['세입자id']+"'><input type='hidden' name='roomNumber' value='"+smsReadyArray[i][3]['방번호']+"'></td><td><textarea class='form-control textareaMany' rows='4' style='background-color: #FAFAFA;'>"+result+"</textarea></td><td style='line-height:15px;'><small><span>"+smsReadyArray[i][4]['세입자']+"</span><br><span class='phonenumber'>"+smsReadyArray[i][5]['연락처']+"</span><br><span class='getByte'></span> / 80 bytes <span class='bytediv'></span></small></td></tr>";
      trAccu += tr;
  }//for end

  $('#tbody2').html(trAccu);

  // 테이블 헤더에 있는 checkbox 클릭시
  $("#thead2 :checkbox").on('click', function(){
      if($("#thead2 :checkbox").is(":checked")){
        $("#tbody2 :checkbox").prop('checked',true);
        $("#tbody2 tr").addClass("selected");
        // console.log(1);
      } else {
        $("#tbody2 :checkbox").prop('checked',false);
        $("#tbody2 tr").removeClass("selected");
        // console.log(2);
      }
  })

  var allCnt = $("#tbody2 :checkbox").length;

  // 헤더에 있는 체크박스외 다른 체크박스 클릭시
  $("#tbody2 :checkbox").on('change', function(){

      var checkedCnt = $(":checkbox", tbody2).filter(":checked").length;
      // console.log(allCnt, checkedCnt);
      // console.log(222);

      if($(this).prop("checked")==true){
        $(this).parent().parent().addClass("selected");
      } else {
        $(this).parent().parent().removeClass("selected");
      }

      if( allCnt==checkedCnt ){
        $("#thead2 :checkbox").prop("checked", true);
      }
  })

  function byteLength(a){
    var l = 0;

    for (var idx=0; idx<a.length; idx++){
      var c = escape(a.charAt(idx));
      if(c.length==1) l++;
      else if(c.indexOf("%u")!==-1) l += 2;
      else if(c.indexOf("%")!==-1) l += c.length/3;
    }
    return l;
  }

  for (var i = 0; i < allCnt; i++) {
      var textareaValue = $("#tbody2").find("tr:eq("+i+")").find("td:eq(1)").children('textarea').text();
      // console.log(textareaValue);

      var getByte = byteLength(textareaValue);

      $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().children("span:eq(2)").text(getByte);

      if(getByte > 80){
        $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().children("span:eq(3)").attr('class','badge badge-danger');
        $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().children("span:eq(3)").text('mms');
      } else {
        $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().children("span:eq(3)").attr('class','badge badge-primary');
        $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().children("span:eq(3)").text('sms');
      }
  }

  $('.textareaMany').on('keyup', function(){
      var textareaValue = $(this).val();
      var getByte = byteLength(textareaValue);
      // console.log(getByte);
      $(this).parent().parent().find("td:eq(2)").children().children("span:eq(2)").text(getByte);
  })

  $('.textareaMany').on('change', function(){
      var textareaValue = $(this).val();
      var getByte = byteLength(textareaValue);
      // console.log(getByte);
      if(getByte > 80){
        $(this).parent().parent().find("td:eq(2)").children().children("span:eq(3)").attr('class','badge badge-primary');
        $(this).parent().parent().find("td:eq(2)").children().children("span:eq(3)").text('mms');
      } else {
        $(this).parent().parent().find("td:eq(2)").children().children("span:eq(3)").attr('class','badge badge-primary');
        $(this).parent().parent().find("td:eq(2)").children().children("span:eq(3)").text('sms');
      }
  })

  $('#smsTime2').on('change', function(){

    // console.log('hanju');


    if($('#smsTime2').val()==='reservation'){


      $('#timeSet2').html('<input type="text" class="form-control form-control-sm timeType" id="timeSetVal2" value="" style="width:10rem;">');
    } else {
      $('#timeSet2').empty();
    }

    $('.timeType').datetimepicker({
      dateFormat:'yy-mm-dd',
      monthNamesShort:[ '1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월' ],
      dayNamesMin:[ '일', '월', '화', '수', '목', '금', '토' ],
      changeMonth:true,
      changeYear:true,
      showMonthAfterYear:true,

      timeFormat: 'HH:mm:ss',
      controlType: 'select',
      oneLine: true,
      minDate: today
      // hourMin: today.getHours(), 시간,분,초 구하는게 잘 안되서 일단 안하기로함.
      // minuteMin: today.getMinutes(),
      // hourMin: today.getSeconds()
    })

    // console.log('solmi');

  })

  $('#smsSendBtn2').on('click', function(){
    var allCnt = $("#tbody2 :checkbox").length;
    var sendedArray2 = [];
    // console.log(allCnt);

    if($("#thead2 :checkbox").is(':checked')){
        for (var i = 0; i < allCnt; i++) {
          var sendedArray2ele = [];
          var colcustomerId = $("#tbody2").find("tr:eq("+i+")").find("td:eq(0)").children('input').val();//세입자번호
          var colcustomerName = $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().children("span:eq(0)").text();//세입자이름
          var coldescription = $("#tbody2").find("tr:eq("+i+")").find("td:eq(1)").children('textarea').text();//문자내용
          var colphone = $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().find('span:eq(1)').text();
          var colgetByte = $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().find('span:eq(2)').text();
          var colsmsmmsdiv = $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().find('span:eq(3)').text();
          var colroomNumber =
          $("#tbody2").find("tr:eq("+i+")").find("td:eq(0)").children('input:eq(1)').val();
          sendedArray2ele.push(colcustomerId, colcustomerName, coldescription, colphone, colgetByte, colsmsmmsdiv, colroomNumber);
          sendedArray2.push(sendedArray2ele);
          // console.log(colcustomerId, coldescription, colphone, colgetByte, colsmsmmsdiv);
        }
    } else {
      for (var i = 0; i < allCnt; i++) {
        var checkboxCheck = $("#tbody2").find("tr:eq("+i+")").find("td:eq(0)").children('input').is(':checked');//체크인지 아닌지 확인
        // console.log(checkboxCheck);

        if(checkboxCheck===true){
          var sendedArray2ele = [];
          var colcustomerId = $("#tbody2").find("tr:eq("+i+")").find("td:eq(0)").children('input').val();//세입자번호
          var colcustomerName = $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().children("span:eq(0)").text();//세입자이름
          var coldescription = $("#tbody2").find("tr:eq("+i+")").find("td:eq(1)").children('textarea').text();
          // console.log(colptAmount);
          var colphone = $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().find('span:eq(1)').text();
          var colgetByte = $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().find('span:eq(2)').text();
          var colsmsmmsdiv = $("#tbody2").find("tr:eq("+i+")").find("td:eq(2)").children().find('span:eq(3)').text();
          var colroomNumber =
          $("#tbody2").find("tr:eq("+i+")").find("td:eq(0)").children('input:eq(1)').val();
          sendedArray2ele.push(colcustomerId, colcustomerName, coldescription, colphone, colgetByte, colsmsmmsdiv, colroomNumber);
          sendedArray2.push(sendedArray2ele);
        }
      }
    }

    console.log(sendedArray2);

    if(sendedArray2.length===0){
      alert('1개이상을 선택해야합니다.');
      return false;
    }

    function goCategoryPage(a,b,c,d,e){
        var frm = formCreate(a, 'post', b,'');
        frm = formInput(frm, 'sendedArray2', c);
        frm = formInput(frm, 'timeDiv', d);
        frm = formInput(frm, 'smsTime', e);
        formSubmit(frm);
    }

    var sendedArray2json = JSON.stringify(sendedArray2);
    var aa = 'sendedArray2';
    var bb = '/svc/service/sms/p_sendedsms2.php';
    var smsTime = $('#smsTime2').val();
    var smsTimeValue = $('#timeSetVal2').val();

    goCategoryPage(aa, bb, sendedArray2json, smsTime, smsTimeValue);




  })//smsSendBtn2 click function end

}//sms_existparase end
