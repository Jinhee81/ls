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
<script src="/js/jquery-ui-timepicker-addon.js"></script>
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
      var dropdownItemCheck = true;

      // 테이블 헤더에 있는 checkbox 클릭시
      $(":checkbox:first", tbl).change(function(){
        if($(":checkbox:first", tbl).is(":checked")){
          $(":checkbox", tbl).prop('checked',true);
          $(":checkbox").parent().parent().addClass("selected");
        } else {
          $(":checkbox", tbl).prop('checked',false);
          $(":checkbox").parent().parent().removeClass("selected");
        }
      })
      // 헤더에 있는 체크박스외 다른 체크박스 클릭시
      $(":checkbox:not(:first)", tbl).change(function(){
        var allCnt = $(":checkbox:not(:first)", tbl).length;
        var checkedCnt = $(":checkbox:not(:first)", tbl).filter(":checked").length;
        if($(this).prop("checked")==true){
          $(this).parent().parent().addClass("selected");
        } else {
          $(this).parent().parent().removeClass("selected");
        }
        if( allCnt==checkedCnt ){
          $(":checkbox:first", tbl).prop("checked", true);
        }
      })

      $('#navbarDropdown').on('click', function(){
          // $('#navbarDropdown').dropdown('toggle');
          var dropdownItem = '<a class="dropdown-item" href="#">고정비</a><a class="dropdown-item" href="#">기타비용</a><div class="dropdown-divider"></div><a class="dropdown-item" href="#">월별회계조회</a><a class="dropdown-item" href="#">연도별회계조회</a><a class="dropdown-item" href="/service/account/deposit.php">보증금조회</a>';
          if(dropdownItemCheck===true){
            $('.dropdown-menu').append(dropdownItem);
          } else {
            $('.dropdown-menu').empty();
          }
          dropdownItemCheck = false;
      })

      // $('#navbarDropdown').dropdown('toggle');
      $('.dropdown-toggle').dropdown();

      $(".amountNumber").click(function(){
        $(this).select();
      });

      $("input:text[numberOnly]").number(true);

      $(".numberComma").number(true);

      $(document).on("keyup","input:text[numberOnly]", function(){
        $(this).number(true);
      });
      $('.dateType').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        // showOn: "button",
        buttonImage: "/img/calendar.svg",
        buttonImageOnly: false
      })

      $('.timeType').datetimepicker({
        dateFormat:'yy-mm-dd',
        monthNamesShort:[ '1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월' ],
        dayNamesMin:[ '일', '월', '화', '수', '목', '금', '토' ],
        changeMonth:true,
        changeYear:true,
        showMonthAfterYear:true,

        timeFormat: 'HH:mm:ss',
        controlType: 'select',
        oneLine: true
      })
  });

  // $('.dateType').on('click', function(){
  //   $(this).datepicker({
  //     changeMonth: true,
  //     changeYear: true,
  //     showButtonPanel: true,
  //     // showOn: "button",
  //     buttonImage: "/img/calendar.svg",
  //     buttonImageOnly: false
  //   })
  // })


</script>
</body>
</html>
