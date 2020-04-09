var table = $("#checkboxTestTbl");

// 테이블 헤더에 있는 checkbox 클릭시
$("#allselect").change(function(){
  if($(this).is(":checked")){
    $(".tbodycheckbox").prop('checked',true);
    $(".tbodycheckbox").parent().parent().addClass("selected");
    // console.log('맨위체크박스 체크함');
  } else {
    $(".tbodycheckbox").prop('checked',false);
    $(".tbodycheckbox").parent().parent().removeClass("selected");
    // console.log('맨위체크박스 체크취소');
  }
})

// 테이블 바디에 있는 checkbox 클릭시, 이걸 펑션화하려고 했는데 암만해도 안된다  ㅠㅠ
// function tbodycheckbox(){
//   var allCnt = $(".tbodycheckbox").length;
//   var checkedCnt = $(".tbodycheckbox").filter(":checked").length;
//
//   console.log(allCnt, checkedCnt);
//
//   if($(this).is(":checked")){
//     $(this).prop('checked',true);
//     $(this).parent().parent().addClass("selected");
//   } else {
//     $(this).prop('checked',false);
//     $(this).parent().parent().removeClass("selected");
//   }
//
//   if( allCnt==checkedCnt ){
//     $("#allselect").prop("checked", true);
//   }
// }
