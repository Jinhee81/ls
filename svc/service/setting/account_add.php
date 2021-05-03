<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /svc/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
?>

<section class="container">
    <div class="jumbotron pt-3 pb-3">
        <h3 class=""> >> 부계정 등록 화면입니다!</h3>
        <p class="font-weight-light">직원이 있는경우 부계정을 등록하세요. 체크된 화면만 사용할 수 있습니다.</p>
        <!-- <hr class="my-4"> -->
        <!-- <small>(1) '명칭'은 평상시 부르는 이름으로 적어주세요. 예)도레미고시원, 성공빌딩 (2) '수금방법'은 임대료를 선불로 수납할 경우 선불 선택, 후불로 수납할경우 후불을 선택하세요.</small> -->
    </div>
</section>
<section class="container">
    <!-- <section class="container" style="max-width:500px;"> -->
    <div class="row justify-content-md-center">
        <div class="col-10">
            <form action="p_account_add.php" method="post">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">이름</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" placeholder="이름 혹은 별명을 넣어주세요" required="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">이메일</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" placeholder="이메일을 입력하세요.(로그인시 사용)"
                            required="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">패스워드</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="password" placeholder="패스워드를 입력하세요. (로그인시 사용)"
                            required="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">특이사항</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="etc"></textarea>
                    </div>
                </div>
                <div class="form-group row bg-light pt-2">
                    <label class="col-sm-3 col-form-label">사용화면</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" class="" checked name=101>
                                <label class="">입주자목록</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" class="" checked name=201>
                                <label class="">임대계약목록</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" class="" checked name=301>
                                <label class="">기타계약목록</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" class="" checked name=401>
                                <label class="">납부예정목록</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" class="" checked name=501>
                                <label class="">납부완료목록</label>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" class="" checked name=501>
                                <label class="">고정비설정</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" class="" checked name=502>
                                <label class="">고정비입력</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" class="" checked name=503>
                                <label class="">변동비입력</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" class="" checked name=504>
                                <label class="">월별회계조회</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" class="" checked name=505>
                                <label class="">연도별회계조회</label>
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-7">
                    <a class="btn btn-secondary" href="building.php" role="button">취소/돌아가기</a>
                    <button type="submit" class="btn btn-primary">저장</button>
                </div>
            </form>
        </div>
    </div>


</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>