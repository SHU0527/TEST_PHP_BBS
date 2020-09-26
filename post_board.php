<?php
session_start();
try {
	$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxx');
} catch (PDOException $e) {
	echo '接続失敗' . $e->getMessage();
	exit();
}
$select_post = 'SELECT registers.name, board_posts.id, board_posts.register_id, board_posts.post_title, board_posts.post_message, board_posts.post_date FROM board_posts INNER JOIN registers ON board_posts.register_id = registers.id AND deleted_flag = 0';
$select_data = $dbh->query($select_post);
$result_data = $select_data->fetchALL();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>投稿一覧</title>
</head>
<body>
<h1>大学受験情報掲示板</h1>
<?php if (isset($_SESSION['id'])): ?>
	 <a href="post_form.php">新規投稿する</a>
	 <a href="logout.php">ログアウト</a>
<?php else: ?>
	<?php echo '投稿するにはログインしてください'; ?>
	<br>
	<?php echo '＊新規会員登録がまだの方は、会員登録画面より新規登録をしてください'; ?>
	<br><a href="signup.php">新規会員登録画面へ</a>
	 <a href="login_form.php">ログインページへ</a>
<?php endif; ?>
<table border="2" cellpadding="6" cellspacing="5">
<tr>
<th>投稿者名</th>
<th>投稿ID</th>
<th>タイトル</th>
<th>本文</th>
<th>投稿者日付</th>
</tr>
<?php foreach ($result_data as $value): ?>
<tr>
<td>
<a href="user_page.php?id=<?php echo $value['register_id']; ?>"><?php echo $value['name']; ?></a>
</td>
<td><?php echo $value['id']; ?></td>
<td>
<?php echo $value['post_title']; ?>
<?php if (isset($_SESSION['id']) && $_SESSION['id'] == $value['register_id']): ?>
	<a href="edit.php?message_id=<?php echo $value['id']; ?>">編集</a>
	<a href="delete.php?message_id=<?php echo $value['id']; ?>">削除</a>
<?php endif; ?>
</td>
<td><?php echo $value['post_message']; ?></td>
<td><?php echo $value['post_date']; ?></td>
</tr>
<?php endforeach; ?>
</body>
</html>

