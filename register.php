<?php
$name = $_POST['name'];
$mail = $_POST['mail'];
$pass = $_POST['pass'];
$comments = $_POST['comments'];
try {
	$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxxxxx');
} catch (PDOException $e) {
	echo '接続失敗' . $e->getMessage();
	exit();
}
$select = 'SELECT * FROM registers WHERE mail = :mail AND pass = :pass';
$select_data = $dbh->prepare($select);
$select_params = array(':mail' => $mail, ':pass' => $pass);
$select_data->execute($select_params);
$result_data = $select_data->fetch();
if ($result_data['mail'] == $mail) {
	$msg = '同じメールアドレスが存在します';
	$link = '<a href="signup.php">戻る</a>';
} else {
	$insert = 'INSERT INTO registers (`name`, `mail`, `pass`, `comments`) VALUES (:name, :mail, :pass, :comments)';
	$insert_data = $dbh->prepare($insert);
	$insert_params = array(':name' => $name, ':mail' => $mail, ':pass' => $pass, ':comments' => $comments);
	$insert_data->execute($insert_params);
	$msg = '会員登録が完了しました';
	$link = '<a href="login_form.php">ログインページ</a>';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>会員登録ページ</title>
</head>
<body>
<?php
echo $msg;
echo $link;
?>
</body>
</html>
