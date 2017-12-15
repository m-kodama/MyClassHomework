<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第9回 課題1</title>
	</head>
	<body>
		<h1>新規教材データの登録</h1>
		<form action="add-question.php" method="POST">
			<p>教材情報を入力してください。</p>
			<p>
				科目：
				<label><input type="radio" name="course" value="英語">英語</label>
				<label><input type="radio" name="course" value="数学">数学</label>
				<label><input type="radio" name="course" value="物理">物理</label>
				<label><input type="radio" name="course" value="化学">化学</label>
				<label><input type="radio" name="course" value="生物">生物</label>
				<label><input type="radio" name="course" value="政治">政治</label>
				<label><input type="radio" name="course" value="経済">経済</label>
				<label><input type="radio" name="course" value="歴史">歴史</label><br>

				問題：<br><textarea name="question" cols="90" rows="10"></textarea><br>
				正答：<input type="text" name="answer">, 解答の単位（必要な場合）：<input type="text" name="unit"><br>
				解説：<br><textarea name="comment" cols="90" rows="10"></textarea><br>
			</p>
			<p>
				<button type="reset">リセット</button> 
				<button type="submit"> 登　録 </button>
			</p><br>
		</form>
		<?php
			if($_SERVER["REQUEST_METHOD"] != "POST") exit(0);
			if(!(isset($_POST['course']) && is_string($_POST['course']))) $course 	= "";
			else $course = addslashes(htmlspecialchars($_POST['course']));
			if(!(isset($_POST['question']) && is_string($_POST['question']))) exit(0);
			if(!(isset($_POST['answer']) && is_string($_POST['answer']))) exit(0);
			if(!(isset($_POST['unit']) && is_string($_POST['unit']))) exit(0);
			if(!(isset($_POST['comment']) && is_string($_POST['comment']))) exit(0);
			$question 	= addslashes(htmlspecialchars($_POST['question']));
			$answer 		= addslashes(htmlspecialchars($_POST['answer']));
			$unit = addslashes(htmlspecialchars($_POST['unit']));
			$comment = addslashes(htmlspecialchars($_POST['comment']));

			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			if($c == false) exit(0);
			try {
				// 未入力項目のチェック
				if($course == "") throw new Exception("登録に失敗しました。科目が入力されていません。");
				if($question == "") throw new Exception("登録に失敗しました。問題が入力されていません。");
				if($answer == "") throw new Exception("登録に失敗しました。正答が入力されていません。");
				// numberの最大値を取得
				$query = "select MAX(number) from ei_questions;";
				if(!($r = pg_query($c, $query))) throw new Exception("Query failed(1).");
				$m = pg_num_rows($r);
				if($m < 0) $number = 1;
				else {
					$row = pg_fetch_assoc($r, 0);
					$number = $row["max"] + 1;
				}
				// ei_questionsテーブルに登録
				$query = "insert into ei_questions values($number,'$course','$question','$answer','$unit','$comment');";
				$r = pg_query($c, $query);
				if($r == false) throw new Exception("Query failed(2)");
				echo("<span style='color:#8BC34A;'>登録が完了しました。</span><br>");
			} catch(Exception $e) {
				echo "<span style='color:#D32F2F;'>".$e->getMessage()."</span>";
			}
			pg_close($c);
		?>
	</body>
</html>