<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第7回 課題1(2)</title>
		<style type="text/css">
			caption {
				font-size:0.9em;
			}
		</style>
	</head>
	<body>
		<h1>学生情報の検索</h1>
		<p>学籍番号を入力してください。</p>
		<form action="search-student.php" method="POST">
			<p><input type="text" name="student_id"></p>
			<p>
				<button type="reset">リセット</button> 
				<button type="submit"> 検　索 </button>
			</p>
		</form>
		<?php
			if($_SERVER["REQUEST_METHOD"] != "POST") exit(0);
			if(!(isset($_POST['student_id']))) exit(0);
			if(!(is_string($_POST['student_id']))) exit(0);
			$id = htmlspecialchars($_POST['student_id']);

			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			if($c == false) exit(0);
			try {
				// 学籍番号: x0yy1111の基本情報
				$query = "select ename,jname,age,gender from ei_students ".
									"where id = '$id';";
				if(!($r = pg_query($c, $query))) throw new Exception("Query failed<br>" );
				$m = pg_num_rows($r);
				if($m <= 0) throw new Exception("学籍番号が".$id."の学生は現在登録されていません。<br>" );
				echo("<table border='1'>");
				echo("<caption>学籍番号： ".$id."の基本情報</caption>");
				$tHead = "";
				$row = pg_fetch_assoc($r, 0);
				foreach($row as $key => $value) {
					$th = "不明";
					switch( $key ) {
						case "ename": 	$th = "英文氏名";		break;
						case "jname":		$th = "和文氏名"; 	break;
						case "age":			$th = "年齢"; 			break;
						case "gender":	$th = "性別"; 			break;
						default: 				$th = "不明"; 			break;
					}
					$tHead .= "<th>$th</th>";
				}
				echo("<tr>$tHead</tr>");
				for($i=0; $i<$m; $i++) {
					$tRow = "";
					$row = pg_fetch_assoc($r, $i);
					foreach($row as $key => $value) {
						$td = "";
						if($key == "gender") $td = $value ? "男性" : "女性";
						else $td = $value;
						$tRow .= "<td>$td</td>";
					}
					echo("<tr>$tRow</tr>");
				}
				echo("</table><br>");

				// 学籍番号: x0yy1111の受講状況
				$query = "select course,progress,result from ei_progress ".
									"where id = '$id';";
				if(!($r = pg_query($c, $query))) throw new Exception("Query failed<br>" );
				$m = pg_num_rows($r);
				if($m <= 0) throw new Exception("学籍番号が".$id."の学生は何も受講していません。<br>" );
				echo("<table border='1'>");
				echo("<caption>学籍番号： ".$id."の受講状況</caption>");
				$tHead = "";
				$row = pg_fetch_assoc($r, 0);
				foreach($row as $key => $value) {
					$th = "不明";
					switch( $key ) {
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
				echo("</table>");
			} catch(Exception $e) {
				echo $e->getMessage();
			}
			pg_close($c);
		?>
		</table>
	</body>
</html>