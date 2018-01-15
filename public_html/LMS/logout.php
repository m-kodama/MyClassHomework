<?php
	session_start();
	/* 全てのセッション変数の値の消去 */
	$_SESSION = array();
	/* Webブラウザ上のクッキーに登録されているセッションIDの破棄 */
	if( isset( $_COOKIE[session_name()] ) ) {
	  setcookie(session_name(), '', time()-42000, '/');
	}
	/* Webサーバ上でのセッション管理用セッションIDの無効化 */
	session_destroy();
?>