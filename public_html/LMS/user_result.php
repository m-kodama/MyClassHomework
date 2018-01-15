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
				<a class="brand-logo mainpurple-text center">歴史</a>
				<ul id="nav-mobile" class="left hide-on-med-and-down">
					<li><a href="user_menu.html" class="black-text"><i class="material-icons left">arrow_back</i>メニューに戻る</a></li>
				</ul>
				<div class="progress-wrapper right black-text">
					<span class="col progress-title">学習状況</span>
					<span class="number">39</span><span class="progress-unit"> 問</span>
					<span class="number"> / 129</span><span class="progress-unit"> 問</span>
				</div>
			</div>
		</nav>
	</header>

	<main>
		<div class="container">
		<!-- Page Content goes here -->
			
			<div class="card-panel white">
				<div class="result blue-text">
					<i class="material-icons left medium">sentiment_very_satisfied</i><span>正解</span>
				</div>
				<!-- <div class="result red-text">
					<i class="material-icons left medium">sentiment_very_dissatisfied</i><span>不正解</span>
				</div> -->
				<h5>問題</h5>
				<p>関ヶ原の戦いに勝ち、江戸幕府を開いた人物の名前を答えよ。</p>
				<div>
					<!-- 回答の選択肢（ラジオボタン） -->
					<div class="row">
						<div class="choices col s12">

							<div class="row">
								<div class="col s2 m2 correct-tag"></div>
								<p class="col s12 m8">
									<input class="with-gap" name="answer" type="radio" id="choice1" disabled="disabled" checked="checked" />
									<label for="choice1">ああああああああ</label>
								</p>
							</div>

							<div class="row">
								<div class="col s2 m2 correct-tag"></div>
								<p class="col s12 m8">
									<input class="with-gap" name="answer" type="radio" id="choice1" disabled="disabled" />
									<label for="choice1">ええええええええ</label>
								</p>
							</div>

							<div class="row">
								<div class="col s2 m2 correct-tag"><div class="chip blue white-text">正解</div></div>
								<p class="col s12 m8">
									<input class="with-gap" name="answer" type="radio" id="choice1" disabled="disabled" />
									<label for="choice1">徳川家康</label>
								</p>
							</div>

							<div class="row">
								<div class="col s2 m2 correct-tag"></div>
								<p class="col s12 m8">
									<input class="with-gap" name="answer" type="radio" id="choice1" disabled="disabled" />
									<label for="choice1">おお</label>
								</p>
							</div>

						</div>
					</div>
					<!-- 回答ボタン -->
					<div class="row">
						<a href="user_learn.html?s=geo" class="waves-effect waves-light btn accentpink col s4 offset-s4">次へ</a>
					</div>
				</div>
			</div>

		</div>
	</main>

	<!-- footer -->
		
	</body>
</html>

