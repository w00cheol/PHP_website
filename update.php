<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '111111',
    'mamp'
);
$list = '';
$update_link = '';
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
    'description' => 'Hello World!'
);
if(isset($_GET['id'])){
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "select * from topic where id = '{$filtered_id}'";
    $res = mysqli_query($conn, $sql);
    if($res->num_rows){
        $rows = mysqli_fetch_array($res);
        $article['title'] = htmlspecialchars($rows['title']);
        $article['description'] = htmlspecialchars($rows['description']);
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
        <ol>
            <?=$list?>
        </ol>
        <form action="process_update.php" method="POST">
            <input type="hidden" name="id" value=<?=$_GET['id']?>>
            <p>
                <input type="text" name="title" placeholder="title" value=<?=$article['title']?>>
            </p>
            <p>
                <textarea name="description" placeholder="description"><?=$article['description']?></textarea>
            </p>
            <p>
                <input type="submit">
            </p>
        </form>
    </body>
</html>