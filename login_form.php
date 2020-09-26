<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログインフォーム</title>
</head>
<body>
<form action="session.php" method="post">
<div>
<label>メールアドレス</label>
<input type="email" name="mail" required>*入力必須
</div>
<div>
<label>パスワード</label>
<input type="password" name="pass" required>*入力必須
</div>
<input type="submit" value="ログイン">
<a href="post_board.php">投稿一覧へ</a><br>
<a href="pass_reset_form.php">パスワードを忘れた方はこちらへ</a>
</body>
</form>
</html>
