<!-- <div class="jumbotron mb-2 pt-3 pb-3 text-center border border-dark rounded">
  <a class="btn btn-dark btn-sm mr-1" href="contract.php" role="button"><i class="fas fa-angle-double-right"></i> 계약목록</a>
  <a class="btn btn-dark btn-sm mr-1" href="/service/account/deposit.php" role="button"><i class="fas fa-angle-double-right"></i> 보증금목록</a>
  <a href="contract_edit.php?id=<?=$filtered_id?>">
    <button name="contractEdit" class="btn btn-dark btn-sm mr-1">계약수정</button>
  </a>
  <button type="button" name="contractDelete" class="btn btn-dark btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="청구정보가 없어야 삭제가능합니다">삭제하기</button>
  <a class="btn btn-outline-dark btn-sm mr-1" href="contract_add2.php" role="button">계약등록</a>
  <a class="btn btn-outline-dark btn-sm mr-1" href="contractAll.php" role="button">일괄계약등록</a>
  <a class="btn btn-outline-dark btn-sm" href="contractCsv.php" role="button">csv계약등록</a>
</div> -->
<div class="jumbotron row mb-2 pt-3 pb-3 border border-dark rounded">
  <div class="col col-md-3">
    <button type='button' class='btn btn-sm btn-outline-primary' data-toggle="modal" data-target="#smsModal1" id="smsBtn"><i class="far fa-envelope"></i> 보내기</button>
    <a href="/svc/service/sms/sent.php">
    <button class="btn btn-sm btn-dark" id="smsSettingBtn"><i class="fas fa-angle-double-right"></i> 보낸문자목록</button></a>
  </div>
  <div class="col col-md-9">
    <div class="row justify-content-end mr-0">
      <a class="btn btn-dark btn-sm mr-1" href="contract.php" role="button"><i class="fas fa-angle-double-right"></i> 계약목록(시작일)</a>
      <a class="btn btn-dark btn-sm mr-1" href="contract.php?dateDiv=endDate" role="button"><i class="fas fa-angle-double-right"></i> 계약목록(종료일)</a>
      <!-- <a class="btn btn-dark btn-sm mr-1" href="../account/deposit/deposit.php" role="button"><i class="fas fa-angle-double-right"></i> 보증금목록</a> -->
      <a href="contract_edit.php?id=<?=$filtered_id?>">
        <button name="contractEdit" class="btn btn-dark btn-sm mr-1">계약수정</button>
      </a>
      <button type="button" name="contractDelete" class="btn btn-dark btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="청구정보가 없어야 삭제가능합니다">삭제하기</button>
      <a class="btn btn-outline-dark btn-sm mr-1" href="contract_add2.php" role="button">계약등록</a>
      <a class="btn btn-outline-dark btn-sm mr-1 mobile" href="contractAll.php" role="button">일괄계약등록</a>
      <a class="btn btn-outline-dark btn-sm mobile" href="contractCsv.php" role="button">csv계약등록</a>
    </div>
  </div>
</div>
