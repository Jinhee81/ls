<?php
$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");

$email=$_GET['email'];

$query = "select count(*) from user where email='{$email}'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
 ?>

 <script type="text/javascript">

 var emailcheck = false;

 var row="<?=$row[0]?>";
 if(Number(row) >= 1){
   parent.alert('이미 존재합니다. 다시 확인하거나 다른 이메일을 사용해주세요');
 } else {
   emailcheck = true;
   parent.alert("사용 가능합니다.");
 }
 </script>
