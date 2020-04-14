<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/svc/view/conn.php";
// error_reporting(E_ALL);

// ini_set("display_errors", 1);
// print_r($_POST);
// print_r($_FILES);
header("Content-Type: text/html; charset=UTF-8");
$filtered_id = mysqli_real_escape_string($conn, $_POST['contract']);

//$_FILES['upfile'] Array ( [name] => 1.txt [type] => text/plain [tmp_name] => /tmp/phpIN6VtW [error] => 0 [size] => 213 )
//$_FILES['upfile']['name'] 1.txt

if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] !== ""){
  $file = $_FILES['upfile'];
  $upload_directory = 'data/';
  $ext_str = "hwp,xls,xlsx,doc,docx,pdf,jpg,gif,png,txt,ppt,pptx,tiff";
  $allowed_extensions = explode(',', $ext_str);

  $max_file_size = 5242880;
  $ext = substr($file['name'], strrpos($file['name'],'.') + 1);

  if(!in_array($ext, $allowed_extensions)){
    echo "업로드 할수없는 확장자입니다.";
  }

  if($file['size'] >= $max_file_size){
    echo "5MB 까지만 업로드 가능합니다.";
  }

  $path = md5(microtime()).'.'.$ext;
//   echo "<pre>";
//   print_r($_FILES);
//  echo "</pre>";
// $file['tmp_name'] /tmp/phpajcAz1
// $upload_directory.$path data/6bd5bce111e8c429469329c8cb750cbb.txt
  if(move_uploaded_file($file['tmp_name'],$upload_directory.$path)){
    $file_id = md5(uniqid(rand(),true));
    $name_orig = $file['name'];
    $name_save = $path;
    $size = $file['size'];
    // $query = "
    //         INSERT INTO upload_file(file_id, name_orig, name_save, size, reg_time, realContract_id) VALUES
    //         (?, ?, ?, ?, now(), {$filtered_id})";
    $query = "
            INSERT INTO upload_file(file_id, name_orig, name_save, size, reg_time, realContract_id) VALUES
            ('{$file_id}', '{$name_orig}', '{$name_save}', {$size}, now(), {$filtered_id})";
    //echo $query;
    $result = mysqli_query($conn, $query);
    // $stmt = mysqli_prepare($conn, $query);
    // $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save, $size);
    // $exec = mysqli_stmt_execute($stmt);
    //
    // mysqli_stmt_close($stmt);
    if($result){
      echo "<script>
              alert('파일저장에 성공하였습니다.');
              location.href='contractEdit3.php?id=".$filtered_id."';
            </script>";
    } else {
      echo "<script>
              alert('파일저장에 실패했습니다. 관리자에게 문의하세요(1).');
              location.href='contractEdit3.php?id=".$filtered_id."';
            </script>";
    }
} else {
  echo "<script>
          alert('파일저장에 실패했습니다. 관리자에게 문의하세요(2).');
          location.href='contractEdit3.php?id=".$filtered_id."';
        </script>";
  // echo "<script>
  //         alert('파일저장에 실패했습니다. 관리자에게 문의하세요.');
  //         location.href='contractEdit3.php?id=$filtered_id';
  //       </script>";
}
}
 ?>
