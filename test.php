<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      $array = ['solmi', 'siwon', 'minsun'];
      $a ="b";
     ?>
     <button type="button" name="button" onclick="hello(<?=$array?>);">hello</button>
  </body>
</html>
<script type="text/javascript">
  function hello(a){
    var array = <?= json_encode($array) ?>;
    // console.dir(a);
    document.write(array);
    console.log(array);


  }

  // array.forEach(function(item){
  //   document.write(item\n);
  // })
</script>
