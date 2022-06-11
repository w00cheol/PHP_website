<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '111111',
    'mamp'
);
$filtered = array(
    'name'=>mysqli_real_escape_string($conn, $_POST['name']),
    'profile'=>mysqli_real_escape_string($conn, $_POST['profile'])
);
$sql = "
    insert into student(name, profile)
        values(
            '{$filtered['name']}',
            '{$filtered['profile']}'
        )
";
if(!mysqli_query($conn, $sql)){
    echo mysqli_error($conn);
    echo 'success<br><a href="students.php">돌아가기</a>';
} else {
    header('Location: students.php');
}
?>