<?php
session_start();
if (empty($_GET['id'])) {
	$msg = 'ユーザーページを閲覧するには投稿者の名前をクリックしてください';
} else {
	$user_id = $_GET['id'];
	$msg = 'ユーザーの各情報が閲覧出来ます';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$select_register = "SELECT name, mail, comments, images_name FROM registers WHERE id = $user_id";
	$select_data = $dbh->query($select_register);
	$result_data = $select_data->fetch();
	$image_path = $result_data['images_name'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ユーザーページ</title>
</head>
<body>
<?php echo $msg; ?>
<?php if (isset($user_id)): ?>
	<h1>ユーザーページ</h1>
	<table border="2" cellpadding="6" cellspacing="5">
	<tr>
	<th>ユーザー名</th>
	<th>ユーザー画像</th>
	<th>メールアドレス</th>
	<th>一言コメント</th>
	</tr>
	<tr>
	<td><?php echo $result_data['name']; ?></td>
	<td>
	<?php if ($image_path): ?>
		<img src="./images/<?php echo $image_path; ?>" width="300" height="300">
	<?php else: ?>
		<?php echo '未登録'; ?>
	<?php endif; ?>
	</td>
	<td><?php echo $result_data['mail']; ?></td>
	<td><?php echo $result_data['comments']; ?></td>
	</tr>
	<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $user_id): ?>
		<a href="user_edit.php">一言コメント編集ページへ</a><br>
		<a href="upload.php">プロフィール画像編集ページへ</a><br>
	<?php endif; ?>
<?php endif; ?>
<a href="post_board.php">投稿一覧へ</a><br>
</body>
</html>

