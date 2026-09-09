<?php
session_start();

$mysqli = new mysqli('localhost', 'intern', 'password', 'test');

if($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
}else{
    $mysqli->set_charset('utf8');
}

if(isset($_SESSION['user_id'])) {
    echo "既にログインしています。";
    echo "あなたのユーザーネームは". $_SESSION['user_name'] . "です。";
    exit();
}

/**
 * 課題２：
 * POSTで受け取った username / password を使って、
 * trx_users に一致するユーザーがいるか確認してください。
 *
 * 一致するユーザーがいれば、
 * $_SESSION['user_id'] にユーザーIDを、
 * $_SESSION['user_name'] にユーザー名を格納してください。
 */


$username = $_POST['username'];
$password = $_POST['password'];

// パスワードはそのままDBに保存せず、ハッシュ化して保存します
$password_hash = hash("sha256", $password);




$sql = "SELECT * FROM trx_users WHERE user_name = ? AND password = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $username, $password_hash);
$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc()){
    $_SESSION['user_id'] = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
    $_SESSION['user_name'] = htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8');
    header('Location: http://localhost:8080/login');
}

$mysqli->close();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログイン</h2>
		<form action="login.php" method="post">
		  ユーザ: <input type="text" name="username" /><br/>
		  パスワード: <input type="password" name="password" /><br/>
		  <input type="submit" />
		</form>
	</body>
</html>