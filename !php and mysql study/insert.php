<?php
$conn = mysqli_connect("127.0.0.1", "root", "wlsgml88", "opentutorials");
$sql  = "
    INSERT INTO topic (
        title,
        description,
        created
    ) VALUES (
        'MySQL',
        'MySQL is ....',
        NOW()
    )";
$result = mysqli_query($conn, $sql);
echo $result;
if($result === false){
    echo mysqli_error($conn);
}
?>
