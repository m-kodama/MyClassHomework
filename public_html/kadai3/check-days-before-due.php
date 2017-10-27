<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>第3回 課題2(3)</title>
  </head>

 	<body>
  	<?php
  		// 今日の曜日を取得
			$datetime = new DateTime();
			$weeks = array("Sun.", "Mon.", "Tue.", "Wed.", "Thurs.", "Fri.", "Sat.");
			$week = (int)$datetime->format('w');
			echo("Today is $weeks[$week]<br>");
  		// 締め切りまでの日数を判定
  		if($week == 0) {
  			// 今日は日曜日
  			echo("It's deadline!!<br>");
  		} else {
  			// 日曜日以外
  			$before = 7 - $week;
  			echo("It's $before days before due.<br>");
  		}
  	?>
  </body>
</html>