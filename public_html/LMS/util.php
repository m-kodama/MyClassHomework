<?php
	// htmlspecialchars短縮用
	function h($str) {
		return htmlspecialchars($str);
	}

	// 改行コードを改行タグに置換

	// 管理者ログインチェック
	function is_manager() {
		if(isset($_SESSION['is_manager'])) return $_SESSION['is_manager'];
		else false;
	}

	// 学習者ログインチェック
	function is_user() {
		if(isset($_SESSION['is_user'])) return $_SESSION['is_user'];
		else false;
	}

	// ログインページへ移動
	function toLoginPage() {
		$url = 'https://vega.ei.tohoku.ac.jp/~b7fm1007/LMS/login.php';
		header("Location: {$url}");
		exit;
	}

	// 授業科目ごとの学習コンテンツの総数を取得
	function loadQuestionNum() {
		// 学習コンテンツ総数の取得
		$dbname="b7fm1007";
		$c = pg_connect("dbname=$dbname");
		try {
			if($c == false) throw new Exception("データベースの接続に失敗しました。");
			// 各授業科目ごとにコンテンツ数を取得
			$query = "select course, COUNT(course) from lms_questions group by course;";
			if(!($r = pg_query($c, $query))) throw new Exception("ネットワークエラー。");
			$m = pg_num_rows($r);
			$question_num = array(
				'history' 	=> 0, 
				'economy'		=> 0, 
				'politics'	=> 0,
				'geography'	=> 0
			);
			for($i=0; $i < $m; $i++) {
				$row = pg_fetch_assoc($r, $i);
				$course = $row['course'];
				$question_num[$course] = $row['count'];
			}

		} catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
		pg_close($c);
		return $question_num;
	}

	// 正解した授業科目ごとの学習コンテンツの総数を取得
	function loadCorrectNum($user_id) {
		// 学習コンテンツ総数の取得
		$dbname="b7fm1007";
		$c = pg_connect("dbname=$dbname");
		try {
			if($c == false) throw new Exception("データベースの接続に失敗しました。");
			// 各授業科目ごとに正解済みのコンテンツ数を取得
			$query = "select lms_questions.course, COUNT(lms_questions.course) ".
							 "from (select distinct * from lms_progress) p ".
							 "inner join lms_questions on p.question_id = lms_questions.question_id ".
							 "where p.user_id = '$user_id' ".
							 "group by lms_questions.course;";
			if(!($r = pg_query($c, $query))) throw new Exception("ネットワークエラー。");
			$m = pg_num_rows($r);
			$correct_num = array(
				'history' 	=> 0, 
				'economy'		=> 0, 
				'politics'	=> 0,
				'geography'	=> 0
			);
			for($i=0; $i < $m; $i++) {
				$row = pg_fetch_assoc($r, $i);
				$course = $row['course'];
				$correct_num[$course] = $row['count'];
			}

		} catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
		pg_close($c);
		return $correct_num;
	}
?>