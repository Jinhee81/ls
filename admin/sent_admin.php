<?php
session_start();
if(!isset($_SESSION['ais_login'])){
  header('Location: /admin/main/alogin.php');
}
require('view/aconn.php');
require('view/admin_header.php');
?>

<header class="container text-center">
    <div class="jumbotron pt-2 pb-2">
        <h2>보낸문자 목록</h2>
    </div>
</header>

<section class="container">
    <div class="row ml-0">
        <label for=""> 총 <span id="countall"></span>건</label>
    </div>
</section>

<!-- 표 섹션 -->
<section class="container">
    <div class="mainTable">
        <table class="table table-hover table-bordered table-sm text-center" id="checkboxTestTbl">
            <thead>
                <tr class="table-secondary">
                    <th class="fixedHeader">순번</th>
                    <th class="fixedHeader mobile">유형</th>
                    <th class="fixedHeader mobile">구분</th>
                    <th class="fixedHeader">전송시간</th>
                    <th class="fixedHeader">수신자</th>
                    <th class="fixedHeader">수신번호</th>
                    <th class="fixedHeader mobile">발신번호</th>
                    <th class="fixedHeader">문자내용</th>
                    <th class="fixedHeader">전송결과</th>
                </tr>
            </thead>
            <tbody id="allVals">

            </tbody>
        </table>
    </div>
</section>

<!-- 페이지 -->
<section class="container mt-2" id="page">

</section>

<section id="allVals2" class="container">

</section>

<?php 
include "modal/modal_description.php"; 
require('view/footer.php');
?>



<script src="/admin/inc/js/jquery-3.3.1.min.js"></script>
<script src="/admin/inc/js/jquery-ui.min.js"></script>
<script src="/admin/inc/js/bootstrap.min.js"></script>
<script src="/admin/inc/js/etc/form.js"></script>
<script src="/admin/inc/js/datepicker-ko.js?<?=date('YmdHis')?>"></script>
<script src="/svc/inc/js/jquery-ui-timepicker-addon.js"></script>
<script src="/svc/inc/js/etc/newdate8.js?<?=date('YmdHis')?>"></script>
<script src="/admin/inc/js/etc/sms_noneparase.js?<?=date('YmdHis')?>"></script>
<script src="/admin/inc/js/etc/sms_array.js?<?=date('YmdHis')?>"></script>

<script>
function maketable(x, y) {
    var form = $('form').serialize();
    var mtable = $.ajax({
        url: 'ajax/ajax_sentsms_admin.php',
        method: 'post',
        data: {
            'form': form,
            'pagerow': x,
            'getPage': y
        },
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);
            datacount = data.length;

            var returns = '';
            var countall;

            $('#allVals').html(returns);
            $('#countall').text(countall);
            var totalpage = Math.ceil(Number(countall) / Number(x));

            var totalpageArray = [];

            for (var i = 1; i <= totalpage; i++) {
                totalpageArray.push(i);
            }

            var paging =
                '<nav aria-label="..."><ul class="pagination pagination-sm justify-content-center">';

            for (var i = 1; i <= totalpageArray.length; i++) {
                paging += '<li class="page-item"><a class="page-link">' + i + '</a></li>';
            }

            paging += '</ul></nav>';

            $('#page').html(paging);
        }
    })

    return mtable;
}

function sql(x, y) {
    var form = $('form').serialize();
    var msqlajax = $.ajax({
        url: 'ajax/ajax_sentsms_sql.php',
        method: 'post',
        data: {
            'form': form,
            'pagerow': x,
            'getPage': y
        },
        success: function(data) {
            $('#allVals2').html(data);
        }
    });
    return msqlajax;
}

let pagerow = 50;
let getPage = 1;


$(document).ready(function() {

    var periodDiv = $('select[name=periodDiv]').val();
    dateinput2(periodDiv);

    // var pagerow = 50;
    // var getPage = 1;

    maketable(pagerow, getPage);
    sql(pagerow, getPage);


    $('.dateType').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        currentText: '오늘',
        closeText: '닫기'
    })

    $(document).on('click', '.page-link', function() {
        // $(this).parent('li').attr('class','active');
        var pagerow = 50;
        var getPage = $(this).text();
        console.log(getPage);
        maketable(pagerow, getPage);
        sql(pagerow, getPage);
    })


    $(document).on('click', '.modalDescription', function() {
        // console.log($(this).text());

        var currow2 = $(this).closest('tr');

        var description = currow2.find('td:eq(7)').children('input[name=description]').val();

        var customer = currow2.find('td:eq(4)').children('label').text();
        var recievenumber = currow2.find('td:eq(5)').text();
        var sentnumber = currow2.find('td:eq(6)').text();
        var byte = currow2.find('td:eq(3)').children('input[name=byte]').val();

        console.log(description, customer, recievenumber, sentnumber);

        $('#modaltextarea').text(description);
        $('#mcustomer').val(customer);
        $('#recievenumber').val(recievenumber);
        $('#sentnumber').val(sentnumber);
        $('#mbyte').val(byte);

    })


}) //---------document.ready end and 조회버튼클릭 펑션 시작--------------//

$('select[name=dateDiv]').on('change', function() {
    var pagerow = 50;
    var getPage = 1;
    maketable(pagerow, getPage);
    sql(pagerow, getPage);
})

$('select[name=periodDiv]').on('change', function() {
    var periodDiv = $('select[name=periodDiv]').val();
    // console.log(periodDiv);
    dateinput2(periodDiv);
    var pagerow = 50;
    var getPage = 1;
    maketable(pagerow, getPage);
    sql(pagerow, getPage);
})

$('input[name=fromDate]').on('change', function() {
    var pagerow = 50;
    var getPage = 1;
    maketable(pagerow, getPage);
    sql(pagerow, getPage);
})

$('input[name=toDate]').on('change', function() {
    var pagerow = 50;
    var getPage = 1;
    maketable(pagerow, getPage);
    sql(pagerow, getPage);
})

$('select[name=div1]').on('change', function() {
    var pagerow = 50;
    var getPage = 1;
    maketable(pagerow, getPage);
    sql(pagerow, getPage);
})

$('select[name=type]').on('change', function() {
    var pagerow = 50;
    var getPage = 1;
    maketable(pagerow, getPage);
    sql(pagerow, getPage);
})

$('select[name=result]').on('change', function() {
    var pagerow = 50;
    var getPage = 1;
    maketable(pagerow, getPage);
    sql(pagerow, getPage);
})

$('select[name=etcCondi]').on('change', function() {
    var pagerow = 50;
    var getPage = 1;
    maketable(pagerow, getPage);
    sql(pagerow, getPage);
})

$('input[name=cText]').on('keyup', function() {
    var pagerow = 50;
    var getPage = 1;
    maketable(pagerow, getPage);
    sql(pagerow, getPage);
})
//---------조회버튼클릭평션 end and contractArray 펑션 시작--------------//
</script>

</body>

</html>