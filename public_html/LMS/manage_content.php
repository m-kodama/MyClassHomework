<?php
	session_start();
	require_once('util.php');

	// 管理者ログインチェック
	if(!is_manager()) toLoginPage();

	$err = [];
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// POSTされた場合

		// 授業科目
		if(isset($_POST['course']) && is_string($_POST['course']) && $_POST['course'] != "") {
			$course = addslashes(h($_POST['course']));
		} else {
			$err['course'] = "授業科目が選択されていません。";
		}

		// 問題
		if(isset($_POST['question']) && is_string($_POST['question']) && $_POST['question'] != "") {
			$question = addslashes(h($_POST['question']));
		} else {
			$err['question'] = "問題が入力されていません。";
		}

		// 正解
		if(isset($_POST['correct_answer']) && is_string($_POST['correct_answer']) && $_POST['correct_answer'] != "") {
			$correct_answer = addslashes(h($_POST['correct_answer']));
		} else{ 
			$err['correct_answer'] = "正解が入力されていません。";
		}

		// 正解以外の選択肢1
		if(isset($_POST['answer1']) && is_string($_POST['answer1']) && $_POST['answer1'] != "") {
			$answer1 = addslashes(h($_POST['answer1']));
		} else {
			$err['answer1'] = "正解以外の選択肢1が入力されていません。";
		}

		// 正解以外の選択肢2
		if(isset($_POST['answer2']) && is_string($_POST['answer2']) && $_POST['answer2'] != "") {
			$answer2 = addslashes(h($_POST['answer2']));
		} else {
			$err['answer2'] = "正解以外の選択肢2が入力されていません。";
		}

		// 正解以外の選択肢3
		if(isset($_POST['answer3']) && is_string($_POST['answer3']) && $_POST['answer3'] != "") {
			$answer3 = addslashes(h($_POST['answer3']));
		} else {
			$err['answer3'] = "正解以外の選択肢3が入力されていません。";
		}

		// 問題ID(新規作成の場合はid=0)
		if(isset($_POST['question_id']) && is_string($_POST['question_id']) && $_POST['question_id'] != "") {
			$question_id = addslashes(h($_POST['question_id']));
		} else {
			$question_id = 0;
		}

		if(isset($_POST['from_menu'])) {
			// メニューからPOSTされている場合はエラーを消去
			$err = []; 

		}
		else if(empty($err)) {
			// メニュー画面から来ていない且つ未入力の項目がない
			// 学習コンテンツの追加または修正
			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			try {
				if($c == false) throw new Exception("データベースの接続に失敗しました。");
				if($question_id == 0) {
					// 追加
					// question_idの最大値を取得
					$query = "select MAX(question_id) from lms_questions;";
					if(!($r = pg_query($c, $query))) throw new Exception("ネットワークエラー。");
					$m = pg_num_rows($r);
					if($m < 0) $number = 1;
					else {
						$row = pg_fetch_assoc($r, 0);
						$number = $row["max"] + 1;
					}
					// lms_questionsテーブルに登録
					$query = "insert into lms_questions values($number,'$course','$question','$correct_answer','$answer1','$answer2', '$answer3');";
					$r = pg_query($c, $query);
					if($r == false) throw new Exception("ネットワークエラー。");
				} else {
					// 修正
					$query = "update lms_questions set course = '$course', question = '$question', correct_answer = '$correct_answer', answer1 = '$answer1', answer2 = '$answer2', answer3 = '$answer3' where question_id = $question_id;";
					$r = pg_query($c, $query);
					if($r == false) throw new Exception("ネットワークエラー。");
				}

				// manage_menuページへ移動
				$url = 'https://vega.ei.tohoku.ac.jp/~b7fm1007/LMS/manage_menu.php?c='.$course;
				header("Location: {$url}");
				exit;

			} catch(Exception $e) {
				$err["db"] = $e->getMessage();
			}
			pg_close($c);
		} 

	} else {
		// POST以外のアクセス

	}

?>
<!DOCTYPE html>

