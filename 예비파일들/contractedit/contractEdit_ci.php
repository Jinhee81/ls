<!-- customer_information의 약자로 파일명을 정함 -->

<div class="p-3 mb-2 text-dark border border-info rounded">
  <div class="">
    <form>
      <h3>임대계약 정보</h3>
      <div class="form-group row">
        <label class="col-sm-3">세입자</label>
        <div class="col-sm-9">
          <a href="/service/customer/m_c_edit.php?id=<?=$row[1]?>">
            <textarea name="name" rows="2" cols="80" class="form-control form-control-sm" disabled><?php if($row['etc']) {
              echo $cName.', '.$cContact.', ('.$row['etc'].')';
            } else {
              echo $cName.', '.$cContact;
            }?></textarea>
          </a>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3">물건</label>
        <div class="col-sm-9">
          <input type="text" class="form-control form-control-sm" value="<?=$row[11].','.$row[13].','.$row[15]?>" disabled>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3">
          기간
          <?php
            if(!($difference===0)) {
            echo "<span class='font-weight-light sky'>[최초 ".$row['monthCount']."개월, " .$row['startDate']."~".$row['endDate']."]</span>";
            }
          ?>
        </label>
        <div class="col-sm-9">
          <!-- <input type="text" class="form-control form-control-sm" value="<?=$row['count2'].'개월, '.$row['startDate'].'~'.$row['endDate2']?>" disabled> -->
          <textarea name="name" rows="2" cols="80" class="form-control form-control-sm" disabled><?=$row['count2'].'개월, '.$row['startDate'].'~'.$row['endDate2']?></textarea>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3">월이용료</label>
        <div class="col-sm-9">
          <input type="text" class="form-control form-control-sm" name="" value="공급가액 <?=$row['mAmount']?>원, 세액 <?=$row['mvAmount']?>원, 합계 <?=$row['mtAmount']?>원" disabled>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3">기타</label>
        <div class="col-sm-9">
          <input type="text" class="form-control form-control-sm" name="" value="최초 계약일 <?=$row['contractDate']?>, 수납구분 <?=$row['payOrder']?>" disabled>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3">상태</label>
        <div class="col-sm-9">
          <?php
          if($status==="현재"){
            echo '<div class="badge badge-info text-wrap mr-1" style="width: 3rem;">현재</div>';
          } elseif($status==="대기"){
            echo '<div class="badge badge-warning text-wrap mr-1" style="width: 3rem;">대기</div>';
          } elseif($status==="종료"){
            echo '<div class="badge badge-danger text-wrap mr-1" style="width: 3rem;">종료</div>';
          }

          if($step === "clear"){
            echo "<div class='badge badge-warning text-light' style='width: 3rem;'>clear</div>";
          } elseif($step === "청구"){
            echo "<div class='badge badge-warning text-primary' style='width: 3rem;'>청구</div>";
          } elseif($step === "입금"){
            echo "<div class='badge badge-warning text-info' style='width: 3rem;'>입금</div>";
          }
          ?>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3">보증금</label>
      </div>
    </form>
  </div>
</div>
