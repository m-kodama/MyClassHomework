<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第8回 課題1(1)</title>
	</head>
	<body>
		<h1>利用者情報の新規登録</h1>
		<form action="add-user.php" method="POST">
			<p>利用者情報を入力してください。</p>
			<p>
				ユーザID：<input type="text" name="id"><br>
				英文氏名：<input type="text" name="ename"><br>
				和文氏名：<input type="text" name="jname"><br>
				年齢　　：<input type="number" name="age"><br>
				性別　　：<label><input type="radio" name="gender" value="true" checked>男性</label>
								<label><input type="radio" name="gender" value="false">女性</label><br>
				パスワード：<input type="password" name="passwd"><br>
				パスワード（確認用）：<input type="password" name="passwd2">
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
			if(!(isset($_POST['passwd']) && is_string($_POST['passwd']))) exit(0);
			if(!(isset($_POST['passwd2']) && is_string($_POST['passwd2']))) exit(0);
			$id 		= addslashes(htmlspecialchars($_POST['id']));
			$ename 	= addslashes(htmlspecialchars($_POST['ename']));
			$jname 	= addslashes(htmlspecialchars($_POST['jname']));
			$age 		= addslashes(htmlspecialchars($_POST['age']));
			$gender = addslashes(htmlspecialchars($_POST['gender']));
			$passwd = addslashes(htmlspecialchars($_POST['passwd']));
			$passwd2 = addslashes(htmlspecialchars($_POST['passwd2']));

			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			if($c == false) exit(0);
			try {
				// ユーザIDが未入力になっていないかチェック
				if($id == "") throw new Exception("登録に失敗しました。ユーザIDが入力されていません。");
				// パスワードと確認用パスワードが不一致じゃないかチェック
				if($passwd != $passwd2) throw new Exception("登録に失敗しました。パスワードと確認用パスワードが異なります。");
				// ユーザIDが重複していないかチェック
				$query = "select * from ei_users where id = '$id';";
				if(!($r = pg_query($c, $query))) throw new Exception("Query failed(1).");
				$m = pg_num_rows($r);
				if($m > 0) throw new Exception("登録に失敗しました。ユーザID：".$id."は既に登録されています。");
				
				// ei_studentsテーブルに登録
				$p = crypt($passwd, "jI!gMjAie%faLk");
				$query = "insert into ei_users values('$id','$ename','$jname',$age,'$gender','$p');";
				$r = pg_query($c, $query);
				if($r == false) throw new Exception("Query failed(2)");

				echo("<span style='color:#8BC34A;'>登録が完了しました。</span>");
			} catch(Exception $e) {
				echo "<span style='color:#D32F2F;'>".$e->getMessage()."</span>";
			}
			pg_close($c);
		?>
	</body>
</html>