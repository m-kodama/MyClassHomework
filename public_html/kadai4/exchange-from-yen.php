<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// フォームからPOSTによって要求された場合のみ
		if(isset($_POST['yen']) && is_numeric($_POST['yen'])) {
			$yen = htmlspecialchars($_POST['yen']);
		}
		if(isset($_POST['currency']) && is_string($_POST['currency'])) {
			$currency = htmlspecialchars($_POST['currency']);
		}
		if(isset($yen) && isset($currency)) {
			$rate = [
				'USD'=>113.58, 'EUR'=>131.91,  'GBP'=>149.25, 'CHF'=>113.89, 
				'AUD'=>87.22,  'KRW'=>0.10099, 'CNY'=>17.09
			];
			if(isset($rate[$currency])) {
				$result = $yen / $rate[$currency];
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第4回 課題1(3)</title>
	</head>
	<body>
		<form action="exchange-from-yen.php" method="POST">
			円：<input type="number" name="yen" value="">[JPY]<br>
			通貨：
			<label><input type="radio" name="currency" value="USD" checked>USD</label>
			<label><input type="radio" name="currency" value="EUR">EUR</label>
			<label><input type="radio" name="currency" value="GBP">GBP</label>
			<label><input type="radio" name="currency" value="CHF">CHF</label>
			<label><input type="radio" name="currency" value="AUD">AUD</label>
			<label><input type="radio" name="currency" value="KRW">KRW</label>
			<label><input type="radio" name="currency" value="CNY">CNY</label><br>
			<input type="submit" name="enter" value="OK">
		</form>
		<?php if(isset($result)) echo($yen."[JPY] => ".$result."[".$currency."]");　?>
	</body>
</html>