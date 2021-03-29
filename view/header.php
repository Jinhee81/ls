<!DOCTYPE html>
<!--홍보페이지 헤더-->
<html lang="en" dir="ltr">

<head>
    <title>klassauto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
      shrink-to-fit=no">
    <!-- <meta property="og:image" content="https://www.instagram.com/"> -->

    <link rel="stylesheet" href="./inc/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1:700|Nanum+Gothic" rel="stylesheet">

    <link rel="stylesheet" href="./inc/css/customizing.css?<?=date('YmdHis')?>">
    <script type="text/javascript" src="./inc/js/jquery-3.3.1.min.js?<?=date('YmdHis')?>"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li href="nav-item">
                    <a class="nav-link" href="#">최저가추출</a>
                </li>
                <li href="nav-item">
                    <a class="nav-link" href="#">차종코드보기</a>
                </li>
                <li href="nav-item">
                    <a class="nav-link" href="#">기타</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <span class="navbar-text">
                    &nbsp;<?=$_SESSION['name']?>님, 안녕하세요.
                </span>&nbsp;&nbsp;
                <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
                <a class="btn btn-outline-success" href="/spec/logout.php" role="button">로그아웃</a>
            </form>
        </div>

    </nav>