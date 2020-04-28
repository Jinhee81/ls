<!-- 문자상용구등록 처리파일 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
header("Content-Type: text/html; charset=UTF-8");

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
               '{$_POST['sendphonenumber']}',
               {$_SESSION['id']}
              )";
      // echo $sql;
      $result = mysqli_query($conn, $sql);




      if($_POST['getByte']>80){
        //장문
      $sql2 = "insert into MMS_MSG (
          SUBJECT,
          PHONE,
          CALLBACK,
          REQDATE,
          MSG,
          FILE_CNT,
          FILE_PATH1,
          FILE_PATH1_SIZ,
          ETC1,
          ETC2,
          ETC3,
          ETC4

          ) value (

          '',
          '{$a[$i][3]}',
          '{$_POST['sendphonenumber']}',
          '{$_POST['smsTime']}',
          '{$a[$i][2]}',
          0,
          '',
          '0',
          'p',
          '11',
          '9',
          'L'
          )";

      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_array($result2);
    }else{

//단문



      $sql3 = "insert into SC_TRAN (
        TR_SENDDATE,
        TR_ETC1,
        TR_ETC4,
        TR_ETC5,
        TR_ETC6,
        TR_PHONE,
        TR_CALLBACK,
        TR_MSG,
        TR_SENDSTAT,
        TR_MSGTYPE

        ) value (

        '{$_POST['smsTime']}',
        'p',
        'L',
        '11',
        '9',
        '{$a[$i][3]}',
        '{$_POST['sendphonenumber']}',
        '{$a[$i][2]}',
        '0',
        '0'
        );";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($result3);
    }


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
    $sql = "INSERT INTO sentsms
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
             '{$_POST['sendphonenumber']}',
             {$_SESSION['id']}
            )";


if($_POST['getByte']>80){
    //장문
    $sql2 = "insert into MMS_MSG (
        SUBJECT,
        PHONE,
        CALLBACK,
        REQDATE,
        MSG,
        FILE_CNT,
        FILE_PATH1,
        FILE_PATH1_SIZ,
        ETC1,
        ETC2,
        ETC3,
        ETC4

        ) value (

        '',
        '{$a[$i][3]}',
        '{$_POST['sendphonenumber']}',
        now(),
        '{$a[$i][2]}',
        0,
        '',
        '0',
        'p',
        '11',
        '9',
        'L'
        )";

    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
  }else{

//단문
        $sql3 = "insert into SC_TRAN (
            TR_SENDDATE,
            TR_ETC1,
            TR_ETC4,
            TR_ETC5,
            TR_ETC6,
            TR_PHONE,
            TR_CALLBACK,
            TR_MSG,
            TR_SENDSTAT,
            TR_MSGTYPE

            ) value (

            now(),
            'p',
            'L',
            '11',
            '9',
            '{$a[$i][3]}',
            '{$_POST['sendphonenumber']}',
            '{$a[$i][2]}',
            '0',
            '0'
            );";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_array($result3);
        }


    // echo $sql2;
    $result2 = mysqli_query($conn, $sql);
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
