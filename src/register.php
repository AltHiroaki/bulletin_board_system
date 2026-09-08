<section>
    <form action="" method="post">
        名前:<br>
        <input type="text" name="name" value=""><br>
        <br>
        パスワード:<br>
        <input type="text" name="password" value=""><br>
        <input type="submit" value="登録">
    </form>
</section>

<?php
if (isset($_POST["name"]) && isset($_POST["password"])) {
    $mysqli = new mysqli('localhost', 'intern', 'password', 'test');

    if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
    }else{
            $mysqli->set_charset('utf8');
    }

    $name = $_POST["name"];
    $pass = $_POST["password"];

    $sql = "INSERT INTO trx_users (`user_name`, `password`) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $name, $pass);
    $stmt->execute();

    $mysqli->close();
}