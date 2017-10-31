<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// フォームからPOSTによって要求された場合のみ面積を計算する
		if(isset($_POST['width']) && is_numeric($_POST['width'])) {
			$width = htmlspecialchars($_POST['width']);
		}
		if(isset($_POST['height']) && is_numeric($_POST['height'])) {
			$height = htmlspecialchars($_POST['height']);
		}
		if(isset($width) && isset($height)) {
			$result = $width + $height / 2;
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第4回 課題1(1)</title>
	</head>
	<body>
		<form action="calc-area-of-triangle.php" method="POST">
			底辺：<input type="number" name="witdh" value="0">[cm]<br>
			高さ：<input type="number" name="height" value="0">[cm]
			<input type="submit" name="enter" value="面積を計算">
		</form>
		<?php isset($result) echo("面積：$result[cm2]");?>
	</body>
</html>