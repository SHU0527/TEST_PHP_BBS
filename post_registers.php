<?php
session_start();
if (empty($_SESSION['id'])) {
	$msg = '投稿を完了するにはログインが必要です';
} elseif (empty($_POST['post_title']) || empty($_POST['post_message'])) {
	$msg = 'タイトルか本文が未入力です';
} else {
	$register_id = $_SESSION['id'];
	$post_title = $_POST['post_title'];
	$post_message = $_POST['post_message'];
	$post_date = date("Y/m/d h:i:s");
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$insert = 'INSERT INTO board_posts (`register_id`, `post_title`, `post_message`, `post_date`) VALUES (:register_id, :post_title, :post_message, :post_date)';
	$insert_post = $dbh->prepare($insert);
	$insert_params = array(':register_id' => $register_id, ':post_title' => $post_title, ':post_message' => $post_message,':post_date' => $post_date);
	$insert_post->execute($insert_params);
	$msg = $_SESSION['name'] . 'さんの書き込みが完了しました';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>投稿データ登録ページ</title>
</head>
<body>
<?php echo $msg; ?>
<a href="post_board.php">投稿一覧ページへ</a>
</body>
</html>
