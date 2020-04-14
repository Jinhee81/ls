<!-- footer에 하도 쓰잘데기없는거 많아서 간단하게 정리함 -->

    <hr>
    <footer class="text-center bg-light text-black pt-3">
      <div class="footer-above">
        Copyright &copy; 유진희 2018 1111
      </div>
    </footer>
    <script src="http://www.leaseman.co.kr/svc/js/jquery.number.min.js"></script><!--number함수호출에필요함-->
    <script src="http://www.leaseman.co.kr/svc/js/popper.min.js"></script><!--툴팁함수호출에필요함-->
    <script src="http://www.leaseman.co.kr/svc/js/bootstrap.min.js"></script><!--툴팁함수호출하면 예쁘게부트스트랩표시가 됨-->

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
