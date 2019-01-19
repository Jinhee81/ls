<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#0B173B;">
  <a class="navbar-brand" href="/main/main.php"><img src="/img/leaseman_logo.png" width="100" height="30" class="d-inline-block align-top" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/main/main.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">고객</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">임대계약</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">기타계약</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">입금예정</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">입금</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          회계관리
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">고정비</a>
          <a class="dropdown-item" href="#">기타비용</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">월별회계조회</a>
          <a class="dropdown-item" href="#">연도별회계조회</a>
          <a class="dropdown-item" href="#">보증금조회</a>
        </div>
      </li>
    </ul>

    <form class="form-inline my-2 my-lg-0">
      <div class="dropdown">
        <span class="navbar-text" id="dropdownMenuButton" data-toggle="dropdown">
          <i class="fas fa-cog"></i>&nbsp;환경설정
        </span>&nbsp;
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="/service/setting/building.php">임대물건관리</a>
          <a class="dropdown-item" href="#">방그룹관리</a>
          <a class="dropdown-item" href="#">방좌석관리</a>
          <a class="dropdown-item" href="#">상품관리</a>
          <a class="dropdown-item" href="#">문자상용구설정</a>
        </div>
      </div>
      <span class="navbar-text">
        <a href="/user/myinfo.php">
        <i class="fas fa-user"></i>&nbsp;나의정보</a>
      </span>&nbsp;&nbsp;
      <span class="navbar-text">
      &nbsp;<?=$_SESSION['email']?>님, 안녕하세요.
      </span>&nbsp;&nbsp;
      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
      <a class="btn btn-outline-success" href="/user/logout.php" role="button">로그아웃</a>
    </form>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/mdb.min.js"></script>
  </div>
</nav>
