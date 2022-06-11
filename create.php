<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '111111',
    'mamp'
);
$list = '';
$sql = "select * from topic";
$res = mysqli_query($conn, $sql);
if(!$res->num_rows){
    echo mysqli_error($conn);
}else { while ($rows = mysqli_fetch_array($res)){
        $list .= '<li><a href=\'index.php?id='.$rows['id'].'\'>'.mysqli_real_escape_string($conn, $rows['title']).'</a></li>';
    }
}

$student_list = '<select name="id">';
$sql = "select * from student";
$res = mysqli_query($conn, $sql);
if(!$res->num_rows){
    echo mysqli_error($conn);
}else { while ($rows = mysqli_fetch_array($res)){
        $student_list .= '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
    }
}
$student_list .= '</select>'
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>WEB</title>
    </head>
    <body>
        <h1><a href="index.php">WEB</a></h1>
        <ol>
            <?=$list?>
        </ol>
        <form action="process_create.php" method="POST">
            <?=$student_list?>
            <p>
                <input type="text" name="title" placeholder="title">
            </p>
            <p>
                <textarea name="description" placeholder="description"></textarea>
            </p>
            <p>
                <input type="submit">
            </p>
        </form>
    </body>
</html>