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

  var taxSelect = '세금계산서';
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

  // if(taxSelect==='현금영수증'){
  //   alert('현금영수증발행은 불가합니다.대신 현금영수증 발행하는것을 입력하는것은 가능합니다.');
  //   return false;
  // }
  //이건 나중에 현금영수증 api도 구현할때 사용할거임


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

  goCategoryPage(buildingkey, buildingText, buildingPopbillid, buildingCompanynumber, taxArrayTo, taxSelect, taxDiv);

  function goCategoryPage(a,b,c,d,e,f,g,h,i,j){
      var frm = formCreate('taxSave', 'post', 'p_payScheduleTaxInput.php','');
      frm = formInput(frm, 'buildingId', a);
      frm = formInput(frm, 'buildingText', b);
      frm = formInput(frm, 'buildingPopbill', c);
      frm = formInput(frm, 'buildingCompanynumber', d);
      frm = formInput(frm, 'taxArray', e);
      frm = formInput(frm, 'taxSelect', f);
      frm = formInput(frm, 'taxDiv', g);
      formSubmit(frm);
  }

})

$('#btnTaxDateInput2').on('click', function(){
  var taxDate = $('input[name="taxDate"]').val();
  var taxSelect = $('select[name="taxSelect"]').val(); //세금계산서인지 현금영수증인지 구분

  if(taxArray.length===0){
    alert('세금계산서 발행할 것들을 먼저 체크박스로 선택해주세요.');
    return false;
  }

  if(taxDate.length===0){
    alert('날짜가 입력되어야합니다.');
    return false;
  }

  if(taxArray.length >= 1) {
    for (var i in taxArray) {
      if(taxArray[i][14]['입금구분']==='카드'){
        alert("입금구분이 '카드'이면 증빙 발행이 불가합니다.");
        return false;
      }

      if(taxArray[i][11]['세액']==='0'){
            alert("세액이 '0'원이면 증빙 발행이 불가합니다.");
            return false;
      }

      if(taxArray[i][15]['증빙일자']){
            alert("이미 증빙일자가 존재하므로 증빙 입력이 불가합니다.");
            return false;
      }
    }
  }

  var taxArrayTo = JSON.stringify(taxArray);

  goCategoryPage(taxArrayTo, taxSelect, taxDate);

  function goCategoryPage(a,b,c){
      var frm = formCreate('taxSave2', 'post', 'p_payScheduleTaxInput2.php','');
      frm = formInput(frm, 'taxArray', a);
      frm = formInput(frm, 'taxSelect', b);
      frm = formInput(frm, 'taxDate', c);
      formSubmit(frm);
  }
})
