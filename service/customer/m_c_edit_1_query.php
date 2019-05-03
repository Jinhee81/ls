<div class="form-row">
  <div class="form-group col-md-8">
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
  <div class="form-group col-md-4">
    <label>문의일자</label>
    <div class="form-row">
      <div class="form-group col-md-9">
        <input type="text" name="qDate" class="form-control" id="date1" value='<?=$row['qDate']?>'>
      </div>
      <div class="form-group col-md-3">
        <span><img src="/img/calendar.svg" id="date1"></span>
      </div>
    </div>
  </div>
</div>
<div class="form-row">
  <label><span id='star' style='color:#F7BE81;'>* </span>문의내용</label>
  <input type="text" name="etc" class="form-control" value='<?=$row['etc']?>' required>
</div>

<div class="form-row mt-3">
  <div class="form-group col-md-2">
    <label>등록자명</label>
    <input type="text" class="form-control" name="" value="<?=$_SESSION['damdangga_name']?>" disabled>
  </div>
  <div class="form-group col-md-4">
    <label>등록일시</label>
    <input type="text" class="form-control" name="" value="<?=$row['created']?>" disabled>
  </div>
  <div class="form-group col-md-2">
    <label>수정자명</label>
    <input type="text" class="form-control" name="" value="<?=$_SESSION['damdangga_name']?>" disabled>
  </div>
  <div class="form-group col-md-4">
    <label>수정일시</label>
    <input type="text" class="form-control" name="" value="<?=$row['updated']?>" disabled>
  </div>
</div>
