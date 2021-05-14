<?php
session_start();
if(!isset($_SESSION['is_login'])){
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);

$fil = array(
    'department' => mysqli_real_escape_string($conn, $_POST['department'])
);

if($fil['department']==='관리팀'){
    $_where = '';
} else {
    $_where = ' where department='.$fil['department'];
}

$sql = "select 
            idnote, firstDate, channel, danawaNumber,
            c_name, c_contact, c_location, 
            rentlease, c_content,
            sales_content,
            user.name,
            user.department
         from note
        ".$_where
        ." left join user on note.usercode = user.usercode";
// echo $sql;

$result = mysqli_query($conn, $sql);

$allrows = array();
while($row = mysqli_fetch_array($result)){
    $allrows[] = $row;
}

echo json_encode($allrows);

?>