<?php
session_start();
if (empty($_SESSION['id'])) {
	$msg = exit('削除するにはログインが必要です' . '<a href="login_form.php">ログインページへ</a>');
} else {
	$post_id = $_GET['message_id'];
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$select = "SELECT post_title, post_message, register_id FROM board_posts WHERE id = $post_id";
	$select_data = $dbh->query($select);
	$message_data = $select_data->fetch();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>投稿削除ページ</title>
</head>
<body>
<h1>大学受験掲示板（投稿の削除)</h1>
<p>以下の投稿を削除します。<br>よろしければ削除ボタンを押してください。</p>
<form action="post_delete.php" method="post">
<p>タイトル<input type="text" name="post_title" value="<?php echo $message_data['post_title']; ?>" disabled></p>
<p>本文<textarea name="post_message" disabled><?php echo $message_data['post_message']; ?></textarea></p>
<p><input type="submit" value="削除する"></p>
<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
<a class="btn_cancel" href="post_board.php">キャンセル</a>
</form>
</body>
</html>
