<?php
session_start();
$mail = $_POST['mail'];
$pass = $_POST['pass'];
if (empty($mail)) {
	$msg = 'メールアドレスを入力してください';
	$link = '<a href="post_board.php">投稿一覧へ</a>';
} elseif (empty($pass)) {
	$msg = 'パスワードを入力してください';
	$link = '<a href="post_board.php">投稿一覧へ</a>';
} else {
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$select = 'SELECT * FROM registers WHERE mail = :mail AND pass = :pass';
	$select_data = $dbh->prepare($select);
	$select_params = array(':mail' => $mail, ':pass' => $pass);
	$select_data->execute($select_params);
	$result_data = $select_data->fetch();
	if ($result_data) {
		$_SESSION['id'] = $result_data['id'];
		$_SESSION['name' ] =  $result_data['name'];
		$msg = 'ログインに成功しました';
		$link = '<a href="post_board.php">投稿一覧へ</a>';
	} else {
		$msg = 'メールアドレスかパスワードが間違えています';
		$link = '<a href="login_form.php">戻る</a>';
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログイン認証ページ</title>
</head>
<body>
<?php
echo $msg;
echo $link;
?>
</body>
</html>
