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
        <h2>회원리스트</h2>
    </div>
</header>

<section class="container">
    <div class="row">
        <div class="col">
            <div class="row pl-3">
                <button class="btn btn-sm btn-block btn-outline-primary mr-1" id="smsBtn" data-toggle="modal"
                    data-target="#smsModal1" style="width:100px;">
                    <i class="far fa-envelope"></i> 보내기
                </button>
                <a href="sent_admin.php">
                    <button class="btn btn-sm btn-block btn-dark" id="smsSettingBtn" style="width:120px;">
                        <i class=" fas fa-angle-double-right"></i> 보낸문자목록</button>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="row justify-content-end mr-0 mb-3">
                <input type="text" name="expandDate" id="expandDate" placeholder="날짜선택"
                    class="form-control form-control-sm dateType text-center mr-1" style="width:100px">
                <button type="button" class="btn btn-sm btn-primary mr-1" id="btnExpand">등급연장</button>
                <button type="button" class="btn btn-sm btn-danger mr-1" id="rowDeleteBtn">선택삭제</button>
            </div>

        </div>

    </div>
    <table class="table table-hover table-bordered table-sm text-center" id="outsideTable">
        <thead class="">
            <tr class="table-secondary">
                <th></th>
                <th>순번</th>
                <th>회원번호</th>
                <th width="15%">이메일</th>
                <th width="25%">유형(회원명,담당자명)</th>
                <th>연락처</th>
                <th>가입경로</th>
                <th>가입일시</th>
                <th>등급</th>
                <th>등급종료일</th>
                <th>건물수</th>
            </tr>
        </thead>
        <tbody class="" id=userlist>
        </tbody>
    </table>
</section>

<?php 
require('view/footer.php');
include $_SERVER['DOCUMENT_ROOT']."/svc/service/sms/modal_sms1.php";
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
$('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    currentText: '오늘',
    closeText: '닫기'
})

$.ajax({
    url: 'ajax/ajax_userlist.php',
    success: function(data) {
        data = JSON.parse(data);
        console.log(data);
        let returns = '';

        $.each(data, function(key, value) {
            returns += `<tr>
            <td class=><input type=checkbox value=${value.id2} name=userid class=tbodycheckbox></td>
            <td name=order>${value.num}</td>
            <td name=id><a href=user_detail.php?id=${value.id2}>${value.id2}</a></td>
            <td name=email><span name=email>${value.email}</span><br><span class=fontshade>${value.password}</span></td>
            <td name=user><span name=lease_type>${value.lease_type}</span>(<span name=user_div>${value.user_div}</span>,<span name=user_name>${value.user_name}</span>,<span name=manager_name>${value.manager_name}</span>)</td>
            <td name=cellphone>${value.cellphone2}<input type=hidden name=cellphone value=${value.cellphone}></td>
            <td name=regist_channel>${value.regist_channel}</td>
            <td name=created>${value.created2}</td>
            <td class="" name="grade">${value.gradename2}</td>
            <td name=enddate>${value.grade_enddate2}</td>
            <td name=building_count>${value.building_count}</td>
            </tr>`;
        })
        $('#userlist').html(returns);
    }
})

let userArray = [];

$(document).on('change', '.tbodycheckbox', function() {
    let userArrayEle = [];

    if ($(this).is(":checked")) {
        let currow = $(this).closest('tr');
        let colOrder = Number(currow.find('td:eq(1)').text());
        let colid = currow.find('td:eq(0)').children('input').val();
        let grade = currow.find('td[name=grade]').text();
        userArrayEle.push(colOrder, colid, grade);
        userArray.push(userArrayEle);
        $(this).parent().parent().addClass("selected");
    } else {
        let currow = $(this).closest('tr');
        let colOrder = Number(currow.find('td:eq(1)').text());

        for (let i = 0; i < userArray.length; i++) {
            if (userArray[i][0] === colOrder) {
                let index = i;
                break;
            }
        }
        userArray.splice(index, 1);
        $(this).parent().parent().removeClass("selected");
    }
    console.log(userArray);
})

$('#rowDeleteBtn').on('click', function() {
    if (userArray.length === 0) {
        alert('1개 이상을 선택하여 주세요.');
        return false;
    }

    // for (let i = 0; i < userArray.length; i++) {
    //     if (!(userArray[i][2] === '무료')) {
    //         alert('무료등급만 삭제 가능합니다.');
    //         location.reload();
    //         return false;
    //     }
    // }

    userArray = JSON.stringify(userArray);

    goCategoryPage(userArray);

    function goCategoryPage(a) {
        var frm = formCreate('userdelete', 'post', 'process2/p_user_delete.php', '');
        frm = formInput(frm, 'userArray', a);
        formSubmit(frm);
    }
})

$('#btnExpand').on('click', function() {
    if (userArray.length === 0) {
        alert('1개 이상을 선택하여 주세요.');
        return false;
    }

    // for (let i = 0; i < userArray.length; i++) {
    //     if (!(userArray[i][2] === '무료')) {
    //         alert('무료등급만 연장 가능합니다.');
    //         location.reload();
    //         return false;
    //     }
    // }

    let expandDate = $('#expandDate').val();

    if (expandDate.length < 8) {
        alert('날짜를 제대로 입력하세요.');
        return false;
    }

    userArray = JSON.stringify(userArray);

    goCategoryPage(userArray, expandDate);

    function goCategoryPage(a, b) {
        var frm = formCreate('userexpand', 'post', 'process2/p_user_expand.php', '');
        frm = formInput(frm, 'userArray', a);
        frm = formInput(frm, 'expandDate', b);
        formSubmit(frm);
    }


})

$('#smsBtn').on('click', function() {

    $('input[name=sendphonenumber]').val('0318798003');
    if (smsReadyArray.length === 0) {
        alert('1개 이상을 선택해야 문자메시지 보내기가 가능합니다.');
        return false;
    }
    sms_noneparase();

}) //smsBtn function closing
</script>

</body>

</html>