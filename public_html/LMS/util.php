<?php
	// htmlspecialchars短縮用
	function h($str) {
		return htmlspecialchars($str);
	}

	// 管理者ログインチェック
	function is_manager() {
		if(isset($_SESSION['is_manager'])) return $_SESSION['is_manager'];
		else false;
	}

	// 学習者ログインチェック
	function is_user() {
		if(isset($_SESSION['user_id'])) return $_SESSION['user_id'];
		else false;
	}

	// ログインページへ移動
	function toLoginPage() {
		$url = 'https://vega.ei.tohoku.ac.jp/~b7fm1007/LMS/login.php';
		header("Location: {$url}");
		exit;
	}

?>