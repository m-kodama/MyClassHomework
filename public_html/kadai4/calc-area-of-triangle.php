<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// フォームからPOSTによって要求された場合のみ
		if(isset($_POST['width']) && is_numeric($_POST['width'])) {
			$width = htmlspecialchars($_POST['width']);
		}
		if(isset($_POST['height']) && is_numeric($_POST['height'])) {
			$height = htmlspecialchars($_POST['height']);
		}
		if(isset($width) && isset($height)) {
			$result = ($width * $height) / 2;
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
			底辺：<input type="number" name="width" value="">[cm]<br>
			高さ：<input type="number" name="height" value="">[cm]<br>
			<input type="submit" name="enter" value="面積を計算">
		</form>
		<?php if(isset($result)) echo("底辺".$width."[cm]高さ".$height."[cm]の三角形の面積は".$result."[cm2]");?>
	</body>
</html>