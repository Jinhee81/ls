<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/admin/view/aconn.php";


$sql_c = "select count(*) from user";
        $result_c = mysqli_query($conn, $sql_c);
        $row_c = mysqli_fetch_array($result_c);

$count = $row_c[0] + 1;

$sql = "SELECT
    @num := @num - 1 as num,
    user.id,
    email,
    password,
    user_div,
    user_name,
    manager_name,
    cellphone,
    lease_type,
    regist_channel,
    user.created,
    user.updated,
    (select count(*) from building where user.id = building.user_id) as building_count,
    gradename
    from
    (select @num :={$count})a,
    user
    order by
    user.created desc";

// echo $sql;
$result = mysqli_query($conn, $sql);
// print_r($result);

$filtered = array();
while($row = mysqli_fetch_array($result)){
    $filtered[] = array(
        'num'=>htmlspecialchars($row['num']),
        'id'=>htmlspecialchars($row['id']),
        'email'=>htmlspecialchars($row['email']),
        'password'=>htmlspecialchars($row['password']),
        'user_div'=>htmlspecialchars($row['user_div']),
        'user_name'=>htmlspecialchars($row['user_name']),
        'manager_name'=>htmlspecialchars($row['manager_name']),
        'cellphone'=>htmlspecialchars($row['cellphone']),
        'lease_type'=>htmlspecialchars($row['lease_type']),
        'regist_channel'=>htmlspecialchars($row['regist_channel']),
        'created'=>htmlspecialchars($row['created']),
        'updated'=>htmlspecialchars($row['updated']),
        'building_count'=>htmlspecialchars($row['building_count']),
        'gradename'=>htmlspecialchars($row['gradename'])
    );
}

for($i=0; $i < count($filtered); $i++) {
    $sql2 = "select count(*) from grade where user_id={$filtered[$i]['id']}";
    // echo $sql2."<br>";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);

    $sql3 = "select enddate 
             from grade 
             where user_id={$filtered[$i]['id']} and
                   ordered = {$row2[0]}
             ";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);

    $filtered[$i]['grade_enddate'] = htmlspecialchars($row3[0]);

    $filtered[$i]['cellphone2'] = substr($filtered[$i]['cellphone'],0,3).'-'.substr($filtered[$i]['cellphone'],3,4).'-'.substr($filtered[$i]['cellphone'],7,4);

    if($filtered[$i]['gradename']==='feefree'){
        $filtered[$i]['gradename2'] = '무료';
    } else {
        $filtered[$i]['gradename2'] = $filtered[$i]['gradename'];
    }

    $filtered[$i]['id2'] = (int)$filtered[$i]['id'];
    $filtered[$i]['created2'] = date('Y-n-j H:i:s', strtotime($filtered[$i]['created']));
    $filtered[$i]['grade_enddate2'] = date('Y-n-j', strtotime($filtered[$i]['grade_enddate']));
}


echo json_encode($filtered);
?>