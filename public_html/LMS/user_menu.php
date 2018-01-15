<!DOCTYPE html>

<html lang="ja">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>LMS｜学習者メニュー</title>

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
	<link type="text/css" rel="stylesheet" href="css/user_menu.css" media="screen,projection">
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/user_menu.js"></script>
	</head>

	<body>
	<!--Import materialize.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<header class="header-fixed">
		<nav class="white">
			<div class="nav-wrapper">
				<a class="brand-logo mainpurple-text"><img src="images/lms_logo.png" class="logo-icon"><span class="logo">LMS</span></a>
				<a href="#" data-activates="mobile-demo" class="button-collapse mainpurple-text"><i class="material-icons">menu</i></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="user_profile.html" class="black-text"><i class="material-icons left">account_circle</i>サンプル管理者</a></li>
					<li><a href="logout.php" class="mainpurple-text">ログアウト</a></li>
				</ul>
				<ul class="side-nav" id="mobile-demo">
					<li><a href="user_profile.html" class="black-text"><i class="material-icons left">account_circle</i>サンプル管理者</a></li>
					<li><a href="logout.php" class="mainpurple-text">ログアウト</a></li>
				</ul>
			</div>
		</nav>
	</header>

	<main>
		<div class="container">
		<!-- Page Content goes here -->
			<!-- 学習ページへのリンク -->
			<!-- 歴史 -->
			<div class="card-panel white content-card">
				<h5>歴史</h5>
				<span class="col progress-title">学習状況</span>
				<span class="number">39</span><span class="progress-unit"> 問</span>
				<span class="number"> / 129</span><span class="progress-unit"> 問</span>
				<a href="user_learn.html?s=hist" class="waves-effect waves-light btn accentpink">学習開始</a>
			</div>
			<!-- 経済 -->
			<div class="card-panel white content-card">
				<h5>経済</h5>
				<span class="col progress-title">学習状況</span>
				<span class="number">39</span><span class="progress-unit"> 問</span>
				<span class="number"> / 129</span><span class="progress-unit"> 問</span>
				<a href="user_learn.html?s=eco" class="waves-effect waves-light btn accentpink">学習開始</a>
			</div>
			<!-- 政治 -->
			<div class="card-panel white content-card">
				<h5>政治</h5>
				<span class="col progress-title">学習状況</span>
				<span class="number">39</span><span class="progress-unit"> 問</span>
				<span class="number"> / 129</span><span class="progress-unit"> 問</span>
				<a href="user_learn.html?s=pli" class="waves-effect waves-light btn accentpink">学習開始</a>
			</div>
			<!-- 地理 -->
			<div class="card-panel white content-card">
				<h5>地理</h5>
				<span class="col progress-title">学習状況</span>
				<span class="number">39</span><span class="progress-unit"> 問</span>
				<span class="number"> / 129</span><span class="progress-unit"> 問</span>
				<a href="user_learn.html?s=geo" class="waves-effect waves-light btn accentpink">学習開始</a>
			</div>
		</div>
	</main>

	<!-- footer -->
		
	</body>
</html>

