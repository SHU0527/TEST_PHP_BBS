<?php
session_start();
if (empty($_SESSION['id'])) {
	$msg = '一言コメントの編集にはログインが必要です' . '<a href="login_form.php">ログインページへ</a>';
} else {
	$user_id = $_SESSION['id'];
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$select = "SELECT comments, id FROM registers WHERE id = $user_id";
	$select_data = $dbh->query($select);
	$register_data = $select_data->fetch();
	if ($_SESSION['id'] == $register_data['id']) {
		$msg = '一言コメントを編集できます';
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>投稿編集ページ</title>
</head>
<body>
<?php echo $msg; ?>
<?php if (isset($user_id)): ?>
	<form action="edit_completed.php" method="post">
	<p>一言コメント<input type="text" name="comments" value="<?php echo $register_data['comments']; ?>" required></p>
	<input type="submit" value="編集する">
	<a class="btn_cancel" href="post_board.php">キャンセル</a>
<?php endif; ?>
</form>
</body>
</html>
