<?php
	$students = [
		'1' => '田中タカシ',
		'2' => '吉田ヨシオ',
		'3' => '佐藤サトシ'
	];
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// フォームからPOSTによって要求された場合のみ面積を計算する
		if(isset($_POST['id']) && is_numeric($_POST['id'])) {
			$id = htmlspecialchars($_POST['id']);
			if(isset($students[$id])) {
				$name = $students[$id];
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第4回 課題1(4)</title>
	</head>
	<body>
		<form action="student-info.php" method="POST">
			学籍番号：<input type="number" name="id" value=""><br>
			<input type="submit" name="enter" value="検索">
		</form>
		<?php 
			if(isset($name)) echo("学籍番号".$id."の学生は".$name."です");
			else if(isset($id)) echo("学籍番号".$id."の学生は在籍していません");
		?>
	</body>
</html>