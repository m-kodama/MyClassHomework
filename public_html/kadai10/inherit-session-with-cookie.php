<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
</head>

<body>

<h1>Cookieを利用したセッションの継続</h1>

<?php
    echo("Session ID: ".session_id()."<br>");
?>

</body>
</html>