<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";

// print_r($_POST);

// echo $_POST['description'];

$output .= "<div class='container'>";
$output .= "<div class='row mb-2'><div class='col align-self-center'><textarea class='form-control' style='background-color: #FAFAFA;'>".$_POST['description']."</textarea></div></div>";
$output .= "<div class='row mb-2'><div class='col col-md-4'>이름</div><div class='col col-md-8'><input class='form-control form-control-sm' value='".$_POST['reciever']."' disabled></div></div>";
$output .= "<div class='row mb-2'><div class='col col-md-4'>수신번호</div><div class='col col-md-8'><input class='form-control form-control-sm' value='".$_POST['recieveNumber']."' disabled></div></div>";
$output .= "<div class='row mb-2'><div class='col col-md-4'>발신번호</div><div class='col col-md-8'><input class='form-control form-control-sm' value='".$_POST['sentNumber']."' disabled></div></div>";
$output .= "</div>";

echo $output;

 ?>

<script>

$('textarea').on('click', function(){
  $(this).select();
})
</script>
