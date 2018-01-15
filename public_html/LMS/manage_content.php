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
					<li><a href="manage_menu.html" class="black-text"><i class="material-icons left">arrow_back</i>メニューに戻る</a></li>
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

						<form action="edit_content.php" method="post">
							<!-- 授業科目 -->
							<div class="row">
								<div class="input-field col s12">
									<select>
										<option value="history"  selected>歴史</option>
										<option value="economy">経済</option>
										<option value="politics">政治</option>
										<option value="geography">地理</option>
									</select>
									<label>授業科目</label>
								</div>
							</div>
							<!-- 問題 -->
							<div class="row">
								<div class="input-field col s12">
									<textarea id="question" class="materialize-textarea"></textarea>
									<label for="question">問題</label>
								</div>
							</div>
							<!-- 正解 -->
							<div class="row">
								<div class="input-field col s12">
									<input type="text" class="validate" name="correct_answer">
									<label for="correct_answer">正解</label>
								</div>
							</div>
							<!-- 正解以外の選択肢1 -->
							<div class="row">
								<div class="input-field col s12">
									<input type="text" class="validate" name="answer1">
									<label for="answer1">正解以外の選択肢1</label>
								</div>
							</div>
							<!-- 正解以外の選択肢2 -->
							<div class="row">
								<div class="input-field col s12">
									<input type="text" class="validate" name="answer2">
									<label for="answer2">正解以外の選択肢1</label>
								</div>
							</div>
							<!-- 正解以外の選択肢3 -->
							<div class="row">
								<div class="input-field col s12">
									<input type="text" class="validate" name="answer3">
									<label for="answer3">正解以外の選択肢1</label>
								</div>
							</div>
							<!-- 保存ボタン -->
							<button class="btn waves-effect waves-light accentpink" type="submit" name="action">保存</button>
							<input type="hidden" name="question_id">
						</form>
					</div>
				</div>
			</div>

		</div>
	</main>

	<!-- footer -->
		
	</body>
</html>

