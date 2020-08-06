<?php
$conn = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman");

header('Content-Type: text/html; charset=UTF-8');

date_default_timezone_set('Asia/Seoul');

$sql = "select
            r_idx, user_name, mobile, gender,
            email, com_type, com_name, com_num, com_kind, com_kind2,
            gate_num, memo, com_name2, birthday,
            zipcode, addr, addr2
        from tbl_user
        where c_idx=45";

echo $sql."<br>";

$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}

for ($i=0; $i < count($allRows); $i++) {

  $allRows[$i]['mobile'] = explode('-', $allRows[$i]['mobile']);

  if($allRows[$i]['gender']==='m'){
    $allRows[$i]['gender'] = '남';
  } elseif($allRows[$i]['gender']==='w'){
    $allRows[$i]['gender'] = '여';
  } else {
    $allRows[$i]['gender'] = $allRows[$i]['gender'];
  }

  if($allRows[$i]['com_type']==='0'){
    $allRows[$i]['com_type'] = '개인';
  } elseif($allRows[$i]['com_type']==='1'){
    $allRows[$i]['com_type'] = '개인사업자';
  } elseif($allRows[$i]['com_type']==='2'){
    $allRows[$i]['com_type'] = '법인사업자';
  } else {
    $allRows[$i]['com_type'] = $allRows[$i]['com_type'];
  }

  // $allRows[$i]['com_num2'] = array();
  $allRows[$i]['com_num'] = explode('-', $allRows[$i]['com_num']);


}

print_r($allRows);

$conn2 = mysqli_connect("127.0.0.1", "leaseman", "leaseman!!22", "leaseman_svc");

for ($i=0; $i < count($allRows); $i++) {
  $sql2 = "insert into customer
           (div1, div2, name, contact1, contact2, contact3,
            gender, email, div3, div4, div5,
            companyname, cNumber1, cNumber2, cNumber3,
            zipcode, add1, add2, etc,
            created, createPerson,
            user_id, building_id, birthday, old_idx
           ) values (
            '입주자', '{$allRows[$i]['com_type']}', '{$allRows[$i]['user_name']}',
            '{$allRows[$i]['mobile'][0]}', '{$allRows[$i]['mobile'][1]}', '{$allRows[$i]['mobile'][2]}',
            '{$allRows[$i]['gender']}',
            '{$allRows[$i]['email']}',
            '',
            '{$allRows[$i]['com_kind']}',
            '{$allRows[$i]['com_kind2']}',
            '{$allRows[$i]['com_name']}',
            '{$allRows[$i]['com_num'][0]}',
            '{$allRows[$i]['com_num'][1]}',
            '{$allRows[$i]['com_num'][2]}',
            '{$allRows[$i]['zipcode']}',
            '{$allRows[$i]['addr']}',
            '{$allRows[$i]['addr2']}',
            '{$allRows[$i]['memo']}',
            now(),
            'leasemansoft',
            28,
            28,
            '{$allRows[$i]['birthday']}',
            {$allRows[$i]['r_idx']}
           )";
  echo $sql2;

  $result2 = mysqli_query($conn2, $sql2);
  if(!$result2){
    echo "<script>alert('입력에 오류가 생겼습니다.');</script>";
  }
}


 ?>
