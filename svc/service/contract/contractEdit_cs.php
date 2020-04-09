<!-- cs는 charge Schedule (청구스케줄)의 약자 파일 -->
<div class="p-3 mb-2 text-dark border border-info rounded">
  <!-- <div class="d-flex justify-content-center bd-highlight mb-3"> -->
  <!-- <div class="form-row">
    <div class="form-group col-md-4">
      <button type="button" id="button5" class="btn btn-outline-info btn-sm mobile">1개월 추가</button>
      <button type="button" class="btn btn-outline-info btn-sm mobile" data-toggle="modal" data-target="#nAddBtn">n개월 추가</button>
      <button type="button" id="button7" class="btn btn-outline-info btn-sm mobile">삭제</button>
    </div>
    <div class="form-group col-md-4">
      <div class="form-row">
        <div class="form-group col-md-4">
          <input type="text" class="form-control form-control-sm dateType text-center" name="" value="" placeholder="입금예정일변경" id="groupExpecteDay" data-toggle="tooltip" data-placement="left" title="체크된것의 입금예정일을 변경합니다">
        </div>
        <div class="form-group col-md-4">
          <select class="form-control form-control-sm" id="paykind">
            <option value="계좌">계좌</option>
            <option value="현금">현금</option>
            <option value="카드">카드</option>
          </select>
        </div>
      </div>
    </div>
    <div class="form-group col-md-4">
      <button type="button" id="button1" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="체크된것을 청구설정합니다">청구설정</button>
      <button type="button" id="button2" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="체크된것의 청구정보를 취소합니다">청구취소</button>
      <button type="button" id="button3" class="btn btn-outline-info btn-sm mobile" data-toggle="tooltip" data-placement="top" title="체크된것들을 입금처리합니다(청구번호가있어야 입금처리 가능해요.)">일괄입금</button>
      <button type="button" id="button4" class="btn btn-outline-info btn-sm mobile" data-toggle="tooltip" data-placement="top" title="체크된것의 입금내역을 취소합니다">일괄입금취소</button>
      <button type="button" id="button8" class="btn btn-outline-danger btn-sm mobile">입금완료보이기</button>
    </div>
  </div>  -->

  <div class="form-row">
    <div class="form-group col-md-6">
      <table>
        <tr>
          <td width="8%"><button type="button" id="button5" class="btn btn-outline-info btn-sm mobile btn-block">1개월 추가</button></td>
          <td width="8%"><button type="button" class="btn btn-outline-info btn-sm mobile btn-block" data-toggle="modal" data-target="#nAddBtn">n개월 추가</button></td>
          <td width="6%"><button type="button" id="button7" class="btn btn-outline-info btn-sm mobile btn-block">삭제</button></td>
          <td width="6%"></td>
          <td width="10%"><input type="text" class="form-control form-control-sm dateType text-center" name="" value="" placeholder="입금예정일변경" id="groupExpecteDay" data-toggle="tooltip" data-placement="left" title="체크된것의 입금예정일을 변경합니다"></td>
          <td width="6%"><select class="form-control form-control-sm" id="paykind">
            <option value="계좌">계좌</option>
            <option value="현금">현금</option>
            <option value="카드">카드</option>
          </select></td>
        </tr>
      </table>
    </div>

    <div class="form-group col-md-6">
      <div class="row justify-content-end mr-0">
        <button type="button" id="button1" class="btn btn-outline-info btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="체크된것을 청구설정합니다">청구설정</button>
        <button type="button" id="button2" class="btn btn-outline-info btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="체크된것의 청구정보를 취소합니다">청구취소</button>
        <button type="button" id="button3" class="btn btn-outline-info btn-sm mobile mr-1" data-toggle="tooltip" data-placement="top" title="체크된것들을 입금처리합니다(청구번호가있어야 입금처리 가능해요.)">일괄입금</button>
        <button type="button" id="button4" class="btn btn-outline-info btn-sm mobile mr-1" data-toggle="tooltip" data-placement="top" title="체크된것의 입금내역을 취소합니다">일괄입금취소</button>
        <button type="button" id="button8" class="btn btn-outline-danger btn-sm mobile">입금완료보이기</button>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-sm table-hover text-center" style="width:100%" cellspacing="0" id="checkboxTestTbl">
      <thead>
        <tr class="table-info">
          <td scope="col" class=""><input type="checkbox" id="checkAll"></td>
          <td scope="col">순번</td>
          <td scope="col">시작일/종료일</td>
          <!-- <td scope="col">종료일</td> -->
          <td scope="col">공급가액/세액</td>
          <!-- <td scope="col" class="mobile">세액</td> -->
          <td scope="col" class="">합계</td>
          <td scope="col">입금예정일</td>
          <td scope="col" class="">입금구분</td>
          <td scope="col" class="">청구번호</td>
          <td scope="col" class="">수납구분</td>
          <td scope="col">입금일</td>
          <td scope="col" class="">입금(미납)액</td>
          <td scope="col" class="">연체일수/이자</td>
          <!-- <td scope="col" class="">연체이자</td> -->
          <td scope="col" class="mobile">증빙</td>
        </tr>
      </thead>
      <tbody id="schedule">
        <?php
        for ($i=0; $i < count($allRows); $i++) { ?>
        <tr>
          <td><input type='checkbox' class='checkSelect' name='chk[]' value='<?=$allRows[$i]['idcontractSchedule']?>'></td><!-- 체크박스 -->
          <td><label class="font-weight-light"><?=$allRows[$i]['ordered']?></label></td><!-- 순번 -->
          <td><label class="font-weight-light mb-0"><?=$allRows[$i]['mStartDate']?></label><br>
          <label class="font-weight-light mb-0"><?=$allRows[$i]['mEndDate']?></label></td><!-- 시작일/종료일 -->
          <td>
            <?php
            if($allRows[$i]['payId']){
              echo "<label class='text-right font-weight-light numberComma mb-0'>".$allRows[$i]['mMamount']."</label><br><label class='text-right font-weight-light numberComma mb-0'>".$allRows[$i]['mVmAmount']."</label>";
              // echo "exists";
            } else {
              echo "<input type='text' size='10' class='form-control form-control-sm text-right amountNumber mb-0' name='mAmount' value='".$allRows[$i]['mMamount']."' numberOnly><input type='text' size='10' class='form-control form-control-sm text-right amountNumber mb-0' name='mAmount' value='".$allRows[$i]['mVmAmount']."' numberOnly>";
            }
             ?>
          </td><!-- 공급가액/세액 -->
          <td>
            <?php
            if($allRows[$i]['payId']){
              echo "<label class='text-right font-weight-light numberComma'>".$allRows[$i]['mTmAmount']."</label>";
              // echo "exists";
            } else {
              echo "<input type='text' size='10' class='form-control form-control-sm text-right amountNumber' name='mAmount' value='".$allRows[$i]['mTmAmount']."' numberOnly>";
            }
            ?>
          </td><!-- 합계 -->
          <td>
            <?php
            if($allRows[$i]['payId']){
              echo "<label class='text-center font-weight-light'>".$allRows[$i]['paySchedule2']['pExpectedDate']."</label>";
              // echo "exists";
            } else {
              echo "<input type='text' size='10' class='form-control form-control-sm text-center dateType' name='expecteDay' value='".$allRows[$i]['mExpectedDate']."'>";
            }
            ?>
          </td><!-- 예정일 -->
          <td>
            <?php
            if($allRows[$i]['payId']){
              echo "<label class='text-center'>".$allRows[$i]['paySchedule2']['payKind']."</label>";
            }
            ?>
          </td><!-- 구분 -->
          <td>
            <?php
            if($allRows[$i]['payId'] && $allRows[$i]['payIdOrder']==='0'){
              echo "<label class='text-primary modalAsk font-weight-light' data-toggle='modal' data-target='#pPay'><u>".$allRows[$i]['payId']."</u></label>";
            }
            ?>
          </td><!-- 청구번호 -->
          <td>
            <?php
            if($allRows[$i]['payId'] && $allRows[$i]['payIdOrder']==='0'){

              $executiveDate = new DateTime($allRows[$i]['paySchedule2']['executiveDate']);
              $expectedDate = new DateTime($allRows[$i]['paySchedule2']['pExpectedDate']);
              $currentDateDate = new DateTime($currentDate);

              if($allRows[$i]['paySchedule2']['executiveDate']) {
                  $notGetDayCount = date_diff($executiveDate, $expectedDate);
                  // $notGetDayCount = ($executiveDate - $expectedDate);
                  // var_dump($notGetDayCount->invert);
                  if(($notGetDayCount->invert) === 1) {
                    echo "<label class='text-center green'>완납(연체)</label>";
                  } else {
                    echo "<label class='text-center green'>완납</label>";
                  }
              } else {
                // $notGetDayCount = ($currentDateDate - $expectedDate);
                $notGetDayCount = date_diff($currentDateDate, $expectedDate);
                // var_dump($notGetDayCount->invert);
                if(($notGetDayCount->invert) === 1) {
                  echo "<label class='text-center pink'>미납</label>";
                } else {
                  echo "<label class='text-center sky'>입금대기</label>";
                }
              }
            }
            ?>
          </td><!-- 수납구분 -->
          <td>
            <?php
            if($allRows[$i]['payId']){
              echo "<label class='text-center font-weight-light green'>".$allRows[$i]['paySchedule2']['executiveDate']."</label>";
            }?>
          </td><!-- 입금일 -->
          <td>
            <?php
            if($allRows[$i]['payId'] && $allRows[$i]['payIdOrder']==='0'){
              if($allRows[$i]['paySchedule2']['executiveDate']) {
                echo "<label class='text-center numberComma font-weight-light green'>".$allRows[$i]['paySchedule2']['getAmount']."</label>";
              } else {
                if($row3['pExpectedDate'] >= $currentDate){
                  echo "<label class='text-center numberComma font-weight-light sky'>"."&#40;".$allRows[$i]['ptAmount'].")"."</label>";
                } else {
                  echo "<label class='text-center numberComma font-weight-light pink'>"."&#40;".$allRows[$i]['ptAmount'].")"."</label>";
                }
              }
            }
             ?>
          </td><!-- 입금액 -->
          <td>
            <?php
            if($allRows[$i]['payId'] && $allRows[$i]['payIdOrder']==='0'){
              if($allRows[$i]['paySchedule2']['executiveDate']) {
                if($allRows[$i]['paySchedule2']['executiveDate'] <= $allRows[$i]['paySchedule2']['pExpectedDate']) {
                  echo "<label class='text-center font-weight-light green mb-0'>0</label><br>";
                } else {
                  $notGetDayCount = date_diff($executiveDate, $expectedDate);
                  echo "<label class='text-center numberComma font-weight-light green mb-0'>";echo $notGetDayCount->days."</label><br>";
                }
              } else {
                if($allRows[$i]['paySchedule2']['pExpectedDate'] >= $currentDate) {
                  echo "<label class='text-center font-weight-light sky mb-0'>0</label><br>";
                } else {
                  $notGetDayCount = date_diff($currentDateDate, $expectedDate);
                  echo "<label class='text-center numberComma font-weight-light pink mb-0'>";echo $notGetDayCount->days."</label><br>";
                }
              }
            }
            ?><!--연체일수-->
            <?php
            if($allRows[$i]['payId'] && $allRows[$i]['payIdOrder']==='0'){
              if($allRows[$i]['paySchedule2']['executiveDate']) {
                if($allRows[$i]['paySchedule2']['executiveDate'] <= $allRows[$i]['paySchedule2']['pExpectedDate']) {
                  echo "<label class='text-center font-weight-light green mb-0'>0</label>";
                } else {
                  $notGetDayCountAmount = $allRows[$i]['paySchedule2']['ptAmount'] * ($notGetDayCount->days / 365) * 0.27;
                  echo "<label class='text-center numberComma font-weight-light green mb-0'>".(int)$notGetDayCountAmount."</label>";
                }
              } else {
                if($allRows[$i]['paySchedule2']['pExpectedDate'] >= $currentDate) {
                  echo "<label class='text-center font-weight-light sky mb-0'>0</label>";
                } else {
                  $notGetDayCountAmount = $allRows[$i]['paySchedule2']['ptAmount'] * ($notGetDayCount->days / 365) * 0.27;
                  echo "<label class='text-center numberComma font-weight-light pink mb-0'>".(int)$notGetDayCountAmount."</label>";
                }
              }
            }
            ?><!--연체이자-->
          </td><!-- 연체일수/이자 -->
          <td></td><!-- 증빙 -->
        </tr>
        <?php
        }
         ?>
      </tbody>
    </table>
  </div>
</div>
