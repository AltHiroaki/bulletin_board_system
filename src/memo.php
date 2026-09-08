<?php
session_start();

if (isset($_SESSION['user_id'])) {
  /**
   * 課題：ここにechoでHTMLタグを書いてコメント投稿フォームを出力してください
   */
  include 'comment.html';

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
}

$mysqli = new mysqli('localhost', 'intern', 'password', 'test');

if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}

/**
 * 課題：
 * trx_comments と trx_users を INNER JOIN して、
 * comment_id, user_name, text を取得してください
 */

$sql = "SELECT comments.id AS comment_id, users.user_name, comments.text FROM trx_comments AS comments INNER JOIN trx_users AS users ON users.id = comments.user_id; ";
$result = $mysqli->query($sql);


echo "<table>\n";
echo "<tr><th>ID</th><th>ユーザ名</th><th>コメント</th></tr>\n";
while($row = $result->fetch_assoc() ){
 
    $escapecomment = htmlspecialchars($row['text'], ENT_QUOTES, 'UTF-8');
    $escapeuser_name = htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8');
    $escapecomment_id = htmlspecialchars($row['comment_id'], ENT_QUOTES, 'UTF-8');

    echo "<tr>\n";
    echo "<td>{$escapecomment_id}</td>\n";
    echo "<td>{$escapeuser_name}</td>\n";
    echo "<td>{$escapecomment}</td>\n";
    echo "</tr>\n";
}
echo "</table>";