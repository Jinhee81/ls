<?php include "view/header.php";
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

?>

<body>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        '크롬브라우저'에서 최적으로 작동합니다. 반드시 크롬브라우저에서 실행해주세요 ^__^ <a href="https://www.google.com/intl/ko/chrome/"
            class="alert-link" target="_blank">다운로드 바로가기</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="bg-dark text-center pt-3">
        <img class="mb-4" src="inc/img/leaseman-1.png" alt="" width="" height="">
    </div>
    <div class="text-center container mt-5">

        <h1 class="h3 mb-3 font-weight-normal">클라스오토 매니저 사이트 접속을 환영합니다 :)</h1>
        <div class="text-center container mt-5" style="width:360px;">


            <form method="post" action="login_check.php" class="form-signin">
                <div class="form-group">
                    <input type="text" name="id" class="form-control" required>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="top_margin"></div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
            </form>
        </div>
    </div>

    <?php
include "view/footer.php";
?>

    <script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
    <script src="/svc/inc/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var c_email = getCookie("email");
        $('input[name=email]').val(c_email);

        if ($('input[name=email]').val() != '') {
            $('input[name=remember-email]').attr("checked", true);
        }

        $('input[name=remember-email]').change(function() {
            if ($(this).is(":checked")) {
                console.log('checked');
                setCookie("email", $('input[name=email]').val(), 60);
            } else {
                deleteCookie("email");
                console.log('unchecked')
            }
        })

        $('input[name=email]').on('keyup', function() {
            if ($('input[name=remember-email]').is(':checked')) {
                setCookie("email", $('input[name=email]').val(), 60);
            }
        })

        function setCookie(cookieName, value, exdays) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + exdays);
            var cookieValue = escape(value) + ((exdays === null) ? "" : "; expires=" + exdate.toGMTString());
            document.cookie = cookieName + "=" + cookieValue;
            console.log(document.cookie);
        }

        function deleteCookie(cookieName) {
            var expireDate = new Date();
            expireDate.setDate(expireDate.getDate() - 1);
            document.cookie = cookieName + '= ' + '; expires=' + expireDate.toGMTString();
        }

        function getCookie(cookieName) {
            cookieName = cookieName + '=';
            var cookieData = document.cookie;
            var start = cookieData.indexOf(cookieName);
            var cookieValue = '';

            if (start != -1) {
                start += cookieName.length;
                var end = cookieData.indexOf(';', start);
                if (end == -1) end = cookieData.length;
                cookieValue = cookieData.substring(start, end);
            }

            return unescape(cookieValue);
        }


    })
    </script>
</body>

</html>