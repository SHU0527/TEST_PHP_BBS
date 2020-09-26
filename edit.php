<?php
session_start();
if (empty($_SESSION['id'])) {
	$msg = exit('編集にはログインが必要です' . '<a href="login_form.php">ログインページへ</a>');
} else {
	$post_id = $_GET['message_id'];
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$select = "SELECT post_title, post_message, register_id FROM board_posts WHERE id = $post_id";
	$select_data = $dbh->query($select);
	$message_data = $select_data->fetch();
	if ($message_data) {
		$msg = '投稿データを取得しました';
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
<form action="post_edit.php" method="post">
<p>タイトル<input type="text" name="post_title" value="<?php echo $message_data['post_title']; ?>" required></p>
<p>本文<textarea required name="post_message"><?php echo $message_data['post_message']; ?></textarea></p>
<input type="submit" value="編集する">
<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
<a class="btn_cancel" href="post_board.php">キャンセル</a>
</form>
</body>
</html>
