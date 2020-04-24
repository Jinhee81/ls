<?php
session_start();
if(!isset($_SESSION['is_login'])){
    header('Location: /svc/login.php');
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>일정관리</title>
<?php
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
?>
<style>
        #checkboxTestTbl tr.selected{background-color: #A9D0F5;}
        select .selectCall{background-color: #A9D0F5;}

        @media (max-width: 990px) {
        .mobile {
          display: none;
        }
}
</style>
<section class="container">
  <div class="jumbotron pt-3 pb-3">
    <h3 class="">일정관리 화면입니다!</h3>
    <p class="lead">
      <!-- (1) 상태(진행 - 현재 계약 진행 중), (대기 - 곧 계약시작임), (종료 - 종료된 계약)로 구분합니다.<br>
      (2) 월이용료를 클릭하면 해당 계약의 상세페이지가 나옵니다.<br>
      (3) 단계는 (clear-계약을 입력하자마자), (청구- 언제돈입금예정인지 설정), 입금(이용료(임대료)가 입금되고있는 상태)로 구분됩니다. -->
    </p>
  </div>
</section>
<section class="container">
  <div id="calendar">

  </div>
  <div class="">
    <!-- <?php echo phpinfo(); ?> -->
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/svc/view/service_footer.php";?>

<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/fullcalendar.min.js"></script>
<script src="/svc/inc/js/popper.min.js"></script>
<script src="/svc/inc/js/bootstrap.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
  var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    // titleFormat: {
    //   month: "yyyy년 mmmm",
    //   week: "[yyyy] mmm dd일 {[yyyy] mmm dd일}",
    //   day: "yyyy년 mmm d일 dddd"
    // }, //이게 잘 안되서 주석처리함
    monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
    monthNamesShort: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
    dayNames: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
    dayNamesShort: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
    buttonText:{
      today: "오늘",
      month: "월별",
      week: "주별",
      day: "일별"
    },
    events: 'load.php',
    selectable: true,
    selectHelper: true,
    select: function(start, end, allDay)
    {
      var title = prompt('이벤트를 입력하세요.');
      if(title)
      {
        var start = $.fullCalendar.formatDate(start, "YYYY-MM-DD 12:00:00");
        var end = $.fullCalendar.formatDate(end, "YYYY-MM-DD 13:00:00");


        var ed = new Date(end);
        ed.setDate(ed.getDate() - 1);
        strEnd = [ed.getFullYear(), ed.getMonth() + 1, ed.getDate()].join("-") + " 13:00:00";


        $.ajax({
          url: 'insert.php',
          type: 'POST',
          data: {title:title, start:start, end:strEnd},
          success: function(){
            calendar.fullCalendar('refetchEvents');
            alert('추가했습니다.');
          }
        })
      }
    },
    editable: true,
    eventResize: function(event)
    {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url: "update.php",
        type: "POST",
        data: {title:title, start:start, end:end, id:id},
        success: function(){
          calendar.fullCalendar('refetchEvents');
          alert('이벤트가 수정되었습니다.');
        }
      })
    },

    eventDrop: function(event)
    {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url: "update.php",
        type: "POST",
        data: {title:title, start:start, end:end, id:id},
        success: function(){
          calendar.fullCalendar('refetchEvents');
          alert('이벤트가 수정되었습니다.');
        }
      })
    },

    eventClick: function(event)
    {
      if(confirm("정말 삭제하겠습니까?"))
      {
        var id = event.id;
        $.ajax({
          url: "delete.php",
          type: "POST",
          data: {id:id},
          success: function()
          {
            calendar.fullCalendar('refetchEvents');
            alert('삭제하였습니다.');
          }
        });
      }
    }

  });
})

</script>

</body>
</html>