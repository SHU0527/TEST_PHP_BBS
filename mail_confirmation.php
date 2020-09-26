<?php
$mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
if (is_bool($mail) === true) {
	$msg = '正しい形式のメールアドレスを入力してください' . '<a href="pass_reset_form.php">メール送信画面へ</a>';
} else {
	date_default_timezone_set("Asia/Tokyo");
	$mail_sent_date = date("Y/m/d h:i:s");
	$pass_reset_token = uniqid(mt_rand(), true);
	mb_language("japanese");
	mb_internal_encoding("UTF-8");
	$title = 'パスワード再設定用の案内メールです';
	$contents = "https://xxxxxxxxxxxx/maegawa207/pass_reset.php?pass_reset_token=$pass_reset_token";
	$from = '大学受験掲示板管理事務局';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	$select = 'SELECT * FROM registers WHERE mail = :mail';
	$select_data = $dbh->prepare($select);
	$select_params = array(':mail' => $mail);
	$select_data->execute($select_params);
	$select_result = $select_data->fetch();
	var_dump($select_result);
	exit;
	if ($select_result) {
		$register_id = $select_result['id'];
		$insert = 'INSERT INTO pass_reset (`register_id`, `mail_sent_date`, `pass_reset_token`) VALUES (:register_id, :mail_sent_date, :pass_reset_token)';
		$insert_post = $dbh->prepare($insert);
		$insert_params = array(':register_id' => $register_id, ':mail_sent_date' => $mail_sent_date, ':pass_reset_token' => $pass_reset_token);
		$insert_post->execute($insert_params);
		mb_send_mail($mail, $title, $contents, $from);
	}
	$msg = '送信頂いたメールアドレスにパスワード再設定用のURLを送信しました' . '<a href="post_board.php">投稿一覧へ</a>';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログイン認証ページ</title>
</head>
<body>
<?php echo $msg; ?>
</body>
</html>
