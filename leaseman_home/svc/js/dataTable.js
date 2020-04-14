$(document).ready(function(){
    $('#checkboxTestTbl').DataTable({
      responsive: true, //이건반영이잘안되는것같음 ㅠㅠ
      "searching": false, //우측상단 검색하는거
      "ordering": false,  //필터정렬기능
      "lengthChange": false, //보여주는길이변경하는거
      "bPaginate": false,    //페이지네이션
      "info": false  //하단에 몇개중몇개 정보보여주는거
    });
  })
  