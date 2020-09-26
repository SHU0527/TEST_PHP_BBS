<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>新規会員登録画面</title>
</head>
<form action="register.php" method="post">
<p>名前<input type="text" name="name" required>*入力必須</p>
<p>メールアドレス<input type="email" name="mail" required>*入力必須</p>
<p>一言コメント<input type="text" name="comments" required>*入力必須</p>
<p>パスワード<input type="password" name="pass" required>*入力必須</p>
<input type="submit" value="新規登録">
<a href="post_board.php">投稿一覧へ</a>
</form>
</body>
</html>

