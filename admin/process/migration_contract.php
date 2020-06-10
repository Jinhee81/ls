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

// echo $sql."<br>";

$result = mysqli_query($conn, $sql);

$allRows = array();
while($row = mysqli_fetch_array($result)){
  $allRows[] = $row;
}

$allRows2 = array();
for ($i=0; $i < count($allRows); $i++) {

  $sql2 = "select
              tbl_contract.idx,
              tbl_contract.u_idx,
              tbl_user.user_name,
              tbl_contract.b_idx,
              tbl_build.aliasName,
              tbl_contract.g_idx,
              tbl_rgroup.g_name,
              tbl_contract.r_idx,
              tbl_room.roomname,
              tbl_contract.c_idx,
              tbl_customer.user_name
           from tbl_contract
           left join tbl_customer
                on tbl_contract.c_idx = tbl_customer.c_idx
           left join tbl_user
                on tbl_contract.u_idx = tbl_user.r_idx
           left join tbl_build
                on tbl_contract.b_idx = tbl_build.idx
           left join tbl_rgroup
                on tbl_contract.g_idx = tbl_rgroup.idx
           left join tbl_room
                on tbl_contract.r_idx = tbl_room.idx
           where tbl_contract.u_idx={$allRows[$i]['r_idx']}
                 and tbl_contract.b_idx=84
           ";

  echo $sql2;

  // $result2 = mysqli_query($conn, $sql2);
  //
  //
  // while($row2 = mysqli_fetch_array($result2)){
  //   $allRows2[] = $row2;
  // }

}

// print_r($allRows2);

 ?>
