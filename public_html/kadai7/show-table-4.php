<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>第6回 課題1(1)</title>
</head>
<body>
	<?php
		$dbname="b7fm1007";
		$c = pg_connect("dbname=$dbname");
		if ( $c != false ) {
			$query = "select * from ei_students;";
			if ( $r = pg_query( $c, "$query" ) ) {
				$m = pg_num_rows($r);
				if ( $m > 0 ) { /* 問合せの結果、データの有無を確認 */
					echo("<table border=\"1\">");
					echo("<tr>");
					$row = pg_fetch_assoc($r, 0);
					foreach($row as $key => $value) {
						echo("<th>");
						switch( $key ) {
							case "id":
							echo("ID"); break;
							case "ename":
							echo("英文氏名"); break;
							case "jname":
							echo("和文氏名"); break;
							case "age":
							echo("年齢"); break;
							case "gender":
							echo("性別"); break;
							default:
							echo("不明"); break;
						}
						echo("</th>");
					}
					echo("</tr>");

					for( $i = 0; $i < $m; $i++ ) {
						echo("<tr>");
						$row = pg_fetch_assoc($r, $i);

						foreach($row as $key => $value) {
							echo("<td>");
							if ( $key == "gender" ) {
								if ( $value == "t" ) {
									echo("男性");
								} else {
									echo("女性");
								}
							} else {
								echo("$value");
							}
							echo("</td>");
						}
						echo("</tr>");
					}
					echo("</table>");
				} else {
					/* 該当データがない場合の出力 */
					echo("no corresponding data with the query<br>");
				}
			} else {
				echo("Query failed<br>");
			}
			pg_close($c);
		} else {
			echo("Cannot connect to $dbname<br>");
		}
	?>
</body>
</html>