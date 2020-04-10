var smsReadyArray = [];

$("#allselect").click(function(){

  var allCnt = $(".tbodycheckbox").length;
  smsReadyArray = [];

  if($("#allselect").is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var smsReadyArrayEle = [];
      var colOrder = Number(table.find("tr:eq("+i+")").find("td:eq(1)").text());
      var colid = Number(table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val());
      var colgroup = table.find("tr:eq("+i+")").find("td:eq(2)").text();
      var colroom = table.find("tr:eq("+i+")").find("td:eq(3)").text();
      var colcustomerName = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(0)').val();
      var colcustomerContact = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(1)').val();
      var colcustomerEmail = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(2)').val();
      var colcustomerId = table.find("tr:eq("+i+")").find("td:eq(4)").children('input:eq(3)').val();
      var colexecutiveDate = "";
      var coltaxDate = table.find("tr:eq("+i+")").find("td:eq(13)").children('label').text();
      var colamount1 = table.find("tr:eq("+i+")").find("td:eq(9)").children('label:eq(0)').text();
      var colamount2 = table.find("tr:eq("+i+")").find("td:eq(9)").children('label:eq(1)').text();
      var colamount3 = table.find("tr:eq("+i+")").find("td:eq(10)").children().text();
      var colexpectedDate = table.find("tr:eq("+i+")").find("td:eq(8)").children('p:eq(0)').text().trim();
      var colstartDate = table.find("tr:eq("+i+")").find("td:eq(7)").children('label:eq(0)').text();
      var colendDate = table.find("tr:eq("+i+")").find("td:eq(7)").children('label:eq(1)').text();
      var colmonthcount = table.find("tr:eq("+i+")").find("td:eq(6)").text();
      var coldelaydays = table.find("tr:eq("+i+")").find("td:eq(12)").children('label:eq(0)').text();
      var coldelayinterest = table.find("tr:eq("+i+")").find("td:eq(12)").children('label:eq(1)').text();

      // console.log(colOrder, colid, colgroup, colroom, colcustomerName, colcustomerContact, colexectutiveDate, coltaxDate, colamount1, colamount2,colamount3);

      smsReadyArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'그룹':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexecutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId}, {'예정일':colexpectedDate}, {'시작일':colstartDate}, {'종료일':colendDate}, {'개월수':colmonthcount}, {'연체일수':coldelaydays}, {'연체이자':coldelayinterest});
      smsReadyArray.push(smsReadyArrayEle);
    }
  } else {
    smsReadyArray = [];
  }
  console.log(smsReadyArray);
})

$(document).on('click', '.tbodycheckbox', function(){
var smsReadyArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());
      var colgroup = currow.find("td:eq(2)").text();
      var colroom = currow.find("td:eq(3)").text();
      var colcustomerName = currow.find("td:eq(4)").children('input:eq(0)').val();
      var colcustomerContact = currow.find("td:eq(4)").children('input:eq(1)').val();
      var colcustomerEmail = currow.find("td:eq(4)").children('input:eq(2)').val();
      var colcustomerId = currow.find("td:eq(4)").children('input:eq(3)').val();
      var colexecutiveDate = "";
      var coltaxDate = currow.find("td:eq(13)").children('label').text();
      var colamount1 = currow.find("td:eq(9)").children('label:eq(0)').text();
      var colamount2 = currow.find("td:eq(9)").children('label:eq(1)').text();
      var colamount3 = currow.find("td:eq(10)").children().text();
      var colexpectedDate = currow.find("td:eq(8)").children('p:eq(0)').text().trim();
      var colstartDate = currow.find("td:eq(7)").children('label:eq(0)').text();
      var colendDate = currow.find("td:eq(7)").children('label:eq(1)').text();
      var colmonthcount = currow.find("td:eq(6)").text();
      var coldelaydays = currow.find("td:eq(12)").children('label:eq(0)').text();
      var coldelayinterest = currow.find("td:eq(12)").children('label:eq(1)').text();
      smsReadyArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'그룹':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexecutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId}, {'예정일':colexpectedDate}, {'시작일':colstartDate}, {'종료일':colendDate}, {'개월수':colmonthcount}, {'연체일수':coldelaydays}, {'연체이자':coldelayinterest});
      smsReadyArray.push(smsReadyArrayEle);
      // console.log('smsReadyArray :',smsReadyArray);
    } else {
      var dropReady = [];
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());
      var colgroup = currow.find("td:eq(2)").text();
      var colroom = currow.find("td:eq(3)").text();
      var colcustomerName = currow.find("td:eq(4)").children('input:eq(0)').val();
      var colcustomerContact = currow.find("td:eq(4)").children('input:eq(1)').val();
      var colcustomerEmail = currow.find("td:eq(4)").children('input:eq(2)').val();
      var colcustomerId = currow.find("td:eq(4)").children('input:eq(3)').val();
      var colexecutiveDate = "";
      var coltaxDate = currow.find("td:eq(13)").children('label').text();
      var colamount1 = currow.find("td:eq(9)").children('label:eq(0)').text();
      var colamount2 = currow.find("td:eq(9)").children('label:eq(1)').text();
      var colamount3 = currow.find("td:eq(10)").children().text();
      var colexpectedDate = currow.find("td:eq(8)").children('p:eq(0)').text().trim();
      var colstartDate = currow.find("td:eq(7)").children('label:eq(0)').text();
      var colendDate = currow.find("td:eq(7)").children('label:eq(1)').text();
      var colmonthcount = currow.find("td:eq(6)").text();
      var coldelaydays = currow.find("td:eq(12)").children('label:eq(0)').text();
      var coldelayinterest = currow.find("td:eq(12)").children('label:eq(1)').text();
      dropReady.push({'순번':colOrder}, {'청구번호':colid}, {'그룹':colgroup}, {'방번호':colroom}, {'세입자':colcustomerName}, {'연락처':colcustomerContact}, {'이메일':colcustomerEmail}, {'입금일':colexecutiveDate}, {'발행일':coltaxDate}, {'공급가액':colamount1}, {'세액':colamount2}, {'합계':colamount3}, {'세입자id':colcustomerId}, {'예정일':colexpectedDate}, {'시작일':colstartDate}, {'종료일':colendDate}, {'개월수':colmonthcount}, {'연체일수':coldelaydays}, {'연체이자':coldelayinterest});

      for (var i = 0; i < smsReadyArray.length; i++) {
        var join1 = smsReadyArray[i].join(',');
        var join2 = dropReady.join(',');

        if(join1===join2){
          var index = i;
        }
      }

      smsReadyArray.splice(index, 1);
      // console.log(index);
      // console.log(smsReadyArray);
    }

console.log(smsReadyArray);
})
