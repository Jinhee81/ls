var d = new Date();
var today = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + d.getDate();

var todayMonthFirst = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + '1';
var todayMonthLastDate = new Date(d.getFullYear(), (d.getMonth()+1), 0);
var todayMonthLastDate1 = todayMonthLastDate.getDate();
var todayMonthLast = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + todayMonthLastDate1;

if(d.getMonth()===0){
  var lastMonthFirst = d.getFullYear()-1 + '-' + '12' + '-' + '01';
  var lastMonthLast = d.getFullYear()-1 + '-' + '12' + '-' + '31';
  var last1monthdate = d.getFullYear()-1 + '-' + '12' + '-' + d.getDate();
} else {
  var lastMonthFirst = d.getFullYear() + '-' + d.getMonth() + '-' + '01';
  var lastMonthLastDate = new Date(d.getFullYear(), d.getMonth(), 0);
  var lastMonthLastDate1 = lastMonthLastDate.getDate();
  var lastMonthLast = new Date(d.getFullYear() + '-' + d.getMonth() + '-' + lastMonthLastDate1);
  lastMonthLast = lastMonthLast.getFullYear() + '-' + (lastMonthLast.getMonth()+1) + '-' + lastMonthLast.getDate();
  var last1monthdate = d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate();
}

if(d.getMonth()===11){
  var nextMonthFirst = d.getFullYear()+1 + '-' + '1' + '-' + '1';
  var nextMonthLast = d.getFullYear()+1 + '-' + '1' + '-' + '31';
} else {
  var nextMonthFirst = d.getFullYear() + '-' + (d.getMonth()+2) + '-' + '1';
  var nextMonthLastDate = new Date(d.getFullYear(), (d.getMonth()+2), 0);
  var nextMonthLastDate1 = lastMonthLastDate.getDate();
  var nextMonthLast = new Date(d.getFullYear() + '-' + (d.getMonth()+2) + '-' + nextMonthLastDate1);
  nextMonthLast = nextMonthLast.getFullYear() + '-' + (nextMonthLast.getMonth()+1) + '-' + nextMonthLast.getDate();
}


var todayYearFirst = d.getFullYear() + '-1-1';



function dateinput2(x){ //from, to date 입력()
  if(x === 'allDate'){
    var fromdate = $('input[name="fromDate"]').val("");
    var todate = $('input[name="toDate"]').val("");
  }

  if(x === 'nowMonth'){
    var fromdate = $('input[name="fromDate"]').val(todayMonthFirst);
    var todate = $('input[name="toDate"]').val(todayMonthLast);
  }

  if(x === 'pastMonth'){ //기간이 전월일 때
    var fromdate = $('input[name="fromDate"]').val(lastMonthFirst);
    var todate = $('input[name="toDate"]').val(lastMonthLast);
  }

  if(x === '1pastMonth'){ //기간이 1개월전일때
    var fromdate = $('input[name="fromDate"]').val(last1monthdate);
    var todate = $('input[name="toDate"]').val(today);
  }

  if(x === 'nextMonth'){ //기간이 익월일 때
    var fromdate = $('input[name="fromDate"]').val(nextMonthFirst);
    var todate = $('input[name="toDate"]').val(nextMonthLast);
  }

  if(x === 'nowYear'){
    var fromdate = $('input[name="fromDate"]').val(todayYearFirst);
    var todate = $('input[name="toDate"]').val(today);
  }

  if(x === 'today'){
    $('input[name="fromDate"]').val(today);
    $('input[name="toDate"]').val(today);
  }

  return fromdate, todate;
}
