<?php
$d1 = new DateTime;
$di -> setTimezone(new DateTimezone($_POST['timezone']));
echo $d1->format($_POST['format']);
 ?>
