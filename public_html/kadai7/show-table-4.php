<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第7回 課題1(1)</title>
	</head>
	<body>
		<table border="1">
		<?php
			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			try {
				if($c == false) throw new Exception("Cannot connect to $dbname<br>");
				$query = "select * from ei_progress;";
				if(!($r = pg_query($c, $query))) throw new Exception("Query failed<br>" );
				$m = pg_num_rows($r);
				if($m <= 0) throw new Exception("no corresponding data with the query<br>" );
				$tHead = "";
				$row = pg_fetch_assoc($r, 0);
				foreach($row as $key => $value) {
					$th = "不明";
					switch( $key ) {
						case "id": 				$th = "ID"; 				break;
						case "course": 		$th = "履修登録科目";	break;
						case "progress":	$th = "進捗状況"; 		break;
						case "result":		$th = "履修結果"; 		break;
						default: 					$th = "不明"; 				break;
					}
					$tHead .= "<th>$th</th>";
				}
				echo("<tr>$tHead</tr>");

				for($i=0; $i<$m; $i++) {
					$tRow = "";
					$row = pg_fetch_assoc($r, $i);
					foreach($row as $key => $value) {
						$tRow .= "<td>$value</td>";
					}
					echo("<tr>$tRow</tr>");
				}
			} catch(Exception $e) {
				echo $e->getMessage();
			}
			pg_close($c);
		?>
		</table>
	</body>
</html>