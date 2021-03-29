<?php include "view/header.php";
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

?>

<body>

    <div class="bg-dark text-center pt-3">
        <img class="mb-4" src="inc/img/leaseman-1.png" alt="" width="" height="">
    </div>

    <section class="container">
        <div class="jumbotron pt-3 pb-3">
            <h3 class="">새로운 비밀번호를 생성합니다.</h3>
            <hr class="my-4">
            <!-- <p>It uses utility classes for typography and spacing to space content out within the larger container.</p> -->
        </div>
    </section>

    <div class="container" style="max-width:500px;">
        <form class="" action="p_password_send.php" method="post">

            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label"><b>이메일</b></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="email">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label"><b>연락처</b></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="cellphone">
                    <button type="submit" class="btn btn-sm btn-outline-info mt-3">비밀번호 생성하기</button>
                </div>
            </div>

            <div class="text-center">
            </div>
        </form>
    </div>

    <?php
    include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";
    ?>

    <script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
    <script src="/svc/inc/js/bootstrap.min.js"></script>
</body>

</html>