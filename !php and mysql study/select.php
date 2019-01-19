<?php
$conn = mysqli_connect("127.0.0.1", "root", "wlsgml88", "opentutorials");

echo '<h1>Single row</h1>';
$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo '<h3>'.$row['title'].'</h3>';
echo $row['description'];

echo '<h1>Multi row</h1>';
$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
  echo '<h3>'.$row['title'].'</h3>';
  echo $row['description'];
}
?>
