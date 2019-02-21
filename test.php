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

<!-- <input type="hidden" name="building_id" value="<?=$escaped['id']?>">
<input type="hidden" name="id" value="<?=$row['id']?>">
<input type="hidden" name="good" value="<?=$row['name']?>"> -->

<div class='form-group col-md-3'><span><img src='/img/calendar.svg' id='date1'></span></div> 달력아이콘
