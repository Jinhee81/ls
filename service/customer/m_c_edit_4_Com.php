
<div class='form-row'>
  <div class='form-group col-md-4'>
    <label>구분</label><br>
    <select name='div3' class='form-control'>
      <option value='주식회사' <?php if($row['div3']==='주식회사'){echo "selected";}?>>주식회사</option>
      <option value='유한회사' <?php if($row['div3']==='유한회사'){echo "selected";}?>>유한회사</option>
      <option value='합자회사' <?php if($row['div3']==='합자회사'){echo "selected";}?>>합자회사</option>
      <option value='기타' <?php if($row['div3']==='기타'){echo "selected";}?>>기타</option>
    </select>
  </div>
  <div class='form-group col-md-4'>
    <label><span id='star' style='color:#F7BE81;'>* </span>사업자명</label>
    <input type='text' name='companyname' class='form-control' maxlength='14' value='<?=$row['companyname']?>'>
  </div>
  <div class='form-group col-md-4'>
    <label>대표자명</label><input type='text' name='name' class='form-control' maxlength='9' value='<?=$row['name']?>'>
  </div>
</div>

<div class='form-row'>
  <div class='form-group col-md-5'>
    <label>사업자번호</label><br>
    <div class='form-row'>
      <div class='form group col-md-4'>
        <input type='number' name='cNumber1' class='form-control' maxlength='3' oninput='maxlengthCheck(this);' value='<?=$row['cNumber1']?>'>
      </div>
      <div class='form group col-md-3'>
        <input type='number' name='cNumber2' class='form-control' maxlength='2' oninput='maxlengthCheck(this);' value='<?=$row['cNumber2']?>'>
      </div>
      <div class='form group col-md-5'>
        <input type='number' name='cNumber3' class='form-control' maxlength='5' oninput='maxlengthCheck(this);' value='<?=$row['cNumber3']?>'>
      </div>
    </div>
  </div>
  <div class='form-group col-md-3'>
    <label>업태</label>
    <input type='text' name='div4' class='form-control' maxlength='9' value='<?=$row['div4']?>'>
  </div>
  <div class='form-group col-md-4'>
    <label>종목</label>
    <input type='text' name='div5' class='form-control' maxlength='14' value='<?=$row['div5']?>'>
  </div>
</div>

<div class='form-row'>
  <div class='form-group col-md-6'>
    <label><span id='star' style='color:#F7BE81;'>* </span>연락처</label>
    <div class='form-row'>
      <div class='form group col-md-4'><input type='number' name='contact1' id='contact1' class='form-control' maxlength='3' required oninput='maxlengthCheck(this);' value='<?=$row['contact1']?>'>
      </div>
    <div class='form group col-md-4'>
      <input type='number' name='contact2' id='contact2' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);' value='<?=$row['contact2']?>'>
    </div>
    <div class='form group col-md-4'>
      <input type='number' name='contact3' id='contact3' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);' value='<?=$row['contact3']?>'>
    </div>
  </div>
  </div>
  <div class='form-group col-md-6'>
    <label>이메일</label>
    <input type='email' name='email' class='form-control' maxlength='40' value='<?=$row['email']?>'>
  </div>
</div>

<div class='form-group'>
  <div class='form-row'>
    <label>주소</label>
  </div>
  <div class='form-row'>
    <div class='form-group col-md-3'>
      <input type='text' id='sample2_postcode' class='form-control' value='<?=$row['zipcode']?>' disabled>
      <input type='hidden' id='sample2_postcode_hidden' name="postcode">
    </div>
    <div class='form-group col-md-3'>
      <input type='button' onclick='sample2_execDaumPostcode();' value='우편번호 찾기' class='btn btn-secondary'><br>
    </div>
  </div>
  <div class='form-row'>
    <div class='form-group col-md-6'>
      <input type='text' name="add1" id='sample2_address' placeholder='주소' class='form-control' value='<?=$row['add1']?>'>
    </div>
    <div class='form-group col-md-6'>
      <input type='text' name="add2" id='sample2_detailAddress' placeholder='상세주소' class='form-control' value='<?=$row['add2']?>'>
    </div>
  </div>
  <div class='form-row'>
    <div class='form-group col'>
      <input type='text' name="add3" id='sample2_extraAddress' placeholder='참고항목' class='form-control' value='<?=$row['add3']?>'>
    </div>
  </div>
</div>
<!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
<div id='layer' style='display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;'>
<img src='//t1.daumcdn.net/postcode/resource/images/close.png' id='btnCloseLayer' style='cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1' onclick='closeDaumPostcode()' alt='닫기 버튼'>
</div>

<div class="form-row">
  <!-- <div class="form-group col"> -->
    <label>특이사항</label>
    <input type="text" name="etc" class="form-control" value='<?=$row['etc']?>'>
  <!-- </div> -->
</div>


<div class="form-row mt-3">
  <div class="form-group col-md-2">
    <label>등록자명</label>
    <input type="text" class="form-control form-control-sm" name="" value="<?=$row[25]?>" disabled>
  </div>
  <div class="form-group col-md-4">
    <label>등록일시</label>
    <input type="text" class="form-control form-control-sm" name="" value="<?=$row['created']?>" disabled>
  </div>
  <div class="form-group col-md-2">
    <label>수정자명</label>
    <input type="text" class="form-control form-control-sm" name="" value="<?=$row[27]?>" disabled>
  </div>
  <div class="form-group col-md-4">
    <label>수정일시</label>
    <input type="text" class="form-control form-control-sm" name="" value="<?=$row['updated']?>" disabled>
  </div>
</div>

<script src="/js/daumAddressAPI.js?v=<%=System.currentTimeMillis() %>"></script>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
