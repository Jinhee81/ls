var today = new Date();
var yyyy = today.getFullYear();
var mm = today.getMonth() + 1;
var dd = today.getDate();

if(mm<10){
  mm = '0'+mm;
}
if(dd<10){
  dd = '0'+dd;
}

today = yyyy + '-' + mm + '-' + dd;
console.log(today);
console.log(typeof(mm));
console.log(mm);

$('select[name="periodDiv"]').on('change', function(){

    var periodVal = $(this).val();
    // console.log(periodVal);
    if(periodVal === 'allDate'){
      $('input[name="fromDate"]').val("");
      $('input[name="toDate"]').val("");
    }
    if(periodVal === 'nowMonth'){
      var fromDate = yyyy + '-' + mm + '-01';
      var nowMonth = Number(mm);
      var nowMonthDate = new Date(yyyy,nowMonth,0).getDate();
      var toDate = yyyy + '-' + nowMonth + '-' + nowMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(toDate);
    }
    if(periodVal === 'pastMonth'){ //기간이 전월일 때
      if(mm==='01'){
        var fromDate = Number(yyyy)-1 + '-' + '12' + '-01';
        var toDate = Number(yyyy)-1 + '-' + '12' + '-' + '31';
        $('input[name="fromDate"]').val(fromDate);
        $('input[name="toDate"]').val(toDate);
        console.log('222');
        console.log(fromDate);
      } else {
        var pastMonth = Number(mm)-1;
        // console.log(pastMonth);
        var pastMonthDate = new Date(yyyy,pastMonth,0).getDate();
        if(pastMonth<10){
          pastMonth = '0' + pastMonth;
        }
        if(pastMonthDate<10){
          pastMonthDate = '0' + pastMonthDate;
        }
        var fromDate = yyyy + '-' + pastMonth + '-01';
        var toDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
        $('input[name="fromDate"]').val(fromDate);
        $('input[name="toDate"]').val(toDate);
      }
    }


    if(periodVal === '1pastMonth'){ //기간이 1개월전일때

      if(mm==='01'){
        var pastMonthDate = Number(dd);
        var fromDate = Number(yyyy)-1 + '-12-' + pastMonthDate
        $('input[name="fromDate"]').val(fromDate);
        $('input[name="toDate"]').val(today);

      } else {
        var pastMonth = Number(mm)-1;
        // console.log(pastMonth);
        var pastMonthDate = Number(dd);
        if(pastMonth<10){
          pastMonth = '0' + pastMonth;
        }
        if(pastMonthDate<10){
          pastMonthDate = '0' + pastMonthDate;
        }
        var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
        $('input[name="fromDate"]').val(fromDate);
        $('input[name="toDate"]').val(today);
      }
    }


    if(periodVal === '3pastMonth'){//기간이 3개월전일때
      var pastMonth = Number(mm)-3;
      // console.log(pastMonth);
      var pastMonthDate = Number(dd);
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }
    if(periodVal === 'nowYear'){
      var pastMonth = Number(1);
      // console.log(pastMonth);
      var pastMonthDate = Number(1);
      if(pastMonth<10){
        pastMonth = '0' + pastMonth;
      }
      if(pastMonthDate<10){
        pastMonthDate = '0' + pastMonthDate;
      }
      var fromDate = yyyy + '-' + pastMonth + '-' + pastMonthDate;
      $('input[name="fromDate"]').val(fromDate);
      $('input[name="toDate"]').val(today);
    }

}) ////select periodDiv function closing
