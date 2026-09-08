<?php
if (isset($_POST["message"])) {
    echo $_POST["message"];
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>
<body>
  <form action="form.php" method="post">
    メッセージ: <input type="text" name="message"><br>
    <input type="submit">
  </form>
</body>
</html>