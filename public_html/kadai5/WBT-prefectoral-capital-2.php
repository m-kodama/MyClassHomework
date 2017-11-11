<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第5回 課題(2)</title>
	</head>
	<body>
		<h1>県庁所在地当てクイズ</h1>
		<p>次の都道府県の県庁所在地を漢字で答えてください。</p>
		<form action="WBT-prefectoral-capital-mark-2.php" method="POST">
			<?php
			// データ定義ファイルの読み込み
			require_once( dirname(__FILE__)."/WBT-prefectoral-capital-data.inc" );
			// 問題文のシャッフル
			$keys = array_keys($problems);
			shuffle($keys);
			// 出題
			$qTemplate = "<p>問%s. %s：<input type=\"text\" name=\"answer[]\" size=\"10\">".
									 "<input type=\"hidden\" name=\"id[]\" value=\"%s\"></p>";
			$number = 1;
			for($i=0; $i<5; $i++) {
				$key = $keys[$i];
				echo sprintf($qTemplate, $number, $problems[$key]['prefecture'], $key);
				$number++;
			}
			?>
			<p>
				<button type="reset">リセット</button> 
				<button type="submit"> 採  点 </button>
			</p>
		</form>
	</body>
</html>