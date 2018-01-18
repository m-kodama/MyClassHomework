<!DOCTYPE html>

<html lang="ja">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>LMS｜利用者情報</title>

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
	<link type="text/css" rel="stylesheet" href="css/user_profile.css" media="screen,projection">
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/user_profile.js"></script>
	</head>

	<body>
	<!--Import materialize.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<header class="header-fixed">
		<nav class="white">
			<div class="nav-wrapper">
				<a class="brand-logo mainpurple-text center">利用者情報</a>
				<ul id="nav-mobile" class="left hide-on-med-and-down">
					<li><a href="user_menu.php" class="black-text"><i class="material-icons left">arrow_back</i>メニューに戻る</a></li>
				</ul>
			</div>
		</nav>
	</header>

	<main>
		<div class="container">
		<!-- Page Content goes here -->

			<div class="card-panel white">
				<p>ユーザ名：　<span class="bold">サンプル太郎</span></p>
				<p>ログインID：　<span class="bold">sample_taro_12345</span></p>
				<p>メールアドレス：　<span class="bold">sample_taro_ei_student@ei.tohoku.ac.jp</span></p>
				<p>パスワード：　<span class="bold">*******</span></p>
				<!-- 編集ボタン -->
				<br>
				<a href="user_profile_edit.html" class="waves-effect waves-light btn accentpink">利用者情報を編集</a>
			</div>

		</div>
	</main>

	<!-- footer -->
		
	</body>
</html>

