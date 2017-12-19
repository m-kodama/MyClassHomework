<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>第10回 課題2</title>
	</head>
	<body>
	<?php
		/* ユーザIDとパスワードが入力済みであれば、その値を取得 */
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(!(isset($_POST['id']) && is_string($_POST['id']))) exit(0);
			if(!(isset($_POST['passwd']) && is_string($_POST['passwd']))) exit(0);
			$id 		= addslashes(htmlspecialchars($_POST['id']));
			$passwd = addslashes(htmlspecialchars($_POST['passwd']));
			/* ユーザ認証 */
			$dbname="b7fm1007";
			try {
				$c = pg_connect("dbname=$dbname");
				if($c == false) throw new Exception("データベースの接続に失敗しました");
				// ユーザIDとパスワードが該当するか問い合わせ
				$p = crypt($passwd, "jI!gMjAie%faLk");
				$query = "select * from ei_users where id = '$id' and password='$p';";
				if(!($r = pg_query($c, $query))) throw new Exception("Query failed(1).<br>");
				$m = pg_num_rows($r);
				if($m <= 0) throw new Exception("ユーザIDもしくはパスワードに誤りがあります");
				/* 認証成功時の処理 */
				$user = pg_fetch_assoc($r, 0);
				$_SESSION["id"] = $user['id'];
				$_SESSION["name"] = $user['jname'];
			} catch(Exception $e) {
				echo "<span style='color:#D32F2F;'>".$e->getMessage()."</span><br>";
				echo( "<a href=\"top-2.html\">トップページに戻る</a>" );
				exit(0);
			}
			pg_close($c);
		}
		if(!isset($_SESSION['id'])) {
			echo "<span style='color:#D32F2F;'>ログインしてください</span><br>";
			echo( "<a href=\"top-2.html\">トップページに戻る</a>" );
			exit(0);
		}
	?>
		<h1>メニューページ</h1>
		<ul>
			<li><a href="morning-2.php">朝</a></li>
			<li><a href="noon-2.php">昼</a></li>
			<li><a href="night-2.php">夜</a></li>
		</ul>
		<p><a href="top-2.html">TOPページ</a></p>
		<p><button onclick="location.href='logout.php'">ログアウト</button></p>
	</body>
</html>