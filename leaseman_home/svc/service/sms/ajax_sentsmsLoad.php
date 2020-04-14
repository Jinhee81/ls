<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
include "ajax_smsCondi.php";
?>

<?php if(count($allRows)===0){
   echo "조회값이 없습니다.";
 } else {?>
  <table class="table table-hover text-center mt-2 table-sm" id="checkboxTestTbl">
    <thead>
      <tr class="table-info">
        <th scope="col">순번</th>
        <th scope="col">유형</th>
        <th scope="col" class="mobile">바이트</th>
        <!-- <th scope="col">청구번호</th> -->
        <th scope="col" class="mobile">전송시간</th>
        <th scope="col" class="">받는사람</th>
        <th scope="col" class="mobile">연락처</th>
        <th scope="col">방번호</th>
        <th scope="col" class="mobile">문자내용</th>
        <th scope="col" class="mobile">전송결과</th>
      </tr>
    </thead>
    <tbody>

    <?php for ($i=0; $i < count($allRows); $i++) {?>
      <tr>
        <td><?=$allRows[$i]['num']?></td><!--순번-->
        <td>
          <?php
          if($allRows[$i]['type']==='sms'){
            echo '<div class="badge badge-primary text-wrap" style="width: 3rem;">단문</div>';
          } elseif($allRows[$i]['type']==='mms'){
            echo '<div class="badge badge-danger text-wrap" style="width: 3rem;">장문</div>';
          } else {
            echo $allRows[$i]['type'];
          }
           ?>
        </td><!--유형-->
        <td class="mobile">
          <label class="numberComma mb-0">
            <?=$allRows[$i]['byte']?>
          </label>
        </td><!--바이트-->
        <td class="mobile">
          <?=$allRows[$i]['sendtime']?>
        </td><!--전송시간-->
        <td>
          <?=$allRows[$i]['customer']?>
        </td><!--세입자명-->
        <td class="mobile">
            <?=$allRows[$i]['phonenumber']?>
            <input type="hidden" name="sentnumber" value="<?=$allRows[$i]['sentnumber']?>">
        </td><!--전화번호-->
        <td>
          <?=$allRows[$i]['roomNumber']?>
        </td><!--방번호-->
        <td class="mobile"><!--문자내용-->
          <label data-toggle="modal" data-target=".bd-example-modal-sm" class="descriptions green">
            <!-- <label data-toggle="modal" data-target="#descriptionModal" data-placement="top" title="<?=$allRows[$i]['description']?>" class="descriptions"> -->
            <u>
              <?=mb_substr($allRows[$i]['description'], 0, 10)?>
            </u>
          </label>
          <input type="hidden" value="<?=$allRows[$i]['description']?>">
          <!-- 모달시작 -->
          <div class="modal fade bd-example-modal-sm" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title">문자메시지</h6>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">

                </div>
                <div class="modal-footer">

              </div>
            </div>
          </div>
          <!-- 모달끝 -->
        </td><!--문자내용-->
        <td class="mobile">
          <?=$allRows[$i]['result']?>
        </td><!--전송결과-->
      </tr>
    <?php
  }
} ?>



<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button> -->



<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})


$('.descriptions').on('click', function(){

  var description = $(this).next().val();
  var reciever = $(this).parent().prev().prev().prev().text().trim();
  var recieveNumber = $(this).parent().prev().prev().text().trim();
  var sentNumber = $(this).parent().prev().prev().children().val();

  console.log(description, reciever, recieveNumber, sentNumber);

  $.ajax({
    url: 'ajax_modaldescription.php',
    method: 'post',
    data: {description:description,
           reciever:reciever,
           recieveNumber:recieveNumber,
           sentNumber:sentNumber},
    success: function(data){
      $('.modal-body').html(data);
    }
  })

})

</script>
