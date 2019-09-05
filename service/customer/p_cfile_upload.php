<?php
session_start();
if(!isset($_SESSION['is_login'])){
  header('Location: /user/login.php');
}
include $_SERVER['DOCUMENT_ROOT']."/view/service_header1_meta.php";
include $_SERVER['DOCUMENT_ROOT']."/view/service_header2.php";
include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

// print_r($_POST);
// print_r($_FILES);

if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] !== ""){
  $file = $_FILES['upfile'];
  $max_file_size = 5242880;

  if($file['size'] >= $max_file_size){
    echo "<script>alert('5MB 까지만 업로드 가능합니다.');</script>";
  }

  $handle = fopen($file['tmp_name'], 'r');?>
  <style>
  .fixed-table-body{
    /* width: 100%;
    height: 100%; */
    overflow-x: auto;
  }
  </style>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1 class="display-4">업로드한 파일 내용입니다.</h1>
      <!-- <p class="lead">이 화면에서는 한꺼번에 많은 방계약들을 등록합니다.</p> -->
      <small>(1)<span id='star' style='color:#F7BE81;'>* </span>표시는 반드시 입력해야 합니다.</small>
      <hr class="my-4">
    </div>
    <div class="fixed-table-container">
      <div class="fixed-table-body">
        <table class="table table-bordered text-center" fixed-header>
          <tr>
            <td><span id='star' style='color:#F7BE81;'>* </span>구분1</td>
            <td><span id='star' style='color:#F7BE81;'>* </span>구분2</td>
            <td><span id='star' style='color:#F7BE81;'>* </span>성명</td>
            <td><span id='star' style='color:#F7BE81;'>* </span>연락처</td>
            <td>성별</td>
            <td>이메일</td>
            <td>법인사업자구분</td>
            <td>업태</td>
            <td>업종</td>
            <td>사업자명</td>
            <td>사업자번호</td>
            <td>특이사항</td>
          </tr>
          <?php
            while($data = fgetcsv($handle)){?>
            <tr>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[0]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[1]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[2]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[3]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[4]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[5]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[6]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[7]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[8]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[9]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[10]?>"></td>
              <td><input type="text" class="form-control fom-control-sm" value="<?=$data[11]?>"></td>
            </tr>
          <?php  }
          ?>
        </table>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <button type="button" name="button" class="btn btn-primary mr-1">세입자등록</button>
    </div>
  </div>
<?php
}
?>

<?php include $_SERVER['DOCUMENT_ROOT']."/view/service_footer.php";?>
