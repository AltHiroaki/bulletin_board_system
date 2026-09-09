<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // パスワードはそのままDBに保存せず、ハッシュ化して保存します
    $password_hash = hash("sha256", $password);

    /**
     * 課題１：mysqliを用いてMySQLに接続し、
     * $username と $password_hash を trx_users にINSERTする処理を書いてください
     */
    $mysqli = new mysqli('localhost', 'intern', 'password', 'test');

    if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
    }else{
            $mysqli->set_charset('utf8');
    }

    $sql = "INSERT INTO trx_users (`user_name`, `password`) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $username, $password_hash);
    $stmt->execute();

    $mysqli->close();
    header('Location: /login');
    exit();
}

?>

<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ユーザ追加</h2>
		<form action="/newUser" method="post">
		  ユーザ: <input type="text" name="username" /><br/>
		  パスワード: <input type="password" name="password" /><br/>
		  <input type="submit" />

		</form>
	</body>
</html>