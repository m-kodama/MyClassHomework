<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第9回 課題2</title>
	</head>
	<body>
		<h1>問題</h1>
		<form action="answer.php" method="POST">
			<?php
			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			if($c == false) exit(0);
			try {
				// 問題データ取得
				$query = "select number, course, question, unit from ei_questions;";
				if(!($r = pg_query($c, $query))) throw new Exception("Query failed(1).");
				$m = pg_num_rows($r);
				if($m < 0) throw new Exception("問題が登録されていません。");;
				// 出題する問題をランダムで一つ取得
				$randomIndex = mt_rand(1, $m);
				$row = pg_fetch_assoc($r, $randomIndex);
				// 出題
				echo "<p>[".$row["course"]."]<br>";
				echo $row["question"]."<br><br>";
				echo "答え：<input type=\"text\" name=\"answer\" size=\"50\">$unit";
				echo "<input type=\"hidden\" name=\"number\" value=\"".$row["number"]."\"></p>";
			} catch(Exception $e) {
				echo "<span style='color:#D32F2F;'>".$e->getMessage()."</span>";
			}
			pg_close($c);
			?>
			<p>
				<button type="reset">リセット</button> 
				<button type="submit"> 採  点 </button>
			</p>
		</form>
	</body>
</html>