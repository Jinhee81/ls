//비고란 텍스트를 당분간 없애기로 함 - 2020.8.6

var taxArray = [];

$("#allselect").click(function(){

  var allCnt = $(".tbodycheckbox").length;
  taxArray = [];

  if($(this).is(":checked")){
    for (var i = 1; i <= allCnt; i++) {
      var taxArrayEle = [];
      var colOrder = Number(table.find("tr:eq("+i+")").find("td:eq(1)").text());//순번
      var colid = Number(table.find("tr:eq("+i+")").find("td:eq(0)").children('input').val());//청구번호

      Number(table.find("tr:eq("+i+")").find("td:eq(7)").children('input[name=customer_id]').val());//세입자번호
      var companynumber = table.find("tr:eq("+i+")").find("td:eq(7)").children('input[name=companynumber]').val();//사업자번호
      var companyname = table.find("tr:eq("+i+")").find("td:eq(7)").children('input[name=companyname]').val();//사업자명
      var name = table.find("tr:eq("+i+")").find("td:eq(7)").children('input[name=name]').val();//성명
      var address = table.find("tr:eq("+i+")").find("td:eq(7)").children('input[name=address]').val();//주소
      var div4 = table.find("tr:eq("+i+")").find("td:eq(7)").children('input[name=div4]').val();//업태
      var div5 = table.find("tr:eq("+i+")").find("td:eq(7)").children('input[name=div5]').val();//종목
      var contact = table.find("tr:eq("+i+")").find("td:eq(8)").text();//연락처
      var email = table.find("tr:eq("+i+")").find("td:eq(7)").children('input[name=email]').val();//이메일
      var supplyamount = table.find("tr:eq("+i+")").find("td:eq(3)").text();//공급가액
      var vatamount = table.find("tr:eq("+i+")").find("td:eq(4)").text();//세액
      var totalamount = table.find("tr:eq("+i+")").find("td:eq(5)").children().text();//합계
      var executiveDate = table.find("tr:eq("+i+")").find("td:eq(2)").children('p').text();//납부일자
      var startdate = table.find("tr:eq("+i+")").find("td:eq(2)").children('input:eq(0)').val();//청구시작일
      var enddate = table.find("tr:eq("+i+")").find("td:eq(2)").children('input:eq(1)').val();//청구종료일
      var monthcount = table.find("tr:eq("+i+")").find("td:eq(2)").children('input:eq(2)').val();//청구개월
      var contractDiv = table.find("tr:eq("+i+")").find("td:eq(9)").children('input[name=roomdiv]').val();//계약구분,방계약인지기타계약인지

      var comment;//비고

      if(contractDiv==='room'){
        // comment = "기간 ("+startdate+"~"+enddate+", "+monthcount+"개월 이용료)";//비고
        comment = '';
      } else {
        comment = '';
      }

      var acceptdiv = table.find("tr:eq("+i+")").find("td:eq(6)").text().trim();//입금구분
      var evidencedate = table.find("tr:eq("+i+")").find("td:eq(10)").text();//증빙일자

      taxArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'사업자번호':companynumber}, {'사업자명':companyname}, {'성명':name}, {'주소':address}, {'업태':div4}, {'종목':div5}, {'연락처':contact}, {'이메일':email}, {'공급가액':supplyamount}, {'세액':vatamount}, {'합계':totalamount}, {'비고':comment}, {'입금구분':acceptdiv}, {'증빙일자':evidencedate});

      taxArray.push(taxArrayEle);
    }
  } else {
    taxArray = [];
  }
//   console.log(taxArray);
})

$(document).on('change', '.tbodycheckbox', function(){
var taxArrayEle = [];

    if($(this).is(":checked")){
      var currow = $(this).closest('tr');
      var colOrder = Number(currow.find('td:eq(1)').text());
      var colid = Number(currow.find("td:eq(0)").children('input').val());

      Number(currow.find("td:eq(7)").children('input[name=customer_id]').val());//세입자번호
      var companynumber = currow.find("td:eq(7)").children('input[name=companynumber]').val();//사업자번호
      var companyname = currow.find("td:eq(7)").children('input[name=companyname]').val();//사업자명
      var name = currow.find("td:eq(7)").children('input[name=name]').val();//성명
      var address = currow.find("td:eq(7)").children('input[name=address]').val();//주소
      var div4 = currow.find("td:eq(7)").children('input[name=div4]').val();//업태
      var div5 = currow.find("td:eq(7)").children('input[name=div5]').val();//종목
      var contact = currow.find("td:eq(8)").text();//연락처
      var email = currow.find("td:eq(7)").children('input[name=email]').val();//이메일
      var supplyamount = currow.find("td:eq(3)").text();//공급가액
      var vatamount = currow.find("td:eq(4)").text();//세액
      var totalamount = currow.find("td:eq(5)").children().text();//합계

      var executiveDate = currow.find("td:eq(2)").children('p').text();//납부일자

      var startdate = currow.find("td:eq(2)").children('input:eq(0)').val();//청구시작일
      var enddate = currow.find("td:eq(2)").children('input:eq(1)').val();//청구종료일
      var monthcount = currow.find("td:eq(2)").children('input:eq(2)').val();//청구개월
      var contractDiv = currow.find("td:eq(9)").children('input[name=roomdiv]').val();//계약구분,방계약인지기타계약인지

      var comment;//비고

      if(contractDiv==='room'){
        // comment = "기간 ("+startdate+"~"+enddate+", "+monthcount+"개월 이용료)";//비고
        comment = '';
      } else {
        comment = '';
      }

      var acceptdiv = currow.find("td:eq(6)").text().trim();//입금구분
      var evidencedate = currow.find("td:eq(10)").text();//증빙일자

      taxArrayEle.push({'순번':colOrder}, {'청구번호':colid}, {'사업자번호':companynumber}, {'사업자명':companyname}, {'성명':name}, {'주소':address}, {'업태':div4}, {'종목':div5}, {'연락처':contact}, {'이메일':email}, {'공급가액':supplyamount}, {'세액':vatamount}, {'합계':totalamount}, {'비고':comment}, {'입금구분':acceptdiv}, {'증빙일자':evidencedate});

      taxArray.push(taxArrayEle);

      console.log(taxArray);

    } else {

      var currow = $(this).closest('tr');
      var dropOrder = Number(currow.find('td:eq(1)').text());

      console.log(dropOrder);

      for (var i = 0; i < taxArray.length; i++) {
        // var join1 = taxArray[i].join(',');
        // var join2 = dropReady.join(',');

        // var join1 = taxArray[i][0]['순번'];
        // var join2 = dropReady['순번'];

        if(taxArray[i][0]['순번'] === dropOrder) {
          var index = i;
        }


      }
      console.log(index);
      taxArray.splice(index, 1);

    } //if else closing}
    // console.log(taxArray);

})//tbodycheckbox change event closing}
