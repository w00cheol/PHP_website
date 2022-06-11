<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '111111',
    'mamp'
);
$sql = "
    select * from topic
";
$res = mysqli_query($conn, $sql);
if(!$res->num_rows){
    echo mysqli_error($conn);
} else {
    while ($rows = mysqli_fetch_array($res)){
        echo '<h1>'.$rows['title'].'</h1>';
        echo $rows['description'];
    }
}
?>