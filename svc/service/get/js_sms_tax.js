$('#smsBtn').on('click', function(){

    var buildingkey = $('select[name=building]').val();
    // console.log(buildingkey);

    //문자발송에 필요한 번호
    var sendphonenumber = buildingArray[buildingkey][3] + buildingArray[buildingkey][4] + buildingArray[buildingkey][5];

    $('input[name=sendphonenumber]').val(sendphonenumber);

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

function taxInfo(idx,mun) {

    var tmps = "<iframe name='ifm_pops_21' id='ifm_pops_21' class='popup_iframe'   scrolling='no' src=''></iframe>";
	$("body").append(tmps);
	//alert( "/inc/tax_invoice2.php?chkId="+chkId+"&callnum="+subIdx );

	$("#ifm_pops_21").attr("src","/svc/service/get/tax_invoice.php?building_idx="+$('#building').val()+"&mun="+mun+"&id="+idx);
	$('#ifm_pops_21').show();
	$('.pops_wrap, .pops_21').show();

}



$('#btnTaxDateInput').on('click', function(){
  var taxDate = $('input[name="taxDate"]').val();
  var taxSelect = $('select[name="taxSelect"]').val(); //세금계산서인지 현금영수증인지 구분

  var buildingkey = $('select[name=building]').val();
  // console.log(buildingkey);

  //세금계산서발송에 필요한 팝빌아이디, 사업자번호
  var buildingText = $('select[name=building] option:selected').text();
  var buildingPopbillid = buildingArray[buildingkey][2];
  var buildingCompanynumber = buildingArray[buildingkey][6]+buildingArray[buildingkey][7] + buildingArray[buildingkey][8];

  // alert(buildingCompanynumber);


  if(taxArray.length===0){
    alert('세금계산서 발행할 것들을 먼저 체크박스로 선택해주세요.');
    return false;
  }


  if(buildingPopbillid.length === 0){
    alert(buildingText+' 물건은 팝빌 전자세금계산서 설정이 되어있지 않습니다. 전자세금계산서 설정을 확인해주세요 (환경설정->물건명클릭, 팝빌아이디 입력)');
    return false;
  }

  if(buildingCompanynumber.length === 0){
    alert(buildingText+'물건의 사업자번호등록이 되어있지 않습니다. 사업자번호가 등록되어야 합니다 (환경설정->물건명클릭)');
    return false;
  }

  if(buildingCompanynumber.length != 10){
    alert(buildingText+'물건의 사업자번호 형식이 올바르지 않습니다. 사업자번호를 확인하세요. (환경설정->물건명클릭)');
    console.log(buildingCompanynumber);
    return false;
  }

  if(taxDate.length===0){
    alert('세금계산서 발행일자가 입력되어야합니다.');
    return false;
  }

  if(taxArray.length >= 1) {
    for (var i in taxArray) {
      if(taxArray[i][14]['입금구분']==='카드'){
        alert("입금구분이 '카드'이면 세금계산서 발행이 불가합니다.");
        return false;
      }

      if(taxArray[i][11]['세액']==='0'){
            alert("세액이 '0'원이면 세금계산서 발행이 불가합니다.");
            return false;
      }

      if(taxArray[i][15]['증빙일자']){
            alert("이미 증빙일자가 존재하므로 세금계산서 발행이 불가합니다.");
            return false;
      }

      if(taxArray[i][2]['사업자번호'].length != 12){
            alert(taxArray[i][4]['성명']+"의 사업자번호가 비어있어 세금계산서 발행이 불가합니다.");
            return false;
      }

      if(!taxArray[i][3]['사업자명']){
            alert(taxArray[i][4]['성명']+"의 사업자명이 비어있어 세금계산서 발행이 불가합니다.");
            return false;
      }
    }
  }

  var taxArrayTo = JSON.stringify(taxArray);
  var aa = 'taxSave';
  var bb = 'p_payScheduleTaxInput.php';

  goCategoryPage(aa, bb, buildingkey, buildingText, buildingPopbillid, buildingCompanynumber, taxArrayTo, taxDate, taxSelect, taxDiv);

  function goCategoryPage(a,b,c,d,e,f,g,h,i,j){
      var frm = formCreate(a, 'post', b,'');
      frm = formInput(frm, 'buildingId', c);
      frm = formInput(frm, 'buildingText', d);
      frm = formInput(frm, 'buildingPopbill', e);
      frm = formInput(frm, 'buildingCompanynumber', f);
      frm = formInput(frm, 'taxArray', g);
      frm = formInput(frm, 'taxDate', h);
      frm = formInput(frm, 'taxSelect', i);
      frm = formInput(frm, 'taxDiv', j);
      formSubmit(frm);
  }

})
