<div class="form-row">
  <div class="form-group col-md-4">
    <label><span id='star' style='color:#F7BE81;'>* </span>성명</label>
    <input type='text' name='name' class='form-control' required value='<?=$row['name']?>'>
  </div>

  <div class="form-group col-md-5">
    <label><span id='star' style='color:#F7BE81;'>* </span>연락처</label>
    <div class='form-row'>
      <div class='form group col-md-4'>
        <input type='number' name='contact1' id='contact1' class='form-control' maxlength='3' required oninput='maxlengthCheck(this);' value='<?=$row['contact1']?>'>
      </div>
      <div class='form group col-md-4'>
        <input type='number' name='contact2' id='contact2' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);' value='<?=$row['contact2']?>'>
      </div>
      <div class='form group col-md-4'>
        <input type='number' name='contact3' id='contact3' class='form-control' maxlength='4' required oninput='maxlengthCheck(this);' value='<?=$row['contact3']?>'>
      </div>
    </div>
  </div>

  <div class="form-group col-md-3">
    <label>성별</label><br>
    <div class='form-check form-check-inline'>
      <input class='form-check-input' type='radio' name='gender' id='inlineRadio1' value='남'<?php if($row['gender']==='남'){echo "checked";}?>>
      <label class='form-check-label'>남</label>
    </div>
    <div class='form-check form-check-inline'>
      <input class='form-check-input' type='radio' name='gender' id='inlineRadio2' value='여'<?php if($row['gender']==='여'){echo "checked";}?>>
      <label class='form-check-label'>여</label>
    </div>
  </div>
</div>

<div class="form-row">
  <label>이메일</label>
  <input type="email" name="email" class="form-control" value='<?=$row['email']?>'>
</div>

<div class='form-group mt-3'>
  <div class='form-row'>
    <label>주소</label>
  </div>
  <div class='form-row'>
    <div class='form-group col-md-3'>
      <input type='text' id='sample2_postcode' placeholder='우편번호' class='form-control' disabled value='<?=$row['zipcode']?>'>
    </div>
    <div class='form-group col-md-3'>
      <input type='button' onclick='sample2_execDaumPostcode()' value='우편번호 찾기' class='btn btn-secondary'><br>
    </div>
  </div>
  <div class='form-row'>
    <div class='form-group col-md-6'>
      <input type='text' id='sample2_address' placeholder='주소' class='form-control' value='<?=$row['add1']?>'>
    </div>
    <div class='form-group col-md-6'>
      <input type='text' id='sample2_detailAddress' placeholder='상세주소' class='form-control' value='<?=$row['add2']?>'>
    </div>
  </div>
  <div class='form-row'>
    <div class='form-group col'>
      <input type='text' id='sample2_extraAddress' placeholder='참고항목' class='form-control' value='<?=$row['add3']?>'>
    </div>
  </div>
</div>


<!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
<div id='layer' style='display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;'>
<img src='//t1.daumcdn.net/postcode/resource/images/close.png' id='btnCloseLayer' style='cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1' onclick='closeDaumPostcode()' alt='닫기 버튼'>
</div>

<div class="form-row">
    <label>특이사항</label>
    <input type="text" name="etc" class="form-control" value='<?=$row['etc']?>'>
</div>

<div class="form-row mt-3">
  <div class="form-group col-md-2">
    <label>등록자명</label>
    <input type="text" class="form-control form-control-sm" name="" value="<?=$row[23]?>" disabled>
  </div>
  <div class="form-group col-md-4">
    <label>등록일시</label>
    <input type="text" class="form-control form-control-sm" name="" value="<?=$row['created']?>" disabled>
  </div>
  <div class="form-group col-md-2">
    <label>수정자명</label>
    <input type="text" class="form-control form-control-sm" name="" value="<?=$row[25]?>" disabled>
  </div>
  <div class="form-group col-md-4">
    <label>수정일시</label>
    <input type="text" class="form-control form-control-sm" name="" value="<?=$row['updated']?>" disabled>
  </div>
</div>
