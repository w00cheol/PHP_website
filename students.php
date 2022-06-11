<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '111111',
    'mamp'
);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>WEB</title>
    </head>
    <body>
        <h1><a href='index.php'>WEB</a></h1>
        <p><a href="index.php">topics</a></p>
        <table border='1'>
            <tr>
                <td>id</td><td>name</td><td>profile</td>
                <?php
                $sql = "select * from student";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
                    $filtered = array(
                        'id'=>htmlspecialchars($row['id']),
                        'name'=>htmlspecialchars($row['name']),
                        'profile'=>htmlspecialchars($row['profile']),
                    )
                    ?>
                    <tr>
                        <td><?=$filtered['id']?></td>
                        <td><?=$filtered['name']?></td>
                        <td><?=$filtered['profile']?></td>
                        <td><a href="students.php?id=<?=$filtered['id']?>">update</a></td>
                        <td>
                            <form action="process_delete_student.php" method="post" onsubmit="if(!confirm('Really?')){return false;}">
                                <input type="hidden" name="id" value="<?=$filtered['id']?>">
                                <input type="submit" value="delete">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tr>
        </table>
        <?php
        $input_id = '';
        $action_url = 'process_create_student.php';
        $submit_message = 'Create new student';
        $escaped = array(
            'name'=>'',
            'profile'=>''
        );
        if(isset($_GET['id'])){
            $submit_message = 'Update student';
            $action_url = 'process_update_student.php';
            $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
            settype($filtered_id, 'integer');
            $sql = 'SELECT * FROM student WHERE id="'.$filtered_id.'"';
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($res);
            $escaped['id'] = htmlspecialchars($row['id']);
            $escaped['name'] = htmlspecialchars($row['name']);
            $escaped['profile'] = htmlspecialchars($row['profile']);
            $input_id = '<input type="hidden" name="id" value="'.$escaped['id'].'">';
        }
        ?>
        <form action="<?=$action_url?>" method="POST">
            <?=$input_id?>
            <p><input type="text" name="name" placeholder="name" value="<?=$escaped['name']?>"></p>
            <p><textarea name="profile" placeholder="profile"><?=$escaped['profile']?></textarea></p>
            <p><input type="submit" value="<?=$submit_message?>"></p>
        </form>
        <p><a href="pdf_student.php">PDF로 변환</a></p>
    </body>
</html>