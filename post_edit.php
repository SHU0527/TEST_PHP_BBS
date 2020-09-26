<?php
session_start();
if (empty($_SESSION['id'])) {
	$msg = exit('編集にはログインが必要です' . '<a href="login_form.php">ログインページへ</a>');
} elseif (empty($_POST['post_title']) && empty($_POST['post_message']) && empty($_POST['post_id'])) {
	$msg = '編集のリンクを押してから編集してください';
} else {
	$post_title = $_POST['post_title'];
	$post_message = $_POST['post_message'];
	$post_id = $_POST['post_id'];
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$select_id = "SELECT register_id FROM board_posts WHERE id = $post_id";
	$select_data = $dbh->query($select_id);
	$result_data = $select_data->fetch();
	if ($_SESSION['id'] == $result_data['register_id']) {
		$update_post = "UPDATE board_posts SET post_title = :post_title, post_message = :post_message WHERE id = $post_id";
		$update_data = $dbh->prepare($update_post);
		$update_params = array(':post_title' => $post_title, ':post_message' => $post_message);
		$update_data->execute($update_params);
		$msg = '投稿を編集完了しました';
	} else {
		$msg = '投稿を編集できません';
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
