<?php
	session_start();
	require_once('util.php');

	// 管学習ログインチェック
	if(!is_user()) toLoginPage();

	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// POSTされた場合
		$course = addslashes(h($_POST['course']));
		$question_id = addslashes(h($_POST['question_id']));
		$answer = addslashes(h($_POST['answer']));
		$order = $_POST['order'];

	} else {
		// POST以外は学習者メニューへ移動
		$url = 'https://vega.ei.tohoku.ac.jp/~b7fm1007/LMS/user_menu.php';
		header("Location: {$url}");
		exit;
	}

	// コース名を日本語に変換
	$courseJName = "歴史";
	switch ($course) {
		case 'history': $courseJName = "歴史";
		case 'economy': $courseJName = "経済";
		case 'politics': $courseJName = "政治";
		case 'geography': $courseJName = "地理";
		default: break;
	}

	// 正解した場合はprogressテーブルを更新
	if($answer == 'correct') {
		$dbname="b7fm1007";
		$c = pg_connect("dbname=$dbname");
		try {
			if($c == false) throw new Exception("データベースの接続に失敗しました。");
				$query = "insert into lms_progress values($question_id, $user_id);";
				$r = pg_query($c, $query);
				if($r == false) throw new Exception("ネットワークエラー。");
		} catch(Exception $e) {
			echo $e->getMessage();
		}
		pg_close($c);
	}

	// 学習コンテンツ総数の取得
	$question_num = loadQuestionNum();
	$correct_num = loadCorrectNum($user_id);
	
	// 採点した問題データを取得
	$dbname="b7fm1007";
	$c = pg_connect("dbname=$dbname");
	try {
		if($c == false) throw new Exception("データベースの接続に失敗しました。");
		$query = "select * from lms_questions where question_id = $question_id limit 1;";
		if(!($r = pg_query($c, $query))) throw new Exception("ネットワークエラー。");
		$question = pg_fetch_assoc($r, 0);

	} catch(Exception $e) {
		echo $e->getMessage();
	}
	pg_close($c);
?>
<!DOCTYPE html>

<html lang="ja">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>LMS｜採点結果</title>

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
	<link type="text/css" rel="stylesheet" href="css/user_result.css" media="screen,projection">
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/user_result.js"></script>
	</head>

	<body>
	<!--Import materialize.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<header class="header-fixed">
		<nav class="white">
			<div class="nav-wrapper">
				<a class="brand-logo mainpurple-text center"><?php echo(h($courseJName));?></a>
				<ul id="nav-mobile" class="left hide-on-med-and-down">
					<li><a href="user_menu.php" class="black-text"><i class="material-icons left">arrow_back</i>メニューに戻る</a></li>
				</ul>
				<div class="progress-wrapper right black-text">
					<span class="col progress-title">学習状況</span>
					<span class="number"><?php echo(h($correct_num[$course]));?></span><span class="progress-unit"> 問</span>
					<span class="number"> / <?php echo(h($question_num[$course]));?></span><span class="progress-unit"> 問</span>
				</div>
			</div>
		</nav>
	</header>

	<main>
		<div class="container">
		<!-- Page Content goes here -->
			
			<div class="card-panel white">
				<?php if($answer == 'correct') : ?>
				<div class="result blue-text">
					<i class="material-icons left medium">sentiment_very_satisfied</i><span>正解</span>
				</div>
				<?php else : ?>
				<div class="result red-text">
					<i class="material-icons left medium">sentiment_very_dissatisfied</i><span>不正解</span>
				</div>
				<?php endif; ?>
				<h5>問題</h5>
				<p><?php echo(nl2br(h($question['question']), false));?></p>
				<div>
					<!-- 回答の選択肢（ラジオボタン） -->
					<div class="row">
						<div class="choices col s12">

							<?php
								//  4択の選択肢をランダムで表示する
								$choice = [
									'correct' => $question['correct_answer'],
									'answer1' => $question['answer1'],
									'answer2' => $question['answer2'],
									'answer3' => $question['answer3']
								];
								for($i=0; $i<4; $i++) {
									$key = addslashes(h($order[$i]));
									$checked = ($key == $answer) ? "checked" : "";
									$tag = ($key == 'correct') ? "<div class=\"chip blue white-text\">正解</div>" : "";
									echo "<div class=\"row\">";
									echo "<div class=\"col s2 m2 correct-tag\">".$tag."</div>";
									echo "<p class=\"col s12 m8\">";
									echo "<input class=\"with-gap\" name=\"answer\" type=\"radio\" id=\"choice".h($key)."\" disabled=\"disabled\" ".$checked."/>";
									echo "<label for=\"choice".h($key)."\">".h($choice[$key])."</label>";
									echo "</p>";
									echo "</div>";
								}
							?>
						</div>
					</div>
					<!-- 回答ボタン -->
					<div class="row">
						<a href="user_learn.php?c=<?php echo(h($course));?>" class="waves-effect waves-light btn accentpink col s4 offset-s4">次へ</a>
					</div>
				</div>
			</div>

		</div>
	</main>

	<!-- footer -->
		
	</body>
</html>

