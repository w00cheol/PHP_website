<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '111111',
    'mamp'
);
$list = '';
$update_link = '';
$delete_link = '';
$sql = "
    select * from topic
";
$res = mysqli_query($conn, $sql);
if(!$res->num_rows){
    echo mysqli_error($conn);
} else {
    while ($rows = mysqli_fetch_array($res)){
        $list .= '<li><a href=\'index.php?id='.$rows['id'].'\'>'.mysqli_real_escape_string($conn, $rows['title']).'</a></li>';
    }
}

$article = array(
    'title' => 'Welcome',
    'description' => 'Hello World!',
    'name' => 'CREATER'
);
if(isset($_GET['id'])){
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "select * from topic left join student on topic.student_id = student.id where topic.id = '{$filtered_id}'";
    $res = mysqli_query($conn, $sql);
    if($res->num_rows){
        $rows = mysqli_fetch_array($res);
        $article['title'] = htmlspecialchars($rows['title']);
        $article['description'] = htmlspecialchars($rows['description']);
        $article['name'] = htmlspecialchars($rows['name']);
        $update_link = '<a href=update.php?id='.$_GET['id'].'>update</a>';
        $delete_link = '
            <form action="process_delete.php" method="post">
                <input type="hidden" name="id" value="'.$_GET['id'].'">
                <input type="submit" value="DELETE!">
            </form>
        ';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>WEB</title>
    </head>
    <body>
        <h1><a href='index.php'>WEB</a></h1>
        <p><a href="students.php">students</a></p>
        <ol>
            <?=$list?>
        </ol>
        <a href="create.php">create</a>
        <?=$update_link?>
        <?=$delete_link?>
        <h2><?=$article['title']?></h2>
        <?=$article['description']?>
        <p>by <?=$article['name']?></p>
    </body>
</html>