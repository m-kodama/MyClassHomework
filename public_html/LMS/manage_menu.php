<?php
	session_start();
	require_once('util.php');

	// 管理者ログインチェック
	if(!is_manager()) toLoginPage();

	$user_name = $_SESSION['user_name'];

	$initialCourse = "history";
	if(isset($_GET['c'])) $initialCourse = $_GET['c'];

	// 学習コンテンツの取得
	$dbname="b7fm1007";
	$c = pg_connect("dbname=$dbname");
	try {
		if($c == false) throw new Exception("データベースの接続に失敗しました。");
		// 各授業科目ごとにコンテンツを取得
		$query = "select * from lms_questions;";
		if(!($r = pg_query($c, $query))) throw new Exception("ネットワークエラー。");
		$m = pg_num_rows($r);
		$questions = array(
			'history' 	=> array(), 
			'economy'		=> array(), 
			'politics'	=> array(),
			'geography'	=> array()
		);
		$cnt = array(
			'history' 	=> 0, 
			'economy'		=> 0, 
			'politics'	=> 0,
			'geography'	=> 0
		);
		for($i=0; $i < $m; $i++) {
			$row = pg_fetch_assoc($r, $i);
			$course = $row['course'];
			$questions[$course][] = $row;
			$cnt[$course]++;
		}
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
	
	<title>LMS｜管理者メニュー</title>

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
	<link type="text/css" rel="stylesheet" href="css/manage_menu.css" media="screen,projection">
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/manage_menu.js"></script>
	</head>

	<body>
	<!--Import materialize.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<header class="header-fixed">
		<nav class="nav-extended white">
			<div class="nav-wrapper">
				<a class="brand-logo mainpurple-text"><img src="images/lms_logo.png" class="logo-icon"><span class="logo">LMS</span></a>
				<a href="#" data-activates="mobile-demo" class="button-collapse mainpurple-text"><i class="material-icons">menu</i></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a class="black-text"><i class="material-icons left">account_circle</i><?php echo(h($user_name));?></a></li>
					<li><a href="logout.php" class="mainpurple-text">ログアウト</a></li>
				</ul>
				<ul class="side-nav" id="mobile-demo">
					<li><a class="black-text"><i class="material-icons left">account_circle</i><?php echo(h($user_name));?></a></li>
					<li><a href="logout.php" class="mainpurple-text">ログアウト</a></li>
				</ul>
			</div>
			<div class="nav-content">
				<ul class="tabs tabs-transparent">
					<li class="tab"><a class="<?php if($initialCourse == "history")echo(h("active"));?>" href="#history">歴史</a></li>
					<li class="tab"><a class="<?php if($initialCourse == "economy")echo(h("active"));?>" href="#economy">経済</a></li>
					<li class="tab"><a class="<?php if($initialCourse == "politics")echo(h("active"));?>" href="#politics">政治</a></li>
					<li class="tab"><a class="<?php if($initialCourse == "geography")echo(h("active"));?>" href="#geography">地理</a></li>
				</ul>
			</div>
		</nav>
	</header>

	<main>
		<div class="container">
		<!-- Page Content goes here -->

			<!--  歴史 -->
			<div id="history" >
				<form name="manage_content" action="delete_content.php" method="post">
					<!-- タイトル・問題数・追加ボタン・削除ボタン -->
					<div class="page-title">
						<h5>学習コンテンツ</h5>
						<span class="number"><?php echo(h($cnt['history']));?></span><span> 問　　</span>
						<a class="add-content-btn waves-effect waves-light btn accentpink" data-course="history">コンテンツを追加</a>
						<button class="delete-content-btn waves-effect waves-light btn mainpurple disabled" type="submit" name="action">削除</button>
					</div>
					<!-- 学習コンテンツ一覧テーブル -->
					<div class="card-panel white content-card">
						<table class="striped">
							<thead>
								<tr>
									<th class="th-check-box"><input type="checkbox" class="filled-in" id="history-all-check-box"/><label for="history-all-check-box"></label></th>
									<th class="th-question">問題</th>
									<th class="th-correct">正解</th>
									<th class="th-edit">編集</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$i = 1;
								if(!empty($questions['history'])) {
									foreach ($questions['history'] as $key => $value) {
										echo "<tr>";
										echo "<td class=\"td-check-box\"><input type=\"checkbox\" class=\"filled-in history-check-box\" id=\"history-check-box".$i."\" name=\"ids[]\" value=\"".$value['question_id']."\"/><label for=\"history-check-box".$i."\"></label></td>";
										echo "<td>".$value['question']."</td>";
										echo "<td>".$value['correct_answer']."</td>";
										echo "<td class=\"td-edit\"><a class=\"waves-effect btn-flat accentpink-text edit-content-btn\" data-course=\"history\" data-question=\"".$value['question']."\" data-correct-answer=\"".$value['correct_answer']."\" data-answer1=\"".$value['answer1']."\" data-answer2=\"".$value['answer2']."\" data-answer3=\"".$value['answer3']."\" data-content-id=\"".$value['question_id']."\">編集</a></td>";
										echo "</tr>";
										$i++;
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</form>
			</div>

			<!--  経済 -->
			<div id="economy" >
				<form name="manage_content" action="delete_content.php" method="post">
					<!-- タイトル・問題数・追加ボタン・削除ボタン -->
					<div class="page-title">
						<h5>学習コンテンツ</h5>
						<span class="number"><?php echo(h($cnt['economy']));?></span><span> 問　　</span>
						<a class="add-content-btn waves-effect waves-light btn accentpink" data-course="economy">コンテンツを追加</a>
						<button class="delete-content-btn waves-effect waves-light btn mainpurple disabled" type="submit" name="action">削除</button>
					</div>
					<!-- 学習コンテンツ一覧テーブル -->
					<div class="card-panel white content-card">
						<table class="striped">
							<thead>
								<tr>
									<th class="th-check-box"><input type="checkbox" class="filled-in" id="economy-all-check-box"/><label for="economy-all-check-box"></label></th>
									<th class="th-question">問題</th>
									<th class="th-correct">正解</th>
									<th class="th-edit">編集</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$i = 1;
								if(!empty($questions['economy'])) {
									foreach ($questions['economy'] as $key => $value) {
										echo "<tr>";
										echo "<td class=\"td-check-box\"><input type=\"checkbox\" class=\"filled-in economy-check-box\" id=\"economy-check-box".$i."\" name=\"ids[]\" value=\"".$value['question_id']."\"/><label for=\"economy-check-box".$i."\"></label></td>";
										echo "<td>".$value['question']."</td>";
										echo "<td>".$value['correct_answer']."</td>";
										echo "<td class=\"td-edit\"><a class=\"waves-effect btn-flat accentpink-text edit-content-btn\" data-course=\"economy\" data-question=\"".$value['question']."\" data-correct-answer=\"".$value['correct_answer']."\" data-answer1=\"".$value['answer1']."\" data-answer2=\"".$value['answer2']."\" data-answer3=\"".$value['answer3']."\" data-content-id=\"".$value['question_id']."\">編集</a></td>";
										echo "</tr>";
										$i++;
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</form>
			</div>

			<!-- 政治 -->
			<div id="politics" >
				<form name="manage_content" action="delete_content.php" method="post">
					<!-- タイトル・問題数・追加ボタン・削除ボタン -->
					<div class="page-title">
						<h5>学習コンテンツ</h5>
						<span class="number"><?php echo(h($cnt['politics']));?></span><span> 問　　</span>
						<a class="add-content-btn waves-effect waves-light btn accentpink" data-course="politics">コンテンツを追加</a>
						<button class="delete-content-btn waves-effect waves-light btn mainpurple disabled" type="submit" name="action">削除</button>
					</div>
					<!-- 学習コンテンツ一覧テーブル -->
					<div class="card-panel white content-card">
						<table class="striped">
							<thead>
								<tr>
									<th class="th-check-box"><input type="checkbox" class="filled-in" id="politics-all-check-box"/><label for="politics-all-check-box"></label></th>
									<th class="th-question">問題</th>
									<th class="th-correct">正解</th>
									<th class="th-edit">編集</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$i = 1;
								if(!empty($questions['politics'])) {
									foreach ($questions['politics'] as $key => $value) {
										echo "<tr>";
										echo "<td class=\"td-check-box\"><input type=\"checkbox\" class=\"filled-in politics-check-box\" id=\"politics-check-box".$i."\" name=\"ids[]\" value=\"".$value['question_id']."\"/><label for=\"politics-check-box".$i."\"></label></td>";
										echo "<td>".$value['question']."</td>";
										echo "<td>".$value['correct_answer']."</td>";
										echo "<td class=\"td-edit\"><a class=\"waves-effect btn-flat accentpink-text edit-content-btn\" data-course=\"politics\" data-question=\"".$value['question']."\" data-correct-answer=\"".$value['correct_answer']."\" data-answer1=\"".$value['answer1']."\" data-answer2=\"".$value['answer2']."\" data-answer3=\"".$value['answer3']."\" data-content-id=\"".$value['question_id']."\">編集</a></td>";
										echo "</tr>";
										$i++;
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</form>
			</div>

			<!--  地理 -->
			<div id="geography" >
				<form name="manage_content" action="delete_content.php" method="post">
					<!-- タイトル・問題数・追加ボタン・削除ボタン -->
					<div class="page-title">
						<h5>学習コンテンツ</h5>
						<span class="number"><?php echo(h($cnt['geography']));?></span><span> 問　　</span>
						<a class="add-content-btn waves-effect waves-light btn accentpink" data-course="geography">コンテンツを追加</a>
						<button class="delete-content-btn waves-effect waves-light btn mainpurple disabled" type="submit" name="action">削除</button>
					</div>
					<!-- 学習コンテンツ一覧テーブル -->
					<div class="card-panel white content-card">
						<table class="striped">
							<thead>
								<tr>
									<th class="th-check-box"><input type="checkbox" class="filled-in" id="geography-all-check-box"/><label for="geography-all-check-box"></label></th>
									<th class="th-question">問題</th>
									<th class="th-correct">正解</th>
									<th class="th-edit">編集</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$i = 1;
								if(!empty($questions['geography'])) {
									foreach ($questions['geography'] as $key => $value) {
										echo "<tr>";
										echo "<td class=\"td-check-box\"><input type=\"checkbox\" class=\"filled-in geography-check-box\" id=\"geography-check-box".$i."\" name=\"ids[]\" value=\"".$value['question_id']."\"/><label for=\"geography-check-box".$i."\"></label></td>";
										echo "<td>".$value['question']."</td>";
										echo "<td>".$value['correct_answer']."</td>";
										echo "<td class=\"td-edit\"><a class=\"waves-effect btn-flat accentpink-text edit-content-btn\" data-course=\"geography\" data-question=\"".$value['question']."\" data-correct-answer=\"".$value['correct_answer']."\" data-answer1=\"".$value['answer1']."\" data-answer2=\"".$value['answer2']."\" data-answer3=\"".$value['answer3']."\" data-content-id=\"".$value['question_id']."\">編集</a></td>";
										echo "</tr>";
										$i++;
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</form>
			</div>
	
			<!-- 追加・編集用のフォーム -->
			<form name="manage_content" action="manage_content.php" method="post">
				<input type="hidden" name="course" value="">
				<input type="hidden" name="question" value="">
				<input type="hidden" name="correct_answer" value="">
				<input type="hidden" name="answer1" value="">
				<input type="hidden" name="answer2" value="">
				<input type="hidden" name="answer3" value="">
				<input type="hidden" name="question_id" value="0">
				<input type="hidden" name="from_menu" value="true">
			</form>
	</main>

	<!-- footer -->
		
	</body>
</html>

