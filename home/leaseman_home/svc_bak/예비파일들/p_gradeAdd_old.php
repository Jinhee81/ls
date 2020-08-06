<!-- 이 파일도 정기결제가 빠지면서 대대적으로 손질되었음, 예전꺼는 예비파일 폴더에 있는거 참조해야 함 -->
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

print_r($_POST);

$fil['session_id'] = mysqli_real_escape_string($conn, $_SESSION['id']);

$sql = "select count(*) from grade where user_id={$fil['session_id']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$ordered = (int)$row[0] + 1;

if($_POST['paydiv']==='yearonly'){
  $sql2 = "insert into grade
           (gradename, executivedate, startdate, enddate,
            formonth, payamount, ordered, user_id)
           VALUES
           ('{$_POST['gradename']}',
            '{$_POST['today']}',
            '{$_POST['today']}',
            '{$_POST['year1later']}',
            12,
            {$_POST['amount']},
            {$ordered},
            {$fil['session_id']}
           )
           ";
  echo $sql2;

  $result2 = mysqli_query($conn, $sql2);

  if(!$result2){
    echo "<script>alert('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(1)');
    location.href = 'payment.php';
    </script>";
    error_log(mysqli_error($conn));
  } else {
    $sql3 = "update user
             set
                gradename='{$_POST['gradename']}'
             where id = {$fil['session_id']}";
    $result3 = mysqli_query($conn, $sql3);

    if(!$result3){
      echo "<script>alert('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(2)');
      location.href = 'payment.php';
      </script>";
      error_log(mysqli_error($conn));
    }
  }
}


if($_POST['paydiv']==='monthonly') {
  $sql2 = "insert into grade
           (gradename, executivedate, startdate, enddate,
            formonth, payamount, ordered, user_id)
           VALUES
           ('{$_POST['gradename']}',
            '{$_POST['today']}',
            '{$_POST['today']}',
            '{$_POST['month1later']}',
            1,
            {$_POST['amount']},
            {$ordered},
            {$fil['session_id']}
           )
           ";
  // echo $sql2;

  $result2 = mysqli_query($conn, $sql2);

  if(!$result2){
    echo "<script>alert('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(3)');
    location.href = 'payment.php';
    </script>";
    error_log(mysqli_error($conn));
  } else {
    $sql3 = "update user
             set
                gradename='{$_POST['gradename']}'
             where id = {$fil['session_id']}";
    $result3 = mysqli_query($conn, $sql3);

    if(!$result3){
      echo "<script>alert('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(4)');
      location.href = 'payment.php';
      </script>";
      error_log(mysqli_error($conn));
    }
  }
}

if($_POST['paydiv']==='threemonthonly') {
  $sql4 = "insert into grade
           (gradename, executivedate, startdate, enddate,
            formonth, payamount, ordered, user_id)
           VALUES
           ('{$_POST['gradename']}',
            '{$_POST['today']}',
            '{$_POST['today']}',
            '{$_POST['month1later']}',
            3,
            {$_POST['amount']},
            {$ordered},
            {$fil['session_id']}
           )
           ";
  // echo $sql2;

  $result4 = mysqli_query($conn, $sql4);

  if(!$result4){
    echo "<script>alert('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(4)');
    location.href = 'payment.php';
    </script>";
    error_log(mysqli_error($conn));
  } else {
    $sql5 = "update user
             set
                gradename='{$_POST['gradename']}'
             where id = {$fil['session_id']}";
    $result5 = mysqli_query($conn, $sql5);

    if(!$result5){
      echo "<script>alert('결제과정에 문제가 생겼습니다. 관리자에게 문의하세요.(4)');
      location.href = 'payment.php';
      </script>";
      error_log(mysqli_error($conn));
    }
  }
}


echo "<script>alert('결제하였습니다.');
location.href = 'main.php';
</script>";





 ?>
