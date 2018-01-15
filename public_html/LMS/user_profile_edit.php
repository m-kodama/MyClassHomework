<!DOCTYPE html>

<html lang="ja">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>LMS｜利用者情報の編集</title>

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
	<link type="text/css" rel="stylesheet" href="css/user_profile_edit.css" media="screen,projection">
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/user_profile_edit.js"></script>
	</head>

	<body>
	<!--Import materialize.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<header class="header-fixed">
		<nav class="white">
			<div class="nav-wrapper">
				<a class="brand-logo mainpurple-text center">利用者情報</a>
				<ul id="nav-mobile" class="left hide-on-med-and-down">
					<li><a href="user_menu.html" class="black-text"><i class="material-icons left">arrow_back</i>メニューに戻る</a></li>
				</ul>
			</div>
		</nav>
	</header>

	<main>
		<div class="container">
			<!-- Page Content goes here -->

			<div class="card-panel white">
				<form action="edit_user.php" method="post">
					<!-- ユーザー名 -->
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="ユーザー名" type="text" class="validate" name="user_name">
							<label for="email">ユーザー名</label>
						</div>
					</div>
					<!-- ログインID -->
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="login_id" type="text" class="validate" name="login_id">
							<label for="email">ログインID（英数字）</label>
						</div>
					</div>
					<!-- メールアドレス -->
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="email@xxx.xxx" type="email" class="validate" name="email">
							<label for="email" data-error="wrong">メールアドレス</label>
						</div>
					</div>
					<!-- パスワード -->
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="password" type="password" class="validate" name="password">
							<label for="password">パスワード</label>
						</div>
					</div>
					<!-- パスワード（確認用） -->
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="password" type="password" class="validate" name="password2">
							<label for="password">パスワード（確認用）</label>
						</div>
					</div>
					<!-- 保存ボタン -->
					<div class="row">
						<button class="btn waves-effect waves-light accentpink" type="submit" name="action">保存</button>
					</div>
				</form>
			</div>

		</div>
	</main>

	<!-- footer -->
		
	</body>
</html>

