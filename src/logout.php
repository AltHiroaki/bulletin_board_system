<?php
session_start();

/**
 * 課題3：
 * セッションが確立しているとき、セッションを破棄してログアウトする処理を書いてください
 */
$button = $_POST['logout'];

session_destroy();
echo "セッションを破棄しました。";
header('Location: /login');

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログアウト</h2>
		<form action="logout.php" method="post">
		  <button type="submit" name="logout" value="send">ログアウト</button>
		</form>
	</body>
</html>