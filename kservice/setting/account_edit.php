<?php
    session_start();
    if(!isset($_SESSION['is_login'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
    include $_SERVER['DOCUMENT_ROOT']."/view/header.php";
    include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

    $sql = "select * from user where usercode={$_GET['usercode']}";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

    $clist['department'] = htmlspecialchars($row['department']);
    $clist['position'] = htmlspecialchars($row['position']);
    $clist['name'] = htmlspecialchars($row['name']);
    $clist['phone1'] = htmlspecialchars($row['phone1']);
    $clist['phone2'] = htmlspecialchars($row['phone2']);
    $clist['phone3'] = htmlspecialchars($row['phone3']);
    $clist['email'] = htmlspecialchars($row['email']);
    $clist['in_date'] = htmlspecialchars($row['in_date']);
    $clist['out_date'] = htmlspecialchars($row['out_date']);
    $clist['id'] = htmlspecialchars($row['id']);
    $clist['password'] = htmlspecialchars($row['password']);
    $clist['etc'] = htmlspecialchars($row['etc']);
?>

<style>
td.primary {
    background-color: #CEF6F5;
}
</style>

<section class="container">
    <div class="jumbotron pt-3 pb-3">
        <h3 class=""> >> 계정 수정 화면입니다!</h3>
        <!-- <p class="lead">관리물건이란 </p> -->
        <hr class="my-4">
    </div>
</section>
<section class="container" style="max-width:500px;">
    <form action="p_account_edit.php" method="post">
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">부서명</label>
            <div class="col-sm-9">
                <select name="department" class="form-control">
                    <option value="관리팀" <?php if($clist['department']==='관리팀'){echo "selected";}?>>관리팀</option>
                    <option value="영업1팀" <?php if($clist['department']==='영업1팀'){echo "selected";}?>>영업1팀</option>
                    <option value="영업2팀" <?php if($clist['department']==='영업2팀'){echo "selected";}?>>영업2팀</option>
                    <option value="영업3팀" <?php if($clist['department']==='영업3팀'){echo "selected";}?>>영업3팀</option>
                    <option value="영업4팀" <?php if($clist['department']==='영업4팀'){echo "selected";}?>>영업4팀</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">직급/직책</label>
            <div class="col-sm-9">
                <select name="position" class="form-control">
                    <option value="대표" <?php if($clist['position']==='대표'){echo "selected";}?>>대표</option>
                    <option value="본부장" <?php if($clist['position']==='본부장'){echo "selected";}?>>본부장</option>
                    <option value="이사" <?php if($clist['position']==='이사'){echo "selected";}?>>이사</option>
                    <option value="팀장" <?php if($clist['position']==='팀장'){echo "selected";}?>>팀장</option>
                    <option value="과장" <?php if($clist['position']==='과장'){echo "selected";}?>>과장</option>
                    <option value="대리" <?php if($clist['position']==='대리'){echo "selected";}?>>대리</option>
                    <option value="사원" <?php if($clist['position']==='사원'){echo "selected";}?>>사원</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">성명</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" value="<?=$clist['name']?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">연락처</label>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col pr-0">
                        <input type="number" class="form-control" name="phone1" value="<?=$clist['phone1']?>">
                    </div>
                    <div class="col pl-0 pr-0">
                        <input type="number" class="form-control" name="phone2" value="<?=$clist['phone2']?>">
                    </div>
                    <div class="col pl-0">
                        <input type="number" class="form-control" name="phone3" value="<?=$clist['phone3']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">이메일</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" value="<?=$clist['email']?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">입사일</label>
            <div class="col-sm-9">
                <input type="text" class="form-control dateType" name="in_date" value="<?=$clist['in_date']?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">퇴사일</label>
            <div class="col-sm-9">
                <input type="text" class="form-control dateType" name="out_date" value="<?=$clist['out_date']?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">아이디</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="id" value="<?=$clist['id']?>">
                <input type="hidden" class="form-control" name="usercode" value="<?=$_GET['usercode']?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">비밀번호</label>
            <div class="col-sm-9">
                <input type="text" class="form-control password" name="password" value="<?=$clist['password']?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">특이사항</label>
            <div class="col-sm-9">
                <textarea name="etc" id="" cols="30" rows="2" class="form-control"><?=$clist['etc']?></textarea>
            </div>
        </div>
        <div class="mt-7">
            <a class="btn btn-secondary" href="account.php" role="button">>>계정목록</a>
            <button type="submit" class="btn btn-primary">수정</button>
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