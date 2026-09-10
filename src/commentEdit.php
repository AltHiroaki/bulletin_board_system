<?php
session_start();


$action = isset($_POST['action']) ? $_POST['action'] : 'edit';
$comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : '';
$text = isset($_POST['text']) ? $_POST['text'] : '';



if ($action === 'update') {

  $token = filter_input(INPUT_POST, 'csrf_token');

  // トークンがない、もしくは一致しない場合、処理を中止
  if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    exit('不正なリクエスト');
  }

  unset($_SESSION['csrf_token']);


  $mysqli = new mysqli('localhost', 'intern', 'password', 'test');

  if($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
  }else{
    $mysqli->set_charset('utf8');
  }


  $user_id = $_SESSION['user_id'];

  $sql = "UPDATE trx_comments SET `text` = ? WHERE id = ? AND user_id = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sii", $text, $comment_id, $user_id);

  if ($stmt->execute()) {
    $stmt->close();
    $mysqli->close();

    header('Location: /table');
    exit();
  }

  echo $stmt->error;

  $stmt->close();
  $mysqli->close();
  exit();
}



$token = filter_input(INPUT_POST, 'csrf_token');

// トークンがない、もしくは一致しない場合、処理を中止
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
  exit('不正なリクエスト');
}

unset($_SESSION['csrf_token']);


$token = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($token);
$_SESSION['csrf_token'] = $csrf_token;


$escapecomment = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
$escapecomment_id = htmlspecialchars($comment_id, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>

		<h2>コメント編集</h2>

		<form action="/commentEdit" method="post">

      元コメント:
		  <?php echo $escapecomment; ?>
      <br/>
		  コメント:
		  <input type="text" name="text" value="" />
		  <br/>
		  <input type="hidden" name="comment_id" value="<?php echo $escapecomment_id; ?>" />
		  <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />
		  <input type="hidden" name="action" value="update" />
		  <input type="submit" value="更新" />

		</form>

		<br>

		<a href="/table">戻る</a>

	</body>
</html>