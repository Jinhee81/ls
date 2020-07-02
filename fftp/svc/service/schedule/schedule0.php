<div id="calendar">

</div>

<script src="/svc/inc/js/jquery-3.3.1.min.js"></script>
<script src="/svc/inc/js/moment.min.js"></script>
<script src="/svc/inc/js/fullcalendar.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
      left:'prevYear,prev,next,nextYear today',
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
      day: "일별",
      list:"목록"
    },
    minTime: "09:00:00",
    maxTime: "18:00:00",
    events: 'load.php',
    selectable: true,
    selectHelper: true,
    select: function(start, end, allDay)
    {
      var title = prompt('이벤트를 입력하세요.');
      if(title)
      {
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

        $.ajax({
          url: 'insert.php',
          type: 'POST',
          data: {title:title, start:start, end:end},
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
