<!-- 이건 예전블로그에서 본 전체선택 자바스크립트 (표 전체선택부분, 이게 그런데 잘 안됨 ㅜㅜ) -->

<hr>
<footer class="text-center bg-light text-black pt-3">
  <div class="footer-above">
    Copyright &copy; 유진희 2018 1111</footer>
  </div>
</footer>

<!-- <script src="/js/jquery-3.2.1.min.js"></script> -->
<script type="text/javascript" src="/js/dataTable.jquery.js"></script>
<script type="text/javascript" src="/js/dataTable.responsive.js"></script>

<script src="/js/jquery.number.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/datepicker-ko.js"></script>
<!-- <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script> 이건 필요한페이지에 넣기로 함-->
<!-- <script src="/js/daumAddressAPI.js"></script> -->
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/mdb.min.js"></script> <!--이걸왜했지? 머티리얼디자인부트스트랩 js파일임-->
<script>
  // $('.nav-item').on('click', '.nav-link', function(){
  //   $('.nav-itme .nav-link.active').removeClass('active');
  //   $(this).addClass('active');
  // })
  // $('.navbar-text').on('click', function(){
  //   $('.navbar-text.active').removeClass('active');
  //   $(this).addClass('active');
  // })
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
      var tbl = $("#checkboxTestTbl");

      // 테이블 헤더에 있는 checkbox 클릭시
      $(":checkbox:first", tbl).click(function(){
          // 클릭한 체크박스가 체크상태인지 체크해제상태인지 판단
          if( $(":checkbox:first", tbl).is(":checked") ){
              // $(":checkbox", tbl).attr("checked", "checked");
              // console.log('테이블헤더체크박스 클릭, 모든행체크된상태로변경');
              $(":checkbox", tbl).attr('checked', 'checked').trigger("change");
              // $(":checkbox", tbl).trigger("change");

          } else{
              // $(":checkbox", tbl).removeAttr("checked");
              // console.log('테이블헤더체크박스 클릭, 모든행체크안된상태로변경');
              $(":checkbox", tbl).attr("checked", false).trigger("change");
              // $(":checkbox", tbl).trigger("change");

          }

          // 모든 체크박스에 change 이벤트 발생시키기
          // $(":checkbox", tbl).trigger("change");
      });

      // 헤더에 있는 체크박스외 다른 체크박스 클릭시
      $(":checkbox:not(:first)", tbl).click(function(){
          var allCnt = $(":checkbox:not(:first)", tbl).length;
          var checkedCnt = $(":checkbox:not(:first)", tbl).filter(":checked").length;

          // 전체 체크박스 갯수와 현재 체크된 체크박스 갯수를 비교해서 헤더에 있는 체크박스 체크할지 말지 판단
          if( allCnt==checkedCnt ){
              $(":checkbox:first", tbl).attr("checked", true);
          } else{
              $(":checkbox:first", tbl).attr("checked", false);
          }
      }).change(function(){
          if( $(this).is(":checked") ){
              // 체크박스의 부모 > 부모 니까 tr 이 되고 tr 에 selected 라는 class 를 추가한다.
              $(this).parent().parent().addClass("selected");
          } else{
              $(this).parent().parent().removeClass("selected");
          }
      });

      $('#navbarDropdown').dropdown('toggle');

      $(".amountNumber").click(function(){
        $(this).select();
      });

      $("input:text[numberOnly]").number(true);
      // $(document).on("keyup","input:text[numberOnly]", function(){
      //   $(this).number(true);
      // });
  });

  $('.dateType').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    // showOn: "button",
    buttonImage: "/img/calendar.svg",
    buttonImageOnly: false
  });
  $(document).on("keyup","input:text[numberOnly]", function(){
    $(this).number(true);
  });
</script>
</body>
</html>
