<!-- n개월추가 모달 시작  -->
<div class="modal fade bd-example-modal-sm" id="nAddBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">n개월 추가</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>추가개월수</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right" name="addMonth" value="" numberOnly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>공급가액</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right amountNumber grey" name="modalAmount1" value="<?=$row['mAmount']?>" numberOnly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>세액</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right amountNumber grey" name="modalAmount2" value="<?=$row['mvAmount']?>" numberOnly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>합계</label>
                </div>
                <div class="form-group col-md-7">
                    <input type="text" class="form-control form-control-sm text-right amountNumber grey" name="modalAmount3" value="<?=$row['mtAmount']?>" numberOnly required disabled>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary" id="button6">추가하기</button>
      </div>
    </div>
  </div>
</div>
<!-- n개월추가 모달 끝  -->
