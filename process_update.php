<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '111111',
    'mamp'
);
settype($_POST['id'], 'integer');
$filtered = array(
    'id'=>mysqli_real_escape_string($conn, $_POST['id']),
    'title'=>mysqli_real_escape_string($conn, $_POST['title']),
    'description'=>mysqli_real_escape_string($conn, $_POST['description'])
);
$sql = "
    update topic
        SET
            title = '{$filtered['title']}',
            description = '{$filtered['description']}'
        WHERE
            id = '{$filtered['id']}'
";
if(!mysqli_query($conn, $sql)){
    echo mysqli_error($conn);
    echo 'failed<br><a href="index.php">돌아가기</a>';
} else {
    echo 'success<br><a href="index.php">돌아가기</a>';
}
?>