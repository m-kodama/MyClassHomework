<?php
	session_start();
	require_once('util.php');

	$err = [];
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// POSTされた場合
		if(isset($_POST['user_name']) && is_string($_POST['user_name']) && $_POST['user_name'] != "") {
			$user_name = addslashes(h($_POST['user_name']));
		} else {
			$err['user_name'] = "ユーザ名が入力されていません。";
		}

		if(isset($_POST['user_id']) && is_string($_POST['user_id']) && $_POST['user_id'] != "") {
			$user_id = addslashes(h($_POST['user_id']));
		} else {
			$err['user_id'] = "ログインIDが入力されていません。";
		}

		if(isset($_POST['email']) && is_string($_POST['email']) && $_POST['email'] != "") {
			$email = addslashes(h($_POST['email']));
		} else{ 
			$err['email'] = "メールアドレスが入力されていません。";
		}

		if(isset($_POST['password']) && is_string($_POST['password']) && $_POST['password'] != "") {
			$password = addslashes(h($_POST['password']));
		} else {
			$err['password'] = "パスワードが入力されていません。";
		}

		if(isset($_POST['password2']) && is_string($_POST['password2']) && $_POST['password2'] != "") {
			$password2 = addslashes(h($_POST['password2']));
		} else {
			$err['password2'] = "パスワード（確認用）が入力されていません。";
		}

		if(empty($err)) {
			// 未入力の項目がない
			// ログインIDとパスワードのエラーチェック
			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			try {
				if($c == false) throw new Exception("データベースの接続に失敗しました。");
				// パスワードと確認用パスワードが不一致じゃないかチェック
				if($password != $password2) throw new Exception("パスワードと確認用パスワードが異なります。");
				// ユーザIDが重複していないかチェック
				$query = "select * from lms_users where user_id = '$user_id';";
				if(!($r = pg_query($c, $query))) throw new Exception("ネットワークエラー。");
				$m = pg_num_rows($r);
				if($m > 0) throw new Exception("ログインIDが既に登録されています。");
				
				// lms_usersテーブルに登録
				$p = crypt($password, "jI!gMjAie%faLk");
				$query = "insert into lms_users values('$user_id','$user_name','$email','$p','f');";
				$r = pg_query($c, $query);
				if($r == false) throw new Exception("ネットワークエラー。");

				pg_close($c);
				// 新規登録完了 -> ログイン画面へ移動
				$url = 'https://vega.ei.tohoku.ac.jp/~b7fm1007/LMS/login.php';
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
	
	<title>LMS｜新規登録</title>

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
	<link type="text/css" rel="stylesheet" href="css/login.css" media="screen,projection">
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
	</head>

	<body>
	<!--Import materialize.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<main>
		<div class="container">
		<!-- Page Content goes here -->
			
			<div class="logo-wrapper">
				<a href="#">
					<img src="images/lms_logo_white.png" class="logo-icon"><br>
					<span class="logo white-text">LMS</span>
				</a>
			</div>

			<!-- ログインフォームwrapper(Card) -->
			<div id="login_card" class="row">
				<div class="col s12 m8 offset-m2">
					<div class="card-panel white">
						<h5>新規登録</h5>
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

						<form action="signup.php" method="post">
							<!-- ユーザー名 -->
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="ユーザー名" type="text" class="validate" name="user_name" value="<?php if(isset($user_name))echo(h($user_name));?>">
									<label for="email">ユーザー名</label>
								</div>
							</div>
							<!-- ログインID -->
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="login_id" type="text" class="validate" name="user_id" value="<?php if(isset($user_id))echo(h($user_id));?>">
									<label for="user_id">ログインID（英数字）</label>
								</div>
							</div>
							<!-- メールアドレス -->
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="email@xxx.xxx" type="email" class="validate" name="email" value="<?php if(isset($email))echo(h($email));?>">
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
							<!-- 新規登録ボタン -->
							<div class="row">
								<button class="btn waves-effect waves-light accentpink col s8 offset-s2" type="submit" name="action">新規登録</button>
							</div>
						</form>
						
						<!-- 新規登録のリンク -->
						<div class="link-wrapper">
							<span>既にアカウントをお持ちの場合は<br><a href="login.php">ログイン</a></span>
						</div>
				</div>
			</div>
		</div>

	</main>

	<!-- footer -->
		
	</body>
</html>

