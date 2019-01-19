<!-- 모달 - 임대물건등록 모달 -->

<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">물건 추가</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="building_process.php" method="post">
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">형태</label>
            <div class="col-sm-9">
              <select name="lease_type" class="form-control" disabled="">
                <option disabled="disabled" value="공유오피스" <?php if($_SESSION['lease_type']=="공유오피스"){echo "selected";}?>>공유오피스</option>
                <option value="원룸" <?php if($_SESSION['lease_type']=="원룸"){echo "selected";}?>>원룸</option>
                <option value="빌딩" <?php if($_SESSION['lease_type']=="빌딩"){echo "selected";}?>>빌딩</option>
                <option value="고시원" <?php if($_SESSION['lease_type']=="고시원"){echo "selected";}?>>고시원</option>
                <option value="창고" <?php if($_SESSION['lease_type']=="창고"){echo "selected";}?>>창고</option>
                <option value="임대관리회사" <?php if($_SESSION['lease_type']=="임대관리회사"){echo "selected";}?>>임대관리회사</option>
                <option value="기타" <?php if($_SESSION['lease_type']=="기타"){echo "selected";}?>>기타</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">명칭</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" value="<?=$_SESSION['user_name']?>" required="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">수금방법</label>
            <div class="col-sm-9">
              <select name="pay" class="form-control">
                <option value="선불">선불</option>
                <option value="후불">후불</option>
              </select>
              <small class="form-text text-muted">
                임대료를 선불로 수납할 경우 선불 선택, 후불로 수납할경우 후불을 선택하세요.
              </small>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
        <button type="submit" class="btn btn-primary">저장</button>
      </div>
    </form>
    </div>
  </div>
</div> <!--modal div close tag-->
