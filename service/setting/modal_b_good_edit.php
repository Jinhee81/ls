<div class="modal" tabindex="-1" role="dialog" id="modal_good_edit<?=$row['id']?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="container mt-3" action="p_good_edit.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title">기타상품</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="container">
            <input type="hidden" name="building_id" value="<?=$escaped['id']?>">
            <input type="hidden" name="id" value="<?=$row['id']?>">
            <input name="good" type="text" class="form-control" value="<?=$row['name']?>">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
        <button type="submit" class="btn btn-secondary" value="delete" onclick="javascript: form.action='p_good_delete.php';">삭제</button>
        <button type="submit" class="btn btn-primary">수정하기</button>
      </div>
      </form>
    </div> <!--modal content 닫는 div -->
  </div> <!--modal dialog 닫는 div -->
</div> <!--modal 닫는 div -->
