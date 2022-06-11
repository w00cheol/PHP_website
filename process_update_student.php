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
    'name'=>mysqli_real_escape_string($conn, $_POST['name']),
    'profile'=>mysqli_real_escape_string($conn, $_POST['profile'])
);
$sql = "
    update student
        SET
            name = '{$filtered['name']}',
            profile = '{$filtered['profile']}'
        WHERE
            id = '{$filtered['id']}'
";
if(!mysqli_query($conn, $sql)){
    echo mysqli_error($conn);
    echo 'failed<br><a href="students.php">돌아가기</a>';
} else {
    header('Location: students.php');
}
?>