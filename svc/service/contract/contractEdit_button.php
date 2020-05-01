<div class="jumbotron pt-3 pb-3 text-center border border-dark rounded">
  <a class="btn btn-dark btn-sm mr-1" href="contract.php" role="button"><i class="fas fa-angle-double-right"></i> 계약목록</a>
  <a class="btn btn-dark btn-sm mr-1" href="/service/account/deposit.php" role="button"><i class="fas fa-angle-double-right"></i> 보증금목록</a>
  <a href="contract_edit.php?id=<?=$filtered_id?>">
    <button name="contractEdit" class="btn btn-dark btn-sm mr-1">계약수정</button>
  </a>
  <button type="button" name="contractDelete" class="btn btn-dark btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="청구정보가 없어야 삭제가능합니다">삭제하기</button>
  <a class="btn btn-outline-dark btn-sm mr-1" href="contract_add2.php" role="button">계약등록</a>
  <a class="btn btn-outline-dark btn-sm mr-1" href="contractAll.php" role="button">일괄계약등록</a>
  <a class="btn btn-outline-dark btn-sm" href="contractCsv.php" role="button">csv계약등록</a>
</div>
