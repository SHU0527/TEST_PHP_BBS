<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>入力フォーム</title>
</head>
<body>
<h2>メールアドレスとパスワードを入力してログインしてください</h2>
<form action="session.php" method="post">
<p>メールアドレス<input type="email" name="mail" required>*入力必須</p>
<p>パスワード<input type="password" name="pass" required>*入力必須</p>
<input type="submit" value="送信">
<a href="post_board.php">投稿一覧へ</a>
</form>
</body>
</html>
