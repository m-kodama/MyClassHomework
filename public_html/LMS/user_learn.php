<?php
	session_start();
	require_once('util.php');

	// 管学習ログインチェック
	if(!is_user()) toLoginPage();

	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];

	$course = "history";
	if($_SERVER["REQUEST_METHOD"] == "GET") {
		// GETされた場合
		if(isset($_GET['c'])) $course = $_GET['c'];
		// 授業科目が正しくない場合は強制的にhistoryにする
		if($course != "history" && $course != "economy" && $course != "politics" && $course != "geography") $course = "history";
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

	// 学習コンテンツ総数の取得
	$question_num = loadQuestionNum();
	$correct_num = loadCorrectNum($user_id);

	// 正解していない問題がないあるかどうか判定
	$disabled = array();
	$can_learn = ($question_num[$course] == $correct_num[$course]) ? false : true;

	$question = [];
	if($can_learn) {
		// まだ正解していない問題を取得
		$dbname="b7fm1007";
		$c = pg_connect("dbname=$dbname");
		try {
			if($c == false) throw new Exception("データベースの接続に失敗しました。");
			$query = "select lms_questions.question_id,  lms_questions.course, lms_questions.question, lms_questions.correct_answer, ".
							 "lms_questions.answer1, lms_questions.answer2, lms_questions.answer3 ".
							 "from lms_questions ".
							 "left join (select distinct * from lms_progress where user_id = $user_id) p ".
							 "on lms_questions.question_id = p.question_id ".
							 "where p.question_id is null and lms_questions.course = '$course';";
			if(!($r = pg_query($c, $query))) throw new Exception("ネットワークエラー。");
			$m = pg_num_rows($r);
			if($m <= 0) $can_learn = false;
			// 出題する問題をランダムで一つ取得
			$randomIndex = mt_rand(0, $m-1);
			$question = pg_fetch_assoc($r, $randomIndex);

		} catch(Exception $e) {
			echo $e->getMessage();
		}
		pg_close($c);
	}
?>
<!DOCTYPE html>

<html lang="ja">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>LMS｜学習</title>

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
	<link type="text/css" rel="stylesheet" href="css/user_learn.css" media="screen,projection">
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/user_learn.js"></script>
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
			
			<!-- 未正解の問題がある場合 -->
			<?php if($can_learn) : ?>
			<div class="card-panel white">
				<h5>問題</h5>
				<p><?php echo(nl2br(h($question['question']), false));?></p>
				<div>
					<form action="user_result.php" method="post">
						<!-- 回答の選択肢（ラジオボタン） -->
						<div class="row">
							<div class="choices col s12 m8 offset-m2">
								<?php
									//  4択の選択肢をランダムで表示する
									$choice = [
										'correct' => $question['correct_answer'],
										'answer1' => $question['answer1'],
										'answer2' => $question['answer2'],
										'answer3' => $question['answer3']
									];
									$keys = array_keys($choice);
									shuffle($keys);
									for($i=0; $i<4; $i++) {
										$key = $keys[$i];
										echo "<p>";
										echo "<input class=\"with-gap\" name=\"answer\" type=\"radio\" id=\"choice".h($key)."\" value=\"".h($key)."\" />";
										echo "<label for=\"choice".h($key)."\">".h($choice[$key])."</label>";
										echo "</p>";	
									}
									// 4択の並び順をpostする
									for($i=0; $i<4; $i++) {
										$key = $keys[$i];
										echo "<input type=\"hidden\"/ name=\"order[]\" value=\"".h($key)."\">";
									}
								?>
							</div>
						</div>
						<!-- 回答ボタン -->
						<div class="row">
							<button class="answer-btn btn waves-effect waves-light accentpink col s4 offset-s4 disabled" type="submit" name="action">回答</button>
						</div>
						<input type="hidden" name="course" value="<?php echo(h($question['course']));?>">
						<input type="hidden" name="question_id" value="<?php echo(h($question['question_id']));?>">
					</form>
				</div>
			</div>
			<?php else : ?>
			<!-- 未正解の問題がない場合 -->
			<div class="empty-states">
				<p class="flow-text">この科目の問題は全て正解しています</p>
				<div class="empty-image"></div>
				<a href="user_menu.php" class="waves-effect waves-light btn accentpink center">他の科目を学習する</a>
			</div>
			<?php endif; ?>

		</div>
	</main>

	<!-- footer -->
		
	</body>
</html>
