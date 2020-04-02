<?php
session_start();
session_destroy();
header('Location: login.php');
 ?>

 <!-- 세션스타트를 넣고 세션디스트로이를 넣어야지 세션이 지워진다. 딸랑 세션디스트로이만 넣으니 세션 삭제가 안된거였음 -->
