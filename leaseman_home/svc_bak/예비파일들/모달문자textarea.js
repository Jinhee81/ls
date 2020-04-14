$('textarea').on('keyup', function(){
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
  var textContent = $('textarea').val();
  var getByte = byteLength(textContent);
  // console.log(getByte);
  $("#getByte").html(getByte);

  if(getByte > 80){
    $('#smsDiv').html('<span class="badge badge-danger">mms</span>');
  } else {
    $('#smsDiv').html('<span class="badge badge-primary">sms</span>');
  }

})

$('textareaMany').on('keyup', function(){
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
  var textContent = $('textareaMany').val();
  var getByte = byteLength(textContent);
  // console.log(getByte);
  $(".getByte").html(getByte);

  if(getByte > 80){
    $('.smsDiv').html('<span class="badge badge-danger">mms</span>');
  } else {
    $('.smsDiv').html('<span class="badge badge-primary">sms</span>');
  }

})



$('#smsTime').on('change', function(){


  if($('#smsTime').val()==='reservation'){


    $('#timeSet').html('<input type="text" class="form-control form-control-sm timeType mb-2" name="startTime" value="" placeholder="">');
  } else {
    $('#timeSet').empty();
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
    oneLine: true
  })

  // console.log('solmi');

})

$('#smsTime2').on('change', function(){

  // console.log('hanju');


  if($('#smsTime2').val()==='reservation'){


    $('#timeSet2').html('<input type="text" class="form-control form-control-sm timeType" name="startTime" value="" style="width:10rem;">');
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
    oneLine: true
  })

  // console.log('solmi');

})
