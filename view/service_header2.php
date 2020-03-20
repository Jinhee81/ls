<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#0B173B;">
  <a class="navbar-brand" href="/main/main.php"><img src="/img/h1b.png" width="100" height="30" class="d-inline-block align-top" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/main/main.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/service/customer/customer.php">세입자</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/service/contract/contract.php">방계약</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/service/contractetc/contractetc.php">기타계약</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/service/get/getexpected.php">입금예정</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/service/get/getfinished.php">입금완료</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          회계관리
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/service/account/fixcost.php">고정비설정</a>
          <a class="dropdown-item" href="/service/account/flexCost/flexCost.php">지출입력</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/service/account/monthAccount/monthAccount.php">월별회계조회</a>
          <a class="dropdown-item" href="/service/account/yearAccount/yearAccount.php">연도별회계조회</a>
          <a class="dropdown-item" href="/service/account/deposit.php">보증금조회</a>
        </div>
      </li>
    </ul>

    <form class="form-inline my-2 my-lg-0">
      <span class="navbar-text">
        <a href="/service/setting/building.php">
        <i class="fas fa-cog"></i>&nbsp;환경설정</a>
      </span>&nbsp;
      <span class="navbar-text" data-toggle="tooltip" data-placement="bottom" title="<?=$_SESSION['gradename']?>">
        <a href="/user/myinfo.php">
        <i class="fas fa-user"></i>&nbsp;나의정보</a>
      </span>&nbsp;&nbsp;
      <span class="navbar-text">
      &nbsp;<?=$_SESSION['email']?>님, 안녕하세요.
      </span>&nbsp;&nbsp;
      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
      <a class="btn btn-outline-success" href="/user/logout.php" role="button">로그아웃</a>
    </form>
  </div>
</nav>
