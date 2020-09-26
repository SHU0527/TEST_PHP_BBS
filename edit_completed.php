<?php
session_start();
if (empty($_SESSION['id'])) {
	$msg = exit('一言コメントの編集にはログインが必要です' . '<a href="login_form.php">ログインページへ</a>');
} elseif (empty($_POST['comments'])) {
	$msg = '編集のリンクを押してから編集してください';
} else {
	$user_comment = $_POST['comments'];
	$user_id = $_SESSION['id'];
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$update_post = "UPDATE registers SET comments = :comments WHERE id = $user_id";
	$update_data = $dbh->prepare($update_post);
	$update_params = array('comments' => $user_comment);
	$update_data->execute($update_params);
	$msg = '投稿を編集完了しました';
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
