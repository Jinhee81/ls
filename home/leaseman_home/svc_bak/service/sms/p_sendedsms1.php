<!-- 문자상용구없음으로 문자보냈을때 처리파일 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$a = json_decode($_POST['sendedArray1']);
// $a = json_decode(json_encode($_POST['sendedArray1']), True);
// print_r($a);

if($_POST['timeDiv']==='reservation'){
  if(!$_POST['smsTime']){
    echo "<script>
            alert('예약전송인 경우 날짜시간을 지정해야 합니다.');
            history.back();
          </script>";
  } else {
    for ($i=0; $i < count($a); $i++) {
      $sql = "INSERT INTO sentsms
              (type, byte, sendtime, customer, roomNumber, phonenumber,
               description, sentnumber, user_id)
              VALUES
              ('{$_POST['smsDiv']}',
               '{$_POST['getByte']}',
               '{$_POST['smsTime']}',
               '{$a[$i][4]->세입자}',
               '{$a[$i][3]->방번호}',
               '{$a[$i][5]->연락처}',
               '{$_POST['textareaOnly']}',
               '{$_SESSION['cellphone']}',
               {$_SESSION['id']}
              )";
      // echo $sql;
      $result = mysqli_query($conn, $sql);
      if(!$result){
        echo "<script>alert('전송과정에 문제가 생겼습니다. 관리자에게 문의하세요(1).');
                          history.back();
              </script>";
            error_log(mysqli_error($conn));
            exit();
      }
    }//for end}
  }
} else {

  for ($i=0; $i < count($a); $i++) {
    $sql2 = "INSERT INTO sentsms
            (type, byte, sendtime, customer, roomNumber, phonenumber,
             description, sentnumber, user_id)
            VALUES
            ('{$_POST['smsDiv']}',
             '{$_POST['getByte']}',
             now(),
             '{$a[$i][4]->세입자}',
             '{$a[$i][3]->방번호}',
             '{$a[$i][5]->연락처}',
             '{$_POST['textareaOnly']}',
             '{$_SESSION['cellphone']}',
             {$_SESSION['id']}
            )";
    // echo $sql2;
    $result2 = mysqli_query($conn, $sql2);
    if(!$result2){
      echo "<script>alert('전송과정에 문제가 생겼습니다. 관리자에게 문의하세요(2).');
                    history.back();
            </script>";
          error_log(mysqli_error($conn));
          exit();
    }
  }//for end}



} //else end}

echo "<script>alert('전송하였습니다.');
         location.href='sent.php';
      </script>";




?>
