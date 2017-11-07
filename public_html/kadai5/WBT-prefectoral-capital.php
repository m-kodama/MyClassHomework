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
		<h1>県庁所在地当てクイズ</h1>
		<p>次の都道府県の県庁所在地を漢字で答えてください。</p>
		<form action="WBT-prefectoral-capital-mark.php">
			<?php
			// データ定義ファイルの読み込み
			require_once( dirname(__FILE__)."/WBT-prefectoral-capital-data-10.inc" );
			// 出題
			$qTemplate = "問%s. %s：<input type=\"text\" name=\"answer[]\" size=\"10\">".
									"<input type=\"hidden\" name=\"id[]\" value=\"%s\">";
			$number = 1;
			foreach ($problems as $key => $value) {
				echo sprintf($qTemplate, $number, $value['prefecture'], $key);
				$number++;
			}

/*
			$amount = count( $problems );
			// 乱数の初期化
			list( $usec, $sec ) = explode( " ", microtime() );
			mt_srand( (int)( ( (float)$usec ) * 1000000) );
			// 乱数の生成
			$num = mt_rand( 0, $amount - 1 );

			echo( "<p>\n" );
			echo( $problems[ $num ][ "prefecture" ] . "の首都は次のどれでしょう?\n" );
			echo( "<input type=\"hidden\" name=\"number\" value=\"$num\">" );
			echo( "</p>\n" );

			$row = 4;
			echo( "<table border=\"0\">\n" );
			for( $i = 0; $i <= ( ( $amount - 1 ) / $row ); $i++ ) {
				echo( "<tr>\n" );
				for( $j = 0; $j < $row; $j++ ) {
					if( isset( $problems[ $i * $row + $j ] ) ) {
						echo( "<td width=\"200em\">\n" );
						echo( "<label>\n" );
						echo( "<input type=\"radio\" name=\"answer\" value=\"". ($i * $row + $j) );
						echo( "\">" );
						echo( $problems[ $i * $row + $j ][ "capital" ] );
						echo( "</label>\n" );
						echo( "</td>\n" );
					}
				}
				echo( "</tr>\n" );
			}
			echo( "</table>\n" );
*/
			?>

			<p>
				<button type="reset">リセット</button> 
				<button type="submit"> 採  点 </button>
			</p>
		</form>
	</body>
</html>