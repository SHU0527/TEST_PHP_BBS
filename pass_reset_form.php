<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>パスワードリセット用メール送信フォーム</title>
</head>
<body>
<h2>登録メールアドレス送信フォーム</h2>
<p>
恐れ入りますが、登録されたメールアドレスをご入力頂き<br>
受信されたメールの案内に従ってパスワードの再設定をお願い致します。
</p>
<form action="mail_confirmation.php" method="post">
登録しているメールアドレス<input type="email" name="mail" required>
<input type="submit" value="送信">
<a href="post_board.php">キャンセル</a>
</form>
</body>
</html>
