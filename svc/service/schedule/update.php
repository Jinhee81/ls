<?php
session_start();
// include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

$connect = new PDO('mysql:host=127.0.0.1;dbname=leaseman_svc','leaseman','leaseman!!22');

if(isset($_POST['id']))
{
  $query = "
    update events
    set title=:title, start_event=:start_event, end_event=:end_event
    where id=:id
  ";
  $statement = $connect -> prepare($query);
  $statement -> execute(
    array(
        ':title' => $_POST['title'],
        ':start_event' => $_POST['start'],
        ':end_event' => $_POST['end'],
        ':id' => $_POST['id']
    )
  );
}
 ?>
