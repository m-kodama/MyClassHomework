<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第7回 課題2</title>
		<style type="text/css">
			caption {
				font-size:0.9em;
			}
		</style>
	</head>
	<body>
		<h1>学生情報の新規登録</h1>
		<form action="add-student.php" method="POST">
			<p>学籍情報を入力してください。</p>
			<p>
				学籍番号：<input type="text" name="id"><br>
				英文氏名：<input type="text" name="ename"><br>
				和文氏名：<input type="text" name="jname"><br>
				年齢　　：<input type="number" name="age"><br>
				性別　　：<label><input type="radio" name="gender" value="t" checked>男性</label>
								<label><input type="radio" name="gender" value="f">女性</label>
			</p>
			<p>
				履修科目：<br>
				<label><input type="checkbox" name="course[]" value="英語">英語</label>
				<label><input type="checkbox" name="course[]" value="数学">数学</label>
				<label><input type="checkbox" name="course[]" value="物理">物理</label>
				<label><input type="checkbox" name="course[]" value="化学">化学</label><br>
				<label><input type="checkbox" name="course[]" value="生物">生物</label>
				<label><input type="checkbox" name="course[]" value="政治">政治</label>
				<label><input type="checkbox" name="course[]" value="経済">経済</label>
				<label><input type="checkbox" name="course[]" value="歴史">歴史</label><br>
			</p>
			<p>
				<button type="reset">リセット</button> 
				<button type="submit"> 登　録 </button>
			</p><br>
		</form>
		<?php
			if($_SERVER["REQUEST_METHOD"] != "POST") exit(0);
			if(!(isset($_POST['id']) && is_string($_POST['id']))) exit(0);
			if(!(isset($_POST['ename']) && is_string($_POST['ename']))) exit(0);
			if(!(isset($_POST['jname']) && is_string($_POST['jname']))) exit(0);
			if(!(isset($_POST['age']) && is_numeric($_POST['age']))) exit(0);
			if(!(isset($_POST['gender']) && is_string($_POST['gender']))) exit(0);
			if(!(isset($_POST['course']) && is_array($_POST['course']))) exit(0);
			if(!(isset($_POST['course'][0]) && is_string($_POST['course'][0]))) exit(0);
			$id 		= addslashes(htmlspecialchars($_POST['id']));
			$ename 	= addslashes(htmlspecialchars($_POST['ename']));
			$jname 	= addslashes(htmlspecialchars($_POST['jname']));
			$age 		= addslashes(htmlspecialchars($_POST['age']));
			$gender = addslashes(htmlspecialchars($_POST['gender']));
			$course = $_POST['course'];

			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			if($c == false) exit(0);
			try {
				// 学籍番号が重複していないかチェック
				$query = "select * from ei_students where id = '$id';";
				if(!($r = pg_query($c, $query))) throw new Exception("Query failed<br>" );
				if($m > 0) throw new Exception("学籍番号".$id."の学生は既に登録されています。<br>");
				
				// ei_studentsテーブルに登録
				$query = "insert into ei_students values('$id','$ename','$jname',$age,'$gender');";
				$r = pg_query($c, $query);
				if($r == false) throw new Exception("Query failed<br>");

				// ei_progressテーブルに登録
				$query = "insert into ei_progress(id,course,progress,result) values ";
				$n = count($course);
				for($i=0; $i<$n; $i++) {
					if(is_string($course[$i])) {
						$value = addslashes(htmlspecialchars($course[$i]));
						$query .= "('$id','$value',0,null)";
						$query .= ($i!=($n-1)) ? ", " : ";";
					}
				}
				$r = pg_query($c, $query);
				if($r == false) throw new Exception("Query failed<br>");

				echo("学籍番号".$id."の学生を登録しました。<br>");
			} catch(Exception $e) {
				echo $e->getMessage();
			}
			pg_close($c);
		?>
	</body>
</html>