<?php
	session_start();
	require_once('util.php');

	$err = [];
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// POSTされた場合

		if(isset($_POST['login_id']) && is_string($_POST['login_id']) && $_POST['login_id'] != "") {
			$login_id = addslashes(h($_POST['login_id']));
		} else {
			$err['login_id'] = "ログインIDが入力されていません。";
		}

		if(isset($_POST['password']) && is_string($_POST['password']) && $_POST['password'] != "") {
			$password = addslashes(h($_POST['password']));
		} else {
			$err['password'] = "パスワードが入力されていません。";
		}

		if(empty($err)) {
			// 未入力の項目がない
			// ログインIDとパスワードのエラーチェック
			$dbname="b7fm1007";
			$c = pg_connect("dbname=$dbname");
			try {
				if($c == false) throw new Exception("データベースの接続に失敗しました。");
				// ユーザIDとパスワードが該当するか問い合わせ
				$p = crypt($password, "jI!gMjAie%faLk");
				$query = "select * from lms_users where login_id = '$login_id' and passwd = '$p';";
				if(!($r = pg_query($c, $query))) throw new Exception("ネットワークエラー。");
				$m = pg_num_rows($r);
				if($m <= 0) throw new Exception("ログインIDもしくはパスワードに誤りがあります。");

				// 認証成功 -> ログイン画面へ移動
				$user = pg_fetch_assoc($r, 0);
				pg_close($c);
				$_SESSION['user_id'] = $user['user_id'];
				$_SESSION['user_name'] = $user['name'];
				if($user['is_manager'] == 't') {
					// 管理者ログイン
					$_SESSION['is_manager'] = true;
					$_SESSION['is_user'] = false;
					$url = 'https://vega.ei.tohoku.ac.jp/~b7fm1007/LMS/manage_menu.php';
				} else {
					// 学習者ログイン
					$_SESSION['is_manager'] = false;
					$_SESSION['is_user'] = true;
					$url = 'https://vega.ei.tohoku.ac.jp/~b7fm1007/LMS/user_menu.php';
				}
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
	
	<title>LMS｜ログイン</title>

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
						<h5>ログイン</h5>
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

						<form action="login.php" method="post">
							<!-- ログインID -->
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="login_id" type="text" class="validate" name="login_id" value="<?php if(isset($login_id))echo(h($login_id));?>">
									<label for="login_id">ログインID（英数字）</label>
								</div>
							</div>
							<!-- パスワード -->
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="password" type="password" class="validate" name="password">
									<label for="password">パスワード</label>
								</div>
							</div>
							<!-- ログインボタン -->
							<div class="row">
								<button class="btn waves-effect waves-light accentpink col s8 offset-s2" type="submit" name="action">ログイン</button>
							</div>
						</form>
						
						<!-- 新規登録のリンク -->
						<div class="link-wrapper">
							<span>アカウントをお持ちではないですか？<br><a href="signup.php">新規登録</a></span>
						</div>
				</div>
			</div>
		</div>

	</main>

	<!-- footer -->
		
	</body>
</html>

