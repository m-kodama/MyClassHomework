<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第10回 課題2</title>
	</head>
	<body>
		<?php
			if(!isset($_SESSION['id'])) {
				echo "<span style='color:#D32F2F;'>ログインしてください</span><br>";
				echo( "<a href=\"top-2.html\">トップページに戻る</a>" );
				exit(0);
			}
		?>
		<h1>今日は、<?php echo $_SESSION["name"]; ?>さん</h1>
		<p><a href="menu-2.php">MENUに戻る</a></p>
	</body>
</html>