<?php
	ini_set( 'display_errors', 'On' ); /* エラー出力が画面上に出力されるよう設定 */
	error_reporting( E_ALL );          /* 全レベルのエラー出力が画面上に出力されるよう設定 */
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第5回 課題(3)</title>
	</head>
	<body>
		<h1>県庁所在地当てクイズ 採点結果</h1>
		<p>
		<?php
		// データ定義ファイルの読み込み
		require_once( dirname(__FILE__)."/WBT-prefectoral-capital-data.inc" );

		$isAnswerExist = (isset($_POST["answer"]) && is_array($_POST["answer"]));
		$isIdExist = (isset($_POST["id"]) && is_array($_POST["id"]));
		if(!$isAnswerExist || !$isIdExist) {
			echo("<p><a href='./WBT-prefectoral-capital-3.php'>問題を解く</a></p>");
			exit(0);
		}
		$answer = [];
		$n = count($_POST["answer"]);
		for($i =0; $i<$n; $i++) {
			$answer[] = [
				'id' => htmlspecialchars($_POST["id"][$i]),
				'capital' => trim(htmlspecialchars($_POST["answer"][$i]))
			];
		}
		// 採点結果の判定・出力
		$number = 1; 
		$point = 0;
		foreach ($answer as $key => $value) {
			if($value['capital'] == $problems[$value['id']]['capital']) {
				$result = "<b style='color:#03A9F4;'>正解</b>";
				$correctAnswer = "";
				$point += 20;
			} else {
				$result = "<b style='color:#F44336;'>不正解</b>";
				$correctAnswer = "正しい答え：".$problems[$value['id']]['capital'];
			}
			$html = "<p>問$number. ".$problems[$value['id']]['prefecture']."　$result<br>".
							"あなたの回答：".$value['capital']."　　$correctAnswer</p>";
			echo($html);
			$number++;
		}
		echo("<p style='font-size:20px;'>得点：".$point."点</p>");
		if(isset($_POST["time"]) && is_string($_POST["time"])) {
			$time = time() - htmlspecialchars($_POST["time"]);
			echo("<p style='font-size:20px;'>回答時間：".$time."[秒]</p>");
		}
		?>
		</p>
		<p>
			<a href="./WBT-prefectoral-capital-3.php">もう1回チャレンジ!</a>
		</p>
	</body>
</html>