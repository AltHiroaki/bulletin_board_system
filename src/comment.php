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
 * 課題：
 * trx_comments に、POSTされたコメントとログインしているユーザのidをINSERTする処理を書いてください
 */

  if (isset($_POST["text"]) && isset($_SESSION['user_id'])) {
    $mysqli = new mysqli('localhost', 'intern', 'password', 'test');

    if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
    }else{
            $mysqli->set_charset('utf8');
    }

    $user = $_SESSION['user_id'];
    $text = $_POST["text"];

    $sql = "INSERT INTO trx_comments (`user_id`, `text`) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('is', $user, $text);
    $stmt->execute();


    $mysqli->close();
    

}


// 登録後は一覧画面に戻すと自然です
header('Location:/table');
exit();