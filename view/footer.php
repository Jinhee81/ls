<hr>
<footer class="container text-right">
    (주)장기렌터카연합, 1522-7107<br>
    <p class=""><a href="https://www.klassauto.com" class="" target='_blank'>클라스오토 바로가기</a> | <a
            href="http://www.rentcarmanager.com/?skiping=skip" class="" target='_blank'>장기렌터카연합 바로가기</a> | <a
            href="https://klassauto.daouoffice.com/login" class="" target='_blank'>그룹웨어 바로가기</a></p>
</footer>


<!-- <script src="/inc/js/jquery-3.3.1.min.js"></script>
<script src="/inc/js/jquery-ui.min.js"></script>
<script src="/inc/js/popper.min.js"></script>
<script src="/inc/js/bootstrap-4.1.3.min.js"></script>
<script src="/inc/js/datepicker-ko.js"></script>
<script src="/inc/js/date.format.min.js"></script>
<script src="/inc/js/jquery.number.min.js"></script>
<script src="/inc/js/etc/form.js"></script> -->

<script class="">
$(document).ready(function() {
    $('.dateType').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        currentText: '오늘',
        closeText: '닫기'
    })

    $('.numberComma').number(true);

    // $('.dropdown-toggle').dropdown('toggle');
})

$(document).on('click', '.numberComma', function() {
    $(this).select();
})

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>