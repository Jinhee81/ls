$('.modalAsk').on('click', function(){ //청구번호클릭하는거(모달클릭)

  var currow2 = $(this).closest('tr');
  var payNumber = currow2.find('td:eq(8)').children('input:eq(1)').val();
  // console.log(payNumber);
  var filtered_id = currow2.find('td:eq(8)').children('input:eq(0)').val();;
  // console.log(filtered_id);

    $.ajax({
      url: '/svc/service/contract/ajax_paySchedule2_payid.php',
      method: 'post',
      data: {payNumber : payNumber, filtered_id:filtered_id},
      success: function(data){
        $('.payid').html(data);
      }
    })

    $.ajax({
      url: '/svc/service/contract/ajax_paySchedule2_search.php',
      method: 'post',
      data: {payNumber : payNumber, filtered_id:filtered_id},
      success: function(data){
        $('.modal-body').html(data);
      }
    })

    $.ajax({
      url: 'ajax_paySchedule2_modalfooter2.php',
      method: 'post',
      data: {payNumber : payNumber, filtered_id:filtered_id},
      success: function(data){
        $('.modal-footer').html(data);
      }
    })
}) //

//===^청구번호클릭하는거(모달클릭) closing}^ ===============
