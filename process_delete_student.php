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
);
$sql = "
    delete from student
        WHERE
            id = '{$filtered['id']}'
";
if(!mysqli_query($conn, $sql)){
    echo mysqli_error($conn);
    echo 'failed<br><a href="index.php">돌아가기</a>';
} else {
    header("Location: students.php");
}
?>