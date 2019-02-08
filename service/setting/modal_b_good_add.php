<div class="modal" tabindex="-1" role="dialog" id="modal_good_add<?=$escaped['id']?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">기타상품</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="mt-5">
        <p>임대계약 외에 일회성으로 발생하는 기타매출 상품명을 적으세요.</p>
      </div>
      <form class="container" action="p_good_add.php" method="post">
        <div class="form-row">
          <div class="container">
            <input type="hidden" name="buidling_id" value="<?=$escaped['id']?>">
            <input name="good" type="text" class="form-control" placeholder="예)회의실, 노트북 등" required="">
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
        <button type="submit" class="btn btn-primary">추가하기</button>
      </div>
    </form>
    </div>
  </div>
</div>
