<div class="p-3 mb-2 text-dark border border-info rounded">
  <h5>보증금 현황<span>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info btn-sm" name="depositSaveBtn">저장</button></span></h5>
       <!-- <div class="form-row d-flex justify-content-center">
           <div class="form-group col-md-2">
             <p class="mb-0 text-center">입금일</p><br>
             <input type="text" name="depositInDate" class="form-control form-control-sm dateType text-center" value="<?=$row_deposit['inDate']?>">
           </div>
           <div class="form-group col-md-2">
             <p class="mb-0 text-center">입금액</p><br>
             <input type="text" name ="depositInAmount" class="form-control form-control-sm amountNumber text-center" value="<?=$row_deposit['inMoney']?>" numberOnly>
           </div>
           <div class="form-group col-md-2">
             <p class="mb-0 text-center">출금일</p><br>
             <input type="text" name="depositOutDate" class="form-control form-control-sm dateType text-center" value="<?=$row_deposit['outDate']?>">
           </div>
           <div class="form-group col-md-2">
             <p class="mb-0 text-center">출금액</p><br>
             <input type="text" name="depositOutAmount" class="form-control form-control-sm amountNumber text-center" value="<?=$row_deposit['outMoney']?>" numberOnly>
           </div>
           <div class="form-group col-md-2">
             <p class="mb-0 text-center">잔액</p><br>
             <input type="text" name="depositMoney" class="form-control form-control-sm amountNumber text-center green" value="<?=$row_deposit['remainMoney']?>" disabled numberOnly>
           </div>
           <div class="form-group col-md-2">
             <p class="mb-0 text-center">저장일시</p><br>
             <input type="text" class="form-control form-control-sm text-center" value="<?=$row_deposit['saved']?>" disabled>
           </div>
       </div> -->
  <table class="table table-sm table-hover text-center mt-3">
    <tr class="table-secondary">
      <td width="12%">입금일</td>
      <td width="12%">입금액</td>
      <td width="12%">출금일</td>
      <td width="12%">출금액</td>
      <td width="12%">잔액</td>
      <td width="20%">저장일시</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="depositInDate" class="form-control form-control-sm dateType text-center" value="<?=$row_deposit['inDate']?>">
      </td>
      <td>
        <input type="text" name="depositInAmount" class="form-control form-control-sm amountNumber text-center" value="<?=$row_deposit['inMoney']?>" numberOnly>
      </td>
      <td>
        <input type="text" name="depositOutDate" class="form-control form-control-sm dateType text-center" value="<?=$row_deposit['outDate']?>">
      </td>
      <td>
        <input type="text" name="depositOutAmount" class="form-control form-control-sm amountNumber text-center" value="<?=$row_deposit['outMoney']?>" numberOnly>
      </td>
      <td>
        <input type="text" name="depositOutAmount" class="form-control form-control-sm amountNumber text-center" value="<?=$row_deposit['remainMoney']?>" numberOnly disabled>
      </td>
      <td><?=$row_deposit['saved']?></td>
    </tr>
  </table>
</div>
