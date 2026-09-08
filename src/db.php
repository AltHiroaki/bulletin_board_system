<?php
$mysqli = new mysqli('localhost', 'intern', 'password', 'test');

if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset("utf8");
        echo 'データベース接続成功';
}

$mysqli->close();