<?php
$conn = mysqli_connect("127.0.0.1", "root", "wlsgml88", "opentutorials");
$sql  = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
$list = '';
while($row = mysqli_fetch_array($result)){
  //<li><a href=\"index.php?id=19\">mysql</a></li>
  $escaped_title = htmlspecialchars($row['title']);
  $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
};

$article = array(
  'title' => 'Welcome!',
  'description' => 'Hello, world.'
);

if ($_GET['id']){
  $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM topic WHERE id={$filtered_id}";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $article['title'] = htmlspecialchars($row['title']);
  $article['description'] = htmlspecialchars($row['description']);

  $update_link = '<a href="update.php?id='.$_GET['id'].'">update</a>';
}
// print_r($article);
?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1><a href="index.php">WEB</a></h1>
    <ol>
      <?=$list?>
    </ol>
    <a href="create.php">create</a>
    <form class="" action="update_process.php" method="post">
      <input type="hidden" name="id" value="<?=$_GET['id']?>">
      <p><input type="text" name="title" placeholder="title" value='<?=$article['title']?>'></p>
      <p><textarea name=description placeholder="description"><?=$article['description']?></textarea></p>
      <p><input type="submit"></p>
    </form>
  </body>
</html>
