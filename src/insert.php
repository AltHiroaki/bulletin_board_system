<?php
$mysqli = new mysqli('localhost', 'intern', 'password', 'test');

if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset('utf8');
}

$sql = "INSERT INTO trx_users (`user_name`, `password`) VALUES ('aiueo','0123')";
$mysqli->query($sql);

$mysqli->close();
