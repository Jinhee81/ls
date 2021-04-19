<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include $_SERVER['DOCUMENT_ROOT']."/admin/view/aconn.php";

$sql1 = "SELECT
        @num := @num + 1 as num,
        user_name,
        user.id as userid,
        building.id as buildingid,
        lease_type,
        bName,
        pay,
        building.created,
        building.updated
    from
    (select @num :=0)a,
    building 
        left join user on building.user_id = user.id
    order by
    num desc"; //세션아이디로 건물정보 호출하는거

// echo $sql1."<br>";
$result1 = mysqli_query($conn, $sql1);
// print_r($result);

$allRows = array();
while($row1 = mysqli_fetch_array($result1)){

    $sql2 = "select id, gName from group_in_building
    where building_id={$row1['buildingid']}
    ";
    $result2 = mysqli_query($conn, $sql2);

    $groupArray = array();
    
    while($row2 = mysqli_fetch_array($result2)){

        $sql3 = "select count(*) 
                 from r_g_in_building
                 where 
                 group_in_building_id={$row2['id']}
                ";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($result3);

        $groupArrayEle = array(
            'id' => htmlspecialchars($row2['id']),
            'gName' => htmlspecialchars($row2['gName']),
            'roomCount' => htmlspecialchars($row3[0])
        );
        array_push($groupArray, $groupArrayEle);
    }

    $sql4 = "select id, name from good_in_building
    where building_id={$row1['buildingid']}
    ";
    $result4 = mysqli_query($conn, $sql4);

    $goodArray = array();
    
    while($row4 = mysqli_fetch_array($result4)){

        $goodArrayEle = array(
            'id' => htmlspecialchars($row4['id']),
            'name' => htmlspecialchars($row4['name'])
        );
        array_push($goodArray, $goodArrayEle);
    }

    $escaped1 = array(
        'num' => htmlspecialchars($row1['num']),
        'user_name' => htmlspecialchars($row1['user_name']),
        'userid' => htmlspecialchars($row1['userid']),
        'buildingid' => htmlspecialchars($row1['buildingid']),
        'lease_type' => htmlspecialchars($row1['lease_type']),
        'bName' => htmlspecialchars($row1['bName']),
        'pay' => htmlspecialchars($row1['pay']),
        'groupArray' => $groupArray,
        'goodArray' => $goodArray,
        'created' => htmlspecialchars($row1['created']),
        'updated' => htmlspecialchars($row1['updated'])
    );

    array_push($allRows, $escaped1);
}

echo json_encode($allRows);

// print_r($allRows);
?>