<?php
session_start();

$token = filter_input(INPUT_POST, 'csrf_token');

//トークンがない、もしくは一致しない場合、処理を中止
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
  exit('不正なリクエスト');
}
unset($_SESSION['csrf_token']);


if (!isset($_SESSION['user_id'])) {
  // ログインしていないときは処理されたくない
  echo "Bad Request";
  exit();
}


$mysqli = new mysqli('localhost', 'intern', 'password', 'test');

if($mysqli->connect_error){
  echo $mysqli->connect_error;
  exit();
}

/**
 * trx_comments のlike_count を+1する処理を書いてください
 */

  if (isset($_POST["comment_id"])) {

    $comment_id = $_POST['comment_id'];

    $sql = "UPDATE trx_comments SET like_count = like_count + 1 WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $comment_id);
    $stmt->execute();

    $mysqli->close();
    

}


// 登録後は一覧画面に戻すと自然です
header('Location:/table');
exit();