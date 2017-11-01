<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// フォームからPOSTによって要求された場合のみ
		if(isset($_POST['m']) && is_numeric($_POST['m'])) {
			$m = htmlspecialchars($_POST['m']);
			$c = 2.99792458 * pow(10,8);
			$E = $m * $c*$c;
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第4回 課題1(2)</title>
	</head>
	<body>
		<form action="special-relativity.php" method="POST">
			質量：<input type="number" name="m" value="">[kg]<br>
			<input type="submit" name="enter" value="特殊相対性理論に基づくエネルギー量を計算">
		</form>
		<?php if(isset($E)) echo("質量".$m."[kg]の特殊相対性理論に基づくエネルギー量は".$E);?>
	</body>
</html>