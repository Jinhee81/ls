<!-- footer에 하도 쓰잘데기없는거 많아서 간단하게 정리함 -->

    <hr>
    <footer class="text-center bg-light text-black pt-3">
      <div class="footer-1 pb-3">
        <a href="http://leaseman.co.kr/about/company_introduction.php" target="_blank"><button class='btn btn-outline-warning btn-sm'>회사소개</button></a>&nbsp;&nbsp;
        <a href="http://as82.kr/leaseman/" target="_blank"><button class='btn btn-outline-warning btn-sm'>원격지원</button></a>&nbsp;&nbsp;
        <a href="http://leaseman.co.kr/about/company_introduction.php" target="_blank"><button class='btn btn-outline-warning btn-sm'>사용문의</button></a>&nbsp;&nbsp;
        <a href="http://leaseman.co.kr/about/company_introduction.php" target="_blank"><button class='btn btn-outline-warning btn-sm'>결제문의</button></a>&nbsp;&nbsp;
        <a href="http://leaseman.co.kr/about/company_introduction.php" target="_blank"><button class='btn btn-outline-warning btn-sm'>탈퇴문의</button></a>&nbsp;&nbsp;
      </div>

      <div class="footer-above">
        <p class="mb-2">
          리스맨소프트 &nbsp;|&nbsp; 의정부시 동일로 119-1, 2층 A22호 &nbsp;|&nbsp; 대표 유진희 &nbsp;|&nbsp; 고객센터: 031-879-8003 &nbsp;|&nbsp; E-Mail: info@leaseman.co.kr
        </p>
        <p class="mb-2">
          사업자등록번호: 745-06-00646 &nbsp;|&nbsp; 통신판매업신고번호: 제2020-의정부신곡-0073호
        </p>
        <p class="mb-0 pb-4">
          COPYRIGHT &copy; 2018 LEASEMANSOFT Co. ALL RIGHT RESERVED.
        </p>
      </div>

    </footer>
    <script src="/js/jquery.number.min.js"></script><!--number함수호출에필요함-->
    <script src="/js/popper.min.js"></script><!--툴팁함수호출에필요함-->
    <script src="/js/bootstrap.min.js"></script><!--툴팁함수호출하면 예쁘게부트스트랩표시가 됨-->

    <script>
    function formCreate(nm, mt, at, tg){
      var f = document.createElement('form');
      f.name = nm;
      f.method = mt;
      f.action = at;
      f.target = tg ? tg : "_self";
      return f;
    }
    function formInput(f, n, v){
      var i = document.createElement('Input');
      i.type = 'hidden';
      i.name = n;
      i.value = v;
      f.insertBefore(i, null);
      return f;
    }
    function formSubmit(f){
      document.body.appendChild(f);
      f.submit();
    }

    $(document).ready(function(){
      $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      })
    })


    </script>
  </body>
</html>
