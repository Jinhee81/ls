<!-- 문자상용구등록 처리파일 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);
// print_r($_SESSION);

$a = json_decode($_POST['sendedArray2']);
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
              ('{$a[$i][5]}',
               '{$a[$i][4]}',
               '{$_POST['smsTime']}',
               '{$a[$i][1]}',
               '{$a[$i][6]}',
               '{$a[$i][3]}',
               '{$a[$i][2]}',
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
            ('{$a[$i][5]}',
             '{$a[$i][4]}',
             now(),
             '{$a[$i][1]}',
             '{$a[$i][6]}',
             '{$a[$i][3]}',
             '{$a[$i][2]}',
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
