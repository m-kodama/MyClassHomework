<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
</head>

<body>

<h1>セッション開始</h1>

<?php
    echo("Session ID: ".session_id()."<br>");
?>

<a href="inherit-session-with-cookie.php">次のページへのリンク</a>

</body>
</html>