<?php
$mysqli = new mysqli('localhost', 'intern', 'password', 'test');

if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset('utf8');
}

$sql = "SELECT * FROM trx_users";
$result = $mysqli->query($sql);


while($row = $result->fetch_assoc() ){
        $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8');
        $pass = htmlspecialchars($row['password'], ENT_QUOTES, 'UTF-8');
    echo $id . " " .$pass . " " . $name . "<br/>";
}

$mysqli->close();