<html lang="ja">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>LMS｜学習コンテンツ</title>

	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css #カスタマイズしているのでCDNは使わない-->
	<link type="text/css" rel="stylesheet" href= "css/materialize.css"  media="screen,projection"/>

	<!-- Import jQuery before Materialize.js-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	<!-- Import noto-font-->
	<link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet" />

	<!-- Load my css file and js file -->
	<link type="text/css" rel="stylesheet" href="css/common.css" media="screen,projection">
	<link type="text/css" rel="stylesheet" href="css/manage_content.css" media="screen,projection">
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/manage_content.js"></script>
	</head>

	<body>
	<!--Import materialize.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<header class="header-fixed">
		<nav class="white">
			<div class="nav-wrapper">
				<a class="brand-logo mainpurple-text center">学習コンテンツ</a>
				<ul id="nav-mobile" class="left hide-on-med-and-down">
					<li><a href="manage_menu.php" class="black-text"><i class="material-icons left">arrow_back</i>メニューに戻る</a></li>
				</ul>
			</div>
		</nav>
	</header>

	<main>
		<div class="container">
		<!-- Page Content goes here -->
			<!-- ログインフォームwrapper(Card) -->
			<div id="login_card" class="row">
				<div class="col s12">
					<div class="card-panel white">
						<?php
						// 入力エラー表示
							if(!empty($err)) {
								echo('<div class="err-wrapper red lighten-5">');
								foreach ($err as $key => $value) {
									echo( h($value)."<br>" );
								}
								echo('</div>');
							}
						?>
						<form action="manage_content.php" method="post">
							<!-- 授業科目 -->
							<div class="row">
								<div class="input-field col s12">
									<select name="course">
										<option value="history" <?php if(isset($course) && $course == "history") echo(h("selected")); ?>>歴史</option>
										<option value="economy" <?php if(isset($course) && $course == "economy") echo(h("selected")); ?>>経済</option>
										<option value="politics" <?php if(isset($course) && $course == "politics") echo(h("selected")); ?>>政治</option>
										<option value="geography" <?php if(isset($course) && $course == "geography") echo(h("selected")); ?>>地理</option>
									</select>
									<label>授業科目</label>
								</div>
							</div>
							<!-- 問題 -->
							<div class="row">
								<div class="input-field col s12">
									<textarea id="question" class="materialize-textarea" name="question"><?php if(isset($question))echo(h($question));?></textarea>
									<label for="question">問題</label>
								</div>
							</div>
							<!-- 正解 -->
							<div class="row">
								<div class="input-field col s12">
									<input type="text" class="validate" name="correct_answer" value="<?php if(isset($correct_answer))echo(h($correct_answer));?>">
									<label for="correct_answer">正解</label>
								</div>
							</div>
							<!-- 正解以外の選択肢1 -->
							<div class="row">
								<div class="input-field col s12">
									<input type="text" class="validate" name="answer1" value="<?php if(isset($answer1))echo(h($answer1));?>">
									<label for="answer1">正解以外の選択肢1</label>
								</div>
							</div>
							<!-- 正解以外の選択肢2 -->
							<div class="row">
								<div class="input-field col s12">
									<input type="text" class="validate" name="answer2" value="<?php if(isset($answer2))echo(h($answer2));?>">
									<label for="answer2">正解以外の選択肢2</label>
								</div>
							</div>
							<!-- 正解以外の選択肢3 -->
							<div class="row">
								<div class="input-field col s12">
									<input type="text" class="validate" name="answer3" value="<?php if(isset($answer3))echo(h($answer3));?>">
									<label for="answer3">正解以外の選択肢3</label>
								</div>
							</div>
							<!-- 保存ボタン -->
							<button class="btn waves-effect waves-light accentpink" type="submit" name="action">保存</button>
							<input type="hidden" name="question_id" value="<?php echo(h($question_id)); ?>">
						</form>
					</div>
				</div>
			</div>

		</div>
	</main>

	<!-- footer -->
		
	</body>
</html>

