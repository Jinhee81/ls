<!-- 세금계산서일자 또는 현금영수증 일자 넣는거 -->
<!-- 팝빌 연동 api가 들어가는데, 여기서 중요한것은 공극받는자(세입자)의 사업자번호가 오류일 경우에 그것에 대한 반응 (alert, 사업자번호가 올바르지 않습니다) 및

공급가액/세액에서 세액이 공급가액의 10%여야 하는데 공급가액 10,000원 / 세액 5,000원으로 들어간 경우 공급가액의 10%를 찾아내는 반응이 추가되어야 할것 같습니다.


(이건 제가 넣어도 될것같은데 딱 떨어지게 10%를 하면 1원차이의 단수차이가 발생하거든요. 이럴때 어떻게 하질요??)-->

<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST);
print_r($_SESSION);

// $a = json_decode($_POST['taxArray']);
//
// for ($i=0; $i < count($a); $i++) {
//   $sql = "update paySchedule2
//           set
//               taxSelect = '{$_POST['taxSelect']}',
//               taxDate = '{$_POST['taxDate']}'
//           WHERE
//               idpaySchedule2 = {$a[$i][1]}";
//   // echo $sql;
//
//   $result = mysqli_query($conn, $sql);
//   if(!$result){
//     echo "<script>alert('발행과정에 문제가 생겼습니다. 관리자에게 문의하세요.');
//                   history.back();
//             </script>";
//     error_log(mysqli_error($conn));
//     exit();
//   }
// }
//
// echo "<script>alert('발행완료하였습니다.');
//          history.back();
//       </script>";
?>
