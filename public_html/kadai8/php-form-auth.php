<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第8回 課題1(2)</title>
	</head>
	<body>
	<?php
		/* ユーザIDとパスワードが入力済みであれば、その値を取得 */
		if($_SERVER["REQUEST_METHOD"] != "POST") exit(0);
		if(!(isset($_POST['id']) && is_string($_POST['id']))) exit(0);
		if(!(isset($_POST['passwd']) && is_string($_POST['passwd']))) exit(0);
		$id 		= addslashes(htmlspecialchars($_POST['id']));
		$passwd = addslashes(htmlspecialchars($_POST['passwd']));
		/* ユーザ認証 */
		$dbname="b7fm1007";
		$c = pg_connect("dbname=$dbname");
		if($c == false) exit(0);
		try {
			// ユーザIDとパスワードが該当するか問い合わせ
			$p = crypt($passwd, "jI!gMjAie%faLk");
			$query = "select * from ei_users where id = '$id' and password='$p';";
			if(!($r = pg_query($c, $query))) throw new Exception("Query failed(1).<br>");
			$m = pg_num_rows($r);
			if($m <= 0) throw new Exception("ユーザIDもしくはパスワードに誤りがあります");
			/* 認証成功時の処理 */
			$user = pg_fetch_assoc($r, 0);
			echo("<span style='font-size:48px;'>こんにちは、".$user['jname']."さん。</span>");
		} catch(Exception $e) {
			echo "<span style='color:#D32F2F;'>".$e->getMessage()."</span><br>";
			echo( "Back to <a href=\"login.html\">login page</a>" );
		}
		pg_close($c);
	?>
	</body>
</html>