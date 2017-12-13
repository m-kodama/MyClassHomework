<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第9回 課題2</title>
		<style type="text/css">
			h3{margin-bottom: 8px;}
		</style>
	</head>
	<body>
		<h1>採点結果</h1>
		<p>
		<?php
		if($_SERVER["REQUEST_METHOD"] != "POST") exit(0);
		if(!(isset($_POST['number']) && is_numeric($_POST['number']))) exit(0);
		if(!(isset($_POST['answer']) && is_string($_POST['answer']))) exit(0);
		$number = addslashes(htmlspecialchars($_POST['number']));
		$answer = addslashes(htmlspecialchars($_POST['answer']));

		// 採点結果の判定・出力
		$dbname="b7fm1007";
		$c = pg_connect("dbname=$dbname");
		if($c == false) exit(0);
		try {
			$query = "select * from ei_questions where number = $number;";
			if(!($r = pg_query($c, $query))) throw new Exception("Query failed(2).");
			$row = pg_fetch_assoc($r, 0);
			if($answer == $row["answer"] ) {
				$result = "<b style='color:#03A9F4;'>正解</b>";
				$correctAnswer = "";
			} else {
				$result = "<b style='color:#F44336;'>不正解</b>";
				$correctAnswer = "正しい答え：".$row["answer"];
			}
			echo "<h3>問題</h3>";
			echo "[".$row["course"]."]<br>";
			echo $row["question"]."<br>";
			echo "<h3>あなたの回答</h3>";
			echo $answer.$row["unit"]." ・・・ ".$result."<br>".$correctAnswer;
			echo "<h3>解説</h3>";
			echo $row["comment"] == "" ? "なし" : $row["comment"];
		} catch(Exception $e) {
			echo "<span style='color:#D32F2F;'>".$e->getMessage()."</span>";
		}
		pg_close($c);
		?>
		</p>
		<p>
			<a href="question.php">戻る</a>
		</p>
	</body>
</html>