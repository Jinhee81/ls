<div class="p-3 mb-2 text-dark border border-info rounded">
  <h5>메모</h5>
  <div class="form-row">
    <div class="col col-sm-2">
      <input type="text" class="form-control form-control-sm text-center" id="memoInputer" value="<?=$_SESSION['user_name']?>">
    </div>
    <div class="col col-sm-8">
      <input type="text" class="form-control form-control-sm text-center" id="memoContent" value="" placeholder="계약의 메모를 입력하세요.">
    </div>
    <div class="col col-sm-2">
      <button type="button" id="memoButton" class="btn btn-outline-secondary btn-sm btn-block">등록</button>
    </div>
  </div>
  <table class="table table-sm table-hover text-center mt-3">
    <tr class="table-secondary">
      <td style="width:5%" class="">순번</td>
      <td style="width:45%" class="">내용</td>
      <td style="width:40%" class="mobile">등록일시/수정일시</td>
      <td style="width:10%" class="">관리</td>
    </tr>
    <?php
    if(count($memoRows)===0){
      echo "<tr><td colspan='6'>등록된 메모가 없습니다.</td></tr>";
    } else {
      for ($i=0; $i < count($memoRows); $i++) { ?>
    <tr>
     <td class="">
       <label class="grey"><?=$memoRows[$i]['num']?></label>
       <input type="hidden" name="memoid" value="<?=$memoRows[$i]['idrealContract_memo']?>">
     </td>
     <td class=""><input class="form-control form-control-sm text-center" name="memoContent" value="<?=$memoRows[$i]['memoContent']?>" disabled></td>
     <td class="mobile"><small class="grey"><?=$memoRows[$i]['created']?>/<?=$memoRows[$i]['updated']?></small></td>
     <td class="">
       <button type="submit" name="memoEdit" class="btn btn-default grey">
         <i class='far fa-edit'></i>
       </button>
       <button type="submit" name="memoDelete" class="btn btn-default grey">
         <i class='far fa-trash-alt'></i>
       </button>
     </td>
    </tr>
<?php }
} ?>
  </table>
</div>
