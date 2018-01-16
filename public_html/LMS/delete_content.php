<?php
	session_start();
	require_once('util.php');

	// 管理者ログインチェック
	if(!is_manager()) toLoginPage();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// POSTされた場合

		if(isset($_POST['course']) && is_string($_POST['course']) && $_POST['course'] != "") {
			$course = addslashes(h($_POST['course']));
		}

		$message = "dn";

		if(isset($_POST['ids']) && is_array($_POST['ids'])) {

			$ids = $_POST['ids'];

			$message = "ds";

			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			try {
				if($c == false) throw new Exception("データベースの接続に失敗しました。");
				foreach ($ids as $key => $value) {
					if(is_string($value)) {
						$id = addslashes(h($value));
						$query = "delete from lms_questions where question_id = ".$id.";";
						$r = pg_query($c, $query);
						if($r == false) throw new Exception("ネットワークエラー。");
					}
				}
			} catch(Exception $e) {
				$message = "df";
			}

		}

		// manage_menuページへ移動
		$url = 'https://vega.ei.tohoku.ac.jp/~b7fm1007/LMS/manage_menu.php?c='.$course."&m=".$message;
		header("Location: {$url}");
		exit;

	}

?>