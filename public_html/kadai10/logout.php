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
	/* 全てのセッション変数の値の消去 */
	$_SESSION = array();
	/* Webブラウザ上のクッキーに登録されているセッションIDの破棄 */
	if( isset( $_COOKIE[session_name()] ) ) {
	  setcookie(session_name(), '', time()-42000, '/');
	}
	/* Webサーバ上でのセッション管理用セッションIDの無効化 */
	session_destroy();
	echo( "<h1>システムからログアウトしました</h1>" );
	?>
	<p><a href="top-2.html">ログイン画面に戻る</a></p>
	</body>
</html>