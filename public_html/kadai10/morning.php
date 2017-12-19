<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第10回 課題1</title>
	</head>
	<body>
		<h1>おはようございます、<?php echo $_SESSION["name"]; ?>さん</h1>
		<p><a href="menu.php">MENUに戻る</a></p>
	</body>
</html>