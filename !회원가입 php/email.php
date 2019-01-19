<?php
// header(“pragma: no-cache”);
$msg = '이름 : '.$_POST['name']."\n"
       . '이메일 : '.$_POST['email']."\n"
       . '연락처 : '.$_POST['phone']."\n"
       . '내용 : '.$_POST['contents']."\n";
mail('bizffice@naver.com','자기소개사이트 문의', $msg);
// $url = "http://charm3007.cafe24.com/PracticeIntroduce/";
// header("Location: index.php");
echo "<script>
  alert('전송하였습니다. 빠르게 연락드리겠습니다^^');
  location.href='http://charm3007.cafe24.com/PracticeIntroduce/';
  </script>";
?>
