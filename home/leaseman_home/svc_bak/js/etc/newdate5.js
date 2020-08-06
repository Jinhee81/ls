var d = new Date();
var today = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + d.getDate();

var todayMonthFirst = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + '1';
var todayMonthLastDate = new Date(d.getFullYear(), (d.getMonth()+1), 0);
var todayMonthLastDate1 = todayMonthLastDate.getDate();
var todayMonthLast = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + todayMonthLastDate1;

if(d.getMonth()===0){
  var lastMonthFirst = d.getFullYear()-1 + '-' + '12' + '-' + '1';
  var lastMonthLast = d.getFullYear()-1 + '-' + '12' + '-' + '31';
  var last1monthdate = d.getFullYear()-1 + '-' + '12' + '-' + d.getDate();
} else {
  var lastMonthFirst = d.getFullYear() + '-' + d.getMonth() + '-' + '1';
  var lastMonthLastDate = new Date(d.getFullYear(), d.getMonth(), 0);
  var lastMonthLastDate1 = lastMonthLastDate.getDate();
  var lastMonthLast = new Date(d.getFullYear() + '-' + d.getMonth() + '-' + lastMonthLastDate1);
  lastMonthLast = lastMonthLast.getFullYear() + '-' + (lastMonthLast.getMonth()+1) + '-' + lastMonthLast.getDate();
  var last1monthdate = d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate();
}


var todayYearFirst = d.getFullYear() + '-1-1';

$('select[name="periodDiv"]').on('change', function(){

    var periodVal = $(this).val();
    // console.log(periodVal);
    if(periodVal === 'allDate'){
      $('input[name="fromDate"]').val("");
      $('input[name="toDate"]').val("");
    }

    if(periodVal === 'nowMonth'){
      $('input[name="fromDate"]').val(todayMonthFirst);
      $('input[name="toDate"]').val(todayMonthLast);
    }

    if(periodVal === 'pastMonth'){ //기간이 전월일 때
      $('input[name="fromDate"]').val(lastMonthFirst);
      $('input[name="toDate"]').val(lastMonthLast);
    }

    if(periodVal === '1pastMonth'){ //기간이 1개월전일때
      $('input[name="fromDate"]').val(last1monthdate);
      $('input[name="toDate"]').val(today);
    }

    if(periodVal === 'nowYear'){
      $('input[name="fromDate"]').val(todayYearFirst);
      $('input[name="toDate"]').val(today);
    }

}) ////select periodDiv function closing
