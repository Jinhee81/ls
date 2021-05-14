<?php
    session_start();
    if(!isset($_SESSION['is_login'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
    include $_SERVER['DOCUMENT_ROOT']."/view/header.php";
?>

<section class="container">
    <div class="jumbotron pt-3 pb-3">
        <h3 class=""> >> 계정 등록 화면입니다!</h3>
        <!-- <p class="lead">관리물건이란 </p> -->
        <hr class="my-4">
    </div>
</section>
<section class="container" style="max-width:500px;">
    <form action="p_account_add.php" method="post">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">부서명</label>
            <div class="col-sm-9">
                <select name="department" class="form-control">
                    <option value="관리팀">관리팀</option>
                    <option value="영업1팀">영업1팀</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">직급/직책</label>
            <div class="col-sm-9">
                <select name="position" class="form-control">
                    <option value="본부장">본부장</option>
                    <option value="이사">이사</option>
                    <option value="팀장">팀장</option>
                    <option value="과장">과장</option>
                    <option value="대리">대리</option>
                    <option value="사원">사원</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">성명</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">연락처</label>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col pr-0">
                        <input type="number" class="form-control" name="phone1" required="">
                    </div>
                    <div class="col pl-0 pr-0">
                        <input type="number" class="form-control" name="phone2" required="">
                    </div>
                    <div class="col pl-0">
                        <input type="number" class="form-control" name="phone3" required="">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">이메일</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">입사일</label>
            <div class="col-sm-9">
                <input type="text" class="form-control dateType" name="in_date" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">아이디</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="id">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">비밀번호</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="password">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">특이사항</label>
            <div class="col-sm-9">
                <textarea name="etc" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="mt-7">
            <a class="btn btn-secondary" href="account.php" role="button">취소/돌아가기</a>
            <button type="submit" class="btn btn-primary">저장</button>
        </div>
    </form>
</section>

<?php
include $_SERVER['DOCUMENT_ROOT']."/view/footer.php";
?>

<script class="">
$(document).ready(function() {
    $('.dateType').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        currentText: '오늘',
        closeText: '닫기'
    })
})
</script>
</body>

</html>