<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '111111',
    'mamp'
);
$filtered = array(
    'title'=>mysqli_real_escape_string($conn, $_POST['title']),
    'description'=>mysqli_real_escape_string($conn, $_POST['description']),
    'student_id'=>mysqli_real_escape_string($conn, $_POST['id'])
);
$sql = "
    insert into topic(title, description, created, student_id)
        values(
            '{$filtered['title']}',
            '{$filtered['description']}',
            now(),
            '{$filtered['student_id']}'
        )
";
if(!mysqli_query($conn, $sql)){
    echo mysqli_error($conn);
    echo 'success<br><a href="index.php">돌아가기</a>';
} else {
    header('Location: index.php');
}
?>