<?php
$pass_reset_token = $_POST['pass_reset_token'];
$pass = $_POST['pass'];
date_default_timezone_set("Asia/Tokyo");
$limit_time = date("Y/m/d h:i:s", strtotime("-30 minute"));
try {
	$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxxx');
} catch (PDOException $e) {
	echo '接続失敗' . $e->getMessage();
	exit();
}
$select = 'SELECT * FROM pass_reset WHERE pass_reset_token = :pass_reset_token';
$select_data = $dbh->prepare($select);
$select_params = array(':pass_reset_token' => $pass_reset_token);
$select_data->execute($select_params);
$select_result = $select_data->fetch();
if (strtotime($select_result['mail_sent_date']) >= strtotime($limit_time)) {
	$update = 'UPDATE registers INNER JOIN pass_reset ON registers.id = pass_reset.register_id SET registers.pass = :pass WHERE registers.id = pass_reset.register_id';
	$update_data = $dbh->prepare($update);
	$update_params = array(':pass' => $pass,);
	$update_completed = $update_data->execute($update_params);
	$msg = '新しいパスワードを設定しました';
	if ($update_completed) {
		$delete_pass_reset = 'DELETE FROM pass_reset WHERE pass_reset_token = :pass_reset_token';
		$delete_data = $dbh->prepare($delete_pass_reset);
		$delete_params = array(':pass_reset_token' => $pass_reset_token);
		$delete_result = $delete_data->execute($delete_params);
	}
} else {
	$msg = 'こちらのURLは30分を経過しているか、不正なアクセスの為無効です';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>パスワード設定完了ページ</title>
</head>
<body>
<?php echo $msg; ?>
<a href="login_form.php">ログインページへ</a>
</body>
</html>
