<?php
session_start();
if (empty($_SESSION['id'])) {
	$msg = exit('削除するにはログインが必要です' . '<a href="login_form.php">ログインページへ</a>');
} elseif (empty($_POST['post_title']) && empty($_POST['post_message']) && empty($_POST['post_id'])) {
	$msg = '削除のリンクを押してから削除してください';
} else {
	$post_id = $_POST['post_id'];
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$select = "SELECT register_id FROM board_posts WHERE id = $post_id";
	$select_data = $dbh->query($select);
	$message_data = $select_data->fetch();
	if ($_SESSION['id'] == $message_data['register_id']) {
		$delete_post = "UPDATE board_posts SET deleted_flag = 1 WHERE id = $post_id";
		$delete_data = $dbh->query($delete_post);
		$msg = '投稿を削除しました';
	} else {
		$msg = '投稿の削除に失敗しました';
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>投稿編集完了ページ</title>
</head>
<body>
<?php echo $msg; ?>
<a href="post_board.php">投稿一覧へ</a>
</body>
</html>
