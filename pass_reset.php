<?php
if (!empty($_GET['pass_reset_token'])) {
	$pass_reset_token = $_GET['pass_reset_token'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログイン認証ページ</title>
</head>
<body>
<p><?php echo '新しいパスワードを入力してください'; ?></p>
<form action="pass_reset_completed.php" method="post">
<input type="password" name="pass" required>*入力必須
<input type="submit" value="送信">
<input type="hidden" name="pass_reset_token" value="<?php echo $pass_reset_token; ?>">
</form>
<a href="post_board.php">キャンセル</a>
</body>
</html>
