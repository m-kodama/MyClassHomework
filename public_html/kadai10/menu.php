<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['name']) && is_string($_POST['name'])) {
			$_SESSION["name"] = addslashes(htmlspecialchars($_POST['name']));
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第10回 課題1</title>
	</head>
	<body>
		<h1>メニューページ</h1>
		<ul>
			<li><a href="morning.php">朝</a></li>
			<li><a href="noon.php">昼</a></li>
			<li><a href="night.php">夜</a></li>
		</ul>
		<p><a href="top.html">TOPページ</a></p>
	</body>
</html>