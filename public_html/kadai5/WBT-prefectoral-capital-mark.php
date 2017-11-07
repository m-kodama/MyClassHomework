<?php
	ini_set( 'display_errors', 'On' ); /* エラー出力が画面上に出力されるよう設定 */
	error_reporting( E_ALL );          /* 全レベルのエラー出力が画面上に出力されるよう設定 */
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第5回 課題(1)</title>
	</head>

	<body>
		<h1>首都当てクイズ 採点結果</h1>

		<p>
		<?php
			// データ定義ファイルの読み込み
			require_once( dirname(__FILE__)."/WBT-prefectoral-capital-data.inc" );

			if ( is_string( $_GET[ "number" ] ) ) {
				$num = htmlspecialchars( $_GET[ "number" ] );
			}
			if ( is_string( $_GET[ "answer" ] ) ) {
				$answer = htmlspecialchars( $_GET[ "answer" ] );
			}
			echo( "<p>あなたの答え: " . $problems[ $answer ][ "capital" ] . " ・・・ " );

			if ( $num == $answer ) {
				echo( "正解!<br>" );
				echo( $problems[ $num ][ "prefecture" ] . "の首都は" );
				echo( $problems[ $num ][ "capital" ] . "ですね。\n" );
			} else {
				echo( "残念、不正解...<br>" );
				echo( $problems[ $num ][ "prefecture" ] . "の首都は" );
				echo( $problems[ $num ][ "capital" ] . "です。\n" );
			}
			echo( "</p>" );
		?>
		<p>
			<a href="./WBT-prefectoral-capital.php">もう1回チャレンジ!</a>
		</p>
	</body>
</html>