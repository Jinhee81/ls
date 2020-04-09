<div class="form-row">
    <div class="form-group col-md-2">
        <label><b>[물건정보]</b></label>
    </div>
    <div class="form-group col-md-10" id="mulgunInfo">
          <div class="form-row">
            <!-- <div class="form-group col-md-2">
                <label>공실구분</label>
                <select id="select1" name="" class="form-control" onchange="">
                  <option value="">전체</option>
                  <option value="" selected>공실</option>
                  <option value="">만실</option>
                </select>
            </div> -->
            <div class="form-group col-md-2"><!--물건목록-->
                <label>물건명</label>
                <select id="select2" name="building_id" class="form-control">
                </select>
            </div>
            <div class="form-group col-md-2"><!--그룹목록-->
                <label>그룹명</label>
                <select id="select3" name="group_id" class="form-control">
                </select>
            </div>
            <div class="form-group col-md-2"><!--관리번호목록-->
                <label>관리번호</label>
                <select id="select4" name="room_id" class="form-control" onchange="">
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>최초 계약일자</label>
                <input type="text" id="contractDate" class="form-control dateType yyyymmdd" name="contractDate" placeholder="">
            </div>
          </div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-2 mb-0">
        <label><b>[임대료정보]</b></label>
    </div>
    <div class="form-group col-md-10 mb-0">
      <div class="form-row">
          <div class="form-group col-md-2 mb-0">
                <label><span id='star' style='color:#F7BE81;'>* </span>공급가액</label>
                <input type="text" class="form-control text-right amountNumber" name="mAmount" value="0" numberOnly required>
          </div>
          <div class="form-group col-md-2 mb-0">
                <label>세액</label>
                <input type="text" class="form-control text-right amountNumber" name="mvAmount" value="0" numberOnly required>
          </div>
          <div class="form-group col-md-2 mb-0">
                <label>합계</label>
                <input type="text" class="form-control text-right amountNumber" name="mtAmount" placeholder="0" numberOnly readonly>
          </div>
          <div class="form-group col-md-1 mb-0"><!--선불,후불체크-->
                <label>수납</label>
                <select id="select5" name="payOrder" class="form-control">
                </select>
          </div>
          <div class="form-group col-md-1 mb-0">
                <label><span id='star' style='color:#F7BE81;'>* </span>기간</label>
                <input type="number" class="form-control" name="monthCount" placeholder="" min="1" max="72" required>
          </div>
          <div class="form-group col-md-2 mb-0">
                <label><span id='star' style='color:#F7BE81;'>* </span>시작일자</label>
                <input type="text" id="startDate" class="form-control dateType yyyymmdd" name="startDate" value="" placeholder="" required>
          </div>
          <div class="form-group col-md-2 mb-0">
                <label>종료일자</label>
                <input type="text" id="endDate" class="form-control" name="endDate" placeholder="" readonly>
          </div>
    </div>
  </div>
</div>
<div class="form-row">
    <div class="form-group col-md-2">
    </div>
    <div class="form-group col-md-10">
        <small class="form-text text-muted">매월 받아야하는 임대료(월세)를 입력합니다.</small>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-2 mb-0">
      <label><b>[보증금정보]</b></label>
    </div>
    <div class="form-group col-md-10 mb-0">
        <div class="form-row">
            <div class="form-group col-md-3 mb-0">
                <label>금액</label>
                <input type="text" class="form-control text-right amountNumber" name="depositInAmount" value="0" placeholder="0" numberOnly>
            </div>
            <div class="form-group col-md-3 mb-0">
                <label>입금일자</label>
                <input type="text" class="form-control dateType yyyymmdd" name="depositInDate" id="depositInDate" value="">
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-2">
    </div>
    <div class="form-group col-md-10">
        <small class="form-text text-muted">보증금을 받았다면, 보증금과 날짜를 입력하세요.</small>
    </div>
</div>
<div class="">
  <button type='submit' class='btn btn-primary'>저장</button>
  <a href='contract.php'><button type='button' class='btn btn-secondary'>계약목록 바로가기</button></a>
</div>
