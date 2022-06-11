<?php
echo 'hi<br>';
$conn = mysqli_connect('localhost', 'root', '111111', 'mamp');
echo mysqli_error($conn);
/*
mysqli_query($conn,
    "create table topic(
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(45) NOT NULL,
        description text,
        created datetime NOT NULL,
        PRIMARY KEY(id)
    ) ENGINE=InnoDB"
);
*/
$res = mysqli_query($conn, $sql);
if(!$res){
    echo mysqli_error($conn);
}
$rows = mysqli_fetch_assoc($res);
echo $rows['msg'];
?>